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
                    Agregar PlayList
                </v-btn>
            </template>

            <v-card max-width="600" flat location="bottom center">
                <v-toolbar
                    density="comfortable"
                    :title="`${
                        itemData.id ? 'Actualizar' : 'Agregar'
                    } Playlist`"
                    color="primary"
                    flat
                ></v-toolbar>
                <v-card-text class="pa-4 mb-2">
                    <v-form v-model="valid" ref="form" lazy-validation>
                        <v-file-input
                            v-model="itemData.foto"
                            :multiple="false"
                            accept="image/*"
                            required
                            prepend-icon="mdi-camera"
                            :rules="[isRequired]"
                            label="Seleccione una imagen"
                        ></v-file-input>
                        <v-text-field
                            v-model="itemData.titulo"
                            label="Titulo"
                            required
                            :rules="[isRequired]"
                        ></v-text-field>

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
            <v-col v-for="playList in items" :key="playList._id">
                <v-card :color="setColor()" theme="dark" variant="flat">
                    <div class="d-flex flex-no-wrap justify-space-between">
                        <div>
                            <v-card-title class="text-h5">
                                {{ playList.titulo }}
                            </v-card-title>

                            <v-card-subtitle>
                                <v-icon class="mr-1" icon="mdi-music"></v-icon>
                                {{ playList.canciones?.length }}
                                canciones</v-card-subtitle
                            >
                            <v-card-actions>
                                <v-btn
                                    class="ml-2"
                                    icon="mdi-play"
                                    variant="text"
                                    :to="'/play-list/' + playList._id"
                                ></v-btn>
                                <v-btn
                                    class="mr-4"
                                    variant="text"
                                    @click="deleteItem(playList._id)"
                                >
                                    <v-icon
                                        class="mr-1"
                                        icon="mdi-close"
                                    ></v-icon>
                                </v-btn>
                            </v-card-actions>
                        </div>

                        <v-avatar class="ma-3" size="125" rounded="0">
                            <v-img :src="'/storage/' + playList.foto"></v-img>
                        </v-avatar>
                    </div>
                </v-card>
            </v-col>
        </v-row>
    </div>
</template>
<script setup lang="ts">
import { useCrud } from "../composables/crud";

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
} = useCrud("api/play-list");
</script>

<style></style>
