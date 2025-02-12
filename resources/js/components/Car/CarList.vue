<script>
import axios from "axios";

export default {
    name: "CarList",
    data() {
        return {
            cars: [],
        };
    },
    methods: {
        async fetchCars() {
            axios.get('/cars')
                .then(response => {
                    this.cars = response.data;
                })
                .catch(error => {
                    console.error('Error fetching cars:', error);
                })
        },

        navigateToCarEdit(id) {
            this.$router.push({name: 'CarEdit', params: {id}});
        }
    },
    mounted() {
        this.fetchCars();
    }
}
</script>

<template>
    <div class="accordion" id="car-accordion">
        <div v-for="car in cars" :key="car.id" class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button"
                        data-bs-toggle="collapse"
                        :data-bs-target="'#panel-' + car.id"
                        aria-expanded="true"
                        :aria-controls="'panel-' + car.id">
                    #{{ car.id }} - {{ car.name }}
                </button>
            </h2>
            <div :id="'panel-' + car.id" class="accordion-collapse collapse show">
                <div class="accordion-body bg-body-tertiary">
                    <div class="row p-2">
                        <div class="col">
                            <span class="text-dark">
                                <strong>Registration Number: </strong>
                                {{ car.registration_number }}
                            </span>
                        </div>
                    </div>
                    <div class="row p-2">
                        <div class="col">
                            <i class="bi bi-trash pe-3 text-danger"></i>
                            <i class="bi bi-pencil-square text-info"
                               @click="navigateToCarEdit(car.id)"
                            ></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
