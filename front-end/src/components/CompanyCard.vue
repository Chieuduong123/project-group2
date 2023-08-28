<template lang="">
<div class="flex flex-col gap-3 shadow rounded-xl bg-white px-[30px] py-[30px] w-[32%] cursor-pointer">
    <div class="flex items-center">
        <div>
            <img src="https://html.creativegigstf.com/khuj/khuj/images/slider/slider-1.png" alt="logo" class="h-[30px] object-cover">
            <p class="mt-2">Công ty Google</p>
        </div>
    </div>
        <div class="flex items-center gap-3">
            <div class="rounded-full w-[20px] h-[20px] flex items-center justify-center bg-green-500">
                <StarFilled :style="{fontSize: '11px', color: '#fff'}"/>
            </div>
            <p class="text-[14px]">Đang tuyển dụng <span class="text-green-500 font-semibold">0</span> vị trí</p>
        </div>
        <div class="flex items-start gap-3">
            <div class="rounded-full w-[20px] h-[20px] flex items-center justify-center bg-green-500">
                <EnvironmentOutlined :style="{fontSize: '11px', color: '#fff'}"/>
            </div>
            <div class="w-[90%]">
                <p class="text-[14px]">Tầng 22, Tòa nhà VPBank, 89 Láng Hạ, Quận Đống Đa, Hà Nội</p>
            </div>
        </div>
        <div class="flex items-start gap-3">
            <div class="rounded-full w-[20px] h-[20px] flex items-center justify-center bg-green-500">
                <InfoOutlined :style="{fontSize: '11px', color: '#fff'}"/>
            </div>
            <p class="w-[90%]">Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt fugiat dolorum voluptatum blanditiis molestiae corporis. Ad accusamus voluptate maiores? Sunt repellat eaque nulla, commodi iusto veritatis alias error autem et.</p>
        </div>


    </div>
</template>
<script setup>
    import {StarFilled, InfoOutlined, EnvironmentOutlined} from "@ant-design/icons-vue"
</script>
<style lang="">
    
</style>