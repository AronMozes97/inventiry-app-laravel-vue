<script>
import axios from "axios";

export default {
    name: "NewPart",
    data() {
        return {
            part: {
                name: '',
                serial_number: '',
                car_id: '',
            },
            cars: [],
            searchQuery: "",
        };
    },
    created() {
        this.fetchCars();
    },
    methods: {
        async savePart() {
            if (!this.part.name) {
                alert('Part name is required.');
                return;
            }

            if (!this.part.serial_number) {
                alert('Part serial number is required.');
                return;
            }

            try {
                const response = await axios.post(`/parts`, this.part);

                this.$router.push({name: 'PartEdit', params: {id: response.data.part.id}});
            } catch (error) {
                if (error.response && error.response.data.errors) {
                    console.error('Validation errors:', error.response.data.errors);
                    alert(
                        Object.values(error.response.data.errors).join('\n')
                    )
                } else {
                    console.error('Error saving car:', error);
                }
            }
        },
        async fetchCars() {
            try {
                const response = await axios.get('/cars');
                this.cars = response.data;
            } catch (error) {
                console.error('Error fetching cars:', error);
            }
        }
    }
}
</script>

<template>
    <form @submit.prevent="this.savePart">
        <h1 class="mb-4">Create new part</h1>
        <div class="mb-3">
            <label for="car-name" class="form-label">Part name</label>
            <input type="text" class="form-control" id="car-name" v-model="part.name">
        </div>
        <div class="mb-3">
            <label for="car-name" class="form-label">Serial number</label>
            <input type="text" class="form-control" id="register-number" v-model="part.serial_number">
        </div>
        <div class="mb-3">
            <label for="car-name" class="form-label">Car</label>
            <select class="form-select" aria-label="Default select example" v-model="part.car_id">
                <option selected :value="null">Choose one...</option>
                <option v-for="car in this.cars" :key="car.id" :value="car.id">{{ car.name }} - {{ car.registration_number }}</option>
            </select>

        </div>

        <button type="submit" class="btn btn-success">Create part</button>
    </form>
</template>

<style scoped>

</style>
