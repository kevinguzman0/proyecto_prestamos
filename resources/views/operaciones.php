<?php
error_reporting(0);
if($_POST['tablapagos'])
{
	$tablapago=$_POST['tablapagos'];
	//Valores que entra por el formulario
	$valorSolicitado = $_POST['valorDePrestamo']; 
	$plazoCuotas = $_POST['plazoEnCuotas'];


	//Valor fijo del interes
	$interes = (0.25/100);
	$decimales=4;


	$valorCuota = round($valorSolicitado * ((((1 + $interes)**$plazoCuotas)*$interes)/(((1 + $interes)**$plazoCuotas)-1)), $decimales);


	$i = 1;
	$saldoInicial = $valorSolicitado;
?>


<!DOCTYPE html>
<html>
<head>
	<title>pruebaaa</title>
</head>
<body>
	<table>
		<thead>
			<tr>
				<th>Periodo</th>
				<th>Saldo Inicial</th>
				<th>Cuota</th>
				<th>Intereses</th>
				<th>Abono a capital</th>
				<th>Saldo de capital</th>
			</tr>
		</thead>

		<tbody>
	
<?php
	while($i <= $plazoCuotas){
		$intereses = round(($saldoInicial * $interes), $decimales);
		$abonoK = round(($valorCuota - $intereses), $decimales);
		$saldoK =round(($saldoInicial - $abonoK), $decimales);	
?>

			<tr>
				<td> <?php printf("%s", $i); ?> </td>
				<td> <?php printf("%.0f", $saldoInicial); ?> </td>
				<td> <?php printf("%.0f", $valorCuota); ?> </td>
				<td> <?php printf("%.0f", $intereses); ?> </td>
				<td> <?php printf("%.0f", $abonoK); ?> </td>
				<td> <?php printf("%.0f", $saldoK); ?> </td>
			</tr>

	<?php
		$i++;
		$saldoInicial = $saldoK;
	}
	?>
		</tbody>
	</table>
</body>
</html>












<?php
	}else if($_POST['valorcuota']){
		//Valores que entra por el formulario
		$valorSolicitado = $_POST['valorDePrestamo']; 
		$plazoCuotas = $_POST['plazoEnCuotas'];


		//Valor fijo del interes
		$interes = (0.25/100);
		$decimales=4;


		$valorCuota = round($valorSolicitado * ((((1 + $interes)**$plazoCuotas)*$interes)/(((1 + $interes)**$plazoCuotas)-1)), $decimales);


		$i = 1;
		$saldoInicial = $valorSolicitado;


		printf ("El valor de la cuota es = %.0f",$valorCuota);
	}
?>
	