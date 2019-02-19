<?php

error_reporting(E_ALL ^ E_NOTICE);
session_start();


$marka = '';
$model = '';
$reg = '';

//--------------Spajanje na bazu---------------
$mysqli = new mysqli('localhost', 'root', '', 'police') or die(mysqli_error($mysqli));

//--------------Upis u bazu---------------
if (isset($_POST['save'])){
    $marka = $_POST['marka'];
    $model = $_POST['model'];
    $reg = $_POST['reg'];
    $prekrsaj = $_POST['prekrsaj'];
    $datum = $_POST['datum'];
    $iznos = $_POST['iznos'];
    $placeno = $_POST['placeno'];
    $opis = $_POST['opis'];

    $mysqli->query("INSERT INTO prekrsitelji (marka, model, reg, prekrsaj, datum, iznos, placeno, opis) VALUES('$marka', '$model', '$reg', '$prekrsaj', '$datum', '$iznos', '$placeno', '$opis')") or die($mysqli->error);

    $_SESSION['message'] = "Unos je spremljen!";
    $_SESSION['msg_type'] = "success";

    header("location: main.php");
}

//--------------Brisanje iz baze---------------
if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    if($id == null){
        $_SESSION['message'] = "Nije odabran ID!";
        $_SESSION['msg_type'] = "danger";
        header("location: main.php");
        
    }
    $mysqli->query("DELETE FROM prekrsitelji WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "Unos je izbrisan!";
    $_SESSION['msg_type'] = "danger";

    header("location: main.php");

}

    



//--------------Editiranje unosa---------------
/*if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $result = $mysqli->query("SELECT * FROM prekrsitelji WHERE id=$id") or die($mysqli->error());
    if (count($result)==1){
        $row = $result->fetch_array();
        $marka = $row['marka'];
        $model = $row['model'];
        $reg = $row['reg'];
        $prekrsaj = $row['prekrsaj'];
        $datum = $row['datum'];
        $iznos = $row['iznos'];
        $placeno = $row['placeno'];
        $opis = $row['opis'];
    }
}*/


//--------------placeno---------------
if (isset($_GET['edit'])){ error_reporting(E_ALL ^ E_WARNING);
    $id = $_GET['edit'];
    if($id == null){
        $_SESSION['message'] = "Nije odabran ID!";
        $_SESSION['msg_type'] = "danger";
        header("location: main.php");
    }
    $result = $mysqli->query("SELECT * FROM prekrsitelji WHERE id=$id") or die($mysqli->error());
    if (count($result)==1){ 
        $mysqli->query("UPDATE prekrsitelji
        SET placeno = 'DA'
        WHERE id=$id") or die($mysqli->error());

    }
    $_SESSION['message'] = "Naplaceno!";
    $_SESSION['msg_type'] = "success";
    header("location: main.php");
    }

    

?>