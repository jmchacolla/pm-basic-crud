<template>
    <div class="p-5">
        <div class="row">
            <div class="col text-right mb-2">
                <b-button @click="openModal()"><i class="fa-solid fa-plus"></i> Add record</b-button>
            </div>
        </div>
        <div class="container">
            <div class="border mb-1">
                <b-table responsive id="pm-table" :items="items" :fields="fields">
                    <template #cell(index)="data">
                        {{ data.index + 1 }}
                    </template>
                    <template #cell(status)="data">
                        <span class="badge badge-success" v-if="data.item.status=='active'">Active</span>
                        <span class="badge badge-danger" v-if="data.item.status=='inactive'">Inactive</span>
                    </template>
                    <template #cell(actions)="data">
                        <button type="" class="btn btn-sm btn-primary" @click="editElement(data.item)"><i class="fas fa-edit"></i></button>
                        <button type="" class="btn btn-sm btn-danger" @click="deleteElement(data.item.id)"><i class="fas fa-trash"></i></button>
                    </template>
                </b-table>
            </div>
            <div class="col text-right">
                <b-pagination
                v-model="currentPage"
                :total-rows="rows"
                :per-page="perPage"
                first-text="First"
                prev-text="Prev"
                next-text="Next"
                last-text="Last"
            ></b-pagination>
            </div>
        </div>
        <div>


        <b-modal
            id="modalrecord"
            title="Add Record"
            ref="modalrecord"
            size="xl"
            no-close-on-backdrop
        >
            <h5 slot="modal-header" class="modal-title text-primary">
                <i class="fa fa-magnifying-glass"></i>
                    &nbsp;Add New Record
            </h5>
            <button
                slot="modal-header"
                type="button"
                aria-label="Close"
                data-dismiss="modal"
                class="close"
                @click="closeModal()"
            >
                <span aria-hidden="true">×</span>
            </button>
            <p class="my-4">Hello from modal!</p>
            <div class="container">
                <div class="row">
                    <div class="col col-6">
                        <div class="form-group">
                            <span title="required" class="required-asterisk">*</span>
                            <label for="name" class="font-weight-bold">Name</label>
                            <input type="text"
                                name="name"
                                id="name"
                                v-model="element.name"
                                :class="{'form-control':true, 'is-invalid' : !element.name }"
                            >
                        </div>
                    </div>
                    <div class="col col-6">
                        <div class="form-group">
                            <span title="required" class="required-asterisk">*</span>
                            <label for="description" class="font-weight-bold">Description</label>
                            <input type="text"
                                name="description"
                                id="description"
                                v-model="element.description"
                                :class="{'form-control':true, 'is-invalid' : !element.description }"
                            >
                        </div>
                    </div>
                    <div class="col col-6">
                        <div class="form-group">
                            <span title="required" class="required-asterisk">*</span>
                            <label for="code" class="font-weight-bold">Code</label>
                            <input type="text"
                                name="code"
                                id="code"
                                v-model="element.code"
                                :class="{'form-control':true, 'is-invalid' : !element.code }"
                            >
                        </div>
                    </div>
                    <div class="col col-6">
                        <div class="form-group">
                            <span title="required" class="required-asterisk">*</span>
                            <label for="code" class="font-weight-bold">Status</label>
                            <select
                                name="status"
                                id="status"
                                v-model="element.status"
                                :class="{'form-control':true, 'is-invalid' : !element.status }"
                            >
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>

            </div>

            <template #modal-footer>
                <b-button @click="closeModal" variant="danger">
                    <i class="fas fa-window-close"></i> Close
                </b-button>
                <b-button @click="saveData()" variant="primary">
                    <i class="fas fa-window-close"></i> Save
                </b-button>
            </template>
        </b-modal>
    </div>
    </div>

</template>
<script>
export default {
    data() {
      return {
        perPage: 1,
        currentPage: 1,
        fields: [
            'index',
            {
                key: 'name',
                label: 'Name'
            },
            {
                key: 'description',
                label: 'Description'
            },
            {
                key: 'status',
                label: 'Status'
            },
            {
                key: 'actions',
                label: 'Actions'
            }
        ],
        items: [],
        element: {
            id: '',
            uuid: '',
            name: '',
            description: '',
            code:'',
            status: ''
        },
        action: 'create'
      }
    },
    methods: {
        fetch(){
            axios.get('/api/pm-tables/index?')
            .then(response => {
                console.log(response, response.data.data);
                this.items = response.data.data;
            })
            .catch(error => {console.log(error.response);});
        },
        rowClass(item, type) {
            if (!item || type !== 'row') return
            if (item.status === 'active') return 'table-success'
        },
        editElement(data){
            this.action = 'edit';
            this.element.id = data.id;
            this.element.uuid = data.uuid;
            this.element.name = data.name;
            this.element.description = data.description;
            this.element.code = data.code;
            this.element.status = data.status;
            this.openModal();
        },
        deleteElement(id){
            console.log('delete---' + id);
            axios.delete('/api/pm-tables/destroy/'+ id)
            .then(response => {
                this.fetch();
            })
            .catch(error => console.log(error));
        },
        closeModal(){
            this.$refs['modalrecord'].hide();
            this.element.id = '';
            this.element.uuid = '';
            this.element.name = '';
            this.element.description = '';
            this.element.code = '';
            this.element.status = '';
            this.action = 'create';
        },
        openModal(){
            this.$refs['modalrecord'].show();
        },
        saveData(){
            switch (this.action) {
                case 'create':
                    axios.post('/api/pm-tables/store', this.element)
                    .then(response =>{
                        this.fetch();
                    })
                    .catch(error => {console.log(response.error);});
                    break;
                case 'edit':
                    axios.put('/api/pm-tables/update/'+ this.element.id, this.element)
                    .then(response =>{
                        this.fetch();
                    })
                    .catch(error => {console.log(response.error);});
                    break;
                default:
                    break;
            }
            this.action = 'create';
            this.closeModal();
        }
    },
    computed: {
      rows() {
        return this.items.length
      }
    },
    mounted() {
        this.fetch();
    },
  }
</script>