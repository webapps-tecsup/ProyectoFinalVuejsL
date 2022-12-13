<template>
    <div>
        <v-app-bar color="primary" flat>
            <v-app-bar-nav-icon @click.stop="drawer = !drawer">
            </v-app-bar-nav-icon>
            <v-spacer></v-spacer>
            <v-icon icon="mdi-account"></v-icon>
            <small class="mr-16">{{ auth.user.name }}</small>
        </v-app-bar>
        <v-navigation-drawer v-model="drawer">
            <v-list>
                <v-list-item
                    v-for="item in auth.user.admin ? items : items1"
                    :to="item.ruta"
                >
                    <template v-slot:prepend>
                        <v-icon :icon="item.icon" color="primary"></v-icon>
                    </template>
                    {{ item.nombre }}
                </v-list-item>
            </v-list>
            <template v-slot:append>
                <div class="pa-2">
                    <v-btn color="error" variant="text" block @click="salir()">
                        Salir
                    </v-btn>
                </div>
            </template>
        </v-navigation-drawer>
    </div>
</template>
<script setup lang="ts">
import { ref } from "vue";
import { useAuthStore } from "../stores/auth";
import { useRouter } from "vue-router";
const auth = useAuthStore();
const router = useRouter();

const items = [
    { nombre: "Inicio", icon: "mdi-home", ruta: "/" },
    {
        nombre: "Generos",
        icon: "mdi-music",
        ruta: "/admin/generos",
    },

    {
        nombre: "Mi musica",
        icon: "mdi-music",
        ruta: "/admin/musicas",
    },
    {
        nombre: "Artistas",
        icon: "mdi-account-music",
        ruta: "/admin/artistas",
    },
    { nombre: "Albums", icon: "mdi-album", ruta: "/admin/albums" },
];
//Para el Publico
const items1 = [
    { nombre: "Inicio", icon: "mdi-home", ruta: "/" },

    {
        nombre: "Playlist",
        icon: "mdi-music",
        ruta: "/play-list",
    },
    {
        nombre: "Mi musica",
        icon: "mdi-music",
        ruta: "/musicas",
    },
    {
        nombre: "Artistas",
        icon: "mdi-account-music",
        ruta: "/artistas",
    },
    { nombre: "Albums", icon: "mdi-album", ruta: "/albums" },
];
const drawer = ref<boolean>(false);
function salir() {
    auth.salir();
    router.push("/login");
}
</script>
