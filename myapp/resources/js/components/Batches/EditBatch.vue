<template>
  <div class="edit-student-page">
    <h2 class="page-title">Edit Batch</h2>

    <form v-if="batch" @submit.prevent="updateBatch" class="student-form">
      <!-- Name -->
      <div class="form-group">
        <label for="name">Batch Name</label>
        <input
          type="text"
          id="name"
          v-model="batch.name"
          placeholder="Enter batch name"
          required
        />
      </div>

      <!-- Course -->
      <div class="form-group">
        <label for="course">Course</label>
        <input
          type="text"
          id="course"
          v-model="batch.course"
          placeholder="Enter course name"
          required
        />
      </div>

      <!-- Start Date -->
      <div class="form-group">
        <label for="startdate">Start Date</label>
        <input
          type="date"
          id="startdate"
          v-model="batch.startdate"
          required
        />
      </div>

      <!-- Submit button -->
      <button class="submit-btn" type="submit">Update Batch</button>
    </form>

    <!-- Loading / Error Messages -->
    <div v-if="loading">Loading batch data...</div>
    <div v-if="successMessage" class="success">{{ successMessage }}</div>
    <div v-if="errorMessage" class="error">{{ errorMessage }}</div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "EditBatch",
  data() {
    return {
      batch: null,
      loading: false,
      successMessage: "",
      errorMessage: "",
    };
  },
  mounted() {
    this.fetchBatch();
  },
  methods: {
    async fetchBatch() {
      try {
        this.loading = true;
        const batchId = this.$route.params.id; // get batch id from route
        const response = await axios.get(`/batches/${batchId}`);
        this.batch = response.data;
        this.loading = false;
      } catch (error) {
        console.error(error);
        this.errorMessage = "Failed to fetch batch data.";
        this.loading = false;
      }
    },
    async updateBatch() {
      try {
        const batchId = this.$route.params.id;
        const response = await axios.put(`/batches/${batchId}`, this.batch);
        this.successMessage = "Batch updated successfully!";
        this.errorMessage = "";
        console.log("Response:", response.data);
        this.$router.push("/batches");
      } catch (error) {
        console.error(error);
        this.errorMessage = "Failed to update batch. Please try again.";
        this.successMessage = "";
      }
    },
  },
};
</script>

<style scoped>

</style>
