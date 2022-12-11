import { defineStore } from "pinia";
import { ref } from "vue";
interface Musica {
    titulo?: string;
    ruta_cancion?: string;
}
export const useMusicStore = defineStore("music", () => {
    const cancionActual = ref<Musica>({});

    return {
        cancionActual,
    };
});
