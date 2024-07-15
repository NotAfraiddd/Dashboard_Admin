<template>
  <div class="border p-4 min-h-screen bg-white rounded-xl ">
    <div class="w-full flex justify-between">
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
                <div class="text-center py-2 border-b-2">Put process here</div>
              </template>
            </draggable>
          </div>
          <div class="w-1/4"></div>
        </div>
        <div class="flex w-full justify-center items-center my-3">
          <div class="w-1/4">Name</div>
          <div class="w-3/4 flex justify-between items-center mr-3">
            <BaseSelect :options="listSelects" v-model="textName" inputClass="w-72 mr-10" />
          </div>
        </div>
        <div class="flex w-full justify-center items-center my-3">
          <div class="w-1/4">Followers</div>
          <div class="w-3/4 flex justify-between items-center mr-3">
            <div class="w-1/2 mr-10">
              <VueMultiselect v-model="multiFollowers" :options="listFollowers" :multiple="true" :preserve-search="true"
                :close-on-select="true" placeholder="Choose users for task" label="name" track-by="name" />
            </div>
          </div>
        </div>
        <div class="flex w-full justify-center items-center my-3">
          <div class="w-1/4">Email</div>
          <div class="w-3/4 flex justify-between items-center mr-3">
            <BaseInput placeholder="Enter email" @update="updateValueEmail" :inputValueProps="textEmail"
              inputClass="w-72 mr-10" />
          </div>
        </div>
        <div class="flex w-full justify-center items-center my-3">
          <div class="w-1/4">Title task</div>
          <div class="w-3/4 flex justify-between items-center mr-3">
            <BaseInput placeholder="Enter title task" @update="updateValueTitle" :inputValueProps="textTitle"
              inputClass="w-[500px] mr-10" />
          </div>
        </div>
        <div class="flex w-full justify-center items-center my-3">
          <div class="w-1/4">Description</div>
          <div class="w-3/4 flex justify-between items-center mr-3">
            <Work :contentProp="textDescription" @update="handleUpdateTextEditor" />
          </div>
        </div>
        <div class="flex w-full justify-center items-center my-3">
          <div class="w-1/4">Deadline</div>
          <div class="w-3/4 flex justify-between items-center mr-3">
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
    <div class="btn-primary w-24 h-8 flex items-center justify-center ml-auto rounded-md mt-10 cursor-pointer"
      @click="createNewTask">Create
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue';
import { VueDraggableNext } from "vue-draggable-next";
import BaseInput from '../../components/BaseInput.vue';
import Work from '../../components/Work.vue';
import { DELETE, PENCIL } from '../../constants/img';
import BaseSelect from '../../components/BaseSelect.vue';
import VueMultiselect from 'vue-multiselect'
import { getListStatus } from '../../api/status';
import { getListUsersName } from '../../api/user';
import { createTask } from '../../api/task';

export default defineComponent({
  components: {
    draggable: VueDraggableNext,
    BaseInput, Work, BaseSelect, VueMultiselect
  },
  created() {
    this.DELETE = DELETE;
    this.PENCIL = PENCIL;
    this.getListStatusesFromApi();
  },
  data() {
    return {
      isEditName: false,
      isEditEmail: false,
      isEditTitle: false,
      isEditDescription: false,
      isEditDeadline: false,
      listSelects: [],
      listStatus: [],
      listProcess: [],
      chooseYearInput: null,
      textName: { id: 0, text: "Select options" },
      textEmail: null,
      textTitle: null,
      textDescription: null,
      textDeadline: null,
      textFilter: null,
      multiFollowers: [],
      listFollowers: []
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
    async createNewTask() {
      try {
        const param = {
          user_id: this.textName.id,
          title: this.textTitle,
          description: this.textDescription,
          deadline: this.textDeadline,
          followers: [{ "id": 1 }, { "id": 2 }],
          statuses: [{ "id": 1 }, { "id": 3 }],
        }
        const res = await createTask(param);
        console.log(res.data)
      }
      catch (err) {
        console.error("Error create:", error);

      }
    },

    /**
     * get list user name
     */
    async getListUserNameFromApi() {
      try {
        const res = await getListUsersName();
        this.listFollowers = res.data;
        this.listSelects = res.data.map(item => ({
          id: item.id,
          text: item.name,
        }));
        this.listSelects.unshift({ id: 0, text: "Select options" })
      } catch (error) {
        console.error("Error fetching list users:", error);
      }
    },

    /**
     * get list status
     */
    async getListStatusesFromApi() {
      try {
        const params = {
          keyword: "",
          process: 0,
        };
        const res = await getListStatus(params);
        res.data.forEach(item => {
          this.listStatus.push({
            id: item?.id,
            name: item?.name,
          });
        });
        // get list user name
        await this.getListUserNameFromApi();
      } catch (error) {
        console.error("Error fetching list statuses:", error);
      }
    },

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
     * update new value of textEmail
     * @param newVal 
     */
    updateValueEmail(newVal) {
      this.textEmail = newVal;
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
})
</script>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>