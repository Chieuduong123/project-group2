<template>
    <button v-print="'#printMe'"
        class="btn rounded-xl w-full text-sm mt-16 text-white delay-200 transition p-3 hover:delay-0"
        :style="{ background: store_setting.cv_data.settings.colors }">
        {{ store_setting.cv_data.settings.buttons.print_or_download }}
    </button>
    <button class="btn rounded-xl w-full text-sm mt-5 text-white  bg-black delay-200 transition p-3 hover:delay-0" @click="handleSave">
        Lưu
    </button>
</template>

<script setup>
    import { useSettingStore } from "../stores/settings"
    import cvComponent from "../components/cvComponent.vue"
    import { ref } from "vue";
    const store_setting = useSettingStore()
    const cv_languages= ["english", "uzbek", "russia"]
    const  cv_colors= ["#000", "#00a8ef", "#ff5900", "#6055f7", "#0ebb62"]
    const languageRef = ref([]);
    const educationRef = ref([]);
    const experienceRef = ref([]);

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
        console.log(dataCV);
    }
</script>

