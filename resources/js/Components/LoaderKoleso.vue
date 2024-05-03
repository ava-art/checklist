<script setup></script>
<template>
    <span class="loader"></span>
</template>

<style>
.loader {
    display: block;
    height: 100%;
    position: relative;
}
.loader::before {
    -webkit-animation: rotation 0.4s linear infinite;
    animation: rotation 0.4s linear infinite;
    background-image: linear-gradient(#b50707 64px, #620c0c00 0),
        linear-gradient(#840a0a 66px, #8a171700 0),
        radial-gradient(circle 4px, #b12033 100%, #91191900 0);
    background-position: 50%;
    background-repeat: no-repeat;
    background-size: 40px 1px, 1px 40px, 8px 8px;
    border: 6px solid #080808;
    border-radius: 50%;
    box-sizing: border-box;
    content: "";
    height: 45px;
    left: calc(50% - 22.5px);
    position: absolute;
    top: calc(50% - 23px);
    width: 45px;
}
@keyframes rotation {
  from {
    transform: rotate(0deg);
  }

  to {
    transform: rotate(360deg);
  }
}
</style>
