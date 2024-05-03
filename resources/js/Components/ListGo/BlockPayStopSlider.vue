<script setup>
import { useStopStore } from "../../../stores/StopStore";
import SVGCredit from "../SVG/SVGCredit.vue";
import SVGNalichka from "../SVG/SVGNalichka.vue";
import SVGPhone from "../SVG/SVGPhone.vue";
import SVGBonus from "../SVG/SVGBonus.vue";
import SVGClose from "../SVG/SVGClose.vue";

const stopStore = new useStopStore();

const props = defineProps({
    id: {
        type: Number,
    },
});

</script>
<template>
    <div class="flex gap-4 justify-center flex-wrap mt-2 relative mb-2">
        <div
            v-if="stopStore.stopInfoAll[id].sposob_pay_stop"
            class="absolute -left-1 top-4"
            @click="stopStore.stopInfoAll[id].sposob_pay_stop = ''"
        >
        

            <SVGClose />
       
        </div>
        <div
            @click="() => (stopStore.stopInfoAll[id].sposob_pay_stop = 'Наличные')"
            :class="{
                active: stopStore.stopInfoAll[id].sposob_pay_stop === 'Наличные',
            }"
            class="item-oplata cursor-pointer flex items-center justify-center w-2/12 border bg-slate-100 h-14 rounded-xl"
        >
        <div class=" w-10">

            <SVGNalichka />
        </div>
        </div>
        <div
            @click="() => (stopStore.stopInfoAll[id].sposob_pay_stop = 'Перевод')"
            :class="{
                active: stopStore.stopInfoAll[id].sposob_pay_stop == 'Перевод',
            }"
            class="item-oplata cursor-pointer flex items-center justify-center w-2/12 border bg-slate-100 h-14 rounded-xl"
        >
        <div class=" w-8">
            <SVGPhone />
        </div>
        </div>
        <div
            @click="() => (stopStore.stopInfoAll[id].sposob_pay_stop = 'Терминал')"
            :class="{
                active: stopStore.stopInfoAll[id].sposob_pay_stop == 'Терминал',
            }"
            class="item-oplata cursor-pointer flex items-center justify-center w-2/12 border bg-slate-100 h-14 rounded-xl"
        >
        <div class=" w-10">
            <SVGCredit />

        </div>
        </div>
        <div
            @click="() => (stopStore.stopInfoAll[id].sposob_pay_stop = 'Бонус')"
            :class="{
                active: stopStore.stopInfoAll[id].sposob_pay_stop == 'Бонус',
            }"
            class="item-oplata cursor-pointer flex items-center justify-center w-2/12 border bg-slate-100 h-14 rounded-xl"
        >
            <SVGBonus />
        </div>
        <div class="flex items-center gap-2 justify-around w-full mt-2 mb-2">
            <div
                @click="(e) => (stopStore.stopInfoAll[id].money_pay_stop = 200)"
                class="w-1/5 h-10 bg-slate-100 flex items-center justify-center text-lg cursor-pointer border rounded-md"
                :class="{'!bg-green-100' : stopStore.stopInfoAll[id].money_pay_stop == 200 }"
            >
                200
            </div>
            <div
                @click="(e) => (stopStore.stopInfoAll[id].money_pay_stop = 300)"
                class="w-1/5 h-10 bg-slate-100 flex items-center justify-center text-lg cursor-pointer border rounded-md"
                :class="{'!bg-green-100' : stopStore.stopInfoAll[id].money_pay_stop == 300 }"
            >
                300
            </div>
            <div
                @click="(e) => (stopStore.stopInfoAll[id].money_pay_stop = 450)"
                class="w-1/5 h-10 bg-slate-100 flex items-center justify-center text-lg cursor-pointer border rounded-md"
                :class="{'!bg-green-100' : stopStore.stopInfoAll[id].money_pay_stop == 450 }"
            >
                450
            </div>

            <input
                type="tel"
                class="w-2/5 border text-center rounded-md border-gray-500"
                placeholder="Доплата"
                @input="
                    (e) => (stopStore.stopInfoAll[id].money_pay_stop = e.target.value.replace(/[^\d.]/g, ''))
                "
                @oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                :value="stopStore.stopInfoAll[id].money_pay_stop"
            />
        </div>
    </div>
    
</template>
<style>
.item-oplata.active {
    background-color: rgb(215, 246, 200);
}
</style>
