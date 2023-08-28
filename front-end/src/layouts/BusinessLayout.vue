<template lang="">
    <div class="flex min-h-[100vh]">
        <div class="w-[15%]">
            <Sidebar/>
        </div>
        <div class="flex flex-col w-[85%]">
            <Navbar/>
            <div class="px-[20px] py-[20px]">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>
<script setup>
    import Sidebar from '../components/Sidebar.vue';
    import Navbar from '../components/Navbar.vue';
</script>
<style lang="">
    
</style>