<?php
require_once Config::getApplicationManagerPath() . 'UserManager.php';
require_once Config::getApplicationManagerPath() . 'AlertManager.php';
$alertManager = new AlertManager();
$userManager = new UserManager();
$numberofAlerts = 0;
try {
    $bool = true;
    $sessionUserID = SessionManager::getSessionValue('authUsername');
    $userModel = $userManager->getUserByID($sessionUserID);
    $numberofAlerts = count($alertManager->getAlertsByUserID($sessionUserID));
} catch (UserException $exc) {
    $bool = false;
} catch (SessionException $exc) {
    $bool = false;
}
?>


<header>
    <img src="../images/logo.png"  alt="Documentos ABC"/>
    <?php
    if ($numberofAlerts > 0) {
        ?>
        <a id="alert" href="../v_private/alerts.php"><?= $numberofAlerts ?> Alerta(s)</a>
        <?php
    }
    ?>
    <nav>
        <ul>
            <li><a href="../v_public/index.php">Inicio</a></li><!--
            --><li class="drop">
                <a class="noclick" href="#">Adicionar Documento</a>
                <ul>
                    <li><a href="../v_private/new-document.php?type=import">Importar</a></li>
                    <li><a href="../v_private/new-document.php?type=create">Criar</a></li>
                </ul>
            </li><!--

            --><li><a href="../v_private/my-docs.php">Meus Documentos</a></li><!--

            <?php
            if ($bool) {
                ?>
                --><li class="drop nav_right">
                    <a  class="noclick" href="#"><?= $userModel->getUserNAME() ?></a>
                    <ul>
                        <li><a href="../v_private/profile-page.php?id=<?= $sessionUserID ?>">Ver Perfil</a></li>
                        <li><a href="../v_private/change-profile.php">Alterar Perfil</a></li>
                        <?php if ($userModel->getUserAUTHLEVEL() === 'ADMIN') { ?>
                            <li><a href = "../v_admin/validate-users.php">Validar Utilizadores</a></li>
                            <li><a href = "../v_admin/manage-categories.php">Categorias</a></li>
                            <?php
                        }
                        ?>
                        <li><a href="../logout.php">Sair</a></li>
                    </ul>
                </li><!--
                <?php
            } else {
                ?>
                --><li class="nav_right"><a href = "../v_public/authentication.php">Login/Registar</a></li><!--
                <?php } ?>
            --></ul>
    </nav>
</header>

