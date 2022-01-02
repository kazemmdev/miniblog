<template>
    <div class="max-w-3xl px-4 mx-auto sm:px-6 xl:max-w-5xl xl:px-0">
        <navbar/>
        <div class="w-3/5 mx-auto flex flex-col" v-if="category">
            <h1 class="text-4xl pb-3 font-semibold">{{ category.name }} Posts</h1>
            <div class="border-b-gray-300 border mb-6"></div>
            <post-card v-for="post in category.posts" :key="post.id" :post="post"/>
        </div>
    </div>
</template>

<script>
import {mapState} from "vuex"
import PostCard from "../components/PostCard";

export default {
    name: "index",
    components: {PostCard},
    computed: {
        ...mapState({
            userName: state => state.user.name
        })
    },
    data() {
        return {
            category: null,
        }
    },
    mounted() {
        this.getCategoryPosts()
    },
    methods: {
        async getCategoryPosts() {
            await axios.get('/categories?slug=' + this.$route.params.slug).then(response => {
                this.category = response.data.data
            })
        }
    }
}
</script>
