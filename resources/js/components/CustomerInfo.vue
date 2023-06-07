<template>
  <div class="card">
    <div class="card-header bg-primary text-white font-weight-bold">Customer Info</div>
    <div class="card-body p-0">
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <strong class="text-muted">Name: </strong>
          <em>{{ customer.name || "-" }}</em>
        </li>
        <li class="list-group-item">
          <strong class="text-muted">Tel: </strong>
          <em> {{ customer.phone || "-" }} </em>
        </li>
        <li class="list-group-item">
          <strong class="text-muted">Email: </strong>
          <em>{{ customer.email || "-" }}</em>
        </li>
        <li class="list-group-item">
          <strong class="text-muted">Address: </strong>
          <em> {{ customer.address || "-" }}</em>
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
export default {
  name: "CustomerInfo",
  props: ["selectedCustomerId"],
  data() {
    return {
      customerId: null,
      customer: {
        name: null,
        phone: null,
        email: null,
        address: null,
      },
    };
  },
  mounted() {
    this.$eventBus.$on("customer-select", (id) => {
      this.customerId = id;
    });
    this.customerId = this.selectedCustomerId;
  },
  watch: {
    customerId: {
      handler: function (id) {
        if (id) {
          axios.get(`/api/customers/${id}`).then((response) => {
            this.customer = response.data.user;
          });
        }
      },
    },
  },
};
</script>
