<?php

class CRMJures {
	// variables statiques
	private static $connection;

	// Pas de constructeur explicite

	// fonction de connection à la BDD
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
			// en cas erreur on affiche un message et on arrete tout
			die('<h1>Erreur de connexion : </h1>' . $e->getMessage());
		}
		
		CRMJures::$connection = $mysqlPDO;
		echo "Connexion établi <br/>";
		
		return CRMJures::$connection;
	}

	// fonction de 'déconnection' de la BDD
    public static function disconnect(){
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
