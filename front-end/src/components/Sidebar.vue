<template lang="">
<div class="border-r w-[100%] h-[100%]">
        <div class="h-[80px] flex items-center justify-center">
            <h1 class="font-bold text-[25px]">Juong Job.</h1>
        </div>
        <ul class="px-[20px] mt-5 flex flex-col gap-8">
            <li class="cursor-pointer bg-gray-300 flex items-center gap-1 px-[10px] py-[7px] text-[15px] rounded-full font-semibold">
                <router-link to="/business">
                    <BarChartOutlined :style="{fontSize: '20px'}"/>
                    Dashboard
                </router-link>
            </li>
            <li class="cursor-pointer bg-gray-300 flex items-center gap-1 px-[10px] py-[7px] text-[15px] rounded-full font-semibold">
                <router-link to="/business/apply-manager">
                    <ShoppingOutlined :style="{fontSize: '20px'}"/>
                    Application
                </router-link>
            </li>
            <li class="cursor-pointer bg-gray-300 flex items-center gap-1 px-[10px] py-[7px] text-[15px] rounded-full font-semibold">
                <router-link to="/business/post">
                    <SkinOutlined :style="{fontSize: '20px'}"/>
                    Post
                </router-link>
            </li>
        </ul>
    </div>
</template>
<script setup>
import {BarChartOutlined, SkinOutlined, SettingOutlined, ShoppingOutlined, TeamOutlined} from "@ant-design/icons-vue"

</script>
<style lang="">
    
</style>