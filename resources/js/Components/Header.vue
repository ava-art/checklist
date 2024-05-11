<script setup>
import Login from "../Pages/Auth/Login.vue";
import MenuFixed from "../Components/MenuFixed.vue";
import { Link } from "@inertiajs/vue3";
import { useHomeStore } from "../../stores/HomeStore";

const homeStore = new useHomeStore();


</script>
<template>
    <div class="relative bg-dots-darker bg-center bg-gray-100 container-custom">
        <div>
            <div  class="p-4 py-2 text-end bg-header">
                <div
                    class="inner-header flex items-center justify-between"
                    v-if="$page.props.auth.user"
                >
                    <Link :href="'/'" class=" text-white font-semibold ">
                        CheckList
                    </Link>
                    <div
                        :class="'burger-menu ' + homeStore.hidden.burger"
                        @click="
                            homeStore.hidden.menu = '';
                            homeStore.hidden.burger = 'hidden-burger';
                        "
                    >
                        <i
                            class="menu-line-top w-8 h-0.5 rounded-sm bg-zinc-50"
                        ></i>
                        <i
                            class="menu-line-top w-8 h-0.5 rounded-sm bg-zinc-50 top-4"
                        ></i>
                    </div>
                </div>

                <template v-else>
                    <div class="inner-header flex items-center justify-between">
                        <Link :href="'/'" class=" ">
                            <img
                                src="https://welotochka.ru/assets/cache/images/webp/templates/welotochka/image/logo-velo.png.webp"
                                width="160"
                                alt="Логотип Велоточка"
                            />
                        </Link>
                    </div>
                </template>
            </div>
            <Login v-if="!$page.props.auth.user" />
        </div>
        <MenuFixed />
    </div>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
.hidden-menu {
    right: -100% !important;
}
.burger-menu {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 6px;
    cursor: pointer;
    width: 30px;
    height: 30px;
    position: relative;
}
.hidden-burger {
    top: -100px;
}
.bg-header {
    background-image: url("https://welotochka.ru/assets/templates/welotochka/image/bg.jpg");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>