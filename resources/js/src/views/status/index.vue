<template>
  <div class="border p-4 min-h-screen bg-white rounded-xl">
    <div class="mb-5 flex">
      <BaseInput placeholder="Enter search information" @update="handleUpdateFilter" :inputValueProps="textFilter"
        inputClass="w-72 mr-10" :icon-search="true" />
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
      <template #color="{ record }">
        <div :style="{ backgroundColor: record.color }" class="w-5 h-5 rounded-full border">
        </div>
      </template>
    </BaseTable>
    <div class="mt-8 text-center p-5 rounded-lg border-dotted border-4 cursor-pointer" @click="navigateCreateStatus">
      <span>＋ Add New Status</span>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import BaseTable from "../../components/BaseTable.vue";
import { RENDER_TYPE } from "../../constants";
import BaseInput from "../../components/BaseInput.vue";
import { useRouter } from "vue-router";
import { getListStatus } from "../../api/status";
const textFilter = ref("");
const router = useRouter();
const tableData = ref([]);

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
    title: "Color",
    key: "color",
    slotName: "color",
    renderType: RENDER_TYPE.slot,
  },
]);

/**
 * handle search
 */
const handleSearch = () => {
  getListStatusesFromApi();
}

/**
 * get list status
 */
const getListStatusesFromApi = async () => {
  try {
    const params = {
      keyword: textFilter.value || "",
    };
    const res = await getListStatus(params);
    tableData.value = [];
    res.data.forEach(item => {
      tableData.value.push({
        id: item?.id,
        name: item?.name,
        color: item?.color,
      });
    });
  } catch (error) {
    console.error("Error fetching list statuses:", error);
  }
}

// list apis
getListStatusesFromApi();

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
  router.push({ name: "DetailStatus", params: { id: data.id } });
};

const navigateCreateStatus = () => {
  router.push({ name: "CreateStatus" });

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
