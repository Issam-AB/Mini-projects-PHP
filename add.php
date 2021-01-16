<?php 

$errors = array('nom' => '', 'prenom' => '', 'sex' => '', 'Photo' => '', 'Email' => '');

if(isset($_POST['submit'])) {
     
  //check nom
  if(empty($_POST['nom'])) {
    $errors['nom'] = 'nom is required';
  } else {
    $nome=$_POST['nom'];
   
  }

    //check prenom
    if(empty($_POST['prenom'])) {
      $errors['prenom'] = 'prenom is required';
    } else {
      $prenom=$_POST['prenom']; 
    }

      //check sex
  if(empty($_POST['sex'])) {
    $errors['sex'] = 'sex is required';
  } else {
    $sex=$_POST['sex'];
  }
  //check Email
  if(empty($_POST['Email'])) {
  $errors['Email'] = 'Email is required';
} else {
  $Email=$_POST['Email'];
}


 
  if(array_filter($errors)) {
    //  echo 'error in the form'
  } else {
    include("functions.php");
    $NomPhoto = uploader($_FILES['photo']);
    //connecter_db();
    ajouter_etudiant($nome,$prenom,$sex,$NomPhoto,$Email);
    header('Location: index.php');
  }


  // try{
  //   //connexion db 
  //   $cnx = connecter_db();
  //   //preparer la requete
  //   $rp = $cnx->prepare("insert into etudiant(nom,prenom,sex,photo,email) values(?,?,?,?,?)"); //protection contre l'injection SQL 
  //   // //exection de la requete dans la cnx 
  //   $rp->execute([$nom,$prenom,$sex,$NomPhoto,$Email]);
  // } 
  // catch (PDOException $e) {
  // echo "Erreur d'ajout de produit dans la bd " . $e->getMessage();
  // }
} 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
   <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">   
    <title>Document</title>
<style type="text/css">
  .brand{
    background: #cbb09c !important;
  }
  .brand-text{
      color: #cbb09c !important;
  }
  h4{
    color: #7f8c8d;
  } 
</style>

</head>
<body class="grey lighten-4">
    <?php include('templetes/header.php') ?>
     <!-- Modal Structure -->

     <section class="container black-text">
     <h4>Ajouter un étudiant</h4>

     <form class="white" action="add.php" method="post" enctype="multipart/form-data">
          <div class="row">
              <div class="input-field col s6">
                <input type="text" name="nom">
                <div class="red-text"><?php echo $errors['nom']; ?></div>
                <label for="first_name">Nom</label>
              </div>
            <div class="input-field col s6">
              <input type="text" name="prenom">
              <div class="red-text"><?php echo $errors['prenom']; ?></div>
              <label for="last_name">Prénom</label>
           </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
            <input type="text" name="sex">
            <div class="red-text"><?php echo $errors['sex']; ?></div>
              <label for="date">Sex</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
                <div class="file-field input-field">
                  <div class="btn">
                    <span>Photo</span>
                    <input type="file" name="photo">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" >
                    <div class="red-text validate"><?php echo $errors['Photo']; ?></div>
                  </div>
               </div>
             </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
            <input type="text" name="Email">
            <div class="red-text"><?php echo $errors['Email']; ?></div>
              <label for="Email">Email</label>
            </div>
          </div> 
          <div class="modal-footer center">
            <input type="submit" name="submit" value="Enregistrer" class="btn brand modal-close waves-effect waves-green">
         </div>          
      </form>
     </section>
 </body>
</html>