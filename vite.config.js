import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    content: [
        "./public/**/*.{html,js}",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./public/**/*.html",
    ],
    theme: {
        fontFamily: {
            poppins: "Poppins, sans-serif",
        },
        extend: {
            colors: {
                // primary: "#FD915A",
                primary: "#009e42ff",
                secondary: "#F7F1F0",
                black: "#121212",
                grey: "#ADAAB4",
                lilac: "#E6D3F8",
            },
        },
    },
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    server: {
        host: "0.0.0.0",
        port: 5173,
        hmr: {
            host: "192.168.0.136", // otomatis mengikuti APP_URL
        },
    },
});
