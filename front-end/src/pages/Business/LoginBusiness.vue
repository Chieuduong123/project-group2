<template lang="">
    <div class="h-[100vh] flex">
        <div class="relative flex items-center justify-center w-[60%] max-md:w-[100%]">
            <div class="absolute top-[70px] left-[150px]">
                <p class="text-[16px] font-medium text-gray-500">Chào mừng đến với</p>
                <h1 class="font-bold text-[25px] text-green-500">Juong Job.</h1>
            </div>
            <div class="w-[300px] flex flex-col items-center">
                <h3 class="font-semibold text-[20px] mb-[30px]">Đăng nhập doanh nghiệp</h3>
                <form action="" class="flex flex-col items-center gap-5 w-full" >
                    <div class="flex flex-col gap-1 w-[100%] rounded">
                        <label for="" class="text-[14px] font-semibold">Email</label>
                        <input type="email" placeholder="Nhập Email" class="outline-none text-[13px] px-[10px] py-[7px] border-[1px]">
                    </div>
                    <div class="flex flex-col gap-1 w-[100%] rounded">
                        <label for="" class="text-[14px] font-semibold">Password</label>
                        <input type="password" placeholder="Nhập Password" class="outline-none text-[13px] px-[10px] py-[7px] border-[1px]">
                    </div>
                    <button :type="submit" class="text-[16px] font-medium px-[40px] py-[10px] text-white bg-green-500 rounded ">Đăng nhập</button>
                </form>
            </div>
        </div>
        <div class="w-[40%] flex items-center justify-center max-md:hidden">
            <img class="w-[100%] object-cover" src="../../assets/images/undraw_Business_deal_re_up4u.png" alt="img" >
        </div>
    </div>
</template>
<script setup>


</script>
<style >

</style>