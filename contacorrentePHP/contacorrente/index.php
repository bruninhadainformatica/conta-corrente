<?php

	include ('conecta.php'); 

	$result = mysqli_query($con,"SELECT * FROM usuario LIMIT 1");
	$usuario = mysqli_fetch_row($result);

	if (!$usuario) {
		mysqli_query($con, "INSERT INTO usuario (saldo) VALUES ('0')");
		$vinicial = 0;
	} else {
		$vinicial = $usuario[1];
	}

	if (isset($_POST['attop']) && isset($_POST['operacao']) && isset($_POST['valor'])) {
		$valor = $_POST['valor'];
		if ($_POST['operacao'] == 1) {			
			if ($valor > 0) {
				if (mysqli_query($con,"INSERT INTO historico (tipo, valor) VALUES ('$_POST[operacao]', '$valor')")) {
					$vinicial += $valor;
					mysqli_query($con, "UPDATE usuario SET saldo = $vinicial");
					echo "<script>alert('Depósito realizado!')</script>";
				}
			} else {
				echo "<script>alert('Valor inválido!')</script>";
			}
		} else {
			if ($valor <= 0) {
				echo "<script>alert('Valor inválido!')</script>";
			} else {
				if ($vinicial >= $valor) {
					if (mysqli_query($con,"INSERT INTO historico (tipo, valor) VALUES ('$_POST[operacao]', '$valor')")) {
						$vinicial -= $valor;
						mysqli_query($con, "UPDATE usuario SET saldo = $vinicial");
						echo "<script>alert('Débito realizado!')</script>";
					}
				} else {
					echo "<script>alert('Saldo indisponivel!')</script>";
				}
			}
		}
	}

	$historico = mysqli_query($con,"SELECT * FROM historico ORDER by id DESC");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bem vindo</title>
	<link rel="stylesheet" type="text/css" href="css/bemVindo.css">
	<link rel="stylesheet" href="css/logo.css">
	<link rel="stylesheet" href="css/pagina.css">
	<link rel="stylesheet" href="css/depSuce.css">
	<script type="text/javascript" src="js/nome.js"></script>
	<meta charset="utf-8">
</head>
<body onload="onLoade2d()">
	<header>
		<div id="mensagemBemVindo">
			Bem-vindo, <span id="nome_usuario">fulano</span>.
		</div>
		<div id="menu">
			<img src="img/bla.jpg" id="imgLogo" width="150px" alt="Logo do Banco">
			<div id="saldoAtual">
				<h3>Seu saldo atual é: R$ <?php echo $vinicial; ?></h3>
			</div>
		</div>
	</header>
	<br>
	<center>
		<div id="formOperacao">
			<form name="form" method="POST" action="">
				<fieldset id="operacao">
					<legend>Nova Operação</legend>

				  <fieldset id="debOrCred" >
					<legend>Operação</legend>
						<select name="operacao" id="op">
						  <option value="1" id="credito">Crédito</option>
						  <option value="2" id="debito">Débito</option>
			        </select>
				  </fieldset>
					<fieldset id="depValor">
							<legend>Valor (R$)</legend>
							<input type="number" name="valor" id="valor">
					</fieldset>
					<br>
					<input type="submit" name="attop" value="Realizar Operacao">
				</fieldset>
			</form>
		</div>

		<div class="historico">
			<h3>Histórico de Operações</h3>
			<table id="customers" border="1">
				<tbody>
					<tr>
						<th>Operação</th>
						<th>Valor</th>
					</tr>
					<?php 
						while($row = mysqli_fetch_row($historico)){
					?>
						<tr>
							<td>
								<?php 
									if ($row['1'] == 1) {
										echo "Crédito";
									} else {
										echo "Débito";
									}
								?>
							</td>
							<td>R$ <?php echo $row['2']; ?></td>
						</tr>
					<?php
						}
					?>					
				</tbody>
			</table>
		</div>

		Equipe: <br>

					Redes de Computadores<br>
						TIIINT-IFPR TB<br>
							2018<br>
	</center>

</body>
</html>
