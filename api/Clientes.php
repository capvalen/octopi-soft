<?php
require_once( 'conectkarl.php');

switch ($_POST['pedir']) {
	case 'buscar': buscar($db); break;
	case 'listar': listarClientes($db); break;
	case 'listar1Cliente': listar1Cliente($db); break;
	case 'registrar': registrarClientes($db); break;
	case 'actualizar': actualizarClientes($db); break;
	case 'eliminar': eliminarCliente($db); break;
	
	default:
		# code...
		break;
}

function buscar($db){
	$filas = [];
	$sql = $db->prepare("SELECT * from clientes where activo =1 and ( apellidos like :filtro or nombres like :filtro or dni like :filtroDNI ) order by registro desc limit 30");
	/* $sql->bindParam(':filtro', '%'. $_POST['texto'] .'%', PDO::PARAM_STR);
	$sql->bindParam(':filtroDNI', $_POST['texto'] , PDO::PARAM_STR); */
	if( $sql->execute([
		':filtro' => '%'. $_POST['texto'] .'%',
		':filtroDNI'=> $_POST['texto'] 
	])){
		while( $rows = $sql->fetch(PDO::FETCH_ASSOC)	)
			$filas[] = $rows;
		echo json_encode($filas);
	}else echo 'Hubo un error';
}

function listarClientes($db){
	$sql = "SELECT * from clientes where activo =1 order by registro desc limit 30";
	$filas = [];
	if($res = $db->query($sql)){
		while($row = $res->fetch(PDO::FETCH_ASSOC))
			$filas[] = $row;
		echo json_encode($filas);
	}else echo 'Hubo un error';
}

function listar1Cliente($db){
	$filas = [];
	$sql = $db->prepare("SELECT * from clientes where activo =1 and id = ?");
	if( $sql->execute([ $_POST['id'] ])){
		while( $rows = $sql->fetch(PDO::FETCH_ASSOC)	)
			$filas[] = $rows;
		echo (count($filas)>0) ? json_encode($filas[0]) : '[]';
	}else echo 'Hubo un error';
}

function registrarClientes($db){
	$cli = json_decode($_POST['cliente'], true);
	$sql = $db->prepare("INSERT INTO `clientes`(`nombres`, `apellidos`, `dni`, `direccion`, `celular`, 
	`sexo`, `fechaNacimiento`) VALUES (
	?,?,?,?,?,
	?,?
	);");
	if($sql->execute([
		$cli['nombres'], $cli['apellidos'], $cli['dni'], '', $cli['celular'], 
		$cli['sexo'], $cli['fechaNacimiento']
	])){
		$id = $db->lastInsertId();

		echo json_encode(array( 'mensaje'=> 'ok', 'id'=> $id));
	}
}

function actualizarClientes($db){
	$cli = json_decode($_POST['cliente'], true);
	$sql = $db->prepare("UPDATE `clientes` SET `nombres`=?,`apellidos`=?,`dni`=?,`celular`=?,`sexo`=?,
	`fechaNacimiento`=? where `id`=?;");
	if($sql->execute([
		$cli['nombres'], $cli['apellidos'], $cli['dni'], $cli['celular'], $cli['sexo'],
		$cli['fechaNacimiento'], $cli['id']
	])){
		$id = $db->lastInsertId();
		echo json_encode(array( 'mensaje'=> 'ok actualizado', 'id'=> $id));
	}
}

function eliminarCliente($db){
	$sql = $db->prepare('UPDATE `clientes` SET `activo`=0 WHERE id=?; ');
	if($sql->execute([ $_POST['id'] ])){
		echo json_encode(array( 'mensaje'=> 'ok eliminado'));
	}
}
?>
