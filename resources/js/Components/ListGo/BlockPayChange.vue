<script setup>
import { useStopStore } from "../../../stores/StopStore";
import SVGClose from "../SVG/SVGClose.vue";
import SVGCredit from "../SVG/SVGCredit.vue";
import SVGNalichka from "../SVG/SVGNalichka.vue";
import SVGPhone from "../SVG/SVGPhone.vue";

const stopStore = new useStopStore();

const props = defineProps({
    item: {
        type: Array,
    },
});
</script>
<template>
    <div class="flex gap-4 justify-center flex-wrap relative mt-2 mb-2">
        <div
            v-if="stopStore.changeItem.sposob_pay_start"
            class="absolute -left-1 top-4"
            @click="stopStore.changeItem.sposob_pay_start = ''"
        >
            <SVGClose />
        </div>
        <div
            @click="() => (stopStore.changeItem.sposob_pay_start = 'Наличные')"
            :class="{
                active: stopStore.changeItem.sposob_pay_start === 'Наличные',
            }"
            class="item-oplata cursor-pointer flex items-center justify-center w-2/12 border bg-slate-100 h-14 rounded-xl"
        >
            <div class="w-10">
                <SVGNalichka />
            </div>
        </div>
        <div
            @click="() => (stopStore.changeItem.sposob_pay_start = 'Перевод')"
            :class="{
                active: stopStore.changeItem.sposob_pay_start === 'Перевод',
            }"
            class="item-oplata cursor-pointer flex items-center justify-center w-2/12 border bg-slate-100 h-14 rounded-xl"
        >
            <div class="w-8">
                <SVGPhone />
            </div>
        </div>
        <div
            @click="() => (stopStore.changeItem.sposob_pay_start = 'Терминал')"
            :class="{
                active: stopStore.changeItem.sposob_pay_start === 'Терминал',
            }"
            class="item-oplata cursor-pointer flex items-center justify-center w-2/12 border bg-slate-100 h-14 rounded-xl"
        >
            <div class="w-10">
                <SVGCredit />
            </div>
        </div>


        <div class="mt-2 h-10 w-full items-center justify-around flex mb-2">
                <div
                    @click="stopStore.changeItem.money_pay_start = 200"
                    class="bg-slate-100 border rounded-xl cursor-pointer p-2 pl-3 pr-3"
                    :class="{
                        '!bg-green-100': stopStore.changeItem.money_pay_start == 200,
                    }"
                >
                    200
                </div>
                <div
                    @click="stopStore.changeItem.money_pay_start = 300"
                    class="bg-slate-100 border rounded-xl cursor-pointer p-2 pl-3 pr-3"
                    :class="{
                        '!bg-green-100': stopStore.changeItem.money_pay_start == 300,
                    }"
                >
                    300
                </div>
                <div
                    @click="stopStore.changeItem.money_pay_start = 450"
                    class="bg-slate-100 border rounded-xl cursor-pointer p-2 pl-3 pr-3"
                    :class="{
                        '!bg-green-100': stopStore.changeItem.money_pay_start == 450,
                    }"
                >
                    450
                </div>
                <div
                    @click="stopStore.changeItem.money_pay_start = 500"
                    class="bg-slate-100 border rounded-xl cursor-pointer p-2 pl-3 pr-3"
                    :class="{
                        '!bg-green-100': stopStore.changeItem.money_pay_start == 500,
                    }"
                >
                    500
                </div>
                <div
                    @click="stopStore.changeItem.money_pay_start = 600"
                    class="bg-slate-100 border rounded-xl cursor-pointer p-2 pl-3 pr-3"
                    :class="{
                        '!bg-green-100': stopStore.changeItem.money_pay_start == 600,
                    }"
                >
                    600
                </div>
            </div>


        <div class="flex items-center gap-2 justify-around w-full">
            <input
                type="tel"
                class="w-2/5 border text-center rounded-md border-gray-500"
                placeholder="Оплата"
                @input="
                    (e) =>
                        (stopStore.changeItem.money_pay_start =
                            e.target.value.replace(/[^0-9]/g, ''))
                "
                :value="stopStore.changeItem.money_pay_start"
            />
            <select
                name="how_time_start"
                id="how-time"
                class="w-2/5 rounded-md mt-2 mb-2"
                @change="
                    (e) => (stopStore.changeItem.time_rent = e.target.value)
                "
            >
                <option selected :value="stopStore.changeItem.time_rent">
                    {{
                        stopStore.changeItem.time_rent == 0
                            ? "ФАКТ"
                            : stopStore.changeItem.time_rent + "мин"
                    }}
                </option>
                <option value="10">10 мин</option>
                <option value="20">20 мин</option>
                <option value="30">30 мин</option>
                <option value="60">1 час</option>
                <option value="120">2 часа</option>
                <option value="180">День</option>
                <option value="240">Сутки</option>
                <option v-if="stopStore.changeItem.time_rent != 0" value="0">
                    ФАКТ
                </option>
            </select>
        </div>
    </div>
</template>
<style>
.item-oplata.active {
    background-color: rgb(215, 246, 200);
}
</style>
