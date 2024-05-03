import { defineStore } from "pinia";
import { ref } from "vue";

import { usePage } from "@inertiajs/vue3";

let csr = "";

document.cookie.split("; ").forEach((el) => {
    let arEl = el.split("=");

    if (arEl[0] == "XSRF-TOKEN") {
        csr = el.split("=")[1];
    }
});


export const useAddStore = defineStore("addStore", () => {

    const addItem = ref({})

    const getCategories = async () => {
        const res = await fetch("https://app.welotochka.ru/api/category");
        const { data } = await res.json();

        addItem.value.categories = data.filter(
            (el) => el.id != addItem.value.category_id
        );
    };
    const getElements = async (cat_id) => {
        const res = await fetch(`https://app.welotochka.ru/api/elements/${cat_id}`);
        const { data } = await res.json();
        addItem.value.elements = data
        addItem.value.element_id =data[0].id
    };
   
    const sendAddElement = async () => {
       
        const data = new FormData();
    
       
        const { money_pay_start, sposob_pay_start } = addItem.value;
        if (
            (money_pay_start && !sposob_pay_start) ||
            (!money_pay_start && sposob_pay_start)
        ) {
            alert("Введите сумму или выберите способ оплаты");
            return;
        }
        if (money_pay_start < 0) return alert("Сумма не может быть меньше 0");
        data.append("add_rent", JSON.stringify(addItem.value));
    // return console.log(addItem.value);


        try {
            const res = await fetch(`https://app.welotochka.ru/api/add-rent-add`, {
                headers: {
                    "X-CSRF-TOKEN": csr,
                },
                method: "POST",
                body: data,
            });
            const datas = await res.json();
    
            if (datas.data == 0) {
                alert("Ошибка, выбранные элементы заняты.");
            } else if (datas.data == 1) {
                window.location.href = "/";
            }
        } catch (error) {
            console.log(error);
        }
    };

    return {
        addItem,
        sendAddElement,
        getCategories,
        getElements
    };
});
