<template>
    <div class=" tw-w-full tw-p-5">
        <component :is="`app-default-layout`" >
            <app-home :today="today" @timestampOverlap="findToday"></app-home>
        </component>
    </div>
</template>

<script>
import appDefaultLayout from './layouts/Default.vue';
import appHome from './pages/Home.vue';
import axios from 'axios';

export default {
    components: {
        appDefaultLayout,
        appHome,
    },

    data() {
        return {
            today: {},
            date: 0,
            month: 0,
            year: 0,
        }
    },

    methods: {
        async findToday() {
            const response = await axios.get('/api/today');
            const {data} = response;
            console.log(data);
        },
    
        
    },

    mounted() {
        this.findToday();
    },
}
</script>