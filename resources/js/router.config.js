import Vue from "vue"
import VueRouter from "vue-router"

Vue.use(VueRouter)

import index from "./pages/index"
import login from "./pages/login"
import register from "./pages/register"
import showPost from "./pages/post/show"
import createPost from "./pages/post/create"
import editPost from "./pages/post/edit"
import category from "./pages/category"

const routes = [
    {path: '/', name: 'home', component: index},
    {path: '/login', name: 'login', component: login},
    {path: '/register', name: 'register', component: register},
    {path: '/category/:slug', name: 'category', component: category},

    {path: '/post/:slug', name: 'show-post', component: showPost},
    {path: '/post/:slug/edit', name: 'edit-post', component: editPost},
    {path: '/new-post', name: 'new-post', component: createPost},
];

export default new VueRouter({
    mode: "history",
    routes
})
