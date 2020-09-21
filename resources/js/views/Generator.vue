<template>
    <div>

        <!--Heading-->
        <vue-page-heading>Generatorius</vue-page-heading>
        <!--heading-->

        <!--Loader-->
        <vue-loader v-if="loading"></vue-loader>
        <!--Loader-->

        <div v-else>
            <!--Form-->
            <vue-form :inputs="form.inputs"
                      :link="'/api/generate'"
                      @generate="generateRoutes">Generuoti
            </vue-form>
            <!--Form-->

            <div class="mt-3"
                 id="generated-tables">

                <div class="card p-5 my-5"
                     v-if="generated">

                    <!--Car Info Table-->
                    <h3 class="mb-2">Informacija</h3>
                    <vue-vertical-table
                            :table="tables.carInfo"></vue-vertical-table>
                    <!--Car Info Table-->

                    <!--Routes Table-->
                    <div class="d-flex flex-wrap align-items-center justify-content-between mb-2">
                        <h3>Maršrutai</h3>
                        <div>
                            <button class="btn btn-danger" @click="repeatGeneration">Generuoti iš naujo</button>
                            <button class="btn btn-success" @click="saveRoutes('/api/routes/find')">Išsaugoti</button>
                        </div>
                    </div>
                    <vue-list-table :table="tables.routes"
                                    :exclude_keys="['id', 'report_date', 'car_id']"
                                    @action="callEditRouteModal"></vue-list-table>
                    <!--Routes Table-->

                </div>
            </div>

            <!--Edit Modal-->
            <vue-modal v-if="edit.modal"
                       :title="'Redaguoti'"
                       @close="edit.modal = false">

                <!--Edit Form-->
                <vue-edit-form @close="edit.modal = false"
                               :inputs="edit.routeInfo.data"
                               :link="'/api/routes/validate'"
                               @approve="editRoute">
                </vue-edit-form>
                <!--Edit Form-->

            </vue-modal>
            <!--Edit Modal-->

            <!--Warning Modal-->
            <vue-modal v-if="warning"
                       :title="'Įspėjimas'"
                       @close="warning = false">
                <div>
                    <p class="text-danger text-center">{{ warning }}</p>
                    <div class="mt-4 text-center">
                        <button type="button"
                                class="btn btn-secondary mr-1"
                                @click="warning = false">Atšaukti
                        </button>
                        <button type="button"
                                class="btn btn-danger"
                                @click="saveRoutes('/api/routes/save')">Patvirtini
                        </button>
                    </div>
                </div>
            </vue-modal>
            <!--Warning Modal-->

            <!--Success Modal-->
            <vue-modal v-if="success"
                       :title="''"
                       @close="success = false">
                <div>
                    <p class="lead text-center">{{ success }}</p>
                    <div class="mt-4 text-center">
                        <button type="button"
                                class="btn btn-success mr-1"
                                @click="success = false">Uždaryti
                        </button>
                    </div>
                </div>
            </vue-modal>
            <!--Success Modal-->
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                cars: [],
                loading: true,
                generated: false,
                warning: '',
                success: '',

                /**
                 * Edit modal call.
                 * Edit form layout and data.
                 */
                edit: {
                    routeInfo: {
                        // selected route index in tables.routes.data
                        key: '',

                        data: {
                            date: {
                                label: 'Data',
                                value: '',
                                type: 'text',
                                id: 'total-distance',
                            },
                            route: {
                                label: 'Maršrutas',
                                value: '',
                                type: 'text',
                                id: 'total-distance',
                            },
                            distance: {
                                label: 'Atstumas',
                                value: '',
                                type: 'number',
                                id: 'total-distance',
                            }
                        }
                    },

                    modal: false
                },

                /**
                 * Generation form layout and data.
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
                            options: {},
                            value: '',
                            type: 'select',
                            id: 'routes-date',
                        },
                        distance: {
                            label: 'Nuvažiuotas kilometrų skaičius per ataskaitinį mėnesį',
                            value: '',
                            type: 'number',
                            id: 'total-distance',
                        },
                    }
                },

                /**
                 * Generated tables layouts and data.
                 */
                tables: {
                    // id of selected car
                    car_id: '',

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
                        report_date: {
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
                            'Redaguoti'
                        ],
                        data: {}
                    }
                },

                /**
                 * Restructured data for post request.
                 * Data is restructured when saveRoutes() method is called.
                 */
                routesDataForSaving: {},
            }
        },

        methods: {
            /**
             * Generate routes table with routes data.
             *
             * @param event (data from child component)
             */
            generateRoutes: function (event) {
                if (this.setGeneratedData(event)) {
                    this.generated = true;

                    // Scroll window to generated tables
                    this.$scrollTo(document.getElementById('generated-tables'));
                }
            },

            /**
             * Repeat route generation with same data.
             */
            repeatGeneration: function () {

                // Set data for post request
                let obj = {
                    car: this.tables.car_id,
                    date: this.tables.carInfo.report_date.data.split(" ")[0],
                    distance: this.tables.carInfo.distance.data.split(" ")[0],
                };

                // Send post request
                axios.post('/api/generate', obj)
                    .then(response => {
                        this.tables.routes.data = response.data.routes;
                        this.sortRoutes();
                        this.tables.carInfo.counted_distance.data = response.data.counted_distance + ' km';
                        this.tables.carInfo.distance_remainder.data = response.data.distance_remainder + ' km';
                    })
                    .catch(error => console.log(error.message));
            },

            /**
             * Set generated data for table.
             *
             * @param data
             */
            setGeneratedData: function (data) {
                this.tables.car_id = data.car.id;
                this.tables.routes.data = data.routes;

                this.tables.carInfo.brand.data = data.car.brand;
                this.tables.carInfo.number.data = data.car.number;
                this.tables.carInfo.driver.data = data.car.driver;
                this.tables.carInfo.fuel_rate_summer.data = data.car.fuel_rate_summer;
                this.tables.carInfo.fuel_rate_winter.data = data.car.fuel_rate_winter;
                this.tables.carInfo.fuel_type.data = data.car.fuel_type;
                this.tables.carInfo.report_date.data = data.date;
                this.tables.carInfo.distance.data = data.distance + ' km';
                this.tables.carInfo.counted_distance.data = data.counted_distance + ' km';
                this.tables.carInfo.distance_remainder.data = data.distance_remainder + ' km';

                // Sort routes by date.
                this.sortRoutes();

                return true;
            },

            /**
             * Sort routes by date.
             */
            sortRoutes: function () {
                this.tables.routes.data = _.sortBy(this.tables.routes.data, ['date']);
            },

            /**
             * Call a modal for route edit with selected route data
             */
            callEditRouteModal: function (event) {

                // Find selected route by route data
                let filteredRoute = this.tables.routes.data.filter((route, key) => {
                    if ((route.route === event.route)
                        && (route.distance === event.distance)
                        && (route.date === event.date)) {
                        // Set selected route index
                        this.edit.routeInfo.key = key;
                        return route;
                    }
                });

                // Set selected route info for update
                this.edit.routeInfo.data.date.value = filteredRoute[0].date;
                this.edit.routeInfo.data.route.value = filteredRoute[0].route;
                this.edit.routeInfo.data.distance.value = filteredRoute[0].distance;

                // Call modal
                this.edit.modal = true;
            },

            /**
             * Edit selected route data and update car info data
             * according route distance changes (locally).
             *
             * @param event (data from child component)
             */
            editRoute: function (event) {
                // Update car info counted distance value
                this.tables.carInfo.counted_distance.data = (+(this.tables.carInfo.counted_distance.data.split(" ")[0])
                    - +(this.tables.routes.data[this.edit.routeInfo.key].distance) + +(event.distance))
                    + ' km';

                // Update car info distance remainder value
                this.tables.carInfo.distance_remainder.data = (+(this.tables.carInfo.distance.data.split(" ")[0])
                    - +(this.tables.carInfo.counted_distance.data.split(" ")[0]))
                    + ' km';

                // Update row data
                this.tables.routes.data[this.edit.routeInfo.key].date = event.date;
                this.tables.routes.data[this.edit.routeInfo.key].route = event.route;
                this.tables.routes.data[this.edit.routeInfo.key].distance = event.distance;

                // Close modal
                this.edit.modal = false;
            },

            /**
             * Restructure data for post request.
             */
            setDataForSaving: function () {
                // Set routes data for saving
                this.routesDataForSaving.routes = this.tables.routes.data;
                this.routesDataForSaving.routes.map(route => {
                    route['report_date'] = this.tables.carInfo.report_date.data;
                    route['car_id'] = this.tables.car_id;
                });

                // Set routes information data
                this.routesDataForSaving.routesInfo = {
                    car_id: this.tables.car_id,
                    date: this.tables.carInfo.report_date.data,
                };

                // Add info to routes information array
                Object.keys(this.tables.carInfo).forEach(key => {
                    Object.keys(this.tables.carInfo[key]).forEach(colName => {
                        if (colName === 'data') {
                            this.routesDataForSaving.routesInfo[key] = this.tables.carInfo[key][colName];
                        }
                    });
                });
            },

            /**
             * Send post requests with generated data.
             * Update data if data already exist and update action confirmed.
             *
             * @param path to action (save or update)
             */
            saveRoutes: function (path) {
                this.setDataForSaving();

                // Send post request with routes
                axios.post(path, this.routesDataForSaving.routes)
                    .then(response => {

                        if (response.data.success) {

                            // Send post request with routes info
                            this.saveRoutesInfo();

                            // Show success modal
                            this.success = response.data.success;

                            // Remove warning modal
                            this.warning = false;

                        } else {
                            // Set message and show warning modal
                            this.warning = response.data.warning;
                        }

                    })
                    .catch(error => console.log(error.message));
            },

            /**
             * Send post request with routes info.
             */
            saveRoutesInfo: function () {
                axios.post('/api/routes/info/save', this.routesDataForSaving.routesInfo)
                    .then(response => {
                        console.log(response.data);
                    })
                    // .catch(error => console.log(error.message));
            },
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