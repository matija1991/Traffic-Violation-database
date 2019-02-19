<!DOCTYPE html>

<!-- login -->
<?php
error_reporting(E_ALL ^ E_NOTICE);

    session_start();

    $username = '';
        $password = '';

    $username = $_POST['username'];
        $password = $_POST['pass'];

    
       $mysqli=new mysqli( 'localhost', 'root', '', 'police') or die(mysqli_error($mysqli)); 
        $result=$mysqli->query("SELECT * FROM korisnici WHERE username = '$username' AND pass = '$password'") or die($mysqli->error);
        $row = $result->fetch_array();
        


        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
            header("Location: main.php");
        }
            
        
        if ($username != '' && $password != ''){
            if($username == $row['username'] && $password == $row['pass']) {
                
                $_SESSION['loggedin'] = true;
                header("Location: main.php");
            }
            else {
                 $_SESSION['message'] = "Greška!";
            $_SESSION['msg_type'] = "danger";
            }
            
            }
            

            
        
    
    ?>

    <!-- login end -->

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body id="homebody">

<?php if (isset($_SESSION[ 'message'])): ?>
	<div id="msg" class="alert alert-<?=$_SESSION['msg_type']?> alert-dismissible fade show " role="alert">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php echo $_SESSION[ 'message']; unset ($_SESSION[ 'message']); ?>
        </div>
	<?php endif ?>


<img id="logo" src="slike/logopolice.png" alt="logo">
<h2>ULAZ U SUSTAV</h2>
<div class="row justify-content-center">
<form method="POST" action="index.php">
<div class="form-group">
<label for="username"><h6>Korisnicko ime</h6></label>
<input type="text" name="username" class="form-control">
</div>
<div class="form-group">
<label for="pass"><h6>Lozinka</h6></label>
<input type="password" name="pass" class="form-control">
</div>
<input type="submit" name="login" value="Ulaz" class="btn btn-primary">
<input type="reset" name="reset" class="btn btn-danger" value="Reset">
</form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript" src="skripta.js"></script>
</body>
</html>