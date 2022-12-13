import { createRouter, createWebHistory } from "vue-router";
import { useAuthStore } from "../stores/auth";
const HomeComponent = () => import("../pages/home.vue");
const LoginComponent = () => import("../pages/login.vue");
const ArtistaComponent = () => import("../pages/artista.vue");
const MusicaComponent = () => import("../pages/musica.vue");
const AlbumComponent = () => import("../pages/album.vue");
const AlbumDetComponent = () => import("../pages/albumDetalle.vue");
const PlayListComponent = () => import("../pages/playList.vue");
const PlayListDetComponent = () => import("../pages/playListDetalle.vue");
const WelcomeComponent = () => import("../pages/welcome.vue");
// paginas del admin

const AdminArtistaComponent = () => import("../pages/admin/artista.vue");
const AdminMusicaComponent = () => import("../pages/admin/musica.vue");
const AdminAlbumComponent = () => import("../pages/admin/album.vue");
const AdminAlbumDetComponent = () => import("../pages/admin/albumDetalle.vue");
const AdminGeneroComponent = () => import("../pages/admin/generos.vue");

const routes = [
    { path: "/", name: "welcome", component: WelcomeComponent },
    { path: "/musicas", name: "home", component: HomeComponent },
    { path: "/login", name: "login", component: LoginComponent },
    { path: "/artistas", name: "artistas", component: ArtistaComponent },
    { path: "/mis-musicas", name: "musicas", component: MusicaComponent },
    {
        path: "/albums",
        name: "albums",
        component: AlbumComponent,
    },
    {
        path: "/albums/:id",
        name: "AlbumDet",
        component: AlbumDetComponent,
    },

    { path: "/play-list", name: "playList", component: PlayListComponent },
    {
        path: "/play-list/:id",
        name: "playlistDet",
        component: PlayListDetComponent,
    },

    //Rutas del admin
    {
        path: "/admin/artistas",
        name: "admin-artistas",
        component: AdminArtistaComponent,
    },
    { path: "/admin/musicas", name: "musica", component: AdminMusicaComponent },
    { path: "/admin/generos", name: "genero", component: AdminGeneroComponent },

    {
        path: "/admin/albums",
        name: "admin-albums",
        component: AdminAlbumComponent,
    },
    {
        path: "/admin/albums/:id",
        name: "admin-AlbumDet",
        component: AdminAlbumDetComponent,
    },
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
});
router.beforeEach(async (to, from) => {
    const auth = useAuthStore();
    const isAuthenticated = await auth.info();
    if (!isAuthenticated && to.name !== "login" && to.name != "welcome") {
        return { name: "login" };
    }
});
export default router;
