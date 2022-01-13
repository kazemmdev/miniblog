<template>
    <div class="bg-white sm:bg-gray-100 h-full flex justify-center">
        <div class="container mt-2 sm:mt-10 flex flex-col items-center">
            <h1 class="text-3xl text-blue-700 font-bold mb-10 pt-8 sm:pt-0">MiniBlog</h1>
            <div class="w-full sm:shadow-xl sm:bg-white sm:py-8 sm:px-12">
                <div class="w-full text-center text-gray-600 font-bold mb-9">Register for your account</div>
                <form @submit.prevent="register">
                    <form-input v-model="name" placeholder="Enter full name" type="text" :errors="errors && errors.name"/>
                    <form-input v-model="email" placeholder="Enter email" type="text" :errors="errors && errors.email"/>
                    <form-input v-model="password" placeholder="Enter password" type="password" :errors="errors && errors.password"/>
                    <form-input v-model="password_confirmation" placeholder="Enter password confirmation" type="password" :errors="errors && errors.password_confirmation"/>
                    <div class="w-full mb-8">
                        <button type="submit" class="rounded px-4 py-2 text-sm bg-blue-700 font-bold outline-none focus:outline-none hover:opacity-75 w-full text-white disabled:opacity-25">Register</button>
                    </div>
                    <div class="w-full mb-4">
                        <div v-if="errors && errors.length > 0 && typeof errors === 'string'" class="flex flex-column text-sm text-red-400">
                            <span>{{ errors }}</span>
                        </div>
                    </div>
                </form>
                <div class="bg-gray-300 h-px w-full mb-6"></div>
                <div class="text-center text-sm">
                    <router-link to="/login" class="text-blue-500 hover:underline">Already have an account? Log in</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {errorsHandler} from "../utils";
import FormInput from "../components/FormInput";

export default {
    name: "register",
    components: {FormInput},
    data() {
        return {
            name: null,
            email: null,
            password: null,
            password_confirmation: null,
            errors: null
        }
    },
    methods: {
        async register() {
            this.errors = []

            let formData = new FormData();
            formData.append('name', this.name)
            formData.append('email', this.email)
            formData.append('password', this.password)
            formData.append('password_confirmation', this.password_confirmation)

            await axios.post('register', formData).then(() => {
                window.location.replace('/');
                this.$router.push({name: 'home'});
            }).catch(error => {
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
