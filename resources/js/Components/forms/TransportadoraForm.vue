<template>
    <div class="transportadora-form">
        <form @submit.prevent="submit">

            <div class="flex">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" v-model="form.nome" id="nome" required>

                </div>
                <div v-if="!props.id" class="form-group mx-1">
                    <label for="cep">C.E.P</label>
                    <input type="text" v-model="form.cep" id="cep" required maxlength="9" @input="handleCEP">
                </div>
            </div>


            <div class="flex">
                <div class="form-group mx-1">
                    <label for="endereco">Endereço:</label>
                    <input type="text" v-model="form.endereco" id="endereco" required>
                </div>

                <div class="form-group mx-1">
                    <label for="bairro">Bairro:</label>
                    <input type="text" v-model="form.bairro" id="bairro" required>
                </div>
                <div class="form-group mx-1">
                    <label for="cidade">Cidade:</label>
                    <input type="text" v-model="form.cidade" id="cidade" required>
                </div>
                <div class="form-group mx-1">
                    <label for="uf">UF:</label>
                    <input type="text" v-model="form.uf" id="uf" required>
                </div>
            </div>

            <div class="flex">
                <div class="form-group mx-1">
                    <label for="limite_creditos">Limite de Créditos:</label>
                    <input type="number" v-model="form.limite_creditos" id="limite_creditos" required>
                </div>
                <div class="form-group mx-1">
                    <label for="data_analise_credito">Data de Análise de Crédito:</label>
                    <input type="date" v-model="form.data_analise_credito" id="data_analise_credito" required>
                </div>
                <button type="submit">Enviar</button>
            </div>
        </form>
    </div>
</template>

<script setup>
import axios from 'axios';
import { reactive, watch, defineProps} from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    id: {
        type: Number,
        isOpen: Boolean

    }
});


const form = reactive({
    nome: '',
    endereco: '',
    bairro: '',
    cidade: '',
    uf: '',
    limite_creditos: null,
    data_analise_credito: '',
    cep: ''
});

//Ficar Olhando Id e adiciona no popUp;
watch(() => props.id, async (newValue) => {
    if (newValue) {
        await fetchTransportadora(newValue);
    } else {
        await fetchTransportadora(false);
    }
});

const submit = async () => {
    if (props.id) {
        await router.put(`/transportadora/${props.id}`, form); // Editar transportadora existente
    } else {
        await router.post('/transportadora', form); // Adicionar nova transportadora

    }
};

async function fetchTransportadora(id) {
    if (id) {
        try {
            const response = await axios.get(`/transportadora/${id}`);
            const transportadora = response.data;
            form.nome = transportadora.nome;
            form.endereco = transportadora.endereco;
            form.bairro = transportadora.bairro;
            form.cidade = transportadora.cidade;
            form.uf = transportadora.uf;
            form.limite_creditos = transportadora.limite_creditos;
            form.data_analise_credito = transportadora.data_analise_credito;
            form.cep = transportadora.cep;
        } catch (error) {
            console.error('Erro ao buscar detalhes da transportadora:', error);
        }
    } else {
        form.nome = '';
        form.endereco = '';
        form.bairro = '';
        form.cidade = '';;
        form.uf = '';
        form.limite_creditos = '';
        form.data_analise_credito = '';
        form.cep = '';
    }
}

async function searchAddress() {
    let cepNumber = form.cep.replace(/\D/g, '');

    if (cepNumber.length === 8) {
        try {
            const response = await axios.get(`https://viacep.com.br/ws/${cepNumber}/json/`);
            form.endereco = response.data.logradouro;
            form.bairro = response.data.bairro;
            form.cidade = response.data.localidade;
            form.uf = response.data.uf;
        } catch (error) {
            console.error('Erro ao obter dados do endereço:', error);
        }
    }
}

function formatCEP() {
    form.cep = form.cep.replace(/\D/g, '');

    if (form.cep.length > 5) {
        form.cep = form.cep.substring(0, 5) + '-' + form.cep.substring(5);
    }
}

function handleCEP() {
    formatCEP();
    if (form.cep.length === 9) {
        searchAddress();
    }
}

</script>


<style scoped>
.transportadora-form {
    width: 100%;
    margin: 0 auto;
    padding: 20px;
    border-radius: 5px;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="number"],
input[type="date"] {
    padding: 8px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 5px;
    color: rgb(209 213 219);
    background-color: rgb(17 24 39);
    border-color: rgb(55 65 81)
}

input[type="text"],
input[type="number"],
input[type="date"]:focus {}

button {
    padding: 10px 20px;
    font-size: 16px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}</style>
