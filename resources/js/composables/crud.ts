import { ref, onMounted } from "vue";
import axios from "axios";
import { useLocalStorage } from "@vueuse/core";

export const useCrud = (path: string, p = {}) => {
    const itemData = ref<any>({});
    const loading = ref<boolean>(false);
    const dialog = ref<boolean>(false);
    const valid = ref<boolean>(true);
    const form = ref<any>(null);
    const items = ref<any>([]);
    const params = ref<any>({ ...p });
    const token = useLocalStorage("token", "");
    const isRequired = (v: any) => !!v || "Campo Requerido";
    onMounted(() => {
        getItems();
    });
    const colores = [
        "#ce93d8",
        "#4fc3f7",
        "#4db6ac",
        "#f48fb1",
        "#9c64a6",
        "#4dd0e1",
        "#ef5350",
        "#f06292",
        "#ba68c8",
        "#9575cd",
        "#7986cb",
        "#4db6ac",
        "#81c784",
        "#aed581",
        "#dce775",
        "#fff176",
        "#ffd54f",
        "#ff8a65",
        "#a1887f",
    ];
    async function getItems() {
        await axios
            .get(`/${path}`, {
                headers: { Authorization: "Bearer " + token.value },
                params: params.value,
            })
            .then((x) => {
                items.value = x.data;
            })
            .catch(() => {});
    }
    async function deleteItem(id: string) {
        loading.value = true;
        await axios
            .delete(`/${path}/${id}`, {
                headers: { Authorization: "Bearer " + token.value },
            })
            .then((x) => {
                getItems();
            })
            .catch(() => {});
        loading.value = false;
    }
    async function saveItemFormData() {
        if (!(await form.value.validate()).valid) return;
        const bodyFormData = new FormData();
        for (const key in { ...itemData.value }) {
            if (Array.isArray(itemData.value[key])) {
                bodyFormData.append(
                    key,
                    key === "foto" || key === "musica"
                        ? itemData.value[key][0]
                        : JSON.stringify(itemData.value[key])
                );
            } else {
                bodyFormData.append(key, itemData.value[key]);
            }
        }
        await axios({
            method: "post",
            url: `/${path}`,
            data: bodyFormData,
            headers: {
                "Content-Type": "multipart/form-data",
                Authorization: "Bearer " + token.value,
            },
        })
            .then((response) => {
                getItems();
                console.log(response);
                reset();
            })
            .catch((response) => {
                console.log(response);
            });
    }
    async function saveItem() {
        if (!(await form.value.validate()).valid) return;
        loading.value = true;

        if (itemData.value._id) {
            await axios
                .put(`/${path}/${itemData.value._id}`, itemData.value, {
                    headers: { Authorization: "Bearer " + token.value },
                })
                .then((x) => {
                    reset();
                    getItems();
                })
                .catch(() => {});
        } else {
            await axios
                .post(`/${path}`, itemData.value, {
                    headers: { Authorization: "Bearer " + token.value },
                })
                .then((x) => {
                    reset();
                    getItems();
                })
                .catch(() => {});
        }

        loading.value = false;
    }

    function reset() {
        form.value?.reset();
        itemData.value = {};
        dialog.value = false;
    }

    function setColor() {
        return colores[Math.floor(Math.random() * (colores.length - 1)) + 0];
    }
    return {
        saveItemFormData,
        getItems,
        token,
        items,
        loading,
        dialog,
        valid,
        form,
        itemData,
        isRequired,
        params,
        saveItem,
        deleteItem,
        reset,
        setColor,
    };
};
