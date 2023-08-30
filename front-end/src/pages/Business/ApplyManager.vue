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
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Số điện thoại
                </th>
                <th scope="col" class="px-6 py-3">
                    
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" v-for="apply in businessStore.applyList" :key="apply.id">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{apply.name}}
                </th>
                <td class="px-6 py-4">
                    Phun sờ nách
                </td>
                <td class="px-6 py-4">
                    llemanhbin@gmail.com
                </td>
                <td class="px-6 py-4">
                    {{apply.phone}}
                </td>
                <td class="px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View</a>
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
    const businessStore = useBusinessStore()
    const handleGetListApply = (token) => {
        businessStore.actGetApplyList(token)
    }

    onMounted(() => {
        handleGetListApply(businessStore.accessToken)
    })

</script>
<style lang="">
    
</style>