<template>
  <div class="border p-4 min-h-screen bg-white rounded-xl ">
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
        <!-- <v-swatches v-model="color"></v-swatches> -->
      </div>
    </div>
  </div>
</template>

<script>
import BaseInput from '../../components/BaseInput.vue';
// import VSwatches from 'vue-swatches'
// import "vue-swatches/dist/vue-swatches.css";

export default {
  components: {
    BaseInput
  },
  data() {
    return {
      textNameProcess: null,
      color: '#1CA085',
      colorPickerTemp: null,
      colorPicker: null
    };
  },
  methods: {
    updateValueNameProcess(data) {
      this.textNameProcess = data;
    },
  },
};
</script>


<style lang="css" scoped></style>