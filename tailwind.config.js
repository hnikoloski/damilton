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
        'greatVibes': ['Great Vibes', 'cursive'],
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
        'infinite-scroll': {
          from: { transform: 'translateX(0)' },
          to: { transform: 'translateX(-100%)' },
        }
      },
      animation: {
        ribbonAnim: 'ribbonAnim 20s linear infinite',
        ribbonMobileAnim: 'ribbonMobileAnim 20s linear infinite',
        'infinite-scroll': 'infinite-scroll 25s linear infinite',
      },
      boxShadow: {
        'loadShadow': '0px 10px 20px rgba(0, 0, 0, 0.2)',
        'cardShadow': '0px 220px 88px rgba(0, 0, 0, 0.01), 0px 124px 74px rgba(0, 0, 0, 0.13), 0px 55px 55px rgba(0, 0, 0, 0.13), 0px 14px 30px rgba(0, 0, 0, 0.17)',
      },
      dropShadow: {
        'contact-image': [
          '0px 264px 106px rgba(0, 0, 0, 0.02)',
          '0px 148px 89px rgba(0, 0, 0, 0.08)',
          '0px 66px 66px rgba(0, 0, 0, 0.14)',
          '0px 16px 36px rgba(0, 0, 0, 0.16)',
        ],
      },
    },
    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      white: '#ffffff',
      black: '#000000',
      beige: '#F9DCBC',
      brightBeige: '#F4F0EA',
      brown: '#42210B',
      dark: '#292A2C',
      lime: '#799410'
    },
  },
  plugins: [],
};