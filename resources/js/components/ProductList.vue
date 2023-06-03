<template>
  <div class="card">
    <div
      class="card-header d-flex justify-content-between align-items-end mb-3"
    >
      List Items
      <button
        type="button"
        @click="addItem"
        class="btn btn-sm btn-outline-primary"
        v-if="customerId"
      >
        Add Item
      </button>
    </div>
    <div class="card-body">
      <div v-if="!customerId" class="text-center py-5">
        <img
          src="/img/select.svg"
          alt="select_img"
          class="d-block mx-auto"
          width="100"
          height="100"
        />
        <h6 class="h6">
          <strong>Please select a customer to add items.</strong>
        </h6>
      </div>
      <div v-else>
        <table class="table">
          <thead>
            <th>Product</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Sub Total</th>
            <th v-if="!viewOnly">Action</th>
          </thead>
          <tbody>
            <tr v-for="(item, index) in items" :key="index">
              <td>
                <div v-if="orderId">
                  {{ item.name }}
                </div>
                <div v-else class="form-group">
                  <select
                    v-model="items[index].id"
                    @change="selectProduct($event, index)"
                    class="form-control"
                    :name="`items[${index}][id]`"
                  >
                    <option value="null" disabled>Select Product</option>
                    <option
                      v-for="(product, i) in products"
                      :key="i"
                      :value="product.id"
                    >
                      {{ product.name }}
                    </option>
                  </select>
                </div>
              </td>
              <td>
                <div v-if="orderId">
                  {{ item.qty }}
                </div>
                <div v-else class="form-group">
                  <input
                    v-model="items[index].qty"
                    type="number"
                    class="form-control"
                    :name="`items[${index}][qty]`"
                  />
                </div>
              </td>
              <td>{{ item.price }}</td>
              <td>{{ item.subTotal }}</td>
              <td v-if="!viewOnly">
                <button
                  type="button"
                  @click="removeRow(index)"
                  class="btn btn-sm"
                >
                  <i class="fa text-danger fa-trash"></i>
                </button>
              </td>
            </tr>
            <tr>
              <td :colspan="viewOnly ? 3 : 4" class="text-right">Total:</td>
              <td>{{ total }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["selectedCustomerId", "selectedItems", "viewOnly", "orderId"],
  data() {
    return {
      customerId: null,
      items: [],
      products: [],
    };
  },
  methods: {
    addItem() {
      this.items.push({
        id: null,
        qty: 0,
        price: 0,
        subTotal: 0,
      });
    },
    removeRow(index) {
      this.items.splice(index, 1);
    },

    selectProduct(event, index) {
      const selectedId = event.target.value;
      const product = this.products.find((p) => p.id == selectedId);
      this.items[index].price = product.price;
    },
  },
  mounted() {
    this.$eventBus.$on("customer-select", (id) => {
      if (id) {
        this.customerId = id;
      }
    });
    this.customerId = this.selectedCustomerId;
    this.items = this.selectedItems || [];
    if (this.orderId) {
      axios.get(`/api/orders/${this.orderId}/items`).then((response) => {
        this.items = response.data;
      });
    }
  },
  computed: {
    total() {
      return this.items.reduce((prev, cur) => prev + cur.subTotal, 0);
    },
  },
  watch: {
    items: {
      handler: function (newVal) {
        newVal.forEach((product) => {
          product.subTotal = product.price * product.qty;
        });
      },
      deep: true,
    },
    customerId: {
      handler: function (newVal) {
        if (newVal) {
          axios
            .get("/api/products", {
              params: {
                customerId: newVal,
              },
            })
            .then((response) => {
              this.products = response.data;
            });
        }
      },
    },
  },
};
</script>
