<script setup>
import SVGInfo from "../SVG/SVGInfo.vue";
import TimeGoRaschet from "./TimeGoRaschet.vue";
import ModalItemInfo from "./ModalItemInfo.vue";
import ModalItemChange from "./ModalItemChange.vue";

import { useStopStore } from "../../../stores/StopStore";
import SVGPause from "../SVG/SVGPause.vue";

const stopStore = new useStopStore();

const props = defineProps({
    innerElement: {
        type: Object,
    },
});
</script>
<template>
    <div
        class="flex flex-col text-sm mb-2 bg-gray-100 p-1 rounded-lg"
        v-for="el of innerElement"
        key="el.id"
    >
        <div class="flex relative items-center justify-between w-full">
            <div class="w-4/12 flex items-center text-xs gap-1 rounded-lg pl-1 mr-2"
            :style="{'background-color': el.element.color + '44'}"
            >
                {{ el.element.name }}
                <div v-if="el.pause_start" class="w-3"><SVGPause /></div>
            </div>
            <div
                @click="() => (stopStore.viewModal.info = el.id)"
                class="flex w-8/12 text-xs justify-between items-center"
            >
                <div class="text-xs w-14">
                    <div>{{ el.time_start }}</div>
                    <div>
                        <TimeGoRaschet v-if="!el.pause_start" :element="el" />
                        <div v-else>{{ el.pause_start }}</div>
                    </div>
                </div>
                <div class="w-10">
                    {{ el.who_start }}
                </div>
                <div class="w-12 text-right">
                    {{ el.money_full_drive - el.money_pay_start }}
                </div>
                <div class="w-6 cursor-pointer z-10">
                    <SVGInfo :item="[el]" />
                </div>
            </div>
        </div>
        <div v-if="el.comment_start" class="text-xs">
            {{ el.comment_start }}
        </div>
        <ModalItemInfo :item="[el]" v-if="stopStore.viewModal.info == el.id" />
        <ModalItemChange
            :item="[el]"
            v-if="stopStore.viewModal.change == el.id"
        />
    </div>
</template>
