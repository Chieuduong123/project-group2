<template>
  <div class="container-fluid flex mt-5">
    <div id="sidebar" class="bg-lightblue w-[600px] h-screen overflow-y-scroll d-grid p-5">
      <!-- LANGUAGE SETTING -->
      <!-- <div class="section">
        <h1 class="text-xl capitalize">
          {{ store_setting.cv_data.settings.languages.cv_languages }}
        </h1> -->

        <!-- <ul class="flex flex-wrap gap-2 mt-5"> -->
          <!-- FROM MY SCRIPT -->
          <!-- <li v-for="cv_language in cv_languages" :key="cv_language">
            <button class="text-sm bg-white py-2.5 px-4 rounded-xl capitalize transition hover:bg-gray-light active:"
              @click="store_setting.cv_change_languages(cv_language)">
              {{ cv_language.toLocaleLowerCase() }}
            </button>
          </li>
        </ul>
      </div> -->
      <!-- END LANGUAGE SETTING -->



      <!-- COLOR SETTING -->
      <div class="section">
        <h1 class="text-xl capitalize transition-all mt-14">{{ store_setting.cv_data.settings.languages.cv_colors }}</h1>
        <ul class="flex flex-wrap gap-3 mt-5">
          <!-- FROM MY SCRIPT -->
          <li v-for="color in cv_colors" :key="color">
            <button :style="{ background: color }" class="w-8 h-8 rounded-xl active:scale-90"
              @click="store_setting.cv_change_colors(color)">
            </button>
          </li>
        </ul>
      </div>
      <!-- END COLOR SETTING-->

      <!-- == ACCARDION START == -->

      <!-- PERSONAL DETAIL -->
      <button @click="handleCollapse"
        class="rounded-xl text-xl mb-4 mt-14 p-3 px-5 bg-white w-full flex align-middle justify-between">
        <span>{{ store_setting.cv_data.settings.languages.cv_personal_details }}</span>
        <span v-if="isOpen"><b>--</b></span>
        <span v-else><b>+</b></span>
      </button>
      <Collapse :when="isOpen" class="collapse">
        <div class="bg-white rounded-xl p-4  mb-6">

          <div class="inputs flex w-full gap-4">
            <!-- FIRST NAME -->
            <div class="input">
              <label for="first_name">{{ store_setting.cv_data.settings.languages.first_name }}</label>
              <input id="first_name" type="text" autocomplete="off"
                class="w-full mt-2 min-w-0 flex-auto rounded-lg px-4 py-2 text-dark shadow-sm ring-0"
                v-on:keyup="store_setting.cv_save" v-model="store_setting.cv_data.personal_details.first_name">
            </div>
            <!-- LAST NAME -->
            <div class="input">
              <label for="last_name">{{ store_setting.cv_data.settings.languages.last_name }}</label>
              <input id="last_name" type="text" autocomplete="off"
                class="w-full mt-2 min-w-0 flex-auto rounded-lg px-4 py-2 text-dark shadow-sm ring-0"
                v-on:keyup="store_setting.cv_save" v-model="store_setting.cv_data.personal_details.last_name">
            </div>
          </div>
          <!-- JOB TITLE -->
          <div class="input mt-5">
            <label for="job_title">{{ store_setting.cv_data.settings.languages.job_title }}</label>
            <input id="job_title" type="text" autocomplete="off"
              class="w-full mt-2 min-w-0 flex-auto rounded-lg px-4 py-2 text-dark shadow-sm ring-0"
              v-on:keyup="store_setting.cv_save" v-model="store_setting.cv_data.personal_details.job_title">
          </div>
          <!-- EMAIL -->
          <div class="input mt-5">
            <label for="email">{{ store_setting.cv_data.settings.languages.email }}</label>
            <input id="email" type="email" autocomplete="off"
              class="w-full mt-2 min-w-0 flex-auto rounded-lg px-4 py-2 text-dark shadow-sm ring-0"
              v-on:keyup="store_setting.cv_save" v-model="store_setting.cv_data.personal_details.email">
          </div>
          <!-- PHONE -->
          <div class="input mt-5">
            <label for="phone">{{ store_setting.cv_data.settings.languages.phone }}</label>
            <input id="phone" type="text" autocomplete="off"
              class="w-full mt-2 min-w-0 flex-auto rounded-lg px-4 py-2 text-dark shadow-sm ring-0"
              v-on:keyup="store_setting.cv_save" v-model="store_setting.cv_data.personal_details.phone">
          </div>
          <!-- LOCATION -->
          <div class="input mt-5">
            <label for="location">{{ store_setting.cv_data.settings.languages.location }}</label>
            <input id="location" type="text" autocomplete="off"
              class="w-full mt-2 min-w-0 flex-auto rounded-lg px-4 py-2 text-dark shadow-sm ring-0"
              v-on:keyup="store_setting.cv_save" v-model="store_setting.cv_data.personal_details.location">
          </div>
          <!-- ABOUT ME -->
          <div class="input mt-5">
            <label for="about_me">{{ store_setting.cv_data.settings.languages.about_me }}</label>
            <textarea id="about_me" type="text" autocomplete="off"
              class="w-full min-h-[150px] mt-2 min-w-0 flex-auto rounded-lg px-4 py-2 text-dark shadow-sm ring-0"
              v-on:keyup="store_setting.cv_save" v-model="store_setting.cv_data.personal_details.about_me">
            </textarea>
          </div>
        </div>
      </Collapse>
      <!-- END PERSONAL DETAIL -->



      <!-- SKILLS -->
      <button @click="handleCollapse1"
        class="rounded-xl text-xl mb-4 mt-2 p-3 px-5 bg-white w-full flex align-middle justify-between">
        <span>{{ store_setting.cv_data.settings.languages.skills }}</span>
        <span v-if="isOpen1"><b>--</b></span>
        <span v-else><b>+</b></span>
      </button>
      <Collapse :when="isOpen1" class="collapse">
        <div class="bg-white rounded-xl p-4 mb-6">

          <div class="inputs w-full gap-4">
            <!-- TECH -->
            <div class="input">
              <label for="tech">{{ store_setting.cv_data.settings.languages.tech }}</label>
              <input type="checkbox" class="float-right mt-2" v-on:change="store_setting.cv_save"
                v-model="store_setting.cv_data.skills.isTech">
              <input id="tech" type="text" autocomplete="off"
                class="w-full mt-2 min-w-0 flex-auto rounded-lg px-4 py-2 text-dark shadow-sm ring-0"
                v-model="store_setting.cv_data.skills.tech" v-on:keyup="store_setting.cv_data_tech_add">
            </div>
          </div>
          <div class="inputs w-full gap-4 mt-5">
            <!-- SOFT -->
            <div class="input">
              <label for="soft">{{ store_setting.cv_data.settings.languages.soft }}</label>
              <input type="checkbox" class="float-right mt-2" v-on:change="store_setting.cv_save"
                v-model="store_setting.cv_data.skills.isSoft">
              <input id="soft" type="text" autocomplete="off"
                class="w-full mt-2 min-w-0 flex-auto rounded-lg px-4 py-2 text-dark shadow-sm ring-0"
                v-model="store_setting.cv_data.skills.soft" v-on:keyup="store_setting.cv_data_soft_add">
            </div>
          </div>

          <div class="h-2 w-full bg-lightblue mt-5"></div>
          <div class="inputs w-full gap-4 mt-5">
            <div class="">
              <!-- LANGUAGE -->
              <div class="input" v-for="l in store_setting.cv_data.skills.language" :key="l">
                <label for="language" v-if="l.name">
                  {{ l.name }}
                </label>
                <label for="language" v-else>
                  {{ store_setting.cv_data.settings.languages.language }}
                </label>
                <input type="checkbox" class="float-right mt-2" v-on:change="store_setting.cv_save"
                  v-model="l.isLanguage">

                <input id="language" type="text" autocomplete="off"
                  class="w-full mt-2 min-w-0 flex-auto rounded-lg px-4 py-2 text-dark shadow-sm ring-0" v-model="l.name"
                  v-on:keyup="store_setting.cv_save">

                <div class="flex align-middle gap-4">
                  <input type="range" class="w-full mt-2 min-w-0 flex-auto px-4 py-2" min="10" max="100" step="10"
                    v-model="l.level" v-on:change="store_setting.cv_save">
                  <h3 class="w-[60px] text-center mt-2.5">{{ l.level }}</h3>
                </div>
              </div>
            </div>


            <button @click="store_setting.add_language_cv_data()"
              class="w-full transition bg-lightblue p-2.5 rounded-lg active:bg-lightblue hover:bg-gray-light">
              {{ store_setting.cv_data.settings.languages.add_language }}
            </button>
          </div>
        </div>
      </Collapse>
      <!-- ENDCONTACT -->



      <!-- SOCIALS START -->
      <button @click="handleCollapse2"
        class="rounded-xl text-xl mb-4 p-3 px-5 bg-white w-full flex align-middle justify-between">
        <span>{{ store_setting.cv_data.settings.languages.social }}</span>
        <span v-if="isOpen2"><b>--</b></span>
        <span v-else><b>+</b></span>
      </button>
      <Collapse :when="isOpen2" class="collapse">
        <div class="bg-white rounded-xl p-4  mb-6">

          <div class="inputs w-full">
            <!-- SOCIALS -->
            <div class="input">
              <label for="github" class="flex gap-2">
                <img src="../../components/svg/github.svg" width="18" alt="Github"> github
              </label>
              <input id="github" type="text" autocomplete="off"
                class="w-full mt-2  flex-auto rounded-lg px-4 py-2 text-dark shadow-sm ring-0"
                v-on:keyup="store_setting.cv_save" v-model="store_setting.cv_data.socials.github">
            </div>
            <div class="input mt-4">
              <label for="twitter" class="flex gap-2">
                <img src="../../components/svg/twitter.svg" width="18" alt="twitter"> twitter
              </label>
              <input id="twitter" type="text" autocomplete="off"
                class="w-full mt-2  flex-auto rounded-lg px-4 py-2 text-dark shadow-sm ring-0"
                v-on:keyup="store_setting.cv_save" v-model="store_setting.cv_data.socials.twitter">
            </div>
            <div class="input mt-4">
              <label for="instagram" class="flex gap-2">
                <img src="../../components/svg/instagram.svg" width="18" alt="instagram"> instagram
              </label>
              <input id="instagram" type="text" autocomplete="off"
                class="w-full mt-2  flex-auto rounded-lg px-4 py-2 text-dark shadow-sm ring-0"
                v-on:keyup="store_setting.cv_save" v-model="store_setting.cv_data.socials.instagram">
            </div>
            <div class="input mt-4">
              <label for="linkedin" class="flex gap-2">
                <img src="../../components/svg/linkedin.svg" width="18" alt="linkedin"> linkedin
              </label>
              <input id="linkedin" type="text" autocomplete="off"
                class="w-full mt-2  flex-auto rounded-lg px-4 py-2 text-dark shadow-sm ring-0"
                v-on:keyup="store_setting.cv_save" v-model="store_setting.cv_data.socials.linkedin">
            </div>
            <div class="input mt-4">
              <label for="telegram" class="flex gap-2">
                <img src="../../components/svg/telegram.svg" width="18" alt="telegram"> telegram
              </label>
              <input id="telegram" type="text" autocomplete="off"
                class="w-full mt-2  flex-auto rounded-lg px-4 py-2 text-dark shadow-sm ring-0"
                v-on:keyup="store_setting.cv_save" v-model="store_setting.cv_data.socials.telegram">
            </div>
            <div class="input mt-4">
              <label for="web" class="flex gap-2">
                <img src="../../components/svg/web.svg" width="18" alt="web"> web portfolio/website
              </label>
              <input id="web" type="text" autocomplete="off"
                class="w-full mt-2  flex-auto rounded-lg px-4 py-2 text-dark shadow-sm ring-0"
                v-on:keyup="store_setting.cv_save" v-model="store_setting.cv_data.socials.web">
            </div>
          </div>
        </div>
      </Collapse>
      <!-- END SOCIALS -->





      <!-- EXPERIENCES START -->
      <button @click="handleCollapse3"
        class="rounded-xl text-xl mb-4 p-3 px-5 bg-white w-full flex align-middle justify-between">
        <span>{{ store_setting.cv_data.settings.languages.experience }}</span>
        <span v-if="isOpen3"><b>--</b></span>
        <span v-else><b>+</b></span>
      </button>
      <Collapse :when="isOpen3" class="collapse">
        <div class="bg-white rounded-xl p-4 mb-6">
          <div class="inputs w-full">
            <!-- EXPERIENCES -->
            <div class="input  mb-3" v-for="e in store_setting.cv_data.experiences" :key="e">
              <div class="w-full bg-lightblue mt-5 mb-5 text-center uppercase" v-if="e.title">{{ e.title }}</div>
              <div class="w-full h-2 bg-lightblue mt-5 mb-5" v-else></div>



              <div class="flex gap-2 w-full justify-between">
                <label>
                  {{ store_setting.cv_data.settings.languages.experience }}
                </label>
                <input type="checkbox" class="" v-on:change="store_setting.cv_save" v-model="e.isExperience">
              </div>
              <label for="">{{ store_setting.cv_data.settings.languages.title }}</label>
              <input type="text" autocomplete="off"
                class="w-full mt-2  flex-auto rounded-lg px-4 py-2 text-dark shadow-sm ring-0"
                v-on:keyup="store_setting.cv_save" v-model="e.title">


              <div class="input mt-4">
                <label>{{ store_setting.cv_data.settings.languages.location }}</label>
                <input type="text" autocomplete="off"
                  class="w-full mt-2  flex-auto rounded-lg px-4 py-2 text-dark shadow-sm ring-0"
                  v-on:keyup="store_setting.cv_save" v-model="e.location">
              </div>
              <div class="flex gap-4 w-full">
                <div class="input mt-4">
                  <label>{{ store_setting.cv_data.settings.languages.from }}</label>
                  <input type="text" autocomplete="off"
                    class="w-full mt-2  flex-auto rounded-lg px-4 py-2 text-dark shadow-sm ring-0"
                    v-on:keyup="store_setting.cv_save" v-model="e.from">
                </div>
                <div class="input mt-4">
                  <label>{{ store_setting.cv_data.settings.languages.to }}</label>
                  <input type="text" autocomplete="off"
                    class="w-full mt-2  flex-auto rounded-lg px-4 py-2 text-dark shadow-sm ring-0"
                    v-on:keyup="store_setting.cv_save" v-model="e.to">
                </div>
              </div>
              <!-- ABOUT ME -->
              <div class="input mt-5">
                <label for="about_me">{{ store_setting.cv_data.settings.languages.summary }}</label>
                <textarea id="about_me" type="text" autocomplete="off"
                  class="w-full min-h-[150px] mt-2 min-w-0 flex-auto rounded-lg px-4 py-2 text-dark shadow-sm ring-0"
                  v-on:keyup="store_setting.cv_save" v-model="e.summary">
                </textarea>
              </div>
            </div>
          </div>




          <button @click="store_setting.add_experience_cv_data()"
            class="w-full transition bg-lightblue p-2.5 rounded-lg active:bg-lightblue hover:bg-gray-light">
            {{ store_setting.cv_data.settings.languages.add_experience }}
          </button>
        </div>
      </Collapse>
      <!-- EXPERIENCES END -->



      <!-- EDUCATION AND CERTIFICATION START -->
      <button @click="handleCollapse4"
        class="rounded-xl text-xl mb-4 p-3 px-5 bg-white w-full flex align-middle justify-between">
        <span>{{ store_setting.cv_data.settings.languages.educations_and_certifications }}</span>
        <span v-if="isOpen4"><b>--</b></span>
        <span v-else><b>+</b></span>
      </button>
      <Collapse :when="isOpen4" class="collapse">
        <div class="bg-white rounded-xl p-4 mb-6">
          <div class="inputs w-full">
            <!-- EXPERIENCES -->
            <div class="input  mb-3" v-for="e in store_setting.cv_data.educations_and_certifications" :key="e">
              <div class="w-full bg-lightblue mt-5 mb-5 text-center uppercase" v-if="e.title">{{ e.title }}</div>
              <div class="w-full h-2 bg-lightblue mt-5 mb-5" v-else></div>



              <div class="flex gap-2 w-full justify-between">
                <label>
                  {{ store_setting.cv_data.settings.languages.educations_and_certifications }}
                </label>
                <input type="checkbox" class="" v-on:change="store_setting.cv_save" v-model="e.isTrue">
              </div>
              <label for="">{{ store_setting.cv_data.settings.languages.title }}</label>
              <input type="text" autocomplete="off"
                class="w-full mt-2  flex-auto rounded-lg px-4 py-2 text-dark shadow-sm ring-0"
                v-on:keyup="store_setting.cv_save" v-model="e.title">


              <div class="input mt-4">
                <label>{{ store_setting.cv_data.settings.languages.location }}</label>
                <input type="text" autocomplete="off"
                  class="w-full mt-2  flex-auto rounded-lg px-4 py-2 text-dark shadow-sm ring-0"
                  v-on:keyup="store_setting.cv_save" v-model="e.location">
              </div>
              <div class="flex gap-4 w-full">
                <div class="input mt-4">
                  <label>{{ store_setting.cv_data.settings.languages.from }}</label>
                  <input type="text" autocomplete="off"
                    class="w-full mt-2  flex-auto rounded-lg px-4 py-2 text-dark shadow-sm ring-0"
                    v-on:keyup="store_setting.cv_save" v-model="e.from">
                </div>
                <div class="input mt-4">
                  <label>{{ store_setting.cv_data.settings.languages.to }}</label>
                  <input type="text" autocomplete="off"
                    class="w-full mt-2  flex-auto rounded-lg px-4 py-2 text-dark shadow-sm ring-0"
                    v-on:keyup="store_setting.cv_save" v-model="e.to">
                </div>
              </div>
              <!-- ABOUT ME -->
              <div class="input mt-5">
                <label for="about_me">{{ store_setting.cv_data.settings.languages.summary }}</label>
                <textarea id="about_me" type="text" autocomplete="off"
                  class="w-full min-h-[150px] mt-2 min-w-0 flex-auto rounded-lg px-4 py-2 text-dark shadow-sm ring-0"
                  v-on:keyup="store_setting.cv_save" v-model="e.summary">
                </textarea>
              </div>
            </div>
          </div>
          <button @click="store_setting.add_educations_and_certifications_cv_data()"
            class="w-full transition bg-lightblue p-2.5 rounded-lg active:bg-lightblue hover:bg-gray-light">
            {{ store_setting.cv_data.settings.languages.add_educations_and_certifications }}
          </button>
        </div>
      </Collapse>
      <!-- EDUCATION AND CERTIFICATION END -->
      <!-- == ACCARDION END == -->


      <br>
      <!-- MAIN BUTTONS -->
      <!-- <mainButtons></mainButtons> -->
      <button v-print="'#printMe'"
          class="btn rounded-xl w-full text-sm mt-16 text-white delay-200 transition p-3 hover:delay-0"
          :style="{ background: store_setting.cv_data.settings.colors }">
          {{ store_setting.cv_data.settings.buttons.print_or_download }}
      </button>
      <button class="btn rounded-xl w-full text-sm mt-5 text-white  bg-black delay-200 transition p-3 hover:delay-0" @click="handleSave">
          Cập nhật
      </button>
      <!-- MAIN BUTTONS -->
    </div>
    <!-- CV SECTION -->
    <CvComponent></CvComponent>
    <!-- CV SECTION -->
  </div>
      <Loading v-if="isLoadingRef"/>
