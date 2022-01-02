<template>
    <div class="bg-gray-100 rounded p-3">
        <h2 class="text-gray-500 font-bold ml-1">Latest Tags</h2>
        <div class="border-b-gray-300 border my-2"></div>
        <div class="flex flex-wrap" v-if="tags && tags.length">
            <div class="bg-gray-400 rounded-full px-3 py-1 m-1 opacity-100 hover:opacity-75" v-for="tag in tags" :key="tag.index">
                <span class="text-sm font-semibold text-white">{{ tag.name }}</span>
            </div>
        </div>
        <div v-else class="text-sm text-gray-400">No tags yet ...</div>

    </div>
</template>

<script>
export default {
    name: "LatestTags",
    data() {
        return {
            tags: null
        }
    },
    mounted() {
        this.getCategories()
    },
    methods: {
        async getCategories() {
            await axios.get('/tags').then(response => {
                this.tags = response.data.data
            })
        }
    }
}
</script>

<style scoped>

</style>
