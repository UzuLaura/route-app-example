<template>
    <div>
        <form @submit.prevent="onSubmit"
              @mousedown="form.errors.clear($event.target.name)">

            <!--Inputs Container-->
            <div class="row">

                <!--Input Group-->
                <div v-for="(input, name) in inputs"
                     class="form-group col-12 col-lg-6">

                    <!--Input Label-->
                    <label :for="input.id">{{ input.label }}</label>
                    <!--Input Label-->

                    <!--Input-->
                    <input v-if="input.type !== 'select'"
                           :type="input.type"
                           :id="input.id"
                           :name="name"
                           :placeholder="input.placeholder"
                           class="form-control"
                           v-model="form[name]">
                    <!--Input-->

                    <!--Selector-->
                    <select v-else
                            id="cars"
                            name="car"
                            class="custom-select"
                            v-model="form[name]">

                        <!--Default Option-->
                        <option value="">
                            Pasirinkti
                        </option>
                        <!--Default Option-->

                        <!--Option-->
                        <option v-for="option in input.options"
                                :value="(typeof option === 'object') ? option.id : option">
                            {{ (typeof option === 'object') ? option.title : option }}
                        </option>
                        <!--Option-->

                    </select>
                    <!--Selector-->

                    <!--Error-->
                    <small class="text-danger"
                           v-if="form.errors.has(name)">
                        {{ form.errors.get(name) }}
                    </small>
                    <!--Error-->

                </div>
                <!--Input Group-->

            </div>
            <!--Inputs Container-->

            <!--Submit Button-->
            <div>
                <button class="btn btn-primary w-100"
                        type="submit"
                        :disabled="form.errors.any()"><slot></slot></button>
            </div>
            <!--Submit Button-->

        </form>
    </div>
</template>

<script>
    export default {
        props: ['inputs', 'link'],

        data() {
            return {
                form: {},
            }
        },

        methods: {
            onSubmit: function () {
                this.form.submit('post', this.link)
                    .then(data => {
                        this.$emit('generate', data);
                    })
                    .catch(errors => console.log(errors.message));
            },
        },

        created() {
            let formInputs = {};

            // Set form input names and values
            Object.keys(this.inputs).forEach(name => {
                formInputs[name] = this.inputs[name].value;
            });

            // Set Form object
            this.form = new Form(formInputs);
        }
    };
</script>