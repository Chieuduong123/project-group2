<template lang="">
    <div class="fixed inset-0  z-30 cursor-pointer bg-black opacity-70" @click="onToggleCreate">
    </div>
    <div class="flex justify-center " >
        <form action="" class="absolute top-0 mt-[20px] translate-x-[-20%] flex flex-col gap-5 bg-white opacity-100 z-50 h-max px-[20px] pt-[40px] pb-[20px] rounded shadow">
            <button class="absolute right-[10px] top-[10px]" @click="onToggleCreate"><CloseOutlined :style="{fontSize: '25px'}" /></button>
            <div class="flex items-center justify-between gap-5">
                <div class="flex flex-col gap-1 w-full">
                    <label for="" class="text-[13px] font-medium">Tên vị trí <RedTick/></label>
                    <input type="text" v-model="postData.position" placeholder="Nhập tên vị trí" class="border rounded px-[10px] py-[5px] text-[14px] outline-none">
                </div>
                <div class="flex flex-col gap-1 w-full">
                    <label for="" class="text-[13px] font-medium">Số lượng tuyển <RedTick/></label>
                    <input type="number" v-model="postData.quantity" placeholder="Nhập số lượng tuyển" class="border rounded px-[10px] py-[5px] text-[14px] outline-none">
                </div>
            </div>
            <div class="flex items-center justify-between gap-5">
                <div class="flex flex-col gap-1 w-full">
                    <label for="" class="text-[13px] font-medium">Level <RedTick/></label>
                    <a-select
                        v-model:value="postData.level"
                        mode="tags"
                        style="width: 100%"
                        placeholder="Chọn level"
                        :options="optionLevel"

                    ></a-select>
                </div>
                <div class="flex flex-col gap-1 w-full">
                    <label for="" class="text-[13px] font-medium">Mức lương <RedTick/></label>
                    <input type="number" v-model="postData.salary" placeholder="Nhập số lượng tuyển" class="border rounded px-[10px] py-[5px] text-[14px] outline-none">
                </div>
            </div>
            <div class="flex items-center justify-between gap-5">
                <div class="flex flex-col gap-1 w-full">
                    <label for="" class="text-[13px] font-medium">Thời gian tuyển dụng <RedTick/></label>
                    <a-space direction="vertical" :size="12">
                        <a-range-picker v-model:value="value1" />
                    </a-space>
                </div>
                <div class="flex flex-col gap-1 w-full">
                    <label for="" class="text-[13px] font-medium">Loại công việc <RedTick/></label>
                    <a-select
                        v-model:value="postData.type"
                        mode="tags"
                        style="width: 100%"
                        placeholder="Chọn kỹ năng phù hợp"
                        :options="optionTypeJob"

                    ></a-select>
                </div>
            </div>
            <div class="flex flex-col gap-1">
                <label for="" class="text-[13px] font-medium">Mô tả công việc <RedTick/></label>
                <ckeditor :editor="editor" v-model="postData.content" ></ckeditor>
            </div>
            <div class="flex flex-col gap-1">
                <label for="" class="text-[13px] font-medium">Yêu cầu <RedTick/></label>
                <ckeditor :editor="editor" v-model="postData.requirement" ></ckeditor>            
            </div>
            <div class="flex flex-col gap-1">
                <label for="" class="text-[13px] font-medium">Kỹ năng <RedTick/></label>
                <a-select
                    v-model:value="postData.skill"
                    mode="tags"
                    style="width: 100%"
                    placeholder="Chọn kỹ năng phù hợp"
                    :options="optionSkills"
                ></a-select>
            </div>
            <div class="flex flex-col gap-1">
                <label for="" class="text-[13px] font-medium">Quyền lợi <RedTick/></label>
                <ckeditor :editor="editor" v-model="postData.benefits" ></ckeditor>
            </div>
            <button  class="bg-green-500 rounded font-medium text-[#fff] px-[10px] py-[5px] text-[15px]" @click.prevent="onCLick">Submit</button>
        </form>
    </div>
</template>
<script setup>
import {CloseOutlined} from "@ant-design/icons-vue"
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    import {ref, watch} from "vue"
    import {skillData} from "../constants/skillData"
import { useToast } from "vue-toastification";
import { usePostStore } from "../stores/postStore";
import RedTick from "./RedTick.vue";
import { useBusinessStore } from "../stores/businessStore";
    const levelArray = ["Intern", "Fresher", "Junior", "Middle", "Senior"]
    const typeJobArray = ["Full time",  "Part time", "Remote"]
    const value1 = ref(null);
    const editor = ClassicEditor
    const toast = useToast()
    const postStore = usePostStore()
    const businessStore = useBusinessStore()
    const {onToggleCreate} = defineProps({
        onToggleCreate: Function
    })
    const postData = ref({
        position: "",
        quantity: "",
        level: [],
        type: [],
        skill: [],
        salary: "",
        content: "",
        requirement: "",
        benefits: "",
        start_day: "",
        end_day: "",
        status: false,
    })
    
    const onCLick = () => {
        if(!postData.value.position || !postData.value.quantity || !postData.value.level || !postData.value.type || !postData.value.skill || !postData.value.salary || !postData.value.content || !postData.value.requirement || !postData.value.benefits || !value1.value) {
            toast.warning("Vui lòng nhập đủ thông tin")
        }else {
            let start = `${value1?.value[0]?.$y}-${value1?.value[0]?.$M+1}-${value1?.value[0]?.$D}`
            let end = `${value1?.value[1]?.$y}-${value1?.value[1]?.$M+1}-${value1?.value[1]?.$D}`
            postData.value = {
                ...postData.value,
                start_day: start,
                end_day: end,
            }
            const formData= new FormData()
            // formData.append('position', postData.value.position)
            // formData.append('level', postData.value.level)
            // formData.append('type', postData.value.type)
            // formData.append('skill', postData.value.skill)
            // formData.append('salary', postData.value.salary)
            // formData.append('content', postData.value.content)
            // formData.append('requirement', postData.value.requirement)
            // formData.append('quantity', postData.value.quantity)
            // formData.append('benefits', postData.value.benefits)
            // formData.append('start_day', postData.value.start_day)
            // formData.append('end_day', postData.value.end_day)
            postStore.actCreatePost(postData?.value, businessStore?.accessToken)
            onToggleCreate()
        }
    }

    const optionLevel = levelArray.map((level) => ({
        value: level
    }));

    const optionSkills = skillData.map((skill) => ({
        value: skill,
    }));

    const optionTypeJob = typeJobArray.map((type) => ({
        value: type,
    }));
</script>
<style lang="">
    
</style>