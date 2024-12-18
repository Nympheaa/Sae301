<?php 

class partenaire {
    public $NomPartenaire="";
    public $typePartenaire="";
    public $mail="";
    public $telephone= 0;
    protected $compte; // C'est pour la clé etrangère//


    public function __construct($nom, $type, $mail, $telephone, $compte) {
        $this->NomPartenaire = $nom;
        $this->typePartenaire = $type;
        $this->mail = $mail;
        $this->telephone = $telephone;
        $this->compte = $compte;
    }

    public function créeEvenement($evenement): void {
        echo "L'événement " . $evenement . " a été créé par " . $this->NomPartenaire . ".\n";
    }

    public function participeEvenement($evenement): void {
        echo $this->NomPartenaire . " participe à l'événement " . $evenement . ".\n";
    }

    public function afficherDetailsPartenaire(): void {
        echo "Nom: " . $this->NomPartenaire . ", Type: " . $this->typePartenaire . "\n";
    }

    public function modifierPartenaire(): void {
        echo "Modification des informations du partenaire.\n";
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