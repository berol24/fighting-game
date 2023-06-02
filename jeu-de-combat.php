<!DOCTYPE html>
<html>
<head>
    <title>Jeu de personnages</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        .message {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .action {
            margin-top: 20px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 3px;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Jeu de personnages</h1>

    <div class="message">
        <?php
        // Étape 1: Définition de la classe de base "Personnage"
        class Personnage {
            protected $nom;
            protected $pointsDeVie;
            protected $attaque;
            protected $defense;

            // Étape 2: Constructeur de la classe "Personnage"
            public function __construct($nom, $pointsDeVie, $attaque, $defense) {
                $this->nom = $nom;
                $this->pointsDeVie = $pointsDeVie;
                $this->attaque = $attaque;
                $this->defense = $defense;
            }

            // Étape 3: Méthodes pour récupérer et modifier le nom et les points de vie du personnage
            public function getNom() {
                return $this->nom;
            }

            public function getPointsDeVie() {
                return $this->pointsDeVie;
            }

            public function setPointsDeVie($points) {
                $this->pointsDeVie = $points;
            }

            public function attaquer($adversaire) {

                $degats = max(0, $this->attaque - $adversaire->defense);

                $adversaire->setPointsDeVie($adversaire->getPointsDeVie() - $degats);

                echo $this->nom . " attaque " . $adversaire->getNom() . " et lui inflige " . $degats . " points de dégâts.<br>";
            }
        }


        class Guerrier extends Personnage {

            public function __construct($nom) {

                parent::__construct($nom, 100, rand(20, 40), rand(10, 19));
            }
        }


        class Magicien extends Personnage {
            private $peutEndormir = true;
            private $dernierEndormissement = 0;


            public function __construct($nom) {

                parent::__construct($nom, 100, rand(5, 10), 0);
            }


            public function peutEndormir() {

                $tempsEcoule = time() - $this->dernierEndormissement;

                return $tempsEcoule >= 120;
            }


            public function endormir($adversaire) {
                if ($this->peutEndormir()) {

                    $adversaire->setPointsDeVie(0);

                    $this->dernierEndormissement = time();

                    echo $this->nom . " endort " . $adversaire->getNom() . " pendant 15 secondes.<br>";
                } else {
                    echo "Le pouvoir d'endormissement n'est pas encore rechargé.<br>";
                }
            }


            public function attaquer($adversaire) {

                parent::attaquer($adversaire);

                if ($this->peutEndormir()) {

                    $this->endormir($adversaire);
                }
            }
        }


        $guerrier = new Guerrier("Conan");
        $magicien = new Magicien("Gandalf");

        $guerrier->attaquer($magicien);
        $magicien->attaquer($guerrier);
        ?>
    </div>

    <div class="action">
        <a href="#" class="button">Attaquer</a>
    </div>
</div>
</body>
</html>
