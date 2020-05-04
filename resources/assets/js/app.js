/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));
//
// const app = new Vue({
//     el: '#app'
// });

$(document).ready(function () {

    if ($('#time').length) {
        $('#time').datetimepicker({
            inline: true,
            value: '',
            rtl: false,
            format: 'Y/m/d H:i',
            formatTime: 'H:i',
            formatDate: 'Y/m/d',
        });
    }

    if ($('#appointments-list').length) {
        $('#appointments-list').DataTable({
            "ajax": "/api/appointments",
            "columns": [
                {"data": "name"},
                {"data": "status"},
                {"data": "time"},
                {
                    data: null,
                    className: "center",
                    defaultContent: '<a href="#" class="appointment_edit btn btn-default">Edit</a>' +
                        '<form method="POST" action="#">' +
                        '<input type="hidden" name="_method" value="DELETE">' +
                        '<input type="hidden" name="_token" value="' + $('meta[name="csrf-token"]').attr('content') + '">' +
                        '<input type="button" class="appointment_remove btn btn-default" value="Delete" />' +
                        '</form>'
                }
            ]
        });

        $('#appointments-list').on('click', 'a.appointment_edit', function (e) {

            let currentID = $(this).closest('tr').attr('id');

            $(this).attr('href', routeEdit + '/' + currentID);

        });

        $('#appointments-list').on('click', 'input.appointment_remove', function (e) {

            let currentID = $(this).closest('tr').attr('id');

            $(this).parent().attr('action', routeDelete + '/' + currentID).submit();

        });
    }

});