import Vue from 'vue';
import Vuex from 'vuex';

import homeSliders from './modules/home-slider';
import scheduleTimes from './modules/schedule-time';
import counter from './modules/counter';

Vue.use(Vuex);

const store = new Vuex.Store({
	modules: {
		iqomah,
		homeSliders,
		scheduleTimes,
	}
});