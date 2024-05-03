<script setup>
import HomeCar from "../SVG/HomeCar.vue";
import HomeVelo from "../SVG/HomeVelo.vue";
import HomeSamokat from "../SVG/HomeSamokat.vue";
import HomeGiro from "../SVG/HomeGiro.vue";
import HomeKart from "../SVG/HomeKart.vue";
import HomeRoller from "../SVG/HomeRoller.vue";

import { useStatiscticsStore } from "../../../stores/StatisticsStore";
const statisticsStore = new useStatiscticsStore();
</script>

<template>
    <ul
        class="category-list stat items-center flex mt-6 container-custom justify-between"
    >
        <div
            class="category-item stat"
            :class="{ active: statisticsStore.checkCategory['Машинки'] }"
            @click="statisticsStore.changeCategory('Машинки')"
        >
            <HomeCar />
        </div>
        <div
            class="category-item stat"
            :class="{ active: statisticsStore.checkCategory['Велосипеды'] }"
            @click="statisticsStore.changeCategory('Велосипеды')"
        >
            <HomeVelo />
        </div>
        <div
            class="category-item stat"
            :class="{ active: statisticsStore.checkCategory['Самокаты'] }"
            @click="statisticsStore.changeCategory('Самокаты') "
        >
            <HomeSamokat />
        </div>
        <div
            class="category-item stat"
            :class="{ active: statisticsStore.checkCategory['Гироскутеры'] }"
            @click="statisticsStore.changeCategory('Гироскутеры')"
        >
            <HomeGiro />
        </div>
        <div
            class="category-item stat"
            :class="{ active: statisticsStore.checkCategory['Картинг'] }"
            @click="statisticsStore.changeCategory('Картинг')"
        >
            <HomeKart />
        </div>
        <div
            class="category-item stat"
            :class="{ active: statisticsStore.checkCategory['Ролики'] }"
            @click="statisticsStore.changeCategory('Ролики')"
        >
            <HomeRoller />
        </div>
    </ul>
</template>

<style>
.category-item.stat {
    width: 12%;
    max-width: 45px;
    height: 36px;
    border-radius: 12px;
    display: flex;
    cursor: pointer;
    padding: 6px;
    padding-left: 10px;
    padding-right: 10px;
    background: #fff;
    transition: all 0.1s linear;
}
.category-item.stat.active {
    background: #e7e7e7;
}
</style>
