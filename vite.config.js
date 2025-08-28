import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        tailwindcss(),
        laravel({
            input: [
                "resources/css/quill.css",
                "resources/css/datatables.css",
                "resources/js/quill.js",
                "resources/js/datatables.js",
            ],
            refresh: true,
        }),
    ],
});
