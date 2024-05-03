import { usePage } from "@inertiajs/vue3";
import { defineStore } from "pinia";
import { ref } from "vue";

export const useDBStore = defineStore("dbStore", () => {
    const textSearch = ref("");
    const clients = ref(null);

    const searchClient = async () => {
        const res = await fetch(
            `https://app.welotochka.ru/api/search/${textSearch.value}`
        );
        const {data}  = await res.json()

        if (data.length) return clients.value = data
        clients.value = 'empty'
    };

    return {
        searchClient,
        clients,
        textSearch,
    };
});
