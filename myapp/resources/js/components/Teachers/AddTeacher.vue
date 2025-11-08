<template>
  <div class="add-student-page">
    <h2 class="page-title">Add Teacher</h2>

    <form @submit.prevent="submitForm" class="student-form">
      <!-- Name -->
      <div class="form-group">
        <label for="name">Name</label>
        <input
          type="text"
          id="name"
          v-model="form.name"
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
          v-model="form.address"
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
          v-model="form.contact"
          placeholder="Enter contact number"
          required
        />
      </div>

      <!-- Submit button -->
      <button type="submit" >Add Teacher</button>
    </form>

    <!-- Success / Error Messages -->
    <div v-if="successMessage" class="success">{{ successMessage }}</div>
    <div v-if="errorMessage" class="error">{{ errorMessage }}</div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "AddTeacher",
  data() {
    return {
      form: {
        name: "",
        address: "",
        contact: "",
      },
      successMessage: "",
      errorMessage: "",
    };
  },
  methods: {
    async submitForm() {
      try {
        // Send POST request to Laravel backend
        const response = await axios.post("/teachers", this.form);
        this.successMessage = "Teacher added successfully!";
        this.errorMessage = "";
        this.form.name = "";
        this.form.address = "";
        this.form.contact = "";
        this.$router.push("/teachers");
        console.log("Response:", response.data);
      } catch (error) {
        this.errorMessage = "Failed to add teacher. Please try again.";
        this.successMessage = "";
        console.error(error);
      }
    },
  },
};
</script>

<style scoped>

</style>
