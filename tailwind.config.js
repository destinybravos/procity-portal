/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  content: ["./src/**/*.{html,js}", "./public/**/*.{html,js,php}"],
  theme: {
    extend: {
      colors: {
        primary: '#5c50e4',
      }
    },
  },
  plugins: [],
}
