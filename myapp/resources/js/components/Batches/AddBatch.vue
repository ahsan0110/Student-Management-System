<template>
  <div class="add-student-page">
    <h2 class="page-title">Add Batch</h2>

    <form @submit.prevent="submitForm" class="student-form">
      <!-- Name -->
      <div class="form-group">
        <label for="name">Batch Name</label>
        <input
          type="text"
          id="name"
          v-model="form.name"
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
          v-model="form.course"
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
          v-model="form.startdate"
          required
        />
      </div>

      <!-- Submit button -->
      <button class="submit-btn" type="submit">Add Batch</button>
    </form>

    <!-- Success / Error Messages -->
    <div v-if="successMessage" class="success">{{ successMessage }}</div>
    <div v-if="errorMessage" class="error">{{ errorMessage }}</div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "AddBatch",
  data() {
    return {
      form: {
        name: "",
        course: "",
        startdate: "",
      },
      successMessage: "",
      errorMessage: "",
    };
  },
  methods: {
    async submitForm() {
      try {
        const response = await axios.post("/batches", this.form);
        this.successMessage = "Batch added successfully!";
        this.errorMessage = "";
        this.form.name = "";
        this.form.course = "";
        this.form.startdate = "";
        this.$router.push("/batches");
        console.log("Response:", response.data);
      } catch (error) {
        this.errorMessage = "Failed to add batch. Please try again.";
        this.successMessage = "";
        console.error(error);
      }
    },
  },
};
</script>

<style scoped>

</style>
