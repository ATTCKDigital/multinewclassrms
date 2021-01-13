module.exports = {
	plugins: {
		'postcss-cssnext': {
			features: {
				customProperties: {
					/**
					 * Disable custom properties warnings
					 * "variable '--my-variable' is undefined and used without a fallback"
					 * Why?
					 * We use PHP to declare various user configured native CSS variables (colors etc.)
					 * within style tags in our rendered HTML.
					 * So, though some of these variables may appear undefined, they are not.
					 */
					warnings: false
				}
			}
		},
		'cssnano': {}
	}
}
