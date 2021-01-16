<?php 

$errors = array('nom' => '', 'prenom' => '', 'sex' => '', 'photo' => '', 'Email' => '');
include('functions.php');
$id = $_GET['id']; 

$etudiant =  find($id);
 

if(isset($_POST['submit'])) {
  //check nom
  if(empty($_POST['nom'])) {
    $errors['nom'] = 'nom is required';
  } else {
    $nom=$_POST['nom'];
   
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

    //include("functions.php");
    include_once("functions.php");
    // $libelle=$_POST['libelle'];
    $NomPhoto = uploader($_FILES['photo']);
    //extract($_POST);
    modifier_etudiant($nom, $prenom, $sex, $NomPhoto, $Email, $id);

    header("location:index.php?op=modif");

  }
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
     <h4>Modifier un étudiant</h4>

     <form class="white" action="edit.php?id=<?= $etudiant['id_etudiant'] ?>" method="post" enctype="multipart/form-data">
         <input type="hidden" name="id" value="<?= $etudiant['id_etudiant'] ?>">
          <div class="row">
              <div class="input-field col s6">
                <input type="text" name="nom" value="<?= $etudiant['nom'] ?>">
                <div class="red-text"><?php echo $errors['nom']; ?></div>
                <label for="first_name">Nom</label>
              </div>
            <div class="input-field col s6">
              <input type="text" name="prenom" value="<?= $etudiant['prenom'] ?>">
              <div class="red-text"><?php echo $errors['prenom']; ?></div>
              <label for="last_name">Prénom</label>
           </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
            <input type="text" name="sex" value="<?= $etudiant['sex'] ?>">
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
                    <input class="file-path validate" type="text" name="photo" value="<?= $etudiant['photo'] ?>" >
                  </div>
               </div>
             </div>
          </div>
        </div>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
            <input type="text" name="Email" value="<?= $etudiant['email'] ?>">
            <div class="red-text"><?php echo $errors['Email']; ?></div>
              <label for="Email">Email</label>
            </div>
          </div> 
          <div class="modal-footer center">
           <button type="submit" name="submit" class="btn btn-warning"  style="background-color: #f1c40f">Enregister</button>   
         </div>          
      </form>
     </section>
 </body>
</html>