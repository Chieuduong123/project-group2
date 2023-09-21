import { createRouter, createWebHistory } from "vue-router";
import HomeLayout from "../src/layouts/HomeLayout.vue";
import AuthLayout from "../src/layouts/AuthLayout.vue";
import HomePage from "./pages/Client/HomePage.vue";
import JobDetail from "./pages/Client/JobDetail.vue";
import LoginPage from "./pages/Auth/LoginPage.vue";
import RegisterPage from "./pages/Auth/RegisterPage.vue";
import CompanyPage from "./pages/Client/CompanyPage.vue";
import CVManagement from "./pages/Client/CVManagementPage.vue";
import AboutPage from "./pages/Client/AboutPage.vue";
import BlogPage from "./pages/Client/BlogPage.vue";
import CompanyDetail from "./pages/Client/CompanyDetail.vue";
import RegisterToBusiness from "./pages/Business/RegisterToBusiness.vue";
import LoginBusiness from "./pages/Business/LoginBusiness.vue";
import BusinessLayout from "./layouts/BusinessLayout.vue";
import PostBusinessPage from "./pages/Business/PostBusinessPage.vue";
import ApplyManager from "./pages/Business/ApplyManager.vue";
import ApplyDetail from "./pages/Business/ApplyDetail.vue";
import BusinessProfile from "./pages/Business/BusinessProfile.vue";
import CreateCVPage from "./pages/Client/CreateCVPage.vue";
import ProfilePage from "./pages/Client/ProfilePage.vue";
import FavoriteJobPage from "./pages/Client/FavoriteJobPage.vue";
import NotFoundPage from "./pages/Client/NotFoundPage.vue";
import HistoryPage from "./pages/Client/HistoryPage.vue";
import ChangePassword from "./pages/Client/ChangePassword.vue";
import SearchResultPage from "./pages/Client/SearchResultPage.vue";
import CVDetailPage from "./pages/Client/CVDetailPage.vue";
import RecommendJobSetting from "./pages/Client/RecommendJobSetting.vue";
import ForgotPasswordPage from "./pages/Client/ForgotPasswordPage.vue";
import DashboardPage from "./pages/Business/DashboardPage.vue";
const routes = [
  {
    path: "/",
    component: HomeLayout,
    children: [
      { path: "", component: HomePage },
      { path: "job/:id", component: JobDetail },
      { path: "company", component: CompanyPage },
      { path: "company/:id", component: CompanyDetail },
      { path: "cv-management", component: CVManagement },
      { path: "cv/:id", component: CVDetailPage },
      { path: "about", component: AboutPage },
      { path: "blog", component: BlogPage },
      { path: "create-cv", component: CreateCVPage },
      { path: "profile", component: ProfilePage },
      { path: "favorite", component: FavoriteJobPage },
      { path: "history", component: HistoryPage },
      { path: "change-password", component: ChangePassword },
      { path: "search", component: SearchResultPage },
      { path: "setting-recommend", component: RecommendJobSetting },
    ],
  },
  {
    path: "/auth-layout",
    component: AuthLayout,
    children: [
      { path: "", component: LoginPage },
      { path: "register", component: RegisterPage },
      { path: "register-business", component: RegisterToBusiness },
      { path: "login-business", component: LoginBusiness },
      { path: "forgot-password", component: ForgotPasswordPage },
    ],
  },
  {
    path: "/business",
    component: BusinessLayout,
    children: [
      { path: "", component: DashboardPage },
      { path: "post", component: PostBusinessPage },
      { path: "apply-manager", component: ApplyManager },
      { path: "apply-manager/:id", component: ApplyDetail },
      { path: "profile", component: BusinessProfile },
    ],
  },
  { path: "/:pathMatch(.*)*", name: "NotFound", component: NotFoundPage },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  window.scrollTo(0, 0);
  next();
});

export default router;
