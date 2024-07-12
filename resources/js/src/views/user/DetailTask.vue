<template>
    <div class="border flex p-4 min-h-screen bg-white rounded-xl justify-between">
        <div class="w-[90%] flex flex-col gap-2 mr-5">
            <div class="flex w-full justify-center items-center my-3">
                <div class="w-1/4">Process</div>
                <div class="w-2/4">
                    <draggable :list="listProcess" itemKey="name" group="myGroup" class="flex h-10 flex-wrap gap-3">
                        <div class="border w-20 cursor-pointer h-8 flex items-center justify-center rounded-md relative"
                            :class="[generateClass(element.id)]" v-for="element in listProcess" :key="element.name">
                            {{ element.name }}
                            <img :src="DELETE" alt="" srcset="" class="w-5 h-5 absolute border rounded-full"
                                style="top: -10px; right: -10px" @click="handleDelete(element)" />
                        </div>
                        <template v-if="listProcess.length === 0">
                            <div class="text-center py-2">Put process here</div>
                        </template>
                    </draggable>
                </div>
                <div class="w-1/4"></div>
            </div>
            <div class="flex w-full justify-center items-center my-3">
                <div class="w-1/4">Name</div>
                <div class="w-3/4 ">
                    <div v-if="!isEditName" class="w-full flex justify-between items-center">
                        <span>Chi Bao</span>
                        <img :src="PENCIL" alt="" srcset="" class="w-5 h-5 cursor-pointer" @click="handleEdit('name')">
                    </div>
                    <div v-else class="w-full flex justify-between items-center mr-3">
                        <BaseSelect :options="listSelects" v-model="textName" inputClass="w-72 mr-10" />
                        <GroupButton @cancel="handleCancel('name')" @save="handleSave('name')" cancel-text="Cancel"
                            save-text="Ok">
                        </GroupButton>
                    </div>
                </div>
            </div>
            <div class="flex w-full justify-center items-center my-3">
                <div class="w-1/4">Email</div>
                <div class="w-3/4">
                    <div v-if="!isEditEmail" class="w-full flex justify-between items-center">
                        <span>nguyenhuynhchibao@gmail.com</span>
                        <img :src="PENCIL" alt="" srcset="" class="w-5 h-5 cursor-pointer" @click="handleEdit('email')">
                    </div>
                    <div v-else class="w-full flex justify-between items-center mr-3">
                        <BaseInput placeholder="Enter email" @update="updateValueEmail" :inputValueProps="textEmail"
                            inputClass="w-72 mr-10" />
                        <GroupButton @cancel="handleCancel('email')" @save="handleSave('email')" cancel-text="Cancel"
                            save-text="Ok">
                        </GroupButton>
                    </div>
                </div>
            </div>
            <div class="flex w-full justify-center items-center my-3">
                <div class="w-1/4">Title task</div>
                <div class="w-3/4">
                    <div v-if="!isEditTitle" class="w-full flex justify-between items-center">
                        <span>Write document in Javascript</span>
                        <img :src="PENCIL" alt="" srcset="" class="w-5 h-5 cursor-pointer" @click="handleEdit('title')">
                    </div>
                    <div v-else class="w-full flex justify-between items-center mr-3">
                        <BaseInput placeholder="Enter title task" @update="updateValueTitle"
                            :inputValueProps="textTitle" inputClass="w-72 mr-10" />
                        <GroupButton @cancel="handleCancel('title')" @save="handleSave('title')" cancel-text="Cancel"
                            save-text="Ok">
                        </GroupButton>
                    </div>
                </div>
            </div>
            <div class="flex w-full justify-center items-center my-3">
                <div class="w-1/4">Description</div>
                <div class="w-3/4">
                    <div v-if="!isEditDescription" class="w-full flex justify-between items-center">
                        <span>Write document in Javascript</span>
                        <img :src="PENCIL" alt="" srcset="" class="w-5 h-5 cursor-pointer"
                            @click="handleEdit('description')">
                    </div>
                    <div v-else class="w-full flex justify-between items-center mr-3">
                        <Work :contentProp="textDescription" @update="handleUpdateTextEditor" />
                        <GroupButton @cancel="handleCancel('description')" @save="handleSave('description')"
                            cancel-text="Cancel" save-text="Ok">
                        </GroupButton>
                    </div>
                </div>
            </div>
            <div class="flex w-full justify-center items-center my-3">
                <div class="w-1/4">Deadline</div>
                <div class="w-3/4">
                    <div v-if="!isEditDeadline" class="w-full flex justify-between items-center">
                        <span>28/07/2024</span>
                        <img :src="PENCIL" alt="" srcset="" class="w-5 h-5 cursor-pointer"
                            @click="handleEdit('deadline')">
                    </div>
                    <div v-else class="w-full flex justify-between items-center mr-3">
                        <div class="w-72 mr-10">
                            <VueDatePicker v-model="textDeadline" position="right" placeholder="Set deadline ">
                                <template #clear-icon>
                                    <img class="d-none" />
                                </template>
                                <template #input-icon>
                                    <img class="d-none" />
                                </template>
                            </VueDatePicker>
                        </div>
                        <GroupButton @cancel="handleCancel('deadline')" @save="handleSave('deadline')"
                            cancel-text="Cancel" save-text="Ok">
                        </GroupButton>
                    </div>

                </div>
            </div>
        </div>
        <div class="">
            <draggable :list="filteredStatus" itemKey="name" group="myGroup" :sort="false"
                class="flex flex-col min-h-[60px] min-w-[60px] border px-2 justify-center items-center">
                <div class="border w-20 cursor-pointer h-8 my-2 flex items-center justify-center rounded-md"
                    :class="[generateClass(element.id)]" v-for="element in filteredStatus" :key="element.name">
                    {{ element.name }}
                </div>
                <template v-if="filteredStatus.length === 0">
                    <div class="text-center py-2 text-gray-500">Put process here</div>
                </template>
            </draggable>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import { VueDraggableNext } from "vue-draggable-next";
