<template lang="">
    <div class="mt-[150px]">
        <h1 class="font-semibold text-[24px] text-center">Cài đặt gợi ý việc làm</h1>
        <div class="flex justify-center " >
            <form action="" class="flex flex-col gap-5 px-[20px] pt-[40px] pb-[20px] rounded shadow" @submit.prevent="handleSubmit">
                <div class="flex items-center justify-between gap-5">
                    <div class="flex flex-col gap-1 w-full">
                        <label for="" class="text-[13px] font-medium">Tên vị trí <RedTick/></label>
                        <input type="text" v-model="recommendRef.position" placeholder="Nhập tên vị trí" class="border rounded px-[10px] py-[5px] text-[14px] outline-none">
                    </div>
                </div>
                <div class="flex items-center justify-between gap-5">
                    <div class="flex flex-col gap-1 w-full">
                        <label for="" class="text-[13px] font-medium">Mức lương <RedTick/></label>
                        <input type="number" v-model="recommendRef.salary" placeholder="Nhập số lượng tuyển" class="border rounded px-[10px] py-[5px] text-[14px] outline-none">
                    </div>
                    <div class="flex flex-col gap-1 w-full">
                        <label for="" class="text-[13px] font-medium">Địa điểm <RedTick/></label>
                        <select name="" id="" v-model="recommendRef.location" class="border rounded px-[10px] py-[5px] text-[14px] outline-none">
                        <option value="" >Chọn địa điểm làm việc</option>
                            <option :value="province.name" v-for="province in dataLocation" :key="province.id">{{province.name}}</option>
                        </select>                    
                    </div>
                </div>
                <div class="flex items-center justify-between gap-5">
                    <div class="flex flex-col gap-1 w-full">
                        <label for="" class="text-[13px] font-medium">Loại công việc <RedTick/></label>
                        <a-select
                            v-model:value="recommendRef.type"
                            mode="tags"
                            style="width: 100%"
                            placeholder="Chọn kỹ năng phù hợp"
                            :options="optionTypeJob"
                        ></a-select>
                    </div>
                </div>
                <div class="flex flex-col gap-1">
                    <label for="" class="text-[13px] font-medium">Level <RedTick/></label>
                    <a-select
                        v-model:value="recommendRef.level"
                        mode="tags"
                        style="width: 100%"
                        placeholder="Chọn level"
                        :options="optionLevel"

                    ></a-select>
                </div>
                <div class="flex flex-col gap-1">
                    <label for="" class="text-[13px] font-medium">Kỹ năng <RedTick/></label>
                    <a-select
                        v-model:value="recommendRef.skill"
                        mode="tags"
                        style="width: 100%"
                        placeholder="Chọn kỹ năng phù hợp"
                        :options="optionSkills"
                    ></a-select>
                </div>
                <button type="submit" class="bg-green-500 rounded font-medium text-[#fff] px-[10px] py-[5px] text-[15px]" >Cập nhật</button>
            </form>
        </div>
    </div>
    <Loading v-if="userStore.isLoading"/>
</template>
<script setup>
    import { onMounted, ref, watchEffect } from 'vue';
import { skillData } from '../../constants/skillData';
import { dataLocation } from '../../constants/dataLocation';
import { useToast } from 'vue-toastification';
import RedTick from "../../components/RedTick.vue"
import { useUserStore } from '../../stores/userStore';
import Loading from '../../components/Loading.vue';
const toast = useToast()
const userStore = useUserStore()
    const levelArray = ["Intern", "Fresher", "Junior", "Middle", "Senior"]
    const typeJobArray = ["Full time",  "Part time", "Remote"]
    const recommendRef = ref({
        position: "",
        level: [],
        type: [],
        skill: [],
        salary: "",
        location: ""
    })
    const optionLevel = levelArray.map((level) => ({
        value: level
    }));

    const optionSkills = skillData.map((skill) => ({
        value: skill,
    }));

    const optionTypeJob = typeJobArray.map((type) => ({
        value: type,
    }));

    const handleGetRecommend = (token) => {
        userStore.actGetRecommend(token)
    }

    onMounted(() => {
        handleGetRecommend(userStore.accessToken)
    })

    watchEffect(() => {
        const recommend = userStore.recommend;
        if(recommend) {
            recommendRef.value.position = recommend.position;
            recommendRef.value.level = recommend.level;
            recommendRef.value.salary = recommend.salary;
            recommendRef.value.type = recommend.type;
            recommendRef.value.skill = recommend.skill;
            recommendRef.value.location = recommend.location;
        }
    })
    
    const handleSubmit = () => {
        if(!recommendRef.value.position || recommendRef.value.level.length == 0 || recommendRef.value.type.length == 0 || recommendRef.value.skill.length == 0 || !recommendRef.value.salary || !recommendRef.value.location) {
            toast.warning("Vui lòng nhập đầy đủ thông tin")
        }
        if(userStore?.recommend) {
            userStore.actUpdateRecommend(userStore.recommend?.id ,recommendRef.value, userStore.accessToken)
        }else {
            userStore.actCreateRecommend(recommendRef.value, userStore.accessToken)
        }
    }
</script>
<style lang="">
    
</style>