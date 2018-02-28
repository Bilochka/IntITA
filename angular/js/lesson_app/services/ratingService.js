angular
    .module('lessonApp')
    .factory('ratingService', ['$resource', 'transformRequest',
        function($resource, transformRequest){
            var idModule = document.querySelector("#scriptData [data-module-id]").getAttribute("data-module-id");
            var idLecture = document.querySelector("#scriptData [data-lecture-id]").getAttribute("data-lecture-id");
            return $resource(
                '',
                {},
                {
                    getOldRating: {
                        url: basePath+'/lesson/getOldRating',
                        params: {
                            id_lecture: idLecture
                        }
                    },
                    nextLecture: {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;',
                                     'X-Requested-With' : 'XMLHttpRequest'  // Needed by Yii to look at it as ajax request.
                        },
                        url: basePath+'/lesson/nextLecture',
                        params: {
                            params: 'params'
                        },
                        transformRequest: transformRequest.bind(null)
                    },
                    averageRating: {
                        url: basePath+'/lesson/averageRatingLecture',
                        params: {
                            idModule: idModule
                        }
                    },
                    saveRatingModule: {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;',
                                    'X-Requested-With' : 'XMLHttpRequest'  // Needed by Yii to look at it as ajax request.
                        },
                        url: basePath+'/lesson/saveRatingModule',
                        params: {
                            params: 'params'
                        },
                        transformRequest : transformRequest.bind(null)
                    }
                });
        }]);