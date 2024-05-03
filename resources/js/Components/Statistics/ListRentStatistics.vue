<script setup>
import { ref } from "vue";
import { useStatiscticsStore } from "../../../stores/StatisticsStore";
import ViewHowTimeRent from "../ListGo/ViewHowTimeRent.vue";
import ViewIconCategory from "../ListGo/ViewIconCategory.vue";
import InnerItemRentStatistics from "./InnerItemRentStatistics.vue";
import LoaderKoleso from "../LoaderKoleso.vue";
const statisticsStore = new useStatiscticsStore();

const viewInfoItem = ref([]);

const clickMoreInfo = (idx) => {
    !viewInfoItem.value.includes(idx)
        ? viewInfoItem.value.push(idx)
        : (viewInfoItem.value = viewInfoItem.value.filter((el) => el != idx));
};
</script>
<template>
    <div>
        <div
            v-for="(rent, id) of statisticsStore.listElements"
            :key="rent.id"
            class="border relative min-h-8 rounded-lg bg-white mb-2 h-auto"
         
        >
            <div
                class="w-1 h-full bg-red-500 absolute top-0 right-0 opacity-60 rounded-full"
                v-if="rent[0].money_full_drive_all > rent[0].money_pay_full"
            ></div>
            <div class="stat-list-item" v-if="rent[0]">
                <div
                    class="stat-item-top flex items-center text-xs"
                    @click="() => clickMoreInfo(id)"
                >
                    <div class="flex w-7/12 flex-col p-1 gap-1 mt-1">
                        <div
                            class="w-full flex gap-1 text-xs"
                            v-for="item of rent"
                        >
                            <div class="w-4">
                                <ViewIconCategory
                                    :category="item.category.name"
                                />
                            </div>
                            <span class=" flex justify-between w-full">
                                <span>
                                    {{ item.element.name }}
                                </span>
                                <span class=" min-w-9">
                                    <ViewHowTimeRent :time="item.time_rent" />
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="w-3/12 flex flex-col items-center">
                        <span>
                            {{ rent[0].time_start }}
                        </span>
                        <span v-if="rent[0].pause_start">
                            |{{ rent[0].pause_start }}|
                        </span>
                        <span>
                            {{ rent[0].time_stop }}
                        </span>
                    </div>
                    <div class="w-2/12 flex flex-col items-center">
                        {{ rent[0].money_pay_full }}
                    </div>
                </div>
                <div class="stat-item-bottom">
                    <div
                        class="elemet-block-info mt-1"
                        :class="viewInfoItem.includes(id) ? 'show' : ''"
                    >
                        <div style="min-height: 0">
                            <InnerItemRentStatistics :rent="rent" :viewInfoItem="viewInfoItem" :id="id" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="statisticsStore.loader" class=" mt-10">
            <LoaderKoleso />
        </div>
    </div>
</template>

<style>
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
</style>
