const state = () => {
	return {
		currentTimestamp: 0,

		spareIqomah: 600, // 10 minutes iqomah countdown
		spareUpcoming: 600, // 10 minutes upcoming countdown 
		spareAlert: 20,

		interval: null,
	}
}

const actions = {
	startCounting(context) {
		
	}
}

const mutations = {
	SET_CURRENT_TIMESTAMP(state, payload) {

	},
	SET_INTERVAL(state, payload) {

	},

}

export default {
	namespaced: true,
	state, 
	actions,
	mutations
}
