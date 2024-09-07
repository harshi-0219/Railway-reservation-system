<!DOCTYPE html>
<html ng-app="loginApp">
<head>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-image: url('l1.jpg'); 
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    
    .login-container {
      background-color: rgba(0, 0, 0, 0.7);
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3);
      text-align: center;
      width: 350px;
    }
    
    .login-container h1 {
      margin-bottom: 20px;
      color: #fff;
    }
    
    .login-input {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px; 
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box; 
    }
    
    .login-button {
      background-color: #007bff;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.2s ease-in-out;
    }
    
    .login-button:hover {
      background-color: #0056b3;
    }
    
    .forgot-password {
      margin-top: 10px;
      font-size: 14px;
      color: #ccc;
      text-decoration: none;
      transition: color 0.2s ease-in-out;
    }
    
    .forgot-password:hover {
      color: #fff;
    }

    /* Additional styling for error message */
    .error-message {
      color: red;
      margin-top: 10px;
    }
  </style>
</head>
<body ng-controller="loginController">

  <div class="login-container">
    <h1>Login</h1>
    <form id="login-form" ng-submit="login()">
      <input type="text" class="login-input" placeholder="Username" ng-model="user.username" required>
      <input type="password" class="login-input" placeholder="Password" ng-model="user.password" required>
      <div class="error-message" ng-show="loginError">{{ loginErrorMessage }}</div>
      <button type="submit" class="login-button" id="login">Login</button><br><br>
    </form>
    <a href="#" class="forgot-password">Forgot Password?</a>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
  <script>
    var app = angular.module('loginApp', []);

    app.controller('loginController', function ($scope, $http, $window) {
      $scope.user = {};
      $scope.loginError = false;
      $scope.loginErrorMessage = '';

      $scope.login = function () {
        if (!$scope.user.username || !$scope.user.password) {
          $scope.loginError = true;
          $scope.loginErrorMessage = 'Please fill in all fields.';
          return;
        }

        $http.post('s9.php', $scope.user)
          .then(function (response) {
            if (response.data.success) {
              $window.open("r1.html", "_blank");
            } else {
              $scope.loginError = true;
              $scope.loginErrorMessage = 'Login not successful. Please check your credentials.';
            }
          })
          .catch(function (error) {
            console.error("Error during login:", error);
            $scope.loginError = true;
            $scope.loginErrorMessage = 'An error occurred during login. Please try again.';
          });
      };
    });
  </script>
<?php
$destination = "s9.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db_host = "localhost:3306"; // Change to your database host
    $db_username = "root"; // Change to your database username
    $db_password = "root"; // Change to your database password
    $db_name = "p1"; // Change to your database name

    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $conn->real_escape_string($_POST["username"]);
    $password = $conn->real_escape_string($_POST["password"]);

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        echo "Login successful!";
    } else {
        echo "Invalid username or password.";
    }

    $conn->close();
}
?>
</body>
</html>