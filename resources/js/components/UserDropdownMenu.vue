<template>
    <div class="relative">
        <button @click="show=!show" class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-gray-400">
           <avatar :fullname="userName" size="40" />
        </button>
        <dropdown-menu :show="show" @closed="show=false">
            <a href="#" class="block px-4 py-2 text-sm text-gray-700">Your Profile</a>
            <div @click="logout" class="block px-4 py-2 text-sm text-gray-700 cursor-pointer">Sign out</div>
        </dropdown-menu>
    </div>
</template>

<script>
import DropdownMenu from "./DropdownMenu";
import Avatar from 'vue-avatar-component'
import {mapState} from "vuex";

export default {
    name: "UserDropdownMenu",
    components: {DropdownMenu, Avatar},
    data() {
        return {
            show: false
        }
    },
   computed: {
      ...mapState({
         userName: state => state.user.name
      })
   },
    methods: {
        logout() {
            this.$store.dispatch('logout')
        }
    }
}
</script>

