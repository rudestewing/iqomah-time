<template>
    <div id="app-vue" class="tw-min-h-full tw-bg-indigo-800 tw-relative tw-bg-center tw-bg-cover tw-bg-opacity-25"  :style="{
        backgroundImage: `url(${imgbg})`,
    }">
        <component :is="`app-layout-default`">
            <div class="tw-py-5 tw-z-10" style="font-size: 20px;">
                <div class="tw-bg-gray-200 tw-bg-opacity-50 tw-rounded-lg">
                    <div class="tw-flex tw-flex-wrap">
                        <div class="tw-w-full tw-p-5 lg:tw-w-8/12">
                            <div class="tw-flex tw-justify-between tw-py-5 tw-px-5 tw-bg-teal-800 tw-text-white tw-font-bold tw-rounded-lg">
                                <div class="tw-w-full lg:tw-w-8/12">
                                    <p class="tw-text-5xl">
                                        {{currentDateString}}
                                    </p>
                                </div>
                                <div class=" tw-w-full lg:tw-w-4/12">
                                    <p class="text-right">
                                        <!-- {{city || city.name}} -->
                                    </p>
                                </div>
                            </div>
                            <div class="tw-pt-5">
                                <div class="tw-text-gray-800 tw-text-6xl tw-font-extrabold tw-tracking-widest tw-bg-yellow-400 tw-rounded-lg tw-p-4 tw-text-center" style="font-size: 6rem;" >
                                    {{currentTimeString}}
                                </div>
                            </div>
                            <div v-if="isIqomah" class="tw-pt-5">
                                <app-iqomah-countdown 
                                    :iqomahDistance="iqomahDistance">
                                </app-iqomah-countdown>
                            </div>
                            <div v-if="reminderUpcomingTime" class="tw-pt-5">
                                <app-reminder-upcoming-time 
                                    :upcomingTime="upcomingTime"
                                    :class="` rounded-tl-none rounded-tr-none `">
                                </app-reminder-upcoming-time>
                            </div>
                            <div v-if="!reminderUpcomingTime && !isIqomah" class="tw-pt-5">
                                <app-home-slider :contents="sliderContents"></app-home-slider>
                            </div>
                        </div>
                        <div class="tw-w-full tw-p-5 lg:tw-w-4/12 ">
                            <div class="tw-mb-4" v-for="(scheduleTime, index) in todayScheduleTimes" :key="index">
                                <app-time-item 
                                    :scheduleTime="scheduleTime"
                                ></app-time-item>
                            </div>
                        </div>
                    </div>
                    <div class="text-center text-gray-200 text-xs pb-3">
                        Data berdasarkan hasil export dari <a href="https://jadwalsholat.pkpu.or.id/export.php"> https://jadwalsholat.pkpu.or.id/export.php </a>
                    </div>
                </div>
            </div>
        </component>
        <audio src="/sounds/beep.mp3" ref="audioElement"></audio>
    </div>
</template>

<script>
import axios from 'axios';
import moment from 'moment';

