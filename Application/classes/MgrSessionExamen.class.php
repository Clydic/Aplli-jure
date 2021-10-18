
<?php
     class  MgrSessionExamen 
    {
        public static function getListExam($connect)
        {	
        
            // $sql="CALL prc_LST_examen();";
            $cursor = $connect->query("CALL prc_LST_examen();");
            $cursor->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,
            'SessionExamen',
            array(
                'intituleFormation' ,
                'id',
                'date'));
            $result = $cursor->fetchAll();
            return $result;    
        }
        
        
        
    } 
?>