<template>
  <div class="add-enrollment-page">
    <h2 class="page-title">Add Enrollment</h2>

    <form @submit.prevent="submitForm" class="student-form">
      <!-- Enroll No -->
      <div class="form-group">
        <label for="enrollno">Enroll No</label>
        <input
          type="text"
          id="enrollno"
          v-model="form.enrollno"
          placeholder="Enter enroll number"
          required
        />
      </div>

      <!-- Batch -->
      <div class="form-group">
        <label for="batch">Batch</label>
        <input
          type="text"
          id="batch"
          v-model="form.batch"
          placeholder="Enter batch name"
          required
        />
      </div>

      <!-- Student Name -->
      <div class="form-group">
        <label for="studentn">Student Name</label>
        <input
          type="text"
          id="studentn"
          v-model="form.studentn"
          placeholder="Enter student name"
          required
        />
      </div>

      <!-- Join Date -->
      <div class="form-group">
        <label for="joindate">Join Date</label>
        <input
          type="date"
          id="joindate"
          v-model="form.joindate"
          required
        />
      </div>

      <!-- Fee -->
      <div class="form-group">
        <label for="fee">Fee</label>
        <input
          type="number"
          id="fee"
          v-model="form.fee"
          placeholder="Enter fee amount"
          required
        />
      </div>

      <!-- Submit button -->
      <button type="submit">Add Enrollment</button>
    </form>

    <!-- Success / Error Messages -->
    <div v-if="successMessage" class="success">{{ successMessage }}</div>
    <div v-if="errorMessage" class="error">{{ errorMessage }}</div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "AddEnrollment",
  data() {
    return {
      form: {
        enrollno: "",
        batch: "",
        studentn: "",
        joindate: "",
        fee: "",
      },
      successMessage: "",
      errorMessage: "",
    };
  },
  methods: {
    async submitForm() {
      try {
        const response = await axios.post("/enrollments", this.form);
        this.successMessage = "Enrollment added successfully!";
        this.errorMessage = "";
        // reset form fields
        this.form.enrollno = "";
        this.form.batch = "";
        this.form.studentn = "";
        this.form.joindate = "";
        this.form.fee = "";
        this.$router.push("/enrollments");
        console.log("Response:", response.data);
      } catch (error) {
        this.errorMessage = "Failed to add enrollment. Please try again.";
        this.successMessage = "";
        console.error(error);
      }
    },
  },
};
</script>

<style scoped>



</style>
