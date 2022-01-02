<template>
    <div class="max-w-3xl px-4 mx-auto sm:px-6 xl:max-w-5xl xl:px-0">
        <navbar/>
        <div class="mx-auto w-full md:w-3/4 my-10">
            <text-input :max="40" :row="1" v-model="title" :placeholder="'Enter you title here ...'" :enterable="false"/>
            <text-input :max="60" :row="2" v-model="subtitle" :placeholder="'Enter you subtitle here ...'"/>
            <text-input :max="2000" :row="5" v-model="body" :placeholder="'Enter you body here ...'"/>
            <text-input :max="100" :row="1" v-model="tags" :placeholder="'separate each tags with `,`'" :enterable="false" :hasHelper="false"/>
            <category-selector v-model="category_id" class="mb-4"/>
            <div class="flex pb-40">
                <button @click="publish"
                        class="rounded px-4 py-2 ml-auto text-sm bg-blue-500 font-bold outline-none focus:outline-none hover:opacity-75 text-white disabled:opacity-25">
                    Publish
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import TextInput from "../../components/TextInput";
import ResizableInput from "v-resizable-input"
import CategorySelector from "../../components/CategorySelector";

export default {
    name: "create",
    components: {CategorySelector, TextInput, ResizableInput},
    data() {
        return {
            title: '',
            subtitle: '',
            body: '',
            tags: '',
            category_id: -1
        }
    },
    methods: {
        async publish() {
            let formData = new FormData()
            formData.append('title', this.title)
            formData.append('subtitle', this.subtitle)
            formData.append('body', this.body)
            formData.append('tags', this.tags)
            formData.append('category_id', this.category_id)

            await axios.post('/posts', formData).then(() => {
                this.$router.push({name: 'home'})
            })
        }
    }
}
</script>
