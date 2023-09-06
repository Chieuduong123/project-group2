<script setup>
import HeaderVue from '../components/Header.vue';
import FooterVue from '../components/Footer.vue';
import { onMounted } from 'vue';
import { useUserStore } from '../stores/userStore';

  const userStore = useUserStore()
  const accessToken = localStorage.getItem("token") || null
  
  onMounted(() => {
    if(accessToken) {
      userStore.actFetchReLogin(accessToken) 
    }
  })
</script>

<template lang="">
    <div class="container mx-auto">
        <HeaderVue/>
        <div class="container mt-[80px]">
            <router-view></router-view>
        </div>
        <FooterVue/>
    </div>
</template>

<style lang="">
    
</style>