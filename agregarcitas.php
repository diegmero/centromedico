<?php session_start();
if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}

if($_SERVER['REQUEST_METHOD']=='POST'){

	$citfecha = $_POST['citfecha'];
	$cithora = $_POST['cithora'];
	$citPaciente =  $_POST['citPaciente'];
	$citMedico =  $_POST['citMedico'];
	$citEspecialidad = $_POST['citEspecialidad'];
	$citConsultorio =  $_POST['citConsultorio'];
	$citestado =  $_POST['citestado'];
	$citobservaciones =  $_POST['citobservaciones'];
	$mensaje='';

	if(empty($citfecha) or empty($cithora)  or empty($citConsultorio) or empty($citPaciente) or empty($citestado)or empty($citMedico)){
		$mensaje.= 'Por favor rellena todos los datos correctamente'."<br />";
	}
	else{	
		try{
			$conexion = new PDO('mysql:host=localhost;dbname=centromedico','root','');
		}catch(PDOException $e){
			echo "Error: ". $e->getMessage();
			die();
		}
	}
	if($mensaje==''){
		$statement = $conexion->prepare(
			'INSERT INTO citas 
			(citfecha, cithora, citPaciente, citMedico, citEspecialidad, citConsultorio, citestado, citobservaciones)
			VALUES
			(:citfecha, :cithora, :citPaciente, :citMedico, :citEspecialidad, :citConsultorio, :citestado, :citobservaciones)'
		);

		$statement->execute(array(
			':citfecha'         => $citfecha,
			':cithora'          => $cithora,
			':citPaciente'      => $citPaciente,
			':citMedico'        => $citMedico,
			':citEspecialidad'  => $citEspecialidad,
			':citConsultorio'   => $citConsultorio,
			':citestado'        => $citestado,
			':citobservaciones' => $citobservaciones
		));

		header('Location: citas.php');
	}

}
require 'vista/agregarcitas_vista.php';
?>
