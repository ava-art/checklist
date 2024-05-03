import { defineStore } from "pinia";
import { ref } from "vue";

export const useChangeStore = defineStore("changeStore", () => {

    const client = ref(null)

    return{
        client
    }
})