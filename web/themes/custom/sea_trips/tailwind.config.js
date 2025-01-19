/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ['./templates/**/*.twig', './../../../modules/custom/custom_extras/src/Plugin/Block/*.php',
    './../../../modules/custom/three_footer/templates/*.twig'],
    theme: {
      extend: {
        colors: {
          'accent-dark-color': '#275CA8',
          'accent-light-color': "#C1D4EF",
          'dark-bg-color': '#0F1329',
          'primary-btn-color': '#9ED3FF',
          'primary-btn-hov-color': '#AEE3FF',
          'secondary-btn-color': '#EBE1AA',
          'secondary-btn-hov-color': '#FBF1BA',
          'infoicon': '#BCE3FF',
          'infophoto-link': '#568AC6'
  
        },
        fontFamily: {
          'main': ['Jost'],
          'heading': ['Magra'],
        },
      },
    },
    plugins: [],
  }