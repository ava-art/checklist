<script setup>
import BlockPayStop from "./BlockPayStop.vue";
import TimeGoRaschet from "./TimeGoRaschet.vue";

import { useStopStore } from "../../../stores/StopStore";
import EditItemInfo from "../SVG/EditItemInfo.vue";
import { ref } from "vue";
import SVGPause from "../SVG/SVGPause.vue";
import SVGPlay from "../SVG/SVGPlay.vue";

const stopStore = new useStopStore();

const props = defineProps({
    item: {
        type: Array,
    },
});
const activeFullPhoto = ref(null);
stopStore.stopInfo = props.item[0];
const doplata = props.item[0].money_full_drive - props.item[0].money_pay_start;
</script>
<template>
    <div
        class="fixed w-screen h-screen top-0 left-0 z-40 bg-black bg-opacity-80"
        @click.self="() => (stopStore.viewModal = {})"
    >
        <div
            class="wrap-modal-all w-11/12 min-h-16 bg-white rounded-xl m-auto mt-12 p-2 pt-0 overflow-y-scroll"
        >
            <div
                class="wrap-go-items items-center pl-8 pr-8 flex flex-wrap gap-2 justify-center text-sm"
            >
                <img
                    v-if="stopStore.stopInfo.element.image"
                    class="block rounded-md w-7"
                    :src="
                        'https://app.welotochka.ru/' +
                        stopStore.stopInfo.element.image
                    "
                    alt=""
                    :class="{
                        img_full_start:
                            activeFullPhoto == stopStore.stopInfo.id,
                    }"
                    @click="
                        activeFullPhoto == stopStore.stopInfo.id
                            ? (activeFullPhoto = null)
                            : (activeFullPhoto = stopStore.stopInfo.id)
                    "
                />
                <div class="text-xl flex gap-2 items-center" v-for="el of item">
                    {{ el.element.name }}
                    <div v-if="el.pause_start" class="w-3"><SVGPause /></div>
                </div>
            </div>
            <div
                class="w-3/4 mb-2 m-auto mt-3 border rounded-xl bg-gray-100 h-10"
            >
                <TimeGoRaschet  v-if="!item[0].pause_start" :element="item[0]" :inner="true" />
                <div class=" text-3xl text-center" v-else> {{item[0].pause_start  }}</div>
            </div>
            <hr />
            <div class="flex text-xl justify-around mt-2 mb-2">
                <div
                    class="p-5 bg-gray-100 cursor-pointer min-w-24 pl-5 text-center pr-5 border rounded-xl pb-1 relative"
                >
                    <span class="absolute top-1 left-4 text-center text-xs"
                        >Стоимость</span
                    >
                    {{ item[0].money_full_drive }}
                </div>
                <div
                    class="p-5 bg-gray-100 cursor-pointer pl-5 text-center min-w-24 pr-5 border rounded-xl pb-1 relative"
                >
                    <span class="absolute top-1 left-4 text-center text-xs"
                        >Оплачено</span
                    >
                    {{ item[0].money_pay_start }}
                </div>
                <div
                    class="p-5 bg-gray-100 cursor-pointer pl-5 text-center min-w-24 pr-5 border rounded-xl pb-1 relative"
                    :class="{ bgRed: doplata }"
                    @click="
                        (e) => (stopStore.stopInfo.money_pay_stop = doplata)
                    "
                >
                    <span class="absolute top-1 left-6 text-center text-xs"
                        >Доплата</span
                    >
                    {{ doplata }}
                </div>
            </div>
            <div
                v-if="item.comment_start"
                class="w-full min-h-12 mb-2 border p-2 rounded-xl"
            >
                {{ item.comment_start }}
            </div>
            <hr />
            <!-- Блок выбора оплаты -->
            <div>
                <BlockPayStop />
            </div>
            <hr />
            <div class="mt-2 mb-2 flex gap-5">
                <input
                type="tel"
                class="w-2/5 border text-center rounded-md border-gray-500"
                placeholder="Доплата"
                @input="
                    (e) => (stopStore.stopInfo.money_pay_stop = e.target.value.replace(/[^\d.]/g, ''))
                "
                @oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                :value="stopStore.stopInfo.money_pay_stop"
                />
                <textarea
                    class="w-full rounded-xl h-11"
                    placeholder="Комментарий"
                    @input="
                        (e) =>
                            (stopStore.stopInfo.comment_stop = e.target.value)
                    "
                    :value="stopStore.stopInfo.comment_stop"
                ></textarea>
            </div>
            <div>
                <div
                    @click="() => stopStore.sendStopItemRent(item)"
                    class="w-3/5 cursor-pointer m-auto flex h-10 items-center justify-center p-5 pl-7 pr-7 bg-red-500 text-xl rounded-xl mb-2"
                >
                    Парковать
                </div>
            </div>
        </div>
        <div class="fixed bottom-6 left-4 flex items-center gap-4">
            <div
                @click="() => stopStore.setPause(item[0])"
                v-if="!item[0].pause_start"
                class="w-14 h-14 p-4 cursor-pointer bg-white rounded-full flex items-center justify-center"
            >
                <SVGPause class="max-w-8" />
            </div>
            <div
                @click="() => stopStore.deletePause(item[0])"
                v-if="item[0].pause_start"
                class="w-14 h-14 p-4 cursor-pointer bg-white rounded-full flex items-center justify-center"
            >
                <SVGPlay class="max-w-8" />
            </div>
            <div
                @click="
                    () =>
                        (stopStore.viewModal = {
                            info: null,
                            change: item[0].id,
                        })
                "
                class="w-14 h-14 cursor-pointer bg-white rounded-full flex items-center justify-center"
            >
                <EditItemInfo class="max-w-8" />
            </div>
        </div>
    </div>
</template>

<style>
.bgRed {
    background-color: rgb(228, 159, 159);
}
</style>
