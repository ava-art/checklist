import { defineStore } from "pinia";
import { ref } from "vue";
import fullRaschet from "../js/fullRaschet.js";

const allRentItems = ref(null);

function format(seconds) {
    let s = (seconds % 60).toString();
    let m = Math.floor((seconds / 60) % 60).toString();
    let h = Math.floor((seconds / 60 / 60) % 60).toString();
    return `${h.padStart(2, "0")}:${m.padStart(2, "0")}:${s.padStart(2, "0")}`;
}

export const useRentItemsStore = defineStore("rentItemsStore", () => {
    const getRentItems = async () => {
        const res = await fetch("https://app.welotochka.ru/api/rent-list");
        const { data } = await res.json();

        data.forEach((elements) => {
            let fullSummDrive = 0;
            let fullPayMoney = 0;

            elements.forEach((el) => {
                el.start = Date.parse(el.date_start + " " + el.time_start);

                el.now = Date.parse(new Date());
                el.beetwenSec = (el.now - el.start) / 1000;
                el.beetwenMin = el.beetwenSec / 60;
                el.money_full_drive = fullRaschet(el);
                fullSummDrive += el.money_full_drive;
                fullPayMoney += Number(el.money_pay_start);
                
            });
            elements.forEach((el) => {
                el.money_full_drive_all = fullSummDrive;
                el.money_full_pay_all = fullPayMoney;
            });
        });
     

        allRentItems.value = data;
    };

    return {
        getRentItems,
        allRentItems,
    };
});
