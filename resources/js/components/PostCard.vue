<template>
    <div class="mb-10">
        <router-link :to="{name: 'show-post', params: {slug: post.slug}}">
            <h4 class="text-2xl pb-3 font-semibold hover:underline">{{ post.title }}</h4>
        </router-link>
        <div class="text-gray-600 pb-3">{{ post.subtitle }}</div>
        <div class="text-sm text-gray-600">
            By {{ post.user.name }} &nbsp;in {{ post.category.name }}&nbsp; - {{ post.created_at | timeago }}
        </div>
    </div>
</template>

<script>
export default {
    name: "PostCard",
    props: ['post']
}
</script>

<style scoped>

</style>
