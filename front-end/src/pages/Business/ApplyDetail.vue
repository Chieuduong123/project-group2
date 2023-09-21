<template lang="">
    <div>
        <h1>Thông tin ứng viên: <span>{{businessStore.apply?.seeker?.name}}</span></h1>
        <div class="mt-[50px] flex items-center gap-12 px-[100px]">
            <div class="flex flex-col justify-evenly flex-1">
                <div class="flex items-center gap-2">
                    <p class="font-medium" >Họ và Tên:</p>
                    <p>{{businessStore.apply?.seeker?.name}}</p>
                </div>
                <div class="flex items-center gap-2">
                    <p class="font-medium" >Vị trí ứng tuyển:</p>
                    <p>{{businessStore.apply?.job?.position}}</p>
                </div>
                <div class="flex items-center gap-2">
                    <p class="font-medium" >Email:</p>
                    <p>{{businessStore.apply?.seeker?.email}}</p>
                </div>
                <div class="flex items-center gap-2">
                    <p class="font-medium" >Số điện thoại:</p>
                    <p>{{businessStore.apply?.seeker?.phone}}</p>
                </div>
                <div class="flex items-center gap-2">
                    <p class="font-medium" >Ngày sinh:</p>
                    <p>{{businessStore.apply?.seeker?.birthday}}</p>
                </div>
                <div class="flex items-center gap-2">
                    <p class="font-medium" >Địa chỉ:</p>
                    <p>{{businessStore.apply?.seeker?.address}}</p>
                </div>
                <div class="flex items-center gap-2">
                    <p class="font-medium" >Thông tin thêm:</p>
                    <p>{{businessStore.apply?.cover_letter}}</p>
                </div>
            </div>
            <div class="flex flex-col items-center gap-5 flex-1">
                <div class="h-[200px] w-[200px] rounded-[10px] overflow-hidden">
                    <img v-if="handleCheckLinkImage(businessStore.apply?.seeker?.avatar)" :src="businessStore.apply?.seeker?.avatar" alt="" class ="w-full h-full object-cover">
                    <img v-else :src="`${IMAGE_URL}${businessStore.apply?.seeker?.avatar}`" alt="" class ="w-full h-full object-cover">
                </div>
                <a :href="`${CV_URL}${businessStore.apply?.resume_path}`" target="_blank" class="flex items-center gap-2 px-[15px] py-[10px] bg-gray-500 text-white font-semibold rounded" >
                    <FilePdfOutlined />
                    Xem CV
                </a>
            </div>
        </div>
    </div>
    <Loading v-if="businessStore.isLoading"/>

</template>
<script setup>
import { useRoute, useRouter } from 'vue-router';
import {FilePdfOutlined} from "@ant-design/icons-vue"
import { useBusinessStore } from '../../stores/businessStore';
import { onMounted } from 'vue';
import { CV_URL, IMAGE_URL } from '../../constants/url';
import Loading from '../../components/Loading.vue';
import { handleCheckLinkImage } from '../../constants/func';
    const route = useRoute()
    const router = useRouter()
    const businessStore = useBusinessStore()
    const handleGetDetailApply = (applyId, token) => {
        businessStore.actGetApplyById(applyId, token)
    }  

    onMounted(() => {
        handleGetDetailApply(route.params.id, businessStore.accessToken)
    })

    console.log("======",businessStore.apply);
    
</script>
<style lang="">
    
</style>