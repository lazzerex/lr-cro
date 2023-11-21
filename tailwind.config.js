import defaultTheme from 'tailwindcss/defaultTheme';
import colors from 'tailwindcss/colors';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Mulish', 'Nunito', ...defaultTheme.fontFamily.sans],
            },
            zIndex: {
                '999': '999',
                '998': '998',
                '1000': '1000'
            },
            colors: {
                transparent: 'transparent',
                current: 'currentColor',
                heading: '#012970',
                primary: colors.indigo, // '#6366f1', //indigo 500
                success: colors.emerald, // '#10b981', //emerald 500
                danger: colors.rose, //'#f43f5e', //rose 500
                warning: colors.amber, //'#f59e0b', //amber 500
            },
            height: {
                '98': '24.3rem',
            },
            maxHeight: {
                '98': '24.3rem',
            }
        },
    },

    plugins: [forms, typography],
};
