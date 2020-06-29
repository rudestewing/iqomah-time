<template>
    <div class="tw-p-8 tw-bg-green-700 tw-shadow-md tw-text-gray-100 tw-rounded-lg">
        <h3 class="tw-font-bold tw-leading-6 tw-tracking-wider tw-text-5xl tw-mt-6">
            IQOMAH
        </h3>
        <p class="tw-mb-0 tw-text-6xl tw-font-bold tw-mt-5">
            {{countdownString}}
        </p>
    </div>
</template>


<script>
export default {
    props: {
        iqomahDistance: Number,
    }, 
    computed: {
        countdownString: function() {
            return this.countIqomah(this.iqomahDistance);
        }
    },
    methods: {
        countIqomah(distance) {
            // Time calculations for days, hours, minutes and seconds
            // var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            // var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            // var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            // var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            // var days = Math.floor(distance / ( 60 * 60 * 24));
            // var hours = Math.floor((distance % ( 60 * 60 * 24)) / ( 60 * 60));
            var minutes = Math.floor((distance % ( 60 * 60)) / ( 60));
            var seconds = Math.floor((distance % ( 60)));

            // $('#iqomah-countdown').html(days + "d " + hours + "h "+ minutes + "m " + seconds + "s ");

            return minutes + " Menit " + seconds + " Detik";
            // $('#iqomah-countdown').html(minutes + " Menit " + seconds + " Detik");
        }
    }
    
}
</script>