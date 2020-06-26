<template>
    <div class=" tw-p-4 tw-bg-green-700 tw-shadow-md tw-text-gray-100 tw-rounded-lg">
        <p class=" tw-text-4xl tw-font-bold tw-leading-6 tw-tracking-wider">
            IQOMAH
        </p>
        <p class=" tw-text-6xl tw-font-bold">
            {{countdownString}}
        </p>
        <!-- <p>
            Waktu Syuruq <span> {{time}} </span> 
        </p> -->
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