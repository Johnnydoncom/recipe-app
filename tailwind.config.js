import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    presets: [
        require('./vendor/wireui/wireui/tailwind.config.js')
    ],
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './vendor/wireui/wireui/resources/**/*.blade.php',
        './vendor/wireui/wireui/ts/**/*.ts',
        './vendor/wireui/wireui/src/View/**/*.php'
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            borderRadius: {
                '4xl': '2.1rem'
            },
            colors: {
                "primary": {
                    DEFAULT: "#8800C9",
                    50: "#F5E0FF",
                    100: "#ECC2FF",
                    200: "#D885FF",
                    300: "#C547FF",
                    400: "#B10AFF",
                    500: "#8800C9",
                    600: "#7000A3",
                    700: "#54007A",
                    800: "#380052",
                    900: "#1C0029",
                    950: "#0E0014"
                }
            },
        },
    },

    plugins: [forms],
};
