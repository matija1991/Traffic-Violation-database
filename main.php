<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
	header("Location: index.php");
}

$connect = mysqli_connect("localhost", "root", "", "police");
$query = "SELECT * FROM prekrsitelji";
$result = mysqli_query($connect, $query);

?>
<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
	<link rel="stylesheet" type="text/css" href="style.css"/>


	  <title>Document</title>
</head>

<body id="mainbody">
	<?php $poruka ?>
	<?php require_once 'process.php'; ?>
	<?php if (isset($_SESSION[ 'message'])): ?>
	<div id="msg" class="alert alert-<?=$_SESSION['msg_type']?> alert-dismissible fade show " role="alert">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<?php echo $_SESSION[ 'message']; unset ($_SESSION[ 'message']); ?>
	</div>
	<?php endif ?>
	<img id="logo" src="slike/logopolice.png" alt="logo">
	<h1 id="h1main">BAZA PREKRSAJA</h1>
	
		<div class="container-fluid">
		<!-- Ispis podataka -->
			<!--<div class="row justify-content-center">-->
			<div id="tblbck">
			<table id="tablica" class="display">
				<thead>
					<tr>
					<th>Id</th>
						<th>Marka</th>
						<th>Model</th>
						<th>Registracija</th>
						<th>Prekrsaj</th>
						<th>Iznos u kunama</th>
						<th>Datum</th>
						<th>Placeno</th>
						<th>Opis</th>
						
					</tr>
				</thead>
				<?php
				while($row = mysqli_fetch_array($result))
				{
					echo '<tr>
					<td>'.$row["id"].'</td>
						<td>'.$row["marka"].'</td>
						<td>'.$row["model"].'</td>
						<td>'.$row["reg"].'</td>
						<td>'.$row["prekrsaj"].'</td>
						<td>'.$row["iznos"].'</td>
						<td>'.$row["datum"].'</td>
						<td>'.$row["placeno"].'</td>
						<td>'.$row["opis"].'</td>
						';
				}
				?>
</table>
			</div>
			</div>
			
			
		
		<!-- Ispis podataka end -->
		<!-- Unos podataka -->
		<!-- Modal popup -->
		<button id="inputbtn" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#forma">Dodaj unos</button>
		<button id="opcijebtn" type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#opcije">Opcije</button>
		<div id="logoutbtn">
		<a href="logout.php" class="btn btn-danger btn-sm">Odjava</a>
		</div>
		<div id="forma" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
				<div class="modal-header"><h4>Unos podataka</h4></div>
					<div class="row justify-content-center">
						<form action="process.php" method="POST">
						<div class="modal-body">
							<div class="form-group">
								<label>Marka</label>
								<input type="text" name="marka" class="form-control" value="<?php echo $marka ?>" placeholder="Marka automobila..." required>
							</div>
							<div class="form-group">
								<label>Model</label>
								<input type="text" name="model" class="form-control" value="<?php echo $model ?>" placeholder="Model automobila..." required>
							</div>
							<div class="form-group">
								<label>Registracija</label>
								<input type="text" name="reg" class="form-control" value="<?php echo $reg ?>" placeholder="Registarska oznaka..." required>
							</div>
							<div class="form-group">
								<label>Prekrsaj</label>
								<select name="prekrsaj" class="form-control" value="<?php echo $prekrsaj ?>" required>
									<option value="">-- odaberi --</option>
									<option value="alkohol">alkohol</option>
									<option value="brzina">brzina</option>
									<option value="pojas">pojas</option>
									<option value="semafor">semafor</option>
								</select>
							</div>
							<div class="form-group">
								<label>Datum</label>
								<input type="date" name="datum" class="form-control" value="<?php echo $datum ?>" required>
							</div>
							<div class="form-group">
								<label>Iznos u kunama</label>
								<input type="number" name="iznos" class="form-control" value="<?php echo $iznos ?>" required>
							</div>
							<div class="form-group">
								<label>Placeno</label>
								<input type="radio" name="placeno" value="DA">da
								<input type="radio" name="placeno" value="NE" checked>ne</div>
							<div class="form-group">
								<label>Opis prekrsaja</label>
								<textarea name="opis" class="form-control" rows="5" cols="20" value="<?php echo $opis ?>" required></textarea>
							</div>
							</div>
							<div class="modal-footer">
							<div class="form-group">
								<button type="submit" name="save" class="btn btn-primary">Spremi</button>
								<input type="reset" name="reset" class="btn btn-danger" value="Reset">
							</div>
							</div>
						</form>
					</div>
					<!-- Unos podataka end-->
				</div>
			</div>
			<!-- Modal popup end-->
        </div>
		
		<!-- Modal opcije-->
		<div id="opcije" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
				<div class="modal-header"><h4>Unesi Id unosa</h4></div>
					<div class="row justify-content-center">
						<div class="modal-body">
							<div id="deledit">
								<label for="qta_field">ID</label>
						<input type="text" id="qta_field" value=""/>
						<a id="editbtn" href='' class="btn btn-warning btn-sm" onclick="this.href='process.php?edit='+document.getElementById('qta_field').value">Naplata</a>
<a id="deletebtn" href='' class="btn btn-danger btn-sm" onclick="this.href='process.php?delete='+document.getElementById('qta_field').value">Izbriši</a>
</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			

						<!-- Modal opcije end-->
		



		<script
  src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
  integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="
  crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
  <script type="text/javascript" src="skripta.js"></script>
</body>

</html>
