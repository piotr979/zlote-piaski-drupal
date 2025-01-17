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
          'secondary-btn-color': '#EBE1AA'
  
        },
        fontFamily: {
          'main-normal': ['Jost'],
          'heading': ['Magra'],
        },
      },
    },
    plugins: [],
  }