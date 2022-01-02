<template>
    <div class="bg-gray-100 rounded p-3">
        <h2 class="text-gray-500 font-bold ml-1">Categories</h2>
        <div class="border-b-gray-300 border my-2"></div>
        <div class="flex flex-wrap" v-if="categories && categories.length">
            <div class="bg-gray-400 rounded-full px-3 py-1 m-1 opacity-100 hover:opacity-75" v-for="category in categories" :key="category.index">
                <router-link class="text-sm font-semibold text-white" :to="{name:'category', params: {slug: category.slug}}">
                    {{ category.name }}
                </router-link>
            </div>
        </div>
        <div v-else>No categories yet ...</div>
    </div>
</template>

<script>
export default {
    name: "LatestCategories",
    data() {
        return {
            categories: null
        }
    },
    mounted() {
        this.getCategories()
    },
    methods: {
        async getCategories() {
            await axios.get('/categories').then(response => {
                this.categories = response.data.data
            })
        }
    }
}
</script>

<style scoped>

</style>
