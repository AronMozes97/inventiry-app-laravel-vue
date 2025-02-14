import {createRouter, createWebHistory} from "vue-router";

import NotFoundPage from "@/components/NotFoundPage.vue";

import CarList from "@/components/Car/CarList.vue";
import NewCar from "@/components/Car/NewCar.vue";
import CarEdit from "@/components/Car/CarEdit.vue";
import CarArchive from "@/components/Car/CarArchive.vue";

import PartList from "@/components/Part/PartList.vue";
import NewPart from "@/components/Part/NewPart.vue";
import PartEdit from "@/components/Part/PartEdit.vue";

const routes = [
    {
        path: "/",
        name: "CarList",
        component: CarList
    },
    {
        path: "/car/create",
        name: "CarCreate",
        component: NewCar
    },
    {
        path: "/car/edit/:id",
        name: "CarEdit",
        component: CarEdit
    },
    {
        path: "/car/archive",
        name: "CarArchive",
        component: CarArchive
    },
    {
        path: '/part/list',
        name: 'PartList',
        component: PartList
    },
    {
        path: '/part/create',
        name: 'PartCreate',
        component: NewPart
    },
    {
        path: "/part/edit/:id",
        name: "PartEdit",
        component: PartEdit
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
