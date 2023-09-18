<template lang="">
    <div class="max-w-[1300px] flex justify-center mx-auto mt-[150px] ">
        <div class="w-[700px] bg-white shadow rounded-xl p-[20px]">
            <h1 class="font-semibold text-[20px] mb-[20px]">Quên mật khẩu</h1>
            <p class="text-gray-400">Thông tin sẽ được gửi về email của bạn!</p>
            <form action=""  class="flex flex-col gap-5" @submit.prevent="handleForgotPassword">
                <div class="flex flex-col gap-2">
                    <label for="" class="text-[14px] font-medium">Email đăng nhập <RedTick/></label>
                    <input type="email" v-model="email" class="outline-none px-[10px] py-[5px] rounded border">
                </div>
                <u class="text-right cursor-pointer font-bold text-[14px] text-gray-500" @click="goLoginPage">Quay lại đăng nhập</u>
                <button type="submit" class="px-[10px] py-[5px] text-white bg-green-500 font-semibold rounded">Xác nhận</button>
            </form>
        </div>
    </div>
    <Loading v-if="userStore.isLoading"/>
</template>
<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import Loading from '../../components/Loading.vue';
import RedTick from '../../components/RedTick.vue';
import { useUserStore } from '../../stores/userStore';
import { useToast } from 'vue-toastification';
    const userStore = useUserStore()
    const router = useRouter()
    const toast = useToast()
    const email = ref("")

    const handleForgotPassword = () => {
        if(!email) {
            toast.warning("Vui lòng nhập email")
        }else {
            userStore.actForgotPassword({email: email.value})
            email.value = ""
        }
    }
    const goLoginPage = () => {
        router.push("/auth-layout")
    }
</script>
<style lang="">
    
</style>