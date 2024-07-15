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
        <BaseTable :data="tableData" :columns="tableColumns" @click-row="navigateDetailTask">
            <template #name="{ record }">
                <div class="break-word text-overflow">
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
                        <span class="">
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
                    <div v-for="item in record.processes" :key="item.id" class="w-fit">
                        <div class="border rounded-md w-20 text-center h-8 flex items-center justify-center"
                            :style="{ background: item.color }">
                            {{ item.name }}
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
import { getListStatus } from "../../api/status";
import { getListUser } from "../../api/user";
import { getListTask } from "../../api/task";

const textFilter = ref("");
const selectOption = ref({ id: 0, text: "Select options" });
const listSelects = ref([
    { id: 0, text: "Select options" },
]);

const tableData = ref([]);

const tableColumns = ref([
    {
        headerClass: "text-center",
        columnClass: "",
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
 * handle search
 */
const handleSearch = () => {
    getListUsersFromApi();
}


/**
 * Function to handle the search event
 * @param newValue
 */
const handleUpdateFilter = (newValue) => {
    textFilter.value = newValue;
};

const navigateDetailTask = (data) => {
    router.push({ name: "DetailTask", params: { id: data.id_task } });
}

const navigateCreateTask = () => {
    router.push({ name: "CreateTask" });
}

/**
 * get list users
 */
const getListUsersFromApi = async () => {
    try {
        const params = {
            keyword: textFilter.value || "",
            process: selectOption.value.id || 0,
        };
        const res = await getListTask(params);
        const arr = [];
        res.data.forEach(task => {
            arr.push({
                id_task: task.id,
                id: task?.assignee?.id,
                name: task?.assignee?.name,
                email: task?.assignee?.email,
                task_title: task?.title,
                users_follow: getListFollowers(task?.followers),
                processes: getNewListStatus(task?.statuses),
            })
        });
        tableData.value = arr;
    } catch (error) {
        console.error("Error fetching list statuses:", error);
    }
}

/**
 * get list followers
 * @param data 
 */
const getListFollowers = (data) => {
    return data.map(item => ({
        id: item.id,
        name: item.name,
    }));
};

/**
 * get new list status
 * @param data 
 */
const getNewListStatus = (data) => {
    return data.map(item => ({
        id: item.id,
        name: item.name,
        color: item.color,
    }));
};


/**
 * get list status
 */
const getListStatusesFromApi = async () => {
    try {
        const params = {
            keyword: textFilter.value || "",
            process: selectOption.value.id || 0,
        };
        const res = await getListStatus(params);
        res.data.forEach(item => {
            listSelects.value.push({
                id: item?.id,
                text: item?.name,
            });
        });
    } catch (error) {
        console.error("Error fetching list statuses:", error);
    }
}

/**
 * list apis
 */
getListUsersFromApi();
getListStatusesFromApi();

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
