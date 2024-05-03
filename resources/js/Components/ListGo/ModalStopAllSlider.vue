<script setup>
import { ref } from "vue";

import BlockPayStopSlider from "./BlockPayStopSlider.vue";
import TimeGoRaschet from "./TimeGoRaschet.vue";

import { useStopStore } from "../../../stores/StopStore";

const stopStore = new useStopStore();

const props = defineProps({
    item: {
        type: Array,
    },
});
const activeFullPhoto = ref(null);
const sharePay = ref(false);

stopStore.stopInfoAll = props.item;
</script>
<template>
    <div v-for="(el, id) of stopStore.stopInfoAll" :key="el.id">
        <div>
            <div class="text-sm flex items-center gap-2 justify-center mt-2 mx-1 rounded-lg py-1 "
            :style="{'background-color': el.element.color + 'AA'}"
            >
                <img
                    v-if="el.element.image"
                    class="block rounded-md w-7 h-auto"
                    :src="'https://app.welotochka.ru/' + el.element.image"
                    alt=""
                    :class="{
                        img_full_start: activeFullPhoto == el.element.id,
                    }"
                    @click="
                        activeFullPhoto == el.element.id
                            ? (activeFullPhoto = null)
                            : (activeFullPhoto = el.element.id)
                    "
                />
                {{ el.element.name }}
            </div>
        </div>
        <div class="w-3/4 mb-4 m-auto mt-3 border rounded-xl bg-gray-100 h-10">
            <TimeGoRaschet :element="el" :inner="true" />
        </div>
        <div class="flex text-xl justify-around mt-2 mb-2">
            <div
                class="p-5 bg-gray-100 cursor-pointer min-w-24 pl-5 text-center pr-5 border rounded-xl pb-1 relative"
            >
                <span class="absolute top-1 left-4 text-center text-xs"
                    >Стоимость</span
                >
                {{ el.money_full_drive }}
            </div>
            <div
                class="p-5 bg-gray-100 cursor-pointer pl-5 text-center min-w-24 pr-5 border rounded-xl pb-1 relative"
            >
                <span class="absolute top-1 left-4 text-center text-xs"
                    >Оплачено</span
                >
                {{ el.money_pay_start }}
            </div>
            <div
                class="p-5 bg-gray-100 cursor-pointer pl-5 text-center min-w-24 pr-5 border rounded-xl pb-1 relative"
                :class="{ bgRed: el.money_full_drive - el.money_pay_start }"
                @click="
                    (e) =>
                        (stopStore.stopInfoAll[id].money_pay_stop =
                            el.money_full_drive - el.money_pay_start)
                "
            >
                <span class="absolute top-1 left-6 text-center text-xs"
                    >Доплата</span
                >
                {{ el.money_full_drive - el.money_pay_start }}
            </div>
        </div>
        <div
            v-if="el.comment_start"
            class="w-full min-h-12 mb-2 border p-2 rounded-xl"
        >
            {{ el.comment_start }}
        </div>

        <!-- Блок выбора оплаты -->
        <div class="mt-6">
            <BlockPayStopSlider :id="id" />
        </div>

        <div class="mt-2 mb-2">
            <textarea
                class="w-full rounded-xl h-11"
                placeholder="Комментарий"
                @input="
                    (e) => (stopStore.stopInfoAll[id].comment_stop = e.target.value)
                "
                :value="stopStore.stopInfoAll[id].comment_stop"
            ></textarea>
        </div>
        <hr />
        <hr />
        <hr />
    </div>

    <div>
        <div
            @click="() => stopStore.sendStopAllRentSlide()"
            class="w-auto cursor-pointer m-auto flex h-10 mt-6 items-center justify-center p-5 pl-7 pr-7 bg-red-500 text-xl rounded-xl mb-4"
        >
            Парковать раздельно
        </div>
    </div>
</template>
