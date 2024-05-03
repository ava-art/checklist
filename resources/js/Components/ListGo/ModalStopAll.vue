<script setup>
import BlockPayStop from "./BlockPayStop.vue";
import TimeGoRaschet from "./TimeGoRaschet.vue";
import ModalStopAllSlider from "./ModalStopAllSlider.vue";

import { useStopStore } from "../../../stores/StopStore";
import { ref } from "vue";
import SVGSlider from "../SVG/SVGSlider.vue";

const stopStore = new useStopStore();

const props = defineProps({
    item: {
        type: Array,
    },
});
const activeFullPhoto = ref(null);
const sharePay = ref(false);

const doplata =
    props.item[0].money_full_drive_all - props.item[0].money_full_pay_all;
</script>
<template>
    <div
        class="fixed w-screen h-screen top-0 left-0 z-40 bg-black bg-opacity-80"
        @click.self="() => (stopStore.viewModal.stop_all = {})"
    >
        <div
            class="wrap-modal-all w-11/12 min-h-16 bg-white rounded-xl m-auto mt-12 p-2 pt-0 overflow-y-scroll"
        >
            <div class="" v-if="!sharePay">
                <div
                    class="wrap-go-items items-center pl-1 pr-1 flex flex-wrap gap-1 justify-center text-sm pt-2"
                >
                    <div
                        class="text-sm flex gap-2 items-center border p-1 rounded-md"
                        :style="{'background-color': el.element.color + 'AA'}"
                        v-for="el of item"
                    >
                        <img
                            v-if="el.element.image"
                            class="block rounded-md w-5 h-auto"
                            :src="
                                'https://app.welotochka.ru/' + el.element.image
                            "
                            alt=""
                            :class="{
                                img_full_start:
                                    activeFullPhoto == el.element.id,
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
                <div
                    class="w-3/4 mb-2 m-auto mt-3 border rounded-xl bg-gray-100 h-10"
                >
                    <TimeGoRaschet :element="item[0]" :inner="true" />
                </div>
                <hr />
                <div class="flex text-xl justify-around mt-2 mb-2">
                    <div
                        class="p-5 bg-gray-100 cursor-pointer min-w-24 pl-5 text-center pr-5 border rounded-xl pb-1 relative"
                    >
                        <span class="absolute top-1 left-4 text-center text-xs"
                            >Стоимость</span
                        >
                        {{ item[0].money_full_drive_all }}
                    </div>
                    <div
                        class="p-5 bg-gray-100 cursor-pointer pl-5 text-center min-w-24 pr-5 border rounded-xl pb-1 relative"
                    >
                        <span class="absolute top-1 left-4 text-center text-xs"
                            >Оплачено</span
                        >
                        {{ item[0].money_full_pay_all }}
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

                <div>
                    <BlockPayStop />
                </div>
                <hr />
                <div class="mt-2 mb-2 flex gap-5" >
                    <input
                    type="tel"
                    class="w-2/5 border text-center rounded-md border-gray-500"
                    placeholder="Доплата"
                    @input="
                            (e) =>
                                (stopStore.stopInfo.money_pay_stop =
                                e.target.value.replace(/[^\d.]/g, ''))
                        "
                        @oninput="
                            this.value = this.value.replace(/[^0-9]/g, '')
                        "
                        :value="stopStore.stopInfo.money_pay_stop"
                        />
                        <textarea
                            class="w-full rounded-xl h-11"
                            placeholder="Комментарий"
                            @input="
                                (e) =>
                                    (stopStore.stopInfo.comment_stop =
                                        e.target.value)
                            "
                            :value="stopStore.stopInfo.comment_stop"
                        ></textarea>
                </div>
                <div>
                    <div
                        @click="() => stopStore.sendStopAllRent(item)"
                        class="w-auto cursor-pointer m-auto flex h-10 items-center justify-center p-5 pl-7 pr-7 bg-red-500 text-xl rounded-xl mb-2"
                    >
                        Парковать всех
                    </div>
                </div>
            </div>
            <div v-else>
                <ModalStopAllSlider :item="item" />
            </div>
        </div>
        <div
            @click="sharePay = !sharePay"
            :class="{ 'rotate-90': sharePay }"
            class="w-14 rounded-full fixed bottom-8 left-4 bg-white transition-all p-2"
        >
            <SVGSlider />
        </div>
    </div>
</template>

<style>
.bgRed {
    background-color: rgb(228, 159, 159);
}
</style>
