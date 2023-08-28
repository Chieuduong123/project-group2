<template lang="">
    <div class="">
        <div class="relative w-full h-[200px] bg-green-100">
            <h1 class="absolute text-white left-[50%] translate-x-[-50%] top-5 text-[30px] font-semibold">Khám phá 100.000+ công ty nổi bật</h1>
            <img src="	https://static.topcv.vn/top_lists/4b8ef4660883f68e7a54770b8e7341b4-61b968185df9c.jpg" alt="banner" class="object-cover w-full h-full">
            <div class="absolute left-[50%] translate-x-[-50%] top-[50%] flex items-center gap-2 bg-white pl-[20px] pr-[10px] py-[10px] rounded-full w-max">
                <SearchOutlined :style="{fontSize: '20px', color: '#9BA4B5'}"/>
                <input type="text" placeholder="Nhập tên công ty" class="outline-none w-[400px] text-[16px]">
                <button class="px-[10px] py-[5px] font-semibold text-[14px] text-white bg-green-500 rounded-full">Tìm kiếm</button>
            </div>
        </div>
        <h1 class="text-center font-semibold text-[34px] mt-[50px]">DANH SÁCH CÁC TOP CÔNG TY</h1>
        <div class="max-w-[1300px] mx-auto flex gap-5 flex-wrap mt-10">
            <CompanyCard/>
            <CompanyCard/>
            <CompanyCard/>
            <CompanyCard/>
            <CompanyCard/>
            <CompanyCard/>
        </div>
    </div>
</template>
<script setup>
    import {SearchOutlined} from "@ant-design/icons-vue"
    import CompanyCard from "../../components/CompanyCard.vue";
</script>
<style lang="">
    
</style>