<script setup>
import { useHomeStore } from "../../stores/HomeStore";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";

if (!usePage().props.auth.user) {
    document.location.href = "/login";
}
const homeStore = new useHomeStore();
</script>

<template>
    <div
        :class="
            'fixed flex p-4 flex-col z-50 ' +
            homeStore.hidden.menu +
            ' transition-all z-10 items-end gap-16 top-0 right-0 h-screen w-1/2 bg-neutral-800/75 leading-8 text-white text-2xl'
        "
    >
        <div
            class="burger-menu"
            @click="
                (homeStore.hidden.menu = 'hidden-menu'),
                    (homeStore.hidden.burger = '')
            "
        >
            <i
                class="menu-line-top w-8 h-0.5 rounded-sm bg-zinc-50 rotate-45 relative"
            ></i>
            <i
                class="menu-line-top two w-8 h-0.5 rounded-sm bg-zinc-50 -rotate-45 absolute"
            ></i>
        </div>
        <ul class="flex flex-col items-end justify-center">
            <li class="list-item mb-2">
                <Link class="navbar-brand" :href="'/'">Главная</Link>
            </li>
            
            <li
                v-if="usePage().props.auth.user?.role != 'stag'"
                class="list-item mb-2"
            >
                <a href="/statistics">Статистика</a>
            </li>
            

            <div class="text-right">
                <li class="list-item">
                    <a href="/">Обновить</a>
                </li>
            </div>
        </ul>
    </div>
</template>

<style>
.menu-line-top.two {
    top: 14px;
}
</style>
