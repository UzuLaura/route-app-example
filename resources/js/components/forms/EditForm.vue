<template>
    <div>
        <form @submit.prevent="onSubmit"
              @keydown="form.errors.clear($event.target.name)">

            <!--Input Group-->
            <div class="form-group"
                 v-for="(input, name) in inputs">

                <!--Input Label-->
                <label :for="input.id">{{ input.label }}</label>
                <!--Input Label-->

                <!--Input-->
                <input :type="input.type"
                       :id="input.id"
                       :name="name"
                       class="form-control"
                       v-model="form[name]">
                <!--Input-->

                <!--Error-->
                <small class="text-danger"
                       v-if="form.errors.has(name)">
                    {{ form.errors.get(name) }}
                </small>
                <!--Error-->

            </div>
            <!--Input Group-->

            <!--Buttons-->
            <div class="mt-4 text-right">
                <!--Button-->
                <button type="button"
                        class="btn btn-secondary mr-1"
                        @click="$emit('close')">Atšaukti
                </button>
                <!--Button-->

                <!--Button-->
                <button type="submit"
                        class="btn btn-primary"
                        @click="onSubmit">Patvirtinti
                </button>
                <!--Button-->
            </div>
            <!--Buttons-->

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
                        this.$emit('approve', data);
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