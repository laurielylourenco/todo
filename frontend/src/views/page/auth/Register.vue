<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
    <div class="w-full max-w-md p-8 bg-white dark:bg-gray-800 rounded-2xl shadow-lg">
      <h1 class="text-2xl font-bold text-center text-gray-900 dark:text-white mb-6">
        Cadastro
      </h1>

      <form class="space-y-4" @submit.prevent="handleRegister">
        <!-- Nome -->
        <div>
          <label class="block text-gray-700 dark:text-gray-300 mb-1">Nome</label>
          <input type="text" v-model="form.name"
            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
            placeholder="Digite seu nome" />
        </div>

        <!-- Email -->
        <div>
          <label class="block text-gray-700 dark:text-gray-300 mb-1">Email</label>
          <input type="email" v-model="form.email"
            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
            placeholder="Digite seu email" />
        </div>

        <!-- Senha -->
        <div>
          <label class="block text-gray-700 dark:text-gray-300 mb-1">Senha</label>
          <input type="password" v-model="form.password"
            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
            placeholder="Digite sua senha" />
        </div>

        <!-- Confirmar Senha -->
        <div>
          <label class="block text-gray-700 dark:text-gray-300 mb-1">Confirmar Senha</label>
          <input type="password" v-model="form.confirmPassword"
            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
            placeholder="Confirme sua senha" />
        </div>

        <!-- Botão de cadastro -->
        <button type="submit"
          class="w-full py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
          Cadastrar
        </button>
      </form>

      <p v-if="errorMessage" class="mt-4 text-center text-red-500">
        {{ errorMessage }}
      </p>

      <p class="mt-4 text-center text-gray-600 dark:text-gray-400">
        Já tem uma conta?
        <router-link to="/login" class="text-blue-600 hover:underline">
          Entrar

        </router-link>
      </p>
    </div>
  </div>
</template>

<script setup>
import { reactive, ref } from 'vue';
import { useRouter } from 'vue-router';
import api from '../../../services/api'; // ajuste o caminho conforme necessário


const form = reactive({
  name: '',
  email: '',
  password: '',
  confirmPassword: ''
});

const errorMessage = ref('');
const router = useRouter();


const handleRegister = async () => { 

  errorMessage.value = ''; // resetar mensagem de erro

  // Validação simples de senha
  if (form.password !== form.confirmPassword) {
    errorMessage.value = 'As senhas não coincidem.';
    return;
  }

  try {
    const response = await api.post('/register', {
      name: form.name,
      email: form.email,
      password: form.password
    });

    // Redirecionar para a página de login após registro bem-sucedido
    router.push('/login');
  } catch (error) {
    errorMessage.value = 'Erro ao cadastrar. Tente novamente.';
    console.error(error);
  } 
}

// Aqui você pode adicionar lógica de formulário, validação ou integração com API
</script>
