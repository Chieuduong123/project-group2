<template lang="">
    <div class="h-[100vh] flex">
        <div class="relative flex items-center justify-center w-[60%] max-md:w-[100%]">
            <div class="absolute top-[70px] left-[150px]">
                <p class="text-[16px] font-medium text-gray-500">Chào mừng trở lại!</p>
                <h1 class="font-bold text-[25px] text-green-500">Juong Job.</h1>
            </div>
            <div class="w-[300px] flex flex-col items-center">
                <h3 class="font-semibold text-[20px] mb-[30px]">Đăng nhập</h3>
                <form action="" class="flex flex-col items-center gap-5 w-[100%]" @submit.prevent="handleLogin">
                    <div class="flex flex-col gap-1 w-[100%] rounded">
                        <label for="" class="text-[14px] font-semibold">Email</label>
                        <input type="text" v-model="userLogin.email" placeholder="Nhập email" class="outline-none text-[13px] px-[10px] py-[7px] border-[1px]">
                    </div>
                    <div class="flex flex-col gap-1 w-[100%] rounded">
                        <label for="" class="text-[14px] font-semibold">Mật Khẩu</label>
                        <div class="border-[1px]">
                            <input :type="isShow ? 'text' : 'password'" v-model="userLogin.password" placeholder="Nhập password" class="outline-none text-[13px] px-[10px] py-[7px] w-[90%]">
                            <EyeOutlined v-if="!isShow" :style="{cursor: 'pointer'}" @click="handleToggleShowPassword"/>
                            <EyeInvisibleOutlined v-if="isShow" :style="{cursor: 'pointer'}" @click="handleToggleShowPassword"/>
                        </div>
                    </div>
                    <div class="flex justify-end w-full">
                        <p class="font-semibold text-[14px] text-right cursor-pointer" @click="goForgotPassword">Quên mật khẩu</p>
                    </div>
                    <button :type="submit" class="text-[16px] font-medium px-[40px] py-[10px] text-white bg-green-500 rounded ">Đăng nhập</button>
                </form>
                <p class="font-normal text-[13px] mt-5">Tôi chưa có tài khoản ? <span class="text-green-500 cursor-pointer" @click="goRegisterPage">Đăng ký</span></p>
            </div>
        </div>
        <div class="w-[40%] flex items-center justify-center max-md:hidden">
            <img class="w-[100%] object-cover" src="../../assets/images/undraw_Job_hunt_re_q203.png" alt="img" >
        </div>
        <Loading v-if="userStore.isLoading"/>
    </div>
</template>
<script setup>
import {EyeOutlined, EyeInvisibleOutlined} from "@ant-design/icons-vue"
import {onMounted, ref} from "vue"
import {useRouter} from "vue-router"
import { useUserStore } from "../../stores/userStore";
import { useToast } from "vue-toastification";
import Loading from "../../components/Loading.vue";
const router = useRouter()
const isShow = ref(false)
const userStore = useUserStore()
const toast = useToast()
const userLogin = ref({
    email: "",
    password: ""
})

    const handleLogin = async () => {
        if (!userLogin.value.email || !userLogin.value.password) {
            toast.warning("Vui lòng nhập đầy đủ thông tin!");
        } else if (!isValidEmail(userLogin.value.email)) {
            toast.warning("Email không hợp lệ!");
        } else {
            await userStore.actLoginUser(userLogin.value)
            if(userStore.isLogged == true && userStore.accessToken) {
                router.push("/")
            }
        }
    }

    const isValidEmail = (email) => {
    // Sử dụng biểu thức chính quy để kiểm tra tính hợp lệ của địa chỉ email.
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(email);
    };

    const handleToggleShowPassword = () => {
        isShow.value = !isShow.value
    }

    const goRegisterPage = () => {
        router.push("/auth-layout/register")
    }

    const goForgotPassword = () => {
        router.push("/auth-layout/forgot-password")
    }


    onMounted(() => {
        if(userStore.isLogged === true) {
            router.push("/")
        }  
    })

</script>
<style >

</style>