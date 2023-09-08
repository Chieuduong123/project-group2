<template lang="">
    <div class="relative shadow p-[20px] rounded overflow-hidden">
        <div class="absolute z-20 bg-white cursor-pointer right-[10px] top-[10px] p-[10px] shadow rounded-full flex justify-center items-center" @click="handleDeleteCV($event, cvData?.personal_detail.id)">
            <DeleteFilled :size="20"/>
        </div>
        <img src="https://lh6.googleusercontent.com/G0zBsMyz6rbxY5HIezYjLaL5-c2aV-INRaEX5RdxbRrWgpFAe1VnHdoHcTdD2MuHAvNBxNSLcq0iaoYTntl90VoTHshYN-Ekwjg9G-oD3sHmzayKSpsXvPh6HmJ8dpqXRMuv8a0pG12xw69dOSzOFgw_UzjNZkUgEnnPakeZHiZTmg-NOEuVvOdGzRu2WeSp_r21Ds8fxw" alt="cv" class="w-full h-full object-cover">
        <div>

        </div>
    </div>
</template>
<script setup>
    import { DeleteFilled } from '@ant-design/icons-vue';
import { useUserStore } from '../stores/userStore';
    const userStore = useUserStore()
    const {cvData} = defineProps({
        cvData: Object
    })
    
    const handleDeleteCV = (e, id) => {
        e.stopPropagation();
        if (confirm("Press a button!") == true) {
            userStore.actDeleteCV(id, userStore.accessToken)
        } else {
            return 0
        }
    }
</script>
<style lang="">
    
</style>