<template lang="">
    <div>
        <HomeBanner/>
    </div>
</template>
<script setup>
    import { useRoute } from 'vue-router';
import HomeBanner from '../../components/HomeBanner.vue';
    const  route = useRoute()

    console.log(route.query);
</script>
<style lang="">
    
</style>