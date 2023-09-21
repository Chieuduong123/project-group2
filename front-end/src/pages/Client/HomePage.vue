<template lang="">
    <div>
        <!-- Home banner -->
        <HomeBanner/>
        <!-- Top công ty -->
        <div class="max-w-[1300px] mx-auto mt-5 border-b max-xl:px-[50px] max-md:px-[20px]">
            <h2 class="font-semibold text-[23px] max-sm:text-center">Công ty nổi bật</h2>
            <div class="mt-10 pb-5 w-full">
                <swiper
                    :modules="modules"
                    :slides-per-view="calculateSlidesPerView()"
                    :space-between="10"
                    navigation
                    :pagination="{ clickable: true }"
                    :loop="true"
                    :autoplay="{delay: 2000}"
                >
                    <swiper-slide v-for="business in businessData" :key="business?.id" @click="handleGoDetailBusiness(business?.id)">
                        <div class="flex flex-col items-center gap-2">
                            <div class="w-[200px] h-[100px] rounded-[10px] flex items-center justify-center border">
                                <img v-if="handleCheckLinkImage(business?.avatar)" :src="business?.avatar || `https://tieusu.com/wp-content/uploads/2023/06/tieu-su-Rose-BlackPink.jpg`" alt="image" class="object-contain h-[50px] rounded">
                                <img v-else :src="`${IMAGE_URL}${business?.avatar}` || `https://tieusu.com/wp-content/uploads/2023/06/tieu-su-Rose-BlackPink.jpg`" alt="image" class="object-cover h-[50px] rounded">
                            </div>
                            <span class="text-[18px] font-semibold text-center">{{business?.name}}</span>
                        </div>
                    </swiper-slide>
                </swiper>
            </div>
        </div>
        <!-- JoB -->
        <div class="max-w-[1300px] mx-auto mt-[50px] max-xl:px-[50px]">
            <h2 class="font-semibold text-[23px] mb-[20px] max-sm:text-center">Công việc nổi bật</h2>
            <div class="grid grid-cols-3 gap-5 max-sm:grid-cols-1 max-xl:grid-cols-2">
                <PostVue v-for="post in TopPostPagination" :key="post.id" :post="post"/>
            </div>
            <div class="flex justify-center mt-5">
                <PaginationVue :pageArray="topPageArray" :currentPage="topCurrentPage" :goToPage="topGoToPage"/>
            </div>
        </div>
        <!-- Banner -->
        <div class="max-w-[1300px] mx-auto mt-[50px]">
            <img src="../../assets/images/banner2.png" alt="banner" class="w-full h-[300px] object-cover rounded-xl">
        </div>
        <!-- Suggest job -->
        <div v-if="userStore?.recommend && userStore?.accessToken" class="max-w-[1300px] mx-auto mt-[50px] max-xl:px-[50px]">
            <h2 class="font-semibold text-[23px] mb-[20px] max-sm:text-center">Dành cho bạn</h2>
            <swiper
                :modules="modules"
                :slides-per-view="3"
                :space-between="10"
                navigation
                :pagination="{ clickable: true }"
                :loop="true"
                :autoplay="{delay: 2000}"
            >
                <swiper-slide v-for="post in userStore?.recommend" :key="post.id">
                    <PostVue  :post="post"/>
                </swiper-slide>
            </swiper>
        </div>
        <!-- New Job -->
        <div class="max-w-[1300px] mx-auto mt-[50px] max-xl:px-[50px]">
            <h2 class="font-semibold text-[23px] mb-[20px] max-sm:text-center">Công việc mới nhất</h2>
            <div class="grid grid-cols-3 gap-5 max-sm:grid-cols-1 max-xl:grid-cols-2">
                <PostVue v-for="post in PostPagination" :key="post.id" :post="post"/>
            </div>
            <div class="flex justify-center mt-5">
                <PaginationVue :pageArray="pageArray" :currentPage="currentPage" :goToPage="goToPage"/>
            </div>
        </div>
        <!-- Why us -->
        <div class="h-screen max-w-[1300px] mx-auto flex items-center max-xl:px-[50px] max-sm:flex-col max-sm:mt-[50px]">
            <div class="flex-1 flex flex-col gap-5">
                <h3 class="font-normal text-gray-50px0 text-[18px] max-sm:text-center">Tại sao lại là chúng tôi</h3>
                <p class="font-bold text-[30px]  max-sm:text-center"><span class="text-green-500">Juong Job. </span>Nơi tìm kiếm cơ hội.</p>
                <p class="max-sm:text-center">
                    Phosfluorescently develop empowered communit rather than front-end networks. Competently formula revolut infrastructures with hi standards.
                </p>
                <ul class="flex flex-col gap-2">
                    <li class="font-semibold flex items-center gap-4">
                        <div class="flex items-center justify-center w-[40px] h-[40px] bg-green-200 rounded-full">
                            <SafetyCertificateOutlined :style="{fontSize: '14px', color: '#03C988'}"/>
                        </div>
                        Payment Gateway Secure
                    </li>
                    <li class="font-semibold flex items-center gap-4">
                        <div class="flex items-center justify-center w-[40px] h-[40px] bg-green-200 rounded-full">
                            <UploadOutlined :style="{fontSize: '14px', color: '#03C988'}"/>
                        </div>
                        Quick Delivery & Fast Load
                    </li>
                    <li class="font-semibold flex items-center gap-4">
                        <div class="flex items-center justify-center w-[40px] h-[40px] bg-green-200 rounded-full">
                            <ClockCircleOutlined :style="{fontSize: '14px', color: '#03C988'}"/>
                        </div>
                        Work Per Hour & Screenshots
                    </li>
                </ul>
            </div>
            <div class="flex-1">
                <img src="https://html.creativegigstf.com/khuj/khuj/images/banner/banner-3.jpg" alt="image">
            </div>
        </div>
    </div>
    <Loading v-if="postStore?.isLoading"/>
