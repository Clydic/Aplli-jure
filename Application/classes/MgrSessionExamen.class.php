
<?php //classes/MgrSessionExame.class.php
     class  MgrSessionExamen 
    {
        /**
         * Call a procedure name prc_LST_examen() which is a 
         * request whic list all from since the current date
         * @param $connect a connection to a DB
         * @return array
         */
        public static function getListExam($connect)
        {	
        
            // $sql="CALL prc_LST_examen();";
            // Initialisation
                //Get the results of the procedure called prc_LST_examen
            $cursor = $connect->query("CALL prc_LST_examen();");
                // Change the fetch mode
            $cursor->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,
            'SessionExamen',
            array(
                'intituleFormation' ,
                'id',
                'date'));
                // Get results of the request
            $result = $cursor->fetchAll();
            return $result;    
        }
        
        
        
    } 
?>
