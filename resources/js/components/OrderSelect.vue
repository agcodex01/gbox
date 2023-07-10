<template>
  <div class="form-group">
    <label for="customer">Order</label>
    <select
      name="order_id"
      id="order"
      class="form-control"
      :class="{ 'is-invalid': hasError }"
      v-model="orderId"
      v-on:change="selectOrder"
      required
    >
      <option value="0" selected disabled>Select a order</option>

      <option
        v-for="(order, index) in orders"
        :value="index"
        :key="index"
      >
        {{ order }}
      </option>
    </select>
    <span v-if="hasError" class="invalid-feedback" role="alert">
      <strong>{{ errors }}</strong>
    </span>
  </div>
</template>
<script>
export default {
  props: ["orders", "selectedOrderId", "errors"],
  data() {
    return {
      orderId: 0,
    };
  },
  mounted() {
    this.orderId = this.selectedOrderId ?? 0;
  },
  methods: {
    selectOrder() {
      this.$eventBus.$emit("order-select", this.orderId);
    },
  },
  computed: {
    hasError() {
      return !!this.errors;
    },
  },
};
</script>
