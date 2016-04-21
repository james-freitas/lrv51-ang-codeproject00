angular.module('app.controllers')
    .controller('ProjectEditController',
    ['$scope', '$routeParams', '$location', '$cookies', '$q', '$filter', 'Project', 'Client', 'appConfig',
        function($scope, $routeParams, $location, $cookies, $q, $filter, Project, Client, appConfig){
            Project.get({id: $routeParams.id}, function(data){
                $scope.project = data;
                $scope.clientSelected = data.client.data;

/*
                Client.get({id: data.client_id}, function(data){
                    $scope.clientSelected = data;
                });
*/
            });

            $scope.status = appConfig.project.status;

            $scope.save = function() {
                if($scope.form.$valid) {
                    $scope.project.owner_id = $cookies.getObject('user').id;
                    Project.update({id: $scope.project.id}, $scope.project, function(){
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
                    deferred.resolve(result);
                }, function(error){
                    deferred.reject(error);
                });
                return deferred.promise;
            };

            $scope.selectClient = function(item){
                $scope.project.client_id = item.id;
            };

        }]);