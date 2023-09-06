<template lang="">
    <div class="max-w-[1300px] mx-auto mt-[150px] max-xl:px-[50px] max-sm:px-[20px]">
        <h1 class="font-semibold text-[20px] max-sm:text-center">Lịch sử ứng tuyển</h1>
        <div v-if="userStore.histories.length > 0" class="grid grid-cols-3 gap-5 mt-[50px] max-sm:grid-cols-1 ">
            <Post v-for="post in userStore.histories" :key="post.id" :post="post?.job" :isHistory="true"/>
        </div>
        <h1 v-else class="mt-[50px] text-center text-[24px] text-gray-500 font-semibold">Không tìm thấy công ty nào</h1>
    </div>
    <Loading v-if="userStore.isLoading"/>
</template>
<script setup>
    import { onMounted } from 'vue';
    import Post from '../../components/Post.vue';
    import { useUserStore } from '../../stores/userStore';
    import Loading from '../../components/Loading.vue';
    const userStore = useUserStore()

    const handleGetHistory = async(token) => {
        await userStore.actGetHistoryApply(token)
    }

    onMounted(() => {
        handleGetHistory(userStore.accessToken)
    })

    
</script>
<style lang="">
    
</style>