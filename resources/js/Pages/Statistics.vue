<script setup>
import { Head } from "@inertiajs/vue3";
import Header from "../Components/Header.vue";

import ListCategories from "../Components/Statistics/ListCategories.vue"
import AdminPanel from "../Components/Statistics/AdminPanel.vue"

import { useStatiscticsStore } from "../../stores/StatisticsStore";
import ListRentStatistics from "@/Components/Statistics/ListRentStatistics.vue";
import ModalRashod from "@/Components/Statistics/ModalRashod.vue";
import ModalAccesory from "@/Components/Statistics/ModalAccesory.vue";
const statisticsStore = new useStatiscticsStore();

statisticsStore.getStatistic();

</script>

<template>
    <Head title="Статистика" />
    <Header />
    <div v-if="$page.props.auth.user" class="container-custom">
       <div v-if="$page.props.auth.user.role != 'stag'" class=" p-4">
            <ListCategories />
            <AdminPanel  />
            <ListRentStatistics  />

            <ModalRashod v-if="statisticsStore.viewRashod" />
            <ModalAccesory v-if="statisticsStore.viewAcessory" />
       </div>
    </div>

</template>

<style></style>
