<template>
    <div>
        <v-dialog v-model="dialog" persistent location="center center">
            <template v-slot:activator="{ props }">
                <v-btn
                    color="primary"
                    variant="text"
                    class="wi-mb-2"
                    v-bind="props"
                >
                    Agregar Album
                </v-btn>
            </template>

            <v-card max-width="600" flat location="bottom center">
                <v-toolbar
                    density="comfortable"
                    :title="`${itemData.id ? 'Update' : 'Agregar'} Album`"
                    color="primary"
                    flat
                ></v-toolbar>
                <v-card-text class="pa-4 mb-2">
                    <v-form v-model="valid" ref="form" lazy-validation>
                        <v-text-field
                            v-model="itemData.titulo"
                            label="Titulo"
                            required
                            :rules="[isRequired]"
                        ></v-text-field>
                        <v-select
                            v-model="itemData.artistaId"
                            :items="artistas"
                            item-value="_id"
                            item-title="nombre"
                            required
                            :rules="[isRequired]"
                            @update:model-value="getCanciones()"
                        ></v-select>
                        <v-select
                            v-model="itemData.canciones"
                            :items="canciones"
                            multiple
                            item-value="_id"
                            item-title="titulo"
                            required
                            :rules="[isRequired]"
                            return-object
                        ></v-select>
                        <v-file-input
                            v-model="itemData.foto"
                            :multiple="false"
                            accept="image/*"
                            required
                            prepend-icon="mdi-camera"
                            :rules="[isRequired]"
                            label="Seleccione una imagen"
                        ></v-file-input>

                        <div class="d-flex justify-end" cols="12">
                            <v-spacer></v-spacer>
                            <v-btn
                                class="mr-2"
                                color="secondary"
                                variant="text"
                                @click="
                                    dialog = false;
                                    reset();
                                "
                            >
                                Cancelar
                            </v-btn>
                            <v-btn
                                class="mr-4"
                                :disabled="loading || !itemData.foto"
                                color="primary"
                                :loading="loading"
                                variant="flat"
                                @click="saveItemFormData()"
                            >
                                Crear
                            </v-btn>
                        </div>
                    </v-form></v-card-text
                >
            </v-card>
        </v-dialog>

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
                                    :to="'/album/' + album._id"
                                ></v-btn>
                                <v-btn
                                    color="error"
                                    class="mr-4"
                                    variant="text"
                                    @click="deleteItem(album._id)"
                                >
                                    <v-icon
                                        class="mr-1"
                                        icon="mdi-delete"
                                    ></v-icon>
                                </v-btn>
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
    reset,
    deleteItem,
    saveItemFormData,
    isRequired,
    form,
    dialog,
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
