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
                    Agregar Genero
                </v-btn>
            </template>

            <v-card max-width="600" flat location="bottom center">
                <v-toolbar
                    density="comfortable"
                    :title="`${itemData.id ? 'Update' : 'Agregar'} Genero`"
                    color="primary"
                    flat
                ></v-toolbar>
                <v-card-text class="pa-4 mb-2">
                    <v-form v-model="valid" ref="form" lazy-validation>
                        <v-text-field
                            v-model="itemData.nombre"
                            label="Nombre"
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
                                :disabled="loading"
                                color="primary"
                                :loading="loading"
                                variant="flat"
                                @click="saveItem()"
                            >
                                Crear
                            </v-btn>
                        </div>
                    </v-form>
                </v-card-text>
            </v-card>
        </v-dialog>

        <v-row>
            <v-col v-for="genero in items" :key="genero._id">
                <v-card :color="setColor()" theme="dark" variant="flat">
                    <div class="d-flex flex-no-wrap justify-space-between">
                        <div>
                            <v-card-title class="text-h5">
                                {{ genero.nombre }}
                            </v-card-title>
                            <v-card-actions>
                                <v-btn
                                    color="error"
                                    class="mr-4"
                                    variant="text"
                                    @click="deleteItem(genero._id)"
                                >
                                    <v-icon
                                        class="mr-1"
                                        icon="mdi-delete"
                                    ></v-icon>
                                </v-btn>
                            </v-card-actions>
                        </div>
                    </div>
                </v-card>
            </v-col>
        </v-row>
    </div>
</template>

<script setup lang="ts">
import { useCrud } from "../../composables/crud";
const {
    items,
    itemData,
    dialog,
    valid,
    form,
    loading,
    saveItem,
    reset,
    deleteItem,
    isRequired,
    setColor,
} = useCrud("api/generos");
</script>

<style lang="scss" scoped></style>
