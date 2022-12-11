import { createApp } from "vue/dist/vue.esm-bundler";
import App from "./App.vue";
import RouterWeb from "./router/index";
import "@mdi/font/css/materialdesignicons.css";
import "vuetify/styles";
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";
import NavbarComponent from "@/components/Navbar.vue";
import { createPinia } from "pinia";
const app = createApp(App);
const pinia = createPinia();
const vuetify = createVuetify({
    components,
    directives,
    theme: {
        defaultTheme: "light",
        themes: {
            light: {
                dark: false,
                colors: {
                    background: "#e8eaf6",
                    surface: "#FFFFFF",
                    primary: "#03DAC6",
                    secondary: "#5e35b1",
                    error: "#ff1744",
                    info: "#2196F3",
                    success: "#4CAF50",
                    warning: "#FB8C00",
                },
            },
        },
    },
});

app.use(vuetify);
app.component("Navbar", NavbarComponent);
app.use(RouterWeb);
app.use(pinia);
app.mount("#app");
