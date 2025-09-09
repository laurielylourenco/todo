<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
    <div class="w-full max-w-md p-8 bg-white dark:bg-gray-800 rounded-2xl shadow-lg">
      <h1 class="text-2xl font-bold text-center text-gray-900 dark:text-white mb-6">
        Cadastro
      </h1>

      <form class="space-y-4">
        <!-- Nome -->
        <div>
          <label class="block text-gray-700 dark:text-gray-300 mb-1">Nome</label>
          <input
            type="text"
            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
            placeholder="Digite seu nome"
          />
        </div>

        <!-- Email -->
        <div>
          <label class="block text-gray-700 dark:text-gray-300 mb-1">Email</label>
          <input
            type="email"
            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
            placeholder="Digite seu email"
          />
        </div>

        <!-- Senha -->
        <div>
          <label class="block text-gray-700 dark:text-gray-300 mb-1">Senha</label>
          <input
            type="password"
            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
            placeholder="Digite sua senha"
          />
        </div>

        <!-- Confirmar Senha -->
        <div>
          <label class="block text-gray-700 dark:text-gray-300 mb-1">Confirmar Senha</label>
          <input
            type="password"
            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
            placeholder="Confirme sua senha"
          />
        </div>

        <!-- Botão de cadastro -->
        <button
          type="submit"
          class="w-full py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition"
        >
          Cadastrar
        </button>
      </form>

      <p class="mt-4 text-center text-gray-600 dark:text-gray-400">
        Já tem uma conta? 
        <a href="/login" class="text-blue-600 hover:underline">Entrar</a>
      </p>
    </div>
  </div>
</template>

<script setup>
// Aqui você pode adicionar lógica de formulário, validação ou integração com API
</script>
