<template>
    <div class="w-full mb-5">
        <span :class="inputCss"
              :placeholder="placeholder"
              @keydown="onchanging"
              ref="textInput"
              role="textbox"
              contenteditable>
        </span>
        <div v-if="hasHelper" :class="helperCss">{{ this.characterCount + '/' + this.max }}</div>
    </div>
</template>

<script>
export default {
    name: "TextInput",
    props: {
        value: String,
        max: Number,
        placeholder: String,
        row: {
            type: Number,
            default: 1
        },
        inputCss: {
            type: String,
            default: 'form-control block w-full px-3 py-2 resize-none overflow-hidden text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none'
        },
        helperCss: {
            type: String,
            default: 'text-sm text-gray-500 mt-1'
        },
        enterable:{
            type: Boolean,
            default: true
        },
        hasHelper: {
            type: Boolean,
            default: true
        }
    },
    computed: {
        input: {
            get() {
                return this.value
            },
            set(v) {
                this.$emit('input', v)
            }
        },
        inputStyle() {
            return this.inputCss
        },
        helperStyle() {
            return this.helperCss
        }
    },
    data() {
        return {
            characterCount: 0
        }
    },
    mounted() {
        this.$refs.textInput.style.minHeight = `${this.$refs.textInput.clientHeight * this.row}px`
    },
    methods: {
        onchanging(e) {
            if (e.keyCode === 13 && !this.enterable) {
                e.preventDefault();
            }

            this.input = this.$refs.textInput.textContent

            setTimeout(() => {
                this.characterCount = this.$refs.textInput.textContent.length
            }, 50)

            if (this.characterCount >= this.max && e.keyCode !== 8) {
                e.preventDefault();
            }
        }
    },
}
</script>

<style scoped>
span[contenteditable=true]:empty:not(:focus):before {
    content: attr(placeholder);
    color: grey;
    font-style: italic;
    font-size: 1rem;
    line-height: 1.5rem;
}
</style>
