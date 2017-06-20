<?php
require_once __DIR__ . '/../partials/_init.php';
require_once Config::getApplicationManagerPath() . 'AddressManager.php';
require_once Config::getApplicationModelPath() . 'AddressModel.php';
require_once Config::getApplicationManagerPath() . 'UserManager.php';
$userid1 = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$userManager1 = new UserManager();
$arrayUsers1 = $userManager1->getUserByID($userid1);
$user1 = reset($arrayUsers1);
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include_once '../partials/_head.php'; ?>
        <title>Perfil</title>
    </head>
    <body>
        <?php include_once '../partials/_header.php'; ?>
        <h1 id="main-title">Perfil</h1>
        <?php
        if (SessionManager::keyExists('authUsername')) {

            if ($user1) {
                ?>    
                <div class="card">
                    <img src="..<?= $user1->getUserPHOTO() ?>" alt="COta" style="width:100%"/>
                    <?php
                    $addressManagement = new AddressManager();
                    $addressQ = $addressManagement->getAddressByID($user1->getUserADDRESS());
                    $addModel = reset($addressQ);
                    ?>
                    <p><?= $user1->getUserNAME(); ?></p>
                    <p><?= $addModel->getAddressCITY(); ?></p>
                    <a>Contact</a>
                </div>
                <?php
            } else {
                $string = 'Utilizador não Existe';
                $url = '../v_public/index.php';
                $text = 'Sair';
                include_once __DIR__ . '/../partials/_error.php';
            }
        } else {
            $string = 'Necessário Login';
            $url = '../v_public/authentication.php';
            $text = 'Login';
            include_once __DIR__ . '/../partials/_error.php';
        }
        ?>

        <?php include_once '../partials/_footer.php'; ?>
    </body>
</html>
