<template lang="">
    <div class="h-[100vh] flex">
        <div class="w-[40%] flex items-center justify-center max-md:hidden">
            <img class="w-[100%] object-cover" src="../../assets/images/undraw_Updated_resume_re_7r9j.png" alt="img" >
        </div>
        <div class="relative flex items-center justify-center w-[60%] max-md:w-[100%]">
            <div class="absolute top-[70px] left-[150px]">
                <p class="text-[16px] font-medium text-gray-500">Chào mừng đến với</p>
                <h1 class="font-bold text-[25px] text-green-500">Juong Job.</h1>
            </div>
            <div class="w-[300px] flex flex-col items-center">
                <h3 class="font-semibold text-[20px] mb-[30px]">Đăng ký</h3>
                <form action="" class="flex flex-col items-center gap-5 w-[100%]" @submit.prevent="handleRegister">
                    <div class="flex flex-col gap-1 w-[100%] rounded">
                        <label for="" class="text-[14px] font-semibold">Họ và tên</label>
                        <input type="text" v-model="userData.name" placeholder="Nhập họ và tên" class="outline-none text-[13px] px-[10px] py-[7px] border-[1px]">
                    </div>
                    <div class="flex flex-col gap-1 w-[100%] rounded">
                        <label for="" class="text-[14px] font-semibold">Số điện thoại</label>
                        <input type="text" v-model="userData.phone" placeholder="Nhập số điện thoại" class="outline-none text-[13px] px-[10px] py-[7px] border-[1px]">
                    </div>
                    <div class="flex flex-col gap-1 w-[100%] rounded">
                        <label for="" class="text-[14px] font-semibold">Email</label>
                        <input type="text" v-model="userData.email" placeholder="Nhập email" class="outline-none text-[13px] px-[10px] py-[7px] border-[1px]">
                    </div>
                    <div class="flex flex-col gap-1 w-[100%] rounded">
                        <label for="" class="text-[14px] font-semibold">Mật Khẩu</label>
                        <div class="border-[1px]">
                            <input :type="isShow ? 'text' : 'password'" v-model="userData.password" placeholder="Nhập password" class="outline-none text-[13px] px-[10px] py-[7px] w-[90%]">
                            <EyeOutlined v-if="!isShow" :style="{cursor: 'pointer'}" @click="handleToggleShowPassword"/>
                            <EyeInvisibleOutlined v-if="isShow" :style="{cursor: 'pointer'}" @click="handleToggleShowPassword"/>
                        </div>
                    </div>
                    <button :type="submit" class="text-[16px] font-medium px-[40px] py-[10px] text-white bg-green-500 rounded " >Đăng ký</button>
                </form>
                <p class="font-normal text-[13px] mt-5">Tôi đã có tài khoản? <span class="text-green-500 cursor-pointer" @click="goLoginPage">Đăng nhập</span></p>
            </div>
        </div>
    </div>
</template>
<script setup>
    import {EyeOutlined, EyeInvisibleOutlined} from "@ant-design/icons-vue"
    import {ref} from "vue"
    import {useRouter} from "vue-router"
    import {useUserStore} from "../../stores/userStore"
    import { useToast } from "vue-toastification";

    const toast = useToast()
    const userStore = useUserStore()
    const router = useRouter()
    const isShow = ref(false)
    const userData = ref({
        name: "",
        phone: "",
        email: "",
        password: "",
    })
   

    const handleToggleShowPassword = () => {
        isShow.value = !isShow.value
    }

    const goLoginPage = () => {
        router.push("/auth-layout")
    }

    const handleRegister = async () => {
        if(!userData.value.name || !userData.value.name || !userData.value.email || !userData.value.password) {
            toast.warning("Vui lòng nhập đầy đủ thông tin!")
        }else {
            await userStore.actRegisterUser(userData.value)
        }
    }

</script>
<style >

</style>