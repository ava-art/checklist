<script setup>
import { Head } from "@inertiajs/vue3";
import Header from "../Components/Header.vue";

import { useAcessoryStore } from "../../stores/AcessoryStore";
import SVGNalichka from "@/Components/SVG/SVGNalichka.vue";
import SVGPhone from "@/Components/SVG/SVGPhone.vue";
import SVGCredit from "@/Components/SVG/SVGCredit.vue";

const acessoryStore = new useAcessoryStore();

acessoryStore.getAcessory();

</script>

<template>
    <Head title="Аксессуары" />
    <Header />
    <div v-if="$page.props.auth.user" class="container-custom">
        <div class="p-4">
            <div>
                <ul class="flex justify-center gap-2 flex-wrap">
                    <li
                        v-for="item of acessoryStore.listAcessory"
                        :key="item.id"
                        class="w-28 bg-white p-2 rounded-lg "
                    >
                        <div class="text-center">{{ item.name }}</div>
                        <div class="flex items-center justify-between">
                            <div class="w-1/3 flex justify-center">
                                <span
                                    @click="
                                        item.count--,
                                            (acessoryStore.infoAcessory.full_price -=
                                                item.price)
                                    "
                                    v-if="item.count"
                                    class="p-1 border w-full text-center rounded-sm"
                                    >-</span
                                >
                                <span class="p-1" v-else> </span>
                            </div>
                            <div class="w-1/3 text-center">
                                {{ item.count }}
                            </div>
                            <div class="w-1/3 flex justify-center">
                                <span
                                    class="p-1 border w-full text-center rounded-sm"
                                    @click="
                                        item.count++,
                                            (acessoryStore.infoAcessory.full_price +=
                                                item.price)
                                    "
                                    >+</span
                                >
                            </div>
                        </div>
                    </li>
                </ul>

                <div class="flex items-center gap-3 justify-around my-5">
                    <div
                        class="border p-4 px-6 pay-item rounded-xl bg-white"
                        :class="{
                            active:
                                acessoryStore.infoAcessory.sposob_pay ==
                                'Наличка',
                        }"
                        @click="
                            acessoryStore.infoAcessory.sposob_pay = 'Наличка'
                        "
                    >
                        <SVGNalichka />
                    </div>
                    <div
                        class="border p-4 px-6 pay-item rounded-xl bg-white"
                        :class="{
                            active:
                                acessoryStore.infoAcessory.sposob_pay ==
                                'Перевод',
                        }"
                        @click="
                            acessoryStore.infoAcessory.sposob_pay = 'Перевод'
                        "
                    >
                        <SVGPhone />
                    </div>
                    <div
                        class="border p-4 px-6 pay-item rounded-xl bg-white"
                        :class="{
                            active:
                                acessoryStore.infoAcessory.sposob_pay ==
                                'Терминал',
                        }"
                        @click="
                            acessoryStore.infoAcessory.sposob_pay = 'Терминал'
                        "
                    >
                        <SVGCredit />
                    </div>
                </div>
                <div class="flex flex-col w-full justify-center items-center">
                    <div class="flex gap-4 items-center text-2xl">
                        <div>Итого</div>
                        <div>{{ acessoryStore.infoAcessory.full_price }}</div>
                    </div>
                    <div
                    @click="() => acessoryStore.setAcessory()"
                        class="w-3/4 text-center p-3 bg-red-500 rounded-xl text-xl mt-4"
                    >
                        Применить
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.pay-item.active{
    background: rgb(152, 215, 152) !important;
}
</style>
