<script setup>
import { ref } from "vue";
import { useHomeStore } from "../../stores/HomeStore";
import { useStartStore } from "../../stores/StartStore";
import SVGArrow from "../Components/SVG/SVGArrow.vue";
import SVGNalichka from "../Components/SVG/SVGNalichka.vue";
import SVGPhone from "../Components/SVG/SVGPhone.vue";
import SVGCredit from "../Components/SVG/SVGCredit.vue";
import LoaderKoleso from "../Components/LoaderKoleso.vue";
import InputPhone from "../Components/ModalOformBlock/InputPhone.vue";
import InputFilePhoto from "../Components/ModalOformBlock/InputFilePhoto.vue";
import BlockPostoyannik from "../Components/ModalOformBlock/BlockPostoyannik.vue";
import SVGBackTime from "./SVG/SVGBackTime.vue";
import SVGClose from "./SVG/SVGClose.vue";
import SVGRepairs from "./SVG/SVGRepairs.vue";
import SVGShield from "./SVG/SVGShield.vue";
import ChangeClient from "../Components/ModalOformBlock/ChangeClient.vue"




const homeStore = new useHomeStore();
const startStore = new useStartStore();

const activeOtherTime = ref(false);
const activeOldGo = ref(false);
const showButtonMoney = ref(false);

const activeFullPhoto = ref(false);
const activeFullPhotoOld = ref(false);
</script>

