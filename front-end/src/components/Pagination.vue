<template lang="">
    <div class="pagination mx-auto flex items-center gap-3 flex-nowrap">
        <button class="w-[30px] h-[30px] border" :class="{'bg-green-500 text-white': pageNumber === (currentPage ?? 1), 'text-green-500 bg-white': pageNumber !== (currentPage ?? 1)}" v-for="pageNumber in pageArray" :key="pageNumber" @click="goToPage(pageNumber)">
            {{ pageNumber }}
        </button>
    </div>
</template>
<script setup>
    import { defineProps } from 'vue';
    
    const props = defineProps({
        currentPage: Number,
        pageArray: Array,
        goToPage: Function
    })

</script>
<style lang="">
    
</style>