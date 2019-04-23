
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


// require('../../../public/js/jquery');

// require('./bootstrap');

// window.SectorMixin = require('./mixins/sectors-mixin');

import SectorMixin from './mixins/sectors-mixin';

// import '../../../public/js/jquery-ui.js';


// import '../../../public/js/select2';

window.Vue = require('vue');
window.SectorMixin = SectorMixin.SectorMixin;

Vue.directive('modal',{
    bind(el,binding,vnode){
        alert(binding);
        $(el).on('click', (e) => {
            $(binding.value).modal();
            return e.preventDefault();
        });
    }
});


// import ProgressBar from 'vuejs-progress-bar';
// Vue.use(ProgressBar);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

Vue.component('category', require('./components/CategoryComponent.vue').default);
Vue.component('sector', require('./components/SectorComponent.vue').default);
Vue.component('customer', require('./components/CustomerComponent.vue').default);
Vue.component('group', require('./components/GroupComponent.vue').default);
Vue.component('group-select', require('./components/GroupSelectComponent.vue').default);
Vue.component('user', require('./components/UserComponent.vue').default);
Vue.component('agrolytic', require('./components/AgrolyticComponent.vue').default);
Vue.component('customer-field', require('./components/CustomerFieldComponent.vue').default);
Vue.component('comment', require('./components/CommentComponent.vue').default);
Vue.component('export-csv', require('./components/CsvDownloadComponent.vue').default);
Vue.component('report', require('./components/ReportComponent.vue').default);
Vue.component('excel-import', require('./components/ExcelImportComponent.vue').default);

Vue.component('xprogress', require('./components/ProgressComponent.vue').default);

Vue.component('dash-board-metrics', require('./components/DashboardMetricsComponent.vue').default);

Vue.component('agrolytic-action', require('./components/AgrolyticActionComponent.vue').default);

Vue.component('agrolytic-form', require('./components/AgrolyticFormComponent.vue').default);

Vue.component('date-picker', require('./components/DatePickerComponent.vue').default);

Vue.component('comment-input', require('./components/CommentInputComponent.vue').default);

Vue.component('comment-modal', require('./components/CommentModalComponent.vue').default);

Vue.component('report-input',require('./components/ReportInputComponent.vue').default);

Vue.component('op-rep-input',require('./components/OperationRepInputComponent.vue').default);

Vue.component('assign-to-op-rep',require('./components/AssignToOpRepComponent.vue').default);

Vue.component('milestones',require('./components/MilestonesComponent.vue').default);


//AssignToOpRepComponent

//OperationRepInputComponent
// mixins:[SectorMixin],
// console.log(SectorMixin);

// console.log(SectorMixin.SectorMixin);

// Vue.extend({
//     mixins:[SectorMixin.SectorMixin]
// });

const app = new Vue({
    el: '#main-app'    
});
