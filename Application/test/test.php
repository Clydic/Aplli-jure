<?php // test/test.php 
	require("classes/CRMJure.class.php");
	require ("classes/SessionExamen.class.php");
	require ("classes/MgrSessionExamen.class.php");
	$examen1 = new SessionExamen("DWWM",2,"2019-03-02");
	$connection =CRMJures::getConnection();
	echo $examen1;	
	var_dump($examen1->getIntituleFormation());
	var_dump( MgrSessionExamen::getListExam($connection));
?>
