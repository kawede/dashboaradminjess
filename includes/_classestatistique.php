<?php
  /**
    * 
    */
   class Statistique
   {
   	private $DB;
   	function __construct($db)
   	{
   		   	$this->DB=$db;
    }

    function statEleve(){
    $mysqwery=$this->DB->prepare('SELECT COUNT(*) as nb FROM _eleve');
    $mysqwery->execute();
     $nb= $mysqwery->fetchAll(PDO::FETCH_OBJ);
     return $nb[0]->nb;
   }
   function countAll($sexe=''){
     $mysqwery=$this->DB->prepare('SELECT COUNT(*) as nb FROM _eleve WHERE _sexe=:sexe');
     $mysqwery->execute(array(
     	'sexe'=>$sexe
     ));
    $nb= $mysqwery->fetchAll(PDO::FETCH_OBJ);
     return $nb[0]->nb;

   }
   } 
 
?>