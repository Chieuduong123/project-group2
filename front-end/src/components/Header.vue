<template lang="">
    <header class="h-[80px] fixed top-0 left-0 right-0 z-30 bg-white shadow-lg py-[20px] px-[20px]">
        <div class="flex items-center justify-between max-w-[1300px] mx-auto">
            <router-link to="/">
                <h1 class="font-bold text-[25px] m-0 text-green-500">Juong Job.</h1>
            </router-link>
            <!-- oVERLAY -->
            <div v-if="isOpenNav" class="fixed inset-0 bg-black opacity-70 z-20" @click="handleToggleNav">
            </div>
            <ul class="flex items-center gap-[30px] max-md:flex-col max-md:bg-white max-md:fixed max-md:w-[70%] z-30 max-md:shadow max-md:pt-[50px] max-md:text-[24px] ease-in-out duration-300" :class="isOpenNav ? 'max-md:right-0 max-md:top-0 max-md:bottom-0 ' : 'max-md:right-[-100%] max-md:top-0 max-md:bottom-0 '">
                <!-- Close btn -->
                <div class="absolute top-[10px] left-[10px] cursor-pointer md:hidden" @click="handleToggleNav">
                    <CloseOutlined :style="{fontSize: '30px'}"/>
                </div>
                <li class="li-root relative">
                    <router-link to="/">Việc làm</router-link>
                    <ul class="child-list absolute rounded bg-white shadow-lg min-w-[300px] px-[10px] py-[10px]">
                        <router-link to="/">
                            <li class="li-widget px-[10px] text-green-400 mb-3 py-[10px] rounded text-[14px] font-medium flex items-center justify-between gap-5">
                                <div class="flex items-center gap-5">
                                    <SearchOutlined :style="{fontSize: '20px'}"/>
                                    <span class="li-text text-white">
                                        Tìm công việc 
                                    </span>
                                </div>
                                <div class="arrow-right">
                                    <ArrowRightOutlined />
                                </div>
                            </li>
                        </router-link>
                        <router-link to="/history">
                            <li class="li-widget px-[10px] text-green-400 py-[10px] mb-3 rounded text-[14px] font-medium flex  items-center justify-between">
                                <div class="flex items-center gap-5">
                                    <HistoryOutlined :style="{fontSize: '20px'}"/>
                                    <span class="li-text text-white">
                                        Việc làm đã ứng tuyển
                                    </span>
                                </div>
                                <div class="arrow-right">
                                    <ArrowRightOutlined />
                                </div>
                            </li>
                        </router-link>
                        <router-link to="/favorite">
                            <li class="li-widget px-[10px] text-green-400 py-[10px] rounded text-[14px] font-medium flex  items-center justify-between">
                                <div class="flex items-center gap-5">
                                    <HeartOutlined :style="{fontSize: '20px'}"/>
                                    <span class="li-text text-white">
                                        Việc làm đã lưu
                                    </span>
                                </div>
                                <div class="arrow-right">
                                    <ArrowRightOutlined />
                                </div>
                            </li>
                        </router-link>
                    </ul>
                </li>
                <li v-if="userStore?.isLogged === true" class="li-root relative">
                    <router-link to="cv-management">Hồ sơ & CV</router-link>
                    <ul class="child-list absolute rounded bg-white shadow-lg min-w-[300px] px-[10px] py-[10px] max-md:hidden">
                        <router-link to="/cv-management">
                            <li class="li-widget px-[10px] text-green-400 py-[10px] rounded text-[14px] font-medium flex items-center justify-between gap-5">
                                <div class="flex items-center gap-5">
                                    <ProfileOutlined :style="{fontSize: '20px'}"/>
                                    <span class="li-text text-white">
                                        Quản lý CV
                                    </span>
                                </div>
                                <div class="arrow-right">
                                    <ArrowRightOutlined />
                                </div>
                            </li>
                        </router-link>
                        <router-link to="/create-cv">
                            <li class="li-widget px-[10px] mt-3 text-green-400 py-[10px] rounded text-[14px] font-medium flex items-center justify-between gap-5">
                                <div class="flex items-center gap-5">
                                    <ProfileOutlined :style="{fontSize: '20px'}"/>
                                    <span class="li-text text-white">
                                    Tạo CV
                                    </span>
                                </div>
                                <div class="arrow-right">
                                    <ArrowRightOutlined />
                                </div>
                            </li>
                        </router-link>
                    </ul>
                </li>
                <li class="li-root relative">
                    <router-link to="/company">Công ty</router-link>
                    <!-- <ul class="child-list absolute rounded bg-white shadow-lg min-w-[300px] px-[10px] py-[10px]">
                        <li class="li-widget px-[10px] text-green-400 mb-3 py-[10px] rounded text-[14px] font-medium flex items-center justify-between gap-5">
                            <div class="flex items-center gap-5">
                                <ShopOutlined :style="{fontSize: '20px'}"/>
                                <span class="li-text text-white">
                                    Danh sách công ty
                                </span>
                            </div>
                            <div class="arrow-right">
                                <ArrowRightOutlined />
                            </div>
                        </li>
                        <li class="li-widget px-[10px] text-green-400 py-[10px] rounded text-[14px] font-medium flex  items-center justify-between">
                            <div class="flex items-center gap-5">
                                <StarOutlined :style="{fontSize: '20px'}"/>
                                <span class="li-text text-white">
                                    Top công ty
                                </span>
                            </div>
                            <div class="arrow-right">
                                <ArrowRightOutlined />
                            </div>
                        </li>
                    </ul> -->
                </li>
                <li class="li-root">
                    <router-link to="/about">Về chúng tôi</router-link>
                </li>
                <!-- <li class="li-root">
                    <router-link to="/blog">Tin tức</router-link>
                </li> -->
            </ul>
            <div v-if="userStore?.isLogged" class="flex items-center gap-5 max-sm:gap-2">
                <div class="flex gap-5 md:hidden max-sm:gap-2">
                    <router-link to="/history">
                        <SaveFilled :style="{fontSize: '25px', color: 'green', marginRight: '5px', cursor: 'pointer'}"/>
                    </router-link>
                    <router-link to="/favorite">
                        <HeartFilled :style="{fontSize: '25px', color: 'green', marginRight: '5px', cursor: 'pointer'}"/>
                    </router-link>
                </div>
                <BellFilled :style="{fontSize: '25px', color: 'green', marginRight: '5px', cursor: 'pointer'}"/>
                <!-- User headlessui -->
                <Menu as="div" class="relative z-20 inline-block text-left">
                    <MenuButton
                        class="w-[40px] h-[40px]"
                        >
                        <img :src="userStore?.myUser?.avatar ? `${IMAGE_URL}${userStore?.myUser?.avatar}` : 'https://e7.pngegg.com/pngimages/178/595/png-clipart-user-profile-computer-icons-login-user-avatars-monochrome-black-thumbnail.png'" alt="avatar" class="w-full h-full object-cover rounded-full">
                    </MenuButton>
                    <transition
                        enter-active-class="transition duration-100 ease-out"
                        enter-from-class="transform scale-95 opacity-0"
                        enter-to-class="transform scale-100 opacity-100"
                        leave-active-class="transition duration-75 ease-in"
                        leave-from-class="transform scale-100 opacity-100"
                        leave-to-class="transform scale-95 opacity-0"
                    >
                        <MenuItems
                        class="absolute right-0 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                        >
                        <div class="px-1 py-1">
                            <MenuItem v-slot="{ active }">
                            <button
                                :class="[
                                active ? 'bg-green-500 text-white' : 'text-gray-900',
                                'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                ]"
                                @click="goProfile"
                            >
                                <ProfileOutlined :style="{fontSize: '20px', color: 'green', marginRight: '5px'}"/>
                                Trang cá nhân
                            </button>
                            </MenuItem>
                        </div>
                        <div class="px-1 py-1">
                            <MenuItem v-slot="{ active }">
                            <button
                                :class="[
                                active ? 'bg-green-500 text-white' : 'text-gray-900',
                                'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                ]"
                                @click="goChangePasswordPage"
                            >
                                <SyncOutlined :style="{fontSize: '20px', color: 'green', marginRight: '5px'}"/>
                                Đổi mật khẩu
                            </button>
                            </MenuItem>
                        </div>
                            <div class="px-1 py-1">
                                <MenuItem v-slot="{ active }">
                                <button
                                    :class="[
                                    active ? 'bg-green-500 text-white' : 'text-gray-900',
                                    'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                    ]"
                                    @click="handleLogout(useUserStore.accessToken)"
                                >
                                    <LogoutOutlined :style="{fontSize: '20px', color: 'green', marginRight: '5px'}"/>
                                    Đăng xuất
                                </button>
                                </MenuItem>
                            </div>
                        </MenuItems>
                    </transition>
                </Menu>
                <!-- Open menu -->
                <div class="md:hidden cursor-pointer" @click="handleToggleNav">
                    <AlignRightOutlined :style="{fontSize: '30px'}" />
                </div>
            </div>
            <div v-else class="flex items-center gap-5">
                <button class="bg-blue-500 text-white font-semibold text-[14px] px-[10px] py-[5px] rounded" @click="goLoginBusiness">Đăng tuyển</button>
                <button class="bg-green-500 text-white font-semibold text-[14px] px-[10px] py-[5px] rounded" @click="goLoginPage">Đăng nhập</button>
            </div>
        </div>
    </header>
