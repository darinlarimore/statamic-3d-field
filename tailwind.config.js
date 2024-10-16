module.exports = {
	content: ['./resources/**/*'],
	corePlugins: {
		preflight: false,
	},
	prefix: 'd-',
	darkMode: ['variant', ['html[class*="dark"] &']],
}
