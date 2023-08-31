<template lang="">
    <div>
        <h1>Thông tin ứng viên</h1>
        <div class="mt-[50px] flex items-center gap-12">
            <div class="flex flex-col justify-evenly">
                <div class="flex items-center gap-2">
                    <p class="font-medium" >Họ và Tên:</p>
                    <p>Lê Mạnh Bin</p>
                </div>
                <div class="flex items-center gap-2">
                    <p class="font-medium" >Email:</p>
                    <p>llemanhbin@gmail.com</p>
                </div>
                <div class="flex items-center gap-2">
                    <p class="font-medium" >Số điện thoại:</p>
                    <p>0365160470</p>
                </div>
                <div class="flex items-center gap-2">
                    <p class="font-medium" >Ngày sinh:</p>
                    <p>0365160470</p>
                </div>
                <div class="flex items-center gap-2">
                    <p class="font-medium" >Địa chỉ:</p>
                    <p>0365160470</p>
                </div>
            </div>
            <div class="flex flex-col items-center gap-5">
                <div class="h-[200px] w-[200px] rounded-[10px] overflow-hidden">
                    <img src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image.jpg" alt="" class ="w-full h-full object-cover">
                </div>
                <button class="px-[15px] py-[10px] bg-gray-500 text-white font-semibold rounded">Xem CV</button>
            </div>
        </div>
    </div>
</template>
<script setup>
import { useRoute } from 'vue-router';
import { useBusinessStore } from '../../stores/businessStore';
import { onMounted } from 'vue';
import { CV_URL } from '../../constants/url';
import pdfjs from 'pdfjs-dist';
    const route = useRoute()

    const businessStore = useBusinessStore()
    const handleGetDetailApply = (applyId, token) => {
        businessStore.actGetApplyById(applyId, token)
    }

    onMounted(() => {
        handleGetDetailApply(route.params.id, businessStore.accessToken)
    })
    
</script>
<style lang="">
    
</style>