module.exports = {
  content: [
    "./resources/js/**/*.js", 
    "./resources/js/**/*.vue"
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('tailwind-scrollbar-hide')
  ],
}
