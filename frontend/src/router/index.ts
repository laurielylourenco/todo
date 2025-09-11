import { createRouter, createWebHistory } from "vue-router";
import type { RouteRecordRaw } from "vue-router";
import { useAuthStore } from "../stores/auth";
import Login from "../views/page/auth/Login.vue";
import Register from "../views/page/auth/Register.vue";
import Home from "../views/page/Home.vue";

const routes: Array<RouteRecordRaw> = [
  { path: "/login", name: "Login", component: Login },
  {
    path: "/", name: "Home", component: Home,
    meta: { requiresAuth: true } 
  },
  { path: "/register", name: "Register", component: Register },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

// Em src/router/index.ts, depois da criação do router



router.beforeEach((to, from, next) => {
  const authStore = useAuthStore();

  console.log('Navegando para:',from, authStore.isAuthenticated ? 'autenticado' : 'não autenticado');

  if (to.meta.requiresAuth && !authStore.isAuthenticated) {

    next({ name: 'Login' });
  } else {
    next();
  }
});

export default router;



