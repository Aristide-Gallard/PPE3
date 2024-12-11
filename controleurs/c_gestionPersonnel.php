<?php
$action = $_REQUEST['action'];

switch ($action) {
    case 'voirPersonnel': {
        $LesPersonnelsC = $pdo->getlesPersonnelsC();
        $LesPersonnelsT = $pdo->getlesPersonnelsT();
        include("vues/v_Personnel.php");
        break;
    }

    case 'creationPersonnelC': {
        $langues = $pdo->getLangues();
        include("vues/v_creerPersonnelCommercial.php");
        break;
    }

    case 'confirmCreatPersonnelC': {
        $tel = $_POST['tel'] ?? null;
        $id_LANGUE = $_POST['langue'] ?? null;

        if ($tel && $id_LANGUE) {
            $pdo->creerPersonnelC($tel, $id_LANGUE);
        }

        $LesPersonnelsC = $pdo->getlesPersonnelsC();
        $LesPersonnelsT = $pdo->getlesPersonnelsT();
        include("vues/v_Personnel.php");
        break;
    }

    case 'creationPersonnelT': {
        include("vues/v_creerPersonnelTechnique.php");
        break;
    }

    case 'confirmCreatPersonnelT': {
        $tel = $_POST['tel'] ?? null;
        $heureV = $_POST['heureV'] ?? null;

        if ($tel && $heureV) {
            $pdo->creerPersonnelT($tel, $heureV);
        }

        $LesPersonnelsC = $pdo->getlesPersonnelsC();
        $LesPersonnelsT = $pdo->getlesPersonnelsT();
        include("vues/v_Personnel.php");
        break;
    }

    case 'modificationPersonnelC': {
        $num = $_REQUEST['num'] ?? null;

        if ($num) {
            $LesPersonnels = $pdo->getlePersonnelC($num);
            $languesParlees = $pdo->getLanguesParPersonnel($num);
            $toutesLangues = $pdo->getToutesLesLangues();
            include("vues/v_modificationPersonnelCom.php");
        }
        break;
    }

    case 'confirmModifPersonnelC': {
        $num = $_POST['num'] ?? null;
        $tel = $_POST['tel'] ?? null;
        $langues = $_POST['langue'] ?? [];

        if ($num && $tel) {
            $pdo->modificationPersonnelC($tel, $num, $langues);
        }

        $LesPersonnelsC = $pdo->getlesPersonnelsC();
        $LesPersonnelsT = $pdo->getlesPersonnelsT();
        include("vues/v_Personnel.php");
        break;
    }

    case 'modificationPersonnelT': {
        $num = $_REQUEST['num'] ?? null;

        if ($num) {
            $LesPersonnels = $pdo->getlePersonnel($num);
            include("vues/v_modificationPersonnelTec.php");
        }
        break;
    }

    case 'confirmModifPersonnelT': {
        $num = $_POST['num'] ?? null;
        $tel = $_POST['tel'] ?? null;
        $heureV = $_REQUEST['heureV'] ?? null;

        if ($num && $tel && $heureV) {
            $pdo->modificationPersonnelT($tel, $num, $heureV);
        }

        $LesPersonnelsC = $pdo->getlesPersonnelsC();
        $LesPersonnelsT = $pdo->getlesPersonnelsT();
        include("vues/v_Personnel.php");
        break;
    }

    case 'supressionPersonnelC': {
        $num = $_REQUEST['num'] ?? null;

        if ($num) {
            $typeP = "C";
            $LesPersonnels = $pdo->getlePersonnel($num);
            include("vues/v_SupprPersonnel.php");
        }
        break;
    }

    case 'confirmSupprPersonnelC': {
        $num = $_REQUEST['num'] ?? null;

        if ($num) {
            $pdo->supressionPersonnelC($num);
        }

        $LesPersonnelsC = $pdo->getlesPersonnelsC();
        $LesPersonnelsT = $pdo->getlesPersonnelsT();
        include("vues/v_Personnel.php");
        break;
    }

    case 'supressionPersonnelT': {
        $num = $_REQUEST['num'] ?? null;

        if ($num) {
            $typeP = "T";
            $LesPersonnels = $pdo->getlePersonnel($num);
            include("vues/v_SupprPersonnel.php");
        }
        break;
    }

    case 'confirmSupprPersonnelT': {
        $num = $_REQUEST['num'] ?? null;

        if ($num) {
            $pdo->supressionPersonnelT($num);
        }

        $LesPersonnelsC = $pdo->getlesPersonnelsC();
        $LesPersonnelsT = $pdo->getlesPersonnelsT();
        include("vues/v_Personnel.php");
        break;
    }

    case 'ajouterLangue': {
        $num = $_POST['num'] ?? null;
        $tel = $_POST['tel'] ?? null;
        $langues = $_POST['langues'] ?? [];

        if ($num && $tel) {
            $pdo->modificationPersonnelC($tel, $num, $langues);
        }

        $LesPersonnelsC = $pdo->getlesPersonnelsC();
        $LesPersonnelsT = $pdo->getlesPersonnelsT();
        include("vues/v_Personnel.php");
        break;
    }
}

?>