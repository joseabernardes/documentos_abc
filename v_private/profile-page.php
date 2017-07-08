<?php
require_once __DIR__ . '/../partials/_init.php';
require_once Config::getApplicationManagerPath() . 'AddressManager.php';
require_once Config::getApplicationModelPath() . 'AddressModel.php';
require_once Config::getApplicationManagerPath() . 'UserManager.php';
$userid1 = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$userManager = new UserManager();
try {
    $user1 = $userManager->getUserByID($userid1);
} catch (UserException $ex) {
    $user1 = false;
}
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
                    <img src="..<?= $user1->getUserPHOTO() ?>" alt="imagem" />
                    <p><?= $user1->getUserNAME(); ?></p>
                    <?php
                    try {
                         $addressManager = new AddressManager();
                        $address = $addressManager->getAddressByID($user1->getUserADDRESS());
                        $city = $address->getAddressCITY();
                        $country = $address->getAddressCOUNTRY();
                    } catch (AddressException $ex) {
                        $city = '####';
                        $country = '####';
                    }
                    ?>
                    <p><?= $city . ', ' . $country ?></p>
                    <?php $link = 'mailto:' . $user1->getUserEMAIL() ?>
                    <a href="<?= $link ?>">Contactar</a>  
                </div>
                <?php
            } else {
                $string = 'Utilizador não existe';
                $url = '../v_public/index.php';
                $text = 'Sair';
                include_once __DIR__ . '/../partials/_error.php';
            }
        } else {
            $string = 'Necessário autenticação';
            $url = '../v_public/authentication.php';
            $text = 'Login';
            include_once __DIR__ . '/../partials/_error.php';
        }
        ?>

        <?php include_once '../partials/_footer.php'; ?>
    </body>
</html>
