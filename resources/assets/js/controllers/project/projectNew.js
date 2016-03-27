angular.module('app.controllers')
    .controller('ProjectNewController',
    ['$scope', '$location', '$cookies', '$q', 'Project', 'Client', 'appConfig',
        function($scope, $location, $cookies, $q ,Project, Client, appConfig){
            $scope.project = new Project();
            $scope.status = appConfig.project.status;
            $scope.project.client_id = 1;
            $scope.due_date = {
                status:{
                    opened: false
                }
            };

            $scope.open = function($event){
                $scope.due_date.status.opened = true;
            };

            $scope.save = function() {
                if($scope.form.$valid) {
                    $scope.project.owner_id = $cookies.getObject('user').id;
                    $scope.project.$save().then(function(){
                        $location.path('/projects');
                    });
                }
            };

            $scope.formatName = function (model) {
                if(model) {
                    return model.name;
                }
                return '';
            };

            $scope.getClients = function (name) {
                var deferred = $q.defer();
                Client.query({
                    search: name,
                    searchFields: 'name:like'
                }, function(data){
                    var result = $filter('limitTo')(data.data,10);
                    deferred.resolve(data.data);
                }, function(error){
                    deferred.reject(error);
                });
                return deferred.promise;
            };

            $scope.selectClient = function(item){
                $scope.project.client_id = item.id;
            };

    }]);