<template>
    <div class=" tw-p-4 tw-bg-yellow-600 tw-shadow-md tw-text-gray-100 tw-rounded-lg">
        <div v-if="upcomingTime">
            <p class="tw-text-4xl ">
                Sedikit lagi masuk waktu {{upcomingTime.time.title}}
            </p>
            <p class="tw-text-6xl">
                Waktu {{upcomingTime.time.title}} {{timeString}}
            </p>
        </div>
    </div>
</template>

<script>
import moment from 'moment';

export default {
    props: {
        upcomingTime: Object
    },

    computed: {
        timeString: function() {
            if(this.upcomingTime) {
                return moment.unix(this.upcomingTime.epoch).format('HH:mm:ss');
            }   
        }
    }
    

}
</script>