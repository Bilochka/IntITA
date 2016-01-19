/**
 * Created by Wizlight on 11.12.2015.
 */
angular
    .module('interpreterApp')
    .controller('interpreterCtrl',interpreterCtrl);

function interpreterCtrl($scope,sendTaskJsonService) {
    //options
    $scope.types = [
        {name:'Integer', type:0},
        {name:'Float', type:1},
        {name:'Bool', type:2},
        {name:'String', type:3}
    ];
    $scope.is_array = [
        {name:'Primitive', value:0},
        {name:'Array', value:1}
    ];
    $scope.compare = [
        {name:'=', value:0},
        {name:'>', value:1},
        {name:'>=', value:2},
        {name:'<', value:3},
        {name:'<=', value:4}
    ];
    $scope.indexes = [
        {index:'$result', value:0},
        {index:'$result_etalon', value:1},
        {index:'$result_etalon_for_etalon', value:2},
        {index:'', value:3},
        {index:'', value:4},
        {index:'', value:5}
    ];
    //options

    //init obj
    $scope.results=[];
    $scope.compare_marks=[0];
    $scope.tests_code_arr=[];
    $scope.compareFull=[
        [{
            first: 0,
            second: 0
        }]
    ];
    $scope.args=
        [{
            type: 0,
            size: null,
            arg_name: '',
            pattern:/^\d+$/,
            value: [],
            is_array: 0,
            etalon_value: [],
            compare_mark: [0]
        }];
    $scope.units=
        [{
            result: '',
            compare_mark:''
        }];
    $scope.unitsResult = '';
    //init obj

    $scope.function = {
        type: 0,
        array_type: 0,
        size:null,
        unit_test_num: 1,
        checkable_args_indexes:$scope.compareFull,
        results: $scope.results,
        compare_mark: $scope.compare_marks,
        tests_code:$scope.tests_code_arr,
        args : $scope.args
    };
    $scope.finalResult= {
        operation: "addtask",
        header:$scope.header,
        etalon: $scope.etalon,
        footer:$scope.footer,
        lang: $scope.lang,
        task: $scope.task,
        function : $scope.function
    };
    //add options to select
    $scope.updateList = function(index, arg){
        $scope.indexes[3+3*index].index = '$'+arg;
        $scope.indexes[3+(3*index+1)].index = '$'+arg+'_etalon';
        $scope.indexes[3+(3*index+2)].index = '$'+arg+'_etalon_for_etalon';
    };
    //add options to select
    $scope.sizeRefresh = function(index,array,type){
        if(array==0){
            $scope.args[index].size=null;
            $scope.updatePattern(type,null,index);
        }
        if(array!=0){
            $scope.args[index].size=1;
            $scope.updatePattern(type,1,index);
        }
    };
    $scope.sizeResultRefresh = function(array,type){
        if(array==0){
            $scope.function.size=null;
            $scope.updateResultPattern(type,null);
        }
        if(array!=0){
            $scope.function.size=1;
            $scope.updateResultPattern(type,1);
        }
    };
    //add or delete form
    $scope.addDellForm = function (index) {
        if(index==0){
            $scope.args.push({
                type: 0,
                size: null,
                arg_name: '',
                pattern:/^\d+$/,
                value: [],
                is_array: 0,
                etalon_value: [],
                compare_mark: []
            });
            for (var i=0;i<3;i++)
                $scope.indexes.push({
                    index: [],
                    value: $scope.indexes.length
                });
        }else{
            $scope.args.splice(-1, 1);
            $scope.indexes.splice(-1, 1);
            $scope.indexes.splice(-1, 1);
            $scope.indexes.splice(-1, 1);
        }
    };

    $scope.addDellFormResult = function (index) {
        if(index==0){
            $scope.units.push({
                result: ''
            });
            $scope.function.compare_mark[$scope.units.length-1]=0;
            for (var i=0;i<$scope.function.args.length;i++){
                $scope.function.args[i].compare_mark[$scope.units.length-1]=0;
            }
            $scope.compareFull.push(
                [{
                first: 0,
                second: 0
                }]
            );
            $scope.function['unit_test_num']=$scope.units.length;
        }else{
            $scope.units.splice(-1, 1);
            var count=$scope.units.length;
            $scope.function.checkable_args_indexes.splice(count, 1);
            $scope.function.results.splice(count, 1);
            $scope.function.compare_mark.splice(count, 1);
            $scope.function.tests_code.splice(count, 1);
            $scope.function.tests_code.splice(count, 1);
            for (var i=0;i<$scope.function.args.length;i++){
                $scope.function.args[i].value.splice(count, 1);
                $scope.function.args[i].etalon_value.splice(count, 1);
                $scope.function.args[i].compare_mark.splice(count, 1);
            }
            $scope.function['unit_test_num']=count;
        }
    };
    $scope.addDellCompare = function (bool,index) {
        if(bool==0){
            $scope.compareFull[index].push({
                first: 0,
                second: 0
            });
        }else{
            $scope.compareFull[index].splice(-1, 1);
        }
    };
    //add or delete form

    //переглядаэмо чи є аргумент масивом і відповідно формуємо value в json и результат
    $scope.res_finalResult = null;

    $scope.$watch('finalResult', function(_data) {
        $scope.res_finalResult = angular.copy(_data);
        for (var i = 0; i < _data.function.args.length; i++) {
            if (_data.function.args[i].is_array) {
                for (var j = 0; j < _data.function.args[i].value.length; j++) {
                    if($scope.res_finalResult.function.args[i].value[j]!=null && (typeof _data.function.args[i].value[j])=='string')
                    $scope.res_finalResult.function.args[i].value[j] = _data.function.args[i].value[j].split(',');
                }
            }
        }
        if (_data.function.array_type) {
            for (var k = 0; k < _data.function.results.length; k++) {
                if($scope.res_finalResult.function.results[k]!=null && (typeof _data.function.results[k])=='string')
                $scope.res_finalResult.function.results[k] = _data.function.results[k].split(',')
            }
        }
    }, true);
    //переглядаэмо чи є аргумент масивом і відповідно формуємо value в json и результат

    $scope.sendJson = function (url) {
        sendTaskJsonService.sendJson(url,$scope.res_finalResult);
    };

    //pattern validation

    $scope.updatePattern = function(type,size,index){
        if(size==null){
            switch (type) {
                case 0:
                    $scope.args[index].pattern=/^\d+$/;
                    break;
                case 1:
                    $scope.args[index].pattern=/^[0-9]+(\.[0-9]+)?$/;
                    break;
                case 2:
                    $scope.args[index].pattern=/^(true|false|[01])$/;
                    break;
                case 3:
                    $scope.args[index].pattern=/./;
                    break;
                default:
                    $scope.args[index].pattern=/./;
            }
        }else{
            switch (type) {
                case 0:
                    $scope.args[index].pattern=new RegExp("^(\\d+,){" + (size-1) + "}\\d+$");
                    break;
                case 1:
                    $scope.args[index].pattern=new RegExp("^([0-9]+(\\.[0-9]+)?,){" + (size-1) + "}([0-9]+(\\.[0-9]+)?)$");
                    break;
                case 2:
                    $scope.args[index].pattern=new RegExp("^([01],){" + (size-1) + "}([01])$");
                    break;
                case 3:
                    $scope.args[index].pattern=new RegExp("^[^,]+(,[^,]+){"+(size-1)+"}$");
                    break;
                default:
                    $scope.args[index].pattern=/./;
            }
        }
    };
    $scope.updateResultPattern = function(type,size){
        if(size==null){
            switch (type) {
                case 0:
                    $scope.resultPattern=/^\d+$/;
                    break;
                case 1:
                    $scope.resultPattern=/^[0-9]+(\.[0-9]+)?$/;
                    break;
                case 2:
                    $scope.resultPattern=/^(true|false|[01])$/;
                    break;
                case 3:
                    $scope.resultPattern=/./;
                    break;
                default:
                    $scope.resultPattern=/./;
            }
        }else{
            switch (type) {
                case 0:
                    $scope.resultPattern=new RegExp("^(\\d+,){" + (size-1) + "}\\d+$");
                    break;
                case 1:
                    $scope.resultPattern=new RegExp("^([0-9]+(\\.[0-9]+)?,){" + (size-1) + "}([0-9]+(\\.[0-9]+)?)$");
                    break;
                case 2:
                    $scope.resultPattern=new RegExp("^([01],){" + (size-1) + "}([01])$");
                    break;
                case 3:
                    $scope.resultPattern=new RegExp("^[^,]+(,[^,]+){"+(size-1)+"}$");

                    break;
                default:
                    $scope.resultPattern=/./;
            }
        }
    };
    //pattern validation when edit load
    $scope.loadPattern = function(type,size,index){
        if(size==null){
            switch (type) {
                case 0:
                    $scope.editedJson.function.args[index].pattern=/^\d+$/;
                    break;
                case 1:
                    $scope.editedJson.function.args[index].pattern=/^[0-9]+(\.[0-9]+)?$/;
                    break;
                case 2:
                    $scope.editedJson.function.args[index].pattern=/^(true|false|[01])$/;
                    break;
                case 3:
                    $scope.editedJson.function.args[index].pattern=/./;
                    break;
                default:
                    $scope.editedJson.function.args[index].pattern=/./;
            }
        }else{
            switch (type) {
                case 0:
                    $scope.editedJson.function.args[index].pattern=new RegExp("^(\\d+,){" + (size-1) + "}\\d+$");
                    break;
                case 1:
                    $scope.editedJson.function.args[index].pattern=new RegExp("^([0-9]+(\\.[0-9]+)?,){" + (size-1) + "}([0-9]+(\\.[0-9]+)?)$");
                    break;
                case 2:
                    $scope.editedJson.function.args[index].pattern=new RegExp("^([01],){" + (size-1) + "}([01])$");
                    break;
                case 3:
                    $scope.editedJson.function.args[index].pattern=new RegExp("^[^,]+(,[^,]+){"+(size-1)+"}$");
                    break;
                default:
                    $scope.editedJson.function.args[index].pattern=/./;
            }
        }
    };
    $scope.loadResultPattern = function(type,size){
        if(size==null){
            switch (type) {
                case 0:
                    $scope.resultPattern=/^\d+$/;
                    break;
                case 1:
                    $scope.resultPattern=/^[0-9]+(\.[0-9]+)?$/;
                    break;
                case 2:
                    $scope.resultPattern=/^(true|false|[01])$/;
                    break;
                case 3:
                    $scope.resultPattern=/./;
                    break;
                default:
                    $scope.resultPattern=/./;
            }
        }else{
            switch (type) {
                case 0:
                    $scope.resultPattern=new RegExp("^(\\d+,){" + (size-1) + "}\\d+$");
                    break;
                case 1:
                    $scope.resultPattern=new RegExp("^([0-9]+(\\.[0-9]+)?,){" + (size-1) + "}([0-9]+(\\.[0-9]+)?)$");
                    break;
                case 2:
                    $scope.resultPattern=new RegExp("^([01],){" + (size-1) + "}([01])$");
                    break;
                case 3:
                    $scope.resultPattern=new RegExp("^[^,]+(,[^,]+){"+(size-1)+"}$");

                    break;
                default:
                    $scope.resultPattern=/./;
            }
        }
    };
    //load json for edit if it is
    if ($scope.editedJson != undefined){
        $scope.results=$scope.editedJson.function.results;
        $scope.compare_marks=$scope.editedJson.function.compare_mark;
        $scope.tests_code_arr=$scope.editedJson.function.tests_code;
        $scope.compareFull=$scope.editedJson.function.checkable_args_indexes;
        for (var k = 0; k < $scope.editedJson.function.args.length; k++) {
            $scope.loadPattern($scope.editedJson.function.args[k].type,$scope.editedJson.function.args[k].size,k);
        }
        $scope.args = $scope.editedJson.function.args;
        for (var i = 0; i < $scope.editedJson.function.args.length; i++) {
            if(i>0){
                for (var j=0;j<3;j++)
                    $scope.indexes.push({
                        index: [],
                        value: $scope.indexes.length
                    });
            }
            $scope.indexes[3+i*3].index = '$'+$scope.editedJson.function.args[i].arg_name;
            $scope.indexes[3+(i*3+1)].index = '$'+$scope.editedJson.function.args[i].arg_name+'_etalon';
            $scope.indexes[3+(i*3+2)].index = '$'+$scope.editedJson.function.args[i].arg_name+'_etalon_for_etalon';
        }
        for (var u=0;u<$scope.editedJson.function.unit_test_num-1;u++){
            $scope.units.push({
                result: ''
            });
        }
        $scope.function = $scope.editedJson.function;
        $scope.finalResult = $scope.editedJson;
    }

    $scope.updateResultPattern($scope.function.type,$scope.function.size);
    $scope.positiveIntPattern=/^[1-9]\d*$/;
}