</template>

<script setup>
  import { useSettingStore } from "../../stores/settings";
import CvComponent from "../../components/CvComponent.vue";
import mainButtons from "../../components/mainButtons.vue";
import { effect, onMounted, ref, watch, watchEffect } from 'vue'
import { Collapse } from 'vue-collapsed';
import { useRoute } from "vue-router";
import { useUserStore } from "../../stores/userStore";
import Loading from "../../components/Loading.vue";
import { fetchGetCVById } from "../../api/cvApi";

const store_setting = useSettingStore()
const userStore = useUserStore()
  const cv_languages= ["english", "vietnam"]
  const  cv_colors= ["#000", "#00a8ef", "#ff5900", "#6055f7", "#0ebb62"]
  const languageRef = ref([]);
  const educationRef = ref([]);
  const experienceRef = ref([]);
  const detailHienThi = ref(null)
  const isLoadingRef = ref(false)
  const route = useRoute()
  const idCV = route.params.id
  const isOpen = ref(false)
  const isOpen1 = ref(false)
  const isOpen2 = ref(false)
  const isOpen3 = ref(false)
  const isOpen4 = ref(false)

  function handleCollapse() {
    isOpen.value = !isOpen.value
  }
  function handleCollapse1() {
    isOpen1.value = !isOpen1.value
  }
  function handleCollapse2() {
    isOpen2.value = !isOpen2.value
  }
  function handleCollapse3() {
    isOpen3.value = !isOpen3.value
  }
  function handleCollapse4() {
    isOpen4.value = !isOpen4.value
  }


  const handleSetDataCV = (data) => {
    detailHienThi.value = {
        settings: {
            languages: {
                cv_languages: "Ngôn ngữ",
                cv_colors: "Màu sắc",
                cv_personal_details: "Thông tin cá nhân",
                first_name: "Họ",
                last_name: "Tên",
                job_title: "Chức vụ" / "Vị trí hiện tại"            ,
                about_me: "Giới thiệu",
                contact: "Liên hệ",
                email: "Email",
                phone: "Số điện thoại",
                location: "Địa chỉ",
                skills: "Kỹ năng",
                tech: "Kỹ năng",
                soft: "Kỹ năng mềm",
                language: "Ngôn ngữ",
                add_language: "Thêm ngôn ngữ",
                social: "Mạng xã hội",
                experience: "Kinh nghiệm",
                add_experience: "Thêm kinh nghiệm",
                from: "Từ",
                to: "Đến",
                summary: "Tóm tắt",
                educations_and_certifications: "Học vấn",
                add_educations_and_certifications: "Thêm học vấn"
            },
            colors: "#000",
            buttons: {
                print_or_download: "In hoặc tải (PDF)",
                download_as_json: "Tải dạng JSON",
                update_json_file: "Upload JSON file",
                remove_all_data: "Xoá toàn bộ thông tin"
            }
        },
        personal_details: {
            first_name: data?.personal_detail?.first_name,
            last_name: data?.personal_detail?.last_name,
            job_title: data?.personal_detail?.job_title,
            about_me: data?.personal_detail?.about_me,
            email: data?.personal_detail?.email,
            phone: data?.personal_detail?.phone,
            location: data?.personal_detail?.location
        },
        skills: {
            isTech: true,
            tech: data?.skill?.tech,
            isSoft: true,
            soft: data?.skill?.soft,
            isAllLanguage: true,
            language: data?.skill?.languages?.map(lang => ({
                      name: lang.name,
                      level: Number(lang.level),
                      isLanguage: true,
                    })) || []
        },
        socials: {
            github: data?.social?.github,
            twitter: data?.social?.twitter,
            instagram: data?.social?.instagram,
            linkedin: data?.social?.linkendin,
            telegram: data?.social?.telegram,
            web: data?.social?.web,
        },
        experiences: data?.experience?.map(exp => ({
                      isExperience: true,
                      title: exp.title,
                      location: exp.location,
                      from: exp.from_date,
                      to: exp.to_date,
                      summary: exp.summary
                    })),
        educations_and_certifications: data?.education?.map(edu => ({
                                          isTrue: true,
                                          from: edu.from_date,
                                          to: edu.to_date,
                                          location: edu.location,
                                          title: edu.title,
                                          summary: edu.summary,
                                        }))
    }
  }
  const handleGetDetailCV =async (id, token) => {
    if(id) {
      isLoadingRef.value = true
      await userStore.actGetCVById(id, token)
      const data = await fetchGetCVById(id, token)
      if(data.data.CV.length > 0) {
        isLoadingRef.value = false
        await handleSetDataCV(data.data.CV[0])
      }
    }
  }

  const handleHienThiCV = async (cv) => {
    await store_setting.cv_getDetail(cv)
  }

  onMounted( async() => {
    if(idCV) {
      await handleGetDetailCV(idCV, userStore.accessToken)
    }
    if(userStore.cv.id) {
      await handleHienThiCV(detailHienThi.value)
    }
  })
  

  const handleMapLanguages = () => {
      store_setting.cv_data.skills.language.map(lang => {
          languageRef.value = [
              ...languageRef.value,
              {
                  name: lang.name,
                  level: lang.level
              }
          ]
      })
  }

  const handleMapEducation = () => {
      store_setting.cv_data.educations_and_certifications.map(edu => {
          educationRef.value = [
              ...educationRef.value,
              {
                  from_date: edu.from,
                  to_date: edu.to,
                  location: edu.location,
                  title: edu.title,
                  summary: edu.summary,
              }
          ]
      })
  }
  const handleMapExperience = () => {
      store_setting.cv_data.experiences.map(exp => {
          experienceRef.value = [
              ...experienceRef.value,
              {
                  from_date: exp.from,
                  to_date: exp.to,
                  location: exp.location,
                  title: exp.title,
                  summary: exp.summary,
              }
          ]
      })
  }
  const handleSave = () => {
      handleMapLanguages()
      handleMapEducation()
      handleMapExperience()
      const dataCV = {
          first_name: store_setting?.cv_data?.personal_details?.first_name,
          last_name: store_setting?.cv_data?.personal_details?.last_name,
          job_title: store_setting?.cv_data?.personal_details?.job_title,
          location: store_setting?.cv_data?.personal_details?.location,
          email: store_setting?.cv_data?.personal_details?.email,
          phone: store_setting?.cv_data?.personal_details?.phone,
          about_me: store_setting?.cv_data?.personal_details?.about_me,
          github: store_setting?.cv_data?.socials?.github,
          instagram: store_setting?.cv_data?.socials?.instagram,
          facebook: "",
          linkendin: store_setting?.cv_data?.socials?.linkedin,
          telegram: store_setting?.cv_data?.socials?.telegram,
          twitter: store_setting?.cv_data?.socials?.twitter,
          web: store_setting?.cv_data?.socials?.web,
          soft: store_setting?.cv_data?.skills?.soft,
          tech: store_setting?.cv_data?.skills?.tech,
          languages: languageRef.value,
          education: educationRef.value,
          experience: experienceRef.value
      }
      userStore.actUpdateCV(idCV,dataCV, userStore.accessToken)
  }
</script>

<style>
.my-class {
  transition: height 300ms cubic-bezier(0.3, 0, 0.6, 1);
}

.collapse {
  transition: height .3s ease-out;
  visibility: visible;
}
</style>

