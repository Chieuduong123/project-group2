<template lang="">
    <div class="bg-gradient-to-l from-green-200 via-green-200 to-green-100 w-full py-[30px] flex flex-col items-center gap-5 rounded-xl">
        <div class="w-[100px] h-[100px] flex items-center justify-center rounded-full bg-green-600 text-white">
            <img :src="image" alt="img" class="rounded-full object-cover w-[80%]">
        </div>
        <h1 class="text-center font-semibold text-[25px]">{{title}}</h1>
    </div>
</template>
<script setup>
    import { defineProps } from 'vue';
    
    const props = defineProps({
        iconComponent: String,
        title: String,
        image: String
    })

</script>
<style lang="">
    
</style>