<?php // classes/SessionExamen.class.php
	class SessionExamen
	{
		// --------------------------------------------------------------------------
		// |                              Properties                                |
		// --------------------------------------------------------------------------
		/*
		 *The property $id is the Id of SessionExamen
		 *The property $date is the date of SessionExamen
		 *
		 * */
		private  $id;
		private $date;

		// --------------------------------------------------------------------------
		// |                              Constructor                               |
		// --------------------------------------------------------------------------

		/*We construct the object SessionExamen
		 *@param int $idExamen
		 *@param int $date
		 * */
		public function __construct(int $idExam, string $dateExam)
		{
			$this->setId($idExam);
			$this->setDateExamen($dateExam);
			echo "L'examen est bien créé\n";
			
		} 

		// --------------------------------------------------------------------------
		// |                              Getter                                    |
		// --------------------------------------------------------------------------


		/* Get the id
		 * @return int
		 **/
		public function getId() {return $this->id;}

		/* Get the date of Examen
		 * @return int
		 */
		public function getDateExamen() {return $this->date; }


		// --------------------------------------------------------------------------
		// |                              Setter                                    |
		// --------------------------------------------------------------------------

		/*
		 *Set the id of SessionExamen it is private
		 *@param int $idToSet
		 * */
		private function setId(int $idToSet)
		{
			$this->id=$idToSet;
		}


		/*
		 *Set the date of SessionExamen it is public
		 *@param int $dateToSet
		 * */
		public function setDateExamen(string $dateToSet)
		{	
			$exp="/^\d{4}\-\d{2}\-\d{2}/";
			if(preg_match($exp,$dateToSet))
			{
				$this->date=$dateToSet;
			}			
			return "La date doit être au format aaaa-mm-jj";
		}

		



		// --------------------------------------------------------------------------
		// |                           Other Methods                                |
		// --------------------------------------------------------------------------


		public function __toString() :string
		{	$msg = "";
			$msg = "L'identifian de cette session d'examen est " . 
				$this->getId() . " et sa date est le " . $this->getDateExamen() 
				."<br/>\n"; 
			return $msg;
		}
	}
?>
