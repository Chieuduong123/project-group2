<template lang="">
    <div class="max-w-[1300px] mx-auto mt-[50px]">
       <div class="relative rounded-xl bg-green-500 h-[300px] overflow-hidden">
            <div class="h-[40%]">
                <img src="../../assets/images/banner2.png" alt="img" class="object-cover w-full h-full ">
            </div>
            <div class="absolute translate-y-[-50%] translate-x-[50%] w-[150px] h-[150px] rounded-full overflow-hidden">
                <img src="https://plus.unsplash.com/premium_photo-1682309761340-3f8b1cbaa655?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8Zmxhc2h8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60" alt="logo" class="w-full h-full object-cover">
            </div>
            <div class="h-60% text-white flex flex-col gap-3 translate-x-[20%]">
                <h2 class="font-semibold text-[24px] mt-2">Công ty A</h2>
                <p class="flex items-center gap-2">
                    <GlobalOutlined :style="{fontSize: '20px'}"/>
                    http://brggroup.vn:8068/1/31/89-j/Tuyen-dung/IT-Ho-tro-nguoi-dung.aspx
                </p>
                <p class="flex items-center gap-2">
                    <ShopOutlined :style="{fontSize: '20px'}"/>
                    1000+ Nhân viên
                </p>
            </div>
       </div>
       <div class="flex gap-5 mt-[20px]">
            <div class="w-[70%] shadow-sm rounded-xl overflow-hidden pb-[20px]">
                <div class="h-[50px] flex items-center px-[20px] bg-green-500">
                    <h3 class="font-semibold text-white text-[20px]">Tuyển dụng</h3>
                </div>
                <div>
                    <div class="flex items-center justify-center gap-5 py-[20px]">
                        <div class="flex items-center gap-2 px-[10px] py-[10px] bg-white rounded-md border">
                            <SearchOutlined :style="{fontSize: '20px', color: '#9BA4B5'}"/>
                            <input type="text" placeholder="Vị trí tuyển dụng" class="outline-none text-[15px] w-[300px]">
                        </div>
                        <button class="px-[15px] py-[10px] bg-green-500 text-white rounded-md font-semibold">Tìm kiếm</button>
                    </div>
                    <div class="flex flex-col gap-5 px-[20px]">
                        <JobCardCompany/>
                        <JobCardCompany/>
                        <JobCardCompany/>
                    </div>
                </div>
            </div>
            <div class="w-[30%] shadow rounded-xl overflow-hidden pb-5 h-max">
                <div class="h-[50px] flex items-center px-[20px] bg-green-500">
                    <h3 class="font-semibold text-white text-[20px]">Thông tin liên hệ</h3>
                </div>
                <div class="p-[20px] flex flex-col gap-5">
                    <div class="flex flex-col gap-2 pb-5 border-b">
                        <p class="font-semibold flex items-center gap-1"><EnvironmentOutlined :style="{fontSize: '20px', color: '#9BA4B5'}"/> Địa chỉ công ty</p>
                        <p class="text-[14px]">Số 198 Trần Quang Khải, phường Lý Thái Tổ, quận Hoàn Kiếm, thành phố Hà Nội, Việt Nam</p>
                    </div>
                    <div class="flex flex-col gap-5">
                        <p class="font-semibold">Xem bản đồ</p>
                        <iframe
                            width="100%"
                            height="300"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d239.63399866655752!2d108.21709009251883!3d16.058016700850477!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314219c979c9e455%3A0x60e267c914712c31!2zMjY3IEhvw6BuZyBEaeG7h3UsIELDrG5oIEhpw6puLCBI4bqjaSBDaMOidSwgxJDDoCBO4bq1bmcgNTUwMDAwLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1692671960344!5m2!1svi!2s"
                            frameborder="0"
                            style="border:0"
                            allowfullscreen
                        ></iframe>
                    </div>
                </div>
            </div>
       </div>
    </div>
</template>
<script setup>
    import {GlobalOutlined, ShopOutlined, SearchOutlined, EnvironmentOutlined} from "@ant-design/icons-vue"
    import JobCardCompany from "../../components/JobCardCompany.vue"
</script>
<style lang="">
    
</style>