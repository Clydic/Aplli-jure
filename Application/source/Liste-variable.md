# Liste des variables, fonctions et classes
## Liste des variables
### index.php
`$action= "accueil"`

`$tabTitle` Le titre dans l'onglet

`$h1Title` Le titre principale de la page

`$connection=CRMJures::getConnection()` La variable de connection

`$message = "";`  Varibales des messages d'inforamtion de crud

`$href="";` Variable pour modifier certain lien hypertexte

`$textLink="";`  Le texte des liens hyper texte	

`$logo="source/index.png";`

## Liste des fonctions du modele
* `getListExam()`
* `getConnectAdmin()`
* `getConnectForm()`
* `getListFormateur()`
* `getFormateurById()`
* `getListFormation()`
* `getInfoFormatByID()`
* `delFormateur()`
* `addFormateur()`
* `updateInfoFormateur()`
* `getListSessionFormation()`
* `addExamen()`

## Liste des classes
### SessionExamen
* propriété
	* `private $Intitule_de_formation;`
	* `private $IDSessionFormation;`
	* `private $DateSessionExam;`
* méthode
	* `public __construct(int $idExam, string $date)`
	* `public getId()`
	* `public getDateExamen()`
	* `public setId()`
	* `public setDateExamen()` 
	* `public setIntituleFormation()` 
### CRMJures
* propriétés
	* `private static $connection`
* méthode
	* `private static connect()`
	* `public static disconnect()`
	* `public static getConction()`

### MgrSessionExamen
* propriétés
* méthodes
	* `public static getListExam()` 
	* `public static addExamen()` 
