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
            --><li><a href="../v_private/edit-document.php">Editar Documento</a></li>
            <?php
            if (session_status() === PHP_SESSION_ACTIVE && SessionManager::keyExists('authUsername')) {
                ?>
                <li class="drop" id="nav_right">
                    <a  class="noclick" href="#">Joel Pereira</a>
                    <ul>
                        <li><a href="../v_private/profile-page.php">Perfil</a></li>
                        <li><a href="../logout.php">Sair</a></li>
                    </ul>
                </li>
                <?php
            } else {
                ?>
                <li id="nav_right"><a href = "../v_public/authentication.php">Login/Registar</a></li>
                <?php } ?>
        </ul>
    </nav>
</header>