<template>
    <div
        class="modal-oform fixed h-screen w-screen bg-opacity-80 bg-black top-0"
        :class="homeStore.hidden.oform"
        @click.self="homeStore.clickOform"
    >
        <div
            class="wrap-modal-all w-11/12 min-h-16 bg-white rounded-xl m-auto mt-12 p-2 pt-0 overflow-y-scroll"
        >
            <div class="text-lg font-medium text-center">Оформление</div>
            <hr />
            <div class=" text-white text-center font-bold text-base bg-red-700 py-2"  >
                ПРЕДУПРЕДИ О ПОВЫШЕНИИ ЦЕН!
            </div>
            <hr />
            <div
                class="flex flex-wrap gap-1 font-bold text-center my-1 justify-center"
            >
                <div class=" border p-1 rounded-lg bg-gray-200 " v-for="item of homeStore.listItems.checked">
                    <span class="flex items-center">
                        <span @click="homeStore.editActiveElemt(item)">
                            {{ item.name }}
                        </span>
                        <div v-if="item.repair" class="w-3">
                            <SVGRepairs :active="item" />
                        </div>
                        <div v-if="item.shield" class="w-3">
                            <SVGShield :active="item" />
                        </div>
                    </span>
                </div>
            </div>
            <hr />
            <InputPhone />
            <div v-if="startStore.startInfo.phone.length == 10">
                <InputFilePhoto />

                <BlockPostoyannik
                    v-if="startStore.startInfo.Client.postoyannik == 1"
                />
            </div>
            <hr />
            <div v-if="startStore.startInfo.Client.old_rent">
                <div
                    @click="activeOldGo = !activeOldGo"
                    class="flex items-center justify-center mb-2 cursor-pointer gap-2"
                    :class="{ active: activeOldGo }"
                    v-if="startStore.startInfo.Client.old_rent.length"
                >
                    <span>Прошлые поездки</span>

                    <span :class="{ active: activeOldGo }" class="other-time">
                        <SVGArrow />
                    </span>
                </div>
                <div
                    v-if="startStore.startInfo.Client.old_rent.length"
                    :class="{ active: activeOldGo }"
                    class="block-hidden flex justify-start gap-3 mb-2"
                >
                    <div
                        class="block-photo w-20 h-24 border border-gray-200 rounded-xl"
                    >
                        <div
                            v-if="startStore.startInfo.Client.img"
                            class="w-full h-full rounded-xl blur"
                            :class="{
                                'img_full_start img_full_start-old-rent':
                                    activeFullPhotoOld,
                            }"
                            :style="
                                'background-image:url(https://app.welotochka.ru/' +
                                startStore.startInfo.Client.img +
                                '); background-size: contain;'
                            "
                            @click="activeFullPhotoOld = !activeFullPhotoOld"
                            alt=""
                        ></div>
                    </div>
                    <div class="w-9/12">
                        <div
                            v-for="item of startStore.startInfo.Client.old_rent"
                            :key="item.id"
                        >
                            <div
                                class="flex gap-2 text-sm w-full justify-between items-center"
                            >
                                <div class="w-1/12">
                                    <img
                                        v-if="item.element.image"
                                        class="w-full h-auto h-5 rounded-lg"
                                        :src="
                                            'https://app.welotochka.ru/' +
                                            item.element.image
                                        "
                                        @click="
                                            activeFullPhoto == item.id
                                                ? (activeFullPhoto = null)
                                                : (activeFullPhoto = item.id)
                                        "
                                        :class="{
                                            img_full_start:
                                                activeFullPhoto == item.id,
                                        }"
                                        alt=""
                                    />
                                </div>
                                <div class="w-7/12 text-xs">
                                    {{ item.element.name }}
                                </div>
                                <div class="w-4/12 text-xs">{{ item.date_start }}</div>
                            </div>
                            <hr />
                        </div>
                    </div>
                </div>
            </div>
            
            <hr />

            <div class="flex gap-4 justify-center relative flex-wrap mt-2 mb-2">
                <div
                    v-if="startStore.startInfo.start_sposob_oplata"
                    class="absolute -left-1 top-4"
                    @click="startStore.startInfo.start_sposob_oplata = ''"
                >
                    <SVGClose />
                </div>
                <div
                    @click="
                        () =>
                            (startStore.startInfo.start_sposob_oplata =
                                'Наличные')
                    "
                    :class="{
                        active:
                            startStore.startInfo.start_sposob_oplata ===
                            'Наличные',
                    }"
                    class="item-oplata cursor-pointer flex items-center justify-center w-3/12 border bg-slate-100 h-14 rounded-xl"
                >
                    <div class="w-10">
                        <SVGNalichka />
                    </div>
                </div>
                <div
                    @click="
                        () =>
                            (startStore.startInfo.start_sposob_oplata =
                                'Перевод')
                    "
                    :class="{
                        active:
                            startStore.startInfo.start_sposob_oplata ===
                            'Перевод',
                    }"
                    class="item-oplata cursor-pointer flex items-center justify-center w-3/12 border bg-slate-100 h-14 rounded-xl"
                >
                    <div class="w-8">
                        <SVGPhone />
                    </div>
                </div>
                <div
                    @click="
                        () =>
                            (startStore.startInfo.start_sposob_oplata =
                                'Терминал')
                    "
                    :class="{
                        active:
                            startStore.startInfo.start_sposob_oplata ===
                            'Терминал',
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
                    @click="startStore.startInfo.start_oplata = 200"
                    class="bg-slate-100 border rounded-xl cursor-pointer p-2 pl-3 pr-3"
                    :class="{'!bg-green-100' : startStore.startInfo.start_oplata == 200}"
                >
                    200
                </div>
                <div
                    @click="startStore.startInfo.start_oplata = 300"
                    class="bg-slate-100 border rounded-xl cursor-pointer p-2 pl-3 pr-3"
                    :class="{'!bg-green-100' : startStore.startInfo.start_oplata == 300}"
                >
                    300
                </div>
                <div
                    @click="startStore.startInfo.start_oplata = 450"
                    class="bg-slate-100 border rounded-xl cursor-pointer p-2 pl-3 pr-3"
                    :class="{'!bg-green-100' : startStore.startInfo.start_oplata == 450}"
                >
                    450
                </div>
                <div
                    @click="startStore.startInfo.start_oplata = 500"
                    class="bg-slate-100 border rounded-xl cursor-pointer p-2 pl-3 pr-3"
                    :class="{'!bg-green-100' : startStore.startInfo.start_oplata == 500}"
                >
                    500
                </div>
                <div
                    @click="startStore.startInfo.start_oplata = 600"
                    class="bg-slate-100 border rounded-xl cursor-pointer p-2 pl-3 pr-3"
                    :class="{'!bg-green-100' : startStore.startInfo.start_oplata == 600}"
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
                            (startStore.startInfo.start_oplata =
                                e.target.value.replace(/[^0-9]/g, ''))
                    "
                    @oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                    :value="startStore.startInfo.start_oplata"
                />
                <select
                    name="how_time_start"
                    id="how-time"
                    class="w-2/5 rounded-md mt-2 mb-2 how-time-item-start"
                    @change="
                        (e) => (startStore.startInfo.time_rent = e.target.value)
                    "
                >
                  
                    <option v-if="homeStore.listItems.checked[0]?.category.id == 3" selected value="30">30 мин</option>
                    <option v-if="homeStore.listItems.checked[0]?.category.id == 2 ||
                    homeStore.listItems.checked[0]?.category.id == 4 ||
                    homeStore.listItems.checked[0]?.category.id == 5 " selected value="10">10 мин</option>
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
                        active:
                            activeOtherTime || startStore.startInfo.other_time,
                    }"
                    @input="
                        (e) =>
                            (startStore.startInfo.other_time = e.target.value)
                    "
                    :value="startStore.startInfo.other_time"
                />
            </div>
            <hr />

            <button
                @click="
                    () => startStore.onStartSend(homeStore.listItems.checked)
                "
                v-if="homeStore.listItems.checked.length"
                class="w-1/2 max-w-30 rounded-xl hover:bg-red-800 mt-3 m-auto block p-2 text-white bg-red-600"
            >
                Оформить
            </button>
            <textarea
                class="mt-2 mb-2 w-full h-8 indent-3 p-0 rounded-xl"
                placeholder="Комментарий"
                name="start-comment"
                id="start-comment"
                @input="
                    (e) => (startStore.startInfo.start_comment = e.target.value)
                "
                :value="startStore.startInfo.start_comment"
            ></textarea>
            <hr />
            <!-- <div
                class="w-16 fixed bottom-6 cursor-pointer h-16 p-3 bg-slate-200 rounded-full"
            >
                <SVGSaveState />
            </div> -->
        </div>
        <ChangeClient />
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
    max-height: 90vh;
    height: auto;
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
.img_full_start-old-rent {
    height: 100%;
    filter: blur(0);
    max-height: 60vh;
}
</style>
