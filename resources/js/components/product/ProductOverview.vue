<!--suppress ALL -->
<template>
    <div>
        <b-row class=" justify-content-center">
            <b-col lg="4" xl="4" md="12" cols="12" sm="12">
                <a class="block block-rounded block-bordered block-link-shadow text-center" @click="openCreateModal"
                   data-toggle="click-ripple">
                    <div class="block-content text-muted">
                        <p class="my-1">
                            <i class="text-primary fa fa-plus-circle fa-2x text-muted"></i>
                        </p>
                        <p class="font-w300">Create product</p>
                    </div>
                </a>
            </b-col>
            <b-col lg="4" xl="4" md="12" cols="12" sm="12">
                <a class="block block-rounded block-bordered block-link-shadow text-center" href="javascript:void(0)"
                   data-toggle="click-ripple">
                    <div class="block-content text-muted">
                        <p class="my-1">
                            <i class="text-primary fa fa-user-plus fa-2x text-muted"></i>
                        </p>
                        <p class="font-w300">Pair to customer</p>
                    </div>
                </a>
            </b-col>
        </b-row>
        <b-row>
            <b-col>
                <b-table :items="items"
                         stacked="md"
                         :fields="fields"
                         :current-page="currentPage"
                         :per-page="perPage"
                         responsive
                         selectable
                         :select-mode="selectMode"
                         striped
                         fixed
                >
                    <template v-slot:cell(selected)="{ rowSelected }" style="width:25px;" class="d-sm-none d-none">
                        <template v-if="rowSelected" style="width:25px;">
                            <span aria-hidden="true"><i class="fa fa-check"></i></span>
                            <span class="sr-only">Selected</span>
                        </template>
                        <template v-else style="width:25px;">
                            <span aria-hidden="true">&nbsp;</span>
                            <span class="sr-only">Not selected</span>
                        </template>
                    </template>
                    <template v-slot:cell(actions)="row" class="d-sm-none d-none"
                              :style="{ width: fields.fields === 'actions' ? '25px' : '180px' }">
                        <b-button size="sm" @click="openRemoveProductModal(row.item, row.index, $event.target)"
                                  variant="primary"
                                  class="mr-1">
                            <i class="fa fa-trash-alt"></i>
                        </b-button>
                    </template>
                </b-table>
            </b-col>
        </b-row>
        <b-row align-h="between">
            <b-col sm="6" md="6" class="my-1" align-self="center">
                <b-pagination
                    v-model="currentPage"
                    :total-rows="totalRows"
                    :per-page="perPage"
                    size="sm"
                    class="my-0"
                ></b-pagination>
            </b-col>
            <b-col sm="" md="3" class="my-1">
                <b-row align-h="between">
                    <b-col>
                        <small>Aantal per pagina</small>
                    </b-col>
                    <b-col sm="6" md="6" lg="6" xl="6">
                        <b-form-select
                            label="Aantal per pagina"
                            class="form-control"
                            v-model="perPage"
                            id="perPageSelect"
                            size="sm"
                            :options="pageOptions"
                        ></b-form-select>
                    </b-col>
                </b-row>
            </b-col>
        </b-row>
        <b-modal :id="infoModal.id" :title="infoModal.title" v-model="removeProductModal">
            <div>
                Are you sure you want to delete <i><b>{{ infoModal.product.name }}</b></i>?
            </div>
            <template v-slot:modal-footer>
                <b-button
                    variant="danger"
                    size="sm"
                    class="float-right"
                    @click="closeRemoveProductModal(infoModal)"
                >
                    Cancel
                </b-button>
                <b-button
                    variant="primary"
                    size="sm"
                    class="float-right"
                    @click="removeProduct(infoModal.product,infoModal.index)"
                >
                    Delete
                </b-button>
            </template>

        </b-modal>
        <b-modal title="Create product" v-model="createProductModal" size="lg" modal-cancel>
            <b-form-group
                label-cols="4"
                label-cols-md="12"
                label-cols-lg="2"
                id="product-name"
                label="Product name"
                label-for="product-name"
            >
                <b-form-input id="product-name" v-model="product.name" trim></b-form-input>
                <div class="invalid-feedback">
                    <span v-if="errors.name">{{ errors.name[0] }}</span>
                </div>
            </b-form-group>
            <b-form-group
                label-cols="4"
                label-cols-md="12"
                label-cols-lg="2"
                id="product-desc"
                label="Product description"
                label-for="product-desc"
            >
                <b-textarea id="product-desc" v-model="product.description"
                            trim
                            rows="6"
                            max-rows="6"
                ></b-textarea>
                <div class="invalid-feedback">
                    <span v-if="errors.description">{{ errors.description[0] }}</span>
                </div>
            </b-form-group>
            <template v-slot:modal-footer>
                <b-button
                    variant="danger"
                    size="sm"
                    class="float-right"
                    @click="createProductModal=false"
                >
                    Close
                </b-button>
                <b-button
                    variant="primary"
                    size="sm"
                    class="float-right"
                    @click="saveProduct"
                >
                    Save
                </b-button>
            </template>

        </b-modal>
    </div>
