<script setup>
import { onMounted } from 'vue';
import { useUserStore } from './stores/userStore';

  const userStore = useUserStore()
  const accessToken = localStorage.getItem("token") || null
  
  onMounted(() => {
    if(accessToken) {
      userStore.actFetchReLogin(accessToken) 
    }
  })
</script>

<template>
  <div>
    <router-view></router-view>
  </div>
</template>

<style scoped>
</style>
