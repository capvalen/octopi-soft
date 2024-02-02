<?php
// Incluye la clase MPDF
require_once __DIR__ . './../vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

/* CONEXION DE BD */
require_once( 'conectkarl.php');

$sql = $db->prepare("SELECT * FROM `receta` r inner join clientes c on c.id = r.idCliente where r.id = ? ;");
if( $sql -> execute([$_GET['idReceta']])){
	$row = $sql->fetch(PDO::FETCH_ASSOC);
	$idReceta =$_GET['idReceta'];

	$sqlLejos = $db->prepare("SELECT * FROM `receta-lejos` where  idReceta  = ?; ");
	$sqlLejos -> execute([ $idReceta ]);
	$rowLejos = $sqlLejos->fetch(PDO::FETCH_ASSOC);
	$sqlCerca = $db->prepare("SELECT * FROM `receta-cerca` where  idReceta  = ?; ");
	$sqlCerca -> execute([ $idReceta ]);
	$rowCerca = $sqlCerca->fetch(PDO::FETCH_ASSOC);
}
//var_dump($rowLejos); die();

$fechaActual = new DateTime();

if ($row['fechaNacimiento']<>null){
	$fechaNacimiento = new DateTime($row['fechaNacimiento']);
	$diferencia = $fechaActual->diff($fechaNacimiento);
	$edad = $diferencia->y;
}
else{
	$edad =0;
}





// Crea un objeto de opciones
$options = new Options();

$options->set('defaultPaperSize', 'a5'); // Tamaño de página A5
$options->set('defaultPaperOrientation', 'landscape'); // Orientación horizontal (Landscape)
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
$options->set('isRemoteEnabled', true);

// Instancia Dompdf
$dompdf = new Dompdf($options);

$dompdf->set_option('margin', [
	'top' => 0,
	'bottom' => 0,
	'left' => 0,
	'right' => 0,
]);


// Define el HTML que se convertirá en PDF
$html = '
<html>
<head>
  <title>Receta de lentes</title>
  <style>
	html{margin: 0; padding:0}
	
    body {
			margin:10px;padding:10px;
      font-family: Arial, sans-serif;
      font-size: 12px;
			
			background: url("http://localhost/vegavision/img/fondo.jpg") no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
    }
    h1 {
      color: #333;
      text-align: center;
			font-size: 14px;
    }
    p {
      color: #555;
      line-height: 1.6;
    }
		.tablaInvi {
      border-collapse: collapse;
    }
		table{width: 100%;}
    #tblDatos th, #tblDatos td {
			border: 0px solid #000;
    }
		th, td{padding: 8px;}
		#tblResultados , #tblResultados td, #tblResultados th{
			border-collapse: collapse;
			border:1px solid;
		}
		.text-center{text-align:center}
		#firma{
			display: none;
			position: absolute;
      bottom: 5px; /* Margen inferior de 5px */
      right: 5px; /* Margen derecho de 5px */
      padding: 10px;
		}
		.ms-3{margin-left:30px;}
		#saludo{margin-top: 30px;}
  </style>
</head>
<body>
  <h1 id="saludo">Receta de lentes</h1>
	<table class="tablaInvi" id="tblDatos">
		<tr>
			<td style="width: 50%;"><strong>Apellidos y nombres: </strong><span>'. $row['apellidos']. ' '. $row['nombres'] .'</span></td>
			<td style="width: 50%;"><strong>Edad:</strong> <span>'.$edad.' años </span> </td>
		</tr>
	</table>
	<table class="table " id="tblResultados">
			<tr class="">
				<td class="" colspan="2"></td>
				<th class="text-center fw-bold" colspan="6">Prescripción de lentes</th>
			</tr>
			<tr class="">
				<td class="" colspan="2"></td>
				<th class="text-center fw-bold">Esfera</th>
				<th class="text-center fw-bold">Cilindro</th>
				<th class="text-center fw-bold">Eje</th>
				<th class="text-center fw-bold">AV</th>
				<th class="text-center fw-bold">DIP</th>
				<th class="text-center fw-bold">Prisma</th>
			</tr>
			<tr>
				<th class="fw-bold text-center" rowspan="2">LEJOS</th>
				<th class="fw-bold text-center">OD</th>
				<td> '. $rowLejos['odEsfera'].'
				</td>
				<td> '. $rowLejos['odCilindro'].'
				</td>
				<td> '. $rowLejos['odEje'].'
				</td>
				<td> '. $rowLejos['odAv'].'
				</td>
				<td> '. $rowLejos['odDip'].'
				</td>
				<td> '. $rowLejos['odPrisma'].'
				</td>
			</tr>
			<tr>
				<th class="fw-bold text-center">OI</th>
				<td> '. $rowLejos['oiEsfera'].'
				</td>
				<td> '. $rowLejos['oiCilindro'].'
				</td>
				<td> '. $rowLejos['oiEje'].'
				</td>
				<td> '. $rowLejos['oiAv'].'
				</td>
				<td> '. $rowLejos['oiDip'].'
				</td>
				<td> '. $rowLejos['oiPrisma'].'
				</td>
			</tr>
			<tr>
				<th class="fw-bold text-center" rowspan="2">CERCA</th>
				<th class="fw-bold text-center">OD</th>
				<td> '. $rowCerca['oiEsfera'].'
				</td>
				<td> '. $rowCerca['odCilindro'].'
				</td>
				<td> '. $rowCerca['odEje'].'
				</td>
				<td> '. $rowCerca['odAv'].'
				</td>
				<td> '. $rowCerca['odDip'].'
				</td>
				<td> '. $rowCerca['odPrisma'].'
				</td>
			</tr>
			<tr>
				<th class="fw-bold text-center">OI</th>
				<td> '. $rowCerca['oiEsfera'].'
				</td>
				<td> '. $rowCerca['oiCilindro'].'
				</td>
				<td> '. $rowCerca['oiEje'].'
				</td>
				<td> '. $rowCerca['oiAv'].'
				</td>
				<td> '. $rowCerca['oiDip'].'
				</td>
				<td> '. $rowCerca['oiPrisma'].'
				</td>
			</tr>
	</table>
  
	<table class="tablaInvi" id="tblDatos">
		<tr>
			<td style="width: 50%;"><strong>DIAGNÓSTICO:</strong> <span><br>'.$row['diagnostico'].'</span></td>
			<td style="width: 50%;"><strong>TRATAMIENTO:</strong> <br>'.$row['tratamiento'].'</span></td>
		</tr>
	</table>
	<div id="firma">
	<span>________________________</span><br>
	<strong class="ms-3">FIRMA Y SELLO</strong>
	</div>
</body>
</html>
';

// Carga el HTML en Dompdf
$dompdf->loadHtml($html);

// Renderiza el PDF
$dompdf->render();

// Envía las cabeceras para mostrar el PDF en el navegador
header('Content-Type: application/pdf');
$dompdf->stream('Receta de lentes.pdf', ['Attachment' => 0]);
?>