<script setup>
import SposobPayPanel from "./SposobPayPanel.vue";
import Thumblers from "./Thumblers.vue";
import { usePage } from "@inertiajs/vue3";
import { useStatiscticsStore } from "../../../stores/StatisticsStore";
import { ref } from "vue";
const statisticsStore = new useStatiscticsStore();
const roleUser = usePage().props.auth.user.role;

const viewPanel = ref(false);
</script>
<template>
    <div class="my-3 border border-red-400 p-2 pt-0 rounded-xl">
        <div @click="viewPanel = !viewPanel" class="h-3"></div>
        <div class="elemet-block-info w-full"
        :class="{show : viewPanel}">
            <div style="min-height: 0" class="w-full">
                <div
                    class="w-full gap-2 flex items-center inner-admin-panel justify-between"
                    v-if="roleUser == 'admins'"
                >
                    <select
                        @change="
                            (e) =>
                                statisticsStore.changeCheckedUser(
                                    e.target.value
                                )
                        "
                        class="h-10 w-1/3 rounded-xl border-gray-300"
                    >
                        <option value="all">все</option>
                        <option
                            v-for="user of statisticsStore.allUsers"
                            :value="user"
                        >
                            {{ user }}
                        </option>
                    </select>
                    <div
                        class="border flex gap-2 w-2/3 items-center px-1 pr-3 h-12 rounded-xl"
                    >
                        <input
                            type="date"
                            class="w-1/2 rounded-xl h-10 border-gray-300"
                            @input="
                                (e) => (
                                    (statisticsStore.dateInput.start =
                                        e.target.value),
                                    statisticsStore.getStatistic()
                                )
                            "
                            :value="statisticsStore.dateInput.start"
                        />
                        <input
                            type="date"
                            class="w-1/2 rounded-xl h-10 border-gray-300"
                            @input="
                                (e) => (
                                    (statisticsStore.dateInput.stop =
                                        e.target.value),
                                    statisticsStore.getStatistic()
                                )
                            "
                            :value="statisticsStore.dateInput.stop"
                        />
                    </div>
                </div>
                <SposobPayPanel v-if="roleUser != 'worker'" />
                <Thumblers />
                <div
                    v-if="roleUser != 'worker'"
                    class="text-base bg-white w-1/2 mx-auto mt-3 mb-1 rounded-lg text-center"
                >
                    {{ statisticsStore.moneyFull }}
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.inner-admin-panel{
    max-width: 86vw;
}
</style>