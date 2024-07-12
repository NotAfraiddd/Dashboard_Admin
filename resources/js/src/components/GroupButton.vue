<template>
  <div class="flex flex-wrap gap-2 items-center justify-center">
    <div
      class="h-8 min-w-[40px] w-24 bg-yellow-500 hover:bg-yellow-400 text-white cursor-pointer rounded-lg text-center flex items-center justify-center"
      @click="handleCancel">
      {{ cancelText }}
    </div>
    <div
      class="h-8 min-w-[40px] w-24 bg-blue-500 hover:bg-blue-400 text-white cursor-pointer rounded-lg text-center flex items-center justify-center"
      @click="handleSave">
      {{ saveText }}
    </div>
  </div>
</template>
<script setup>
import { defineProps, defineEmits } from "vue";

const emit = defineEmits(["cancel", "save"]);
const props = defineProps(["cancelText", "saveText"]);

const handleCancel = () => {
  emit("cancel");
};

const handleSave = () => {
  emit("save");
};
</script>