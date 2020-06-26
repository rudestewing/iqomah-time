<template>
    <div 
        :class="`
            tw-flex tw-flex-wrap tw-rounded-lg tw-shadow-lg tw-border-0 tw-border-l-8 tw-p-5
            ${(isActive == true ? 'tw-bg-yellow-500 tw-border-yellow-700' : 'tw-bg-gray-100 tw-border-indigo-700')}
        `"
        >
        <div class="tw-font-semibold tw-tracking-wider md:tw-w-5/12">
            <div :class="`tw-text-indigo-800 tw-font-bold tw-text-4xl tw-uppercase ${(isActive == true ? 'tw-font-black' : '')} tw-flex tw-items-center`">
                {{scheduleTime.time.title}}
            </div>
            <div class="tw-font-bold tw-text-4xl">
                
            </div>
        </div>
        <div class="md:tw-w-7/12 tw-relative tw-font-extrabold tw-text-5xl tw-text-right">
            {{timeString}}
            <!-- <img src="#" alt="" class="tw-w-full tw-h-auto tw-object-cover tw-object-center tw-absolute tw-inset-0 tw-h-full tw-w-full"> -->
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
        }  
    },
    mounted() {
        console.log(
            this.title,
            this.time,
            this.isActive,
        )
    },
}
</script>