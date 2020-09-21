import Errors from './Errors.js';

export default class Form {
    /**
     * Form constructor.
     *
     * @param data
     */
    constructor(data) {

        this.originalData = data;

        for (let field in data) {
            this[field] = data[field];
        }

        this.errors = new Errors();
    }

    /**
     * Set data for submitting.
     */
    data() {

        let data = {};

        for (let property in this.originalData) {
            data[property] = this[property];
        }

        return data;
    }

    /**
     * Reset form values.
     */
    reset() {

        for (let field in this.originalData) {
            this[field] = '';
        }

        this.errors.clear();
    }

    /**
     * Form submit action.
     *
     * @param requestType
     * @param url
     * @returns {Promise<any>}
     */
    submit(requestType, url) {

        return new Promise((resolve, reject) => {
            axios[requestType](url, this.data())
                .then(response => {
                    this.onSuccess(response.data);

                    resolve(response.data);
                })
                .catch(error => {
                    this.onFail(error.response.data);

                    reject(error.response.data);
                });
        });

    }

    /**
     * What happens if submit action was successful.
     */
    onSuccess() {
        this.reset();
    }

    /**
     * What happens if submit action fails.
     *
     * @param errors
     */
    onFail(errors) {
        this.errors.record(errors);
    }
}