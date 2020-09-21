import Vue from "vue";

// Loader
Vue.component('vue-loader', require('../components/loaders/Loader').default);

// Table components
Vue.component('vue-vertical-table', require('../components/tables/VerticalTable').default);
Vue.component('vue-table', require('../components/tables/Table').default);
Vue.component('vue-list-table', require('../components/tables/ListTable').default);

// Form components
Vue.component('vue-form', require('../components/forms/Form').default);
Vue.component('vue-edit-form', require('../components/forms/EditForm').default);

// Headings
Vue.component('vue-page-heading', require('../components/headings/Page').default);

// Modals
Vue.component('vue-modal', require('../components/modals/Modal').default);