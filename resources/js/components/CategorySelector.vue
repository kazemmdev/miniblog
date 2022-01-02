<template>
    <div class="relative">
        <div @click="showDropdown" class="form-control block w-full px-3 py-2 resize-none overflow-hidden text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
            <div class="group flex justify-between">
                <template v-if="editing">
                    <input v-model="category_edit" class="outline-none" ref="editBox">
                    <div class="flex opacity-50 group-hover:opacity-90 transition-opacity ease-out duration-500 cursor-pointer" id="action_edit">
                        <div class="text-gray-400 px-1 hover:text-green-700" @click="store">S</div>
                        <div class="text-gray-400 px-1 hover:text-gray-700" @click="editing=false">E</div>
                    </div>
                </template>
                <template v-else-if="category">
                    {{ category.name }}
                    <div class="flex opacity-50 group-hover:opacity-90 transition-opacity ease-out duration-500 cursor-pointer" id="action_select">
                        <div class="text-gray-400 px-1 hover:text-yellow-700" @click="editing=true">E</div>
                        <div class="text-gray-400 px-1 hover:text-red-700" @click="destroy">D</div>
                    </div>
                </template>
                <template v-else>select category</template>
            </div>
        </div>
        <template v-if="categories && categories.length">
            <dropdown-menu :show="show" @closed="show=false" style="width: 100% !important;">
                <div class="w-full block px-4 py-2 text-sm text-gray-700 cursor-pointer" v-for="item in categories" @click="select(item.id)">{{ item.name }}</div>
                <div class="w-full block px-4 py-2 text-sm text-gray-700 cursor-pointer">
                    <div class="text-sm text-green-500 font-bold focus:outline-none hover:opacity-75" @click="addNew">
                        Add Category
                    </div>
                </div>
            </dropdown-menu>
        </template>
    </div>
</template>

<script>
import DropdownMenu from "./DropdownMenu";

export default {
    name: "CategorySelector",
    components: {DropdownMenu},
    props: ['value'],
    computed: {
        selected: {
            set(v) {
                this.$emit('input', v)
            },
            get() {
                return this.value
            }
        }
    },
    data() {
        return {
            show: false,
            categories: null,
            category: null,
            editing: false,
            category_edit: ''
        }
    },
    mounted() {
        this.load()
    },
    methods: {
        async load() {
            await axios.get('/categories').then(response => {
                this.categories = response.data.data
            })
        },
        async store() {
            if (this.category) {
                await axios.put('/categories/' + this.category.id, {'name': this.category_edit}).then(response => {
                    this.editing = false
                    this.category = response.data.data
                    const index = this.categories.findIndex((obj => obj.id === this.category.id))
                    this.categories[index] = this.category
                })
            } else {
                await axios.post('/categories/', {'name': this.category_edit}).then(response => {
                    this.editing = false
                    this.category = response.data.data
                    this.categories.push(this.category)
                })
            }
        },
        async destroy() {
            await axios.delete('/categories/' + this.category.id).then(() => {
                this.categories = this.categories.filter(el => el.id !== this.category.id)
                this.category = null
            }).catch(error => {
                console.log(error.response.data.message)
            })
        },
        showDropdown(e) {
            if (e.target.parentNode.id !== 'action_select' && e.target.parentNode.id !== 'action_edit' && !this.editing)
                this.show = !this.show
        },
        select(id) {
            this.show = false
            this.category = this.categories?.filter(v => v.id === id)[0];
            this.category_edit = this.category.name
        },
        addNew() {
            this.category_edit = ''
            this.category = null
            this.editing = true
            this.show = false
        }
    },
    watch: {
        editing: function (v) {
            if (v) setTimeout(() => {
                this.$refs.editBox.focus()
            }, 10)
        },
        category: function (v) {
            if (v) this.selected = v.id
        }
    }
}
</script>
