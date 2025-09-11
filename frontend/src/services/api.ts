import axios from 'axios';
import { useAuthStore } from '../stores/auth';

const api = axios.create({
    baseURL: 'http://localhost:8000/api', 
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    }
});

// Interceptor de Requisição
api.interceptors.request.use(config => {
    const authStore = useAuthStore();
    const token = authStore.token;

    if (token) {

        config.headers.Authorization = `Bearer ${token}`;
    }

    return config;
}, error => {
    return Promise.reject(error);
});

export default api;