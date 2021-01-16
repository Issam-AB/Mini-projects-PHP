<?php 
include("functions.php");
$etudiant = aficherclasse();

$message = "";
$classe = "d-none";
if (isset($_GET['op']) && $_GET['op'] == 'ajout') {
    $classe = "alert-success";
    $message = "Ajout OK";
}
if (isset($_GET['op']) && $_GET['op'] == 'modif') {
    $message = "Modification  OK";
    $classe = "alert-warning";
}
// // dep(id,nom)
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <title>Document</title>
</head>
<style>
table {
    background: #d2dae2 !important;
    margin-top: 40px;
}
.list-inline {
  padding-left: 0;
  margin-left: -5px;
  list-style: none;
}
.list-inline > li {
  display: inline-block;
  padding-right: 5px;
  padding-left: 5px;
}

</style>
<body>
    <?php include('templetes/header.php')?>
    <section class="container black-text">
    
    <div class="alert <?= $classe ?>"><?= $message ?></div>
    <h2 class="text-center">Liste des <?= count($etudiant); ?> classe </h2>
    <form action="">
    <table class="striped">
        <thead>
          <tr>
              <th>id classe</th>
              <th>classe</th>
          </tr>
        </thead>

        <tbody>
        <?php foreach ($etudiant as $ligne) { ?>
              <tr>
                <td><?= $ligne['id_classe'] ?></td>
                <td><?= $ligne['classe'] ?></td>
              </tr>
          <?php } ?>
        </tbody>
      </table>
    </form>
    <div class="">
     <ul class="list-inline center">
     <li><a href="addClasse.php"  class="btn btn-warning"  style="background-color: #1B9CFC">Ajouter classe</a></li>
     </ul>
    </div>
    </section>
    <?php 
// On sécurise les données recueillies dans la base de données
    //  $nom = isset($_POST["nom"]) ? htmlspecialchars($_POST["nom"]) : NULL;
    //  $prenom = isset($_POST["prenom"]) ? htmlspecialchars($_POST["prenom"]) : NULL;
    //  $sex = isset($_POST["sex"]) ? htmlspecialchars($_POST["sex"]) : NULL;
    //  $date = isset($_POST["date"]) ? htmlspecialchars($_POST["date"]) : NULL;
    //  $matricul = isset($_POST["matricul"]) ? htmlspecialchars($_POST["matricul"]) : NULL;


    //  if($nom != NULL && $prenom != NULL && $sex != NULL $date != NULL && $matricul != NULL ) {
    //      $requet_sql = "INSERT INTO etudiant (nom, prenom, sex, date_naissance, matricule )"
    //  }

    ?>
    <?php include('templetes/footer.php')?>
</body>
</html>