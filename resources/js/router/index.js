import { createRouter, createWebHistory } from "vue-router";
const HomeComponent = () => import("../pages/home.vue");
const LoginComponent = () => import("../pages/login.vue");
const ArtistaComponent = () => import("../pages/artista.vue");
const MusicaComponent = () => import("../pages/musica.vue");
const AlbumComponent = () => import("../pages/album.vue");
const UsuarioComponent = () => import("../pages/usuario.vue");
const AlbumDetComponent = () => import("../pages/albumDetalle.vue");

// paginas del admin

const AdminArtistaComponent = () => import("../pages/admin/artista.vue");
const AdminMusicaComponent = () => import("../pages/admin/musica.vue");
const AdminUsuarioComponent = () => import("../pages/admin/usuario.vue");
const AdminAlbumComponent = () => import("../pages/admin/album.vue");
const AdminAlbumDetComponent = () => import("../pages/admin/albumDetalle.vue");
const AdminGeneroComponent = () => import("../pages/admin/generos.vue");

const routes = [
    { path: "/", name: "home", component: HomeComponent },
    { path: "/login", name: "login", component: LoginComponent },
    { path: "/artistas", name: "artistas", component: ArtistaComponent },
    { path: "/musicas", name: "musicas", component: MusicaComponent },
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

    { path: "/usuarios", name: "usuarios", component: UsuarioComponent },

    //Rutas del admin
    {
        path: "/admin/artistas",
        name: "admin-artistas",
        component: AdminArtistaComponent,
    },
    { path: "/admin/musicas", name: "musica", component: AdminMusicaComponent },
    { path: "/admin/generos", name: "genero", component: AdminGeneroComponent },

    {
        path: "/admin/usuarios",
        name: "admin-usuarios",
        component: AdminUsuarioComponent,
    },
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
export default router;