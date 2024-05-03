const fullRaschet = (element) => {
    const { name } = element.category;
    const elementName = element.element.name;
    const moneyPayStart = Number(element.money_pay_start);
    let min = element.beetwenSec / 60;

    // if (element.pause_start) {
    //     min = element.pause_start / 60;
    // }

    const date = new Date();
    const hour = date.getHours();

    console.log(hour);

    if (!min) {
        min = 1;
    }

    if (name == "Велосипеды" || name == "Ролики") {
        if (elementName.includes("Тандем")) {
            if (min <= 70) return 500;
            if (min > 70) {
                return Math.ceil((min - 70) / 30) * 250 + 500;
            }
        }

        if (min <= 70) return 300;
        if (min > 70) {
            const summ = Math.ceil((min - 70) / 30) * 150 + 300;
            const time18 = Date.parse(`${element.date_start} 18:05:00`);
            const time24 = Date.parse(`${element.date_start} 23:59:59`);

            if (summ <= 900) {
                return summ;
            } else if (summ > 900 && element.now < time18) {
                return 900;
            } else if (summ > 900 && element.now < time24) {
                if (summ < 1200) {
                    return summ;
                } else if (hour == 18){
                    return 1200
                } else{
                    return 1500;
                }
            } else if (min <= 1440) {
                return 1500;
            } else {
                return 3000;
            }
        }
    } else if (name == "Машинки" || name == "Гироскутеры") {
        if (min <= 12) {
            return 200;
        } else {
            return Math.ceil((min - 12) / 10) * 200 + 200;
        }
    } else if (name == "Самокаты") {
        if (min <= 35) return 300;
        if (min > 35 && min <= 65) return 500;
        if (min > 65 && min <= 95) return 750;
        if (min > 95 && min <= 125) return 1000;
        if (min > 125 && min <= 155) return 1250;
        if (min > 155 && min <= 185) return 1500;
        if (min > 185 && min <= 215) return 1750;
        if (min > 215 && min <= 245) return 2000;
        if (min > 245 && min <= 275) return 2250;
        if (min > 275 && min <= 305) return 2500;
        if (min > 305) return 2700;
    } else if (name == "Картинг") {
        if (min <= 12) {
            return 300;
        } else {
            return Math.ceil((min - 12) / 10) * 300 + 300;
        }
    } else if (name == "Защита") {
        return 100;
    }
};
export default fullRaschet;
