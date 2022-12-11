<template>
    <v-app>
        <Navbar v-if="$route.path != '/login'"></Navbar>
        <v-main>
            <v-container>
                <router-view></router-view>
            </v-container>
        </v-main>
        <div v-if="music.cancionActual.ruta_cancion">
            <audio
                controls
                autoplay
                style="vertical-align: middle"
                :src="'/storage/' + music.cancionActual.ruta_cancion"
                type="audio/mp3"
                controlslist="nodownload"
            ></audio>
            <v-btn
                icon
                color="error"
                class="mr-4"
                @click="music.cancionActual = {}"
            >
                <v-icon class="mr-1" icon="mdi-close"></v-icon>
            </v-btn>
        </div>
    </v-app>
</template>
<script setup lang="ts">
import { useMusicStore } from "./stores/music";
const music = useMusicStore();
</script>
<style>
@import url("https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap");

#app {
    font-family: "Roboto", sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    color: #2c3e50;
}
</style>