</template>

<script>
export default {
    name: "ProductOverview",
    data() {
        return {
            // Note 'isActive' is left out and will not appear in the rendered table
            selected: [],
            fields: [
                'selected',
                {
                    key: 'id',
                    label: 'ID',
                    sortable: true
                },
                {
                    key: 'name',
                    label: 'Product name',
                    sortable: true,
                },
                {
                    key: 'description',
                    label: 'Product description',
                    sortable: true
                },
                {
                    key: 'actions',
                    label: 'Actions',
                    sortable: false
                }
            ],
            items: [],
            selectMode: 'single',
            totalRows: 2,
            currentPage: 1,
            perPage: 10,
            pageOptions: [10, 15, 25, 50, 75],
            infoModal: {
                id: 'info-modal',
                title: '',
                product: {},
                index:0
            },
            createProductModal: false,
            removeProductModal: false,
            product: {
                name: "",
                description: ""
            },
            errors: []
        };
    },
    computed: {
        sortOptions() {
            // Create an options list from our fields
            return this.fields
                .filter(f => f.sortable)
                .map(f => {
                    return {text: f.label, value: f.key}
                })
        }
    },
    created() {
        this.getProducts();
    },
    mounted() {
        // Set the initial number of items
    },
    methods: {
        getProducts() {
            axios.get('axios/product/get/all')
                .then(response => {
                    this.items = response.data;
                    this.totalRows = this.items.length
                }).catch(error => {

            });
        },
        onRowSelected(items) {
            this.selected = items
        },
        selectAllRows() {
            this.$refs.selectableTable.selectAllRows()
        },
        clearSelected() {
            this.$refs.selectableTable.clearSelected()
        },
        openRemoveProductModal(item, index, button) {
            this.infoModal.title = `Deleting ${item.name} ?`
            this.infoModal.product = item;
            this.infoModal.index = index;
            this.$root.$emit('bv::show::modal', this.infoModal.id, button)
        },
        removeProduct(item) {
            axios.delete(`axios/product/${item.id}`)
                .then(response => {
                    for(let x in this.items){
                        if(this.items[x].id === item.id) {
                            this.items.splice(x,1);
                        }
                    }
                    this.removeProductModal = !this.removeProductModal;
                    this.totalRows = this.items.length
                }).catch(error => {

            });
        },
        openCreateModal() {
            this.createProductModal = !this.createProductModal
        },
        closeRemoveProductModal() {
            this.removeProductModal = !this.removeProductModal;
        },
        onFiltered(filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.totalRows = filteredItems.length
            this.currentPage = 1
        },
        saveProduct() {
            axios.post('axios/product/store', this.product)
                .then(response => {
                    this.items.push(response.data)
                    this.totalRows = this.items.length
                    this.createProductModal = !this.createProductModal
                })
                .catch(error => {
                    console.log(error);
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    }
                });
        }
    }
}
</script>

<style scoped lang="scss">

.invalid-feedback {
    display: block;
    font-size: 90%;
}

table.b-table[aria-busy='true'] {
    opacity: 0.6;
}
</style>
