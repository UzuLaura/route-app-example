<template>
    <div>

        <!--Heading-->
        <vue-page-heading>Maršrutų sąrašas</vue-page-heading>
        <!--Heading-->

        <!--Loader-->
        <vue-loader v-if="loading"></vue-loader>
        <!--Loader-->

        <div v-else>

            <!--Search Bar-->
            <input class="form-control mb-3"
                   type="text"
                   v-model="searchInput"
                   placeholder="Įveskite mokyklos pavadinimą, adresą arba atstumą">
            <!--Search Bar-->

            <!--Table-->
            <vue-list-table :table="table"
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
                               :link="'/api/school/edit/' + form.school"
                               @approve="updateSchool"></vue-edit-form>
                <!--Edit Form-->

            </vue-modal>
            <!--Modal-->

        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                loading: true,
                modal: false,
                searchInput: '',

                /**
                 * Layout and data of table.
                 */
                table: {
                    headers: [
                        'Įstaigos pavadinimas',
                        'Adresas',
                        'Bendras atstumas (km)',
                        'Redaguoti'
                    ],
                    data: {},
                },

                tempData: {},

                /**
                 * Edit form layout and data.
                 */
                form: {
                    school: '',
                    inputs: {
                        title: {
                            label: 'Įstaigos pavadinimas',
                            value: '',
                            type: 'text',
                            id: 'school-title',
                        },
                        address: {
                            label: 'Adresas',
                            value: '',
                            type: 'text',
                            id: 'school-address',
                        },
                        distance: {
                            label: 'Atstumas',
                            value: '',
                            type: 'number',
                            id: 'school-distance',
                        },
                    }
                }
            }
        },

        watch: {
            /**
             * Filter table data.
             */
            searchInput: function () {
                // Regex pattern for words
                let regex = new RegExp(`^.*(${this.searchInput}).*$`);

                // Regex pattern for distance to get accurate distance result
                let distanceRegex = new RegExp(`^(${this.searchInput})$`);

                let searchResults = {};
                this.table.data = Object.keys(this.tempData).forEach(key => {
                    if (this.tempData[key].title.match(regex)
                        || this.tempData[key].address.match(regex)
                        || this.tempData[key].distance.match(distanceRegex)) {
                        searchResults[key] = this.tempData[key];
                    }
                });
                this.table.data = searchResults;
            }
        },

        methods: {
            /**
             * Get modal with edit form
             * and set initial input values.
             *
             * @param school (id of selected school)
             */
            showModal: function (school) {
                this.form.school = school.id;
                this.form.inputs.title.value = school.title;
                this.form.inputs.address.value = school.address;
                this.form.inputs.distance.value = school.distance;

                this.modal = true;
            },

            /**
             * Close modal.
             */
            closeModal: function () {
                this.modal = false;
            },

            /**
             * Update school info via post request
             * and get updated data.
             *
             * @param school
             */
            updateSchool: function (school) {
                this.table.data = school;
                this.tempData = school;
                this.closeModal();
            }
        },

        created() {

            // Get schools and set data for table
            axios.get('/api/schools')
                .then(response => {
                    this.table.data = response.data;
                    this.tempData = this.table.data;
                    this.loading = false;
                })
                .catch(error => {
                    console.log(error.message);
                });

        },
    };
</script>