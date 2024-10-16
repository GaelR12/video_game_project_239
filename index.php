<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php include "model/cdnlinks.php"?>
</head>
<body>
    <?php include "model/nav.php"?>

    <div class="grid text-center">
    <h1>Login Page</h1><br>
    <!-- always set method=POST and action=.php -->
    <form method="POST" action="index.php">

        <label for="username">User Name:</label>
        <input type="text" id="username" name="username" value=""><br><br>

        <label for="password">Password:</label>
        <input type="text" id="password" name="password"><br><br>

        <input class="btn btn-primary" type="submit" value="Login">

    </form>
    </div>

    <?php

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        //checks if phone has been submitted
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        //check for empty fields
        if(empty($username)){
            echo "<p>Username is required</p>";
        }

        if(empty($password)){
            echo "<p>Password is required</p>";
        }

        //reads if both fields are filled in order to open users.csv
        if (!empty($username) && !empty($password)) {
            //open users.csv
            $file = fopen("users.csv", "r");
           
            if($file) {
                $loginSuccess = false;


            }
            // Validate against users.csv
            while (($data = fgetcsv($file)) !== FALSE) {
                if ($data[0] === $username && $data[1] === $password) {
                    $loginSuccess = true;
                    break;
                }
                
            }
        
        // directs user to games.php
        fclose($file); // Close the file after reading

        if ($loginSuccess) {
            // Redirect to the games page if login is successful
            header("Location: games.php");
            exit();
        } else {
            // Show an error message if login fails
            echo "<p>Invalid username or password for: " . htmlspecialchars($username) . "</p>";
        }
    }
}

?>
    
</body>
</html>