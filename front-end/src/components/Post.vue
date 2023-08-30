<template lang="">
    <div class="flex flex-col gap-3 shadow rounded-xl bg-white px-[30px] py-[30px] w-[32%]" @click="handleGoDetailPost(post?.id)">
        <div class="flex items-start justify-between">
            <div>
                <img :src="`${IMAGE_URL}${post?.business?.avatar}`" alt="logo" class="h-[50px] w-[50px] rounded object-cover">
                <p class="mt-2">{{post?.business?.name}}</p>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-[50px] h-[50px] rounded flex justify-center items-center bg-green-200 cursor-pointer" @click="handleAddFavorite($event, post?.id)">
                    <HeartOutlined :style="{fontSize: '20px', color: '#fff'}"/>
                </div>
                <div v-if="post?.id === idFavicon">
                    <a-dropdown>
                        <a class="ant-dropdown-link" @click.prevent>
                            <MoreOutlined :style="{fontSize: '20px', color: '#9BA4B5', cursor: 'pointer'}"/>
                        </a>
                        <template #overlay>
                        <a-menu>
                            <a-menu-item key="0" @click="handleRemoveFavicon(post?.id)">
                            Bỏ lưu
                            </a-menu-item>
                        </a-menu>
                        </template>
                    </a-dropdown>
                </div>
            </div>
        </div>
        <p class="text-[18px] font-semibold">{{post?.position}}</p>
        <div class="flex flex-col gap-5">
            <div class="flex items-center gap-1">
                <EnvironmentOutlined :style="{fontSize: '12px', color: '#9BA4B5'}"/>
                <span>{{post?.business.location}}</span>
            </div>
            <div class="flex gap-5">
                <div class="flex items-center gap-1">
                    <ClockCircleOutlined :style="{fontSize: '12px', color: '#9BA4B5'}"/>
                    <span v-for="(type, index) in post?.type">{{type}}/</span>
                </div>
                <div class="flex items-center gap-1">
                    <ClockCircleOutlined :style="{fontSize: '12px', color: '#9BA4B5'}"/>
                    <span v-for="(level, index) in post?.level" :key="index">{{level}}/</span>
                </div>
            </div>
        </div>
        <div class="flex items-center justify-between">
            <p class="font-medium text-[18px]">${{post?.salary}}<span class="text-[14px] font-normal">/Tháng</span></p>
            <button v-if="isHistory === false" class="px-[10px] py-[5px] rounded bg-green-200 text-green-600">Ứng tuyển</button>
        </div>
    </div>
</template>
<script setup>
    import {HeartOutlined, EnvironmentOutlined, ClockCircleOutlined, MoreOutlined} from "@ant-design/icons-vue"
    import {defineProps} from "vue"
    import { useRouter } from "vue-router";
import { IMAGE_URL } from "../constants/url";
import { usePostStore } from "../stores/postStore";
import { useUserStore } from "../stores/userStore";
import { useToast } from "vue-toastification";
    const postStore = usePostStore()
    const userStore = useUserStore()
    const router = useRouter()
    const toast = useToast()
    const props = defineProps({
        post: Object,
        idFavicon: String,
        isHistory: Boolean
    })

    const handleGoDetailPost = (id) => {
        router.push(`/job/${id}`)
    }

    const handleAddFavorite = (e, id) => {
        e.stopPropagation();
        if(userStore.accessToken) {
            postStore.actAddFavorite(id, userStore.accessToken)
        }else {
            toast.warning("Vui lòng đăng nhập")
        };
    }

    const handleRemoveFavicon = (id) => {
        if(userStore.accessToken) {
            postStore.actRemoveFavorite(id, userStore.accessToken)
        }else {
            toast.warning("Vui lòng đăng nhập")
        };
    }

</script>
<style lang="">
    
</style>