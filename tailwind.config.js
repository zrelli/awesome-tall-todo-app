import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },


            colors: {
                primary: {
                  darkest: '#1f2d3d',
                  dark: '#3c4858',
                  DEFAULT: '#FFD700', // Your primary yellow color
                  light: '#e0e6ed',
                  lightest: '#f9fafc',
                },
              },


        },
    },

    plugins: [forms],
    customClasses: {
        'z-toast': 'z-50', // You can adjust the z-index value as needed
      },
};
