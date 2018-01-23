

app.directive('singleImageUpload', ['$parse', function ($parse) {
    'use strict';
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            // var modelSetter = model.assign;
            element.bind("change", function (changeEvent) {
                // console.log(changeEvent);
                var reader = new FileReader();
                reader.onload = function (loadEvent) {
                    
                    scope.$apply(function () {
                        scope.fileModel = [];
                        scope.singleImageUpload(changeEvent.target.files[0]);
                    });
                }
                reader.readAsDataURL(changeEvent.target.files[0]);

            });

        }
    };
}]);


app.directive('singleImageUploadProfile', ['$parse', function ($parse) {
    'use strict';
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            // var modelSetter = model.assign;
            element.bind("change", function (changeEvent) {
                // console.log(changeEvent);
                var reader = new FileReader();
                reader.onload = function (loadEvent) {
                    
                    scope.$apply(function () {
                        scope.fileModel = [];
                        scope.singleImageUploadProfile(changeEvent.target.files[0]);
                    });
                }
                reader.readAsDataURL(changeEvent.target.files[0]);

            });

        }
    };
}]);

app.directive('fileModel', ['$parse', function ($parse) {
    'use strict';
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            // var modelSetter = model.assign;
            element.bind("change", function (changeEvent) {
                // console.log(changeEvent);
                var reader = new FileReader();
                reader.onload = function (loadEvent) {
                    
                    scope.$apply(function () {
                        scope.fileModel = [];
                        var path = [];
                        var preview = [];
                        var extension = "";
                        var errorfilecount = 0;
                        for(var i=0 ; i<changeEvent.target.files.length ; i++){
                            extension = changeEvent.target.files[i].name.split('.').pop();
                            if(extension != "jpeg" && extension != "jpg" && extension != "png"){
                                errorfilecount = errorfilecount + 1;
                            }
                            scope.fileModel[i] = {
                                lastModified: changeEvent.target.files[i].lastModified,
                                lastModifiedDate: changeEvent.target.files[i].lastModifiedDate,
                                name: changeEvent.target.files[i].name,
                                size: changeEvent.target.files[i].size,
                                type: changeEvent.target.files[i].type,
                                data: loadEvent.target.result
                            };
                            path[i] = loadEvent.target.result;
                            preview[i] = URL.createObjectURL(changeEvent.target.files[i]);
                        }
                        if(errorfilecount == 0){
                            scope.getFile(changeEvent.target.files,preview);    
                        } else {
                            scope.fileError(errorfilecount);
                        }
                        
                    });
                }
                // console.log(changeEvent.target.files[0]);
                reader.readAsDataURL(changeEvent.target.files[0]);

            });

        }
    };
}]);