import { PENCIL, DELETE } from "../../constants/img";
import GroupButton from "../../components/GroupButton.vue";
import BaseInput from "../../components/BaseInput.vue";
import Work from "../../components/Work.vue";
import BaseSelect from '../../components/BaseSelect.vue';

export default defineComponent({
    components: {
        draggable: VueDraggableNext,
        GroupButton, BaseInput, Work, BaseSelect
    },
    created() {
        this.DELETE = DELETE;
        this.PENCIL = PENCIL;
    },
    data() {
        return {
            isEditName: false,
            isEditEmail: false,
            isEditTitle: false,
            isEditDescription: false,
            isEditDeadline: false,
            listStatus: [
                { id: 1, name: "Not Start" },
                { id: 2, name: "In Process" },
                { id: 3, name: "Pending" },
                { id: 4, name: "Done" },
            ],
            listProcess: [
                { id: 1, name: "Not Start" },
                { id: 4, name: "Done" },
            ],
            listSelects: [
                { id: 0, text: "Select options" },
                { id: 1, text: "Not start" },
                { id: 2, text: "In process" },
                { id: 3, text: "Pending" },
                { id: 4, text: "Done" },
            ],
            chooseYearInput: null,
            textName: { id: 0, text: "Select options" },
            textEmail: null,
            textTitle: null,
            textDescription: null,
            textDeadline: null,
        };
    },
    computed: {
        filteredStatus() {
            return this.listStatus.filter(status =>
                !this.listProcess.some(process => process.id === status.id)
            );
        },
    },
    methods: {
        /**
         * update new value of textDescription
         * @param newValue
         */
        handleUpdateTextEditor(newValue) {
            this.textDescription = newValue;
        },

        /**
         * update new value of textTitle
         * @param newVal 
         */
        updateValueTitle(newVal) {
            this.textTitle = newVal;
        },

        /**
         * update new value of textName
         * @param newVal 
         */
        updateValueName(newVal) {
            this.textName = newVal;
        },

        /**
         * update new value of textEmail
         * @param newVal 
         */
        updateValueEmail(newVal) {
            this.textEmail = newVal;
        },

        setEditingState(field, state) {
            switch (field) {
                case 'name':
                    this.isEditName = state;
                    break;
                case 'email':
                    this.isEditEmail = state;
                    break;
                case 'title':
                    this.isEditTitle = state;
                    break;
                case 'description':
                    this.isEditDescription = state;
                    break;
                case 'deadline':
                    this.isEditDeadline = state;
                    break;
                default:
                    break;
            }
        },

        /**
         * handle turn on edit
         * @param field 
         */
        handleEdit(field) {
            this.setEditingState(field, true);
        },

        /**
         * handle off on edit
         * @param field 
         */
        handleCancel(field) {
            this.setEditingState(field, false);
        },

        /**
         * handle turn on edit
         * @param field 
         */
        handleSave(field) {
            this.setEditingState(field, false);
        },

        /**
         * Generates a CSS class based on the given id.
         * @param {number} id - The id to determine the CSS class for.
         * @returns {string} - The CSS class corresponding to the id.
         */
        generateClass(id) {
            switch (id) {
                case 2:
                    return "bg-orange-200";
                case 3:
                    return "bg-blue-700";
                case 4:
                    return "bg-green-500";
                default:
                    return "";
            }
        },

        /**
         * handle delete
         * @param data
         */
        handleDelete(data) {
            this.listProcess = this.listProcess.filter((item) => item !== data);
            if (!this.listStatus.some(item => item.id === data.id)) {
                this.listStatus.push(data);
            }
        },
    },
});
</script>

<style lang="css">
.dp__input {
    font-size: 14px;
    min-width: 288px;
}
</style>
