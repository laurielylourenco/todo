import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import Aura from '@primeuix/themes/aura';
import router from "./router/index";
import './style.css'

// importa os estilos do 
// importa PrimeVue
import PrimeVue from 'primevue/config'

const app = createApp(App)

const pinia = createPinia()

app.use(pinia)
app.use(router);
// registra o PrimeVue
app.use(PrimeVue, {
    theme: {
        preset: Aura
    }
});

// monta a aplicação
app.mount('#app')
