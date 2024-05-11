<script setup>
import { useHomeStore } from "/resources/stores/HomeStore";

import ListElements from "./ListElements.vue"

const homeStore = new useHomeStore();

homeStore.getCategories()

</script>
<template>
    <div class="flex flex-col items-center justify-center">
        <div class="w-full p-4 bg-white rounded-lg mb-2" :key="category.id" v-for="category of homeStore.categories">

            <ListElements :category="category"/>
        </div>
        <div class="bg-white w-full flex-col justify-center p-2 items-center">
            <div class="mb-2 m-auto" v-if="homeStore.newCategory.checked">
                <input type="text" class=" rounded-lg m-auto w-4/5 block"
                    @input="e => homeStore.newCategory.name = e.target.value"
                placeholder="Новая категория" />
            </div>
            <div
                @click="homeStore.addCategory"
                class="w-1/2 p-4 rounded-lg m-auto border bg-orange-200 text-center cursor-pointer"
            >
                Добавить категорию
            </div>
        </div>
    </div>
</template>
<style></style>
