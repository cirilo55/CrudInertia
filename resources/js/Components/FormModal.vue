<template>
    <div v-show="isOpen" class="modal">
        <div class="modal-overlay" @click="close"></div>
        <div class="modal-container bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="modal-content">
                <div class="modal-header">
                <div>Transportadora</div>
                <button class="close-button" @click="close"><closeIcon /></button>
                </div>
                <slot name="content"></slot>
            </div>
        </div>
    </div>
</template>

<script>
import closeIcon from './icons/closeIcon.vue';

export default {
    components:{
        closeIcon
    },
    props: {
        isOpen: {
            type: Boolean,
            default: false,
        },
    },
    methods: {
        close() {
            this.$emit('close');
        },
    },
};
</script>

<style scoped>
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
}
.modal-header{
    background-color: rgba(0, 0, 0, 0.5);
    border-radius: 2px;
}

.modal-container {
    z-index: 999;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 80%;
    height: 65%;
    color: rgba(209, 213, 219, 0.896);

}

.modal-content {
    position: relative;
}

.close-button {
    position: absolute;
    top: 5px;
    right: 5px;
}
</style>
