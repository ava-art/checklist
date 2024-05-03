<script setup>
import { Head } from "@inertiajs/vue3";
import Header from "../Components/Header.vue";

import { useDBStore } from "../../stores/DBStore";

const dbStore = new useDBStore();

</script>

<template>
    <Head title="База>" />
    <Header />
    <div v-if="$page.props.auth.user">
        
       <div class="container-main" v-if="$page.props.auth.user.role != 'stag'">
        <div class=" relative w-full mt-5 ">
            <input type="text" class="w-full rounded-md" 
            @input="e => dbStore.textSearch = e.target.value"
            placeholder="Номер или фамилия">
            <button 
            @click="dbStore.searchClient()"
            class="py-1 rounded-md absolute right-2 top-1 bg-red-500 text-white font-bold px-4 border-gray-900 border " >Поиск</button>
        </div>
        <div v-if="dbStore.clients != 'empty'">
            <div v-for="(client, index) in dbStore.clients" :key="index">
                <div v-if="client.postoyannik == 1" class="flex gap-4 items-center my-3">
                    <img :src="'https://app.welotochka.ru/'+client.img" class="w-full max-w-32 h-full max-h-32" alt="">
                    <div>
                        <div>{{ client.phone }}</div>
                        <div>{{ client.name }}</div>
                        <div>{{ client.family }}</div>
                        <div>{{ client.comment }}</div>
                    </div>
                </div>
                <div v-else>
                    Катался но нет в базе
                </div>
                <hr>
            </div>
        </div>
        <div v-else >
            Пусто
        </div>
        
       </div>
    </div>
</template>

<style>
.container-main {
    max-width: 600px;
    padding: 0 10px;
    margin-left: auto;
    margin-right: auto;
}
</style>
