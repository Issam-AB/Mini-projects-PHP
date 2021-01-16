<?php 

function connecter_db() {
    try {
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
       $cnx = new PDO("mysql:host=localhost;dbname=devoir php/mysql", 'root', '', $options);


    } catch (PDOException $e) {
      echo 'Erreur de connexion bd ' . $e->getMessage();
    }
    return $cnx;
}

function verifier_acces(string $nom, string $password)
{
    try {
        //connexion db 
        $cnx = connecter_db();
        //preparer la requete
        $rp = $cnx->prepare("select * from user where nom=? and password = ?"); //protection contre l'injection SQL 

        //exection de la requete dans la cnx 
        $rp->execute([$nom, $password]);
        //extraction fetchAll
        $resultat = $rp->fetch(); //liste 
        if (empty($resultat)) {
            header("location:login.php");
        } else if ($resultat['nom'] == $nom && $resultat['password'] == $password) {
           header("location:index.php");
        } else {
            header("location:login.php");
        }
        return $resultat;
    } catch (PDOException $e) {
        echo "Erreur de selection  du etudiant ayant l'id=$id  " . $e->getMessage();
    }
}
function uploader($infos)
{
    $nom = $infos['name'];

    $tmp = $infos['tmp_name'];
    $infos = pathinfo($nom);
    $ext = $infos['extension'];

    $new_name = md5(time() . $nom . rand(0, 99999)) . '.' . $ext;

    move_uploaded_file($tmp, "./templetes/images/$new_name");
    return "./templetes/images/$new_name";
}
// delete etudiant
function supprimer_etudiant(int $id)
{
    try {
        //connexion db 
        $cnx = connecter_db();
        //preparer la requete
        $rp = $cnx->prepare("delete from etudiant where id_etudiant =?"); //protection contre l'injection SQL 

        //exection de la requete dans la cnx 
        $rp->execute([$id]);
    } catch (PDOException $e) {
        echo "Erreur de suppression du etudiant dans la bd " . $e->getMessage();
    }
}
//modification 
function modifier_etudiant($id, string $nom, string $prenom, string $sex, string $NomPhoto, string $Email)
{
    try {
        //connexion db 
        $cnx = connecter_db();
        //preparer la requete
        $rp = $cnx->prepare("update etudiant SET nom= ?, prenom= ?, sex= ?, photo= ?, email= ? WHERE id_etudiant = ?"); //protection contre l'injection SQL 

        //exection de la requete dans la cnx 
        $rp->execute([$nom, $prenom, $sex, $NomPhoto ,$Email, $id]);
    } catch (PDOException $e) {
        echo "Erreur de modification  de etudiant dans la bd " . $e->getMessage();
    }
}
function ajouter_etudiant(string $nom, string $prenom, string $sex, string $NomPhoto, string $Email)
  {
    try{
        //connexion db 
        $cnx = connecter_db();
        //preparer la requete
        $rp = $cnx->prepare("insert into etudiant(nom,prenom,sex,photo,email) values(?,?,?,?,?)"); //protection contre l'injection SQL 
        // //exection de la requete dans la cnx 
        $rp->execute([$nom,$prenom,$sex,$NomPhoto,$Email]);
        //die("bien créé");
      } 
      catch (PDOException $e) {
      echo "Erreur d'ajout de etudiant dans la bd " . $e->getMessage();
    }
}
  
// afiicher
function aficher() {
try {
    $cnx = connecter_db();
    $rp = $cnx->prepare("SELECT * FROM etudiant");
    $rp->execute();
    //extraction fetchAll
    $resultat = $rp->fetchAll(); //liste 
    return $resultat;
} catch (PDOException $e) {
    echo "Erreur de selection  des etudiant  " . $e->getMessage();
}
}
// afiicher
function aficherclasse() {
    try {
        $cnx = connecter_db();
        $rp = $cnx->prepare("SELECT * FROM classe");
        $rp->execute();
        //extraction fetchAll
        $resultat = $rp->fetchAll(); //liste 
        return $resultat;
    } catch (PDOException $e) {
        echo "Erreur de selection  de classe  " . $e->getMessage();
    }
}

// afiicher
function aficherMatier() {
    try {
        $cnx = connecter_db();
        $rp = $cnx->prepare("SELECT * FROM matiere");
        $rp->execute();
        //extraction fetchAll
        $resultat = $rp->fetchAll(); //liste 
        return $resultat;
    } catch (PDOException $e) {
        echo "Erreur de selection  des matiere  " . $e->getMessage();
    }
}

// afiicher
function aficherAll() {
    try {
        $cnx = connecter_db();
        $rp = $cnx->prepare("SELECT E.nom, E.prenom, E.email, C.classe, M.matiere, n.note, an.anneé_scolaire FROM etudiant E JOIN classe C JOIN matiere M JOIN anneé_scolaire an JOIN note n WHERE n.id_Etudiant = E.id_etudiant and n.id_classe = C.id_classe and n.id_matier = M.id_matiere and n.id_anneé_scolaire = an.id_anneéScolaire ORDER BY `an`.`anneé_scolaire` ASC");
        $rp->execute();
        //extraction fetchAll
        $resultat = $rp->fetchAll(); //liste 
        return $resultat;
    } catch (PDOException $e) {
        echo "Erreur de selection  des matiere  " . $e->getMessage();
    }
}

function addClasse(int $id_classe, string $classe) {
    try {
        $cnx = connecter_db();
        $rp = $cnx->prepare("insert into classe(id_classe,classe) values(?,?)");
        $rp->execute([$id_classe, $classe]);
        //extraction fetchAll
        $resultat = $rp->fetchAll(); //liste 
        return $resultat;
    } catch (PDOException $e) {
        echo "Erreur de selection  des classe  " . $e->getMessage();
    }
}


function addMatiere(int $id_matiere, string $matiere) {
    try {
        $cnx = connecter_db();
        $rp = $cnx->prepare("insert into matiere(id_matiere,matiere) values(?,?)");
        $rp->execute([$id_matiere, $matiere]);
        //extraction fetchAll
        $resultat = $rp->fetchAll(); //liste 
        return $resultat;
    } catch (PDOException $e) {
        echo "Erreur de selection  des classe  " . $e->getMessage();
    }
}


//consulter un produit par son id 
function find($id)
{
    try {
        //connexion db 
        $cnx = connecter_db();
        //preparer la requete
        $rp = $cnx->prepare("select * from etudiant WHERE id_etudiant=?"); //protection contre l'injection SQL 

        //exection de la requete dans la cnx 
        $rp->execute([$id]);
        //extraction fetchAll
        $resultat = $rp->fetch(); //liste 
        return $resultat;
    } catch (PDOException $e) {
        echo "rreur de selection  du etudiant ayant l'id=$id  " . $e->getMessage();
    }
}


  


?>