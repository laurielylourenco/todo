import { createRouter, createWebHistory } from "vue-router";
import type { RouteRecordRaw } from "vue-router";

import Login from "../views/page/auth/Login.vue";
import Register from "../views/page/auth/Register.vue";
import Home from "../views/page/Home.vue";

const routes: Array<RouteRecordRaw> = [
  { path: "/login", name: "Login", component: Login },
  { path: "/", name: "Home", component: Home },
  { path: "/register", name: "Register", component: Register },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;



