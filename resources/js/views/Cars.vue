<template>
    <div>

        <!--Heading-->
        <vue-page-heading>Automobilių sąrašas</vue-page-heading>
        <!--Heading-->

        <!--Loader-->
        <vue-loader v-if="loading"></vue-loader>
        <!--Loader-->

        <!--Table-->
        <vue-list-table v-else
                        :table="table"
                        :exclude_keys="['id', 'created_at', 'updated_at']"
                        @action="showModal"></vue-list-table>
        <!--Table-->

        <!--Modal-->
        <vue-modal v-if="modal"
                   :title="'Redaguoti'"
                   @close="closeModal">

            <!--Edit Form-->
            <vue-edit-form @close="closeModal"
                           :inputs="form.inputs"
                           :link="'/api/car/edit/' + form.car"
                           @approve="updateCar"></vue-edit-form>
            <!--Edit Form-->

        </vue-modal>
        <!--Modal-->

    </div>
</template>

<script>
    export default {
        data() {
            return {
                loading: true,
                modal: false,

                /**
                 * Layout and data of table.
                 */
                table: {
                    headers: [
                        'Modelis',
                        'Numeris',
                        'Kuro tipas',
                        'Vairuotojas',
                        'Kuro norma vasaros sezonu (litrai)',
                        'Kuro norma žiemos sezonu (litrai)',
                        'Redaguoti'
                    ],
                    data: {},
                },

                /**
                 * Edit form layout and data.
                 */
                form: {
                    // id of selected car
                    car: '',

                    inputs: {
                        brand: {
                            label: 'Modelis',
                            value: '',
                            type: 'text',
                            id: 'car-brand',
                        },
                        number: {
                            label: 'Numeris',
                            value: '',
                            type: 'text',
                            id: 'car-number',
                        },
                        'fuel_type': {
                            label: 'Kuro tipas',
                            value: '',
                            type: 'text',
                            id: 'car-fuel-type',
                        },
                        driver: {
                            label: 'Vairuotojas',
                            value: '',
                            type: 'text',
                            id: 'car-driver',
                        },
                        'fuel_rate_summer': {
                            label: 'Kuro norma vasaros sezonu',
                            value: '',
                            type: 'text',
                            id: 'fuel-rate-summer',
                        },
                        'fuel_rate_winter': {
                            label: 'Kuro norma žiemos sezonu',
                            value: '',
                            type: 'text',
                            id: 'fuel-rate-winter',
                        },
                    }
                }
            }
        },

        methods: {
            /**
             * Get modal with edit form
             * and set initial input values.
             *
             * @param car (id of selected car)
             */
            showModal: function (car) {
                this.form.car = car.id;
                this.form.inputs.brand.value = car.brand;
                this.form.inputs.number.value = car.number;
                this.form.inputs['fuel_type'].value = car['fuel_type'];
                this.form.inputs.driver.value = car.driver;
                this.form.inputs['fuel_rate_summer'].value = car['fuel_rate_summer'];
                this.form.inputs['fuel_rate_winter'].value = car['fuel_rate_winter'];

                this.modal = true;
            },

            /**
             * Close modal.
             */
            closeModal: function () {
                this.modal = false;
            },

            /**
             * Update car info via post request
             * and get updated data.
             *
             * @param cars (updated data from child component)
             */
            updateCar: function (cars) {
                this.table.data = cars;
                this.closeModal();
            }
        },

        created() {

            // Get cars and set data for table
            axios.get('/api/cars')
                .then(response => {
                    this.table.data = response.data;
                    this.loading = false;
                })
                .catch(error => {
                    console.log(error.message);
                });
        }
    };
</script>