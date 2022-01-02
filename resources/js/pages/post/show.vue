<template>
    <div class="max-w-3xl px-4 mx-auto sm:px-6 xl:max-w-5xl xl:px-0">
        <navbar/>
        <div class="mx-auto w-full md:w-3/4 my-20 pb-10" v-if="post">
            <div class="text-lg text-gray-600 mb-5">
                By {{ post.user.name }}&nbsp; - {{ post.created_at | timeago }}
            </div>
            <h1 class="text-5xl font-bold mb-5">{{ post.title }}</h1>
            <p class="text-gray-700 whitespace-pre-line mb-8">{{ post.body }}</p>
            <div class="flex flex-wrap mb-5">
                <div class="text-sm text-white bg-gray-400 rounded-full px-3 py-1 m-1" v-for="tag in post.tags" :key="tag.id">
                    {{ tag.name }}
                </div>
            </div>
            <div class="flex">
                <div class="mr-6">
                    <img :src="post.user.avatar" alt="writer avatar" class="w-16 h-16 rounded-full">
                </div>
                <div class="flex flex-col justify-center">
                    <div class="text-xl text-gray-600">Written By {{ post.user.name }}</div>
                    <div class="text-gray-600">
                        Published in
                        <router-link :to="{name:'category', params: {slug: post.category.slug}}" class="font-bold hover:text-gray-900">
                            {{ post.category.name }}
                        </router-link>
                        on {{ post.created_at | longdate }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "post",
    data() {
        return {
            post: null
        }
    },
    mounted() {
        this.getPost()
    },
    methods: {
        async getPost() {
            await axios.get('/posts/' + this.$route.params.slug).then(response => {
                this.post = response.data.data
            })
        }
    }
}
</script>

<style scoped>

</style>
