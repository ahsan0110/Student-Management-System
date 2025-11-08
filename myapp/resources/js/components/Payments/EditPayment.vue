<template>
  <div class="edit-student-page">
    <h2 class="page-title">Edit Payment</h2>

    <form v-if="payment" @submit.prevent="updatePayment" class="student-form">
      <!-- Enrollment No -->
      <div class="form-group">
        <label for="enrollno">Enrollment No</label>
        <input
          type="text"
          id="enrollno"
          v-model="payment.enrollno"
          placeholder="Enter enrollment number"
          required
        />
      </div>

      <!-- Paid Date -->
      <div class="form-group">
        <label for="paiddate">Paid Date</label>
        <input
          type="date"
          id="paiddate"
          v-model="payment.paiddate"
          required
        />
      </div>

      <!-- Amount -->
      <div class="form-group">
        <label for="amount">Amount</label>
        <input
          type="number"
          id="amount"
          v-model="payment.amount"
          placeholder="Enter amount"
          required
        />
      </div>

      <!-- Submit button -->
      <button type="submit">Update Payment</button>
    </form>

    <!-- Loading / Error Messages -->
    <div v-if="loading">Loading payment data...</div>
    <div v-if="successMessage" class="success">{{ successMessage }}</div>
    <div v-if="errorMessage" class="error">{{ errorMessage }}</div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "EditPayment",
  data() {
    return {
      payment: null,
      loading: false,
      successMessage: "",
      errorMessage: "",
    };
  },
  mounted() {
    this.fetchPayment();
  },
  methods: {
    async fetchPayment() {
      try {
        this.loading = true;
        const paymentId = this.$route.params.id; // get payment id from route
        const response = await axios.get(`/payments/${paymentId}`);
        this.payment = response.data;
        this.loading = false;
      } catch (error) {
        console.error(error);
        this.errorMessage = "Failed to fetch payment data.";
        this.loading = false;
      }
    },
    async updatePayment() {
      try {
        const paymentId = this.$route.params.id;
        const response = await axios.put(`/payments/${paymentId}`, this.payment);
        this.successMessage = "Payment updated successfully!";
        this.errorMessage = "";
        this.$router.push("/payments");
        console.log("Response:", response.data);
      } catch (error) {
        console.error(error);
        this.errorMessage = "Failed to update payment. Please try again.";
        this.successMessage = "";
      }
    },
  },
};
</script>

<style scoped>

</style>
