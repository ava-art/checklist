<script setup></script>
<template>
    <svg class="oform-pic w-6 h-6 rotate-45 opacity-80 hover:opacity-100"
        width="20"
        height="20"
        viewBox="0 0 154 154"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
    >
        <circle cx="77" cy="77" r="77" fill="#FA092D" />
        <g filter="url(#filter0_d_2913_8)">
            <line
                x1="27.5"
                y1="78.5"
                x2="126.5"
                y2="78.5"
                stroke="white"
                stroke-width="7"
                stroke-linecap="round"
            />
            <line
                x1="75.5"
                y1="27.5"
                x2="75.5"
                y2="126.5"
                stroke="white"
                stroke-width="7"
                stroke-linecap="round"
            />
        </g>
        <defs>
            <filter
                id="filter0_d_2913_8"
                x="20"
                y="24"
                width="114"
                height="114"
                filterUnits="userSpaceOnUse"
                color-interpolation-filters="sRGB"
            >
                <feFlood flood-opacity="0" result="BackgroundImageFix" />
                <feColorMatrix
                    in="SourceAlpha"
                    type="matrix"
                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                    result="hardAlpha"
                />
                <feOffset dy="4" />
                <feGaussianBlur stdDeviation="2" />
                <feComposite in2="hardAlpha" operator="out" />
                <feColorMatrix
                    type="matrix"
                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"
                />
                <feBlend
                    mode="normal"
                    in2="BackgroundImageFix"
                    result="effect1_dropShadow_2913_8"
                />
                <feBlend
                    mode="normal"
                    in="SourceGraphic"
                    in2="effect1_dropShadow_2913_8"
                    result="shape"
                />
            </filter>
        </defs>
    </svg>
</template>

<style>
.oform-pic{
    transition: all .2s linear;
}
</style>