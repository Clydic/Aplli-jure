<?php

class CRMJures {
	// statiques variables 
	private static $connection;

	// no  explicite constructor 

	//   connection function to DB
    private static function connect() {
        $TCONFIG = parse_ini_file("config/settings.ini");
        $host = $TCONFIG['host'];
        $port = $TCONFIG['port'];
        $bdd = $TCONFIG['bdd'];
        $user =$TCONFIG['user'];
        $password =$TCONFIG['password'];

		$dsn = "mysql:host=".$host."; port=".$port."; dbname=".$bdd."; charset=utf8";
		try {
			$mysqlPDO = new PDO($dsn, $user, $password,
							array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		} catch(Exception $e) { 
			// If there is an error the function will stop completely 
			die('<h1>Erreur de connexion : </h1>' . $e->getMessage());
		}
		
		CRMJures::$connection = $mysqlPDO;
		
		return CRMJures::$connection;
	}

	// deconnection function of DB
 static function disconnect(){
        CRMJures::$connection = null;
    }

    // Pattern singleton
    public static function getConnection() {
        if (CRMJures ::$connection != null) {
            return CRMJures ::$connection;
        } else {
            return CRMJures ::connect();
        }
    }
}

?>
