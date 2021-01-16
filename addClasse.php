<?php 


if(isset($_POST['submit'])) {
     

$classe=$_POST['nom'];


$id_classe=$_POST['id'];

include("functions.php");
//connecter_db();
addClasse($id_classe,$classe);
header('Location: classe.php');
    
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
     <h4>Ajouter un classe</h4>

     <form class="white" action="addClasse.php" method="post">
          <div class="row">
              <div class="input-field col s6">
                <input type="text" name="nom">
                <label for="first_name">Nom classe</label>
         </div>
         <div class="row">
              <div class="input-field col s6">
                <input type="text" name="id">
                <label for="first_name">Number</label>
         </div>
 
          <div class="modal-footer center">
            <input type="submit" name="submit" value="Enregistrer" class="btn brand modal-close waves-effect waves-green">
         </div>          
      </form>
     </section>
 </body>
</html>