<template>
    <div class="table-grid max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 ">
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
                        class="bg-white border-b dark:bg-gray-600 dark:border-gray-700 hover:bg-blue-400 cursor-pointer"
                        @dblclick="editTransportadora(item.id)"
                        >
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
                            <button class="bg-blue-300" @click="editTransportadora(item.id)"><EditLogo /></button>
                        </td>
                        <td class="px-2 py-2 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <button @click="deleteTransportadora(item.id)"><DeleteLogo /></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import EditLogo from './icons/editLogo.vue';
import DeleteLogo from './icons/deleteLogo.vue';
import Swal from 'sweetalert2';

const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 1500,
  color: '#ffff',
  background: '#1f2937',
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  }
});


export default {
    components:{
        EditLogo,DeleteLogo
    },
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
                        // Remove a linha
                        const index = this.data.findIndex(item => item.id === id);
                        if (index !== -1) {
                            this.data.splice(index, 1);
                        }
                        Toast.fire({
                                icon: "success",
                                title: 'Transportadora excluida com sucesso.'
                        });
            })
                    .catch(error => {
                        console.error('Erro ao excluir a transportadora:', error);
                    });
            }
        }

    }
};
</script>
