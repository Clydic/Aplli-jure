# Liste des variables, fonctions et classes
## Liste des variables
### index.php
`$action= "accueil"`

`$tabTitle` Le titre dans l'onglet

`$h1Title` Le titre principale de la page

`$connection=CRMJures::getConnection()` La variable de connection

## Liste des fonctions

## Liste des classes
### SessionExamen
* propriété
	* `private $id`
	* `private $date`
* méthode
	* `__construct(int $idExam, string $date)`
	* `getId()`
	* `getDateExamen()`
	* `setId()`
	* setDateExamen()` 
### CRMJures
* propriétés
	* `private static $connection`
* méthode
	* `private static connect()`
	* `public static disconnect()`
	* `public static getConction()`
