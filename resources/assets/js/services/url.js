angular.module('app.services')
.service('Url', ['$interpolate', function($interpolate) {
    return {
        getUrlFromUrlSymbol: function(url,params){
            // '/project/{{id}}/file/{{idFile}}'
            // id = 1, idFile = 2
            // project/1/file/2
            var urlMod = $interpolate(url)(params);
            return urlMod.replace(/\/\//g,'/').replace(/\/$/,'');
        },
        getUrlResource: function(url){
            // transformar '/project/{{id}}/file/{{idFile}}'
            // em '/project/:id/file/:idFile'
            return url.replace(new RegExp('{{','g'),':').replace(new RegExp('}}','g'),'');
        }
    }

}]);