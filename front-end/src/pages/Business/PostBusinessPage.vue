<template lang="">
    <div class="flex gap-5">
        <div class=" flex flex-col justify-between overflow-x-auto sm:rounded-lg w-[60%] ">
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
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700" >
                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                            Full sờ  nách
                        </th>
                        <td class="px-4 py-3 text-center">
                            2
                        </td>
                        <td class="px-4 py-3 text-center">
                            2
                        </td>
                        <td class="px-4 py-3 text-center">
                            2
                        </td>
                        <td class="px-4 py-3 text-center">
                            Chờ duyệt
                        </td>
                        <td class="px-4 py-3 text-center">
                            <button href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline mr-2">Delete</button>
                            <button href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" >Edit</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <form action="" class="flex flex-col gap-5  w-[40%]" >
            <div class="flex items-center justify-between gap-5">
                <div class="flex flex-col gap-1 w-full">
                    <label for="" class="text-[13px] font-medium">Tên vị trí</label>
                    <input type="text" v-model="postData.position" placeholder="Nhập tên vị trí" class="border rounded px-[10px] py-[5px] text-[14px] outline-none">
                </div>
                <div class="flex flex-col gap-1 w-full">
                    <label for="" class="text-[13px] font-medium">Số lượng tuyển</label>
                    <input type="number" v-model="postData.quantity" placeholder="Nhập số lượng tuyển" class="border rounded px-[10px] py-[5px] text-[14px] outline-none">
                </div>
            </div>
            <div class="flex items-center justify-between gap-5">
                <div class="flex flex-col gap-1 w-full">
                    <label for="" class="text-[13px] font-medium">Level</label>
                    <a-select
                        v-model:value="postData.level"
                        mode="tags"
                        style="width: 100%"
                        placeholder="Chọn level"
                        :options="optionLevel"
                        @change="handleChange"
                    ></a-select>
                </div>
                <div class="flex flex-col gap-1 w-full">
                    <label for="" class="text-[13px] font-medium">Mức lương</label>
                    <input type="number" v-model="postData.salary" placeholder="Nhập số lượng tuyển" class="border rounded px-[10px] py-[5px] text-[14px] outline-none">
                </div>
            </div>
            <div class="flex items-center justify-between gap-5">
                <div class="flex flex-col gap-1 w-full">
                    <label for="" class="text-[13px] font-medium">Thời gian tuyển dụng</label>
                    <a-space direction="vertical" :size="12">
                        <a-range-picker v-model:value="value1" />
                    </a-space>
                </div>
                <div class="flex flex-col gap-1 w-full">
                    <label for="" class="text-[13px] font-medium">Loại công việc</label>
                    <a-select
                        v-model:value="postData.type"
                        mode="tags"
                        style="width: 100%"
                        placeholder="Chọn kỹ năng phù hợp"
                        :options="optionTypeJob"
                        @change="handleChange"
                    ></a-select>
                </div>
            </div>
            <div class="flex flex-col gap-1">
                <label for="" class="text-[13px] font-medium">Mô tả công việc</label>
                <ckeditor :editor="editor" v-model="postData.content" ></ckeditor>
            </div>
            <div class="flex flex-col gap-1">
                <label for="" class="text-[13px] font-medium">Yêu cầu</label>
                <ckeditor :editor="editor" v-model="postData.requiement" ></ckeditor>            
            </div>
            <div class="flex flex-col gap-1">
                <label for="" class="text-[13px] font-medium">Kỹ năng</label>
                <a-select
                    v-model:value="postData.skill"
                    mode="tags"
                    style="width: 100%"
                    placeholder="Chọn kỹ năng phù hợp"
                    :options="optionSkills"
                    @change="handleChange"
                ></a-select>
            </div>
            <div class="flex flex-col gap-1">
                <label for="" class="text-[13px] font-medium">Quyền lợi</label>
                <ckeditor :editor="editor" v-model="postData.benefits" ></ckeditor>
            </div>
            <button  class="bg-green-500 rounded font-medium text-[#fff] px-[10px] py-[5px] text-[15px]" @click.prevent="onCLick">Submit</button>
        </form>
    </div>
</template>
<script setup>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    import {ref, watch} from "vue"
    import {skillData} from "../../constants/skillData"
    const levelArray = ["Intern", "Fresher", "Junior", "Middle", "Senior"]
    const typeJobArray = ["Full time",  "Part time", "Remote"]
    const value1 = ref(null);

    const editor = ClassicEditor
    const postData = ref({
        business_id: "",
        position: "",
        quantity: "",
        level: [],
        type: [],
        skill: [],
        salary: "",
        content: "",
        requiement: "",
        benefits: "",
        start_day: "",
        end_day: "",
        status: false,
    })
    
    const onCLick = () => {
        let start = `${value1?.value[0]?.$y}-${value1?.value[0]?.$M+1}-${value1?.value[0]?.$D}`
        let end = `${value1?.value[1]?.$y}-${value1?.value[1]?.$M+1}-${value1?.value[1]?.$D}`
        postData.value = {
            ...postData.value,
            start_day: start,
            end_day: end,
        }
        console.log(postData.value);
    }
    
    const handleChange = (value) => {
        console.log(`selected ${value}`);
    };

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
<style scoped>
</style>