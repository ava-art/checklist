<script setup>
import { useStopStore } from "../../../stores/StopStore";
import SVGCredit from "../SVG/SVGCredit.vue";
import SVGNalichka from "../SVG/SVGNalichka.vue";
import SVGPhone from "../SVG/SVGPhone.vue";
import SVGBonus from "../SVG/SVGBonus.vue";
import SVGClose from "../SVG/SVGClose.vue";

const stopStore = new useStopStore();


</script>
<template>
    <div class="flex gap-4 justify-center flex-wrap mt-2 relative mb-2">
        <div
            v-if="stopStore.stopInfo.sposob_pay_stop"
            class="absolute -left-1 top-4"
            @click="stopStore.stopInfo.sposob_pay_stop = ''"
        >
        
            <SVGClose />
        </div>
        <div
            @click="() => (stopStore.stopInfo.sposob_pay_stop = 'Наличные')"
            :class="{
                active: stopStore.stopInfo.sposob_pay_stop === 'Наличные',
            }"
            class="item-oplata cursor-pointer flex items-center justify-center w-2/12 border bg-slate-100 h-14 rounded-xl"
        >
        <div class="w-10">

            <SVGNalichka />
        </div>
        </div>
        <div
            @click="() => (stopStore.stopInfo.sposob_pay_stop = 'Перевод')"
            :class="{
                active: stopStore.stopInfo.sposob_pay_stop == 'Перевод',
            }"
            class="item-oplata cursor-pointer flex items-center justify-center w-2/12 border bg-slate-100 h-14 rounded-xl"
        ><div class="w-8">

            <SVGPhone />
        </div>
        </div>
        <div
            @click="() => (stopStore.stopInfo.sposob_pay_stop = 'Терминал')"
            :class="{
                active: stopStore.stopInfo.sposob_pay_stop == 'Терминал',
            }"
            class="item-oplata cursor-pointer flex items-center justify-center w-2/12 border bg-slate-100 h-14 rounded-xl"
        >
        <div class="w-10">

            <SVGCredit />
        </div>
        </div>
        <div
            @click="() => (stopStore.stopInfo.sposob_pay_stop = 'Бонус')"
            :class="{
                active: stopStore.stopInfo.sposob_pay_stop == 'Бонус',
            }"
            class="item-oplata cursor-pointer flex items-center justify-center w-2/12 border bg-slate-100 h-14 rounded-xl"
        >
            <SVGBonus />
        </div>
        <div class="flex items-center gap-2 justify-around w-full mt-2 mb-2">
            <div
                @click="(e) => (stopStore.stopInfo.money_pay_stop = 200)"
                class="w-1/5 h-10 bg-slate-100 flex items-center justify-center text-lg cursor-pointer border rounded-md"
                :class="{'!bg-green-100' : stopStore.stopInfo.money_pay_stop == 200 }"
            >
                200
            </div>
            <div
                @click="(e) => (stopStore.stopInfo.money_pay_stop = 300)"
                class="w-1/5 h-10 bg-slate-100 flex items-center justify-center text-lg cursor-pointer border rounded-md"
                :class="{'!bg-green-100' : stopStore.stopInfo.money_pay_stop == 300 }"
            >
                300
            </div>
            <div
                @click="(e) => (stopStore.stopInfo.money_pay_stop = 450)"
                class="w-1/5 h-10 bg-slate-100 flex items-center justify-center text-lg cursor-pointer border rounded-md"
                :class="{'!bg-green-100' : stopStore.stopInfo.money_pay_stop == 450 }"
            >
                450
            </div>
            <div
                @click="(e) => (stopStore.stopInfo.money_pay_stop = 500)"
                class="w-1/5 h-10 bg-slate-100 flex items-center justify-center text-lg cursor-pointer border rounded-md"
                :class="{'!bg-green-100' : stopStore.stopInfo.money_pay_stop == 500 }"
            >
                500
            </div>
            <div
                @click="(e) => (stopStore.stopInfo.money_pay_stop = 600)"
                class="w-1/5 h-10 bg-slate-100 flex items-center justify-center text-lg cursor-pointer border rounded-md"
                :class="{'!bg-green-100' : stopStore.stopInfo.money_pay_stop == 600 }"
            >
                600
            </div>

           
        </div>
    </div>
    
</template>
<style>
.item-oplata.active {
    background-color: rgb(215, 246, 200);
}
</style>
