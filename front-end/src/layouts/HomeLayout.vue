<script setup>
import HeaderVue from '../components/Header.vue';
import FooterVue from '../components/Footer.vue';
</script>

<template lang="">
    <div class="container">
        <HeaderVue/>
        <div class="container mt-[80px]">
            <router-view></router-view>
        </div>
        <FooterVue/>
    </div>
</template>

<style lang="">
    
</style>