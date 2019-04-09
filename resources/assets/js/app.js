
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.SectorMixin = require('./mixins/sectors-mixin');

import SectorMixin from './mixins/sectors-mixin';


window.Vue = require('vue');
window.SectorMixin = SectorMixin.SectorMixin;

import ProgressBar from 'vuejs-progress-bar';
Vue.use(ProgressBar);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

Vue.component('category', require('./components/CategoryComponent.vue'));
Vue.component('sector', require('./components/SectorComponent.vue'));
Vue.component('customer', require('./components/CustomerComponent.vue'));
Vue.component('group', require('./components/GroupComponent.vue'));
Vue.component('group-select', require('./components/GroupSelectComponent.vue'));
Vue.component('user', require('./components/UserComponent.vue'));
Vue.component('agrolytic', require('./components/AgrolyticComponent.vue'));
Vue.component('customer-field', require('./components/CustomerFieldComponent.vue'));
Vue.component('comment', require('./components/CommentComponent.vue'));
Vue.component('export-csv', require('./components/CsvDownloadComponent.vue'));
Vue.component('report', require('./components/ReportComponent.vue'));
Vue.component('excel-import', require('./components/ExcelImportComponent.vue'));

Vue.component('xprogress', require('./components/ProgressComponent.vue'));

Vue.component('dash-board-metrics', require('./components/DashboardMetricsComponent.vue'));


// mixins:[SectorMixin],
// console.log(SectorMixin);

// console.log(SectorMixin.SectorMixin);

// Vue.extend({
//     mixins:[SectorMixin.SectorMixin]
// });

const app = new Vue({
    el: '#app'    
});
