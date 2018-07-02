<?php
	include ('conecta.php'); 
	$vinicial = $_POST['v1']; // Valor do saldo atual
	$valor = $_POST['valor']; // Valor que será inserido pelo usuário
	$credito = $_POST['credito']; // Retirar do valor do inicial
	$debito = $_POST['debito']; // Adicionar ao valor inicial
	
	if($op == $credito){
		$vinicial = $vinicial - $valor; // Realizar a operação de crédito
	}else if ($op == $debito){
		$vinicial = $vinicial + $valor; // Realizar operação de débito
	}
	
	echo $vinicial;
	
?>