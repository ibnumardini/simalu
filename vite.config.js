import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import purge from "@erbelion/vite-plugin-laravel-purgecss";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/css/landingpage.css",
                "resources/js/landingpage.js",
            ],
            refresh: true,
        }),
        purge({
            paths: [
                "resources/views/**/*.blade.php",
                "resources/js/**/*.js",
            ],
        }),
    ],
});
