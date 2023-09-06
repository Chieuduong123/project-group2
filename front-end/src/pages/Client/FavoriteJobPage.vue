<template lang="">
    <div class="max-w-[1300px] mx-auto mt-[150px] max-xl:px-[50px] max-sm:px-[20px]">
        <h1 class="font-semibold text-[20px] max-xl:px-[50px] max-sm:px-[20px] max-sm:text-center">Danh sách công việc yêu thích</h1>
        <div v-if="postStore.favorites.length > 0" class="grid grid-cols-3 gap-5 mt-[50px] max-sm:grid-cols-1">
            <Post v-for="post in postStore.favorites" :key="post.id" :post="post.job" :idFavicon="post?.job_id"/>        
        </div>
        <h1 v-else class="text-gray-500 text-center text-[20px] font-semibold">Chưa có công việc nào</h1>
    </div>
    <Loading v-if="postStore.isLoading"/>
</template>
<script setup>
    import { onMounted } from 'vue';
    import Post from '../../components/Post.vue';
    import Loading from '../../components/Loading.vue';
    import { usePostStore } from '../../stores/postStore';
    import { useUserStore } from '../../stores/userStore';
    const postStore = usePostStore()
    const userStore= useUserStore()

    const handleGetFavorite =async (token) => {
       await postStore.actGetFavorite(token)
    }

    onMounted(() => {
        handleGetFavorite(userStore.accessToken)
    })

</script>
<style lang="">
    
</style>