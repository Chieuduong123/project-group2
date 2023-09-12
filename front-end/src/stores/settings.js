import { defineStore } from "pinia";

import data_en from "./data/data_en.json";
import data_ve from "./data/data_ve.json";

if (!JSON.parse(localStorage.getItem("cv_data"))) {
  localStorage.setItem("cv_data", JSON.stringify(data_en));
}
// window.addEventListener("load", () => {
//     let data = JSON.parse(localStorage.getItem("cv_data")).personal_details
//     document.title = data.first_name + "'s cv"
// })

export const useSettingStore = defineStore("settings", {
  state: () => {
    return {
      cv_data: JSON.parse(localStorage.getItem("cv_data")),
    };
  },
  actions: {
    cv_change_languages(language) {
      switch (language) {
        case "english":
          localStorage.setItem("cv_data", JSON.stringify(data_en));
          this.cv_data = JSON.parse(localStorage.getItem("cv_data"));
          break;
        case "vietnam":
          localStorage.setItem("cv_data", JSON.stringify(data_ve));
          this.cv_data = JSON.parse(localStorage.getItem("cv_data"));
          break;
      }
    },
    cv_change_colors(color) {
      this.cv_data.settings.colors = color;
      const root_theme = document.querySelector(":root");
      root_theme.style.setProperty("--clrx", color);
      this.cv_save();
    },
    cv_data_tech_add() {
      let txtToArr = document.querySelector("#tech").value.split(",");
      this.cv_data.skills.tech = txtToArr;
      this.cv_save();
    },
    cv_data_soft_add() {
      let txtToArr = document.querySelector("#soft").value.split(",");
      this.cv_data.skills.soft = txtToArr;
      this.cv_save();
    },
    add_language_cv_data() {
      let newData = {
        isLanguage: true,
        name: "",
        level: 10,
      };
      this.cv_data.skills.language.push(newData);
      this.cv_save();
    },
    add_experience_cv_data() {
      let newData = {
        isExperience: true,
        title: "",
        location: "",
        from: "",
        to: "",
        summary: "",
      };
      this.cv_data.experiences.push(newData);
      this.cv_save();
    },
    add_educations_and_certifications_cv_data() {
      let newData = {
        isTrue: true,
        title: "",
        location: "",
        from: "",
        to: "",
        summary: "",
      };
      this.cv_data.educations_and_certifications.push(newData);
      this.cv_save();
    },

    cv_save() {
      // let data = JSON.parse(localStorage.getItem("cv_data")).personal_details
      // document.title = data.first_name + "'s cv"
      localStorage.setItem("cv_data", JSON.stringify(this.cv_data));
    },
    cv_remove() {
      let conf = confirm("Are you sure? all your data will be deleted. 😅");
      let data = JSON.parse(localStorage.getItem("cv_data")).personal_details
        .first_name;
      if (conf) {
        let prom = prompt("Just enter your name in cv which is written. 🫣");
        if (prom.toLocaleLowerCase() == data.toLocaleLowerCase()) {
          localStorage.removeItem("cv_data");
          alert("SUCCESS \nYour all data removed.💥 \nNow Reload page ");
        } else {
          alert("ERROR! Your name did not match. \nPlease try again.  😔");
        }
      }
    },
    cv_download() {
      const jsonData = localStorage.getItem("cv_data");
      const blob = new Blob([jsonData], { type: "application/json" });
      const url = URL.createObjectURL(blob);
      const link = document.createElement("a");
      link.href = url;
      link.download =
        "CV_" +
        this.cv_data.personal_details.first_name +
        "_" +
        this.cv_data.personal_details.last_name +
        "_" +
        this.cv_data.settings.cv +
        "_" +
        new Date().getFullYear();
      console.log(link.download);
      link.click();
      URL.revokeObjectURL(url);
    },
    cv_updata(event) {
      var reader = new FileReader();
      reader.onload = onReaderLoad;
      reader.readAsText(event.target.files[0]);
      let oldKey = Object.keys(this.cv_data);
      console.log(oldKey);

      function onReaderLoad(event) {
        var obj = JSON.parse(event.target.result);
        let objKey = Object.keys(obj);
        console.log(objKey);
        if (oldKey[0] == objKey[0]) {
          localStorage.setItem("cv_data", JSON.stringify(obj));
          alert("SUCCESS, \nNow reload page. 🧑‍💻");
        } else {
          alert("Your JSON file did not match. ❓");
        }
      }
    },
    async cv_getDetail(cv) {
      if (!JSON.parse(localStorage.getItem("cv_data"))) {
        localStorage.setItem("cv_data", JSON.stringify(cv));
      }
      localStorage.setItem("cv_data", JSON.stringify(cv));
      this.cv_data = cv;
    },
  },
});
