<template>
    <v-container>
        <v-row aling="center" justify="center">
            <v-col cols="12" sm="12">
                <v-card class="elevation-6 mt-16">
                    <v-window v-model="auth.step">
                        <v-window-item :value="1">
                            <v-row>
                                <v-col cols="12" md="6">
                                    <v-card-text class="mt-12">
                                        <h4 class="text-center">
                                            Inicie sesión en su cuenta
                                        </h4>
                                        <p class="text-center text-grey">
                                            Inicia sesión en tu cuenta para
                                            poder continuar
                                        </p>
                                        <v-row aling="center" justify="center">
                                            <v-col cols="12" sm="10">
                                                <v-text-field
                                                    v-model="auth.auth.email"
                                                    label="E-mail"
                                                    color="blue"
                                                    required
                                                ></v-text-field>
                                                <v-text-field
                                                    label="Password"
                                                    v-model="auth.auth.password"
                                                    outlined
                                                    dense
                                                    color="blue"
                                                    type="password"
                                                />
                                                <v-row>
                                                    <v-col cols="12" sm="6">
                                                        <v-checkbox
                                                            hide-details
                                                            label="Recordarme"
                                                            class=""
                                                            color="blue"
                                                        ></v-checkbox>
                                                    </v-col>
                                                    <v-col
                                                        cols="12"
                                                        sm="6"
                                                        class="d-flex align-center"
                                                        type=""
                                                    >
                                                        <small class="text-blue"
                                                            ><a href=""
                                                                >¿Olvidaste tu
                                                                contraseña?</a
                                                            >
                                                        </small>
                                                    </v-col>
                                                </v-row>
                                                <v-btn
                                                    color="blue"
                                                    dark
                                                    block
                                                    tile
                                                    @click="login()"
                                                    >Iniciar Sesion</v-btn
                                                >
                                                <h6
                                                    class="text-center grey--text mt-4 mb-3"
                                                >
                                                    Iniciar sesión con
                                                </h6>
                                                <div
                                                    class="d-flex justify-space-between align-center mx-10 mb-16"
                                                >
                                                    <v-btn color="white">
                                                        <v-icon color="red"
                                                            >mdi-google</v-icon
                                                        >
                                                    </v-btn>
                                                    <v-btn color="white">
                                                        <v-icon
                                                            color="blue lighten-3"
                                                            >mdi-facebook</v-icon
                                                        >
                                                    </v-btn>
                                                    <v-btn color="white">
                                                        <v-icon
                                                            color="light-blue lighten-3"
                                                            >mdi-twitter</v-icon
                                                        >
                                                    </v-btn>
                                                </div>
                                            </v-col>
                                        </v-row>
                                    </v-card-text>
                                </v-col>
                                <v-col
                                    cols="12"
                                    md="6"
                                    class="blue rounded-bl-xl"
                                >
                                    <div class="register">
                                        <v-card-text>
                                            <h3 class="text-center">
                                                ¿Aún no tienes una cuenta?
                                            </h3>
                                            <p class="text-center">
                                                Vamos a prepararlo todo para que
                                                pueda comenzar a crear su cuenta
                                            </p>
                                        </v-card-text>
                                        <div class="text-center">
                                            <v-btn
                                                color="indigo"
                                                @click="auth.step++"
                                                >Registrarse</v-btn
                                            >
                                        </div>
                                    </div>
                                </v-col>
                            </v-row>
                        </v-window-item>
                        <v-window-item :value="2">
                            <v-row>
                                <v-col cols="12" md="5" class="rounded-br-xl">
                                    <div class="register">
                                        <v-card-text class="white--text">
                                            <h4 class="text-center">
                                                ¿Ya se encuentra registrado?
                                            </h4>
                                            <p class="text-center">
                                                Inicia sesión en tu cuenta para
                                                que puedas continuar
                                            </p>
                                        </v-card-text>
                                        <div class="text-center">
                                            <v-btn
                                                tile
                                                outlined
                                                dark
                                                @click="auth.step--"
                                                color="indigo"
                                                >Iniciar Sesion</v-btn
                                            >
                                        </div>
                                    </div>
                                </v-col>

                                <v-col cols="12" md="7">
                                    <v-card-text class="mt-12">
                                        <h4 class="text-center">
                                            Regístrese para obtener una cuenta
                                        </h4>
                                        <p class="text-center text-grey">
                                            Vamos a prepararlo todo para que
                                            pueda comenzar a crear su cuenta
                                        </p>
                                        <v-row aling="center" justify="center">
                                            <v-col cols="12" sm="8">
                                                <v-row>
                                                    <v-col cols="12" sm="12">
                                                        <v-text-field
                                                            v-model="
                                                                auth.auth.name
                                                            "
                                                            label="Nombre"
                                                            outlined
                                                            dense
                                                            color="pink"
                                                            class="mt-4"
                                                        />
                                                    </v-col>
                                                </v-row>
                                                <v-text-field
                                                    v-model="auth.auth.email"
                                                    label="E-mail"
                                                    color="pink"
                                                    required
                                                ></v-text-field>
                                                <v-text-field
                                                    v-model="auth.auth.password"
                                                    label="Password"
                                                    outlined
                                                    dense
                                                    color="pink"
                                                    type="password"
                                                />

                                                <v-btn
                                                    color="pink"
                                                    @click="auth.registrar()"
                                                    >Registrarse</v-btn
                                                >

                                                <h6
                                                    class="text-center grey--text mt-4 mb-3"
                                                >
                                                    Registrarse con
                                                </h6>
                                                <div
                                                    class="d-flex justify-space-between align-center mx-10 mb-11"
                                                >
                                                    <v-btn color="white">
                                                        <v-icon color="red"
                                                            >mdi-google</v-icon
                                                        >
                                                    </v-btn>
                                                    <v-btn color="white">
                                                        <v-icon color="blue"
                                                            >mdi-facebook</v-icon
                                                        >
                                                    </v-btn>
                                                    <v-btn color="white">
                                                        <v-icon
                                                            color="light-blue lighten-3"
                                                            >mdi-twitter</v-icon
                                                        >
                                                    </v-btn>
                                                </div>
                                            </v-col>
                                        </v-row>
                                    </v-card-text>
                                </v-col>
                            </v-row>
                        </v-window-item>
                    </v-window>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script setup lang="ts">
import { onMounted } from "vue";
import { useAuthStore } from "../stores/auth";
import { useRouter } from "vue-router";
const auth = useAuthStore();
const router = useRouter();
onMounted(() => {
    auth.sanctum();
});
async function login() {
    await auth.iniciarSesion();
    router.push("/musicas");
}
</script>
<style scoped>
.register {
    text-align: center;
    padding: 180px 0;
}
</style>
