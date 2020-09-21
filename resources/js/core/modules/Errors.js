export default class Errors {
    /**
     * Errors constructor.
     */
    constructor() {
        this.errors = {}
    }

    /**
     * Get error message for field.
     *
     * @param field
     * @returns {string}
     */
    get(field) {

        if (this.errors[field]) {
            return this.errors[field][0].charAt(0).toUpperCase() + this.errors[field][0].slice(1);
        }

    }

    /**
     * Record all errors.
     *
     * @param errors
     */
    record(errors) {
        this.errors = errors.errors;
    }

    /**
     * Clear field's error.
     *
     * @param field
     */
    clear(field) {

        if(field) {
            delete this.errors[field];
        } else {
            this.errors = {};
        }

    }

    /**
     * Check if field has error.
     *
     * @param field
     * @returns {boolean}
     */
    has(field) {
        return this.errors.hasOwnProperty(field);
    }

    /**
     * Check if any errors exist.
     *
     * @returns {boolean}
     */
    any() {
        return Object.keys(this.errors).length > 0;
    }

}