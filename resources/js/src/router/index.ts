import { createRouter, createWebHistory, RouteRecordRaw } from "vue-router";
import { useAppStore } from "@/stores/index";
import appSetting from "@/app-setting";

import HomeView from "../views/user/index.vue";
import StatusView from "../views/status/index.vue";
import DetailTask from "../views/user/DetailTask.vue";
import CreateTask from "../views/user/CreateTask.vue";
import CreateStatus from "../views/status/CreateStatus.vue";
import DetailStatus from "../views/status/DetailStatus.vue";

const routes: RouteRecordRaw[] = [
    // dashboard
    { path: "/", name: "home", component: HomeView },
    { path: "/task/create", name: "CreateTask", component: CreateTask },
    { path: "/task-of-user/:id", name: "DetailTask", component: DetailTask },
    { path: "/status", name: "Status", component: StatusView },
    { path: "/status/create", name: "CreateStatus", component: CreateStatus },
    { path: "/status/:id", name: "DetailStatus", component: DetailStatus },
];

const router = createRouter({
    history: createWebHistory(),
    linkExactActiveClass: "active",
    routes,
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition;
        } else {
            return { left: 0, top: 0 };
        }
    },
});

router.beforeEach((to, from, next) => {
    const store = useAppStore();

    if (to?.meta?.layout == "auth") {
        store.setMainLayout("auth");
    } else {
        store.setMainLayout("app");
    }
    next(true);
});
router.afterEach((to, from, next) => {
    appSetting.changeAnimation();
});
export default router;
