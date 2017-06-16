<?php
require_once Config::getApplicationManagerPath() . 'UserManager.php';
require_once Config::getApplicationModelPath() . 'UserModel.php';


try {
    $bool = TRUE;
    $userMan = new UserManager();
    $userMana = $userMan->getUserByID(SessionManager::getSessionValue('authUsername'));
    $userModel = reset($userMana);

    if (!$userModel) {
        throw new SessionException('User não existe');
    }
} catch (SessionException $exc) {
    $bool = FALSE;
}
?>


<header>
    <img src="../images/logo.png"  alt="Documentos ABC"/>
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
            --><li><a href="../v_private/change-profile.php">Alterar Perfil</a></li><!--
            --><li><a href="../v_private/view-document.php">Ver Documento</a></li><!--
            --><li><a href="../v_private/edit-document.php">Editar Documento</a></li><!--
            <?php
            if ($bool && $userModel->getUserAUTHLEVEL() === 'ADMIN') {
                ?>

            --><li><a href="../v_admin/validate-users.php">Validar Utilizadores</a></li><!--
            --><li><a href="../v_admin/manage-categories.php">Categorias</a></li><!--
                                                                                                                                  
            <?php }

            if ($bool) {
                ?>
                    --><li class="drop" id="nav_right">
                        <a  class="noclick" href="#"> <?= $userModel->getUserNAME() ?></a>
                        <ul>
                            <li><a href="../v_private/profile-page.php">Perfil</a></li>
                            <li><a href="../logout.php">Sair</a></li>
                        </ul>
                    </li><!--
                <?php
            } else {
                ?>
                       --><li id="nav_right"><a href = "../v_public/authentication.php">Login/Registar</a></li><!--
            <?php } ?>
        --></ul>
    </nav>
</header>

