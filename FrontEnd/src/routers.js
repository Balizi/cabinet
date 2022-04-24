import loginVue from './components/loginVue.vue'
import SignupVue from './components/SignupVue.vue'
import HomeVue from './components/HomeVue.vue'
import RendezVous from './components/RendezVous.vue'
import UpdateVue from './components/UpdateVue.vue'
import { createRouter, createWebHistory } from 'vue-router'

const routes = [
    {
        name: "HomeVue",
        component: HomeVue,
        path: "/"
    },
    {
        name: "SignupVue",
        component: SignupVue,
        path: "/Signup"
    },
    {
        name: "loginVue",
        component: loginVue,
        path: "/login"
    },
    {
        name: "RendezVous",
        component: RendezVous,
        path: "/Rendezvous"
    },
    {
        name: "updateVue",
        component: UpdateVue,
        path: "/update/:id"
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router;