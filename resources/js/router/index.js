import {createRouter, createWebHistory} from "vue-router";

import HomePage from "@/components/HomePage.vue";
import NotFoundPage from "@/components/NotFoundPage.vue";

const routes = [
    {
        path: "/",
        name: "Home",
        component: HomePage
    },
    {
        path: "/:pathMatch(.*)*",
        name: "NotFoundPage",
        component: NotFoundPage
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;
