<template>
    <div>
        <v-card variant="tonal">
            <v-row class="bg-black">
                <v-col cols="7">
                    <v-img
                        :src="'/storage/' + album.foto"
                        class="align-end"
                        gradient="to bottom, rgba(0,0,4,.5), rgba(107,7,172,.5)"
                        height="400px"
                    >
                    </v-img>
                </v-col>
                <v-col cols="5" class="text">
                    <div>
                        <v-card-title
                            class="text-h3 text-white text-center m-5"
                            v-text="album.titulo"
                        ></v-card-title>
                        <div class="d-flex text-white text-s justify-center">
                            <v-avatar size="x-small" class="">
                                <v-img
                                    cover
                                    height="250"
                                    :src="'/storage/' + album.artista?.foto"
                                >
                                </v-img>
                            </v-avatar>
                            <v-card-subtitle
                                v-text="album.artista?.nombre"
                            ></v-card-subtitle>
                            <v-card-subtitle>
                                <v-icon icon="mdi-music-box-multiple"></v-icon>
                                {{ album.canciones?.length }}
                                canciones</v-card-subtitle
                            >
                        </div>
                    </div>
                </v-col>
            </v-row>
        </v-card>

        <v-col cols="8">
            <v-list lines="two">
                <v-list-subheader inset>Canciones</v-list-subheader>
                <v-list-item
                    v-for="cancion in album.canciones"
                    :key="cancion._id"
                    :title="cancion.titulo"
                >
                    <!-- :subtitle="cancion.subtitle" -->
                    <template v-slot:prepend>
                        <v-avatar color="grey" rounded="2">
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
                    </template>
                </v-list-item>
            </v-list>
        </v-col>
    </div>
</template>

<script setup lang="ts">
import { useRoute } from "vue-router";
import { useMusicStore } from "../../stores/music";
import axios from "axios";
import { ref } from "vue";
import { useLocalStorage } from "@vueuse/core";
const album = ref<any>({});
const route = useRoute();
const music = useMusicStore();
const token = useLocalStorage("token", "");
getCanciones();

async function getCanciones() {
    await axios
        .get(`/api/albums/${route.params.id}`, {
            headers: { Authorization: "Bearer " + token.value },
        })
        .then((x) => {
            album.value = x.data;
        })
        .catch(() => {});
}
</script>

<style lang="scss" scoped>
.text {
    padding-top: 130px;
}
.text-s {
    padding-top: 90px;
}
</style>
