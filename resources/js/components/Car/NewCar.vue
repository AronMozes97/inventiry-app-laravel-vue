<script>
import axios from "axios";

export default {
    name: "NewCar",
    data() {
        return {
            car: {
                name: '',
                registration_number: '',
                is_registered: false,
            },
        };
    },
    methods: {
        async saveCar() {
            if (!this.car.name) {
                alert('Car name is required.');
                return;
            }

            if (this.car.is_registered && !this.car.registration_number) {
                alert('Registration number is required for registered cars.');
                return;
            }

            try {
                const response = await axios.post(`/cars`, this.car);

                this.$router.push({name: 'CarEdit', params: {id: response.data.car.id}});
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
        }
    }
}
</script>

<template>
    <form @submit.prevent="this.saveCar">
        <h1 class="mb-4">Create new car</h1>
        <div class="mb-3">
            <label for="car-name" class="form-label">Car name</label>
            <input type="text" class="form-control" id="car-name" v-model="car.name">
        </div>
        <div class="mb-3">
            <label for="car-name" class="form-label">Register number</label>
            <input type="number" class="form-control" id="register-number" v-model="car.registration_number">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is-registered" v-model="car.is_registered">
            <label class="form-check-label" for="exampleCheck1">Is registered</label>
        </div>
        <button type="submit" class="btn btn-success">Create car</button>
    </form>
</template>

<style scoped>

</style>
