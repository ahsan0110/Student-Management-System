<template>
  <div>
    <div>
      <h1>Payment Table</h1>
    </div>

    <!-- Table -->
    <div>
      <table border="1" cellpadding="10">
        <thead>
          <tr>
            <th>ID</th>
            <th>Enrollment No</th>
            <th>Paid Date</th>
            <th>Amount</th>
            <th>Actions</th>
          </tr>
        </thead>

        <tbody>
          <tr v-for="payment in payments" :key="payment.id">
            <td>{{ payment.id }}</td>
            <td>{{ payment.enrollno }}</td>
            <td>{{ payment.paiddate }}</td>
            <td>{{ payment.amount }}</td>
            <td>
              <button class="edit-btn" @click="editPayment(payment.id)">Update</button>
              <button class="delete-btn" @click="deletePayment(payment.id)">Delete</button>
            </td>
          </tr>
          <tr v-if="payments.length === 0">
            <td colspan="5">No payments found.</td>
          </tr>
        </tbody>
      </table>
    </div> 
    <br><br>

    <button class="submit-btn" @click="$router.push('/payments/add')">
      Add Payment
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
  name: "Payments",

  data() {
    return {
      payments: [],
      successMessage: "",
      errorMessage: "",
    };
  },

  mounted() {
    this.fetchPayments();
  },

  methods: {
    async fetchPayments() {
      try {
        const response = await axios.get("/payments");
        this.payments = response.data;
      } catch (error) {
        console.error("Error fetching payments:", error);
        this.errorMessage = "Failed to load payments.";
      }
    },

    editPayment(id) {
      this.$router.push(`/payments/edit/${id}`);
    },

    async deletePayment(id) {
      try {
        await axios.delete(`/payments/${id}`);
        this.payments = this.payments.filter((p) => p.id !== id);
        this.successMessage = "Payment deleted successfully!";
        this.errorMessage = "";
      } catch (error) {
        console.error("Error deleting payment:", error);
        this.errorMessage = "Failed to delete payment. Please try again.";
        this.successMessage = "";
      }
    },
  },
};
</script>

<style scoped>
/* Add your own CSS for table and buttons here */
</style>