export default {
    data() {
        return {
            city: null,
            today: {},
            todayScheduleTimes: [],
            date: 0,
            month: 0,
            year: 0,
            currentTimestamp: 0,
            interval: null,
            isIqomah: false,
            iqomahCountdown: 0,
            iqomahDistance: 0,

            spareIqomah: 0, // 10 minutes iqomah countdown
            spareUpcoming: 0, // 10 minutes upcoming countdown 
            spareAlert: 0,
            
            upcomingTime: null,
            reminderUpcomingTime: false,


            maxTimestamp: 0,
            minTimestamp: 0,

            background: null,
            sliderContents: [],
        }
    },

    watch: {
        currentTimestamp: function(newVal, oldVal) {
            if(newVal > this.maxTimestamp  || newVal < this.minTimestamp ) {
                this.restartService();
            }
        }
    },

    computed: {
        currentTimeString: function() {
            return moment.unix(this.currentTimestamp).format('HH:mm:ss');
        },
        currentDateString: function() {
            return moment.unix(this.currentTimestamp).format('dddd, DD MMMM yyyy');
        },

        imgbg: function() {
            return this.background ? 
                `/storage/${this.background.image_path}` : ''
        },
    },

    methods: {
        async getSetting() {
            try {
                const background = await axios.get('/api/background');

                var {data} = background.data;
                
                this.background = data;
                
            } catch (error) {
                console.log(error);                
            }

            try {
                const spares = await axios.get('/api/spare');
                var {data} = spares.data;
                console.log('data', data);
    
                this.spareIqomah = data.iqomah;
                this.spareUpcoming = data.upcoming;
                this.spareAlert = data.iqomah_alert;
                
            } catch (error) {
                console.log(error);                
            }
        },  

        async getHomeSliderContents() {
            const response = await axios.get('api/homeSliders');
            const {data} = response;
            this.sliderContents = data.data;
        },

        startService() {
            console.log('service start');
            this.getSetting();
            this.getHomeSliderContents();
            this.findCity();
        },

        async findCity() {
            const response = await axios.get('api/city/1');
            const {data} = response;
            
            this.city = data.data;
            this.findToday();
        },

        async findToday() {
            const response = await axios.get(`/api/today/${this.city.id}`);
            const {data} = response;
            
            this.today = {
                dateTime: moment(),
            };

            this.todayScheduleTimes = data.data;

            var todayDateString = moment(this.today.dateTime).format('DD MMMM yyyy');

            this.minTimestamp = moment(`${todayDateString} 00:00:00`, 'DD MMMM yyyy HH:mm:ss').unix();
            this.maxTimestamp = moment(`${todayDateString} 23:59:59`, 'DD MMMM yyyy HH:mm:ss').unix();
            this.startCounting();
        },

        setCurrentTimestamp() {
            var value = moment().unix();
            this.currentTimestamp = value;
        },

        findUpcoming() {
            if(!this.todayScheduleTimes.length) {
                return ;
            }

            var self = this;

            var data = Array.from(this.todayScheduleTimes).find((item, index) => {
                return self.currentTimestamp <= item.epoch;
            });

            if(data) {
                this.upcomingTime = data;

                var gap = this.currentTimestamp - data.epoch;
                if(gap >= -(this.spareUpcoming)) {
                    
                    this.reminderUpcomingTime = true; 
                } else {
                    this.reminderUpcomingTime = false;
                }
            } else {
                this.upcomingTime = null;
            }
        },
        
        findPassed() {
            if(!this.todayScheduleTimes.length) {
                return ;
            }
            
            var self = this;

            var data =  Array.from(this.todayScheduleTimes).reverse().find((item, index) => {
                return self.currentTimestamp >= item.epoch;
            });

            if(data) {
                var distance = (data.epoch + this.spareIqomah) - this.currentTimestamp;

                if(distance > 0 && data.time.is_iqomah == 1) {
                    this.isIqomah = true;
                    this.iqomahDistance = distance;
                    
                    if(distance <= this.spareAlert) {
                        console.log('play');
                        this.playIqomahAlertSound();
                    }
                    
                } else {
                    this.isIqomah = false;
                }
            }
        },

        startCounting() {
            const self = this;

            this.interval = setInterval(() => {
                self.setCurrentTimestamp();
                self.findUpcoming();
                self.findPassed();
            }, 1000);
        },

        stopCounting() {
            console.log('stop counting');
            clearInterval(this.interval);
        },

        restartService() {
            console.log('service restart');
            this.stopCounting();
            this.startService();
        },

        playIqomahAlertSound() {
            new Audio('/sounds/beep.mp3').play();
            // console.log('play alert sound');
            // this.$refs.audioElement.play();
        }
    },

    mounted() {
        this.startService();
    },
}
</script>

<style lang="css">
    html, body {
        height: 100%;
    }
</style>
