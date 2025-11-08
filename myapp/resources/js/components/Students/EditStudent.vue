<template>
  <div class="edit-student-page">
    <h2 class="page-title">Edit Student</h2>

    <form v-if="student" @submit.prevent="updateStudent" class="student-form">
      <!-- Name -->
      <div class="form-group">
        <label for="name">Name</label>
        <input
          type="text"
          id="name"
          v-model="student.name"
          placeholder="Enter student name"
          required
        />
      </div>

      <!-- Address -->
      <div class="form-group">
        <label for="address">Address</label>
        <input
          type="text"
          id="address"
          v-model="student.address"
          placeholder="Enter address"
          required
        />
      </div>

      <!-- Contact -->
      <div class="form-group">
        <label for="contact">Contact</label>
        <input
          type="text"
          id="contact"
          v-model="student.contact"
          placeholder="Enter contact number"
          required
        />
      </div>

      <!-- Submit button -->
      <button type="submit">Update Student</button>
    </form>

    <!-- Loading / Error Messages -->
    <div v-if="loading">Loading student data...</div>
    <div v-if="successMessage" class="success">{{ successMessage }}</div>
    <div v-if="errorMessage" class="error">{{ errorMessage }}</div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "EditStudent",
  data() {
    return {
      student: null,
      loading: false,
      successMessage: "",
      errorMessage: "",
    };
  },
  mounted() {
    this.fetchStudent();
  },
  methods: {
    async fetchStudent() {
      try {
        this.loading = true;
        const studentId = this.$route.params.id; // get student id from route
        const response = await axios.get(`/students/${studentId}`);
        this.student = response.data;
        this.loading = false;
      } catch (error) {
        console.error(error);
        this.errorMessage = "Failed to fetch student data.";
        this.loading = false;
      }
    },
    async updateStudent() {
      try {
        const studentId = this.$route.params.id;
        const response = await axios.put(`/students/${studentId}`, this.student);
        this.successMessage = "Student updated successfully!";
        this.errorMessage = "";
        this.$router.push("/students");
        console.log("Response:", response.data);
      } catch (error) {
        console.error(error);
        this.errorMessage = "Failed to update student. Please try again.";
        this.successMessage = "";
      }
    },
  },
};
</script>

<style scoped>

</style>
