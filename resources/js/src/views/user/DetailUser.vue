<template>
    <div class="border flex p-4 min-h-screen bg-white rounded-xl">
        <div class="w-full flex flex-col">
            <div class="flex w-full h-14 justify-center items-center">
                <div class="w-1/4">Process</div>
                <div class="w-2/4">
                    <draggable
                        :list="listProcess"
                        itemKey="name"
                        group="myGroup"
                        class="flex h-10 flex-wrap gap-3"
                    >
                        <div
                            class="border w-20 cursor-pointer h-8 flex items-center justify-center rounded-md relative"
                            :class="[generateClass(element.id)]"
                            v-for="element in listProcess"
                            :key="element.name"
                        >
                            {{ element.name }}
                            <img
                                :src="DELETE"
                                alt=""
                                srcset=""
                                class="w-5 h-5 absolute border rounded-full"
                                style="top: -10px; right: -10px"
                                @click="handleDelete(element)"
                            />
                        </div>
                    </draggable>
                </div>
                <div class="w-1/4"></div>
            </div>
            <div class="flex w-full h-14 justify-center items-center">
                <div class="w-1/4">Avatar</div>
                <div class="w-3/4">
                    <img
                        :src="AVATAR"
                        alt=""
                        srcset=""
                        class="h-10 min-w-[40px]"
                    />
                </div>
            </div>
            <div class="flex w-full h-14 justify-center items-center">
                <div class="w-1/4">Name</div>
                <div class="w-3/4">Chi Bao</div>
            </div>
            <div class="flex w-full h-14 justify-center items-center">
                <div class="w-1/4">Email</div>
                <div class="w-3/4">nguyenhuynhchibao@gmail.com</div>
            </div>
            <div class="flex w-full h-14 justify-center items-center">
                <div class="w-1/4">Title task</div>
                <div class="w-3/4">Write document in Javascript</div>
            </div>
            <div class="flex w-full h-14 justify-center items-center">
                <div class="w-1/4">Description</div>
                <div class="w-3/4">Write document in Javascript</div>
            </div>
        </div>
        <div class="">
            <draggable
                :list="listStatus"
                itemKey="name"
                group="myGroup"
                class="flex flex-col min-h-[60px] min-w-[60px] border px-2 justify-center items-center"
            >
                <div
                    class="border w-20 cursor-pointer h-8 my-2 flex items-center justify-center rounded-md"
                    :class="[generateClass(element.id)]"
                    v-for="element in listStatus"
                    :key="element.name"
                >
                    {{ element.name }}
                </div>
                <template v-if="listStatus.length === 0">
                    <div class="text-center py-2 text-gray-500">No process</div>
                </template>
            </draggable>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import { VueDraggableNext } from "vue-draggable-next";
import { AVATAR, DELETE } from "../../constants/img";

export default defineComponent({
    components: {
        draggable: VueDraggableNext,
    },
    created() {
        this.DELETE = DELETE;
        this.AVATAR = AVATAR;
    },
    data() {
        return {
            listStatus: [
                { id: 1, name: "Not Start" },
                { id: 2, name: "In Process" },
                { id: 3, name: "Pending" },
                { id: 4, name: "Done" },
            ],
            listProcess: [],
        };
    },
    methods: {
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
            this.listStatus.push(data);
        },
    },
});
</script>

<style lang="css" scoped></style>
