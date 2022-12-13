<template>
    <div>
        <v-row>
            <v-col
                v-for="artista in items"
                :key="artista._id"
                cols="12"
                sm="6"
                md="4"
                xl="3"
            >
                <v-card
                    :color="setColor()"
                    theme="dark"
                    variant="flat"
                    class="card"
                >
                    <div>
                        <div class="text-center">
                            <v-avatar class="m-4 rounder-circle" size="180">
                                <v-img
                                    class=""
                                    :src="'/storage/' + artista.foto"
                                ></v-img>
                            </v-avatar>
                        </div>

                        <div>
                            <v-card-title class="text-h5">
                                {{ artista.nombre }}
                            </v-card-title>
                            <v-card-subtitle class="mb-2">
                                Artista
                            </v-card-subtitle>
                        </div>
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

<style lang="scss" scoped>
.card {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    transition: 0.3s;
    border-radius: 5px;
}
.card:hover {
    box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    opacity: 0.8;
    color: #e5ffff;
}
</style>
