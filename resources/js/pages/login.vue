<template>
    <div class="bg-white sm:bg-gray-100 h-full flex justify-center">
        <div class="container mt-2 sm:mt-10 flex flex-col items-center">
            <h1 class="text-3xl text-blue-700 font-bold mb-10 pt-8 sm:pt-0">
                <a href="/">MiniBlog</a>
            </h1>
            <div class="w-full sm:shadow-xl sm:bg-white sm:py-8 sm:px-12">
                <div class="w-full text-center text-gray-600 font-bold mb-9">Log in to MiniBlog</div>
                <form @submit.prevent="login">
                    <form-input v-model="email" placeholder="Enter email" type="text" :errors="errors && errors.email"/>
                    <form-input v-model="password" placeholder="Enter password" type="password" :errors="errors && errors.password"/>
                    <div class="w-full mb-8">
                        <button type="submit" class="rounded px-4 py-2 text-sm bg-green-500 font-bold outline-none focus:outline-none hover:opacity-75 w-full text-white disabled:opacity-25">Login</button>
                    </div>
                    <div class="w-full mb-4">
                        <div v-if="errors && errors.length > 0 && typeof errors === 'string'" class="flex flex-column text-sm text-red-400">
                            <span>{{ errors }}</span>
                        </div>
                    </div>
                </form>
                <div class="bg-gray-300 h-px w-full mb-6"></div>
                <div class="text-center text-sm">
                    <router-link to="/register" class="text-blue-500 hover:underline">Register for an account</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {errorsHandler} from "../utils";

export default {
    name: "login",
    data() {
        return {
            email: null,
            password: null,
            errors: null
        }
    },
    methods: {
        async login() {
            this.errors = []

            let formData = new FormData();
            formData.append('email', this.email)
            formData.append('password', this.password)

            await axios.post('login', formData)
                .then(() => {
                    this.$store.dispatch('fetchCurrentUser')
                    window.location.replace('/');
                })
                .catch(error => {
                    this.errors = errorsHandler(error)
                })
        }
    }
}
</script>

<style scoped>
.container {
    width: 300px;
    max-width: 300px;
}

@media (min-width: 640px) {
    .container {
        width: 400px;
        max-width: 400px;
    }
}
</style>
