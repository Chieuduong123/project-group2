<template lang="">
    <div class="h-[80px] w-full border-b flex items-center justify-between px-[20px]">
        <h2>Hello</h2>
        <Menu as="div" class="relative z-30 inline-block text-left">
            <MenuButton>
                <div class="flex items-center gap-2 cursor-pointer">
                    <span class="w-[40px] h-[40px] rounded-full bg-gray-300 flex items-center justify-center text-white text-[20px]"> 
                        B
                    </span>
                    <p class="font-semibold text-[14px]">Công ty A</p>
                </div>
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
                        >
                            Đăng xuất
                        </button>
                        </MenuItem>
                    </div>
                </MenuItems>
            </transition>
        </Menu>
    </div>
</template>
<script setup>
    import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
    import { useRouter } from 'vue-router';
    const router = useRouter()

    const goProfile = () => {
        router.push("/business/profile")
    }
</script>
<style lang="">
    
</style>