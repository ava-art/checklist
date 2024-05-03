<script setup>

import { useChangeStore } from "../../../stores/ChangeStore";


const changeStore = new useChangeStore();
</script>
<template>
    <div
        v-if="changeStore.client"
        @click.self="changeStore.client = null"
        class="z-100 fixed top-0 right-0 z-40 flex items-center justify-center h-screen w-full bg-black bg-opacity-85"
    >
        <div class="bg-white h-5/6 w-11/12 rounded-xl p-4">
            {{ changeStore.client }}
        </div>
    </div>
</template>
<style></style>
