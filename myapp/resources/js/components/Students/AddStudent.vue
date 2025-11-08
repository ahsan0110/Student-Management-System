<template>
  <div class="add-student-page">
    <h2 class="page-title">Add Student</h2>

    <form @submit.prevent="submitForm" enctype="multipart/form-data" class="student-form">
      <!-- Name -->
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" v-model="form.name" placeholder="Enter student name" required />
      </div>

      <!-- Address -->
      <div class="form-group">
        <label for="address">Address</label>
        <input type="text" id="address" v-model="form.address" placeholder="Enter address" required />
      </div>

      <!-- Contact -->
      <div class="form-group">
        <label for="contact">Contact</label>
        <input type="text" id="contact" v-model="form.contact" placeholder="Enter contact number" required />
      </div>

      <!-- Image -->
      <div class="form-group">
        <label for="image">Image</label>
        <input type="file" id="image" @change="handleFileUpload" />
      </div>

      <!-- Submit button -->
      <button class="submit-btn" type="submit">Add Student</button>
    </form>

    <!-- Success / Error Messages -->
    <div v-if="successMessage" class="success">{{ successMessage }}</div>
    <div v-if="errorMessage" class="error">{{ errorMessage }}</div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "AddStudent",
  data() {
    return {
      form: {
        name: "",
        address: "",
        contact: "",
        image: null, // store the selected image
      },
      successMessage: "",
      errorMessage: "",
    };
  },
  methods: {
    handleFileUpload(event) {
      this.form.image = event.target.files[0]; // save selected file
    },

    async submitForm() {
      try {
        // Create FormData object
        const formData = new FormData();
        formData.append("name", this.form.name);
        formData.append("address", this.form.address);
        formData.append("contact", this.form.contact);

        if (this.form.image) {
          formData.append("image", this.form.image);
        }

        // Send POST request to Laravel backend
        const response = await axios.post("http://127.0.0.1:8000/students", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        });

        this.successMessage = "Student added successfully!";
        this.errorMessage = "";
        this.form.name = "";
        this.form.address = "";
        this.form.contact = "";
        this.form.image = null;

        this.$router.push("/students"); // redirect to student list
        console.log("Response:", response.data);
      } catch (error) {
        this.errorMessage = "Failed to add student. Please try again.";
        this.successMessage = "";
        console.error(error);
      }
    },
  },
};
</script>

<style scoped>
.add-student-page {
  max-width: 500px;
  margin: auto;
  padding: 20px;
}

.form-group {
  margin-bottom: 15px;
}

input[type="text"],
input[type="email"],
input[type="file"] {
  width: 100%;
  padding: 8px;
  box-sizing: border-box;
}

.submit-btn {
  padding: 10px 20px;
  background-color: #3490dc;
  color: white;
  border: none;
  cursor: pointer;
}

.success {
  color: green;
  margin-top: 10px;
}

.error {
  color: red;
  margin-top: 10px;
}
</style>
