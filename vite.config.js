import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],

    server: {
        host: "127.0.0.1", // binds to all IPv4 interfaces
        port: 5173,
        strictPort: true,
    },
    hmr: {
        host: "127.0.0.1", // <--- this is key for HMR/client URL
        port: 5173,
    },
});
