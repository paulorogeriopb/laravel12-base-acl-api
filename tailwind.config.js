import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                "cor-padrao": "#32a2b9",
                "cor-primary": "#32a2b9",
                "cor-primary-secondary": "#298ba1",
                "cor-dark-primary": "#1d232a",
                "cor-dark-secondary": "#191e24",
                "cor-dark-tertiary": "#14191f",
                "cor-light-primary": "#f4f6f9",
                "cor-light-secondary": "#ebeef4",
                "cor-light-tertiary": "#d8dee9",
                "cor-success": "#45b977",
                "cor-success-secondary": "#3fa56e",
                "cor-info": "#60bbcd",
                "cor-info-secondary": "#4ab3c6",
                "cor-warning": "#dfa300",
                "cor-warning-secondary": "#c18f00",
                "cor-danger": "#dd4c6a",
                "cor-danger-secondary": "#b43c54",
                "cor-sombra": "#191e24",
                "cor-table-header": "#15191e",
                "color-athens-gray-400": "#A0AEC0", // ex: para texto escuro
                "cor-table-hover": "#15191e",
                "cor-table-line": "##323d48",
                "cor-claro": "#4ab3c6",
                "cor-escuro": "#276377",
            },
        },
    },

    plugins: [forms],
};
