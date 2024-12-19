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
    public $date=0;
    public $statut="";
    public $type = "";
    protected $typeEvenement; //la clé etrangere
    protected $compte; //la clé etrangere 
    private $participants = []; // liasion je pense ? (chatGPT)


    public function __construct($nom, $description, $date, $statut, $type, $typeEvenement, $compte) {
        $this->nom = $nom;
        $this->description = $description;
        $this->date = $date;
        $this->statut = $statut;
        $this->type = $type;
        $this->typeEvenement = $typeEvenement;
        $this->compte = $compte;
    }

    public function ajouterPartenaire($partenaire): void {
        $this->participants[] = $partenaire;
        echo "Partenaire ajouté: " . $partenaire->NomPartenaire . "\n";
    }

    public function supprimerPartenaire($partenaire): void {
        foreach ($this->participants as $key => $p) {
            if ($p === $partenaire) {
                unset($this->participants[$key]);
                echo "Partenaire supprimé: " . $partenaire->NomPartenaire . "\n";
            }
        }
    }

    public function modifierEvenement(): void {
        echo "L'événement " . $this->nom . " a été modifié.\n";
    }

    public function afficherDetailsEvenement(): void {
        echo "Nom: " . $this->nom . ", Description: " . $this->description . "\n";
    }

    public function listerParticipants(): void {
        foreach ($this->participants as $partenaire) {
            echo "Participant: " . $partenaire->NomPartenaire . "\n";
        }
    }

}

class Compte {
    public $identifiant = "";
    public $motDePasse = "";
    public $role = "";
    public $nom = "";
    public $prenom = "";

    public function __construct($id, $mdp, $role, $nom, $prenom) {
        $this->identifiant = $id;
        $this->motDePasse = $mdp;
        $this->role = $role;
        $this->nom = $nom;
        $this->prenom = $prenom;
    }

    public function seConnecter(): void {
        echo $this->nom . " s'est connecté.\n";
    }

    public function modifierCompte(): void {
        echo "Le compte de " . $this->nom . " a été modifié.\n";
    }

    public function supprimerEvenement($evenement): void {
        echo "L'événement " . $evenement->nom . " a été supprimé.\n";
    }

    public function creerEvenement($evenement): void {
        echo "Création d'un événement: " . $evenement->nom . "\n";
    }

    public function gererEvenement($evenement): void {
        echo "Gestion de l'événement: " . $evenement->nom . "\n";
    }

    public function afficherDetailsCompte(): void {
        echo "Identifiant: " . $this->identifiant . ", Nom: " . $this->nom . ", Rôle: " . $this->role . "\n";
    }
}

class TypeEvenement {
    public $nom = "";

    public function __construct($nom) {
        $this->nom = $nom;
    }

    public function afficherTypeEvenement(): void {
        echo "Type d'événement: " . $this->nom . "\n";
    }

    public function modifierTypeEvenement($nouveauNom): void {
        $this->nom = $nouveauNom;
        echo "Le type d'événement a été modifié en: " . $this->nom . "\n";
    }
}