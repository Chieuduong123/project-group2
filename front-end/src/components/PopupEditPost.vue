<template lang="">
    <div class="fixed inset-0  z-30 cursor-pointer bg-black opacity-70" @click="onToggleUpdate">
    </div>
    <div class="flex justify-center " >
        <form action="" class="absolute top-0 mt-[20px] translate-x-[-20%] flex flex-col gap-5 bg-white opacity-100 z-50 h-max px-[20px] pt-[20px] pb-[20px] rounded shadow">
            <div class="flex items-center justify-between">
                <h5>Cập nhật bài viêt {{idTemp}}</h5>
                <button class="" @click="onToggleUpdate"><CloseOutlined :style="{fontSize: '25px'}" /></button>
            </div>
            <div class="flex items-center justify-between gap-5">
                <div class="flex flex-col gap-1 w-full">
                    <label for="" class="text-[13px] font-medium">Tên vị trí <RedTick/></label>
                    <input type="text" v-model="postUpdateData.position" placeholder="Nhập tên vị trí" class="border rounded px-[10px] py-[5px] text-[14px] outline-none">
                </div>
                <div class="flex flex-col gap-1 w-full">
                    <label for="" class="text-[13px] font-medium">Số lượng tuyển <RedTick/></label>
                    <input type="number" v-model="postUpdateData.quantity" placeholder="Nhập số lượng tuyển" class="border rounded px-[10px] py-[5px] text-[14px] outline-none">
                </div>
            </div>
            <div class="flex items-center justify-between gap-5">
                <div class="flex flex-col gap-1 w-full">
                    <label for="" class="text-[13px] font-medium">Level <RedTick/></label>
                    <a-select
                        v-model:value="postUpdateData.level"
                        mode="tags"
                        style="width: 100%"
                        placeholder="Chọn level"
                        :options="optionLevel"
                        @change="handleChange"
                    ></a-select>
                </div>
                <div class="flex flex-col gap-1 w-full">
                    <label for="" class="text-[13px] font-medium">Mức lương <RedTick/></label>
                    <input type="number" v-model="postUpdateData.salary" placeholder="Nhập số lượng tuyển" class="border rounded px-[10px] py-[5px] text-[14px] outline-none">
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
                        v-model:value="postUpdateData.type"
                        mode="tags"
                        style="width: 100%"
                        placeholder="Chọn kỹ năng phù hợp"
                        :options="optionTypeJob"
                        @change="handleChange"
                    ></a-select>
                </div>
            </div>
            <div class="flex flex-col gap-1">
                <label for="" class="text-[13px] font-medium">Mô tả công việc <RedTick/></label>
                <ckeditor :editor="editor" v-model="postUpdateData.content" ></ckeditor>
            </div>
            <div class="flex flex-col gap-1">
                <label for="" class="text-[13px] font-medium">Yêu cầu <RedTick/></label>
                <ckeditor :editor="editor" v-model="postUpdateData.requirement" ></ckeditor>            
            </div>
            <div class="flex flex-col gap-1">
                <label for="" class="text-[13px] font-medium">Kỹ năng <RedTick/></label>
                <a-select
                    v-model:value="postUpdateData.skill"
                    mode="tags"
                    style="width: 100%"
                    placeholder="Chọn kỹ năng phù hợp"
                    :options="optionSkills"
                    @change="handleChange"
                ></a-select>
            </div>
            <div class="flex flex-col gap-1">
                <label for="" class="text-[13px] font-medium">Quyền lợi <RedTick/></label>
                <ckeditor :editor="editor" v-model="postUpdateData.benefits" ></ckeditor>
            </div>
            <button  class="bg-green-500 rounded font-medium text-[#fff] px-[10px] py-[5px] text-[15px]" @click.prevent="onCLick">Submit</button>
        </form>
    </div>
</template>
<script setup>
import {CloseOutlined} from "@ant-design/icons-vue"
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    import {onMounted, ref, watch, watchEffect} from "vue"
    import {skillData} from "../constants/skillData"
import { useToast } from "vue-toastification";
import { usePostStore } from "../stores/postStore";
import { useBusinessStore } from "../stores/businessStore";
import RedTick from "./RedTick.vue";
    const levelArray = ["Intern", "Fresher", "Junior", "Middle", "Senior"]
    const typeJobArray = ["Full time",  "Part time", "Remote"]
    const value1 = ref(null);
    const editor = ClassicEditor
    const toast = useToast()
    const postStore = usePostStore()
    const businessStore = useBusinessStore()
    const {onToggleUpdate, idTemp} = defineProps({
        onToggleUpdate: Function,
        idTemp: String
    }) 

    const handleGetPostById = async(idPost) => {
        await postStore.actGetPostById(idPost)
    }

    onMounted(async() => {
        handleGetPostById(idTemp)
    })

    const postUpdateData = ref({
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
    watchEffect(() => {
        const post = postStore.post;
        if (post) {
            postUpdateData.value.position = post.position;
            postUpdateData.value.quantity = post.quantity;
            postUpdateData.value.type = post.type;
            postUpdateData.value.level = post.level;
            postUpdateData.value.salary = post.salary;
            postUpdateData.value.content = post.content;
            postUpdateData.value.requirement = post.requirement;
            postUpdateData.value.skill = post.skill;
            postUpdateData.value.benefits = post.benefits;
            postUpdateData.value.start_day = post.start_day;
            postUpdateData.value.end_day = post.end_day;
        }
    });

    const onCLick = () => {
        if(!postUpdateData.value.position || !postUpdateData.value.quantity || !postUpdateData.value.level || !postUpdateData.value.type || !postUpdateData.value.skill || !postUpdateData.value.salary || !postUpdateData.value.content || !postUpdateData.value.requirement || !postUpdateData.value.benefits || !value1.value) {
            toast.warning("Vui lòng nhập đủ thông tin")
        }else {
            let start = `${value1?.value[0]?.$y}-${value1?.value[0]?.$M+1}-${value1?.value[0]?.$D}`
            let end = `${value1?.value[1]?.$y}-${value1?.value[1]?.$M+1}-${value1?.value[1]?.$D}`
            postUpdateData.value = {
                ...postUpdateData.value,
                start_day: start,
                end_day: end,
            }
            postStore.actUpdatePost(postStore.post.id, postUpdateData.value, businessStore.accessToken);
            onToggleUpdate()
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