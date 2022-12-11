<template>
    <div>
        <v-row>
            <v-col
                cols="12"
                sm="6"
                md="3"
                xl="3"
                v-for="(item, index) in artistas"
                :key="index"
            >
                <v-card>
                    <v-img cover height="250" :src="item.image"></v-img>

                    <v-card-item>
                        <v-card-title>{{ item.name }}</v-card-title>

                        <v-card-subtitle>
                            <span class="mr-1">Local Favorite</span>

                            <v-icon
                                color="error"
                                icon="mdi-fire-circle"
                                size="small"
                            ></v-icon>
                        </v-card-subtitle>
                    </v-card-item>

                    <v-card-text>
                        <v-row aling="center" class="mx-0">
                            <v-rating
                                :model-value="4.5"
                                color="amber"
                                density="compact"
                                half-increments
                                readonly
                                size="small"
                            >
                            </v-rating>

                            <div class="text-grey ms-4">4.5 (413)</div>
                        </v-row>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </div>
</template>
<script>
export default {
    data: () => ({
        loading: false,
        selection: 1,
        artistas: [
            {
                name: "Olivia Rodrigo",
                image: "https://i.pinimg.com/564x/8a/38/ad/8a38ad716d3f9ba83c29481871a6c7a7.jpg",
            },
            {
                name: "Billie Eilish",
                image: "https://i.pinimg.com/564x/ed/04/ba/ed04bad2a89aeb6d3ad254b7f5ece1e3.jpg",
            },
            {
                name: "The Weeknd",
                image: "https://i.pinimg.com/564x/7e/f5/79/7ef579549eeee0d7b668f922dc2d1758.jpg",
            },
            {
                name: "Harry Styles",
                image: "https://i.pinimg.com/564x/c7/21/91/c721919f9e3e447ae92f540cec01f7a5.jpg",
            },
            {
                name: "Lil Peep",
                image: "https://i.pinimg.com/474x/cc/b5/4d/ccb54d16148b867e1356a9f22431a61c.jpg",
            },
            {
                name: "Sebastian Yatra",
                image: "https://i.pinimg.com/474x/97/c4/53/97c4539022263608b3a621a98a16a3d3.jpg",
            },
            {
                name: "Shawn Mendes",
                image: "https://i.pinimg.com/474x/56/d4/c4/56d4c42647a44ff8c788141b6181d13e.jpg",
            },
            {
                name: "Bruno Mars",
                image: "https://i.pinimg.com/474x/b6/6c/ff/b66cff3a4a342fe09acba76f97269a48.jpg",
            },
        ],
    }),

    methods: {
        reserve() {
            this.loading = true;

            setTimeout(() => (this.loading = false), 2000);
        },
    },
};
</script>
