<?php 

class partenaire {
    public $nom="";
    public $prénom="";
    public $NomPartenaire="";
    public $typePartenaire="";
    public $mail="";
    public $telephone= 0625698654;
    protected $compte;
    private $identifiant = 0;

    public function créeEvenement($evenement)
    {
        
    }
    public function participeEvenement($evenement) 
    {
        
    }

}

class evenement {

    public $nom="";
    public $description="";
    public $date=12/12/24;
    public $statut="";

    protected $typeEvenement;

    private $identifiant=0;


}

class typeEvenement extends evenement
{
    public $nom="";
}

class compte {
    public $identifiant="";
    public $motDePasse="";
    public $role="";


    public function SeConnecter()
{
    
}
}