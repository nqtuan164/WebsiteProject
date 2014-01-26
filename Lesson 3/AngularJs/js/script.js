/**
 * Created with JetBrains WebStorm.
 * User: LEEYOOL
 * Date: 7/10/13
 * Time: 10:39 AM
 * To change this template use File | Settings | File Templates.
 */

function TodoCtrl($scope){

    $scope.todos = [
        {text: 'Learn AngularJs', done: false},
        {text: 'Build First AngularJs', done: false}
    ];

    $scope.getTotalTodos = function() {
        return $scope.todos.length;
    }

    $scope.clearCompleted = function() {
        $scope.todos = _.filter($scope.todos, function(todo){
            return !todo.done;
        });
        console.log($scope.todos);
    }

    $scope.addTodo = function() {
        $scope.todos.push({text: $scope.formTodoText, done: false});
        $scope.formTodoText = '';
        console.log($scope.todos);
    }
}