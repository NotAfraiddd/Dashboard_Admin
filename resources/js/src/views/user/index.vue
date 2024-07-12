<template>
    <div class="border p-4 min-h-screen bg-white rounded-xl">
        <div class="mb-5 flex">
            <BaseInput placeholder="Enter search information" @update="handleUpdateFilter" :inputValueProps="textFilter"
                inputClass="w-72 mr-10" :icon-search="true" />
            <BaseSelect :options="listSelects" v-model="selectOption" inputClass="mr-10" />
            <button class="rounded-md btn-primary w-24 h-9" @click="handleSearch">
                Search
            </button>
        </div>
        <BaseTable :data="tableData" :columns="tableColumns">
            <template #name="{ record }">
                <div class="break-word text-overflow" @click="handleRowClick(record)">
                    {{ record.name }}
                </div>
            </template>
            <template #email="{ record }">
                <div class="break-word text-overflow">
                    {{ record.email }}
                </div>
            </template>
            <template #users_follow="{ record }">
                <div class="flex break-word flex-wrap text-overflow">
                    <span v-for="(user, index) in record.users_follow" :key="user" class="w-fit">
                        <span class="hover:underline cursor-pointer" @click="handleRowClick(user)">
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
                    <div v-for="item in record.processes" :key="item" class="w-fit">
                        <div class="border rounded-md w-20 text-center h-8 flex items-center justify-center"
                            v-if="item.status === PROGRESS.not_start">
                            Not Start
                        </div>
                        <div class="border rounded-md w-20 text-center h-8 flex items-center justify-center bg-orange-200"
                            v-if="item.status === PROGRESS.in_process">
                            In Process
                        </div>
                        <div class="border rounded-md w-20 text-center h-8 flex items-center justify-center bg-blue-700"
                            v-if="item.status === PROGRESS.pending">
                            Pending
                        </div>
                        <div class="border rounded-md w-20 text-center h-8 flex items-center justify-center bg-gray-500"
                            v-if="item.status === PROGRESS.done">
                            Done
                        </div>
                    </div>
                </div>
            </template>
        </BaseTable>
        <div class="mt-8 text-center p-5 rounded-lg border-dotted border-4 cursor-pointer" @click="navigateCreateTask">
            <span>＋ Add New Task</span>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import BaseTable from "../../components/BaseTable.vue";
import { RENDER_TYPE, PROGRESS } from "../../constants";
import BaseInput from "../../components/BaseInput.vue";
import BaseSelect from "../../components/BaseSelect.vue";
import { useRouter } from "vue-router";

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
        id: 1,
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
        id: 2,
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
        columnClass: "hover:underline cursor-pointer",
        title: "Name",
        key: "name",
        slotName: "name",
        renderType: RENDER_TYPE.slot,
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

/**
 * Function to handle go to detail user
 * @param data
 */
const handleRowClick = (data) => {
    router.push({ name: "DetailTask", params: { id: data.id } });
};

const navigateCreateTask = () => {
    router.push({ name: "CreateTask" });

}
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
