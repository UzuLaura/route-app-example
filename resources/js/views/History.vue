<template>
    <div>

        <!--Heading-->
        <vue-page-heading>Ankstesnių maršrutų paieška</vue-page-heading>
        <!--Heading-->

        <!--Loader-->
        <vue-loader v-if="loading"></vue-loader>
        <!--Loader-->

        <div v-else>
            <!--Form-->
            <vue-form :inputs="form.inputs"
                      :link="'/api/routes/search'"
                      @generate="searchRoutes">Ieškoti
            </vue-form>
            <!--Form-->

            <div class="mt-3"
                 id="search-results">

                <div class="card p-5 my-5"
                     v-if="searched">

                    <h3 v-if="!showTables">Nerasta duomenų.</h3>

                    <div v-else>

                        <!--Car Info Table-->
                        <div>
                            <h3 class="mb-2 d-inline">Informacija</h3>
                            <small>(nurodyta informacija atitinka informaciją maršruto generavimo metu)</small>
                        </div>
                        <vue-vertical-table :table="tables.carInfo"></vue-vertical-table>
                        <!--Car Info Table-->

                        <!--Routes Table-->
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h3>Maršrutai</h3>
                        </div>
                        <vue-table :table="tables.routes"
                                   :exclude_keys="[
                               'id',
                               'car_id',
                               'date',
                               'created_at',
                               'updated_at'
                               ]"></vue-table>
                        <!--Routes Table-->

                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                cars: [],
                loading: true,
                searched: false,
                showTables: false,

                /**
                 * Searching form layout and data.
                 */
                form: {
                    inputs: {
                        car: {
                            label: 'Automobilis',
                            value: '',
                            options: {},
                            type: 'select',
                            id: 'car',
                        },
                        date: {
                            label: 'Ataskaitinis laikotarpis',
                            options: [],
                            value: '',
                            type: 'select',
                            id: 'routes-date',
                        },
                    }
                },

                /**
                 * Generated tables layout and data.
                 */
                tables: {
                    carInfo: {
                        brand: {
                            header: 'Modelis',
                            data: ''
                        },
                        number: {
                            header: 'Numeris',
                            data: ''
                        },
                        fuel_type: {
                            header: 'Kuro tipas',
                            data: ''
                        },
                        driver: {
                            header: 'Vairuotojas',
                            data: ''
                        },
                        fuel_rate_summer: {
                            header: 'Kuro norma vasarą',
                            data: ''
                        },
                        fuel_rate_winter: {
                            header: 'Kuro norma žiemą',
                            data: ''
                        },
                        date: {
                            header: 'Atsakaitinis laikotarpis',
                            data: ''
                        },
                        distance: {
                            header: 'Atstumas ataskaitinį laikotarpį',
                            data: ''
                        },
                        counted_distance: {
                            header: 'Apskaičiuotas atstumas',
                            data: ''
                        },
                        distance_remainder: {
                            header: 'Likutis',
                            data: ''
                        },
                    },

                    routes: {
                        headers: [
                            'Data',
                            'Maršrutas',
                            'Atstumas (km)',
                        ],
                        data: {},
                    }
                }
            }
        },

        methods: {
            /**
             * Search for data and set tables.
             *
             * @param event (data from child component)
             */
            searchRoutes: function (event) {
                this.searched = true;

                if (event['route_info'].length > 0) {
                    this.setSearchResults(event);
                    this.showTables = true;
                } else {
                    this.showTables = false;
                }

                // Scroll window to generated tables
                this.$scrollTo(document.getElementById('search-results'));
            },

            /**
             * Set search results for table.
             *
             * @param data
             */
            setSearchResults: function (data) {
                this.tables.car_id = data['route_info'][0]['car_id'];
                this.tables.routes.data = data.routes;

                this.tables.carInfo.brand.data = data['route_info'][0].brand;
                this.tables.carInfo.number.data = data['route_info'][0].number;
                this.tables.carInfo.driver.data = data['route_info'][0].driver;
                this.tables.carInfo.fuel_rate_summer.data = data['route_info'][0]['fuel_rate_summer'];
                this.tables.carInfo.fuel_rate_winter.data = data['route_info'][0]['fuel_rate_winter'];
                this.tables.carInfo.fuel_type.data = data['route_info'][0]['fuel_type'];
                this.tables.carInfo.date.data = data['route_info'][0].date;
                this.tables.carInfo.distance.data = data['route_info'][0].distance;
                this.tables.carInfo.counted_distance.data = data['route_info'][0]['counted_distance'];
                this.tables.carInfo.distance_remainder.data = data['route_info'][0]['distance_remainder'];
            }
        },

        created() {

            // Get available cars for form
            axios.get('/api/cars')
                .then(response => response.data)
                .then(data => {
                    data.forEach(car => {
                        this.cars.push({
                            title: `${car.number} - ${car.brand}`,
                            id: car.id
                        });
                    });

                    this.form.inputs.car.options = this.cars;
                })
                .catch(error => {
                    console.log(error.message);
                });

            // Get available dates for form
            axios.get('/api/dates')
                .then(response => {
                    this.form.inputs.date.options = response.data;
                    this.loading = false;
                })
                .catch(error => console.log(error.message));
        }
    };
</script>