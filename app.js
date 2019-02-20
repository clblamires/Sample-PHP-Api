"use strict";

let app = angular.module("testApp", []);

app.controller("testCtrl", ($scope,$http) => {
    $http.get("http://localhost:8888/api/employees/read.php?key=c903f90d6078bd641d5eca794deb1d99")
        .then( res => {
            console.log(res);
            $scope.employees = res.data.body;
            $scope.num_employees = res.data.count;
        });
    
        $scope.delete = id => {
            $http.delete("http://localhost:8888/api/employees/read.php?key=c903f90d6078bd641d5eca794deb1d99&id=" + id )
                .then( res => {
                    console.log(res);
                })
        }

        $scope.submitForm = () => {
            // $scope.new is bound to the input fields in the HTML file
            $http.post("http://localhost:8888/api/employees/create.php?key=c903f90d6078bd641d5eca794deb1d99", $scope.new )
                .then( res => {
                    console.log(res);
                })
        }
})