<script setup>
import { ref } from "vue";
import { useStopStore } from "../../../stores/StopStore";
import { useAddStore } from "../../../stores/AddStore";
import SVGNalichka from "../SVG/SVGNalichka.vue";
import SVGPhone from "../SVG/SVGPhone.vue";
import SVGCredit from "../SVG/SVGCredit.vue";
import SVGBackTime from "../SVG/SVGBackTime.vue";
import SVGClose from "../SVG/SVGClose.vue";

const stopStore = new useStopStore();
const addStore = new useAddStore();

const activeOtherTime = ref(false);
const showButtonMoney = ref(false);

addStore.getCategories();
addStore.getElements(addStore.addItem.category_id);
addStore.addItem.time_rent = 0;
addStore.addItem.money_pay_start = 0;
addStore.addItem.sposob_pay_start = "";
</script>

<template>
    <div
        class="modal-oform fixed h-screen w-screen left-0 z-50 bg-opacity-80 bg-black top-0"
        :class="{ active: stopStore.viewModal.add == addStore.addItem.id }"
        @click.self="stopStore.viewModal.add = null"
    >
        <div
            class="wrap-modal-all w-11/12 min-h-16 bg-white rounded-xl m-auto mt-12 p-2 pt-0 overflow-y-scroll"
        >
            <div class="text-lg font-medium text-center">
                Добавление к {{ addStore.addItem.phone }}
            </div>
            <hr />
            <div
                class="wrap-go-items items-center flex flex-wrap gap-2 justify-center text-sm"
            >
                <select
                    class="w-5/12 rounded-md mt-2 mb-2"
                    @change="
                        (e) => (
                            (addStore.addItem.category_id = e.target.value),
                            addStore.getElements(e.target.value)
                        )
                    "
                >
                    <option selected :value="addStore.addItem.category.id">
                        {{ addStore.addItem.category.name }}
                    </option>

                    <option
                        v-for="el of addStore.addItem.categories"
                        :value="el.id"
                    >
                        {{ el.name }}
                    </option>
                </select>
                <select
                    class="w-6/12 rounded-md mt-2 mb-2"
                    @change="
                        (e) => (addStore.addItem.element_id = e.target.value)
                    "
                >
                    <option
                        v-for="el of addStore.addItem.elements"
                        :value="el.id"
                    >
                        {{ el.name }}
                    </option>
                </select>
            </div>

            <hr />

            <div class="flex gap-4 justify-center relative flex-wrap mt-2 mb-2">
                <div
                    v-if="addStore.addItem.sposob_pay_start"
                    class="absolute -left-1 top-4"
                    @click="addStore.addItem.sposob_pay_start = ''"
                >
                    <SVGClose />
                </div>
                <div
                    @click="
                        () => (addStore.addItem.sposob_pay_start = 'Наличные')
                    "
                    :class="{
                        active:
                            addStore.addItem.sposob_pay_start === 'Наличные',
                    }"
                    class="item-oplata cursor-pointer flex items-center justify-center w-3/12 border bg-slate-100 h-14 rounded-xl"
                >
                    <div class="w-10">
                        <SVGNalichka />
                    </div>
                </div>
                <div
                    @click="
                        () => (addStore.addItem.sposob_pay_start = 'Перевод')
                    "
                    :class="{
                        active: addStore.addItem.sposob_pay_start === 'Перевод',
                    }"
                    class="item-oplata cursor-pointer flex items-center justify-center w-3/12 border bg-slate-100 h-14 rounded-xl"
                >
                    <div class="w-8">
                        <SVGPhone />
                    </div>
                </div>
                <div
                    @click="
                        () => (addStore.addItem.sposob_pay_start = 'Терминал')
                    "
                    :class="{
                        active:
                            addStore.addItem.sposob_pay_start === 'Терминал',
                    }"
                    class="item-oplata cursor-pointer flex items-center justify-center w-3/12 border bg-slate-100 h-14 rounded-xl"
                >
                    <div class="w-10">
                        <SVGCredit />
                    </div>
                </div>
            </div>
            <div class="mt-2 h-10 w-full items-center justify-around flex mb-2">
                <div
                    @click="addStore.addItem.money_pay_start = 200"
                    class="bg-slate-100 border rounded-xl cursor-pointer p-2 pl-3 pr-3"
                    :class="{
                        'bg-green-100': addStore.addItem.money_pay_start == 200,
                    }"
                >
                    200
                </div>
                <div
                    @click="addStore.addItem.money_pay_start = 300"
                    class="bg-slate-100 border rounded-xl cursor-pointer p-2 pl-3 pr-3"
                    :class="{
                        'bg-green-100': addStore.addItem.money_pay_start == 300,
                    }"
                >
                    300
                </div>
                <div
                    @click="addStore.addItem.money_pay_start = 450"
                    class="bg-slate-100 border rounded-xl cursor-pointer p-2 pl-3 pr-3"
                    :class="{
                        'bg-green-100': addStore.addItem.money_pay_start == 450,
                    }"
                >
                    450
                </div>
                <div
                    @click="addStore.addItem.money_pay_start = 500"
                    class="bg-slate-100 border rounded-xl cursor-pointer p-2 pl-3 pr-3"
                    :class="{
                        'bg-green-100': addStore.addItem.money_pay_start == 500,
                    }"
                >
                    500
                </div>
                <div
                    @click="addStore.addItem.money_pay_start = 600"
                    class="bg-slate-100 border rounded-xl cursor-pointer p-2 pl-3 pr-3"
                    :class="{
                        'bg-green-100': addStore.addItem.money_pay_start == 600,
                    }"
                >
                    600
                </div>
            </div>
            <hr />
            <div class="flex items-center justify-between">
                <input
                    type="tel"
                    class="w-2/5 rounded-md mt-2 mb-2"
                    :class="{}"
                    placeholder="Сумма"
                    name="start-oplata"
                    @focus="showButtonMoney = true"
                    @input="
                        (e) =>
                            (addStore.addItem.money_pay_start =
                                e.target.value.replace(/[^0-9]/g, ''))
                    "
                    :value="addStore.addItem.money_pay_start"
                />
                <select
                    name="how_time_start"
                    id="how-time"
                    class="w-2/5 rounded-md mt-2 mb-2"
                    @change="
                        (e) => (addStore.addItem.time_rent = e.target.value)
                    "
                >
                    <option selected value="0">ФАКТ</option>
                    <option value="10">10 мин</option>
                    <option value="20">20 мин</option>
                    <option value="30">30 мин</option>
                    <option value="60">1 час</option>
                    <option value="120">2 часа</option>
                    <option value="180">День</option>
                    <option value="240">Сутки</option>
                </select>
            </div>
            <hr />
            <div class="relative">
                <div
                    @click="activeOtherTime = !activeOtherTime"
                    class="flex items-center gap-2 justify-center relative cursor-pointer"
                >
                    <span
                        class="other-time absolute -top-11"
                        :class="{ active: activeOtherTime }"
                    >
                        <SVGBackTime />
                    </span>
                </div>
                <input
                    type="time"
                    class="input-other-time w-20 rounded-md mt-2 mb-2 ml-auto mr-auto"
                    :class="{
                        active: activeOtherTime || addStore.addItem.other_time,
                    }"
                    @input="
                        (e) => (addStore.addItem.other_time = e.target.value)
                    "
                    :value="addStore.addItem.other_time"
                />
            </div>
            <hr />

            <textarea
                class="mt-2 mb-2 w-full rounded-xl"
                placeholder="Комментарий"
                name="start-comment"
                id="start-comment"
                @input="
                    (e) => (addStore.addItem.comment_start = e.target.value)
                "
                :value="addStore.addItem.comment_start"
            ></textarea>
            <hr />
            <br />

            <button
                @click="addStore.sendAddElement"
                class="w-1/2 max-w-30 rounded-xl hover:bg-red-800 m-auto block p-2 text-white bg-red-600"
            >
                Добавить
            </button>
        </div>
    </div>
</template>

<style>
.flexImportant {
    display: flex !important;
}
.img_full {
    position: fixed;
    width: 100%;
    left: 0px;
    background-repeat: no-repeat;
    border: 5px solid #ffe607;
    z-index: 100;
    top: 47px;
    height: auto;
    max-height: 90vh;
    background-color: #1f1f1f;
    background-size: contain;
    background-position: center;
}
.wrap-modal-all {
    max-height: 80vh;
}
.item-oplata.active {
    background: #d3fdd1;
}
.modal-oform {
    transition: all 0.1s linear;
    visibility: hidden;
    opacity: 0;
}
.block-hidden {
    display: none;
}
.block-hidden.active {
    display: flex;
}
.modal-oform.active {
    visibility: visible;
    opacity: 1;
}
.other-time.active {
    transform: rotate(180deg);
}
.input-other-time {
    display: none;
}
.input-other-time.active {
    display: flex;
}
</style>
