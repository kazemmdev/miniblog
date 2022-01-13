<template>
    <div class="max-w-3xl px-4 mx-auto sm:px-6 xl:max-w-5xl xl:px-0">
        <navbar/>
        <div class="mx-auto w-full md:w-3/4 my-20 pb-10" v-if="post">
            <div class="text-lg text-gray-600 mb-5">
                By {{ post.user.name }}&nbsp; - {{ post.created_at | timeago }}
            </div>
            <h1 class="text-5xl font-bold mb-5">{{ post.title }}</h1>
            <div class="text-gray-700 whitespace-pre-line mb-8" v-html="post.body"></div>
            <div class="flex flex-wrap mb-5">
                <div class="text-sm text-white bg-gray-400 rounded-full px-3 py-1 m-1" v-for="tag in post.tags" :key="tag.id">
                    {{ tag.name }}
                </div>
            </div>
            <div class="flex">
                <div class="mr-6">
                    <avatar :fullname="post.user.name"/>
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
            <div class="flex flex-wrap mt-10" v-if="isLoggedIn">
                <router-link :to="{name:'edit-post', slug: post.title}" class="rounded px-4 py-2 text-sm bg-blue-500 font-bold text-white outline-none focus:outline-none hover:opacity-75 disabled:opacity-25">
                    Edit
                </router-link>
                <div @click="destroy" class="rounded px-4 py-2 mx-5 text-sm bg-red-500 font-bold outline-none focus:outline-none hover:opacity-75 text-white disabled:opacity-25 cursor-pointer">
                    delete
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Avatar from 'vue-avatar-component'
import {mapState} from "vuex";

export default {
    name: "post",
    components: {Avatar},
    computed:{
    ...mapState({
        isLoggedIn: 'isLoggedIn',
    })
    },
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
        },
        async destroy() {
            await axios.delete('/posts/' + this.post.id).then(() => {
                this.$router.push({name: 'home'})
            })
        }
    }
}
</script>
