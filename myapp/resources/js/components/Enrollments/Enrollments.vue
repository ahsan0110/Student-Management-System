<template>
  <div>
    <div>
      <h1>Enrollment Table</h1>
    </div>

    <!-- Table -->
    <div>
      <table border="1" cellpadding="10">
        <thead>
          <tr>
            <th>ID</th>
            <th>Enroll No</th>
            <th>Batch</th>
            <th>Student Name</th>
            <th>Join Date</th>
            <th>Fee</th>
            <th>Actions</th>
          </tr>
        </thead>

        <tbody>
          <tr v-for="enrollment in enrollments" :key="enrollment.id">
            <td>{{ enrollment.id }}</td>
            <td>{{ enrollment.enrollno }}</td>
            <td>{{ enrollment.batch }}</td>
            <td>{{ enrollment.studentn }}</td>
            <td>{{ enrollment.joindate }}</td>
            <td>{{ enrollment.fee }}</td>
            <td>
              <button class="edit-btn" @click="editEnrollment(enrollment.id)">Update</button>
              <button class="delete-btn" @click="deleteEnrollment(enrollment.id)">Delete</button>
            </td>
          </tr>
          <tr v-if="enrollments.length === 0">
            <td colspan="7">No enrollments found.</td>
          </tr>
        </tbody>
      </table>
    </div>
    <br><br>

    <button class="submit-btn" @click="$router.push('/enrollments/add')">
      Add Enrollment
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
  name: "Enrollments",

  data() {
    return {
      enrollments: [],
      successMessage: "",
      errorMessage: "",
    };
  },

  mounted() {
    this.fetchEnrollments();
  },

  methods: {
    async fetchEnrollments() {
      try {
        const response = await axios.get("/enrollments");
        this.enrollments = response.data;
      } catch (error) {
        console.error("Error fetching enrollments:", error);
        this.errorMessage = "Failed to load enrollments.";
      }
    },

    editEnrollment(id) {
      this.$router.push(`/enrollments/edit/${id}`);
    },

    async deleteEnrollment(id) {
      try {
        await axios.delete(`/enrollments/${id}`);
        this.enrollments = this.enrollments.filter((e) => e.id !== id);
        this.successMessage = "Enrollment deleted successfully!";
        this.errorMessage = "";
      } catch (error) {
        console.error("Error deleting enrollment:", error);
        this.errorMessage = "Failed to delete enrollment. Please try again.";
        this.successMessage = "";
      }
    },
  },
};
</script>

<style scoped>

</style>
