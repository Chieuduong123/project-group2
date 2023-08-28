<template lang="">
    <div class="max-w-[1300px] mx-auto mt-[100px] flex gap-5">
        <div class="rounded w-[30%] h-max flex flex-col gap-5 bg-green-100 py-[40px] px-[20px]">
            <div>
                <img :src="postData?.business?.logo" alt="logo" class="h-[50px] w-[50px] rounded object-cover">
                <p class="mt-2 font-medium">{{postData?.business?.name}}</p>
            </div>
            <p class="text-gray-500">
                {{postData?.business?.career}}
            </p>
            <div>
                <p class="">Số lượng bài đăng:</p>
                <p class="font-semibold">{{postData?.quantity}} Jobs</p>
            </div>
            <div>
                <p class="">Quy mô công ty:</p>
                <p class="font-semibold">{{postData?.business?.size}}</p>
            </div>
            <div>
                <p class="">Email:</p>
                <p class="font-semibold">{{postData?.business?.email}}</p>
            </div>
            <div>
                <p class="">Website:</p>
                <p class="font-semibold">{{postData?.business?.website}}</p>
            </div>
            <div>
                <p class="">Địa chỉ công ty:</p>
                <p class="font-semibold">{{postData?.business?.location}}</p>
            </div>
            <button class="bg-green-500 text-white text-[14px] font-semibold px-[15px] py-[10px] rounded" @click="goDetailCompany(postData?.business?.id)">Xem thêm</button>
        </div>
        <div class="w-[70%]">
            <div class="shadow-lg flex flex-col gap-5 px-[30px] py-[30px] rounded">
                <div class="flex items-center justify-between border-b pb-[20px]">
                    <img src="https://html.creativegigstf.com/khuj/khuj/images/slider/slider-1.png" alt="logo" class="h-[30px] object-cover">
                    <p class="font-medium text-[18px]">${{postData?.salary}}<span class="text-[14px] font-normal">/Tháng</span></p>
                </div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[30px] font-semibold mb-2">{{postData?.position}}</p>
                        <div class="flex gap-5 items-center">
                            <div class="flex items-center gap-1">
                                <EnvironmentOutlined :style="{fontSize: '14px', color: '#9BA4B5'}"/>
                                <span>{{postData?.business?.location}}</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <ClockCircleOutlined :style="{fontSize: '14px', color: '#9BA4B5'}"/>
                                <span>{{postData?.type}}</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <ClockCircleOutlined :style="{fontSize: '14px', color: '#9BA4B5'}"/>
                                <span v-for="(level, index) in postData?.level">{{level}}/</span>
                            </div>
                        </div>
                    </div>
                    <button class="px-[10px] py-[5px] rounded bg-green-200 text-green-600" @click="handleToggleApplyPopUp">Ứng tuyển</button>
                </div>
            </div>
            <div class="mt-[50px] flex flex-col gap-5">
                <div>
                    <h2 class="text-[24px] font-medium">Mô tả công việc</h2>
                    <p class="mt-3 text-gray-500">
                        {{postData?.content}}
                    </p>
                </div>
                <div>
                    <h2 class="text-[24px] font-medium">Yêu cầu</h2>
                    <p class="mt-3 text-gray-500">
                        {{postData?.requirement}}
                    </p>
                </div>
                <div>
                    <h2 class="text-[24px] font-medium">Quyền lợi</h2>
                    <p class="mt-3 text-gray-500">
                        {{postData?.benefits}}
                    </p>
                </div>
                <div>
                    <h2 class="text-[24px] font-medium">Kỹ năng</h2>
                    <p class="mt-3 text-gray-500">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolorem nostrum dolores accusamus a vero consequuntur dolorum, autem repellat quaerat architecto officia quos animi? Ipsum aperiam delectus consectetur labore, nesciunt voluptatem!
                    </p>
                    <div class="mt-5 flex flex-wrap gap-3 px-[20px]">
                        <div class="px-[15px] py-[5px] bg-green-100 text-green-600 font-semibold rounded" v-for="(skill, index) in postData?.skills" :key="index" >
                            {{skill}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <ApplyPopup v-if="isApply" :toggle="handleToggleApplyPopUp"/>
</template>
<script setup>
    import {EnvironmentOutlined, ClockCircleOutlined} from "@ant-design/icons-vue"
    import { useRoute, useRouter } from "vue-router";
    import { usePostStore } from "../../stores/postStore";
    import { computed, onMounted, ref } from "vue";
    import ApplyPopup from "../../components/ApplyPopup.vue"
    
    const route = useRoute()
    const router = useRouter()
    const postStore = usePostStore()
    const idPost = route.params.id
    const isApply = ref(false)

    const goDetailCompany = (id) => {
        router.push(`/company/${id}`)
    }
    const handleToggleApplyPopUp = () => {
        isApply.value = !isApply.value
    }
    const handleGetPostById = async(idPost) => {
       await postStore.actGetPostById(idPost)
    }

    onMounted(() => {
        handleGetPostById(idPost)
    })

    const postData = computed(() => {
        return postStore.post
    })
    console.log(route.params.id);
</script>
<style lang="">
    
</style>