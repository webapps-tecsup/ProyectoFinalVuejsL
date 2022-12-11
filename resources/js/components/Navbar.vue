<template>
    <div>
        <v-app-bar color="primary" flat>
            <v-app-bar-nav-icon @click.stop="drawer = !drawer">
            </v-app-bar-nav-icon>
        </v-app-bar>
        <v-navigation-drawer v-model="drawer">
            <v-list>
                <v-list-item v-for="item in items" :to="item.ruta">
                    <template v-slot:prepend>
                        <v-icon :icon="item.icon" color="primary"></v-icon>
                    </template>
                    {{ item.nombre }}
                </v-list-item>
            </v-list>
            <template v-slot:append>
                <div class="pa-2">
                    <v-btn color="error" variant="text" block to="/login">
                        Salir
                    </v-btn>
                </div>
            </template>
        </v-navigation-drawer>
    </div>
</template>
<script>
export default {
    data() {
        return {
            items: [
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
            ],
            drawer: null,
        };
    },
};
</script>
