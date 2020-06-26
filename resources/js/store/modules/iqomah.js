const state = () => {
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

		maxTimestamp: 0,
		minTimestamp: 0,
	}
}