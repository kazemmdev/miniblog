import Vue from "vue"

addVueComponentToContext(require.context('./', false, /.*\.(vue)$/));

function addVueComponentToContext(components) {
    components.keys().forEach((file) => {
        const Component = components(file).default;

        if (Component.name) {
            Vue.component(Component.name, Component)
        }
    });
}
