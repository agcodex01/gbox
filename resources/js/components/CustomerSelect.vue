<template>
  <div class="form-group">
    <label for="customer">Customer</label>
    <select
      name="customer_id"
      id="customer"
      class="form-control"
      :class="{ 'is-invalid': hasError }"
      v-model="customerId"
      v-on:change="selectCustomer"
      required
    >
      <option value="0" selected disabled>Select a customer</option>

      <option
        v-for="(customer, index) in customers"
        :value="index"
        :key="index"
      >
        {{ customer }}
      </option>
    </select>
    <span v-if="hasError" class="invalid-feedback" role="alert">
      <strong>{{ errors }}</strong>
    </span>
  </div>
</template>
<script>
export default {
  props: ["customers", "selectedCustomerId", "errors"],
  data() {
    return {
      customerId: 0,
    };
  },
  mounted() {
    this.customerId = this.selectedCustomerId ?? 0;
    console.log(this.errors);
  },
  methods: {
    selectCustomer() {
      this.$eventBus.$emit("customer-select", this.customerId);
    },
  },
  computed: {
    hasError() {
      return !!this.errors;
    },
  },
};
</script>
