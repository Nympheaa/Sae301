<?php
include("config/config.php");
$bdd = new PDO('mysql:host=' . $hote . ';port=' . $port . ';dbname=' . $nom_bd, $identifiant, $mot_de_passe, $options);

class partenaire
{
    public $NomPartenaire = "";
    public $typePartenaire = "";
    public $mail = "";
    public $telephone = 0;
    public $numeroSiren = 0;
    public $compte = "";
    public $Id_partenaire = "";

    public function __construct($nom, $type, $mail, $telephone, $numeroSiren, $compte)
    {
        $this->NomPartenaire = $nom;
        $this->typePartenaire = $type;
        $this->mail = $mail;
        $this->telephone = $telephone;
        $this->numeroSiren = $numeroSiren;
        $this->compte = $compte;


    }

    public function listerEvenement($bdd): array
    {
        $evenements = [];
        $requete = "SELECT evenement.Nom, evenement.Description, evenement.Date, evenement.Statut, typeevenement.Nom as eventNom
        FROM evenement 
        INNER JOIN participe ON evenement.id_Evenement = participe.Id_Evenement 
        INNER JOIN  typeevenement ON evenement.Id_typeEvenement = typeevenement.Id_typeEvenement
        WHERE participe.Id_Partenaire='$this->Id_partenaire'";

        $resultats = $bdd->query($requete);
        foreach ($resultats->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $event = new evenement($row['Nom'], $row['Description'], $row['Date'], $row['Statut'], $row['eventNom']);
            array_push($evenements, $event);
        }
        return $evenements;
    }

    public function initialiserPartenaire($bdd, $Id_compte): void
    {
        $requete = "SELECT * FROM partenaire WHERE Id_compte='$Id_compte'";
        $resultats = $bdd->query($requete);
        $res = $resultats->fetch(PDO::FETCH_ASSOC);
        $this->NomPartenaire = $res['NomPartenaire'];
        $this->typePartenaire = $res['TypePartenaire'];
        $this->mail = $res['Mail'];
        $this->telephone = $res['Telephone'];
        $this->numeroSiren = $res['NumeroSiren'];
        $this->Id_partenaire = $res['Id_partenaire'];

    }



    public function enregistrerCreation($bdd): void
    {
        $this->compte->enregistrerCreationCompte($bdd);
        $requete_preparee = $bdd->prepare('INSERT INTO partenaire (NomPartenaire,TypePartenaire,Mail,Telephone,Id_compte,NumeroSiren) VALUES (:NomPartenaire,:TypePartenaire,:Mail,:Telephone,:Id_compte,:NumeroSiren)');
        $requete_preparee->bindValue(':NomPartenaire', $this->NomPartenaire, PDO::PARAM_STR);
        $requete_preparee->bindValue(':TypePartenaire', $this->typePartenaire, PDO::PARAM_STR);
        $requete_preparee->bindValue(':Mail', $this->mail, PDO::PARAM_STR);
        $requete_preparee->bindValue(':Telephone', $this->telephone, PDO::PARAM_STR);
        $requete_preparee->bindValue(':Id_compte', $bdd->lastInsertId(), PDO::PARAM_INT);
        $requete_preparee->bindValue(':NumeroSiren', $this->numeroSiren, PDO::PARAM_STR);
        $res = $requete_preparee->execute();

    }



}



class evenement
{
    public $nom = "";
    public $description = "";
    public $date = 0;
    public $statut = "";
    public $Id_typeEvenement;
    public $Id_compte;



    public function __construct($nom, $description, $date, $statut, $Id_typeEvenement)
    {
        $this->nom = $nom;
        $this->description = $description;
        $this->date = $date;
        $this->statut = $statut;
        $this->Id_typeEvenement = $Id_typeEvenement;
    }

    public function enregistrerEvenement($bdd): void

    {
        // $requete 'SELECT * FROM typeevenement WHERE Nom='.$this->typeEvenement
        $requete_preparee = $bdd->prepare('INSERT INTO evenement (Nom,Description,Date,Statut,Id_typeEvenement,) VALUES (:Nom,:Description,:Date,:Statut,:Id_TypeEvenement)');
        $requete_preparee->bindValue(':Nom', $this->nom, PDO::PARAM_STR);
        $requete_preparee->bindValue(':Description', $this->description, PDO::PARAM_STR);
        $requete_preparee->bindValue(':Date', $this->date, PDO::PARAM_STR);
        $requete_preparee->bindValue(':Statut', $this->statut, PDO::PARAM_STR);
        $requete_preparee->bindValue(':Id_typeEvenement', $bdd->lastInsertId(), PDO::PARAM_INT);
        $res = $requete_preparee->execute();
        if ($res) {
            echo "L'événement a été ajouté avec succès.";
        } else {
            echo "Erreur lors de l'ajout de l'événement.";
        }
    }   
}


class Compte
{
    public $identifiant = "";
    public $motDePasse = "";
    public $role = "";
    public $nom = "";
    public $prenom = "";

    public function __construct($id, $mdp, $role, $nom, $prenom)
    {
        $this->identifiant = $id;
        $this->motDePasse = $mdp;
        $this->role = $role;
        $this->nom = $nom;
        $this->prenom = $prenom;
    }

    public function seConnecter($bdd): bool
    {

        $requete = "SELECT * FROM compte WHERE identifiant=  '$this->identifiant'   AND MotDePasse= '$this->motDePasse'";
        $resultats = $bdd->query($requete);


        if ($resultats->rowCount() == 0) {
            return 0;

        } else {
            $res = $resultats->fetch(PDO::FETCH_ASSOC);
            $this->role = $res['Role'];
            $this->nom = $res['Nom'];
            $this->prenom = $res['Prenom'];
            return $res['Id_compte'];

        }

    }


    public function enregistrerCreationCompte($bdd)
    {
        $requete_preparee = $bdd->prepare('INSERT INTO compte (MotDePasse,Role,Prenom,Nom,Identifiant) VALUES (:MotDePasse,:Role,:Prenom,:Nom,:Identifiant)');
        $requete_preparee->bindValue(':MotDePasse', $this->motDePasse, PDO::PARAM_STR);
        $requete_preparee->bindValue(':Role', $this->role, PDO::PARAM_STR);
        $requete_preparee->bindValue(':Prenom', $this->prenom, PDO::PARAM_STR);
        $requete_preparee->bindValue(':Nom', $this->nom, PDO::PARAM_STR);
        $requete_preparee->bindValue(':Identifiant', $this->identifiant, PDO::PARAM_STR);
        $res = $requete_preparee->execute();
        var_dump($bdd->lastInsertId());

        echo $res;

    }
}
