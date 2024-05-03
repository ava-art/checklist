<script setup>
import { useStatiscticsStore } from "../../../stores/StatisticsStore";
import SposobOplata from "./ChangeModal/SposobOplata.vue"
import SposobDoplata from "./ChangeModal/SposobDoplata.vue"


const statisticsStore = new useStatiscticsStore();
import SVGTrash from "../SVG/SVGTrash.vue";

const props = defineProps({
    item: {
        type: Object,
    },
});

statisticsStore.changeItem = props.item
</script>
<template>
    
    <div
        class="fixed w-screen h-screen top-0 left-0 z-40 bg-black text-base bg-opacity-80"
        @click.self="statisticsStore.viewModal = null"
    >
        <div
            class="wrap-modal-all relative w-11/12 min-h-16 bg-white rounded-xl m-auto mt-12 p-2 overflow-y-scroll"
        >
            <div @click="statisticsStore.onDeleteItem" class="absolute top-3 z-10 w-4 right-3 cursor-pointer">
                <SVGTrash />
            </div>
            <div class="text-center">Изменить: {{ item.element.name }}</div>
          <SposobOplata />
          <SposobDoplata />
          <div class=" w-1/2 mt-3 text-center rounded-xl mx-auto px-4 py-2 bg-red-500 text-xl"
            @click="statisticsStore.onChangeItem"
          >
            Изменить
          </div>
        </div>
    </div>
</template>
