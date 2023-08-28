<template lang="">
    <div class="max-w-[1300px] mx-auto mt-[100px]">
       <div class="flex items-center gap-10">
            <h1 class="font-semibold text-[24px]">CV đã tạo tại Juong Job.</h1>
            <button class="px-[10px] py-[5px] rounded bg-green-500 text-white font-medium" @click="createNewCV">+ tạo mới</button>
       </div>
       <div class="flex gap-5 mt-[50px]">
            <CardCV/>
            <CardCV/>
            <CardCV/>
       </div>
    </div>
</template>
<script setup>
    import { useRouter } from 'vue-router';
import CardCV from '../../components/CardCV.vue';

    const router = useRouter()

    const createNewCV = () => {
        router.push("/create-cv")
    }
</script>
<style lang="">
    
</style>