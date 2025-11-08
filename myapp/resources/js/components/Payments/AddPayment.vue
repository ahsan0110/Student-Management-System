<template>
  <div class="add-student-page">
    <h2 class="page-title">Add Payment</h2>

    <form @submit.prevent="submitForm" class="student-form">
      <!-- Enrollment No -->
      <div class="form-group">
        <label for="enrollmentno">Enrollment No</label>
        <input
          type="text"
          id="enrollno"
          v-model="form.enrollno"
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
          v-model="form.paiddate"
          required
        />
      </div>

      <!-- Amount -->
      <div class="form-group">
        <label for="amount">Amount</label>
        <input
          type="number"
          id="amount"
          v-model="form.amount"
          placeholder="Enter amount"
          required
        />
      </div>

      <!-- Submit button -->
      <button type="submit">Add Payment</button>
    </form>

    <!-- Success / Error Messages -->
    <div v-if="successMessage" class="success">{{ successMessage }}</div>
    <div v-if="errorMessage" class="error">{{ errorMessage }}</div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "AddPayment",
  data() {
    return {
      form: {
        enrollno: "",
        paiddate: "",
        amount: "",
      },
      successMessage: "",
      errorMessage: "",
    };
  },
  methods: {
    async submitForm() {
      try {
        // Send POST request to Laravel backend
        const response = await axios.post("/payments", this.form);
        this.successMessage = "Payment added successfully!";
        this.errorMessage = "";
        this.form.enrollmentno = "";
        this.form.paiddate = "";
        this.form.amount = "";
        this.$router.push("/payments");
        console.log("Response:", response.data);
      } catch (error) {
        this.errorMessage = "Failed to add payment. Please try again.";
        this.successMessage = "";
        console.error(error);
      }
    },
  },
};
</script>

<style scoped>

</style>
