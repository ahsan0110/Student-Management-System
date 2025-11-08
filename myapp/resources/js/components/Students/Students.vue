<template>
  <div>
    <div>
      <h1>Student Table</h1>
    </div>

    <!-- Table -->
    <div>
      <table border="1" cellpadding="10">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Contact</th>
            <th>Image</th>
            <th>Actions</th>
          </tr>
        </thead>

        <tbody>
          <tr v-for="student in students" :key="student.id">
            <td>{{ student.id }}</td>
            <td>{{ student.name }}</td>
            <td>{{ student.address }}</td>
            <td>{{ student.contact }}</td>
            <td>
              <img v-if="student.image" :src="`http://127.0.0.1:8000/storage/${student.image}`" alt="Student" width="60"
                height="60" style="background-color: black; padding: 10px; border-radius: 5px;" />
              <span v-else>No Image</span>
            </td>
            <td>
              <button class="edit-btn" @click="editStudent(student.id)">
                Update
              </button>
              <button class="delete-btn" @click="deleteStudent(student.id)">
                Delete
              </button>
            </td>
          </tr>
          <tr v-if="students.length === 0">
            <td colspan="5">
              No students found.
            </td>
          </tr>
        </tbody>
      </table>
    </div> <br> <br>

    <button class="submit-btn" @click="$router.push('/students/add')">
      Add Student
    </button>

    <div v-if="successMessage" style="display: inline;margin-left: 20px; color: green;">
      {{ successMessage }}
    </div>
    <div v-if="errorMessage" style="display: inline;margin-left: 20px; color: red;">
      {{ errorMessage }}
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Students",

  data() {
    return {
      students: [],
      successMessage: "",
      errorMessage: "",
    };
  },

  mounted() {
    this.fetchStudents();
  },

  methods: {
    async fetchStudents() {
      try {
        const response = await axios.get("/students");
        this.students = response.data;
      } catch (error) {
        console.error("Error fetching students:", error);
      }
    },

    editStudent(id) {
      this.$router.push(`/students/edit/${id}`);
    },

    async deleteStudent(id) {
      try {
        await axios.delete(`/students/${id}`);
        this.students = this.students.filter((s) => s.id !== id);
        this.successMessage = "Student Deleted successfully!";
        this.errorMessage = "";
      } catch (error) {
        console.error("Error deleting student:", error);
        this.errorMessage = "Failed to Delete student. Please try again.";
        this.successMessage = "";
      }
    },
  },
};
</script>

<style>
/* Add your CSS here */
</style>
