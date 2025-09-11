import axios from 'axios';

const api = axios.create({
    baseURL: 'http://localhost:8000/api', // A URL base da sua API Laravel
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    }
});

export default api;