<template>
  <div class="card">
    <div class="card-header">Customer Info</div>
    <div class="card-body">
      <h6>
        <strong>Name: </strong> <em>{{ customer.name || "-" }}</em>
      </h6>
      <h6>
        <strong>Tel: </strong> <em> {{ customer.phone || "-" }} </em>
      </h6>
      <h6>
        <strong>Email: </strong> <em>{{ customer.email || "-" }}</em>
      </h6>
      <h6>
        <strong>Address: </strong> <em> {{ customer.address || "-" }}</em>
      </h6>
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
