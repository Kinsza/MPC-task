module.exports = {
	important: true,
	content: [ './src/**/*.vue', './../*.php', './src/**/*.php', './../srcwp/**/*.php', './../templates/*.php', './../woocommerce/**/*.php' ],
	media: false, // or 'media' or 'class'

	theme: {
		extend: {
			screens: {
				'2xl': '1440px'
			},
			fontSize: {},

			colors: {
				gray: {},
				primary: {
					100: '#FAB00F',
					200: '#c3a865',
					300: '#dddddd'
				}
			},
			lineHeight: {},
			boxShadow: {}
		}
	},
	variants: {
		extend: {}
	},
	plugins: []
};
