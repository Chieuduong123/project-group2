<template lang="">
    <div class="p-[20px] flex gap-5 border rounded-md" @click="handleGoDetailPost(job?.id)">
        <div class="w-[100px] h-[100px] rounded border overflow-hidden">
            <img v-if="handleCheckLinkImage(job?.business?.avatar)" :src="job?.business?.avatar" alt="logo" class="w-full h-full object-contain">
            <img  v-else :src="`${IMAGE_URL}${job?.business?.avatar}`" alt="logo" class="w-full h-full object-contain">
        </div>
        <div class="w-[80%]">
            <h4 class="font-medium">{{job?.position}}</h4>
            <p>{{job?.business?.name}}</p>
            <div class="flex gap-5 items-center flex-wrap">
                <div class="flex items-center gap-1">
                    <EnvironmentOutlined :style="{fontSize: '12px', color: '#9BA4B5'}"/>
                    <span>{{job?.business?.location}}</span>
                </div>
                <div class="flex items-center gap-1">
                    <ClockCircleOutlined :style="{fontSize: '12px', color: '#9BA4B5'}"/>
                    <span v-for="(type, index) in job?.type" :key="index">{{type}}</span>
                </div>
            </div>
            <div class="flex items-center justify-between max-sm:flex-col max-sm:items-start max-sm:mt-5">
                <p class="font-medium text-[18px] mb-0">${{job?.salary}}<span class="text-[14px] font-normal">/Tháng</span></p>
                <div class="flex items-center gap-2">
                    <button class="px-[10px] py-[5px] rounded bg-green-200 text-green-600">Ứng tuyển</button>
                    <div class="w-[35px] h-[35px] rounded flex justify-center items-center bg-green-200 cursor-pointer" @click="handleAddFavorite($event, job?.id)">
                        <HeartOutlined :style="{fontSize: '14px', color: '#fff'}"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
    import {HeartOutlined, EnvironmentOutlined, ClockCircleOutlined} from "@ant-design/icons-vue"
import { useRouter } from "vue-router";
import { useUserStore } from "../stores/userStore";
import { useToast } from "vue-toastification";
import { IMAGE_URL } from "../constants/url";
    const {job} = defineProps({
        job: Object
    })
    const toast = useToast()
    const router = useRouter()
    const userStore = useUserStore()

    const handleGoDetailPost = (id) => {
        router.push(`/job/${id}`)
    }

    const handleCheckLinkImage = (url) => {
        return url?.startsWith("https");
    }

    const handleAddFavorite = (e, id) => {
        e.stopPropagation();
        if(userStore.accessToken) {
            postStore.actAddFavorite(id, userStore.accessToken)
        }else {
            toast.warning("Vui lòng đăng nhập")
        };
    }
</script>
<style lang="">
    
</style>