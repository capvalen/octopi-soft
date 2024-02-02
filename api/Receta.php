<?php
require_once( 'conectkarl.php');

switch ($_POST['pedir']) {
	case 'crear': crear($db); break;
	case 'medidasAnteriores': medidasAnteriores($db); break;

	default:
		# code...
		break;
}

function crear($db){
	$lejos = json_decode($_POST['lejos'], true);
	$cerca = json_decode($_POST['cerca'], true);
	$sql = $db->prepare("INSERT INTO `receta`(`idCliente`, `diagnostico`, `tratamiento`) VALUES (
	?,?, ?
	);");
	if($sql->execute([
		$_POST['idCliente'], $_POST['diagnostico'], $_POST['tratamiento']
	])){
		$idReceta = $db->lastInsertId();

		$sqlLejos = $db->prepare("INSERT INTO `receta-lejos`(`idReceta`,
		`odEsfera`, `odCilindro`, `odEje`, `odAv`, `odDip`, `odPrisma`, 
		`oiEsfera`, `oiCilindro`, `oiEje`, `oiAv`, `oiDip`, `oiPrisma`) VALUES ({$idReceta},
		?,?,?,?,?,?,
		?,?,?,?,?,?
		)");
		$sqlLejos ->execute([
			$lejos['odEsfera'],$lejos['odCilindro'],$lejos['odEje'],$lejos['odAv'],$lejos['odDip'],$lejos['odPrisma'],
			$lejos['oiEsfera'],$lejos['oiCilindro'],$lejos['oiEje'],$lejos['oiAv'],$lejos['oiDip'],$lejos['oiPrisma']
		]);
		$sqlCerca = $db->prepare("INSERT INTO `receta-cerca`(`idReceta`,
		`odEsfera`, `odCilindro`, `odEje`, `odAv`, `odDip`, `odPrisma`, 
		`oiEsfera`, `oiCilindro`, `oiEje`, `oiAv`, `oiDip`, `oiPrisma`) VALUES ({$idReceta},
		?,?,?,?,?,?,
		?,?,?,?,?,?
		)");
		$sqlCerca ->execute([
			$cerca['odEsfera'],$cerca['odCilindro'],$cerca['odEje'],$cerca['odAv'],$cerca['odDip'],$cerca['odPrisma'],
			$cerca['oiEsfera'],$cerca['oiCilindro'],$cerca['oiEje'],$cerca['oiAv'],$cerca['oiDip'],$cerca['oiPrisma']
		]);
		echo json_encode(array( 'mensaje'=> 'ok', 'id'=> $idReceta));
	}
}

function medidasAnteriores($db){
	$filas = [];
	$sql = $db->prepare("SELECT * FROM `receta` where idCliente = ?;");
	if( $sql -> execute([$_POST['idCliente']])){
		while($row = $sql->fetch(PDO::FETCH_ASSOC)){
			$filas[] = $row;
		}
		echo json_encode($filas);
	}else{
		echo 'error';
	}
}
?>
