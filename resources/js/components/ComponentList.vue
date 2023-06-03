<template>
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h6 class="font-weight-bold m-0">Components</h6>
      <button type="button" @click="addRow" class="btn btn-sm btn-primary">
        Add +
      </button>
    </div>
    <div class="card-body">
      <div class="row mb-2" v-for="(item, index) in items" :key="index">
        <div class="col-md-6">
          <div class="form-group">
            <select
              id="board"
              class="form-control"
              :name="`items[${index}][id]`"
              v-model="items[index].id"
              @change="selectComponent"
            >
              <option value="0" selected>Select a component</option>
              <option
                v-for="(available, id) in item.options"
                :key="id"
                :value="id"
              >
                {{ available }}
              </option>
            </select>

            <!-- <span class="invalid-feedback" role="alert"> -->
              <!-- <strong>{{ $message }}</strong> -->
            <!-- </span> -->
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group">
            <input
              type="number"
              class="form-control"
              id="estimate"
              aria-describedby="estimateHelp"
              :name="`items[${index}][qty]`"
              v-model="items[index].qty"
            />

            <!-- <span class="invalid-feedback" role="alert"> -->
              <!-- <strong>{{ $message }}</strong> -->
            <!-- </span> -->
          </div>
        </div>
        <div class="col-md-1 pt-1">
          <button type="button" class="btn btn-sm" @click="deleteRow(index)">
            <i class="fa text-danger fa-trash"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["components"],
  data() {
    return {
      selectedIds: [],
      items: [],
    };
  },
  mounted() {
    console.log(this.components);
  },
  methods: {
    addRow() {
      this.items.push({
        id: 0,
        qty: 0,
        options: this.availableComponents
      });
    },

    deleteRow(index) {
      this.items.splice(index, 1);
    },
    selectComponent(event) {
      this.selectedIds.push(event.target.value);
    },
  },
  computed: {
    availableComponents() {
      return Object.keys(this.components).reduce((prev, key) => {
        const value = this.components[key];
        if (!this.selectedIds.includes(key)) {
            prev[key] = value;
        }
        return prev;
      }, {});
    },
  },
};
</script>
