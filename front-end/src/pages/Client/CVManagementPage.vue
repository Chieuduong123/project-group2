<template lang="">
    <div class="max-w-[1300px] mx-auto mt-[100px] max-md:px-[20px] max-xl:px-[50px]">
       <div class="flex items-center gap-10">
            <h1 class="font-semibold text-[24px]">CV đã tạo tại Juong Job.</h1>
            <button class="px-[10px] py-[5px] rounded bg-green-500 text-white font-medium whitespace-nowrap" @click="createNewCV">+ tạo mới</button>
       </div>
       <div class="mt-[50px] grid grid-cols-3 gap-5 max-sm:grid-cols-1 max-xl:grid-cols-2s">
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