<script>
import axios from "axios";

export default {
    name: "PartList",
    data() {
        return {
            parts: [],
            successAlert: false,
            successAlertMsg: '',
            noPartYet: false,
            filterTerm: ''
        }
    },
    computed: {
        filteredParts() {
            if (!this.filterTerm) {
                return this.parts;
            }
            const term = this.filterTerm.toLowerCase();

            return this.parts.filter(part => {
                return (
                    (part.name && part.name.toLowerCase().includes(term)) ||
                    (part.serial_number && part.serial_number.toLowerCase().includes(term))
                );
            });
        },
    },

    created() {
        this.fetchParts();
    },
    methods: {
        async fetchParts() {
            try {
                const response = await axios.get('/parts');
                this.parts = response.data;
                this.noPartYet = this.parts.length < 1;
            } catch (error) {
                console.error('Error fetching parts:' + error);
            }
        },
        showSuccessAlert(msg) {
            this.successAlert = true;

            this.successAlertMsg = msg;

            setTimeout(() => {
                this.successAlert = false;
            }, 5000);
        },
        navigateToPartEdit(id) {
            this.$router.push({name: 'PartEdit', params: {id}});
        },
        async deletePart(id) {
            if (confirm('Are you sure you want to delete this part?')) {
                try {
                    const response = await axios.delete(`/parts/${id}`);

                    this.showSuccessAlert(response.data.message + " #" + response.data.id)

                    await this.fetchParts();
                } catch (error) {
                    console.error('Error archiving car:', error);
                }
            }
        },
        navigateToCarEdit(id) {
            this.$router.push({name: 'CarEdit', params: {id}});
        },
    },
}
</script>

<template>

    <div v-if="this.successAlert" class="alert alert-success" role="alert">
        {{ this.successAlertMsg }}
    </div>
    <div v-if="noPartYet" class="col-12 d-flex justify-content-center">
        <h1>Create part first with this
            <RouterLink :to="{name: 'PartCreate'}" class="text-info">
                link
            </RouterLink>
        </h1>
    </div>
    <div v-if="!noPartYet" class="mb-3">
        <label for="search" class="form-label">Filter Parts</label>
        <input
            type="text"
            id="search"
            v-model="filterTerm"
            class="form-control"
            placeholder="Search by name or serial number..."
        />
    </div>

    <table v-if="!noPartYet" class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Serial Number</th>
            <th scope="col">Connected car</th>
            <th scope="col">Actions</th>

        </tr>
        </thead>
        <tbody>
        <tr v-for="part in filteredParts" :key="part.id">
            <th scope="row">{{ part.id }}</th>
            <td>{{ part.name }}</td>
            <td>{{ part.serial_number }}</td>
            <td>
                <div class="row">
                    <div class="col-6">
                        {{ part.car ? part.car.name + " - " + part.car.registration_number : 'N/A' }}
                    </div>
                    <div class="col-6">
                        <button v-if="part.car" class="btn btn-outline-primary"
                                @click="this.navigateToCarEdit(part.car.id)">
                            <i class="bi bi-pencil"></i>
                        </button>
                    </div>

                </div>
            </td>
            <td style="width: 200px">
                <button class="btn btn-outline-danger me-2"
                        @click.prevent="this.deletePart(part.id)">
                    Delete
                    <i class="bi bi-trash"></i>
                </button>
                <button class="btn btn-outline-primary"
                        @click="this.navigateToPartEdit(part.id)">
                    Edit
                    <i class="bi bi-pen"></i>
                </button>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<style scoped>

</style>
