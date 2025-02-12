<script>
import axios from "axios";

export default {
    data(){
        return {
            car: {},
        };
    },
    created() {
        const id = this.$route.params.id;
        this.fetchCar(id);
    },
    methods: {
        async fetchCar(id) {
            axios.get(`/cars/${id}`)
                .then(response => {
                    this.car = response.data;
                })
                .catch(error => {
                    console.error('Error fetching car:', error);
                })
        }
    }
}
</script>

<template>
    {{this.car}}
</template>

<style scoped>

</style>
