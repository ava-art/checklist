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

function getRandomInt(max) {
    return Math.floor(Math.random() * max);
}

export const useStartStore = defineStore("startStore", () => {
    const startInfo = ref({
        phone: "",
        Client: {},
    });
    const csrf = ref({
        csrf: csr,
    });
    const user = usePage().props.auth.user;
    const arStartRents = ref([]);

    const onStartSend = async (checkedElements) => {
        startInfo.value.elements = checkedElements;

        if (
            !startInfo.value.phone ||
            Number(startInfo.value.phone) < 999999999
        ) {
            startInfo.value.phone = getRandomInt(9999999);
        }

        const countZashita = startInfo.value.elements.filter(
            (el) => el.category.name == "Защита"
        );

        arStartRents.value = startInfo.value.elements.map((el, id) => {
            let money_pay_start = 0;
            if (Number(startInfo.value.start_oplata) > 0) {
                if (countZashita.length && el.category.name == "Защита") {
                    money_pay_start = 100;
                } else {
                    money_pay_start =
                        (startInfo.value.start_oplata -
                            countZashita.length * 100) /
                        (startInfo.value.elements.length - countZashita.length);
                }
            }
            const photo = !startInfo.value.photo
                ? startInfo.value.Client.img
                : startInfo.value.photo;

            return {
                money_pay_start,
                category_id: el.category_id,
                element_id: checkedElements[id].id,
                client_id: startInfo.value.Client.id
                    ? startInfo.value.Client.id
                    : null,
                name: el.name,
                phone: startInfo.value.phone,
                user: user.name,
                photo: photo ? photo : null,
                other_time: startInfo.value.other_time
                    ? startInfo.value.other_time
                    : "",
                sposob_pay_start: startInfo.value.start_sposob_oplata
                    ? startInfo.value.start_sposob_oplata
                    : "",
                money_pay_start,
                time_rent: !startInfo.value.time_rent
                    ? document.querySelector('.how-time-item-start').value
                    : startInfo.value.time_rent,
                comment_start: startInfo.value.start_comment
                    ? startInfo.value.start_comment
                    : "",
            };
        });
       
        const data = new FormData();
        const { money_pay_start, sposob_pay_start } = arStartRents.value[0];

        if (
            (money_pay_start && !sposob_pay_start) ||
            (!money_pay_start && sposob_pay_start)
        ) {
            alert("Введите сумму или выберите способ оплаты");
            return;
        }
        if (money_pay_start < 0) return alert("Сумма не может быть меньше 0");
        data.append("new_rent", JSON.stringify(arStartRents.value));
       
        try {
            const res = await fetch(`https://app.welotochka.ru/api/add-rent`, {
                headers: {
                    "X-CSRF-TOKEN": csrf,
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
        startInfo,
        csrf,
        onStartSend,
        arStartRents,
        user,
    };
});
