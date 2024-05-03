<script setup>
import { useStatiscticsStore } from "../../../stores/StatisticsStore";
const statisticsStore = new useStatiscticsStore();


import SVGBonus from "../SVG/SVGBonus.vue";
import SVGCredit from "../SVG/SVGCredit.vue";
import SVGNalichka from "../SVG/SVGNalichka.vue";
import SVGPhone from "../SVG/SVGPhone.vue";
</script>
<template>
    <div class="flex justify-between mt-2 items-center">
        <div
            class="w-16 h-12 bg-white flex flex-col item-sposob-stat items-center justify-center rounded-lg p-1 px-4"
        :class="{active : statisticsStore.checkSposob['Наличные']}"
            @click="statisticsStore.changeCheckSposob('Наличные')"
            >
            <SVGNalichka />
            <span class=" text-sm">{{statisticsStore.sposobPay['Наличные']}}</span>
        </div>
        <div
            class="w-16 h-12 bg-white flex flex-col item-sposob-stat items-center justify-center rounded-lg p-1 px-4"
            :class="{active : statisticsStore.checkSposob['Перевод']}"
            @click="statisticsStore.changeCheckSposob('Перевод')"
            >
            <SVGPhone />
            <span class=" text-sm">{{statisticsStore.sposobPay['Перевод']}}</span>
        </div>
        <div
            class="w-16 h-12 bg-white flex flex-col item-sposob-stat items-center justify-center rounded-lg p-1 px-4"
            :class="{active : statisticsStore.checkSposob['Терминал']}"
            @click="statisticsStore.changeCheckSposob('Терминал')"
            >
            <SVGCredit />
            <span class=" text-sm">{{statisticsStore.sposobPay['Терминал']}}</span>
        </div>
        <div
            class="w-16 h-12 bg-white flex flex-col item-sposob-stat items-center justify-center rounded-lg p-1 px-4"
            :class="{active : statisticsStore.checkSposob['Бонус']}"
            @click="statisticsStore.changeCheckSposob('Бонус')"
            >
            <SVGBonus />
            <span class=" text-sm">{{statisticsStore.sposobPay['Бонус']}}</span>
        </div>
    </div>
</template>

<style>
.item-sposob-stat.active{
    background-color: rgb(231, 230, 230);
}
</style>