<template>
    <div 
        :class="`
            tw-flex tw-flex-wrap tw-rounded-lg tw-shadow-lg tw-border-0 tw-border-l-8 tw-p-5 tw-relative
            ${(isActive == true ? 'tw-bg-yellow-500 tw-border-yellow-700' : 'tw-bg-gray-100 tw-border-indigo-700')}
        `"
        >
        <!-- <img :src="imgbg" alt="" data-default="/mosque.jpeg" @error="replaceDefaultBackground" class="
                tw-w-full 
                tw-h-auto 
                tw-object-cover 
                tw-object-center 
                tw-absolute 
                tw-inset-0 
                tw-h-full 
                tw-w-full
                tw-z-0
                tw-opacity-25
            "> -->
        <div class="tw-font-semibold tw-tracking-wider tw-w-full lg:tw-w-5/12 tw-z-20">
            <div :class="`tw-text-indigo-900 tw-font-extrabold tw-text-5xl tw-uppercase ${(isActive == true ? 'tw-font-black' : '')} tw-flex tw-items-center`">
                {{scheduleTime.time.title}}
            </div>
        </div>
        <div class="tw-w-full lg:tw-w-7/12 tw-font-extrabold tw-text-5xl tw-text-right tw-z-20 tw-text-indigo-900">
            {{timeString}}
        </div>
    </div>
</template>

<script>
import moment from 'moment';

export default {
    props: {
        scheduleTime: Object
    },
    data() {
        return {
            isActive: false,
        }
    },
    computed: {
        timeString: function() {
            return moment.unix(this.scheduleTime.epoch).format('HH:mm');
        },
        imgbg: function() {
            return `/storage/${this.scheduleTime.time.image_path}`;
        },
    },
    mounted() {
        console.log(
            this.title,
            this.time,
            this.isActive,
        )
    },
    methods: {
        replaceDefaultBackground(e) {
            return e.target.src = e.target.getAttribute('data-default');
        }
    }
}
</script>