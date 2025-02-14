<script>
import axios from "axios";
import $ from 'jquery';

export default {
    name: "CarEdit",
    data() {
        return {
            car: {
                name: '',
                registration_number: '',
                is_registered: false,
            },
            successAlert: false,
            successAlertMsg: '',
            parts: []
        };
    },
    created() {
        const id = this.$route.params.id;
        this.fetchCar(id);
        this.fetchAvailableParts();
    },
    methods: {
        async fetchCar(id) {
            try {
                const response = await axios.get(`/cars/${id}`);
                this.car = response.data;

                //this is needed for checkbox
                this.car.is_registered = Boolean(this.car.is_registered);
            } catch (error) {
                console.error('Error fetching car:', error);
            }
        },
        showSuccessAlert(msg)
        {
            this.successAlert = true;

            this.successAlertMsg = msg;

            setTimeout(() => {
                this.successAlert = false;
            }, 5000);
        },
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
                const response = await axios.put(`/cars/${this.car.id}`, this.car);


                this.showSuccessAlert(response.data.message + " #" + response.data.car.id);

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
        async removePart(id) {
            try {
                const response = await axios.delete(`car/part/${id}/remove`);

                this.showSuccessAlert(response.data.message + " #" + response.data.part.id);

                await this.fetchCar(this.car.id);
                await this.fetchAvailableParts();
            }catch (error) {
                console.error('Error removing part:', error);
            }
        },
        async fetchAvailableParts(){
            try {
                const response = await axios.get('/parts/get/withoutCar');
                this.parts = response.data;
            }catch (error) {
                console.error('Error fetching parts:', error);
            }
        },
        async addPart(){
            try {
                const selectedPartId = $("#part-selector").val();

                if (selectedPartId === "Choose one...") {
                    alert('Please select a part.');
                    return;
                }

                const response = await axios.post(`/car/${this.car.id}/part/${selectedPartId}/connect`);
                this.showSuccessAlert(response.data.message + " #" + response.data.part.id);

                await this.fetchCar(this.car.id);
                await this.fetchAvailableParts();
            }catch (error) {
                console.error('Error adding parts:', error);
            }
        },
        navigateToPartEdit(id) {
            this.$router.push({name: 'PartEdit', params: {id}});
        },
    }
}
</script>

<template>
    <div v-if="this.successAlert" class="alert alert-success" role="alert">
        {{ this.successAlertMsg }}
    </div>
    <form @submit.prevent="saveCar">
        <h1 class="mb-4">Edit car #{{ car.id }}</h1>
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
        <button type="submit" class="btn btn-success">Save</button>
    </form>

    <h1 class="mt-5">Connected pats</h1>

    <div class="row col-6">
        <div class="col-6">
            <select class="form-select my-3" aria-label="Default select example" id="part-selector">
                <option selected :value="null">Choose one...</option>
                <option v-for="part in this.parts" :key="part.id" :value="part.id">
                    {{ part.name }} - {{ part.serial_number }}
                </option>
            </select>
        </div>
        <div class="col-6">
            <button class="btn btn-success my-3"
                    @click.prevent="this.addPart()">
                Add
            </button>
        </div>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Serial number</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="part in car.parts">
            <th scope="row">{{ part.id }}</th>
            <td>{{ part.name }}</td>
            <td>{{ part.serial_number }}</td>
            <td style="width: 200px">
                <button class="btn btn-outline-danger"
                        @click.prevent="this.removePart(part.id)">
                    Remove
                </button>
                <button class="btn btn-outline-primary"
                        @click.prevent="this.navigateToPartEdit(part.id)">
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
