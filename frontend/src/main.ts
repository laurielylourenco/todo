import { createApp } from 'vue'
import App from './App.vue'
import Aura from '@primeuix/themes/aura';
import router from "./router/index";
import './style.css'

// importa os estilos do 
// importa PrimeVue
import PrimeVue from 'primevue/config'

const app = createApp(App)

// registra o PrimeVue
app.use(PrimeVue, {
    theme: {
        preset: Aura
    }
});

// monta a aplicação

app.use(router);
app.mount('#app')
