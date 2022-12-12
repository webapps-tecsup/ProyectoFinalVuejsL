<template>
    <div>
        <v-row>
            <v-col v-for="artista in items" :key="artista._id">
                <v-card :color="setColor()" theme="dark" variant="flat">
                    <div class="d-flex flex-no-wrap justify-space-between">
                        <div>
                            <v-card-title class="text-h5">
                                {{ artista.nombre }}
                            </v-card-title>
                        </div>
                        <v-avatar class="ma-3" size="125" rounded="0">
                            <v-img :src="'/storage/' + artista.foto"></v-img>
                        </v-avatar>
                    </div>
                </v-card>
            </v-col>
        </v-row>
    </div>
</template>

<script setup lang="ts">
import { useCrud } from "../composables/crud";
const { items, setColor } = useCrud("api/artistas");
</script>

<style lang="scss" scoped></style>
