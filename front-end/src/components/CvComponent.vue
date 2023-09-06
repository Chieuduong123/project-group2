<template>
    <div id="cv" class="w-full grid justify-center gap-10 h-screen p-10 overflow-y-scroll bg-white">

        <section id="printMe" class="w-full">
            <!-- <div class="theme-name text-sm w-full text-end py-2 px-3">
    <p class="uppercase">Benito theme</p>
  </div> -->
            <div class="main-cv flex">
                <aside class="h-full min-w-[275px] w-[275px] p-7">
                    <div class="flex flex-wrap gap-x-2 font-semibold">
                        <!-- PERSONAL DETAIL FIRST NAME -->
                        <h1 class="text-2xl uppercase" :style="{ color: store_setting.cv_data.settings.colors }">
                            {{ store_setting.cv_data.personal_details.first_name }}</h1>
                        <!-- PERSONAL DETAIL LAST NAME -->
                        <h1 class="text-2xl uppercase" :style="{ color: store_setting.cv_data.settings.colors }">
                            {{ store_setting.cv_data.personal_details.last_name }}</h1>
                    </div>
                    <!-- PERSONAL DETAIL JOB TITLE -->
                    <div class="mt-1">
                        <h1 class="text-sm uppercase">{{ store_setting.cv_data.personal_details.job_title }}</h1>
                    </div>
                    <!-- PERSONAL DETAIL CONTATCS TITLE -->
                    <div class="mt-6" v-show="store_setting.cv_data.personal_details.email ||
                        store_setting.cv_data.personal_details.phone ||
                        store_setting.cv_data.personal_details.location">
                        <h1 class="text-[20px] uppercase font-semibold">
                            {{ store_setting.cv_data.settings.languages.contact }}
                        </h1>
                    </div>
                    <!-- PERSONAL DETAIL CONTATCS DATA -->
                    <div class="mt-2">
                        <div class="flex align-middle gap-2" v-show="store_setting.cv_data.personal_details.email">
                            <img src="../components/svg/email.svg" width="20" alt="">
                            <h1 class="text-sm">{{ store_setting.cv_data.personal_details.email }}</h1>
                        </div>
                        <div class="flex align-middle gap-2 mt-1" v-show="store_setting.cv_data.personal_details.phone">
                            <img src="../components/svg/phone.svg" width="20" alt="">
                            <h1 class="text-sm">{{ store_setting.cv_data.personal_details.phone }}</h1>
                        </div>
                        <div class="flex align-middle gap-2 mt-1" v-show="store_setting.cv_data.personal_details.location">
                            <img src="../components/svg/location.svg" width="20" alt="">
                            <h1 class="text-sm">{{ store_setting.cv_data.personal_details.location }}</h1>
                        </div>
                    </div>

                    <!-- ==SKILLS START== -->
                    <!-- TECH TITLE -->
                    <div class="mt-6" v-show="store_setting.cv_data.skills.isTech">
                        <h1 class="text-[20px] uppercase font-semibold">
                            {{ store_setting.cv_data.settings.languages.tech }}
                        </h1>
                    </div>
                    <!-- TECH -->
                    <div class="mt-2" v-show="store_setting.cv_data.skills.isTech">
                        <ul class="flex flex-wrap gap-1.5">
                            <li class="py-[4px] px-2 rounded-[5px] text-[10px] text-white"
                                :style="{ background: store_setting.cv_data.settings.colors }"
                                v-for=" tech  in  store_setting.cv_data.skills.tech " :key="tech">
                                {{ tech }}
                            </li>
                        </ul>
                    </div>

                    <!-- SOFT TITLE -->
                    <div class="mt-6" v-show="store_setting.cv_data.skills.isSoft">
                        <h1 class="text-[20px] uppercase font-semibold">
                            {{ store_setting.cv_data.settings.languages.soft }}
                        </h1>
                    </div>
                    <!-- SOFT -->
                    <div class="mt-2" v-show="store_setting.cv_data.skills.isSoft">
                        <ul class="ml-5">
                            <li class="text-sm text-dark" style="list-style: disc;"
                                v-for="soft  in  store_setting.cv_data.skills.soft " :key="soft">
                                {{ soft }}
                            </li>
                        </ul>
                    </div>

                    <!-- LANGUAGE TITLE -->
                    <div class="mt-6">
                        <h1 class="text-[20px] uppercase font-semibold">
                            {{ store_setting.cv_data.settings.languages.language }}
                        </h1>
                    </div>
                    <!-- LANGUAGE -->
                    <div class="mt-2">
                        <ul class="grid gap-3">
                            <li class="text-sm text-dark" v-for="language  in  store_setting.cv_data.skills.language "
                                :key="language" v-show="language.isLanguage">
                                <div class="flex justify-between">
                                    <p class="text-sm">{{ language.name.toUpperCase() }}</p>
                                    <strong class="text-sm font-light">{{ language.level }}%</strong>
                                </div>
                                <div class="h-2 relative w-full bg-[#d2d6db] rounded-xl">
                                    <div class="h-2 mt-1.5 rounded-xl"
                                        :style="{ width: language.level + '%', background: store_setting.cv_data.settings.colors }">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- ==SKILLS END== -->

                    <!-- SOCIALS TITLE -->
                    <div class="mt-6" v-show="store_setting.cv_data.socials.github ||
                        store_setting.cv_data.socials.twitter ||
                        store_setting.cv_data.socials.instagram ||
                        store_setting.cv_data.socials.linkedin ||
                        store_setting.cv_data.socials.telegram ||
                        store_setting.cv_data.socials.web">
                        <h1 class="text-[20px] uppercase font-semibold">
                            {{ store_setting.cv_data.settings.languages.social }}
                        </h1>
                    </div>
                    <!-- SOCIALS BODY -->
                    <div class="mt-2" v-show="store_setting.cv_data.settings.languages.social">
                        <ul class="grid gap-0.5">
                            <li class="text-sm text-dark flex gap-2">
                                <img src="../components/svg/github.svg" width="16" alt="github"
                                    v-show="store_setting.cv_data.socials.github">
                                {{ store_setting.cv_data.socials.github }}
                            </li>
                            <li class="text-sm text-dark flex gap-2">
                                <img src="../components/svg/twitter.svg" width="16" alt="twitter"
                                    v-show="store_setting.cv_data.socials.twitter">
                                {{ store_setting.cv_data.socials.twitter }}
                            </li>
                            <li class="text-sm text-dark flex gap-2">
                                <img src="../components/svg/instagram.svg" width="16" alt="instagram"
                                    v-show="store_setting.cv_data.socials.instagram">
                                {{ store_setting.cv_data.socials.instagram }}
                            </li>
                            <li class="text-sm text-dark flex gap-2">
                                <img src="../components/svg/linkedin.svg" width="16" alt="linkedin"
                                    v-show="store_setting.cv_data.socials.linkedin">
                                {{ store_setting.cv_data.socials.linkedin }}
                            </li>
                            <li class="text-sm text-dark flex gap-2">
                                <img src="../components/svg/telegram.svg" width="16" alt="telegram"
                                    v-show="store_setting.cv_data.socials.telegram">
                                {{ store_setting.cv_data.socials.telegram }}
                            </li>
                            <li class="text-sm text-dark flex gap-2">
                                <img src="../components/svg/web.svg" width="16" alt="web"
                                    v-show="store_setting.cv_data.socials.web">
                                {{ store_setting.cv_data.socials.web }}
                            </li>
                        </ul>
                    </div>


                </aside>

                <main class="h-full w-full p-7">
                    <div class="">
                        <!-- PERSONAL DETAIL ABOUT ME TITLE -->
                        <h1 class="text-xl uppercase font-semibold"
                            :style="{ color: store_setting.cv_data.settings.colors }">
                            {{ store_setting.cv_data.settings.languages.about_me }}
                        </h1>
                        <article class="mt-2 text-sm">
                            {{ store_setting.cv_data.personal_details.about_me }}
                        </article>
                    </div>

                    <div class="h-2 w-full bg-lightblue mt-5"></div>


                    <div class="mt-5">
                        <!-- PERSONAL DETAIL ABOUT ME TITLE -->
                        <h1 class="text-xl uppercase font-semibold"
                            :style="{ color: store_setting.cv_data.settings.colors }">
                            {{ store_setting.cv_data.settings.languages.experience }}
                        </h1>

                        <div v-for="e in store_setting.cv_data.experiences" :key="e" v-show="e.isExperience">
                            <h1 class="text-[16px] uppercase font-medium mt-4">{{ e.title }}</h1>
                            <p class="text-[14px] mt-1.5">{{ e.location }} <span v-show="e.from"> | </span>{{ e.from }}<span
                                    v-show="e.to">-</span>{{ e.to }}</p>
                            <article class="mt-1 text-sm">
                                {{ e.summary }}
                            </article>
                        </div>
                    </div>
                    <div class="mt-6">
                        <!-- PERSONAL DETAIL ABOUT ME TITLE -->
                        <h1 class="text-xl uppercase font-semibold"
                            :style="{ color: store_setting.cv_data.settings.colors }">
                            {{ store_setting.cv_data.settings.languages.educations_and_certifications }}
                        </h1>

                        <div class="" v-for="e in store_setting.cv_data.educations_and_certifications" :key="e"
                            v-show="e.isTrue">
                            <h1 class="text-[16px] uppercase font-medium mt-5">{{ e.title }}</h1>
                            <p class="text-[14px] mt-1.5">{{ e.location }} <span v-show="e.from"> | </span>{{ e.from }}<span
                                    v-show="e.to">-</span>{{ e.to }}</p>
                            <article class="mt-1 text-sm">
                                {{ e.summary }}
                            </article>
                        </div>
                    </div>
                </main>
            </div>



        </section>
    </div>
</template>

<script>
import { useSettingStore } from "../stores/settings"


export default {
    components: {
        
    },
    data() {
        return {
            store_setting: useSettingStore(),
            cv_languages: ["english", "vie"],
            cv_colors: ["#000", "#00a8ef", "#ff5900", "#6055f7", "#0ebb62"],
        }
    },
}
</script>