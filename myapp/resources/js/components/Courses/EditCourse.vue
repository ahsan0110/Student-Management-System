<template>
  <div class="edit-student-page">
    <h2 class="page-title">Edit Course</h2>

    <form v-if="course" @submit.prevent="updateCourse" class="student-form">
      <!-- Course Name -->
      <div class="form-group">
        <label for="name">Course Name</label>
        <input
          type="text"
          id="name"
          v-model="course.name"
          placeholder="Enter course name"
          required
        />
      </div>

      <!-- Syllabus -->
      <div class="form-group">
        <label for="syllabus">Syllabus</label>
        <input
          type="text"
          id="syllabus"
          v-model="course.syllabus"
          placeholder="Enter syllabus details"
          required
        />
      </div>

      <!-- Duration -->
      <div class="form-group">
        <label for="duration">Duration</label>
        <input
          type="text"
          id="duration"
          v-model="course.duration"
          placeholder="Enter course duration"
          required
        />
      </div>

      <!-- Teacher Dropdown -->
      <div class="form-group">
        <label for="teacher">Teacher</label>
        <select id="teacher" v-model="course.teacher_id" required>
          <option value="" disabled>Select a teacher</option>
          <option
            v-for="teacher in teachers"
            :key="teacher.id"
            :value="teacher.id"
          >
            {{ teacher.name }}
          </option>
        </select>
      </div>

      <!-- Submit button -->
      <button type="submit">Update Course</button>
    </form>

    <!-- Loading / Error Messages -->
    <div v-if="loading">Loading course data...</div>
    <div v-if="successMessage" class="success">{{ successMessage }}</div>
    <div v-if="errorMessage" class="error">{{ errorMessage }}</div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "EditCourse",
  data() {
    return {
      course: null,
      teachers: [], // Array to hold all teachers
      loading: false,
      successMessage: "",
      errorMessage: "",
    };
  },
  mounted() {
    this.fetchCourse();
    this.fetchTeachers();
  },
  methods: {
    async fetchCourse() {
      try {
        this.loading = true;
        const courseId = this.$route.params.id;
        const response = await axios.get(`/courses/${courseId}`);
        this.course = response.data;
        
        this.loading = false;
      } catch (error) {
        console.error(error);
        this.errorMessage = "Failed to fetch course data.";
        this.loading = false;
      }
    },
    async fetchTeachers() {
      try {
        const response = await axios.get("/teachers"); // Make sure your backend route exists
        this.teachers = response.data;
      } catch (error) {
        console.error(error);
        this.errorMessage = "Failed to fetch teachers.";
      }
    },
    async updateCourse() {
      try {
        const courseId = this.$route.params.id;
        await axios.put(`/courses/${courseId}`, this.course);
        this.successMessage = "Course updated successfully!";
        this.errorMessage = "";
        this.$router.push("/courses");
      } catch (error) {
        console.error(error);
        this.errorMessage = "Failed to update course. Please try again.";
        this.successMessage = "";
      }
    },
  },
};
</script>

<style scoped>
/* You can add styles for your form and select dropdown here */
</style>
