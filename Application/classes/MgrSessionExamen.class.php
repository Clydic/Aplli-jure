
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
                'idFormation',
                'idExamen',
                'date'));
                // Get results of the request
            $result = $cursor->fetchAll();
            return $result;    
        }

        /**
         * Call a procedure name prc_LST_examen() which is a 
         * request whic list all from since the current date
         * @param $connect a connection to a DB
         * @param $idOfSessionFormation
         * @param $$dateOfSessionExamen 
         * @return array
         */
        public static function addExamen($connect, $idOfSessionFormation, $dateOfSessionExamen)
        {	
       
            // $sql="CALL prc_ADD_examen();";
            // Initialisation
                //Get the results of the procedure called prc_ADD_examen
           $connect->query("CALL prc_ADD_examen(
                $idOfSessionFormation, 
                '$dateOfSessionExamen'
            );");
            return true;

        } 
        
        
        /**
         * Call a procedure name prc_LST_examen() which is a 
         * request whic list all from since the current date
         * @param $connect a connection to a DB
         * @param $idOfSessionFormation
         * @param $$dateOfSessionExamen 
         * @return array
         */
        public static function delExamen($connect, $idOfSessionExamen )
        {	
       
            // $sql="CALL prc_DEL_examen();";
            // Initialisation
                //Get the results of the procedure called prc_ADD_examen
           $connect->query("CALL prc_DEL_examen(
                $idOfSessionExamen

            );");
            return true;

        } 

        public static function getId($connect, $dateOfSessionExamen, $idOfSessionFormation)
        {
            $id= $connect->query("SELECT `fn_id_examen($idOfSessionFormation, $dateOfSessionExamen) as id");
            return $id;
        }
    } 
?>
