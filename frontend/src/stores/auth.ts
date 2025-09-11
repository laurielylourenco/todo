import { defineStore } from 'pinia';
import { ref, computed } from 'vue';

export const useAuthStore = defineStore('auth', () => {


    
    // Tenta pegar o token e o usuário do localStorage ao iniciar
    const token = ref(localStorage.getItem('token') || null);
    const user = ref(JSON.parse(localStorage.getItem('user') || 'null'));

    
    const isAuthenticated = computed(() => !!token.value);

  
    function setAuthData(authToken: string, authUser: any) {
        token.value = authToken;
        user.value = authUser;
  
        localStorage.setItem('token', authToken);
        localStorage.setItem('user', JSON.stringify(authUser));
    }

    function clearAuthData() {
        token.value = null;
        user.value = null;
        localStorage.removeItem('token');
        localStorage.removeItem('user');
    }

    return { token, user, isAuthenticated, setAuthData, clearAuthData };
});