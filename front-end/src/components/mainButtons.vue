<template>
    <button v-print="'#printMe'"
        class="btn rounded-xl w-full text-sm mt-16 text-white delay-200 transition p-3 hover:delay-0"
        :style="{ background: store_setting.cv_data.settings.colors }">
        {{ store_setting.cv_data.settings.buttons.print_or_download }}
    </button>

    <!-- <div class="sticky bottom-0">
        <button @click="store_setting.cv_download()"
            class="btn rounded-xl w-full text-sm mt-2 text-white p-3 delay-150 transition hover:delay-0"
            :style="{ background: store_setting.cv_data.settings.colors }">
            {{ store_setting.cv_data.settings.buttons.download_as_json }}
        </button>
    </div> -->

    <!-- <label for="file"
        class="btn rounded-xl mt-2 block bottom-0 cursor-pointer w-100 p-3 text-center text-sm text-white delay-100 transition hover:delay-0"
        :style="{ background: store_setting.cv_data.settings.colors }">
        {{ store_setting.cv_data.settings.buttons.update_json_file }}
    </label> -->

    <!-- <input type="file" v-on:change="store_setting.cv_updata" style="display: none;" id="file">
    <button @click="store_setting.cv_remove()"
        class="btn rounded-xl w-full text-sm mt-2 text-white p-3 delay-50 transition hover:delay-0"
        :style="{ background: store_setting.cv_data.settings.colors }">
        {{ store_setting.cv_data.settings.buttons.remove_all_data }}
    </button> -->
</template>

<script>
import { useSettingStore } from "../stores/settings"
import cvComponent from "../components/cvComponent.vue"
export default {
    components: {
        cvComponent
    },
    data() {
        return {
            store_setting: useSettingStore(),
            cv_languages: ["english", "uzbek", "russia"],
            cv_colors: ["#000", "#00a8ef", "#ff5900", "#6055f7", "#0ebb62"],
        }
    },
}
</script>