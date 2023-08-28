<template lang="">
    <div class="flex gap-5 mt-[50px] justify-center">
        <div class="flex-1">
            <form action="" class="flex flex-col items-center gap-5 w-max" >
                <div class="flex gap-3">
                    <div class="flex flex-col gap-1 w-[100%] rounded">
                        <label for="" class="text-[14px] font-semibold">Tên công ty</label>
                        <input type="text" placeholder="Nhập tên công ty" class="outline-none text-[13px] px-[10px] py-[7px] border-[1px]">
                    </div>
                    <div class="flex flex-col gap-1 w-[100%] rounded">
                        <label for="" class="text-[14px] font-semibold">Số điện thoại</label>
                        <input type="text" placeholder="Nhập số điện thoại" class="outline-none text-[13px] px-[10px] py-[7px] border-[1px]">
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="flex flex-col gap-1 w-[100%] rounded">
                        <label for="" class="text-[14px] font-semibold">Email</label>
                        <input type="email" placeholder="Nhập email" class="outline-none text-[13px] px-[10px] py-[7px] border-[1px]">
                    </div>
                    <div class="flex flex-col gap-1 w-[100%] rounded">
                        <label for="" class="text-[14px] font-semibold">Địa chỉ</label>
                        <input type="text" placeholder="Nhập địa chỉ công ty" class="outline-none text-[13px] px-[10px] py-[7px] border-[1px]">
                    </div>
                </div>
                <div class="flex flex-col gap-1 w-[100%] rounded">
                    <label for="" class="text-[14px] font-semibold">Password</label>
                    <input type="password" placeholder="Nhập password" class="outline-none text-[13px] px-[10px] py-[7px] border-[1px]">
                </div>
                <div class="flex items-center gap-3">
                    <div class="flex flex-col gap-1 w-[100%] rounded">
                        <label for="" class="text-[14px] font-semibold">Website</label>
                        <input type="text" placeholder="Nhập link website" class="outline-none text-[13px] px-[10px] py-[7px] border-[1px]">
                    </div>
                    <div class="flex flex-col gap-1 w-[100%] rounded">
                        <label for="" class="text-[14px] font-semibold">Số lượng nhân sự</label>
                        <input type="text" placeholder="Nhập số lượng nhân sự" class="outline-none text-[13px] px-[10px] py-[7px] border-[1px]">
                    </div>
                </div>
                <button :type="submit" class="text-[16px] font-medium px-[40px] py-[10px] text-white bg-green-500 rounded ">Submit</button>
            </form>
        </div>
        <div class="flex-1">
            <div class="relative w-[200px] h-[200px] ">
                <img src="https://media-cdn-v2.laodong.vn/storage/newsportal/2023/7/25/1220914/Rose.jpg" alt="logo" class="w-full h-full rounded-full object-cover">
                <input type="file" id="logo-business" class="hidden">
                <label for="logo-business" class="absolute right-0 translate-x-[-30%] bottom-[10%] w-[30px] h-[30px] rounded-full flex items-center justify-center cursor-pointer bg-green-500 text-white"><CameraOutlined :style="{fontSize: '14px'}"/></label>
            </div>
        </div>
    </div>
</template>
<script setup>
    import {CameraOutlined} from "@ant-design/icons-vue"
</script>
<style lang="">
    
</style>