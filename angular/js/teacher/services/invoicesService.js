'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('invoicesService', ['$resource',
    function ($resource) {
        var url = basePath+'/_teacher/_accountant/invoices';
        return $resource(
            url,
            {},
            {
                list: {
                    url : url + '/getInvoices',
                    method: 'GET',
                    params: {
                        page: 'page',
                        pageCount: 'pageCount'
                    }
                },
                typeahead: {
                    url: url + '/getTypeahead',
                    params: {
                        query : 'query'
                    },
                    isArray:true
                }
            });
    }]);