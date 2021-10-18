<?php // classes/SessionExamen.class.php
	class Utilisateur
	{
		// --------------------------------------------------------------------------
		// |                              Properties                                |
		// --------------------------------------------------------------------------
		/*
		 *The property $id is the Id of SessionExamen
		 *The property $date is the date of SessionExamen
		 *
		 * */
		private  $user;
		private $password;
        private $typeUser;

		// --------------------------------------------------------------------------
		// |                              Constructor                               |
		// --------------------------------------------------------------------------

		/*We construct the object SessionExamen
		 *@param int $idExamen
		 *@param int $date
		 * */
		public function __construct(string $utilisateur, string $motdepasse, string $type)
		{
			$this->setUser($utilisateur);
			$this->setPassword($motdepasse);
            $this->setTypeUser($type);

			echo "L'examen est bien créé\n";
			
		} 

		// --------------------------------------------------------------------------
		// |                              Getter                                    |
		// --------------------------------------------------------------------------


		/* Get the user
		 * @return string
		 **/
		public function getUser() {return $this->user;}

		/* Get the password
		 * @return string
		 */
		public function getPassword() {return $this->password; }

        /* Get the type
		 * @return string
		 */
		public function getTypeUser() {return $this->typeUser; }


		// --------------------------------------------------------------------------
		// |                              Setter                                    |
		// --------------------------------------------------------------------------

		/*
		 *Set the id of User it is private
		 *@param int $idToSet
		 * */
		private function setUser(string $userToSet)
		{
			$this->id=$userToSet;
		}

        /*
		 *Set the id of Password it is private
		 *@param int $idToSet
		 * */
        private function setPassword(string $passwordToSet)
		{
			$this->id=$passwordToSet;
		}

        /*
		 *Set the id of TypeUser it is private
		 *@param int $idToSet
		 * */
        private function setTypeUser(string $typeToSet)
		{
			$this->id=$typeToSet;
		}
		

		// --------------------------------------------------------------------------
		// |                           Other Methods                                |
		// --------------------------------------------------------------------------


		public function __toString() : string
		{	$msg = "";
			$msg = "L'identifiant de cet utilisateur est " . 
				$this->getUser() . " et son mot de passe est " . $this->getPassword() 
				."<br/>\n"; 
			return $msg;
		}
	}
?>
