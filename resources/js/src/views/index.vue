<template>
    <div class="border p-4 min-h-screen bg-white rounded-xl">
        <div class="mb-5 flex">
            <BaseInput
                placeholder="Enter search information"
                @update="handleUpdateFilter"
                :inputValueProps="textFilter"
                inputClass="w-72 mr-10"
                :icon-search="true"
            />
            <BaseSelect
                :options="listSelects"
                v-model="selectOption"
                inputClass="mr-10"
            />
            <button
                class="rounded-md btn-primary w-24 h-9"
                @click="handleSearch"
            >
                検索
            </button>
        </div>
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
                        <span
                            class="hover:underline cursor-pointer"
                            @click="handleRowClick(user)"
                        >
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
                        v-for="item in record.processes"
                        :key="item"
                        class="w-fit"
                    >
                        <div
                            class="border rounded-md w-20 text-center h-8 flex items-center justify-center"
                            v-if="item.status === PROGRESS.not_start"
                        >
                            Not Start
                        </div>
                        <div
                            class="border rounded-md w-20 text-center h-8 flex items-center justify-center bg-orange-200"
                            v-if="item.status === PROGRESS.in_process"
                        >
                            In Process
                        </div>
                        <div
                            class="border rounded-md w-20 text-center h-8 flex items-center justify-center bg-blue-700"
                            v-if="item.status === PROGRESS.pending"
                        >
                            Pending
                        </div>
                        <div
                            class="border rounded-md w-20 text-center h-8 flex items-center justify-center bg-gray-500"
                            v-if="item.status === PROGRESS.done"
                        >
                            Done
                        </div>
                    </div>
                </div>
            </template>
        </BaseTable>
    </div>
</template>

<script setup>
import { ref } from "vue";
import BaseTable from "../components/BaseTable.vue";
import { AVATAR } from "../constants/img";
import { RENDER_TYPE, PROGRESS } from "../constants";
import BaseInput from "../components/BaseInput.vue";
import BaseSelect from "../components/BaseSelect.vue";
import { useRouter } from "vue-router";
import DetailUser from "./user/DetailUser.vue";

const textFilter = ref("");
const selectOption = ref({ id: 0, text: "Select options" });
const listSelects = ref([
    { id: 0, text: "Select options" },
    { id: 1, text: "Not start" },
    { id: 2, text: "In process" },
    { id: 3, text: "Pending" },
    { id: 4, text: "Done" },
]);

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
        processes: [
            {
                id: 1,
                status: PROGRESS.not_start,
            },
            {
                id: 2,
                status: PROGRESS.in_process,
            },
            {
                id: 3,
                status: PROGRESS.pending,
            },
            {
                id: 4,
                status: PROGRESS.done,
            },
        ],
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

const router = useRouter();

/**
 * Function to handle the search event
 * @param newValue
 */
const handleUpdateFilter = (newValue) => {
    textFilter.value = newValue;
};

const handleRowClick = (data) => {
    router.push({ name: "DetailUser", params: { id: data.id } });
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
