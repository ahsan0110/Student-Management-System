<template>
  <div>
    <div>
      <h1>Teacher Table</h1>
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
            <th>Actions</th>
          </tr>
        </thead>

        <tbody>
          <tr v-for="teacher in teachers" :key="teacher.id">
            <td>{{ teacher.id }}</td>
            <td>{{ teacher.name }}</td>
            <td>{{ teacher.address }}</td>
            <td>{{ teacher.contact }}</td>
            <td>
              <button class="edit-btn" @click="editTeacher(teacher.id)">
                Update
              </button>
              <button class="delete-btn" @click="deleteTeacher(teacher.id)">
                Delete
              </button>
            </td>
          </tr>
          <tr v-if="teachers.length === 0">
            <td colspan="5">
              No teachers found.
            </td>
          </tr>
        </tbody>
      </table>
    </div> <br> <br>

    <button class="submit-btn" @click="$router.push('/teachers/add')">
      Add Teacher
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
  name: "Teachers",

  data() {
    return {
      teachers: [],
      successMessage: "",
      errorMessage: "",
    };
  },

  mounted() {
    this.fetchTeachers();
  },

  methods: {
    async fetchTeachers() {
      try {
        const response = await axios.get("/teachers");
        this.teachers = response.data;
      } catch (error) {
        console.error("Error fetching teachers:", error);
      }
    },

    editTeacher(id) {
      this.$router.push(`/teachers/edit/${id}`);
    },

    async deleteTeacher(id) {
      try {
        await axios.delete(`/teachers/${id}`);
        this.teachers = this.teachers.filter((s) => s.id !== id);
        this.successMessage = "Teacher deleted successfully!";
        this.errorMessage = "";
      } catch (error) {
        console.error("Error deleting teacher:", error);
        this.errorMessage = "Failed to delete teacher. Please try again.";
        this.successMessage = "";
      }
    },
  },
};
</script>

<style scoped>
/* Add your CSS here */
</style>
