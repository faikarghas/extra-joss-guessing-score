/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
      fontFamily: {
        head: ['BebasNeue-Regular'],
        sans: ['WorkSans-Regular'],
      },
    },
  },
  plugins: [
    require('flowbite/plugin')
  ],
}
