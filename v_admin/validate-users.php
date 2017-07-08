<?php
require_once __DIR__ . '/../partials/_init.php';
require_once Config::getApplicationManagerPath() . 'UserManager.php';
require_once Config::getApplicationManagerPath() . 'AddressManager.php';
$pageTitle = 'Validar Utilizadores';
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include_once '../partials/_head.php'; ?>
        <script src="../scripts/validateusers.js" type="text/javascript"></script>
        <title><?= $pageTitle ?></title>
    </head>
    <body>
        <?php include_once '../partials/_header.php'; ?> 
        <h1 id="main-title"><?= $pageTitle ?></h1>
        <?php
        if (SessionManager::keyExists('authUsername')) {

            $userManager = new UserManager();
            $usersValid = $userManager->getUserByAuthLevel('USER');
            $usersInvalid = $userManager->getUserByAuthLevel('USERINACTIVE');
            $users = array_merge($usersValid, $usersInvalid);
            try {
                $loggedUser = $userManager->getUserByID(SessionManager::getSessionValue('authUsername'));
                if ($loggedUser->getUserAUTHLEVEL() === 'ADMIN') {
                    ?>
                    <section id="validate">
                        <?php
                        $addressManager = new AddressManager();
                        foreach ($users as $value) {
                            ?>
                            <article class="article">
                                <img id="image" src="..<?= $value->getUserPHOTO() ?>" alt="ALT">
                                <p><?= $value->getUserNAME() ?></p>
                                <p><?= $value->getUserEMAIL() ?></p>
                                <?php
                                try {
                                    $address = $addressManager->getAddressByID($value->getUserADDRESS());
                                    $city = $address->getAddressCITY();
                                    $country = $address->getAddressCOUNTRY();
                                } catch (AddressException $ex) {
                                    $city = '####';
                                    $country = '####';
                                }
                                ?>
                                <p><?= $city . ', ' . $country ?></p>
                                <p><?= $value->getUserPHONE() ?></p>

                                <input <?= ($value->getUserAUTHLEVEL() == 'USER') ? 'checked' : '' ?> class="check" id="<?= $value->getUserID() ?>"type="checkbox"><label for="<?= $value->getUserID() ?>" class="valid noselect"><?= ($value->getUserAUTHLEVEL() == 'USER') ? 'Invalidar' : 'Validar' ?></label>
                            </article>
                        <?php } ?>
                    </section>
                    <?php
                } else {
                    $string = 'Necessário permissões de Administrador!';
                    $url = '../v_public/index.php';
                    $text = 'Sair';
                    include_once __DIR__ . '/../partials/_error.php';
                }
            } catch (UserException $ex) {
                $string = 'Falha ao identificar utilizador';
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
