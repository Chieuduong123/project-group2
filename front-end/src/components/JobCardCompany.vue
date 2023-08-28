<template lang="">
    <div class="p-[20px] flex gap-5 border rounded-md">
        <div class="w-[100px] h-[100px] rounded border overflow-hidden">
            <img src="https://plus.unsplash.com/premium_photo-1682309761340-3f8b1cbaa655?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8Zmxhc2h8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60" alt="logo" class="w-full h-full object-cover">
        </div>
        <div class="w-[80%]">
            <h4 class="font-medium">Full Stack Developer</h4>
            <p>Công ty A</p>
            <div class="flex gap-5 items-center">
                <div class="flex items-center gap-1">
                    <EnvironmentOutlined :style="{fontSize: '12px', color: '#9BA4B5'}"/>
                    <span>Đà Nẵng</span>
                </div>
                <div class="flex items-center gap-1">
                    <ClockCircleOutlined :style="{fontSize: '12px', color: '#9BA4B5'}"/>
                    <span>Full-Time</span>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <p class="font-medium text-[18px]">$5000<span class="text-[14px] font-normal">/Tháng</span></p>
                <div class="flex items-center gap-2">
                    <button class="px-[10px] py-[5px] rounded bg-green-200 text-green-600">Ứng tuyển</button>
                    <div class="w-[35px] h-[35px] rounded flex justify-center items-center bg-green-200 cursor-pointer">
                        <HeartOutlined :style="{fontSize: '14px', color: '#fff'}"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
    import {HeartOutlined, EnvironmentOutlined, ClockCircleOutlined} from "@ant-design/icons-vue"
</script>
<style lang="">
    
</style>