<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TransportadoraForm from '@/Components/forms/TransportadoraForm.vue';
import FormModal from '@/Components/FormModal.vue';
import TableGrid from '@/Components/TableGrid.vue';
import addLogo from '@/Components/icons/addLogo.vue';

export default {
    components: {
        AuthenticatedLayout,
        TransportadoraForm,
        FormModal,
        TableGrid,
        addLogo
    },
    props: {
        transportadoras: Array,
    },
    data() {
        return {
            isOpen: false,
            selectedTransportadora: null, // Guarda a transportadora selecionada para edição
            selectedTransportadoraId: null // Guarda o ID da transportadora selecionada
        };
    },
    methods: {
        openModal(transportadora) {
            if (Number.isInteger(transportadora)) {
                this.selectedTransportadora = transportadora;
            }
            this.isOpen = true;
        },
        closeModal() {
            this.isOpen = false;
            this.selectedTransportadora = null; // Limpa a transportadora selecionada
        },

    },
};
</script>

<template>
    <AuthenticatedLayout>
        <div class="py-12 bg-dots-darker" style="padding-bottom: 1rem;">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">Transportadoras:</div>
                    <div class="flex justify-center" style="margin-left: auto;">
                        <button @click="openModal"><addLogo class="logo-add"/></button>
                    </div>
                </div>
            </div>
        </div>

        <TableGrid :data="transportadoras" @edit="openModal"/>

        <FormModal :isOpen="isOpen" @close="closeModal">
            <template #content>
                <div class="form-content">
                    <!-- Passe o ID da transportadora selecionada para o formulário de edição -->
                    <TransportadoraForm :id="selectedTransportadora" @closePopUp="closeModal" />
                </div>
            </template>
        </FormModal>
    </AuthenticatedLayout>
</template>
<style>
    .logo-add{
    }
</style>
