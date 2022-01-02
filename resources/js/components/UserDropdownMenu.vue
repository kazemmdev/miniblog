<template>
    <div class="relative">
        <button @click="show=!show" class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-gray-400">
            <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
        </button>
        <dropdown-menu :show="show" @closed="show=false">
            <a href="#" class="block px-4 py-2 text-sm text-gray-700">Your Profile</a>
            <div @click="logout" class="block px-4 py-2 text-sm text-gray-700 cursor-pointer">Sign out</div>
        </dropdown-menu>
    </div>
</template>

<script>
import DropdownMenu from "./DropdownMenu";

export default {
    name: "UserDropdownMenu",
    components: {DropdownMenu},
    data() {
        return {
            show: false
        }
    },
    methods: {
        logout() {
            this.$store.dispatch('logout')
        }
    }
}
</script>

