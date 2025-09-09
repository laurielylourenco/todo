import { createRouter, createWebHistory } from "vue-router";
import type { RouteRecordRaw } from "vue-router";

import Login from "../views/page/auth/Login.vue";
import Register from "../views/page/auth/Register.vue";

const routes: Array<RouteRecordRaw> = [
  { path: "/login", name: "Login", component: Login },
  { path: "/", name: "Login", component: Login },
  { path: "/register", name: "Register", component: Register },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;



