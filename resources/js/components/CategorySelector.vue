<template>
    <div class="relative">
        <div @click="showDropdown" class="form-control block w-full px-3 py-2 resize-none overflow-hidden text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
            <div class="group flex justify-between">
                <template v-if="editing">
                    <input v-model="category_edit" class="outline-none" ref="editBox">
                    <div class="flex opacity-50 group-hover:opacity-90 transition-opacity ease-out duration-500 cursor-pointer" id="action_edit">
                        <div class="text-green-400 px-1 hover:text-green-700" @click="store">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="2 3 10 9" xml:space="preserve">
                                <path xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" d="M11.3904 5.31232L7.07178 10.7106L3.67991 7.88408L4.32009 7.11586L6.92822 9.2893L10.6096 4.68762L11.3904 5.31232Z" fill="black"/>
                            </svg>
                        </div>
                        <div class="text-red-400 px-1 hover:text-red-700" @click="editing=false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="-30 -30 150 150">
                                <g>
                                    <path xmlns="http://www.w3.org/2000/svg"
                                          d="M55.931,47.463L94.306,9.09c0.826-0.827,0.826-2.167,0-2.994L88.833,0.62C88.436,0.224,87.896,0,87.335,0   c-0.562,0-1.101,0.224-1.498,0.62L47.463,38.994L9.089,0.62c-0.795-0.795-2.202-0.794-2.995,0L0.622,6.096   c-0.827,0.827-0.827,2.167,0,2.994l38.374,38.373L0.622,85.836c-0.827,0.827-0.827,2.167,0,2.994l5.473,5.476   c0.397,0.396,0.936,0.62,1.498,0.62s1.1-0.224,1.497-0.62l38.374-38.374l38.374,38.374c0.397,0.396,0.937,0.62,1.498,0.62   s1.101-0.224,1.498-0.62l5.473-5.476c0.826-0.827,0.826-2.167,0-2.994L55.931,47.463z"/>
                                </g>
                            </svg>
                        </div>
                    </div>
                </template>
                <template v-else-if="category">
                    {{ category.name }}
                    <div class="flex opacity-50 group-hover:opacity-90 transition-opacity ease-out duration-500 cursor-pointer" id="action_select">
                        <div class="text-gray-400 px-1 hover:text-yellow-700" @click="editing=true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="-50 -50 600 600">
                                <g>
                                    <g>
                                        <path d="M313.548,152.387l-230.8,230.9c-6.7,6.7-6.7,17.6,0,24.3c3.3,3.3,7.7,5,12.1,5s8.8-1.7,12.1-5l230.8-230.8     c6.7-6.7,6.7-17.6,0-24.3C331.148,145.687,320.248,145.687,313.548,152.387z"/>
                                        <path d="M431.148,191.887c4.4,0,8.8-1.7,12.1-5l25.2-25.2c29.1-29.1,29.1-76.4,0-105.4l-34.4-34.4     c-14.1-14.1-32.8-21.8-52.7-21.8c-19.9,0-38.6,7.8-52.7,21.8l-25.2,25.2c-6.7,6.7-6.7,17.6,0,24.3l115.6,115.6     C422.348,190.187,426.748,191.887,431.148,191.887z M352.948,45.987c7.6-7.6,17.7-11.8,28.5-11.8c10.7,0,20.9,4.2,28.5,11.8     l34.4,34.4c15.7,15.7,15.7,41.2,0,56.9l-13.2,13.2l-91.4-91.4L352.948,45.987z"/>
                                        <path d="M162.848,467.187l243.5-243.5c6.7-6.7,6.7-17.6,0-24.3s-17.6-6.7-24.3,0l-239.3,239.5l-105.6,14.2l14.2-105.6     l228.6-228.6c6.7-6.7,6.7-17.6,0-24.3c-6.7-6.7-17.6-6.7-24.3,0l-232.6,232.8c-2.7,2.7-4.4,6.1-4.9,9.8l-18,133.6     c-0.7,5.3,1.1,10.6,4.9,14.4c3.2,3.2,7.6,5,12.1,5c0.8,0,1.5-0.1,2.3-0.2l133.6-18     C156.748,471.587,160.248,469.887,162.848,467.187z"/>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <div class="text-gray-400 px-1 hover:text-red-700" @click="destroy">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="-50 -50 600 600">
                                <g>
                                    <path d="M411.8,131.7c-9.5,0-17.2,7.7-17.2,17.2v288.2c0,10.1-8.2,18.4-18.4,18.4H113.3c-10.1,0-18.4-8.2-18.4-18.4V148.8     c0-9.5-7.7-17.2-17.1-17.2c-9.5,0-17.2,7.7-17.2,17.2V437c0,29,23.6,52.7,52.7,52.7h262.9c29,0,52.7-23.6,52.7-52.7V148.8     C428.9,139.3,421.2,131.7,411.8,131.7z"/>
                                    <path d="M457.3,75.9H353V56.1C353,25.2,327.8,0,296.9,0H192.7c-31,0-56.1,25.2-56.1,56.1v19.8H32.3c-9.5,0-17.1,7.7-17.1,17.2     s7.7,17.1,17.1,17.1h425c9.5,0,17.2-7.7,17.2-17.1C474.4,83.5,466.8,75.9,457.3,75.9z M170.9,56.1c0-12,9.8-21.8,21.8-21.8h104.2     c12,0,21.8,9.8,21.8,21.8v19.8H170.9V56.1z"/>
                                    <path d="M262,396.6V180.9c0-9.5-7.7-17.1-17.1-17.1s-17.1,7.7-17.1,17.1v215.7c0,9.5,7.7,17.1,17.1,17.1     C254.3,413.7,262,406.1,262,396.6z"/>
                                    <path d="M186.1,396.6V180.9c0-9.5-7.7-17.1-17.2-17.1s-17.1,7.7-17.1,17.1v215.7c0,9.5,7.7,17.1,17.1,17.1     C178.4,413.7,186.1,406.1,186.1,396.6z"/>
                                    <path d="M337.8,396.6V180.9c0-9.5-7.7-17.1-17.1-17.1s-17.1,7.7-17.1,17.1v215.7c0,9.5,7.7,17.1,17.1,17.1     S337.8,406.1,337.8,396.6z"/>
                                </g>
                            </svg>
                        </div>
                    </div>
                </template>
                <template v-else>select category</template>
            </div>
        </div>
        <dropdown-menu :show="show" @closed="show=false" style="width: 100% !important;">
            <template v-if="categories && categories.length">
                <div class="w-full block px-4 py-2 text-sm text-gray-700 cursor-pointer" v-for="item in categories" @click="select(item.id)">{{ item.name }}</div>
            </template>
            <div class="w-full block px-4 py-2 text-sm text-gray-700 cursor-pointer">
                <div class="text-sm text-green-500 font-bold focus:outline-none hover:opacity-75" @click="addNew">
                    Add Category
                </div>
            </div>
        </dropdown-menu>
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
