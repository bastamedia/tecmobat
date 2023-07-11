/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.{js,php}"],
  theme: {
    extend: {},
  },
  plugins: [require("@tailwindcss/typography"), require("daisyui")],
};
