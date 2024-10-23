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
        $file = fopen("models/users.csv", "r");
       
        if($file) {
            $loginSuccess = false;
        }
        //validate against users.csv
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

// function addVideoGame()
// {
//     if ()
// }
?>