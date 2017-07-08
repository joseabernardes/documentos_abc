<?php
require_once __DIR__ . '/../partials/_init.php';
require_once Config::getApplicationManagerPath() . 'AlertManager.php';
require_once Config::getApplicationManagerPath() . 'UserManager.php';
require_once Config::getApplicationManagerPath() . 'DocumentManager.php';
$pageTitle = 'Alertas';
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include_once __DIR__ . '/../partials/_head.php'; ?>
        <script src="../scripts/markalerts.js" type="text/javascript"></script>
        <title><?= $pageTitle ?></title>
    </head>
    <body>
        <?php include_once '../partials/_header.php'; ?>
        <h1 id="main-title"><?= $pageTitle ?></h1>
        <?php
        if (SessionManager::keyExists('authUsername')) {
            $alertManager = new AlertManager();
            $arrayAlerts = $alertManager->getAlertsByUserID(SessionManager::getSessionValue('authUsername'));
            if (!empty($arrayAlerts)) {
                $userManager = new UserManager();
                $docManager = new DocumentManager();
                ?>
                <ul id="alertas">
                    <?php
                    foreach ($arrayAlerts as $value) {
                        try {
                            /* documento que foi partilhado */
                            /* user que partilhou */
                            $userpart = $userManager->getUserByID($value->getAlertUserSendID());
                            ?>
                            <li class="<?= ($value->getAlertTYPE() != AlertModel::SHARE) ? 'red-alert' : '' ?>">
                                <span>◷ <?= $value->getAlertDATE() ?></span>

                                <?php
                                if ($value->getAlertTYPE() != AlertModel::DELETE) {
                                    $docAlertAtual = $docManager->getDocumentByID($value->getAlertDocumentID());
                                    ?>
                                    <a class="link" href="../v_public/view-document.php?id=<?= $docAlertAtual->getDocumentID() ?>"><?= $docAlertAtual->getDocumentTITLE() ?></a>
                                    <p>O utilizador <?= $userpart->getUserNAME() ?> <?= ($value->getAlertTYPE() == AlertModel::SHARE) ? 'partilhou' : 'deixou de partilhar' ?> consigo este documento</p>
                                    <?php
                                } else {
                                    ?>
                                    <span class="link"><?= $value->getAlertDocumentNAME() ?></span>
                                    <p>O utilizador <?= $userpart->getUserNAME() ?> eliminou este documento</p>
                                    <?php
                                }
                                ?>
                                <input id="<?= $value->getAlertID() ?>" type="button" value="Marcar como visto" class="markAlert"/>
                            </li>

                            <?php
                        } catch (UserException $ex) {
                            ?>
                            <li><h3>Falha ao identificar o utilizador</h3></li> 
                            <?php
                        } catch (DocumentException $ex) {
                            ?>
                            <li><h3>Falha ao identificar o documento</h3></li> 
                            <?php
                        }
                    }
                    ?>       
                </ul> 
                <?php
            } else {
                $string = 'Não existem alertas';
                $url = "../v_public/index.php";
                $text = 'Sair';
                include_once __DIR__ . '/../partials/_error.php';
            }
        } else {
            $string = 'Necessário Login';
            $url = "../v_public/authentication.php";
            $text = 'Login';
            include_once __DIR__ . '/../partials/_error.php';
        }
        ?>
        <?php include_once '../partials/_footer.php'; ?>
    </body>
</html>
