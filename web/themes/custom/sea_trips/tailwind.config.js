/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ['./templates/**/*.twig', './../../../modules/custom/custom_extras/src/Plugin/Block/*.php',
    './../../../modules/custom/three_footer/templates/*.twig',
  './templates/custom/sea_trips/sea_trips.theme'],
    theme: {
      extend: {
        backgroundImage: {
          'footer-bg': "url('../images/footer_background.jpeg')",
        },
        borderRadius: {
          '4xl': '40px'
        },
        colors: {
          'accent-dark-color': '#275CA8',
          'accent-light-color': "#C1D4EF",
          'dark-bg-color': '#0F1329',
          'primary-btn-color': '#9ED3FF',
          'primary-btn-hov-color': '#AEE3FF',
          'secondary-btn-color': '#EBE1AA',
          'secondary-btn-hov-color': '#FBF1BA',
          'infoicon': '#BCE3FF',
          'infophoto-link': '#568AC6',
          'pricing-bg-1': '#F6F5EF',
          'pricing-btn-1': '#3E2F21',
          'pricing-bg-2': '#EFF4F6',
          'pricing-btn-2': '#385364',
          'pricing-bg-3': '#F6EFF2',
          'pricing-btn-3': '#643838'

  
        },
        fontFamily: {
          'main': ['Jost'],
          'heading': ['Magra'],
        },
      },
    },
    safelist: [
      'bg-pricing-bg-1',
      'bg-pricing-bg-2',
      'bg-pricing-bg-3',
      'bg-pricing-btn-1',
      'bg-pricing-btn-2',
      'bg-pricing-btn-3',
    ],
    plugins: [],
  }
