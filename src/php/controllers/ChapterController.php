<?php

// controllers/ChapterController.php

require_once 'src/php/models/Chapter.php';
require_once 'src/php/config.php';

class ChapterController
{
    private $chapters = [];

    public function __construct()
    {
        // Exemple de chapitres avec des images
        $this->chapters[] = new Chapter(
            1,
            "La Forêt Enchantée",
            "Vous vous trouvez dans une forêt sombre et enchantée. Deux chemins se présentent à vous.",
            "images/forêt.jpg", // Chemin vers l'image
            [
                ["text" => "Aller à gauche", "chapter" => 2],
                ["text" => "Aller à droite", "chapter" => 3]
            ]
        );

        $this->chapters[] = new Chapter(
            2,
            "Le Lac Mystérieux",
            "Vous arrivez à un lac aux eaux limpides. Une créature vous observe.",
            "images/lac.jpg", // Chemin vers l'image
            [
                ["text" => "Nager dans le lac", "chapter" => 4],
                ["text" => "Faire demi-tour", "chapter" => 1]
            ]
        );

    }

    public function loadChaptersFromDB()
    {
        global $pdo;
        $sql = "SELECT * FROM DUN_CHAPTER JOIN DUN_ADVENTURE USING (ADV_ID)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $chapter = new Chapter(
                $row['CHA_ID'], // l'ID du chapitre
                $row['ADV_LIBELLE'], // titre du chapitre
                $row['CHA_CONTENT'], // contenu du chapitre
                $this->loadChoices($row['CHA_ID']) // choix du chapitre
            );

            $imageName = "img_" . $row['ADV_ID'] . "_" . $row['CHA_ID'] . ".png"; // recup le nom de l'image

            $this->chapters[] = $chapter;
        }
    }

    public function loadChoices($chapterID){
        global $pdo;
        $sql = "SELECT * FROM DUN_LINKS JOIN DUN_CHAPTER USING (LIN_ID) WHERE CHA_ID = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$chapterID]);

        $choices = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $choices[] = [
                'test' => $row['LN_DESCRIPTION'], //le texte du choix
                'chapter' => $row['LN_NEXT_CHAPTER'] //l'id du chapitre suivant
            ];
        }
        return $choices;
    }

    public function show($id)
    {
        $chapter = $this->getChapter($id);

        if ($chapter) {
            include 'src/php/view/chapter_view.php'; // Charge la vue pour le chapitre
        } else {
            // Si le chapitre n'existe pas, redirige vers un chapitre par défaut ou affiche une erreur
            header('HTTP/1.0 404 Not Found');
            echo "Chapitre non trouvé!";
        }
    }

    public function getChapter($id)
    {
        foreach ($this->chapters as $chapter) {
            if ($chapter->getId() == $id) {
                return $chapter;
            }
        }
        return null; // Chapitre non trouvé
    }
}
