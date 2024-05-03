<script setup>
import { ref } from "vue";
import { useStatiscticsStore } from "../../../stores/StatisticsStore";
import SVGMinusSquare from "../SVG/SVGMinusSquare.vue";
import ViewIconCategory from "../ListGo/ViewIconCategory.vue";
import ViewIconSposobOplat from "../ListGo/ViewIconSposobOplat.vue";
import ModalChangeItemStat from "./ModalChangeItemStat.vue";
const statisticsStore = new useStatiscticsStore();

const props = defineProps({
    rent: {
        type: Object,
    },
    id: {
        type: Number,
    },
    viewInfoItem: {
        type: Array
    }
});
const activeFullPhoto = ref(false);
</script>
<template>
    <hr />
    <div class="p-2">
        <div class="flex gap-3 items-center text-xs mb-2">
            <div class="flex gap-2 w-1/5">
                <div
                    class="w-4"
                    @click="statisticsStore.deletePhoto(rent[0].id)"
                >
                    <SVGMinusSquare />
                </div>
                <div class="w-8 h-8 rounded-lg">
                    <img
                        v-if="viewInfoItem.includes(id)"
                        class="rounded-lg w-full h-full"
                        :src="'https://app.welotochka.ru/' + rent[0].photo"
                        alt=""
                        @click="activeFullPhoto = !activeFullPhoto"
                        :class="{ img_full: activeFullPhoto }"
                    />
                </div>
            </div>
            <div class="w-2/5">
                <a class=" " :href="'tel:' + rent[0].phone">{{
                    rent[0].phone
                }}</a>
            </div>

            <div class="flex flex-col w-1/5 text-center">
                <span>{{ rent[0].who_start }}</span>
                <span>{{ rent[0].who_stop }}</span>
            </div>
            <div class="flex flex-col text-right pr-2 w-1/5">
                <span>{{ rent[0].money_pay_start_all }}</span>
                <span>{{ rent[0].money_pay_stop_all }}</span>
            </div>
        </div>
        <hr />
        <hr />
        <hr />
        <div class="text-xs">
            <div v-for="item of rent" class="relative">
                <div
                    class="border-b"
                    @click="statisticsStore.viewModal = item.id"
                >
                    <div v-if="(rent[0].money_pay_stop + rent[0].money_pay_start) < rent[0].money_full_drive"
                        class="w-3 h-3 bg-red-500 absolute top-3 -right-1 opacity-60 rounded-full"
                    ></div>
                    <div
                        class="flex mt-1 p-1 items-center w-full justify-between"
                    >
                        <div class="flex items-center w-4/12">
                            <div class="w-3">
                                <ViewIconCategory
                                    :category="item.category.name"
                                />
                            </div>
                            <div class="text-xs ml-1">
                                {{ item.element.name }}
                            </div>
                        </div>
                        <div class="w-3/12">
                            {{ item.date_start }}
                        </div>
                        <div class="w-3/12 flex flex-col">
                            <span>{{ item.time_start }}</span>
                            <span>{{ item.time_stop }}</span>
                        </div>
                        <div class="w-2/12 flex flex-col">
                            <div
                                class="flex items-center gap-1 justify-between pr-2"
                            >
                                <span class="w-3">
                                    <ViewIconSposobOplat
                                        :sposob="item.sposob_pay_start"
                                    />
                                </span>
                                <span class="">{{ item.money_pay_start }}</span>
                            </div>
                            <div
                                class="flex items-center gap-1 justify-between pr-2"
                            >
                                <span class="w-3">
                                    <ViewIconSposobOplat
                                        :sposob="item.sposob_pay_stop"
                                    />
                                </span>
                                <span>{{ item.money_pay_stop }}</span>
                            </div>
                        </div>
                    </div>
                    <div v-if="item.comment_start">
                        Старт: {{ item.comment_start }}
                    </div>
                    <div v-if="item.comment_stop">
                        Стоп: {{ item.comment_stop }}
                    </div>
                </div>

                <ModalChangeItemStat
                    v-if="statisticsStore.viewModal == item.id && $page.props.auth.user.role == 'admins'"
                    :item="item"
                />
            </div>
        </div>

    </div>
</template>
