<template>
    <v-dialog v-model="dialog" persistent location="center center">
        <template v-slot:activator="{ props }">
            <v-btn
                color="primary"
                variant="text"
                class="wi-mb-2"
                v-bind="props"
            >
                Agregar Musica
            </v-btn>
        </template>
        <v-card max-width="600" flat location="bottom center">
            <v-toolbar
                density="comfortable"
                :title="`${itemData.id ? 'Update' : 'Agregar'} Musica`"
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
                        label="Artista"
                        required
                        :rules="[isRequired]"
                    ></v-select>
                    <v-select
                        v-model="itemData.generoId"
                        :items="generos"
                        item-value="_id"
                        item-title="nombre"
                        label="Genero"
                        required
                        :rules="[isRequired]"
                    ></v-select>
                    <v-file-input
                        v-model="itemData.musica"
                        :multiple="false"
                        accept="audio/*"
                        label="Seleccione una musica"
                        required
                        :rules="[isRequired]"
                    ></v-file-input>
                    <v-file-input
                        v-model="itemData.foto"
                        :multiple="false"
                        accept="image/*"
                        prepend-icon="mdi-camera"
                        label="Seleccione una imagen"
                        required
                        :rules="[isRequired]"
                    ></v-file-input>

                    <div class="d-flex justify-end">
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
                            :disabled="
                                loading || !itemData.foto || !itemData.musica
                            "
                            color="primary"
                            :loading="loading"
                            variant="flat"
                            @click="saveItemFormData()"
                        >
                            Crear
                        </v-btn>
                    </div>
                </v-form>
            </v-card-text>
        </v-card>
    </v-dialog>

    <v-row>
        <v-col v-for="cancion in items" :key="cancion._id">
            <v-card :color="setColor()" theme="dark" variant="flat">
                <div class="d-flex flex-no-wrap justify-space-between">
                    <div>
                        <v-card-title class="text-h5">
                            {{ cancion.titulo }}
                        </v-card-title>

                        <v-card-subtitle>{{
                            cancion.artista?.nombre
                        }}</v-card-subtitle>

                        <v-card-actions>
                            <v-btn
                                class="ml-2"
                                icon="mdi-play"
                                variant="text"
                                @click="music.cancionActual = cancion"
                            ></v-btn>
                            <v-btn
                                color="error"
                                class="mr-4"
                                variant="text"
                                @click="deleteItem(cancion._id)"
                            >
                                <v-icon class="mr-1" icon="mdi-delete"></v-icon>
                            </v-btn>
                        </v-card-actions>
                    </div>

                    <v-avatar class="ma-3" size="125" rounded="0">
                        <v-img :src="'/storage/' + cancion.foto"></v-img>
                    </v-avatar>
                </div>
            </v-card>
        </v-col>
    </v-row>
</template>

<script setup lang="ts">
import { useMusicStore } from "../../stores/music";
import { useCrud } from "../../composables/crud";

const music = useMusicStore();
const {
    items,
    itemData,
    deleteItem,
    reset,
    saveItemFormData,
    valid,
    isRequired,
    form,
    loading,
    dialog,
    setColor,
} = useCrud("api/canciones");

const { items: artistas } = useCrud("api/artistas");

const { items: generos } = useCrud("api/generos");
</script>

<style lang="scss" scoped></style>
