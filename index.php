<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="bootstrap.min.css">
  <title>Document</title>
</head>
<body>
  <?php

      $servername = "localhost";
      $username = "Root";
      $password = "";
      $dbname = "solicode";
      $con = mysqli_connect($servername, $username, $password, $dbname);
      if (!$con) {
        die("Connexion échouée : " . mysqli_connect_error());
      }





      // ----------    suprimer    ---------- //

      if (isset($_POST['suprimer'])) {
        // Récupérer l'ID de l'entrée à supprimer
        $id = $_POST['id'];
        
        // Requête SQL pour supprimer une entrée
        $sql = " DELETE FROM apprenant WHERE code=$id ";

        if (mysqli_query($con, $sql)) {
          // echo "Record deleted successfully";
        } else {
          echo "Error deleting" . $id . " record: " . mysqli_error($con);
        }

      }





      // ----------    modifier    ---------- //

      if (isset($_POST['modifier'])) {

        // Vérifiez la connexion
        if (!$con) {
          die("Connexion échouée : " . mysqli_connect_error());
        }

        // Préparer la requête de mise à jour
        $id = $_POST["ids"];
        $nom = $_POST['nom'];
        $age = $_POST['age'];

        $sql = "UPDATE apprenant SET nom = '$nom',  age = '$age' WHERE code=$id ";


        // Exécuter la requête

        if (mysqli_query($con, $sql)) {
         
        } else {
          echo "Error updating record: " . $con->error;
        }
      }



            // ----------    ajouter    ---------- //
      

            if (isset($_POST['submit'])) {
              $nom = $_POST['nom'];
              $age = $_POST['age'];
      
              // Vérifiez la connexion
              if (!$con) {
                die("Connexion échouée : " . mysqli_connect_error());
              }
              $sql = "insert into apprenant (nom, age)
              values ('$nom', '$age')";
              if (mysqli_query($con, $sql)) {
                // echo "Données ajoutées avec succès";
              } else {
                echo "Error : " . $sql . "<br>" . mysqli_error($con);
              }
              mysqli_close($con);
              header('location:' . $_SERVER['PHP_SELF']);
              die();

            }


      $sql = "SELECT * FROM apprenant";
      // les donneé qui vient de $sql $con est sera stoké $result
      $result= mysqli_query($con, $sql);
      // ils permet de returner le nombre de ligne qui sont stoké dans le varieble $result
      if(mysqli_num_rows($result)>0) {
        echo "<table style='border:3px solid #000;border-collapse:collapse;'>";
        echo "<tr style='border:3px solid #000;'>
              <th style='border:3px solid #000;'>Nom</th>
              <th style='border:3px solid #000;'>Age</th>
              <th style='border:3px solid #000;'>Action</th>
            </tr>
            ";

          while($row=mysqli_fetch_assoc($result)){ //cetter function qui permet de récuperer une ligne de resluta il afficher saus form d'un tableu
            
            echo "<tr style='border:3px solid #000;'>
                    <td style='border:3px solid #000;'>".$row["nom"]."</td>
                    <td style='border:3px solid #000;'> ".$row["age"]."</td>
                    <td style='border:3px solid #000;'>
                      <form method='post' action='index.php'>
                        <input type='hidden' name='id' id='id' value=".$row["code"].">     
                        <input type='submit' class='btn btn-danger' name='suprimer' value='Supprimer'>
                      </form>


                      <!-- Button trigger modal -->
                      <button type='button' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#staticBackdrop".$row["code"]."'>
                        Modifier
                      </button>

                      <!-- Modal -->
                      <div class='modal fade' id='staticBackdrop".$row["code"]."' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
                        <div class='modal-dialog'>
                          <div class='modal-content'>
                            <div class='modal-header'>
                              <h1 class='modal-title fs-5' id='staticBackdropLabel'>Modification d'un apprenant</h1>
                              <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <div class='modal-body'>
                            <form method='post' action='index.php'>
                            <div class='mb-3'>
                              <input type='hidden' class='form-control' name='ids' aria-describedby='emailHelp' value=".$row["code"].">
                            </div>
                            <div class='mb-3'>
                              <label for='name' class='form-label'>Name</label>
                              <input type='text' class='form-control' id='name' aria-describedby='emailHelp' name='nom' value=".$row["nom"].">
                            </div>
                            <div class='mb-3'>
                              <label for='age' class='form-label'>Age</label>
                              <input type='text' class='form-control' id='age' name='age' value=".$row["age"].">
                            </div>
                            
                            <button type='submit' name='modifier' class='btn btn-success'>Modifier</button>
                          </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                    </td>
                </tr>";
                

          }
          echo "</table>";

        } 
  ?>



  <?php

      $servername = "localhost";
      $username = "Root";
      $password = "";
      $dbname = "solicode";
      $con = mysqli_connect($servername, $username, $password, $dbname);
      if (!$con) {
        die("Connexion échouée : " . mysqli_connect_error());
      }

            echo "

                <button type='button' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#staticBackdrop'>
                Ajouter
                </button>
                
                <!-- Modal -->
                <div class='modal fade' id='staticBackdrop' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
                  <div class='modal-dialog'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <h1 class='modal-title fs-5' id='staticBackdropLabel'>Ajouter un apprenant</h1>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                      </div>
                      <div class='modal-body'>
                      <form method='post' action='index.php'>
                      <div class='mb-3'>
                        <label for='name' class='form-label'>Name</label>
                        <input type='text' class='form-control' id='name' aria-describedby='emailHelp' name='nom'>
                      </div>
                      <div class='mb-3'>
                        <label for='age' class='form-label'>Age</label>
                        <input type='text' class='form-control' id='age' name='age'>
                      </div>
                      
                      <button type='submit' name='submit' class='btn btn-success'>Ajouter</button>
                    </form>
                ";

  ?>


 <script src="bootstrap.bundle.min.js"></script>


</body>
</html>