</template>
<script setup>
    import {SearchOutlined, HistoryOutlined,SyncOutlined,HeartFilled, SaveFilled,AlignRightOutlined, BellFilled, HeartOutlined, ArrowRightOutlined,LogoutOutlined, ProfileOutlined, ShopOutlined, StarOutlined, CloseOutlined} from "@ant-design/icons-vue"
    import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
    import { IMAGE_URL } from "../constants/url";
    import {useRouter} from "vue-router"
    import { useUserStore } from "../stores/userStore";
    import { computed, ref } from "vue";
    const router = useRouter()
    const userStore = useUserStore()
    const isOpenNav = ref(false)

    const handleToggleNav = () => {
        isOpenNav.value = !isOpenNav.value
    }
    const handleLogout = (token) => {
        userStore.actFetchLogout(token)
        router.push("/auth-layout")
    }
    const goLoginPage = () => {
        router.push("/auth-layout")
    }

    const goProfile = () => {
        router.push("/profile")
    }

    const goChangePasswordPage = () => {
        router.push("/change-password")
    }

    const goLoginBusiness = () => {
        router.push("/auth-layout/login-business")
    }

</script>
<style scoped>
    ul {
        margin: 0;
    }
    .li-root {
        font-weight: 600;    
    }

    .li-root:hover {
        color: rgb(74 222 128 / 1);
    }

    .router-link-exact-active {
        color: rgb(74 222 128 / 1);
    }

    .li-root:hover .child-list {
        display: block;
    }
    .child-list {
        display: none;
        z-index: 20;
    }

    .li-widget {
        background-color: rgb(229 231 235 / 1)
    }

    .li-widget:hover {
        background-color: rgb(209 213 219 / 1);
    }

    .li-widget:hover .li-text {
        color: rgb(74 222 128 / 1);
    }

    .li-widget:hover .arrow-right {
        display: block;
    }
    .arrow-right {
        display: none;
    }


</style>