const publicRoutes = [
	{
		path: '/',
		name: 'home',
		component: () => import('../pages/Home.vue')
	},
]

export default [
	...publicRoutes
];