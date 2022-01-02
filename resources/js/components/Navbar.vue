<template>
    <header class="flex items-center justify-between py-10">
        <div class="flex items-center justify-between">
            <a href="/" class="h-6 text-2xl font-semibold">MiniBlog</a>
        </div>
        <div class="flex items-center text-base leading-5">
            <template v-if="isLoggedIn">
                <template v-if="$route.name!=='new-post'">
                    <router-link to="/new-post" class="rounded-full px-4 py-2 mr-5 text-sm bg-green-400 font-bold hover:opacity-75 text-white">
                        New Post
                    </router-link>
                </template>
                <user-dropdown-menu/>
            </template>
            <template v-else>
                <router-link to="login" class="rounded px-4 py-2 text-sm font-bold outline-none focus:outline-none hover:opacity-75 w-full disabled:opacity-25">
                    Login
                </router-link>
                <router-link to="register" class="rounded px-4 py-2 text-sm bg-blue-500 font-bold outline-none focus:outline-none hover:opacity-75 w-full text-white disabled:opacity-25">
                    Register
                </router-link>
            </template>
        </div>
    </header>
</template>

<script>
import {mapState} from "vuex";
import UserDropdownMenu from "./UserDropdownMenu";

export default {
    name: "navbar",
    components: {UserDropdownMenu},
    data() {
        return {
            show: false
        }
    },
    computed: {
        dropDown() {
            return this.show ? 'transition ease-out duration-100' : 'transform opacity-0 scale-95'
        },
        ...mapState({
            isLoggedIn: 'isLoggedIn'
        })
    },
}
</script>
