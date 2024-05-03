<script setup>
import { useStatiscticsStore } from "../../../stores/StatisticsStore";

const statisticsStore = new useStatiscticsStore();


</script>
<template>
    <div
        class="fixed w-screen h-screen top-0 left-0 z-40 bg-black text-base bg-opacity-80"
        @click.self="statisticsStore.viewAcessory = false"
    >
        <div
            class="wrap-modal-all relative w-11/12 min-h-16 bg-white rounded-xl m-auto mt-12 p-2 overflow-y-scroll"
        >
            <div class="text-center">Аксессуары</div>
            
            <div
                class="flex mb-2 flex-col mt-2 border p-2 pb-0 rounded-lg gap-2 items-center"
            >
                <div class=" w-full"  v-for="item of statisticsStore.Acessory.list" :key="item[0]">
                <div class=" w-full flex text-xs items-center justify-between">
                    <div class=" w-2/12 " >{{ item[1].name }}</div>
                    <div class=" w-2/12 " >{{ item[1].full_price }}</div>
                    <div class=" w-1/12 " >{{ item[1].count }}</div>
                    <div class=" w-2/12 " >{{ item[1].who_add }}</div>
                    <div class=" flex flex-col justify-center items-center w-3/12 " >
                        <span>{{ item[1].time }}</span>
                        <span>{{ item[1].date }}</span>
                        
                    </div>
                </div>
                <hr>
                </div>
            </div>
        </div>
    </div>
</template>
