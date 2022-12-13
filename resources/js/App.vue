<template>
    <v-app class="app">
        <Navbar v-if="$route.path != '/login' && $route.path != '/'"></Navbar>
        <v-main v-if="$route.path === '/'"> <router-view></router-view></v-main>
        <v-main v-else>
            <v-container>
                <router-view></router-view>
            </v-container>
        </v-main>
        <div class="playing bg-primary" v-if="music.cancionActual.ruta_cancion">
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
                class="mr-4"
                variant="text"
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
.playing {
    display: flex;
    justify-content: center;
    align-items: center;
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    border-radius: 30px 30px 0 0;
}
.app {
    position: relative;
    height: 100vh !important;
    overflow-y: auto;
}
.player {
    background-color: transparent;
}
audio::-webkit-media-controls-play-button,
audio::-webkit-media-controls-panel {
    background-color: #03dac6;
    color: white !important;
    border: none;
}
</style>
