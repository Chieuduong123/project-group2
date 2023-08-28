<template lang="">
    <div class="flex flex-col gap-5 shadow rounded-xl bg-white px-[30px] py-[30px] w-[32%]" @click="handleGoDetailPost(post?.id)">
        <div class="flex items-center justify-between">
            <div>
                <img :src="post?.business?.logo" alt="logo" class="h-[50px] w-[50px] rounded object-cover">
                <p class="mt-2">{{post?.business?.name}}</p>
            </div>
            <div class="w-[50px] h-[50px] rounded flex justify-center items-center bg-green-200 cursor-pointer">
                <HeartOutlined :style="{fontSize: '20px', color: '#fff'}"/>
            </div>
        </div>
        <p class="text-[18px] font-semibold">{{post?.position}}</p>
        <div class="flex gap-5 items-center">
            <div class="flex items-center gap-1">
                <EnvironmentOutlined :style="{fontSize: '12px', color: '#9BA4B5'}"/>
                <span>{{post?.business.location}}</span>
            </div>
            <div class="flex items-center gap-1">
                <ClockCircleOutlined :style="{fontSize: '12px', color: '#9BA4B5'}"/>
                <span>{{post?.type}}</span>
            </div>
            <div class="flex items-center gap-1">
                <ClockCircleOutlined :style="{fontSize: '12px', color: '#9BA4B5'}"/>
                <span v-for="(level, index) in post?.level" :key="index">{{level}}/</span>
            </div>
        </div>
        <div class="flex items-center justify-between">
            <p class="font-medium text-[18px]">${{post?.salary}}<span class="text-[14px] font-normal">/Tháng</span></p>
            <button class="px-[10px] py-[5px] rounded bg-green-200 text-green-600">Ứng tuyển</button>
        </div>
    </div>
</template>
<script setup>
    import {HeartOutlined, EnvironmentOutlined, ClockCircleOutlined} from "@ant-design/icons-vue"
    import {defineProps} from "vue"
import { useRouter } from "vue-router";

    const router = useRouter()
    const props = defineProps({
        post: Object
    })

    const handleGoDetailPost = (id) => {
        router.push(`job/${id}`)
    }
</script>
<style lang="">
    
</style>