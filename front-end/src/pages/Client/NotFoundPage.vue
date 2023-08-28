<template lang="">
    <div class="flex justify-center flex-col items-center">
        <div class="w-[40%]">
            <img src="../../assets/images/notfound.jpg" alt="">
        </div>
        <button class="bg-[#00DFC2] text-[16px] font-semibold text-[#2C444E] px-[20px] py-[10px] rounded" @click="handleGoBack">Go Back</button>
    </div>
</template>
<script>
import { useRouter } from 'vue-router';

export default {
    name: "NotFound",
    setup() {
        const router = useRouter()

        const handleGoBack = () => {
            router.back()
        }

        return {
            handleGoBack
        }
    }
}

</script>
<style lang="">
    
</style>