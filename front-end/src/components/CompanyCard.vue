<template lang="">
<div class="flex flex-col gap-3 shadow rounded-xl bg-white px-[30px] py-[30px] w-[32%] cursor-pointer" @click="handleGoDetailBusiness(business?.id)">
    <div class="flex items-center">
        <div>
            <img :src="`${IMAGE_URL}${business?.avatar}`" alt="logo" class="h-[50px] w-[50px] rounded object-cover">
            <p class="mt-2">{{business?.name}}</p>
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
                <p class="text-[14px]">{{business?.location}}</p>
            </div>
        </div>
        <div class="flex items-start gap-3">
            <div class="rounded-full w-[20px] h-[20px] flex items-center justify-center bg-green-500">
                <InfoOutlined :style="{fontSize: '11px', color: '#fff'}"/>
            </div>
            <p class="w-[90%]">{{business?.career}}</p>
        </div>


    </div>
</template>
<script setup>
    import {StarFilled, InfoOutlined, EnvironmentOutlined} from "@ant-design/icons-vue"
    import {defineProps} from "vue"
    import { IMAGE_URL } from "../constants/url";
import { useRouter } from "vue-router";
    const router = useRouter()
    const {business} = defineProps({
        business: Object
    })

    const handleGoDetailBusiness = (id) => {
        router.push(`company/${id}`)
    }
</script>
<style lang="">
    
</style>