</template>
<script setup>
    import {ClockCircleOutlined, SafetyCertificateOutlined, UploadOutlined} from "@ant-design/icons-vue"
    // import Swiper core and required modules
    import { Navigation, Pagination, Scrollbar, A11y, Autoplay } from 'swiper/modules';
    // Import Swiper Vue.js components
    import { Swiper, SwiperSlide } from 'swiper/vue';
    // Import Swiper styles
    import 'swiper/css';
    import 'swiper/css/navigation';
    import 'swiper/css/pagination';
    import 'swiper/css/scrollbar';
    import HomeBanner from '../../components/HomeBanner.vue';
    import PostVue from "../../components/Post.vue"
    import PaginationVue from "../../components/Pagination.vue";
    import { usePostStore } from "../../stores/postStore";
    import { computed, onMounted, ref } from "vue";
    import { useBusinessStore } from "../../stores/businessStore";
    import { useRouter } from "vue-router";
    import Loading from "../../components/Loading.vue";
import { IMAGE_URL } from "../../constants/url";
import { useUserStore } from "../../stores/userStore";
    const modules= [Navigation, Pagination, Scrollbar, A11y, Autoplay]
    const router = useRouter()
    const postStore = usePostStore()
    const businessStore = useBusinessStore()
    const userStore = useUserStore()
    const itemsPerPage = ref(6)
    const totalPages = ref(1)
    const currentPageInit = ref(1)

    const handleCheckLinkImage = (url) => {
        return url?.startsWith("https");
    }
    const calculateSlidesPerView = () => {
      // Tính toán số lượng slides hiển thị trên mỗi view dựa trên độ rộng cửa sổ hoặc thiết bị
      const windowWidth = window.innerWidth;

      if (windowWidth >= 1200) {
        return 6; // Hiển thị 6 slides trên màn hình lớn
      } else if (windowWidth >= 768) {
        return 4; // Hiển thị 4 slides trên tablet
      } else {
        return 1; // Hiển thị 2 slides trên điện thoại
      }
    }
    const handleGetTopData = async() => {
        await postStore.actGetTopPost()
    }
    const handleGetAllData = async() => {
        await postStore.actGetAllPost()
    }

    const handleGetAllBusiness = async() => {
        await businessStore.actGetAllBusiness()
    }
    const handleGetRecommendPost = async() => {
        await userStore.actGetPostRecommend(userStore.accessToken)
    }
    onMounted(() => {
        handleGetAllData()
        handleGetAllBusiness()
        handleGetTopData()
        if(userStore.accessToken) {
            handleGetRecommendPost()
        }
    })
   

    const postsData = computed(() => {
        return postStore.posts
    })

    const businessData = computed(() => {
        return businessStore.businesses
    })

    const handleGoDetailBusiness = (id) => {
        router.push(`company/${id}`)
    }
// Pagination top post
    const TopPostPagination = computed(() => {
        totalPages.value = Math.ceil(postStore?.topPosts.length / itemsPerPage.value)
        const startIndex = (currentPageInit.value - 1) * itemsPerPage.value;
        totalPages.value = Math.ceil(postStore.topPosts.length / itemsPerPage.value)
        const endIndex = startIndex + itemsPerPage.value;
        return postStore?.topPosts?.slice(startIndex, endIndex);
    });

    const topPageArray = computed(() => {
        const arr = [];
        for (let i = 1; i <= totalPages.value; i++) {
            arr.push(i);
        }
        return arr;
    });


    const topGoToPage = (pageNumber) => {
        currentPageInit.value = pageNumber;
    };

    const topCurrentPage = computed(() => {
        return currentPageInit.value
    })
    // Pagination post
    const PostPagination = computed(() => {
        const startIndex = (postStore.currentPage - 1) * postStore.itemsPerPage;
        const endIndex = startIndex + postStore.itemsPerPage;
        return postStore.posts.slice(startIndex, endIndex);
    });

    const pageArray = computed(() => {
        const arr = [];
        for (let i = 1; i <= postStore.totalPages; i++) {
            arr.push(i);
        }
        return arr;
    });

    const goToPage = (pageNumber) => {
        postStore.currentPage = pageNumber;
    };

    const currentPage = computed(() => {
        return postStore.currentPage
    })
</script>
<style >
    .swiper-scrollbar {
        display: none;
    }
    .swiper-scrollbar-drag {
        display: none;
    }
</style>