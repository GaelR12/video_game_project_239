
<?php
   // Open the games.csv file
   $file = fopen("models/games.csv", "r");
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