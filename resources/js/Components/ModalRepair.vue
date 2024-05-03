<script setup>
import { ref } from "vue";
import { useHomeStore } from "../../stores/HomeStore";

const homeStore = new useHomeStore();

const props = defineProps({
    item : {
        type: Object
    }
})
</script>

<template>
    <div
        class=" fixed h-screen w-screen flex items-center justify-center bg-opacity-80 bg-black top-0 left-0 z-40"
        v-if="homeStore.itemRepair == item"
        @click.self="homeStore.itemRepair = {}"
    >
        <div class=" w-11/12 h-auto bg-white p-4 rounded-2xl ">
            <div class=" text-center text-base">Ремонт - {{ item.name }}</div>
            <hr>
            <textarea
            type="text"
            class="w-full rounded-md mt-2 min-h-28 max-h-44 mb-2"
            placeholder="Какие неисправности?"
            @input="(e) => (homeStore.itemRepair.repair = e.target.value)"
            :value="homeStore.itemRepair.repair"
        ></textarea>
            <div class="w-1/2 max-w-30 rounded-xl  m-auto block p-2 text-white bg-red-600 text-center"
            @click="() => homeStore.setRepair()"
            >
                Сохранить
            </div>
        </div>
    </div>
</template>

<style>
.modal-oform {
    transition: all 0.1s linear;
    visibility: hidden;
    opacity: 0;
}
.modal-oform.active {
    visibility: visible;
    opacity: 1;
}</style>
