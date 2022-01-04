<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        View Reports
      </h2>
    </template>

    <!-- Reports Table -->
    <reports-table
      :categories="categories"
      :showAddCategoryModal="showAddCategoryModal"
      :showEditCategoryModal="showEditCategoryModal"
      :showDeleteCategoryModal="showDeleteCategoryModal"
    />
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import ReportsTable from "@/Components/ReportsTable";
export default {
  props: ["categories", "qtyTypes"],

  components: { AppLayout, ReportsTable },
};
</script>