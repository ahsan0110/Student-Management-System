<template>
  <div >
    <div >
      <h1 >Batch Table</h1>
    </div>

    <!-- Table -->
    <div >
      <table  border="1" cellpadding="10">
        <thead >
          <tr>
            <th >ID</th>
            <th >Name</th>
            <th >Course</th>
            <th >Start Date</th>
            <th >Actions</th>
          </tr>
        </thead>

        <tbody>
          <tr
            v-for="batch in batches"
            :key="batch.id"
            
          >
            <td >{{ batch.id }}</td>
            <td >{{ batch.name }}</td>
            <td >{{ batch.course }}</td>
            <td >{{ batch.startdate }}</td>
            <td >
              <button class="edit-btn"
                
                @click="editBatch(batch.id)"
              >
                Update
              </button>
              <button class="delete-btn"
                
                @click="deleteBatch(batch.id)"
              >
                Delete
              </button>
            </td>
          </tr>
          <tr v-if="batches.length === 0">
            <td colspan="5" >
              No batches found.
            </td>
          </tr>
        </tbody>
      </table>
    </div> 
    <br><br>

    <button 
      class="add-btn submit-btn"
      @click="$router.push('/batches/add')"
    >
      Add Batch
    </button>

    <div v-if="successMessage" class="success" style="display: inline; margin-left: 20px; color: green;">
      {{ successMessage }}
    </div>
    <div v-if="errorMessage" class="error" style="display: inline; margin-left: 20px; color: red;">
      {{ errorMessage }}
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Batches",

  data() {
    return {
      batches: [],
      successMessage: "",
      errorMessage: "",
    };
  },

  mounted() {
    this.fetchBatches();
  },

  methods: {
    async fetchBatches() {
      try {
        const response = await axios.get("/batches");
        this.batches = response.data;
      } catch (error) {
        console.error("Error fetching batches:", error);
      }
    },

    editBatch(id) {
      this.$router.push(`/batches/edit/${id}`);
    },

    async deleteBatch(id) {
      try {
        await axios.delete(`/batches/${id}`);
        this.batches = this.batches.filter((b) => b.id !== id);
        this.successMessage = "Batch deleted successfully!";
        this.errorMessage = "";
      } catch (error) {
        console.error("Error deleting batch:", error);
        this.errorMessage = "Failed to delete batch. Please try again.";
        this.successMessage = "";
      }
    },
  },
};
</script>

<style scoped>

</style>
