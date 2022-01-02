module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            boxShadow: {
                card: '0 1px 2px rgba(9, 30, 66, 0.25)'
            }
        },
    },
    variants: {
        opacity: ['group-hover', 'hover']
    },
    plugins: [],
}
