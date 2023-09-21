<template lang="">
    <div class="p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
        Danh sách ứng tuyển
        <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Browse a list of Flowbite products designed to help you work and play, stay organized, get answers, keep in touch, grow your business, and more.</p>
    </div>
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
        <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"  v-for="apply in businessStore.applyList" :key="apply.id">
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
</template>
<script setup>
import { onMounted } from 'vue';
import { useBusinessStore } from '../../stores/businessStore';
    import Loading from '../../components/Loading.vue';
    import {handleCheckLinkImage} from "../../constants/func"
import { useRouter } from 'vue-router';
import { IMAGE_URL } from '../../constants/url';

    const businessStore = useBusinessStore()
    const router = useRouter()
    const handleGetListApply = (token) => {
        businessStore.actGetApplyList(token)
    }

    onMounted(() => {
        handleGetListApply(businessStore.accessToken)
    })

    const handleGoDetail = (id) => {
        router.push(`/business/apply-manager/${id}`)
    }

</script>
<style lang="">
    
</style>