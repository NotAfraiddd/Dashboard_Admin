<script setup>
import { ref, defineEmits, defineProps, watch, toRefs } from "vue";
import { SEARCH } from "../constants/img";
/**
 * Define the component props using defineProps
 */
const props = defineProps({
    placeholder: String,
    inputClass: String,
    iconSearch: {
        type: Boolean,
        default: false,
    },
    maxlength: {
        type: Number,
    },
    inputValueProps: {
        type: String,
        default: "",
    },
    typeInput: {
        type: String,
        default: "text",
    },
    onlyText: {
        type: Boolean,
        default: false,
    },
    onlyPhoneNumber: {
        type: Boolean,
        default: false,
    },
});
const { inputValueProps } = toRefs(props);
/**
 * Define the 'update' event emitter using defineEmits
 */
const emit = defineEmits(["update"]);

/**
 * Define a reactive reference for the input value
 */
const inputValue = ref(inputValueProps.value);

/**
 * Watch
 */
watch(inputValue, (newVal) => {
    emit("update", newVal);
});

watch(inputValueProps, (newVal) => {
    inputValue.value = newVal;
});
</script>

<template>
    <div class="search-input">
        <input :type="typeInput" :class="[
            'border border-[#ddd] focus-visible:outline-none h-9 rounded-md',
            !iconSearch ? 'pl-5' : 'pl-10',
            inputClass,
        ]" :placeholder="placeholder" spellcheck="false" v-model="inputValue" @keydown="validText"
            :maxlength="maxlength" />
        <div v-if="iconSearch">
            <img :src="SEARCH" alt="" class="search-icon w-5 h-5" />
        </div>
    </div>
</template>

<style scoped>
.search-input {
    position: relative;
}

.search-icon {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
}
</style>
