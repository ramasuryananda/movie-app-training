const plugin = require('tailwindcss/plugin')

module.exports = {
    purge: [],
    purge: [
      './resources/**/*.blade.php',
      './resources/**/*.js',
      './resources/**/*.vue',
    ],
     darkMode: false, // or 'media' or 'class'
     theme: {
       extend: {
           width:{
            '96' : '24rem'
           }
       },
     },
     variants: {
       extend: {},
     },
     plugins: [
        plugin(function ({ addUtilities }) {
          addUtilities({
            '.bg-overlay': {
              'background': 'linear-gradient(var(--overlay-colors)), var(--overlay-image)',
              'background-position': 'center',
              'background-size': 'cover',
            },
          });
        }),
      ],
   }
