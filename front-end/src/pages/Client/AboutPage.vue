<template lang="">
    <div>
        <HomeBanner/>
        <div class="h-screen max-w-[1300px] mx-auto mt-[100px]">
            <p class="text-[20px] font-medium text-green-500 text-center">How It Works</p>
            <h1 class="font-bold text-[40px] text-center">Easy Step To Get Your <span class="text-green-500">Dream Job</span></h1>
            <div class="flex items-center justify-between gap-[100px] mt-[100px]">
                <AboutWidget iconComponent="UserAddOutlined" title="Create Your Account"/>
                <AboutWidget iconComponent="UserAddOutlined" title="Search Your Job"/>
                <AboutWidget iconComponent="UserAddOutlined" title="Apply For Job"/>
            </div>
        </div>
    </div>
</template>
<script setup>
    import HomeBanner from "../../components/HomeBanner.vue"
    import AboutWidget from "../../components/AboutWidget.vue";
    import {UserAddOutlined} from "@ant-design/icons-vue"
</script>
<style lang="">
    
</style>