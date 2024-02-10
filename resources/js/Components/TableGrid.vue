<template>
    <div class="table-grid max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <tr>
                        <th scope="col" class="w-1/12 whitespace-nowrap">#</th>
                        <th scope="col" class="w-3/12 whitespace-nowrap">Nome</th>
                        <th scope="col" class="w-3/12 whitespace-nowrap">Logradouro</th>
                        <th scope="col" class="w-3/12 whitespace-nowrap">Bairro</th>
                        <th scope="col" class="w-3/12 whitespace-nowrap">Cidade/UF</th>
                        <th scope="col" class="w-4/12 whitespace-nowrap">Limite de Creditos</th>
                        <th scope="col" class="w-3/12 whitespace-nowrap">Data Credito</th>

                        <th scope="col" class="w-1/12">Edit</th>
                        <th scope="col" class="w-1/12">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in data" :key="index"
                        class="bg-white border-b dark:bg-gray-600 dark:border-gray-700">
                        <td class="px-2 py-2 font-medium text-gray-900 dark:text-white whitespace-nowrap">{{ item.id }}</td>
                        <td class="px-2 py-2 font-medium text-gray-900 dark:text-white whitespace-nowrap">{{ item.nome }}
                        </td>
                        <td class="px-2 py-2 font-medium text-gray-900 dark:text-white whitespace-nowrap">{{ item.endereco
                        }}</td>
                        <td class="px-2 py-2 font-medium text-gray-900 dark:text-white whitespace-nowrap">{{ item.bairro }}
                        </td>
                        <td class="px-2 py-2 font-medium text-gray-900 dark:text-white whitespace-nowrap">{{ item.cidade }}
                            - {{ item.uf }}</td>
                        <td class="px-2 py-2 font-medium text-gray-900 dark:text-white whitespace-nowrap">{{
                            item.limite_creditos }}</td>
                        <td class="px-2 py-2 font-medium text-gray-900 dark:text-white whitespace-nowrap">{{
                            item.data_analise_credito }}</td>

                        <td class="px-2 py-2 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <button class="bg-blue-300" @click="editTransportadora(item.id)">Edit</button>
                        </td>
                        <td class="px-2 py-2 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <button class="bg-red-700" @click="deleteTransportadora(item.id)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import { useRouter } from 'vue-router';

export default {
    props: {
        data: {
            type: Array,
            required: true,
        },
    },
    methods: {
        editTransportadora(id) {
            this.$emit('edit', id);
        },
        deleteTransportadora(id) {
            if (confirm('Tem certeza que deseja excluir esta transportadora?')) {
                axios.delete(`/transportadora/${id}`)
                    .then(response => {

                    })
                    .catch(error => {
                        console.error('Erro ao excluir a transportadora:', error);
                    });
            }
        }

    }
};
</script>
