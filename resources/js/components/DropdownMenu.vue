<template>
    <transition name="appear">
        <div v-on-click-away="close" v-if="show" class="dropdown-menu absolute bg-gray-100 rounded-sm mt-2 text-sm text-gray-600 border-gray-200 shadow w-40 overflow-y-auto z-10 p-2">
            <slot></slot>
        </div>
    </transition>
</template>

<script>
import {directive as onClickAway} from 'vue-clickaway';

export default {
    name: "DropdownMenu",
    props: {
        show: Boolean,
    },
    methods: {
        close() {
            this.$emit('closed');
        }
    },
    directives: {onClickAway}
}
</script>

<style scoped>
.dropdown-menu {
    right: 0
}
</style>
