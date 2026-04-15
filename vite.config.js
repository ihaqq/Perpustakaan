import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                //Landing Page
                "resources/css/LandingPage/landing_page.css",
                "resources/js/LandingPage/landing_page.js",

                // css dashboard
                "resources/css/admin/dashboard/dashboard_tanpa_sidebar.css",
                "resources/css/admin/dashboard/dashboard_improved.css",
                // css anggota perpus
                "resources/css/admin/anggota/halaman_anggota_tanpa_sidebar.css",
                
                // css buku
                "resources/css/admin/buku/halaman_buku.css",
                "resources/css/admin/buku/perbaikan_buku.css",
                // css sidebar
                "resources/css/admin/sidebar/sidebar_tes.css",
                "resources/css/admin/sidebar/sidebar.css",
                // css genre
                "resources/css/admin/genre/daftar_genre.css",
                // css riwayat transaksi

                // css halaman admin


                // js anggota
                "resources/js/admin/anggota/daftar_anggota.js",
                // js buku
                "resources/js/admin/buku/halaman_buku.js",
                "resources/js/admin/buku/perbaikan_buku.js",
                // js dashboard
                // 'resources/js/admin/dashboard/dashboard_copy.js',
                "resources/js/admin/dashboard/dashboard.js",
                // js genre
                "resources/js/admin/genre/daftar_genre.js",
                // js navbar
                "resources/js/admin/navbar/navbar_copy.js",
                "resources/js/admin/navbar/navbar.js",
                // js riwayat transaksi
                // 'resources/js/admin/transaksi/riwayat_transaksi/halaman_riwayat_transaksi.js',
            ],
            refresh: true,
        }),
    ],
});
