
<?php
    class MgrSessionExamen 
        {
        public static function getListExam($connect)
        {	
            $sql="call prc_LST_examen();";
            $cursor = $connect->query($sql);
            $result = $cursor->fetchAll();
            
            $message = "";
            foreach($result as $line)
            {
                $message.="<tr><td>".$line["Intitule_de_formation"].
                    $line["IDSessionFormation"]."</td>";
                $message.="<td>".$line["DateSessionExam"]."</td>".
                    "<td>
                        <a href=\"\"><i class=\"fas fa-info-circle\"></i></a>
                    </td>
                    <td>
                        <a href=\"\"><i class=\"fas fa-minus-circle bg-danger\">
                        </i></a>
                    
                    </td>";
                
            }
            return $message;	
        }
    }
?>