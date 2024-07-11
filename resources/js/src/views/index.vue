<template>
    <div class="border p-4 min-h-screen bg-white rounded-xl">
        <div>
            <BaseTable :data="tableData" :columns="tableColumns">
                <template #avatar="{ record }">
                    <img
                        :src="record.avatar"
                        alt="Avatar"
                        class="min-w-[40px] h-10 text-center"
                    />
                </template>
                <template #email="{ record }">
                    <div class="break-word text-overflow">
                        {{ record.email }}
                    </div>
                </template>
                <template #users_follow="{ record }">
                    <div class="flex break-word flex-wrap text-overflow">
                        <span
                            v-for="(user, index) in record.users_follow"
                            :key="user"
                            class="w-fit"
                        >
                            <span class="hover:underline cursor-pointer">
                                {{ user.name }}
                            </span>
                            <span v-if="index < record.users_follow.length - 1">
                                ,
                            </span>
                        </span>
                    </div>
                </template>
                <template #task_title="{ record }">
                    <div class="break-word text-overflow">
                        {{ record.task_title }}
                    </div>
                </template>
                <template #processes="{ record }">
                    <div class="flex flex-wrap gap-2">
                        <div
                            v-for="status in record.processes"
                            :key="status"
                            class="w-fit"
                        >
                            <div
                                class="border rounded-md w-20 text-center"
                                v-if="status === PROGRESS.not_start"
                            >
                                Not Start
                            </div>
                            <div
                                class="border rounded-md w-20 text-center bg-orange-200"
                                v-if="status === PROGRESS.in_process"
                            >
                                In Process
                            </div>
                            <div v-if="status === PROGRESS.pending">
                                Pending
                            </div>
                            <div v-if="status === PROGRESS.done">Done</div>
                        </div>
                    </div>
                </template>
            </BaseTable>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import BaseTable from "../components/BaseTable.vue";
import { AVATAR } from "../constants/img";
import { RENDER_TYPE, PROGRESS } from "../constants";
const tableData = ref([
    {
        avatar: AVATAR,
        name: "John",
        email: "nguyenhuynhchibao@gmail.com",
        task_title: "Write document in Javascript",
        users_follow: [
            {
                id: 1,
                name: "chi bao",
            },
            {
                id: 2,
                name: "tien dat",
            },
            {
                id: 3,
                name: "an com chua",
            },
            {
                id: 4,
                name: "troi oi",
            },
            {
                id: 5,
                name: "buon ngu qua",
            },
        ],
        processes: [PROGRESS.not_start, PROGRESS.in_process],
    },
    {
        avatar: AVATAR,
        name: "Jane",
        email: "nguyenhuynhchibao@gmail.com",
        task_title: "Write document in Javascript",
        users_follow: [
            {
                id: 1,
                name: "chi bao",
            },
        ],
        processes: [PROGRESS.in_process],
    },
]);

const tableColumns = ref([
    {
        headerClass: "text-center",
        columnClass: "",
        title: "",
        key: "avatar",
        slotName: "avatar",
        renderType: RENDER_TYPE.slot,
    },
    {
        headerClass: "text-center",
        columnClass: "hover:underline cursor-pointer",
        title: "Name",
        key: "name",
    },
    {
        headerClass: "text-center",
        columnClass: "",
        title: "Email",
        key: "email",
        slotName: "email",
        renderType: RENDER_TYPE.slot,
    },
    {
        headerClass: "text-center",
        columnClass: "",
        title: "Task title",
        key: "task_title",
        slotName: "task_title",
        renderType: RENDER_TYPE.slot,
    },
    {
        headerClass: "text-center",
        columnClass: "",
        title: "User Follower",
        key: "users_follow",
        slotName: "users_follow",
        renderType: RENDER_TYPE.slot,
    },
    {
        headerClass: "text-center",
        columnClass: "",
        title: "Process",
        key: "processes",
        slotName: "processes",
        renderType: RENDER_TYPE.slot,
    },
]);

const handleRowClick = (row) => {
    console.log("Row clicked:", row);
};
</script>

<style lang="css" scoped>
.text-overflow {
    overflow: hidden;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
    text-overflow: ellipsis;
}

.break-word {
    word-break: break-word;
}
</style>
