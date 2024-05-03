<script setup>
import { useStatiscticsStore } from "../../../stores/StatisticsStore";
const statisticsStore = new useStatiscticsStore();
</script>
<template>
    <div class="flex justify-between mt-3 gap-2 items-center">
        <div class="w-1/3 flex bg-white items-center rounded-xl flex-col">
            <span
                class="text-sm block w-full text-center"
                @click="statisticsStore.viewRashod = true"
                >Расходы</span
            >
            <span
                class="text-sm block w-full text-center"
                >{{ statisticsStore.Rashod.sum }}</span
            >
            <span class="thumbler">
                <label class="switch">
                    <input
                        @input="
                            (e) =>
                                statisticsStore.changeCheckedRashod(
                                    e.target.value
                                )
                        "
                        checked
                        type="checkbox"
                    />
                    <span class="slider round"></span>
                </label>
            </span>
        </div>
        <div class="w-1/3 flex bg-white items-center rounded-xl flex-col">
            <span
                class="text-sm block w-full text-center"
                @click="statisticsStore.viewAcessory = true"
                >Аксессуары</span
            >
            <span
                class="text-sm block w-full text-center"
                >{{ statisticsStore.Acessory.sum }}</span
            >
            <span class="thumbler">
                <label class="switch">
                    <input
                        @input="
                            (e) =>
                                statisticsStore.changeCheckedAcessory(
                                    e.target.value
                                )
                        "
                        type="checkbox"
                        checked
                    />
                    <span class="slider round"></span>
                </label>
            </span>
        </div>
        <!-- <div class="w-1/3 flex bg-white items-center rounded-xl flex-col">
            <span class="text-sm">Зарплата %</span>
            <span class="text-sm">8000</span>
            <span class="thumbler">
                <label class="switch">
                    <input @input="e => console.log(e.target.checked)" type="checkbox" />
                    <span class="slider round"></span>
                </label>
            </span>
        </div> -->
    </div>
</template>

<style>
.switch {
    position: relative;
    display: inline-block;
    width: 40px;
    height: 24px;
}

/* Hide default HTML checkbox */
.switch input {
    display: none;
}

/* The slider */
.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: 0.4s;
    transition: 0.4s;
}

.slider:before {
    position: absolute;
    content: "";
    height: 16px;
    width: 16px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: 0.4s;
    transition: 0.4s;
}

.thumbler input:checked + .slider {
    background-color: #2196f3;
}

.thumbler input:focus + .slider {
    box-shadow: 0 0 1px #2196f3;
}

.thumbler input:checked + .slider:before {
    -webkit-transform: translateX(16px);
    -ms-transform: translateX(16px);
    transform: translateX(16px);
}

/* Rounded sliders */
.slider.round {
    border-radius: 34px;
}

.slider.round:before {
    border-radius: 50%;
}
</style>
