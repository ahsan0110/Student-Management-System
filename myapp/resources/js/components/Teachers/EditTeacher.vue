<template>
  <div class="edit-student-page">
    <h2 class="page-title">Edit Teacher</h2>

    <form v-if="teacher" @submit.prevent="updateTeacher" class="student-form">
      <!-- Name -->
      <div class="form-group">
        <label for="name">Name</label>
        <input
          type="text"
          id="name"
          v-model="teacher.name"
          placeholder="Enter teacher name"
          required
        />
      </div>

      <!-- Address -->
      <div class="form-group">
        <label for="address">Address</label>
        <input
          type="text"
          id="address"
          v-model="teacher.address"
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
          v-model="teacher.contact"
          placeholder="Enter contact number"
          required
        />
      </div>

      <!-- Submit button -->
      <button type="submit">Update Teacher</button>
    </form>

    <!-- Loading / Error Messages -->
    <div v-if="loading">Loading teacher data...</div>
    <div v-if="successMessage" class="success">{{ successMessage }}</div>
    <div v-if="errorMessage" class="error">{{ errorMessage }}</div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "EditTeacher",
  data() {
    return {
      teacher: null,
      loading: false,
      successMessage: "",
      errorMessage: "",
    };
  },
  mounted() {
    this.fetchTeacher();
  },
  methods: {
    async fetchTeacher() {
      try {
        this.loading = true;
        const teacherId = this.$route.params.id; // get teacher id from route
        const response = await axios.get(`/teachers/${teacherId}`);
        this.teacher = response.data;
        this.loading = false;
      } catch (error) {
        console.error(error);
        this.errorMessage = "Failed to fetch teacher data.";
        this.loading = false;
      }
    },
    async updateTeacher() {
      try {
        const teacherId = this.$route.params.id;
        const response = await axios.put(`/teachers/${teacherId}`, this.teacher);
        this.successMessage = "Teacher updated successfully!";
        this.errorMessage = "";
        console.log("Response:", response.data);
        this.$router.push("/teachers");
      } catch (error) {
        console.error(error);
        this.errorMessage = "Failed to update Teacher. Please try again.";
        this.successMessage = "";
      }
    },
  },
};
</script>

<style scoped>

</style>
