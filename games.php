<?php include 'includes/cdnlinks.php'?>
<?php include 'includes/nav.php'?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Game List</title>
</head>
<body>
    
<h1>Video Games</h1>

<div class="container mt-4">
    <h1 class="mb-4">Video Game List</h1>

    <div class="card-group">
    <?php
            // Open the games.csv file
            $file = fopen("games.csv", "r");
            if ($file) {
                // Loop through each line in the CSV file
                while (($data = fgetcsv($file)) !== FALSE) {
                    // Skip the header row
                    if ($data[0] == "Title") {
                        continue;
                    }
                    
                    // Assign variables for each field
                    $title = htmlspecialchars($data[0]);
                    $genre = htmlspecialchars($data[1]);
                    $platform = htmlspecialchars($data[2]);
                    $imagePath = htmlspecialchars($data[3]);
                    
                    // Generate a Bootstrap card for each game
                    echo '
                    <div class="card">
                        <img src="' . $imagePath . '" class="card-img-top" alt="' . $title . '">
                        <div class="card-body">
                            <h5 class="card-title">' . $title . '</h5>
                            <p class="card-text">Genre: ' . $genre . '</p>
                            <p class="card-text">Platform: ' . $platform . '</p>
                        </div>
                    </div>';
                }

                // Close the file
                fclose($file);
            } else {
                echo "<p>Error: Could not open games.csv file.</p>";
            }
        ?>
    </div>
</div>

</body>
</html>