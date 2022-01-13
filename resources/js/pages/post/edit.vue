<template>
    <div class="max-w-3xl px-4 mx-auto sm:px-6 xl:max-w-5xl xl:px-0">
        <navbar/>
        <div class="mx-auto w-full md:w-3/4 my-10" v-if="id!==-1">
            <text-input :max="60" :row="1" v-model="title" :placeholder="'Enter you title here ...'" :enterable="false"/>
            <text-input :max="200" :row="2" v-model="subtitle" :placeholder="'Enter you subtitle here ...'"/>
            <div class="mb-8">
                <ckeditor :editor="editor" v-model="body" :config="editorConfig"></ckeditor>
            </div>
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
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

export default {
    name: "edit",
    components: {CategorySelector, TextInput, ResizableInput},
    data() {
        return {
            id: -1,
            title: '',
            subtitle: '',
            body: '',
            tags: '',
            category_id: -1,
            editor: ClassicEditor,
            editorConfig: {
                toolbar: ['bold', 'italic', 'link', 'blockQuote', '|', 'undo', 'redo']
            }
        }
    },
    mounted() {
        this.load();
    },
    methods: {
        async load() {
            await axios.get('/posts/' + this.$route.params.slug).then(response => {
                this.id = response.data.data.id
                this.title = response.data.data.title
                this.subtitle = response.data.data.subtitle
                this.body = response.data.data.body
                this.tags = response.data.data.tags.map(x => x.name).join(", ")
                this.category_id = response.data.data.category.id
            })
        },
        async publish() {
            let formData = new FormData()
            formData.append('title', this.title)
            formData.append('subtitle', this.subtitle)
            formData.append('body', this.body)
            formData.append('tags', this.tags)
            formData.append('category_id', this.category_id)

            await axios.put('/posts/' + this.id, formData).then(() => {
                this.$router.push({name: 'home'})
            })
        }
    }
}
</script>
