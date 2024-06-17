/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './src/scripts/**/*.js',
    './**/*.php'
  ],
  theme: {
    extend: {
      spacing: {
        'side-padding-desktop': '12rem',
        'side-padding-mobile': '1.5rem',
      },
      fontFamily: {
        'manrope': ['Manrope', 'sans-serif'],
      },
      keyframes: {
        ribbonAnim: {
          '0%': {
            transform: 'translateX(0)',
          },
          '100%': {
            transform: 'translateX(calc(-100% - 9rem))',
          },
        },
        ribbonMobileAnim: {
          '0%': {
            transform: 'translateX(0)',
          },
          '100%': {
            transform: 'translateX(calc(-100% - 3rem))',
          },
        },
      },
      animation: {
        ribbonAnim: 'ribbonAnim 20s linear infinite',
        ribbonMobileAnim: 'ribbonMobileAnim 20s linear infinite',
      },

    },
    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      white: '#ffffff',
      black: '#000000',
      beige: '#F9DCBC',
    },
  },
  plugins: [],
};