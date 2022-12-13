<template>
    <div>
        <v-card variant="tonal">
            <v-row class="bg-black">
                <v-col cols="5">
                    <v-card-title class="text-white text-subtitle-2">
                        PLAYLIST
                    </v-card-title>
                    <v-card-title
                        class="title text-white text-center"
                        v-text="playList.titulo"
                    ></v-card-title>
                </v-col>
                <v-col cols="7">
                    <v-img
                        :src="'/storage/' + playList.foto"
                        class="align-end"
                        gradient="to bottom, rgba(0,0,4,.5), rgba(30,127,181,.5)"
                        height="400px"
                    >
                    </v-img>
                </v-col>
            </v-row>
        </v-card>
        <v-col cols="8">
            <v-list lines="two">
                <v-list-subheader inset>Canciones</v-list-subheader>
                <v-list-item
                    v-for="cancion in playList.canciones"
                    :key="cancion._id"
                    :title="cancion.titulo"
                >
                    <template v-slot:prepend>
                        <v-avatar rounded="2" color="grey">
                            <v-img
                                cover
                                height="250"
                                :src="'/storage/' + cancion.foto"
                                class="align-end"
                            >
                            </v-img>
                        </v-avatar>
                    </template>

                    <template v-slot:append>
                        <v-btn
                            color="grey-lighten-1"
                            icon="mdi-play-circle"
                            variant="text"
                            @click="music.cancionActual = cancion"
                        ></v-btn>
                        <v-btn
                            color="error"
                            class="mr-4"
                            variant="text"
                            @click="
                                eliminarCancionDePlayList(
                                    cancion._id,
                                    playList._id
                                )
                            "
                        >
                            <v-icon class="mr-1" icon="mdi-delete"></v-icon>
                        </v-btn>
                    </template>
                </v-list-item>
            </v-list>
        </v-col>
    </div>
</template>

<script setup lang="ts">
import { useRoute } from "vue-router";
import { useMusicStore } from "../stores/music";
import axios from "axios";
import { ref } from "vue";
import { useLocalStorage } from "@vueuse/core";

const playList = ref<any>({});
const route = useRoute();
const music = useMusicStore();
const token = useLocalStorage("token", "");
getCanciones();

async function getCanciones() {
    await axios
        .get(`/api/play-list/${route.params.id}`, {
            headers: { Authorization: "Bearer " + token.value },
        })
        .then((x) => {
            playList.value = x.data;
        })
        .catch(() => {});
}
async function eliminarCancionDePlayList(
    idCancion: string,
    idPlayList: string
) {
    await axios
        .post(
            `/api/remove_cancion_playlist`,
            { cancion_id: idCancion, playlist_id: idPlayList },
            {
                headers: { Authorization: "Bearer " + token.value },
            }
        )
        .then((x) => {
            getCanciones();
        })
        .catch(() => {});
}
</script>

<style lang="scss" scoped>
.title {
    padding-top: 140px;
    font-family: "Times New Roman", Times, serif;
    font-size: 40px;
}
</style>
