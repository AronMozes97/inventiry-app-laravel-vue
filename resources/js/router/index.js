import {createRouter, createWebHistory} from "vue-router";

import CarList from "@/components/Car/CarList.vue";
import CarEdit from "@/components/Car/CarEdit.vue";
import NotFoundPage from "@/components/NotFoundPage.vue";


const routes = [
    {
        path: "/",
        name: "CarList",
        component: CarList
    },
    {
        path: "/car/edit/:id",
        name: "CarEdit",
        component: CarEdit
    },
    {
        path: "/:pathMatch(.*)*",
        name: "NotFoundPage",
        component: NotFoundPage
    }
]

const router = createRouter({
    history: createWebHistory(),
    linkActiveClass: "active",
    routes
})

export default router;
