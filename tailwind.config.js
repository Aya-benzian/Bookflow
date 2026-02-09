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
                'primary-navy': '#0A1128',
                'primary-creamy': '#F8F8F8',
                'accent-gold': '#DAA520',
                'secondary-blue': '#1C3F70',
                'neutral-grey': '#D0D0D0',
                'text-on-navy': '#F8F8F8', // Creamy text on navy backgrounds
                'text-on-creamy': '#303030', // Dark grey text on creamy backgrounds
                'success-sage': '#8FBC8F',
                'error-red': '#DC3545',
                // New colors for welcome page
                'primary': '#0A1128', // Same as primary-navy
                'primary-light': '#1C3F70', // Same as secondary-blue
                'secondary': '#F8F8F8', // Same as primary-creamy
                'secondary-dark': '#E0E0E0', // A custom darker creamy
                'accent': '#DAA520', // Same as accent-gold
            },
        },
    },

    plugins: [forms],
};
