<template lang="">
    <div>
        <HomeBanner/>
        <h1 class="text-[34px] font-semibold text-center m-[50px]">Kết quả tìm kiếm <span class="text-green-500">{{route.query.position}}</span></h1>
        <div v-if="postStore.posts.length > 0" class="grid grid-cols-3 gap-5 max-sm:grid-cols-1 max-xl:grid-cols-2 max-w-[1300px] mx-auto mt-[50px] ">
            <Post v-for="post in postStore.posts" :key="post.id" :post="post"/>
        </div>
        <h1  v-else class="text-center mt-[50px]">Không tìm thấy kết quả nào !</h1>
    </div>
    <LoadingVue v-if="postStore.isLoading"/>
</template>
<script setup>
    import { useRoute } from 'vue-router';
import HomeBanner from '../../components/HomeBanner.vue';
import { usePostStore } from '../../stores/postStore';
import { onMounted, watch } from 'vue';
import Post from "../../components/Post.vue"
import LoadingVue from '../../components/Loading.vue';
    const  route = useRoute()
    const postStore = usePostStore()

    const handleSearch = async(position, level, location) => {
       await postStore.actSearchPost(position, level, location)
    }

    watch(() => route.query, (newQuery) => {
        handleSearch(newQuery.position, newQuery.level, newQuery.location)
    })

    onMounted(() => {
        handleSearch(route.query.position, route.query.level, route.query.location)
    })

</script>
<style lang="">
    
</style>