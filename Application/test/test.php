<?php // test/test.php 
	require("classes/CRMJures.class.php");
	require ("classes/MgrSessionExamen.class.php");
	require ("modele/modele.inc.php");
	$examen1 = new SessionExamen("DWWM",2,1,"2019-03-02");
	$connection = CRMJures::getConnection();
	echo $examen1;	
	$examen1->setIdExamen(3);
	echo $examen1;	
	// var_dump($examen1->getIntituleFormation());
	// var_dump( MgrSessionExamen::getListExam($connection));
	// $list= getListExam($connection);
	// echo ($list);
	// addExamen($connection,  11, '23/07/2022');
	$ajout = addExamen($connection,  1, '2023-02-13');
	$ajout1 = addExamen($connection,  1, '2022-02-16');
	$del = delExamen($connection,  52);
	$del1 = delExamen($connection,  53);
	// echo $list;	
	echo $ajout . "\n";
	echo $ajout1. "\n";
	echo $del. "\n";
	echo $del1. "\n";
	$message="";
	$test= MgrSessionExamen::getListExam($connection);
	// $line = $test[6];
	// echo $line->getIDExamen();
	foreach($test as $line):
		var_dump($line);
		$message.= '\n'.$line->getIdExamen()  ;
		// echo "id examen :";
		// var_dump($line->getIdExamen());
	endforeach;
	echo $message;
?>
