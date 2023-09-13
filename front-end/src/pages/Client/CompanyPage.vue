<template lang="">
    <div class="">
        <div class="relative w-full h-[200px] pt-[20px]" style="background-image: url('https://static.topcv.vn/top_lists/4b8ef4660883f68e7a54770b8e7341b4-61b968185df9c.jpg'); background-repeat: no-repeat; background-size: cover;">
            <h1 class="text-center text-white text-[30px] font-semibold px-[20px]">Khám phá 100.000+ công ty nổi bật</h1>
            <div class="w-[70%] absolute left-[50%] translate-x-[-50%] top-[50%] flex items-center gap-2 bg-white pl-[20px] pr-[10px] py-[10px] rounded-full">
                <SearchOutlined :style="{fontSize: '20px', color: '#9BA4B5'}"/>
                <input v-model="searchRef" type="text" placeholder="Nhập tên công ty" class="outline-none w-full text-[16px]">
                <!-- <button class="px-[10px] py-[5px] font-semibold text-[14px] text-white bg-green-500 rounded-full">Tìm kiếm</button> -->
            </div>
        </div>
        <h1 class="text-center font-semibold text-[34px] mt-[50px] px-[20px]">DANH SÁCH CÁC TOP CÔNG TY</h1>
        <div v-if="businessData.length > 0">
            <div class="max-w-[1300px] mx-auto max-xl:px-[50px] max-md:px-[20px] grid grid-cols-3 gap-5 max-sm:grid-cols-1 max-xl:grid-cols-2s mt-10">
                <CompanyCard v-for="business in PostPagination" :key="business.id" :business="business"/>
            </div>
            <div class="flex justify-center mt-5">
                <Pagination :pageArray="pageArray" :currentPage="currentPage" :goToPage="goToPage"/>
            </div>
        </div>
        <h1 v-else class="mt-[50px] text-center text-[24px] text-gray-500 font-semibold">Không tìm thấy công ty nào</h1>
    </div>
    <Loading v-if="businessStore.isLoading"/>
</template>
<script setup>
    import {SearchOutlined} from "@ant-design/icons-vue"
    import CompanyCard from "../../components/CompanyCard.vue";
    import { useBusinessStore } from "../../stores/businessStore";
    import { useRouter } from "vue-router";
    import {computed, onMounted, ref} from "vue"
    import Loading from "../../components/Loading.vue";
    import Pagination from "../../components/Pagination.vue";
    const businessStore = useBusinessStore()
    const searchRef = ref("")
    const itemsPerPage = ref(6)
    const totalPages = ref(1)
    const currentPageInit = ref(1)
    const handleGetAllBusiness = async() => {
        await businessStore.actGetAllBusiness()
    }
    onMounted(async () => {
        handleGetAllBusiness()
    })

    const businessData = computed(() => {
        return businessStore.businesses.filter((business) => {
            return business?.name?.toLowerCase().includes(searchRef.value.toLowerCase());
        })
    })

    // Pagination
    const PostPagination = computed(() => {
        const startIndex = (currentPageInit.value - 1) * itemsPerPage.value;
        const endIndex = startIndex + itemsPerPage.value;
        totalPages.value = Math.ceil(businessStore.businesses.length / itemsPerPage.value)
        const filteredBusinesses = businessStore.businesses.filter((business) => {
            const businessName = business?.name?.toLowerCase();
            const searchQuery = searchRef.value.toLowerCase();
            return businessName.includes(searchQuery);
        });

        return filteredBusinesses.slice(startIndex, endIndex);
    });

    const pageArray = computed(() => {
        const arr = [];
        for (let i = 1; i <= totalPages.value; i++) {
            arr.push(i);
        }
        return arr;
    });

    const goToPage = (pageNumber) => {
        currentPageInit.value = pageNumber;
    };

    const currentPage = computed(() => {
        return currentPageInit.value
    })


</script>
<style lang="">
    
</style>