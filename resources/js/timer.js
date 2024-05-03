/*!
 * vue-timer-hook v1.0.84
 * (c) 2023 Eduardo San Martin Morote
 * @license MIT
 */

import { computed, ref } from "vue";

class Time {
    static getTimeFromSeconds(secs) {
        const totalSeconds = computed(() => Math.ceil(secs.value));
        const days = computed(() =>
            Math.floor(totalSeconds.value / (60 * 60 * 24))
        );
        const hours = computed(() =>
            Math.floor((totalSeconds.value % (60 * 60 * 24)) / (60 * 60))
        );
        const minutes = computed(() =>
            Math.floor((totalSeconds.value % (60 * 60)) / 60)
        );
        const seconds = computed(() => Math.floor(totalSeconds.value % 60));
        return {
            seconds,
            minutes,
            hours,
            days,
        };
    }
    static getSecondsFromExpiry(expiry, shouldRound) {
        const now = new Date().getTime();
        const milliSecondsDistance = expiry - now;
        if (milliSecondsDistance > 0) {
            const val = milliSecondsDistance / 1000;
            return shouldRound ? Math.round(val) : val;
        }
        return 0;
    }
    static getSecondsFromPrevTime(prevTime, shouldRound) {
        const now = new Date().getTime();
        const milliSecondsDistance = now - prevTime;
        if (milliSecondsDistance > 0) {
            const val = milliSecondsDistance / 1000;
            return shouldRound ? Math.round(val) : val;
        }
        return 0;
    }
    static getSecondsFromTimeNow() {
        const now = new Date();
        const currentTimestamp = now.getTime();
        const offset = now.getTimezoneOffset() * 60;
        return currentTimestamp / 1000 - offset;
    }
    static getFormattedTimeFromSeconds(totalSeconds, format) {
        const {
            seconds: secondsValue,
            minutes,
            hours,
        } = Time.getTimeFromSeconds(totalSeconds);
        const ampm = computed(() =>
            format === "12-hour" ? (hours.value >= 12 ? "pm" : "am") : ""
        );
        const hoursValue = computed(() =>
            format === "12-hour" ? hours.value % 12 : hours.value
        );
        return {
            seconds: secondsValue,
            minutes,
            hours: hoursValue,
            ampm,
        };
    }
}

const isNumber = (val) => typeof val === "number";
function useInterval(callback, ms) {
    let intervalId = undefined;
    const remove = () => {
        if (!intervalId) return;
        clearInterval(intervalId);
        intervalId = undefined;
    };
    const start = (_ms) => {
        remove();
        if (!_ms && !ms) {
            return;
        }
        const m = _ms || ms;
        return (intervalId = setInterval(callback, m));
    };
    if (isNumber(ms)) {
        start();
    }
    return { remove, start };
}

const epochSeconds = () => new Date().getTime();
const useStopwatch = (offsetTimestamp = 60, autoStart = true) => {
    let interval;
    const passedSeconds = ref(offsetTimestamp);
    const prevTime = ref(epochSeconds());
    const seconds = ref(
        passedSeconds.value +
            Time.getSecondsFromPrevTime(prevTime.value || 0, true)
    );
    const isRunning = ref(autoStart);
    function start() {
        prevTime.value = epochSeconds();
        isRunning.value = true;
        seconds.value =
            passedSeconds.value +
            Time.getSecondsFromPrevTime(prevTime.value, true);
        interval = useInterval(
            () => {
                seconds.value =
                    passedSeconds.value +
                    Time.getSecondsFromPrevTime(prevTime.value, true);
            },
            isRunning.value ? 1000 : false
        );
    }
    function pause() {
        passedSeconds.value = seconds.value;
        isRunning.value = false;
        if (interval) interval.remove();
    }
    function reset(offset = 0, newAutoStart = true) {
        pause();
        isRunning.value = newAutoStart;
        passedSeconds.value = offset;
        seconds.value = +passedSeconds.value;
        Time.getSecondsFromPrevTime(prevTime.value, true);
        if (isRunning.value) start();
    }
    if (isRunning.value) start();
    return {
        ...Time.getTimeFromSeconds(seconds),
        start,
        pause,
        reset,
        isRunning,
    };
};

export default useStopwatch;
