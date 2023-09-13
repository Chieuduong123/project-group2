<template lang="">
    <div class="flex gap-5 mt-[50px] justify-center">
        <div class="flex-1">
            <form action="" class="flex flex-col items-center gap-5 w-max" @submit.prevent="handleSubmit">
                <div class="flex gap-3">
                    <div class="flex flex-col gap-1 w-[100%] rounded">
                        <label for="" class="text-[14px] font-semibold">Tên công ty</label>
                        <input type="text" v-model="businessProfile.name" placeholder="Nhập tên công ty" class="outline-none text-[13px] px-[10px] py-[7px] border-[1px]">
                    </div>
                    <div class="flex flex-col gap-1 w-[100%] rounded">
                        <label for="" class="text-[14px] font-semibold">Số điện thoại</label>
                        <input type="text" v-model="businessProfile.phone" placeholder="Nhập số điện thoại" class="outline-none text-[13px] px-[10px] py-[7px] border-[1px]">
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="flex flex-col gap-1 w-[100%] rounded">
                        <label for="" class="text-[14px] font-semibold">Email</label>
                        <input type="email" v-model="businessProfile.email" disabled placeholder="Nhập email" class="outline-none text-[13px] px-[10px] py-[7px] border-[1px]">
                    </div>
                    <div class="flex flex-col gap-1 w-[100%] rounded">
                        <label for="" class="text-[14px] font-semibold">Địa chỉ</label>
                        <input type="text" v-model="businessProfile.location" placeholder="Nhập địa chỉ công ty" class="outline-none text-[13px] px-[10px] py-[7px] border-[1px]">
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="flex flex-col gap-1 w-[100%] rounded">
                        <label for="" class="text-[14px] font-semibold">Website</label>
                        <input type="text" v-model="businessProfile.website" placeholder="Nhập link website" class="outline-none text-[13px] px-[10px] py-[7px] border-[1px]">
                    </div>
                    <div class="flex flex-col gap-1 w-[100%] rounded">
                        <label for="" class="text-[14px] font-semibold">Số lượng nhân sự</label>
                        <input type="text" v-model="businessProfile.size" placeholder="Nhập số lượng nhân sự" class="outline-none text-[13px] px-[10px] py-[7px] border-[1px]">
                    </div>
                </div>
                <div class="flex flex-col gap-1 w-[100%] rounded">
                    <label for="" class="text-[14px] font-semibold">Mô tả</label>
                    <textarea name="" id="" cols="30" rows="10" v-model="businessProfile.career" placeholder="Nhập số mô tả" class="outline-none text-[13px] px-[10px] py-[7px] border-[1px]"></textarea>
                </div>
                <button :type="submit" class="text-[16px] font-medium px-[40px] py-[10px] text-white bg-green-500 rounded ">Submit</button>
            </form>
        </div>
        <div class="flex-1">
            <div class="relative w-[200px] h-[200px]">
                <img  :src="avatarFile.preview ? `${avatarFile.preview}` : `${IMAGE_URL}${businessProfile.avatar}`" alt="logo" class="w-full h-full rounded-full object-cover" >
                <input type="file" id="logo-business" class="hidden" @change="changeFile">
                <label for="logo-business" class="absolute right-0 translate-x-[-30%] bottom-[10%] w-[30px] h-[30px] rounded-full flex items-center justify-center cursor-pointer bg-green-500 text-white"><CameraOutlined :style="{fontSize: '14px'}"/></label>
            </div>
        </div>
    </div>
    <Loading v-if="businessStore.isLoading"/>
</template>
<script setup>
    import {CameraOutlined} from "@ant-design/icons-vue"
    import { useBusinessStore } from "../../stores/businessStore";
    import { onMounted, ref, watchEffect } from "vue";
    import { IMAGE_URL } from "../../constants/url";
    import Loading from "../../components/Loading.vue";
    const businessStore = useBusinessStore()

    const handleGetProfile = async(token) => {
        businessStore.actFetchReLoginBusiness(token)
    }

    onMounted(() => {
        handleGetProfile(businessStore.accessToken)
    })
    const avatarFile = ref({
        file: null,
        preview: null,
    })

    const businessProfile = ref({
        name: "",
        phone: "",
        email: "",
        location: "",
        website: "",
        size: "",
        career: "",
        avatar: "",
    })

    const changeFile = (e) => {
        const file = e.target.files[0];
      if (file) {
        avatarFile.value.preview = URL.createObjectURL(file);
        avatarFile.value.file = file;
      }
    }
    
    watchEffect(() => {
        const profile = businessStore.myBusiness;
        if (profile) {
            businessProfile.value.name = profile.name;
            businessProfile.value.phone = profile.phone;
            businessProfile.value.email = profile.email;
            businessProfile.value.avatar = profile.avatar;
            businessProfile.value.location = profile.location;
            businessProfile.value.website = profile.website;
            businessProfile.value.career = profile.career;
            businessProfile.value.size = profile.size;
        }
    });

    const handleSubmit = () => {
        const formData = new FormData();
        formData.append('avatar', avatarFile.value.file);
        formData.append('name', businessProfile.value.name)
        formData.append('email', businessProfile.value.email)
        formData.append('phone', businessProfile.value.phone)
        formData.append('location', businessProfile.value.location)
        formData.append('career', businessProfile.value.career)
        formData.append('size', businessProfile.value.size)
        formData.append('website', businessProfile.value.website)
        const payload = {
            formData
        }
        businessStore.actEditProfile(formData, businessStore.accessToken)
        console.log(avatarFile.value.file,'avatarFile.value.file');
        console.log(formData,'formDataformData');
    }
</script>
<style lang="">
    
</style>