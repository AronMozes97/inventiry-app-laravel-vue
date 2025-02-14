<script>
export default {
    name: "CarArchive",
    data() {
        return {
            cars: [],
            successAlert: false,
            successMessage: '',
        }
    },
    created() {
        this.fetchCars();
    },
    methods: {
        async fetchCars() {
            try {
                const response = await axios.get('/cars/get/archive');
                this.cars = response.data;
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
        async revokeCar(id) {
            try {
                const response = await axios.post(`/cars/${id}/revoke`);

                this.showSuccessAlert(response.data.message + " #" + response.data.car.id);
                await this.fetchCars();
            } catch (error) {
                console.error('Error fetching cars:', error);
            }
        }
    },
}
</script>

<template>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Registration number</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="car in this.cars" :key="car.id">
            <th scope="row">{{ car.id }}</th>
            <td>{{ car.name }}</td>
            <td>{{ car.registration_number }}</td>
            <td style="width: 200px">
                <button class="btn btn-outline-success me-2"
                        @click="this.revokeCar(car.id)">
                    Revoke archive
                    <i class="bi bi-arrow-counterclockwise"></i>
                </button>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<style scoped>

</style>
