<template lang="">
<div class="flex flex-col gap-3 shadow rounded-xl bg-white px-[30px] py-[30px] cursor-pointer" @click="handleGoDetailBusiness(business?.id)">
    <div class="flex items-center">
        <div>
            <img v-if="handleCheckLinkImage(business?.avatar)" :src="business?.avatar" alt="logo" class="h-[50px] rounded object-contain max-w-[50%]">
            <img v-else :src="`${IMAGE_URL}${business?.avatar}`" alt="logo" class="h-[50px] rounded object-cover">
            <p class="mt-2">{{business?.name}}</p>
        </div>
    </div>
        <div class="flex items-center gap-3">
            <div class="rounded-full w-[20px] h-[20px] flex items-center justify-center bg-green-500">
                <StarFilled :style="{fontSize: '11px', color: '#fff'}"/>
            </div>
            <p class="text-[14px]">Đang tuyển dụng <span class="text-green-500 font-semibold">{{ quantityJob}}</span> vị trí</p>
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
            <p class="w-[90%] line-clamp-4">{{business?.career}}</p>
        </div>


    </div>
</template>
<script setup>
    import {StarFilled, InfoOutlined, EnvironmentOutlined} from "@ant-design/icons-vue"
    import {computed, defineProps, onMounted, ref} from "vue"
    import { IMAGE_URL } from "../constants/url";
import { useRouter } from "vue-router";
import { usePostStore } from "../stores/postStore";
import { fetchPostByIdBusiness } from "../api/postApi";
    const router = useRouter()
    const {business} = defineProps({
        business: Object
    })
    const quantityJob = ref(null)
    const postStore = usePostStore()

    const handleCheckLinkImage = (url) => {
        return url?.startsWith("http");
    }
    const handleGoDetailBusiness = (id) => {
        router.push(`company/${id}`)
    }
    const handleCalJobByBusinessId = async(id) => {
        const data = await fetchPostByIdBusiness(id)
        if(data) {
            quantityJob.value = data?.data?.length
        }
    }

    onMounted(() => {
        handleCalJobByBusinessId(business?.id)
    })
    
</script>
<style lang="">
    
</style>