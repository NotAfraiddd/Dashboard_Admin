<template>
    <div class="base-table my-2">
        <div :class="`table-responsive ${extendClass}`">
            <table :class="`table ${tableClass}`">
                <thead>
                    <tr>
                        <th
                            v-for="(column, index) in columns"
                            :key="index"
                            :class="column.headerClass"
                        >
                            {{ column.title }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(row, indexRow) in data"
                        :key="indexRow"
                        @click="clickRow(row)"
                    >
                        <td
                            v-for="(column, indexCol) in columns"
                            :key="indexCol"
                            :class="column.columnClass"
                        >
                            <template
                                v-if="column.renderType === RENDER_TYPE.slot"
                            >
                                <slot :name="column.slotName" :record="row" />
                            </template>
                            <template v-else>
                                {{ getCellData(row, column.key) }}
                            </template>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div
                v-if="data.length === 0"
                class="text-center pt-1 pb-3 text-base"
            >
                {{ emptyText }}
            </div>
        </div>
    </div>
</template>

<script setup>
import { toRefs } from "vue";
import { RENDER_TYPE } from "../constants";

const props = defineProps({
    data: { type: Array, default: () => [] },
    columns: { type: Array, default: () => [] },
    tableClass: { type: String, default: "" },
    extendClass: { type: String, default: "" },
    emptyText: { type: String, default: "Data empty" },
    onClickRow: { type: Function, default: () => {} },
});

const { data, columns, tableClass, extendClass, emptyText, onClickRow } =
    toRefs(props);

const getCellData = (rowData, key) => {
    return key.split(".").reduce((acc, cur) => (acc ? acc[cur] : ""), rowData);
};

const clickRow = (record) => {
    onClickRow.value(record);
};
</script>

<style scoped lang="css">
.table td,
.table th {
    vertical-align: middle !important;
}
</style>
