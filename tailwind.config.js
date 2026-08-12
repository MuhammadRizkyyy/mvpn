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
            colors: {
                primary: {
                    50: '#FDECEC', 100: '#F9C7C7', 300: '#E4696B',
                    500: '#CE1126', 600: '#B00E20', 700: '#8C0B19', 900: '#4E0610',
                },
                navy: {
                    50: '#EAF0F6', 100: '#C3D3E3', 300: '#5C7A9B',
                    500: '#12233B', 700: '#0A1526', 900: '#05090F',
                },
                gold: {
                    100: '#FBEFD2', 400: '#E8B84B', 500: '#D4A017', 600: '#B3830D',
                },
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                display: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
