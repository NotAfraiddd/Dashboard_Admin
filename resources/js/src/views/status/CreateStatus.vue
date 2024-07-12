<template>
  <div class="border p-4 min-h-screen bg-white rounded-xl">
    <div class="flex w-full justify-center items-center my-3">
      <div class="w-1/4">Name process</div>
      <div class="w-3/4 flex justify-between items-center mr-3">
        <BaseInput placeholder="Enter name process" @update="updateValueNameProcess" :inputValueProps="textNameProcess"
          inputClass="w-72 mr-10" />
      </div>
    </div>
    <div class="flex w-full justify-center items-center my-3">
      <div class="w-1/4">Color</div>
      <div class="w-3/4 flex justify-between items-center mr-3">
        <VSwatches v-model="color" />
      </div>
    </div>
    <div class="flex w-full justify-end items-center my-3">
      <div v-if="!hasParam"
        class="w-24 h-8 cursor-pointer bg-blue-400 text-white flex items-center justify-center rounded-md"
        @click="createStatusFromApi">Create
      </div>
      <div v-else class="w-24 h-8 cursor-pointer bg-green-400 text-white flex items-center justify-center rounded-md"
        @click="updateStatusFromApi">Update</div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import BaseInput from '../../components/BaseInput.vue';
import { useRoute } from 'vue-router';
import { createStatus, getStatusDetail, updateStatus } from '../../api/status';
import { useNotification } from "@kyvg/vue3-notification";
import { ERROR_MESSAGE } from '../../constants';

const route = useRoute();
const hasParam = ref(route.params.id !== undefined);
const idStatus = ref(route.params.id);
const textNameProcess = ref(null);
const color = ref('#1CA085');
const notification = useNotification();

const updateValueNameProcess = (data) => {
  textNameProcess.value = data;
}

/**
 * get status detail
 */
const getStatusDetailFromApi = async () => {
  try {
    const res = await getStatusDetail(idStatus.value);
    color.value = res.data.color;
    textNameProcess.value = res.data.name;
  } catch (error) {
    notification.notify({
      title: ERROR_MESSAGE.create_fail,
      type: "error",
    });
    console.error("Error create statuses:", error);
  }
}

/**
 * create status
 */
const createStatusFromApi = async () => {
  try {
    const formData = new FormData();
    formData.append('name', textNameProcess.value)
    formData.append('color', color.value)
    if (textNameProcess.value && color.value) {
      const res = await createStatus(formData);
      if (res.data) {
        notification.notify({
          title: ERROR_MESSAGE.create_success,
          type: "success",
        });
        route.push({ name: "Status" });
      }
    } else {
      notification.notify({
        title: ERROR_MESSAGE.empty_data,
        type: "warn",
      });
    }
  } catch (error) {
    notification.notify({
      title: ERROR_MESSAGE.create_fail,
      type: "error",
    });
    console.error("Error create statuses:", error);
  }
}

/**
 * udpate status
 */
const updateStatusFromApi = async () => {
  try {
    const formData = new FormData();
    formData.append('name', textNameProcess.value)
    formData.append('color', color.value)
    if (textNameProcess.value && color.value) {
      const res = await updateStatus(idStatus.value, formData);
      if (res.data) {
        notification.notify({
          title: ERROR_MESSAGE.update_success,
          type: "success",
        });
        route.push({ name: "Status" });
      }
    } else {
      notification.notify({
        title: ERROR_MESSAGE.empty_data,
        type: "warn",
      });
    }
  } catch (error) {
    notification.notify({
      title: ERROR_MESSAGE.update_fail,
      type: "error",
    });
    console.error("Error fetching list statuses:", error);
  }
}

// list apis
hasParam.value && getStatusDetailFromApi();
</script>

<style scoped></style>
