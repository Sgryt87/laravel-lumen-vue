<template>
    <div class="text-md-center">
        <h2>Login</h2>
        <v-layout>
            <v-flex xs6 offset-xs3>
                <v-card>
                    <v-card-text>
                        <form @keyup.enter="_login">
                            <v-text-field
                                    v-model="login.email"
                                    label="Email"
                                    required
                            >
                            </v-text-field>

                            <v-text-field
                                    v-model="login.password"
                                    label="Password"
                                    type="password"
                                    required
                            >
                            </v-text-field>
                        </form>
                    </v-card-text>
                    <v-btn class="mb-3" success @click="_login">Login</v-btn>
                </v-card>
            </v-flex>

        </v-layout>

    </div>
</template>

<script>
    export default {
        name: "Login",
        data() {
            return {
                login: {
                    email: "",
                    password: ""
                }
            }
        },
        methods: {
            _login() {
                axios.post('/login',this.login)
                    .then(response => {
                        console.log(response.data.message)
                        localStorage.setItem('token', response.data.data.api_token)
                        this.$router.push('/')
                    })
                    .catch(error => console.error(`Error ${error}`))
            }
        }
    }
</script>

<style scoped>

</style>