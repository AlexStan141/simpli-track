import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/**/*.php'

    ],

    theme: {
        extend: {
            boxShadow: {
                'text-outline': '-1px -1px 0 #E3E8EF, 1px -1px 0 #E3E8EF, -1px 1px 0 #E3E8EF, 1px 1px 0 #E3E8EF',
            },
            fontFamily: {
                sans: ['Manrope', ...defaultTheme.fontFamily.sans],
                nunito: ['Nunito', ...defaultTheme.fontFamily.sans],
                inter: ['Inter', 'sans-serif'],
            },
            colors: {
                loginblue: '#334461',
                formgray: '#EDEDED',
                formtitle: '#1E1E1E',
                editprofilelabel: '#949494',
                editprofileinput: '#F6F6F6',
                bodycolor: '#FAFAFA',
                pagelink: '#0C5489',
                invoiceadd: '#EFEFEF',
                inputbordercolor: '#E3E8EF',
                buttontext: '#5F5F5F'
            }
        },
    },

    plugins: [forms],
};
