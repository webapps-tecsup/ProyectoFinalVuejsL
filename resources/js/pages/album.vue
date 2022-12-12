<template>
    <div>
        <p v-if="loading">Loading...</p>
        <v-row>
            <v-col v-for="album in items" :key="album._id">
                <v-card :color="setColor()" theme="dark" variant="flat">
                    <div class="d-flex flex-no-wrap justify-space-between">
                        <div>
                            <v-card-title class="text-h5">
                                {{ album.titulo }}
                            </v-card-title>

                            <v-card-subtitle>{{
                                album.artista?.nombre
                            }}</v-card-subtitle>
                            <v-card-subtitle>
                                <v-icon class="mr-1" icon="mdi-music"></v-icon>
                                {{ album.canciones.length }}
                                canciones</v-card-subtitle
                            >
                            <v-card-actions>
                                <v-btn
                                    class="ml-2"
                                    icon="mdi-play"
                                    variant="text"
                                    :to="'/admin/albums/' + album._id"
                                ></v-btn>
                            </v-card-actions>
                        </div>
                        <v-avatar class="ma-3" size="125" rounded="0">
                            <v-img :src="'/storage/' + album.foto"></v-img>
                        </v-avatar>
                    </div>
                </v-card>
            </v-col>
        </v-row>
    </div>
</template>
<script setup lang="ts">
import { useCrud } from "../composables/crud";
import { ref } from "vue";
import axios from "axios";

const {
    items,
    itemData,
    loading,
    valid,
    token,
    form,
    dialog,
    reset,
    deleteItem,
    saveItemFormData,
    isRequired,
    setColor,
} = useCrud("api/albums");
const { items: artistas } = useCrud("api/artistas");
const canciones = ref([]);

async function getCanciones() {
    await axios
        .get(`/api/canciones_por_artista/${itemData.value.artistaId}`, {
            headers: { Authorization: "Bearer " + token.value },
        })
        .then((x) => {
            canciones.value = x.data;
        })
        .catch(() => {});
}
</script>

<style></style>
