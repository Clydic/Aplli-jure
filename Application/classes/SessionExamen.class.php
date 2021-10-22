<?php // classes/SessionExamen.class.php
	class SessionExamen
	{
		// --------------------------------------------------------------------------
		// |                              Properties                                |
		// --------------------------------------------------------------------------
		/*
		 *The property $IDSessionFormation is the Id of SessionExamen
		 *The property $DateSessionExam is the DateSessionExam of SessionExamen
		 *
		 * */
		private $Intitule_de_formation;
		private $IDSessionFormation;
		private $IDSessionExamen;
		private $DateSessionExam;

		// --------------------------------------------------------------------------
		// |                              Constructor                               |
		// --------------------------------------------------------------------------

		/*We construct the object SessionExamen
		 *@param int $IDSessionFormationExamen
		 *@param int $DateSessionExam
		 * */
		public function __construct(string $Intitule_de_formation,   $IDSessionExamen,  $IDSessionFormation, string $DateSession)
		{
			$this->setIdFormation($IDSessionFormation);
			$this->setIdExamen($IDSessionExamen);
			$this->setDateExamen($DateSession);
			$this->setIntiTuleFormation($Intitule_de_formation);
			
			echo "L'examen est bien créé\n";
			
		} 

		// --------------------------------------------------------------------------
		// |                              Getter                                    |
		// --------------------------------------------------------------------------


		/* Get the IDSessionFormation
		 * @return int
		 **/
		public function getIdFormation() {return $this->IDSessionFormation;}

		/* Get the IDSessionExamen
		 * @return int
		 **/
		public function getIdExamen() {return $this->IDSessionExamen;}


		/* Get the DateSessionExam of Examen
		 * @return int
		 */
		public function getDateExamen() {return $this->DateSessionExam; }


		/* Get the intitule of of formation.
		 * @return int
		 */
		public function getIntituleFormation() {return $this->Intitule_de_formation; }


		// --------------------------------------------------------------------------
		// |                              Setter                                    |
		// --------------------------------------------------------------------------

		/*
		 *Set the IDSessionFormation of SessionExamen it is private
		 *@param int $IDSessionFormationToSet
		 * */
		private function setIdFormation( $IDSessionFormationToSet)
		{
			$this->IDSessionFormation=$IDSessionFormationToSet;
		}


		/*
		 *Set the IDSessionFormation of SessionExamen it is private
		 *@param int $IDSessionFormationToSet
		 * */
		public function setIdExamen( $IDSessionExamenToSet)
		{
			$this->IDSessionExamen=$IDSessionExamenToSet;
		}


		
		/*
		 *Set the DateSessionExam of SessionExamen it is public
		 *@param int $DateSessionExamToSet
		 * */
		public function setDateExamen(string $DateSessionExamToSet)
		{	
			$exp="/^\d{4}\-\d{2}\-\d{2}/";
			if(preg_match($exp,$DateSessionExamToSet))
			{
				$this->DateSessionExam=$DateSessionExamToSet;
			}			
			return "La DateSessionExam doit être au format aaaa-mm-jj";
		}

		
		/*
		 *Set the intitle of Formation of SessionExamen it is private
		 *@param int $intituleToSet
		 * */
		private function setIntituleFormation(string $intituleToSet)
		{
			$this->Intitule_de_formation=$intituleToSet;
		}



		// --------------------------------------------------------------------------
		// |                           Other Methods                                |
		// --------------------------------------------------------------------------


		public function __toString() :string
		{	$msg = "";
			$msg = "L'intitule de la formation est : ". $this->getIntituleFormation().
			" L'IDSessionFormation de cette session d'examen est " . 
				$this->getIdFormation() .
				" L'IDSessionExamen est le numéro : " . $this->getIdExamen().
				" et sa DateSessionExam est le " . $this->getDateExamen() 
				."<br/>\n"; 
			return $msg;
		}
	}
?>
