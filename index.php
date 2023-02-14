<?php
$servername = "localhost";
$username = "Root";
$password = "";
$dbname = "solicode";
$con = mysqli_connect($servername, $username, $password, $dbname);

if (!$con) {
  die("Connexion échouée : " . mysqli_connect_error());
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
       </tr>";

    while($row=mysqli_fetch_assoc($result)){ //cetter function qui permet de récuperer une ligne de resluta il afficher saus form d'un tableu
      
      echo "<tr style='border:3px solid #000;'>
              <td style='border:3px solid #000;'>".$row["nom"]."</td>
              <td style='border:3px solid #000;'> ".$row["age"]."</td>
              <td style='border:3px solid #000;'>
                <form method='post' action='index.php'>
                  <input type='hidden' name='id' id='id' value=".$row["code"].">     
                  <input type='submit' name='suprimer' value='Supprimer'>
                  <input type='hidden' name='id' id='id' value=".$row["code"].">     
                  <input type='submit' name='modifier' value='modifier'>
                </form>
              </td>
          </tr>";
      

    }
    echo "</table>";



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

  // Fermer la connexion
  mysqli_close($con);
}



// ----------    modifier    ---------- //

if (isset($_POST['modifier'])) {

  // Préparer la requête de mise à jour
  $id = $_POST["id"];
  $nom = $_POST['nom'];
  $age = $_POST['age'];

  $sql = "UPDATE apprenant SET nom = '$nom',  age = '$age' WHERE code=$id ";

  // Exécuter la requête
  if (mysqli_query($con, $sql)) {
  // echo "Record updated successfully";
  } else {
    echo "Error updating record: " . $con->error;
  }
  echo '
  <form  method="post" class="w-100  h-75 bg-white" enctype="multipart/form-data">
  <input type="text" name="nom"  class="d-block form-control w-50 mt-2" value=<br>
  <input type="text"  name="age"  class="d-block form-control w-50 mt-2"  value=<?php echo $employee->getlastName()  ?>><br>
  <div class="buttonContainer mt-2">
      <input class=" buttonModify btn-md d-inline btn btn-success mt-2 mb-2 ms-2  " type="submit" value="modify" name="modify" >
      <a href="index.php" class=" buttonCancel btn btn-danger mt-2 mb-2 border rounded-2">Cancel</a>
  </div> 
  </form>';
  // Fermer la connexion
  $con->close();
}

}
?>