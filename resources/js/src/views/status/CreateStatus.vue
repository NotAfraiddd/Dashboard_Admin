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
      <div v-if="!hasParam" class="w-24 h-8 bg-blue-400 text-white flex items-center justify-center rounded-md">Create
      </div>
      <div v-else class="w-24 h-8 bg-green-400 text-white flex items-center justify-center rounded-md">Update</div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import BaseInput from '../../components/BaseInput.vue';
import { useRoute } from 'vue-router';
const route = useRoute();
const hasParam = ref(route.params.id !== undefined);
const textNameProcess = ref(null);
const color = ref('#1CA085');

function updateValueNameProcess(data) {
  textNameProcess.value = data;
}
</script>

<style scoped>
/* Add your styles here if needed */
</style>
