<script>
import axios from "axios";

export default {
    name: "CarList",
    data() {
        return {
            cars: [],
            successAlert: false,
            successAlertMsg: '',
            noCarYet: false,
        };
    },
    created() {
        this.fetchCars();
    },
    methods: {
        async fetchCars() {
            try {
                const response = await axios.get('/cars');
                this.cars = response.data;

                this.noCarYet = this.cars.length < 1;
            } catch (error) {
                console.error('Error fetching cars:', error);
            }
        },
        showSuccessAlert(msg) {
            this.successAlert = true;

            this.successAlertMsg = msg;

            setTimeout(() => {
                this.successAlert = false;
            }, 5000);
        },
        navigateToCarEdit(id) {
            this.$router.push({name: 'CarEdit', params: {id}});
        },
        async archiveCar(id) {
            if (confirm('Are you sure you want to archive this car?')) {
                try {
                    const response = await axios.post(`/cars/${id}/archive`);

                    this.showSuccessAlert(response.data.message + " #" + response.data.id);

                    await this.fetchCars();
                } catch (error) {
                    console.error('Error archiving car:', error);
                }
            }
        },
        async deleteCar(id) {
            if (confirm('Are you sure you want to delete this car?')) {
                try {
                    const response = await axios.delete(`/cars/${id}`);

                    this.showSuccessAlert(response.data.message + " #" + response.data.id);

                    await this.fetchCars();
                } catch (error) {
                    console.error('Error archiving car:', error);
                }
            }
        }
    },
}
</script>

<template>
    <div v-if="this.successAlert" class="alert alert-success" role="alert">
        {{ this.successAlertMsg }}
    </div>
    <div v-if="noCarYet" class="col-12 d-flex justify-content-center">
        <h1>Create a car first with this
            <RouterLink :to="{name: 'CarCreate'}" class="text-info">
                link
            </RouterLink>
        </h1>
    </div>
    <div class="accordion" id="car-accordion">
        <div v-for="(car,index) in this.cars" :key="car.id" class="accordion-item">
            <h2 class="accordion-header">
                <button
                    :class="['accordion-button', index === 0 ? '' : 'collapsed']"
                    type="button"
                    data-bs-toggle="collapse"
                    :data-bs-target="'#panel-' + car.id"
                    aria-expanded="true"
                    :aria-controls="'panel-' + car.id"
                >
                    #{{ car.id }} - {{ car.name }}
                </button>
            </h2>
            <div :id="'panel-' + car.id" :class="['accordion-collapse collapse', index === 0 ? 'show' : '']">
                <div class="accordion-body">
                    <div class="row p-2">
                        <div class="col-6">
                            <span class="text-dark pe-4">
                                <strong>Registration Number: </strong>
                                {{ car.registration_number || 'N/A' }}
                            </span>
                            <span class="text-dark">
                                <strong>Is registered : </strong>
                                {{ car.is_registered ? 'Yes' : 'No' }}
                            </span>
                        </div>
                        <div class="col-6">
                            <span class="text-dark"><strong>Connected parts</strong></span>
                            <ul>
                                <li v-for="part in car.parts" :key="part.id">
                                    {{ part.name }} - {{ part.serial_number }}
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row p-2">
                        <div class="col">
                            <button class="btn btn-outline-danger me-2"
                                    @click="this.deleteCar(car.id)">
                                Delete
                                <i class="bi bi-trash"></i>
                            </button>
                            <button class="btn btn-outline-warning me-2"
                                    @click="this.archiveCar(car.id)">
                                Archive
                                <i class="bi bi-archive"></i>
                            </button>
                            <button class="btn btn-outline-primary me-2"
                                    @click="this.navigateToCarEdit(car.id)">
                                Edit
                                <i class="bi bi-pen"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
