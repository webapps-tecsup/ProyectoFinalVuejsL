<template>
    <div class="d-flex h-100 text-center text-white bg-dark">
        <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
            <header class="mb-auto">
                <div>
                    <h3 class="float-md-start mb-0">Grovemusic</h3>
                    <nav
                        class="nav nav-masthead justify-content-center float-md-end"
                    >
                        <router-link
                            v-if="auth.user._id"
                            to="/musicas"
                            class="nav-link active"
                            >Home</router-link
                        >
                        <router-link class="mr-16 nav-link" to="/mis-musicas">{{
                            auth.user.name
                        }}</router-link>

                        <router-link
                            v-if="!auth.user._id"
                            to="/login"
                            class="nav-link"
                            >Iniciar Sesion</router-link
                        >

                        <router-link
                            v-if="!auth.user._id"
                            to="/login"
                            class="nav-link"
                            >Registrarse</router-link
                        >
                    </nav>
                </div>
            </header>

            <main id="hero">
                <section class="container">
                    <video
                        class="fullscreen"
                        src="https://player.vimeo.com/external/454825064.hd.mp4?s=1592bf3ecf1847fa831986b637abd651661fc97c&profile_id=174"
                        playsinline
                        autoplay
                        muted
                        loop
                    ></video>
                    <div class="content">
                        <h1>Grovemusic</h1>
                        <p class="lead">
                            La mejor inspiracion en un solo lugar Grovemusic, tu
                            musica favorita
                        </p>
                        <p class="lead">
                            “Él tomó su dolor y lo convirtió en algo hermoso. En
                            algo con lo que la gente pueda conectarse. Y eso es
                            lo que hace la buena música.
                            <br />Te habla. Te cambia.” Hannah Harrington
                        </p>
                    </div>
                </section>
            </main>

            <footer class="mt-auto text-white-50">
                <p>
                    Grovemusic
                    <a href="https://getbootstrap.com/" class="text-white"
                        >Laravel</a
                    >, by
                    <a href="https://twitter.com/mdo" class="text-white"
                        >@TECSUP</a
                    >.
                </p>
            </footer>
        </div>
    </div>
</template>

<script setup lang="ts">
import { useAuthStore } from "../stores/auth";
const auth = useAuthStore();
</script>

<style lang="scss" scoped>
.bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
}

@media (min-width: 768px) {
    .bd-placeholder-img-lg {
        font-size: 3.5rem;
    }
}

/*
 * Globals
 */

/* Custom default button */
.btn-secondary,
.btn-secondary:hover,
.btn-secondary:focus {
    color: #333;
    text-shadow: none;
    /* Prevent inheritance from `body` */
}

/*
 * Base structure
 */
body {
    text-shadow: 0 0.05rem 0.1rem rgba(0, 0, 0, 0.5);
    box-shadow: inset 0 0 5rem white;
}

.cover-container {
    max-width: 100%;
    background: black;
}

/*
 * Header
 */

.nav-masthead .nav-link {
    padding: 0.25rem 0;
    font-weight: 700;
    color: white;

    border-bottom: 0.25rem;
}

.nav-masthead .nav-link + .nav-link {
    margin-left: 1rem;
}

/*-----------carrusel---------- */
video.fullscreen {
    position: absolute;
    z-index: 0;
    object-fit: cover;
    width: 100%;
    height: 100%;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.container {
    position: relative;
    display: grid;
    place-items: center;
    height: 80vh;
    width: 1000vh;
    margin: 0 auto;
    background: #ccc;
}

.content {
    z-index: 1;
}

body {
    height: 100vh;
    display: grid;
    place-items: center;
}

/**titulo */
h1 {
    font-size: 25vh;

    font-family: Vegur, "PT Sans", Verdana, sans-serif;
}

p.fant {
    font-family: new times roman;
}
</style>
