<template>
  <div class="p-8">
    <h1 class="text-2xl font-bold">Minha Dashboard</h1>
    <p v-if="authStore.user">
      Bem-vindo(a), {{ authStore.user.name }}!
    </p>

    <button 
      @click="handleLogout"
      class="mt-4 px-4 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition"
    >
      Sair (Logout)
    </button>
  </div>
</template>

<script setup>
import { useAuthStore } from '../../stores/auth';
import { useRouter } from 'vue-router';

const authStore = useAuthStore();
const router = useRouter();

const handleLogout = () => {
  // Limpa os dados de autenticação da store do Pinia
  authStore.clearAuthData();
  
  // Redireciona o usuário para a página de login
  router.push({ name: 'Login' });
};
</script>