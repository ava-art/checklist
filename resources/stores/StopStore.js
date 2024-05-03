import { usePage } from "@inertiajs/vue3";
import { defineStore } from "pinia";
import { ref } from "vue";
import checkForSend from "../js/checkForSend";
let csrf = "";

document.cookie.split("; ").forEach((el) => {
    let arEl = el.split("=");

    if (arEl[0] == "XSRF-TOKEN") {
        csrf = el.split("=")[1];
    }
});
function format(seconds) {
    let s = (seconds % 60).toString();
    let m = Math.floor((seconds / 60) % 60).toString();
    let h = Math.floor((seconds / 60 / 60) % 60).toString();
    return `${h.padStart(2, "0")}:${m.padStart(2, "0")}:${s.padStart(2, "0")}`;
}

export const useStopStore = defineStore("stopStore", () => {
    const stopInfo = ref({
        comment_stop: "",
        money_pay_stop: null,
        sposob_pay_stop: "",
    });

    const thisUser = ref(usePage().props.auth.user);
    const viewModal = ref({});
    const changeItem = ref({});
    const stopInfoAll = ref({});
    const sendStopItemRent = async (item) => {
        const { now, money_full_drive, money_pay_start } = item[0];
        const stopItem = stopInfo.value;

        if (stopItem.money_pay_stop && !stopItem.sposob_pay_stop) {
            return alert("Выберите тип оплаты");
        }
        if (
            !stopItem.money_pay_stop &&
            stopItem.sposob_pay_stop &&
            stopItem.sposob_pay_stop != "Бонус"
        ) {
            return alert("Впишите сумму");
        }
        if (stopItem.money_pay_stop < 0)
            return alert("Сумма не может быть меньше 0");

        if (
            !(Number(stopItem.money_pay_stop) + Number(money_pay_start)) &&
            stopItem.sposob_pay_stop != "Бонус" &&
            !stopItem.comment_stop
        ) {
            return alert("Почему оплата 0? Пишите в комментарий.");
        }
        stopItem.money_pay_stop == "" ? (stopItem.money_pay_stop = 0) : "";
        stopItem.element_id = item[0].element.id;
        stopItem.time_stop = format(Math.round(now / 1000 / 60));
        stopItem.who_stop = usePage().props.auth.user.name;
        stopItem.money_full_drive = money_full_drive;

        const sendData = new FormData();
        sendData.append("stop_rent", JSON.stringify(stopItem));

        try {
            const res = await fetch("https://app.welotochka.ru/api/stop-rent", {
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

    const sendStopAllRent = async (item) => {
        const countZashita = item.filter((el) => el.category.name == "Защита");
        let check = 0;

        item.forEach((el) => {
            el.sposob_pay_stop = stopInfo.value.sposob_pay_stop;
            if (!el.money_pay_stop) el.money_pay_stop = 0;
            if (Number(stopInfo.value.money_pay_stop) > 0) {
                if (countZashita.length && el.category.name == "Защита") {
                    el.money_pay_stop = 100;
                } else {
                    el.money_pay_stop =
                        (stopInfo.value.money_pay_stop -
                            countZashita.length * 100) /
                        (item.length - countZashita.length);
                }
            }
            if (checkForSend(el)) check++;
            el.who_stop = usePage().props.auth.user.name;
        });

        if (check) return;

        const sendData = new FormData();
        sendData.append("stop_rent_all", JSON.stringify(item));

        try {
            const res = await fetch(
                "https://app.welotochka.ru/api/stop-rent-all",
                {
                    method: "POST",
                    body: sendData,
                    headers: {
                        "X-CSRF-TOKEN": csrf,
                    },
                }
            );
            const { data } = await res.json();
            console.log(data);
            if (data == 1) {
                window.location.href = "/";
            }
        } catch (error) {}
    };

    const setPause = async (item) => {
        if (!confirm("Точно поставить на паузу?")) return;
        const date = new Date();
        const hour = date.getHours()
        const minutes = date.getMinutes()
        const seconds = date.getSeconds()
        
        const now = `${hour} : ${minutes} : ${seconds}`;
        item.pause_start = now;
        
        const sendData = new FormData();
        sendData.append("set_pause", JSON.stringify(item));
        try {
            const res = await fetch("https://app.welotochka.ru/api/set-pause", {
                method: "POST",
                body: sendData,
                headers: {
                    "X-CSRF-TOKEN": csrf,
                },
            });
            const { data } = await res.json();
            console.log(data);
            if (data == 1) {
                window.location.href = "/";
            }
        } catch (error) {}
    };
    const deletePause = async (item) => {
        if (!confirm("Точно cнять с паузы?")) return;
        item.pause_start = null;

        const sendData = new FormData();
        sendData.append("del_pause", JSON.stringify(item));
        try {
            const res = await fetch("https://app.welotochka.ru/api/del-pause", {
                method: "POST",
                body: sendData,
                headers: {
                    "X-CSRF-TOKEN": csrf,
                },
            });
            const { data } = await res.json();
            console.log(data);
            if (data == 1) {
                window.location.href = "/";
            }
        } catch (error) {}
    };

    const getCategories = async () => {
        const res = await fetch("https://app.welotochka.ru/api/category");
        const { data } = await res.json();

        changeItem.value.categories = data.filter(
            (el) => el.id != changeItem.value.category_id
        );
    };
    const getElements = async (cat_id) => {
        const res = await fetch(
            `https://app.welotochka.ru/api/elements/${cat_id}`
        );
        const { data } = await res.json();

        changeItem.value.elements = data;
    };

    const sendStopAllRentSlide = async () => {
        let check = 0;

        stopInfoAll.value.forEach((el) => {
            if (checkForSend(el)) check++;
        });
        if (check) return;

        const sendData = new FormData();
        sendData.append("stop_rent_all", JSON.stringify(stopInfoAll.value));

        try {
            const res = await fetch(
                "https://app.welotochka.ru/api/stop-rent-all",
                {
                    method: "POST",
                    body: sendData,
                    headers: {
                        "X-CSRF-TOKEN": csrf,
                    },
                }
            );
            const { data } = await res.json();

            if (data == 1) {
                window.location.href = "/";
            }
        } catch (error) {}
    };

    const sendChangeItemRent = async () => {
        if (changeItem.value.element_id == 0) return alert("Выберите элемент");
        if (
            (changeItem.value.sposob_pay_start &&
                !changeItem.value.money_pay_start) ||
            (!changeItem.value.sposob_pay_start &&
                changeItem.value.money_pay_start)
        )
            return alert("Выберите способ оплаты или введите сумму");

        const sendData = new FormData();
        sendData.append("update_rent", JSON.stringify(changeItem.value));

        try {
            const res = await fetch(
                "https://app.welotochka.ru/api/update-rent",
                {
                    method: "POST",
                    body: sendData,
                    headers: {
                        "X-CSRF-TOKEN": csrf,
                    },
                }
            );
            const { data } = await res.json();
            if (data == 1) {
                window.location.href = "/";
            }
        } catch (error) {}
    };

    return {
        thisUser,
        stopInfo,
        viewModal,
        getCategories,
        stopInfoAll,
        sendStopAllRentSlide,
        changeItem,
        setPause,
        deletePause,
        getElements,
        sendStopItemRent,
        sendStopAllRent,
        sendChangeItemRent,
    };
});
