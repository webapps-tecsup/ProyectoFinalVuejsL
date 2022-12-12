import { defineStore } from "pinia";
import { ref } from "vue";
import axios from "axios";
import { useLocalStorage } from "@vueuse/core";

interface Auth {
    name?: string;
    email?: string;
    password?: string;
}

export const useAuthStore = defineStore("auth", () => {
    const step = ref<number>(1);
    const auth = ref<Auth>({});
    const user = ref<any>({});

    const emailRules = [
        (v) => !!v || "E-mail is requerido",
        (v) => /.+@.+\..+/.test(v) || "E-mail debe ser valido",
    ];
    const token = useLocalStorage("token", "");

    async function iniciarSesion() {
        await axios
            .post("/api/user/login", auth.value)
            .then((x) => {
                token.value = x.data.token;
            })
            .catch(() => {});
    }
    async function registrar() {
        await axios
            .post("/api/user/register", auth.value)
            .then((x) => {
                console.log(x.data);
            })
            .catch(() => {});
    }
    function salir() {
        token.value = "";
    }

    async function info() {
        return await axios
            .get("/api/user/info", {
                headers: { Authorization: "Bearer " + token.value },
            })
            .then((x) => {
                user.value = x.data;
                return true;
            })
            .catch(() => {
                return false;
            });
    }
    async function sanctum() {
        await axios
            .get("/sanctum/csrf-cookie")
            .then((x) => {})
            .catch(() => {});
    }

    return {
        auth,
        step,
        user,
        salir,
        iniciarSesion,
        info,
        sanctum,
        registrar,
    };
});
