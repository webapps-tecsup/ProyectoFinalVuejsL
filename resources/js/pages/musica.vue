<template>
    <v-row>
        <v-col v-for="cancion in items" :key="cancion._id">
            <v-card :color="setColor()" theme="dark" variant="flat">
                <div class="d-flex flex-no-wrap justify-space-between">
                    <div>
                        <v-card-title class="text-h5">
                            {{ cancion.cancion.titulo }}
                        </v-card-title>

                        <v-card-subtitle>{{
                            cancion.cancion.artista?.nombre
                        }}</v-card-subtitle>

                        <v-card-actions>
                            <v-btn
                                class="ml-2"
                                icon="mdi-play"
                                variant="text"
                                @click="music.cancionActual = cancion.cancion"
                            ></v-btn>
                            <v-menu>
                                <template v-slot:activator="{ props }">
                                    <v-btn
                                        icon="mdi-playlist-plus"
                                        v-bind="props"
                                    ></v-btn>
                                </template>

                                <v-list>
                                    <v-list-item
                                        v-for="(item, i) in playList"
                                        :key="item._id"
                                        @click="
                                            agregarAplayList(
                                                cancion._id,
                                                item._id
                                            )
                                        "
                                    >
                                        <v-list-item-title>{{
                                            item.titulo
                                        }}</v-list-item-title>
                                    </v-list-item>
                                </v-list>
                            </v-menu>

                            <v-btn
                                class="ml-2"
                                icon="mdi-heart"
                                variant="text"
                                @click="removeReaccion(cancion.cancion._id)"
                            >
                            </v-btn>
                            <small>{{
                                cancion.cancion?.reacciones?.length
                            }}</small>
                        </v-card-actions>
                    </div>

                    <v-avatar class="ma-3" size="125" rounded="0">
                        <v-img
                            :src="'/storage/' + cancion.cancion.foto"
                        ></v-img>
                    </v-avatar>
                </div>
            </v-card>
        </v-col>
    </v-row>
</template>

<script setup lang="ts">
import { useMusicStore } from "../stores/music";
import { useAuthStore } from "../stores/auth";
import { useCrud } from "../composables/crud";
import axios from "axios";

const music = useMusicStore();
const auth = useAuthStore();

const { items, setColor, getItems, params } = useCrud("api/mis-canciones");

const { items: playList, token } = useCrud("api/play-list");

async function agregarAplayList(idCancion: string, idPlayList: string) {
    await axios
        .post(
            `/api/add_cancion_playlist`,
            { cancion_id: idCancion, playlist_id: idPlayList },
            {
                headers: { Authorization: "Bearer " + token.value },
            }
        )
        .then((x) => {})
        .catch(() => {});
}
async function agregarReaccion(idCancion: string) {
    await axios
        .post(
            `/api/reacciones`,
            { cancion_id: idCancion },
            {
                headers: { Authorization: "Bearer " + token.value },
            }
        )
        .then((x) => {
            getItems();
        })
        .catch(() => {});
}
async function removeReaccion(idCancion: string) {
    await axios
        .delete(`/api/reacciones/${idCancion}`, {
            headers: { Authorization: "Bearer " + token.value },
        })
        .then((x) => {
            getItems();
        })
        .catch(() => {});
}
function checkReaccion(reacciones: any[]) {
    const reaccion = reacciones.find((r) => r.user_id === auth.user._id);

    return reaccion !== undefined;
}
</script>

<style lang="scss" scoped></style>
