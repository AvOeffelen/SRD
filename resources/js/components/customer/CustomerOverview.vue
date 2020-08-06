<template>
    <div>
        <b-row class=" justify-content-center">
            <b-col lg="4" xl="4" md="12" cols="12" sm="12">
                <a class="block block-rounded block-bordered block-link-shadow text-center" @click="openCreateModal"
                   data-toggle="click-ripple">
                    <div class="block-content text-muted">
                        <p class="my-1">
                            <i class="text-primary fa fa-user-plus fa-2x text-muted"></i>
                        </p>
                        <p class="font-w300">Invite customer</p>
                    </div>
                </a>
            </b-col>
            <b-col lg="4" xl="4" md="12" cols="12" sm="12">
                <a class="block block-rounded block-bordered block-link-shadow text-center" href="javascript:void(0)"
                   data-toggle="click-ripple">
                    <div class="block-content text-muted">
                        <p class="my-1">
                            <i class="text-primary fa fa-parking fa-2x text-muted"></i>
                        </p>
                        <p class="font-w300">Pair customer with product</p>
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
        <b-modal v-model="customerCreateModal" size="xl">
            <h5 class="content-heading">Customer</h5>
            <b-form-group
                label-cols="4"
                label-cols-md="12"
                label-cols-lg="2"
                id="customer-name"
                label="Name"
                label-for="product-name"
            >
                <b-form-input id="product-name" v-model="customer.name" trim></b-form-input>
                <div class="invalid-feedback">
                    <span v-if="errors.name">{{ errors.name[0] }}</span>
                </div>
            </b-form-group>
            <b-form-group
                label-cols="4"
                label-cols-md="12"
                label-cols-lg="2"
                id="customer-lastname"
                label="Lastname"
                label-for="customer-lastname"
            >
                <b-form-input id="customer-lastname" v-model="customer.lastname" trim></b-form-input>
                <div class="invalid-feedback">
                    <span v-if="errors.lastname">{{ errors.lastname[0] }}</span>
                </div>
            </b-form-group>
            <b-form-group
                label-cols="4"
                label-cols-md="12"
                label-cols-lg="2"
                id="customer-email"
                label="E-mail"
                label-for="customer-email"
            >
                <b-form-input id="customer-lastname" v-model="customer.email" trim></b-form-input>
                <div class="invalid-feedback">
                    <span v-if="errors.email">{{ errors.email[0] }}</span>
                </div>
            </b-form-group>
            <h5 class="content-heading">Support package</h5>
            <b-form-group
                label-cols="4"
                label-cols-md="12"
                label-cols-lg="2"
                id="supportPackageSelect"
                label="Support package"
                label-for="supportPackageSelect"
            >
                <b-form-select
                    class="form-control"
                    v-model="customer.support.supportPackage"
                    id="supportPackageSelect"
                    size="sm"
                    :options="supportPackage"
                ></b-form-select>

            </b-form-group>
            <b-form-group
                label-cols="4"
                label-cols-md="12"
                label-cols-lg="2"
                id="supportDurationSelect"
                label="Support Billing"
                label-for="supportPackageSelect"
            >
                <b-form-select
                    class=""
                    v-model="customer.support.duration"
                    id="supportDurationSelect"
                    size="sm"
                    :options="duration"
                ></b-form-select>

            </b-form-group>
            <b-form-group
                label-cols="4"
                label-cols-md="12"
                label-cols-lg="2"
                id="startDateSelect"
                label="Support Start"
                label-for="date"
            >
                <flat-pickr
                    v-model="customer.support.startdate"
                    :config="config"
                    class="form-control"
                    placeholder="Select start date"
                    name="date">
                </flat-pickr>
            </b-form-group>
            <b-form-group
                label-cols="4"
                label-cols-md="12"
                label-cols-lg="2"
                id="endDateSelect"
                label="Support End"
                label-for="date"
            >
                <flat-pickr
                    v-model="customer.support.enddate"
                    :config="config"
                    class="form-control"
                    placeholder="Select end date"
                    name="date">
                </flat-pickr>
            </b-form-group>
            <template v-slot:modal-footer>
                <b-button
                    variant="danger"
                    size="sm"
                    class="float-right"
                    @click="customerCreateModal=false"
                >
                    Close
                </b-button>
                <b-button
                    variant="primary"
                    size="sm"
                    class="float-right"
                    @click="saveCustomer"
                >
                    Save
                </b-button>
            </template>
        </b-modal>
    </div>
</template>

<script>


import {Dutch} from 'flatpickr/dist/l10n/nl.js';
import 'flatpickr/dist/flatpickr.css';

export default {
    name: "CustomerOverview",
    data() {
        return {
            config: {
                wrap: true, // set wrap to true only when using 'input-group'
                altFormat: 'd-m-Y',
                altInput: true,
                dateFormat: 'd-m-Y',
                defaultDate: "today",
                locale: Dutch,
            },
            customerCreateModal: false,
            fields: [
                {
                    key: 'id',
                    label: 'ID',
                    sortable: true
                },
                {
                    key: 'name',
                    label: 'Customer',
                    sortable: true,
                },
                {
                    key: 'credits_total',
                    label: 'Credits total',
                    sortable: true
                },
                {
                    key: 'actions',
                    label: 'Actions',
                    sortable: false
                }
            ],
            items: [],
            totalRows: 2,
            currentPage: 1,
            perPage: 10,
            pageOptions: [10, 15, 25, 50, 75],
            customer:{
                name:'',
                lastname:'',
                phone:'',
                email:'',
                support:{
                    supportPackage:'Basic-6C',
                    duration:'Quarterly',
                    startdate:'',
                    enddate:'',
                }
            },
            supportPackage:['Basic-6C','Medium-15C','Pro-25C'],
            duration:['Quarterly','Half- yearly','Annually'],
            errors:[]
        }
    },
    methods: {
        openCreateModal() {
            this.customerCreateModal = !this.customerCreateModal;
        },
        saveCustomer(){

        }
    }
}
</script>

<style scoped>

</style>
