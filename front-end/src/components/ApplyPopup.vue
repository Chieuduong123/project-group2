<template lang="">
    <div class="relative flex justify-center items-center ">
        <div class="bg-black z-40 opacity-70 fixed inset-0 " @click="toggle">
        </div>
        <div class="w-[700px] fixed top-[50%] translate-y-[-50%] z-50 left-[50%] translate-x-[-50%] bg-white rounded-xl p-[20px]">
            <div class="h-[50px] border-b flex items-center justify-between">
                <h2 class="text-[16px] font-semibold">Bạn đang ứng tuyển vị trí <span class="text-green-500">Phun sờ nách</span> tại</h2>
                <CloseOutlined :style="{fontSize: '20px', cursor: 'pointer'}" @click="toggle"/>
            </div>
            <form action="" class="flex flex-col gap-5 mt-5">
                <div class="flex flex-col gap-2">
                    <label for="" class="text-[14px] font-medium">Họ và tên</label>
                    <input type="text" placeholder="Nhập họ và tên" class="px-[10px] py-[5px] outline-none border rounded">
                </div>
                <div class="flex flex-col gap-2">
                    <label for="" class="text-[14px] font-medium">Email</label>
                    <input type="text" placeholder="Nhập email" class="px-[10px] py-[5px] outline-none border rounded">
                </div>
                <div class="flex flex-col gap-2">
                    <label for="" class="text-[14px] font-medium">Số điện thoại</label>
                    <input type="text" placeholder="Nhập số điện thoại" class="px-[10px] py-[5px] outline-none border rounded">
                </div>
                <div class="flex flex-col gap-2">
                    <label for="" class="text-[14px] font-medium">CV của bạn</label>
                    <input type="file" class="px-[10px] py-[5px] outline-none border rounded">
                </div>
                <div class="flex flex-col gap-2">
                    <label for="" class="text-[14px] font-medium">Thông tin thêm</label>
                    <textarea placeholder="Thông tin thêm" name="" id="" cols="30" rows="5" class="px-[10px] py-[5px] outline-none border rounded"></textarea>
                </div>
                <div class="flex items-center gap-5 justify-end">
                    <button class="border-2 border-red-500 px-[10px] py-[5px] rounded font-semibold">Huỷ</button>
                    <button class="bg-green-500 text-white px-[10px] py-[5px] rounded font-semibold">Nộp CV</button>
                </div>
            </form>
        </div>
    </div>
</template>
<script setup>
    import {CloseOutlined} from "@ant-design/icons-vue"
    import {defineProps} from "vue"

    const props = defineProps({
        toggle: Function
    })

</script>
<style lang="">
    
</style>