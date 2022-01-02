<template>
    <div class="max-w-3xl px-4 mx-auto sm:px-6 xl:max-w-5xl xl:px-0">
        <navbar/>
        <div class="flex">
            <div class="w-3/5 flex-auto flex flex-col">
                <div v-if="posts.length">
                    <post-card v-for="post in posts" :key="post.id" :post="post"/>
                </div>
            </div>
            <div class="w-2/5 flex-auto pl-10 h-screen sticky top-10 hidden md:flex md:flex-col">
                <latest-categories class="mb-10"/>
                <latest-tags/>
            </div>
        </div>
    </div>
</template>

<script>
import {mapState} from "vuex"
import PostCard from "../components/PostCard";
import LatestCategories from "../components/LatestCategories";
import LatestTags from "../components/LatestTags";

export default {
    name: "index",
    components: {LatestTags, LatestCategories, PostCard},
    computed: {
        ...mapState({
            userName: state => state.user.name
        })
    },
    data() {
        return {posts: []}
    },
    mounted() {
        this.getPosts()
    },
    methods: {
        async getPosts() {
            await axios.get('posts').then(response => {
                this.posts = response.data.data
            })
        }
    }
}
</script>
