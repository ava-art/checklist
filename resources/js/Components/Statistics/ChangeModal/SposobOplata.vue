<script setup>
import SVGNalichka from "@/Components/SVG/SVGNalichka.vue";
import { useStatiscticsStore } from "../../../../stores/StatisticsStore";
import SVGPhone from "@/Components/SVG/SVGPhone.vue";
import SVGCredit from "@/Components/SVG/SVGCredit.vue";
import SVGBonus from "@/Components/SVG/SVGBonus.vue";
const statisticsStore = new useStatiscticsStore();
</script>
<template>
   <div class="p-4 border rounded-xl w-full min-h-20 border-gray-200 mt-2 flex flex-col items-center">
        <div class=" mb-2 text-lg">
            ОПЛАТА
        </div>
    <div class="flex gap-3 w-full justify-around">
            <div
            @click="() => (statisticsStore.changeItem.sposob_pay_start = 'Наличные')"
            :class="{
                active: statisticsStore.changeItem.sposob_pay_start === 'Наличные',
            }"
            class="item-oplata cursor-pointer flex items-center justify-center w-2/12 border bg-slate-100 h-14 rounded-xl"
        >
        <div class="w-10">

            <SVGNalichka />
        </div>
        </div>
        <div
            @click="() => (statisticsStore.changeItem.sposob_pay_start = 'Перевод')"
            :class="{
                active: statisticsStore.changeItem.sposob_pay_start == 'Перевод',
            }"
            class="item-oplata cursor-pointer flex items-center justify-center w-2/12 border bg-slate-100 h-14 rounded-xl"
        ><div class="w-8">

            <SVGPhone />
        </div>
        </div>
        <div
            @click="() => (statisticsStore.changeItem.sposob_pay_start = 'Терминал')"
            :class="{
                active: statisticsStore.changeItem.sposob_pay_start == 'Терминал',
            }"
            class="item-oplata cursor-pointer flex items-center justify-center w-2/12 border bg-slate-100 h-14 rounded-xl"
        >
        <div class="w-10">

            <SVGCredit />
        </div>
        </div>
        <div
            @click="() => (statisticsStore.changeItem.sposob_pay_start = 'Бонус')"
            :class="{
                active: statisticsStore.changeItem.sposob_pay_start == 'Бонус',
            }"
            class="item-oplata cursor-pointer flex items-center justify-center w-2/12 border bg-slate-100 h-14 rounded-xl"
        >
            <SVGBonus />
        </div>
        </div>
        <input
                type="tel"
                class="w-2/5 border mt-3 text-center rounded-md  border-gray-300"
                placeholder="Доплата"
                @input="
                    (e) => (statisticsStore.changeItem.money_pay_start = e.target.value.replace(/[^\d.]/g, ''))
                "
                @oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                :value="statisticsStore.changeItem.money_pay_start"
            />
   </div>
</template>

<style>
.item-oplata.active {
    background-color: rgb(215, 246, 200);
}
</style>
