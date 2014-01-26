/**
 * Created with JetBrains WebStorm.
 * User: LEEYOOL
 * Date: 7/19/13
 * Time: 12:10 AM
 * To change this template use File | Settings | File Templates.
 */
angular.module('components', [])
    .directive('helloWorld', function () {
        return {
            restrict: 'E',
            templateUrl: 'partials/hello.html'
        }
    });

angular.module('HelloApp', ['components']);