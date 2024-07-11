<template>
    <select
        v-model="selectOption"
        class="select-list border cursor-pointer w-60 mr-5 rounded-md px-4 h-9 appearance-none bg-white bg-no-repeat focus-visible:outline-none"
        :class="[inputClass]"
    >
        <option
            v-for="option in options"
            :key="option.id"
            :value="option.id"
            class="cur-p text-grey1"
        >
            <span class="px-3 text-grey9">{{ option.text }}</span>
        </option>
    </select>
</template>

<script setup>
import { ref, watchEffect, defineProps, defineEmits } from "vue";

/**
 * Define the component props using defineProps
 */
const props = defineProps({
    options: {
        type: Array,
    },
    modelValue: {
        type: Object,
        default: () => ({ id: null, text: "" }),
    },
    inputClass: String,
});

/**
 * Define a reactive reference for the selected option's ID
 */
let selectOption = ref(props.modelValue.id);

/**
 * Define the 'update:modelValue' event emitter using defineEmits
 */
const emit = defineEmits(["update:modelValue"]);

/**
 * Watch for changes in the selected option ID and emit the 'update:modelValue' event accordingly
 */
watchEffect(() => {
    emit(
        "update:modelValue",
        props.options.find((option) => option.id === selectOption.value)
    );
});
</script>

<style scoped>
.select-list {
    background-position: right 10px top 50%;
    background-size: 16px auto;
    background-repeat: no-repeat;
    background-image: url(../assets/img/down-arrow.svg);
}
</style>
