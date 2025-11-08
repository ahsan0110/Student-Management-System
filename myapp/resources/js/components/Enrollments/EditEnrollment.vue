<template>
  <div class="edit-enrollment-page">
    <h2 class="page-title">Edit Enrollment</h2>

    <form v-if="enrollment" @submit.prevent="updateEnrollment" class="student-form">
      <!-- Enroll No -->
      <div class="form-group">
        <label for="enrollno">Enroll No</label>
        <input
          type="text"
          id="enrollno"
          v-model="enrollment.enrollno"
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
          v-model="enrollment.batch"
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
          v-model="enrollment.studentn"
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
          v-model="enrollment.joindate"
          required
        />
      </div>

      <!-- Fee -->
      <div class="form-group">
        <label for="fee">Fee</label>
        <input
          type="number"
          id="fee"
          v-model="enrollment.fee"
          placeholder="Enter fee amount"
          required
        />
      </div>

      <!-- Submit button -->
      <button type="submit">Update Enrollment</button>
    </form>

    <!-- Loading / Error Messages -->
    <div v-if="loading">Loading enrollment data...</div>
    <div v-if="successMessage" class="success">{{ successMessage }}</div>
    <div v-if="errorMessage" class="error">{{ errorMessage }}</div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "EditEnrollment",
  data() {
    return {
      enrollment: null,
      loading: false,
      successMessage: "",
      errorMessage: "",
    };
  },
  mounted() {
    this.fetchEnrollment();
  },
  methods: {
    async fetchEnrollment() {
      try {
        this.loading = true;
        const enrollmentId = this.$route.params.id; // get enrollment id from route
        const response = await axios.get(`/enrollments/${enrollmentId}`);
        this.enrollment = response.data;
        this.loading = false;
      } catch (error) {
        console.error(error);
        this.errorMessage = "Failed to fetch enrollment data.";
        this.loading = false;
      }
    },
    async updateEnrollment() {
      try {
        const enrollmentId = this.$route.params.id;
        const response = await axios.put(`/enrollments/${enrollmentId}`, this.enrollment);
        this.successMessage = "Enrollment updated successfully!";
        this.errorMessage = "";
        this.$router.push("/enrollments");
        console.log("Response:", response.data);
      } catch (error) {
        console.error(error);
        this.errorMessage = "Failed to update enrollment. Please try again.";
        this.successMessage = "";
      }
    },
  },
};
</script>

<style scoped>

</style>
