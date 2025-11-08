<template>
  <div class="add-student-page">
    <h2 class="page-title">Add Course</h2>

    <form @submit.prevent="submitForm" class="student-form">
      <!-- Name -->
      <div class="form-group">
        <label for="name">Course Name</label>
        <input type="text" id="name" v-model="form.name" placeholder="Enter course name" required />
      </div>

      <!-- Syllabus -->
      <div class="form-group">
        <label for="syllabus">Syllabus</label>
        <input type="text" id="syllabus" v-model="form.syllabus" placeholder="Enter course syllabus" required />
      </div>

      <!-- Duration -->
      <div class="form-group">
        <label for="duration">Duration</label>
        <input type="text" id="duration" v-model="form.duration" placeholder="Enter course duration" required />
      </div>


      <!-- Teacher Dropdown -->
      <div class="form-group">
        <label for="teacher">Teacher</label>
        <select id="teacher" v-model="form.teacher_id" required>
          <option value="" disabled>Select a teacher</option>
          <option v-for="teacher in teachers" :key="teacher.id" :value="teacher.id">
            {{ teacher.name }}
          </option>
        </select>
      </div>


      <!-- Submit button -->
      <button class="submit-btn" type="submit">Add Course</button>
    </form>

    <!-- Success / Error Messages -->
    <div v-if="successMessage" class="success">{{ successMessage }}</div>
    <div v-if="errorMessage" class="error">{{ errorMessage }}</div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "AddCourse",
  data() {
    return {
      form: {
        name: "",
        syllabus: "",
        duration: "",
        teacher_id: "",
      },
      successMessage: "",
      errorMessage: "",
      teachers: [],
    };
  },

  mounted() {
    this.fetchTeachers();
  },
  methods: {
    async submitForm() {
      try {
        // Send POST request to Laravel backend
        const response = await axios.post("/courses", this.form);
        this.successMessage = "Course added successfully!";
        this.errorMessage = "";
        this.form.name = "";
        this.form.syllabus = "";
        this.form.duration = "";
        this.$router.push("/courses");
        console.log("Response:", response.data);
      } catch (error) {
        this.errorMessage = "Failed to add course. Please try again.";
        this.successMessage = "";
        console.error(error);
      }
    },

    async fetchTeachers() {
      try {
        const response = await axios.get("/teachers");
        this.teachers = response.data;
      } catch (error) {
        console.error("Error fetching teachers:", error);
      }
    },
  },
};
</script>

<style scoped></style>
