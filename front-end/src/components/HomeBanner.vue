<template lang="">
    <div class="min-h-[70vh] w-full bg-green-200 py-[20px]">
        <h1 class="font-bold text-[25px] text-center">Tìm việc làm nhanh 24h, việc làm mới nhất trên toàn quốc.</h1>
        <p class="text-[14px] text-center text-gray-500">Tiếp cận 40,000+ tin tuyển dụng việc làm mỗi ngày từ hàng nghìn doanh nghiệp uy tín tại Việt Nam</p>
        <div class="flex items-center justify-center gap-5 mt-[20px]">
            <div class="flex items-center gap-5 bg-white rounded">
                <div class="flex items-center gap-2 px-[10px] py-[10px] relative before:absolute before:content-[''] before:h-[80%] before:w-[2px] before:bg-gray-500 before:right-0">
                    <SearchOutlined :style="{fontSize: '20px', color: '#9BA4B5'}"/>
                    <input type="text" v-model="positionRef" placeholder="Vị trí tuyển dụng" class="outline-none text-[15px]">
                </div>
                <div class="flex items-center gap-2 px-[10px] py-[10px]">
                    <EnvironmentOutlined :style="{fontSize: '20px', color: '#9BA4B5'}"/>
                    <select name="" id="" v-model="provinceSelect" class="text-gray-500 outline-none max-h-[300px]">
                        <option value="all" >Tất cả tỉnh/thành phố</option>
                        <option :value="province.name" v-for="province in dataLocation" :key="province.id">{{province.name}}</option>
                    </select>
                </div>
            </div>
            <div class="flex items-center gap-2 bg-white px-[10px] py-[10px] rounded">
                <StarOutlined :style="{fontSize: '20px', color: '#9BA4B5'}"/>
                <select name="" id="" v-model="levelSelect" class="text-gray-500 outline-none">
                    <option value="all">Tất cả kinh nghiệm</option>
                    <option value="intern">Intern</option>
                    <option value="fresher">Fresher</option>
                    <option value="junior">Junior</option>
                    <option value="middle">Middle</option>
                    <option value="senior">Senior</option>
                </select>
            </div>
            <button class="px-[15px] py-[10px] bg-green-500 text-white rounded font-semibold" @click="handleSearch">Tìm kiếm</button>
        </div>
        <div class="bg-white w-[70%] mx-auto mt-10 rounded-[10px] overflow-hidden">
            <swiper
                :slides-per-view="1"
                :space-between="50"
                :autoplay="{ delay: 3000 }"
                :loop="true"
                :modules="modules"
                :pagination="{ clickable: true }"
            >
                <swiper-slide>
                    <img src="../assets/images/banner1.png" alt="banner" class="h-[250px] w-full object-cover">
                </swiper-slide>
                <swiper-slide>
                    <img src="../assets/images/banner2.png" alt="banner" class="h-[250px] w-full object-cover">
                </swiper-slide>
            </swiper>
        </div>
    </div>
</template>
<script setup>
    import {SearchOutlined, EnvironmentOutlined, StarOutlined} from "@ant-design/icons-vue"
    import { Swiper, SwiperSlide } from 'swiper/vue';
    import 'swiper/css';
    import { ref, watch } from "vue";
    import { dataLocation } from "../constants/dataLocation";
    import {Pagination, Autoplay } from 'swiper/modules';
import { useRouter } from "vue-router";

    const modules = [Autoplay, Pagination]
    const router = useRouter()
    const positionRef = ref("");
    const provinceSelect = ref("all");
    const levelSelect = ref("all")
    watch(provinceSelect, (newValue) => {
        console.log(newValue);
    })

    const handleSearch = () => {
        router.push(`/search?position=${positionRef.value}&level=${levelSelect.value}&location=${provinceSelect.value}`)
    }
</script>
<style lang="">
    
</style>