<template lang="">
    <div class="flex flex-col gap-5 items-end">
        <button class="px-[10px] py-[7px] bg-green-500 text-white font-semibold rounded" @click="isToggleFormCreate">Thêm bài viết</button>
        <div class=" flex flex-col justify-between overflow-x-auto sm:rounded-lg w-[100%] ">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-3 text-center">
                            Vị trí
                        </th>
                        <th scope="col" class="px-4 py-3 text-center" >
                            Số lượng tuyển
                        </th>
                        <th scope="col" class="px-4 py-3 text-center" >
                            Ngày bắt đầu
                        </th>
                        <th scope="col" class="px-4 py-3 text-center" >
                            Ngày kết thúc
                        </th>
                        <th scope="col" class="px-4 py-3 text-center" >
                            Trạng thái
                        </th>
                        <th scope="col" class="px-4 py-3 text-center" >
                            Thao tác
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700" v-for="post in postData" :key="post.id">
                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                            {{post?.position}}
                        </th>
                        <td class="px-4 py-3 text-center">
                            {{post?.quantity}}
                        </td>
                        <td class="px-4 py-3 text-center">
                            {{post?.start_day}}
                        </td>
                        <td class="px-4 py-3 text-center">
                            {{post?.end_day}}
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span v-if="post?.status === 0" class="text-white bg-yellow-500 px-[10px] py-[5px] rounded font-semibold">Đang duyệt</span>
                            <span  v-else class="text-white bg-green-500 px-[10px] py-[5px] rounded font-semibold">Đã duyệt</span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <button href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline mr-2" @click="handleDelete(post?.id)">Delete</button>
                            <button href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-2" @click="isToggleFormUpdate(post?.id)">View</button>
                            <button href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" @click="isToggleFormUpdate(post?.id)">Edit</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <Loading v-if="postStore.isLoading"/>
    </div>
    <PopupCreatePost v-if="isCreate" :onToggleCreate="isToggleFormCreate" />
    <PopupEditPost v-if="isUpdate" :onToggleUpdate="isToggleFormUpdate" :idTemp="idTemp"/>
</template>
<script setup>
    import {computed, onMounted, ref} from "vue"
    import Loading from "../../components/Loading.vue";
    import PopupCreatePost from "../../components/PopupCreatePost.vue";
    import PopupEditPost from "../../components/PopupEditPost.vue";
    import { usePostStore } from "../../stores/postStore";
    import { useBusinessStore } from "../../stores/businessStore";
    const isCreate = ref(false)
    const isUpdate = ref(false)
    const idTemp = ref("")
    const postStore = usePostStore()
    const businessStore = useBusinessStore()
    const isToggleFormCreate = () => {
        isCreate.value = !isCreate.value
    }
    const isToggleFormUpdate = (id) => {
        isUpdate.value = !isUpdate.value
        idTemp.value = id
    }

    const handleGetPostBusiness = async(token) => {
        await postStore.actGetPostByTokenBusiness(token)
    }

    onMounted(() => {
        handleGetPostBusiness(businessStore.accessToken)
    })

    const postData = computed(() => {
        return postStore.posts
    })

    const handleDelete = (id) => {
        if (confirm("Bạn có chắc chắn với thao tác này!") == true) {
            postStore.actDeletePost(id, businessStore.accessToken)
        } else {
            return 0
        }
    }
</script>
<style scoped>
</style>