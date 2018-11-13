<template>
    <v-container grid-list-md text-xs-center>
        <v-layout row wrap>
            <v-flex v-for='board in boards' :key='board.id' xs3>
                <router-link :to="{path:'/boards/:id',params:{id:board.id}}">
                    <v-card dark color="primary">
                        <v-card-text class="px-0">{{board.name}}</v-card-text>
                    </v-card>
                </router-link>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
        name: "Boards",
        data() {
            return {
                boards: null
            }
        },
        methods: {
            index() {
                axios.get(`/boards`)
                    .then(response => {
                        console.log(response.data)
                        this.boards = response.data.data
                    })
                    .catch(error => console.error(`Error: ${error}`))
            }
        },
        mounted() {
            this.index()
        }
    }
</script>

<style scoped>

</style>