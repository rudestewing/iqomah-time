<template>
    <div id="app-vue" class="tw-min-h-full tw-bg-indigo-800">
        <component :is="`app-layout-default`">
            <div class="tw-py-5">
                <div class="tw-bg-gray-200 tw-bg-opacity-50 tw-rounded-lg">
                    <div class="tw-flex">
                        <div class="tw-w-full tw-p-5 md:tw-w-7/12">
                            <div class="tw-flex tw-justify-between tw-py-5 tw-px-5 tw-bg-teal-800 tw-text-white tw-font-bold tw-rounded-lg">
                                <div class="tw-w-full md:tw-w-8/12">
                                    <p class="tw-text-4xl">
                                        Jadwal Shalat
                                    </p>
                                    <p class="tw-text-5xl">
                                        {{currentDateString}}
                                    </p>
                                </div>
                                <div class=" tw-w-full md:tw-w-4/12">
                                    <p class="text-right">
                                        Bogor
                                    </p>
                                </div>
                            </div>

                            <div>
                                <div class="tw-text-gray-800 tw-text-6xl tw-font-extrabold tw-tracking-widest" style="font-size: 6rem;" v-if="!isIqomah">
                                    <div class=" tw-bg-yellow-400 tw-rounded-lg tw-p-4 tw-text-center">
                                        {{currentTimeString}}
                                    </div>
                                </div>
                                <div v-if="reminderUpcomingTime">
                                    <app-reminder-upcoming-time 
                                        :upcomingTime="upcomingTime"
                                        :class="` rounded-tl-none rounded-tr-none `">
                                    </app-reminder-upcoming-time>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tw-w-full tw-p-5 md:tw-w-5/12 ">
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

            spareIqomah: 600, // 10 minutes iqomah countdown
            spareUpcoming: 600, // 10 minutes upcoming countdown 
            
            upcomingTime: null,
            reminderUpcomingTime: false,

            spareAlert: 20,

            maxTimeStamp: 0,
            minTimeStamp: 0,
        }
    },

    computed: {
        currentTimeString: function() {
            return moment.unix(this.currentTimestamp).format('HH:mm:ss');
        },
        currentDateString: function() {
            return moment.unix(this.currentTimestamp).format('dddd, DD MMMM yyyy');
        }
    },

    methods: {
        startService() {
            this.findCity();
        },
        stopService() {
            this.stopCounting();
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
            this.startCounting();
        },

        setCurrentTimestamp() {
            var value = moment().unix();
            console.log(value);
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

            console.log(data);

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
            clearInterval(this.interval);
        },
    },

    mounted() {
        this.startService();
    },
}
</script>

<style lang="css">
    html, body {
        height: 100%;
        font-size: 20px;
    }
</style>
