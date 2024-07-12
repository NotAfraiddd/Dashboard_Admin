<template>
  <Editor :api-key="apiKey" v-model="content" :init="editorConfig" @getContent="handleEditorChange" />
</template>

<script setup>
import { ref, defineProps, defineEmits } from "vue";
import Editor from "@tinymce/tinymce-vue";

const props = defineProps({
  contentProp: {
    type: String,
    required: "",
  },
});
const emits = defineEmits(["update"]);
const content = ref(props.contentProp);
const apiKey = import.meta.env.VITE_TINYMCE_API_KEY;
const editorConfig = ref({
  statusbar: false,
  notifications: false,
  height: 350,
  menubar: false,
  toolbar_mode: "sliding",
  plugins:
    "anchor autolink charmap codesample link lists searchreplace table visualblocks wordcount",
  toolbar:
    " blocks fontsize | bold italic underline strikethrough | link table | align lineheight | numlist bullist indent outdent | charmap | removeformat",
});

/**
 * emit content value
 */
const handleEditorChange = () => {
  emits("update", content.value);
};
</script>

<style lang="css" scoped>
.tox {
  display: none !important;
}
</style>
