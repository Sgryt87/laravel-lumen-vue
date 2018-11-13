<template>
    <div class="text-md-center">
        <h2>Register</h2>
        <v-layout>
            <v-flex xs6 offset-xs3>
                <v-card>
                    <v-card-text>
                        <form @keyup.enter="_register">
                        <v-text-field
                                v-model="register.username"
                                label="Username*"
                                required
                        >
                        </v-text-field>

                        <v-text-field
                                v-model="register.email"
                                label="Email*"
                                required
                        >
                        </v-text-field>

                        <v-text-field
                                v-model="register.password"
                                label="Password*"
                                type="password"
                                required
                        >
                        </v-text-field>
                        </form>
                    </v-card-text>

                    <v-btn class="mb-3" success @click='_register'>Register</v-btn>

                </v-card>
            </v-flex>

        </v-layout>

    </div>
</template>


<script>
    export default {
        name: "Register",
        data() {
            return {
                register: {
                    username: "",
                    email: "",
                    password: ""
                }
            }
        },
        methods: {
            _register() {
                axios.post('register', this.register)
                    .then(response => {
                        console.log(response.data.data)
                        localStorage.setItem('token', response.data.data.api_token)
                        this.$router.push('/')
                    })
                    .catch(error => console.log(`Error: ${error}`))
            }
        }
    }
</script>
