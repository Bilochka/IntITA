angular
    .module('lessonEdit')
    .controller('CKEditorCtrl', CKEditorCtrl)

function CKEditorCtrl($compile, $scope, $http, $ngBootbox,getTaskJson,sendTaskJsonService) {
    $scope.lectureLocation=window.location.pathname.substring(0, window.location.pathname.lastIndexOf('/')+1);
    $scope.locationToPreview =$scope.lectureLocation+'#/page'+window.location.pathname.substring(window.location.pathname.lastIndexOf('/')+1);

    $scope.unableSkipTask = function(pageId){
        $ngBootbox.confirm('Ви впевнені, що хочете видалити завдання?')
            .then(function() {
                $http({
                    url: basePath + "/skipTask/unableSkipTask",
                    method: "POST",
                    data: $.param({pageId: pageId}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                })
                    .success(function (response) {
                        location.reload();
                    })
                    .error(function () {
                        alert('error unableSkipTask');
                    })
            }, function() {
            });
    };
    $scope.unablePlainTask = function(pageId){
        $ngBootbox.confirm('Ви впевнені, що хочете видалити завдання?')
            .then(function() {
                $http({
                    url: basePath + "/plainTask/unablePlainTask",
                    method: "POST",
                    data: $.param({pageId: pageId}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                })
                    .success(function (response) {
                        location.reload();
                    })
                    .error(function () {
                        alert('error unablePlainTask');
                    })
            }, function() {
            });
    };
    $scope.editorOptions = {
        language: lang
    };
    $scope.editorOptionsCode = {
        language: lang,
        enterMode: CKEDITOR.ENTER_BR
    };
    $scope.editorOptionsTask = {
        language: lang,
        toolbar: 'task'
    };
    $scope.editorOptionsAnswer = {
        language: lang,
        toolbar: 'answer',
        height: '40px'
        //enterMode: CKEDITOR.ENTER_BR
    };
    $scope.editorOptionsSkipTask = {
        language: lang,
        toolbar: 'skipTask'
    };
    $scope.$on("ckeditor.ready", function (event) {
        $scope.isReady = true;
    });

    $scope.getBlockHtml = function (blockOrder, idLecture, element) {
        $http({
            url: basePath + '/lesson/editBlock',
            method: "POST",
            data: $.param({order: blockOrder, lecture: idLecture}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            $scope.editRedactor = response.data;
            var template = '<textarea data-ng-cloak class="openCKE" ' +
                'id="openCKE' + blockOrder + '"' +
                'ckeditor="editorOptions" name="editor" ng-model="editRedactor">' +
                '</textarea>';
            ($compile(template)($scope)).insertAfter(element);
            return true;
        }, function errorCallback() {
            alert($scope.errorMsg);
        });
    };

    $scope.answers = [{id: 1}];

    $scope.addAnswer = function () {
        $scope.answers.push({id: $scope.answers.length });
        var optionsNum = angular.element(document.querySelector("#optionsNum"));
        optionsNum.val(parseInt(optionsNum.val()) + 1);
    };
    $scope.deleteAnswer = function () {
        $scope.answers.splice(-1, 1);
        var optionsNum = angular.element(document.querySelector("#optionsNum"));
        if (optionsNum.val() > 0) {
            optionsNum.val(parseInt(optionsNum.val()) - 1);
        }
    };
    $scope.editAddAnswer = function () {
        $scope.editAnswers.push('');
        var optionsNum = angular.element(document.querySelector("#optionsNum"));
        optionsNum.val(parseInt(optionsNum.val()) + 1);
    };
    $scope.editDeleteAnswer = function () {
        $scope.editAnswers.splice(-1, 1);
        var optionsNum = angular.element(document.querySelector("#optionsNum"));
        if (optionsNum.val() > 0) {
            optionsNum.val(parseInt(optionsNum.val()) - 1);
        }
    };
    /*add Skip Task*/
    $scope.createSkipTaskCKE = function (url, pageId, author) {
        var questionTemp = $scope.addSkipTaskQuest;
        var condition = $scope.addSkipTaskCond;

        var number=0
        var question=questionTemp.replace( /<span skip=\"(.+?)\:(.+?)\" style=\"background:([^\d]*)\">(.+?)<\/span>/g, function(p1,p2,p3,p4,p5) {
            number++;
            return '<span skip=\"'+number+'\:'+p3+'\" style=\"background:'+p4+'\">'+p5+'<\/span>';
        });
        text = question.replace( /<span skip=\"(.+?)\:(.+?)\" style=\"background:([^\d]*)\">(.+?)<\/span>/g, '<input type=text id=skipTask$1 caseInsensitive=$2 />' );
        pattern = /<span skip=\"(.+?)\:(.+?)\" style=\"background:([^\d]*)\">(.+?)<\/span>/ig;

        var newSkipTask = {
            "page":pageId,
            "author": author,
            "question": question,
            "condition":condition,
            "text": text,
            "answer": []
        };
        while (result = pattern.exec(question)) {
            newSkipTask.answer.push({
                "index": result[1],
                "caseInsensitive":result[2],
                "value":  result[4].replace(/[\u200B-\u200D\uFEFF]/g, '')
            });
        }

        var jsonSkip = $.post(url, newSkipTask, function () {
        })
            .done(function () {
                //alert("Завдання успішно додано до лекції!");
                 location.reload();
            })
            .fail(function () {
                alert("Вибачте, але на сайті виникла помилка і додати задачу до заняття наразі неможливо. " +
                    "Спробуйте додати пізніше або зв'яжіться з адміністратором сайту.");
                location.reload();
            })
            .always(function () {
            });
    };
    $scope.editTaskCKE = function (blockId) {
        editTaskCondition(blockId)
            .then(function(editResponse) {
                if(editResponse){
                    getTaskJson.getJson($scope.task,$scope.interpreterServer).then(function(response){
                        if (response != undefined){
                            $scope.editedJson=response;
                            $scope.editedJson=JSON.parse($scope.editedJson);
                            var tempLang=originLang;
                            $scope.editedJson.lang=selectedLang;
                            sendTaskJsonService.sendJson($scope.interpreterServer,$scope.editedJson).then(function(response){
                                if(!response){
                                    editTaskCondition(blockId, tempLang).then(function() {
                                        $("select#programLang option[value="+"'"+ tempLang +"'"+ "]").attr('selected', 'true');
                                    })
                                }
                            });
                        }
                    });
                }else{
                    $ngBootbox.alert("Зберегти зміни не вдалося. Спробуйте ще раз або зв'яжіться з адміністратором сайту.");
                }
            });
    };

    function editTaskCondition(blockId,lng) {
        lng = typeof lng !== 'undefined' ? lng : selectedLang;
        var promise = $http({
            url: basePath + '/task/editTaskCKE',
            method: "POST",
            data: $.param({idTaskBlock: blockId, condition: $scope.editTask, lang:lng}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            return true;
        }, function errorCallback() {
            return false;
        });
        return promise;
    }

    $scope.addTextBlock = function(type){
        if(type==7){
            $scope.instructionStyle=true;
        }else{
            $scope.instructionStyle=false;
        }
        document.getElementById('addBlock').style.display = 'block';
        if(type==3) {
            document.getElementById('blockForm').style.display = 'none';
            document.getElementById('blockFormCode').style.display = 'block';
            document.getElementById('blockTypeCode').value = type;
        }else{
            document.getElementById('blockFormCode').style.display = 'none';
            document.getElementById('blockForm').style.display = 'block';
            document.getElementById('blockType').value = type;
        }
    }
}