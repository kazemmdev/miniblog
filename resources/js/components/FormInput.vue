<template>
    <div class="w-full mb-6">
        <input :type="type"
               :class="errorStyle"
               :placeholder="placeholder"
               v-model="input"
               class="rounded px-4 py-2 outline-none focus:outline-none border-solid border-2 border-gray-300 bg-gray-100 w-full text-sm focus:border-blue-700">
        <template v-if="hasErrors">
            <div v-for="error in errors" class="flex flex-column text-sm text-red-400">
                <span>{{ error }}</span>
            </div>
        </template>
    </div>
</template>

<script>
export default {
    name: "FormInput",
    props: {
        value: String,
        type: String,
        placeholder: String,
        errors: {
            type: Array,
            default: () => []
        },
    },
    computed: {
        input: {
            get() {
                return this.value
            },
            set(v) {
                this.$emit("input", v);
            }
        },
        hasErrors() {
            return this.errors?.length
        },
        errorStyle() {
            return this.hasErrors ? 'border-red-400' : ''
        }
    }
}
</script>
