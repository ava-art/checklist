import { defineStore } from "pinia";
import { ref } from "vue";

import { usePage } from "@inertiajs/vue3";

let csrf = "";
document.cookie.split("; ").forEach((el) => {
    let arEl = el.split("=");

    if (arEl[0] == "XSRF-TOKEN") {
        csrf = el.split("=")[1];
    }
});

export const useAcessoryStore = defineStore("acessoryStore", () => {
    const listAcessory = ref({});
    const infoAcessory = ref({
        full_price: 0,
        sposob_pay: null,
    });

    const getAcessory = async () => {
        try {
            const res = await fetch("https://app.welotochka.ru/api/acessory");
            const { data } = await res.json();
            listAcessory.value = data.map((el) => {
                el.count = 0;
                el.full_price = 0;
                el.sposob_pay = 0;
                return el;
            });
        } catch (error) {}
    };

    const setAcessory = async () => {
        if (!infoAcessory.value.full_price || !infoAcessory.value.sposob_pay) {
            return alert("Выберите товар или способ оплаты");
        }

        const arSendAcessory = [];
        listAcessory.value.forEach((el) => {
            if (el.count) {
                el.full_price = el.count * el.price;
                el.sposob_pay = infoAcessory.value.sposob_pay;
                el.who_add = usePage().props.auth.user.name;
                arSendAcessory.push(el);
            }
        });
        const sendData = new FormData();
        sendData.append("set_acessory", JSON.stringify(arSendAcessory));

        try {
            const res = await fetch("https://app.welotochka.ru/api/set-acessory", {
                method: "POST",
                body: sendData,
                headers: {
                    "X-CSRF-TOKEN": csrf,
                },
            });
            const { data } = await res.json();
         
            if (data == 1) {
                window.location.href = "/";
            }
        } catch (error) {}
    };

    return {
        listAcessory,
        infoAcessory,
        getAcessory,
        setAcessory,
    };
});
