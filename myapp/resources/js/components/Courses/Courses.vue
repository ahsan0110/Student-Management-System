<template>
  <div>
    <div>
      <h1>Course Table</h1>
    </div>

    <!-- Table -->
    <div>
      <table border="1" cellpadding="10">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Syllabus</th>
            <th>Duration</th>
            <th>Teacher</th>
            <th>Actions</th>
          </tr>
        </thead>

        <tbody>
          <tr v-for="course in courses" :key="course.id">
            <td>{{ course.id }}</td>
            <td>{{ course.name }}</td>
            <td>{{ course.syllabus }}</td>
            <td>{{ course.duration }}</td>
            <td>{{ course.teacher.name }}</td>

            <td>
              <button class="edit-btn" @click="editCourse(course.id)">Update</button>
              <button class="delete-btn" @click="deleteCourse(course.id)">Delete</button>
            </td>
          </tr>
          <tr v-if="courses.length === 0">
            <td colspan="5">No courses found.</td>
          </tr>
        </tbody>
      </table>
    </div> 
    <br><br>

    <button class="submit-btn" @click="$router.push('/courses/add')">
      Add course
    </button>

    <div v-if="successMessage" style="display: inline; margin-left: 20px; color: green;">
      {{ successMessage }}
    </div>
    <div v-if="errorMessage" style="display: inline; margin-left: 20px; color: red;">
      {{ errorMessage }}
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Courses",

  data() {
    return {
      courses: [],
      successMessage: "",
      errorMessage: "",
    };
  },

  mounted() {
    this.fetchCourses();
  },

  methods: {
    async fetchCourses() {
      try {
        const response = await axios.get("/courses");
        this.courses = response.data;
      } catch (error) {
        console.error("Error fetching courses:", error);
      }
    },

    editCourse(id) {
      this.$router.push(`/courses/edit/${id}`);
    },

    async deleteCourse(id) {
      try {
        await axios.delete(`/courses/${id}`);
        this.courses = this.courses.filter((c) => c.id !== id);
        this.successMessage = "Course deleted successfully!";
        this.errorMessage = "";
      } catch (error) {
        console.error("Error deleting course:", error);
        this.errorMessage = "Failed to delete course. Please try again.";
        this.successMessage = "";
      }
    },
  },
};
</script>

<style scoped>
/* Add your own CSS for table and buttons here */
</style>
