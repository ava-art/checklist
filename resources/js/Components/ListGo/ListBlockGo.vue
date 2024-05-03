<script setup>
import { ref } from "vue";

import PlusItem from "../SVG/PlusItem.vue";
import ViewIconCategory from "./ViewIconCategory.vue";

import ViewHowTimeRent from "./ViewHowTimeRent.vue";
import InnerElement from "./InnerElement.vue";
import { useRentItemsStore } from "../../../stores/RentItemsStore";
import { useHomeStore } from "../../../stores/HomeStore";
import { useAddStore } from "../../../stores/AddStore";
import { useStopStore } from "../../../stores/StopStore";
import ModalOformAdd from "./ModalOformAdd.vue";
import ModalStopAll from "./ModalStopAll.vue";
import SVGStop from "../SVG/SVGStop.vue";
import SVGPause from "../SVG/SVGPause.vue";
import SVGQr from "../SVG/SVGQr.vue";
import LoaderKoleso from "../LoaderKoleso.vue";

const rentItemsStore = new useRentItemsStore();
const homeStore = new useHomeStore();
const stopStore = new useStopStore();
const addStore = new useAddStore();

const viewInfoItem = ref([]);

const activeFullPhoto = ref("");
const clickMoreInfo = (idx) => {
    !viewInfoItem.value.includes(idx)
        ? viewInfoItem.value.push(idx)
        : (viewInfoItem.value = viewInfoItem.value.filter((el) => el != idx));
};
rentItemsStore.getRentItems();
setInterval(() => rentItemsStore.getRentItems(), 15000);
</script>
<template>
    <div class="mt-6" v-if="!rentItemsStore.allRentItems">
        <LoaderKoleso />
    </div>
    <div v-else class="p-2 pt-0 container-custom">
        <div
            class="flex gap-0 border p-2 pb-0 flex-col relative text-sm rounded-lg bg-white mb-1"
            v-for="(item, id) of rentItemsStore.allRentItems"
            key="item[0].id"
        >
            <div
                v-if="item[0].money_full_drive_all > item[0].money_full_pay_all"
                class="glowing-stop absolute w-4 h-4 top-1 right-1 rounded-lg"
                :class="{
                    active:
                        item[0].beetwenMin + 1 > item[0].time_rent &&
                        item[0].time_rent < 122 &&
                        item[0].time_rent != 0,
                }"
            ></div>
            <div
                v-else
                class="glowing-success absolute w-4 h-4 top-1 right-1 rounded-lg"
                :class="{
                    active:
                        item[0].beetwenMin + 1 > item[0].time_rent &&
                        item[0].time_rent < 122 &&
                        item[0].time_rent != 0,
                }"
            ></div>

            <div class="flex gap-3">
                <div class="w-6">
                    <ViewIconCategory :category="item[0].category.name" />
                </div>
                <div class="flex-col flex w-full">
                    <div class="flex h-5" @click="() => clickMoreInfo(id)">
                        <div class="w-4/5">
                            <a :href="'tel:' + item[0].phone">{{
                                item[0].phone
                            }}</a>
                            <ViewHowTimeRent :time="item[0].time_rent" />
                        </div>
                        <div class="w-1/5">
                            {{
                                item[0].money_full_drive_all -
                                item[0].money_full_pay_all
                            }}
                        </div>
                    </div>
                    <div
                        class="flex gap-1 min-h-4 flex-wrap leading-2"
                        @click="() => clickMoreInfo(id)"
                    >
                        <div
                            class="list-go-elements flex-wrap flex items-center gap-1"
                            v-for="it of item"
                        >
                            <span class="block">{{ it.element.name }}</span>
                            <div v-if="it.pause_start" class="w-2">
                                <SVGPause />
                            </div>
                            <span class="block"> |</span>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="elemet-block-info mt-1"
                :class="viewInfoItem.includes(id) ? 'show' : ''"
            >
                <div style="min-height: 0">
                    <hr />
                    <div class="w-full text-sm mt-1" id="0" alt="''">
                        <div class="flex gap-2 w-full">
                            <img
                                v-if="viewInfoItem.includes(id)"
                                class="w-12 h-14 rounded-xl"
                                @click="
                                    activeFullPhoto != item[0].photo
                                        ? (activeFullPhoto = item[0].photo)
                                        : (activeFullPhoto = ''),
                                        console.log(activeFullPhoto)
                                "
                                :class="{
                                    img_full: activeFullPhoto == item[0].photo,
                                }"
                                :src="
                                    'https://app.welotochka.ru/' + item[0].photo
                                "
                            />
                            <div class="w-full">
                                <InnerElement :innerElement="item" />
                                <hr />
                            </div>
                        </div>
                        <div class="flex justify-start gap-6 items-center">
                            <div
                                class="w-6 mt-2 mr-0 mb-2 cursor-pointer"
                                @click="
                                    stopStore.viewModal.stop_all = item[0].phone
                                "
                            >
                                <SVGStop />
                            </div>
                            <div
                                class="w-6 mt-2 mr-0 mb-2 cursor-pointer"
                                @click="
                                    (stopStore.viewModal.add = item[0].id),
                                        (addStore.addItem = item[0])
                                "
                            >
                                <PlusItem />
                            </div>

                            <div v-if="stopStore.thisUser.role == 'admins'" class="w-5 mt-2 mr-0 mb-2 cursor-pointer">
                                <a target="_blank" :href="'https://welotochka.ru/status-poezdki?qr-code='+item[0].element.qr">
                                    <SVGQr />
                                </a>
                            </div>
                        </div>
                    </div>
                    <ModalOformAdd
                        v-if="stopStore.viewModal.add == item[0].id"
                        :item="item[0]"
                    />
                    <ModalStopAll
                        v-if="stopStore.viewModal.stop_all == item[0].phone"
                        :item="item"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<style>
@keyframes glowing {
    0% {
        background-color: #e81919;
        box-shadow: 0 0 15px #e81919;
    }
    50% {
        background-color: #9f3030;
        box-shadow: -70px 0 15px #e81919;
    }
    100% {
        background-color: #e81919;
        box-shadow: 0px 0px 15px #e81919;
    }
}
@keyframes glowing-succes {
    0% {
        background-color: #19e820;
        box-shadow: 0 0 15px #19e820;
    }
    50% {
        background-color: #1dad21;
        box-shadow: -70px 0 15px #108e14;
    }
    100% {
        background-color: #19e820;
        box-shadow: 0 0 15px #19e820;
    }
}
.glowing-stop {
    background-color: #e8191989;
}
.glowing-stop.active {
    animation: glowing 1300ms infinite;
}
.glowing-success {
    background-color: #19e82089;
}
.glowing-success.active {
    animation: glowing-succes 1300ms infinite;
}
.elemet-block-info {
    display: grid;
    overflow: hidden;
    grid-template-rows: 0fr;
    transition: all 0.16s linear;
}
.list-go-elements {
    font-size: 10px;
    font-weight: 400;
}
.elemet-block-info.show {
    grid-template-rows: 1fr;
}
.leading-2 {
    line-height: 10px;
}
</style>
