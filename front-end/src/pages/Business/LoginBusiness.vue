<template lang="">
    <div class="h-[100vh] flex">
        <div class="relative flex items-center justify-center w-[60%] max-md:w-[100%]">
            <div class="absolute top-[70px] left-[150px]">
                <p class="text-[16px] font-medium text-gray-500">Chào mừng đến với</p>
                <h1 class="font-bold text-[25px] text-green-500">Juong Job.</h1>
            </div>
            <div class="w-[300px] flex flex-col items-center">
                <h3 class="font-semibold text-[20px] mb-[30px]">Đăng nhập doanh nghiệp</h3>
                <form action="" class="flex flex-col items-center gap-5 w-full" @submit.prevent="handleLogin">
                    <div class="flex flex-col gap-1 w-[100%] rounded">
                        <label for="" class="text-[14px] font-semibold">Email</label>
                        <input type="email" v-model="businessData.email" placeholder="Nhập Email" class="outline-none text-[13px] px-[10px] py-[7px] border-[1px]">
                    </div>
                    <div class="flex flex-col gap-1 w-[100%] rounded">
                        <label for="" class="text-[14px] font-semibold">Password</label>
                        <input type="password" v-model="businessData.password" placeholder="Nhập Password" class="outline-none text-[13px] px-[10px] py-[7px] border-[1px]">
                    </div>
                    <button :type="submit" class="text-[16px] font-medium px-[40px] py-[10px] text-white bg-green-500 rounded ">Đăng nhập</button>
                </form>
                <p class="font-normal text-[13px] mt-5">Tôi chưa có tài khoản ? <span class="text-green-500 cursor-pointer" @click="goRegisterBusinessPage">Đăng ký</span></p>
            </div>
        </div>
        <div class="w-[40%] flex items-center justify-center max-md:hidden">
            <img class="w-[100%] object-cover" src="../../assets/images/undraw_Business_deal_re_up4u.png" alt="img" >
        </div>
    </div>
    <Loading v-if="businessStore.isLoading"/>
</template>
<script setup>
import { useRouter } from 'vue-router';
import { useBusinessStore } from '../../stores/businessStore';
import {onMounted, ref} from "vue"
import Loading from '../../components/Loading.vue';
import { useToast } from 'vue-toastification';
    const businessStore = useBusinessStore()
    const router = useRouter()
    const toast = useToast()
    const businessData = ref({
        email: "",
        password: ""
    })

    const handleLogin = async () => {
        if (!businessData.value.email || !businessData.value.password) {
            toast.warning("Vui lòng nhập đầy đủ thông tin!");
        } else if (!isValidEmail(businessData.value.email)) {
            toast.warning("Email không hợp lệ!");
        } else {
            await businessStore.actLoginBusiness(businessData.value)
            console.log(businessStore.isLoggedBusiness);
            if(businessStore.isLoggedBusiness == true && businessStore.accessToken) {
                router.push("/business")
            }
        }
    }

    onMounted(() => {
        if(businessStore.isLoggedBusiness == true) {
            router.push("/business")
        }
    })

    const isValidEmail = (email) => {
    // Sử dụng biểu thức chính quy để kiểm tra tính hợp lệ của địa chỉ email.
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(email);
    };

    const goRegisterBusinessPage = () => {
        router.push("/auth-layout/register-business")
    }
</script>
<style >

</style>