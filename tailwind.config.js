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
                oxford: {
                    50:  '#eef2f7',
                    100: '#d5deeb',
                    200: '#adbdd7',
                    300: '#859cc3',
                    400: '#5f7baf',
                    500: '#3d5a9b',
                    600: '#314a8a',
                    700: '#253978',
                    800: '#192867',
                    900: '#0d1756',
                },
                tan: {
                    50:  '#fdf8f0',
                    100: '#f9edd8',
                    200: '#f2dab1',
                    300: '#eac78a',
                    400: '#dbaf5e',
                    500: '#cc9832',
                    600: '#b07d1f',
                    700: '#8f6118',
                    800: '#6d4912',
                    900: '#4b310d',
                },
            },
            boxShadow: {
                'soft': '0 1px 3px 0 rgb(0 0 0 / 0.06)',
                'card': '0 4px 6px -1px rgb(0 0 0 / 0.05)',
                'lift': '0 10px 15px -3px rgb(0 0 0 / 0.08)',
            },
        },
    },

    plugins: [forms],
};
