<template lang="">
    <div class="flex gap-5 flex-wrap">
        <div class="px-[20px] py-[15px] border border-l-[5px] border-l-red-500 w-[270px]">
            <p class="font-semibold text-[18px]">Bài đăng đã duyệt</p>
            <div class="flex items-center justify-between">
                <p class="mb-0 font-medium">{{postIsConfirm.length}}</p>
                <FolderOutlined :style="{fontSize: '20px'}"/>
            </div>
            <router-link to="/business/post">
                <p class="text-gray-500 text-[14px] mb-0 text-right mt-5 cursor-pointer">View</p>
            </router-link>
        </div>
        <div class="px-[20px] py-[15px] border border-l-[5px] border-l-blue-500 w-[270px]">
            <p class="font-semibold text-[18px]">Tổng bài đăng</p>
            <div class="flex items-center justify-between">
                <p class="mb-0 font-medium">{{postStore?.posts?.length}}</p>
                <SmileOutlined :style="{fontSize: '20px'}"/>
            </div>
            <router-link to="/business/post">
                <p class="text-gray-500 text-[14px] mb-0 text-right mt-5 cursor-pointer">View</p>
            </router-link>
        </div>
        <div class="px-[20px] py-[15px] border border-l-[5px] border-l-green-500 w-[270px]">
            <p class="font-semibold text-[18px]">Số lượng đơn ứng tuyển</p>
            <div class="flex items-center justify-between">
                <p class="mb-0 font-medium">{{businessStore?.applyList?.length}}</p>
                <SolutionOutlined :style="{fontSize: '20px'}"/>
            </div>
            <router-link to="/business/apply-manager">
                <p class="text-gray-500 text-[14px] mb-0 text-right mt-5 cursor-pointer">View</p>
            </router-link>
        </div>
        <div class="px-[20px] py-[15px] border border-l-[5px] border-l-yellow-500 w-[270px]">
            <p class="font-semibold text-[18px]">Coming soon</p>
            <div class="flex items-center justify-between">
                <p class="mb-0 font-medium">10</p>
                <SmileOutlined :style="{fontSize: '20px'}"/>
            </div>
            <router-link to="">
                <p class="text-gray-500 text-[14px] mb-0 text-right mt-5 cursor-pointer">View</p>
            </router-link>
        </div>
    </div>
    <div class="mt-10">
        <h1 class="font-semibold">Đơn ứng tuyển hôm nay</h1>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Tên ứng viên
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Vị trí ứng tuyển
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Số điện thoại
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody >
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"  v-for="apply in newApply" :key="apply.id">
                    <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        <img v-if="handleCheckLinkImage(apply?.seeker?.avatar)" class="w-10 h-10 rounded-full" :src="apply?.seeker?.avatar" alt="Jese image">
                        <img v-else class="w-10 h-10 rounded-full" :src="`${IMAGE_URL}${apply?.seeker?.avatar}`" alt="Jese image">
                        <div class="pl-3">
                            <div class="text-base font-semibold">{{apply.name}}</div>
                            <div class="font-normal text-gray-500">{{apply?.seeker?.email}}</div>
                        </div>  
                    </th>
                    <td class="px-6 py-4">
                        {{apply?.job?.position}}
                    </td>
                    <td class="px-6 py-4">
                        {{apply.phone}}
                    </td>
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" @click="handleGoDetail(apply.id)">View</a>
                    </td>
                </tr>
            </tbody>
        </table>
        <Loading v-if="businessStore.isLoading"/>
    </div>
</template>
<script setup>
    import {FolderOutlined, SolutionOutlined, SmileOutlined} from '@ant-design/icons-vue'
    import { useBusinessStore } from '../../stores/businessStore';
    import { computed, onMounted } from 'vue';
    import { usePostStore } from '../../stores/postStore';
import { useRouter } from 'vue-router';
    const businessStore = useBusinessStore()
    const postStore = usePostStore()
    const router = useRouter()
    const handleGetListApply = (token) => {
        businessStore.actGetApplyList(token)
    }

    const handleGetPostBusiness = async(token) => {
        await postStore.actGetPostByTokenBusiness(token)
    }

    const newApply = computed(() => {
        const today  = new Date().toISOString().split('T')[0]
        return businessStore.applyList.filter((apply) => {
            const applyMatch = apply.created_at.split('T')[0]
            return applyMatch == today
        })
    })

    const postIsConfirm = computed(() => {
        return postStore.posts.filter((post) => post.status === 1 )
    })
    console.log("....",postIsConfirm.value);

    const handleCheckLinkImage = (url) => {
        if(url) {
            return url?.startsWith("https");
        }
    }

    const handleGoDetail = (id) => {
        router.push(`/business/apply-manager/${id}`)
    }
    
    onMounted(() => {
        handleGetListApply(businessStore.accessToken)
        handleGetPostBusiness(businessStore.accessToken)
    })

    
</script>
<style lang="">
    
</style>