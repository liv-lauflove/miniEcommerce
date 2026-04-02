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
                chocolate: {
                    50:  '#fdf6f0',
                    100: '#f5e6d3',
                    200: '#e8ccab',
                    300: '#d4a574',
                    400: '#8b5e3c',
                    500: '#6b4226',
                    600: '#4a2c17',
                    700: '#2d1a0f',
                },
                cream: {
                    50:  '#fffbf5',
                    100: '#fff5e6',
                    200: '#ffeacc',
                    300: '#ffdca8',
                    400: '#ffc577',
                    500: '#f5a623',
                },
                berry: {
                    50:  '#fdf2f8',
                    100: '#fce7f3',
                    200: '#fbcfe8',
                    300: '#f9a8d4',
                    400: '#ec4899',
                    500: '#db2777',
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
