<?php
require_once __DIR__ . '/../partials/_init.php';
require_once Config::getApplicationManagerPath() . "DocumentManager.php";

$doc_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$docManager = new DocumentManager();
$doc = $docManager->getDocumentByID($doc_id);
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include_once '../partials/_head.php'; ?>
        <script src="../libs/jquery-3.2.1.js" type="text/javascript"></script>
        <script src="../scripts/details.js" type="text/javascript"></script>
        <title><?= empty($doc) ? 'Documento não existe' : reset($doc)->getDocumentTITLE() ?></title>
    </head>
    <body>
        <?php include_once '../partials/_header.php'; ?>
        <h1 id="main-title"><?= empty($doc) ? '#####' : reset($doc)->getDocumentTITLE() ?></h1>
        <?php
        if (empty($doc)) {
            $string = 'Documento não existe';
            $url = '../v_public/index.php';
            $text = 'Sair';
            include_once __DIR__ . '/../partials/_error.php';
        } else {
            $doc = reset($doc);
            $permitions = false;
            if ($doc->getDocumentVisibilityId() == 1) {
                $permitions = true;
            } else {
                if (SessionManager::keyExists('authUsername')) {
                    $userid = SessionManager::getSessionValue('authUsername');
                    if ($doc->getDocumentVisibilityId() == 2 && $userid == $doc->getDocumentUserId()) {
                        $permitions = true;
                    } else if ($doc->getDocumentVisibilityId() == 3) {
                        $shared = $docManager->getSharedUsersByDocumentID($doc_id);
                        $found = false;
                        foreach ($shared as $value) {
                            if ($userid == $value['UserID']) {
                                $found = true;
                                break;
                            }
                        }
                        if ($found || $userid == $doc->getDocumentUserId()) {
                            $permitions = true;
                        } else {
                            $string = 'Não tem permissões para ver o documento';
                            $url = '../v_public/index.php';
                            $text = 'Sair';
                        }
                    } else {
                        $string = 'Não tem permissões para ver o documento';
                        $url = '../v_public/index.php';
                        $text = 'Sair';
                    }
                } else {
                    $string = 'Este documento não é publico';
                    $url = '../v_public/authentication.php';
                    $text = 'Login';
                }
            }

            if ($permitions) {
                ?>



                <main id="view-doc">
                    <div id="top">
                        <div id="details" class="noselect"><span>Detalhes</span><span>+</span></div>
                        <div id="content">
                            <h3>Data de Criação</h3>
                            <span>5 de Março de 2017</span>
                            <h3>Categoria</h3>
                            <span>Geografia</span> 
                            <h3>Palavras-Chave</h3>
                            <span>eu, vi, um, sapo</span>
                            <h3>Resumo</h3>
                            <span>A empresa “Documentos ABC” pretende dasd asd asd asd asd asd asd criar uma plataforma simples de gestão documental. Nesse sentido, uma das medidas definidas passa pelo desenvolvimento de um portal capaz de possibilitar a importação de documentos word e respetiva possibilidade de partilha pelos diferentes utilizadores da plataforma.
                            </span>
                        </div>
                    </div>
                    <p id="doc">Descrição do Trabalho 
                        A empresa “Documentos ABC” pretende criar uma plataforma simples de gestão documental. Nesse sentido, uma das medidas definidas passa pelo desenvolvimento de um portal capaz de possibilitar a importação de documentos word e respetiva possibilidade de partilha pelos diferentes utilizadores da plataforma.
                        Um documento é caracterizado, no mínimo, pelo seu título, autor, resumo, categoria (Livre, Gestão, entre outros) data de criação, conteúdo, palavras chave e um “atalho” para o ficheiro e respetivo tamanho do ficheiro. Alerta-se que o conteúdo do documento deve ser populado automaticamente, de acordo com o contéudo do ficheiro do documento. Importem apenas o texto, podendo ser ignorado os elementos de estilo. 
                        Um documento pode ser privado (visível apenas para o utilizador que o importou), público (visível para todos os utilizadores da plataforma, inclusive utilizadores que não estejam registados na plataforma), ou partilhados apenas para alguns utilizadores da plataforma devidamente escolhidos pelo utilizador que criou o documento.

                        Um documento é inicialmente importado por um utilizador devidamente registado. Após a definição da estrutura do documento (o conteúdo é gerado automaticamente pelo sistema, baseado no conteúdo do documento), o dono do documento tem a possibilidade de partilhar o documento com outros utilizadores da plataforma. A partilha pode permitir ou bloquear a introdução de comentários ao documento de determinados utilizadores. A qualquer momento o “dono” pode editar o documento, sendo que é necessário justificar essa edição. O histórico de edição do documento deve ser visível para o dono ou utilizadores com o qual partilhou o documento. 
                        O portal que deverá desenvolver contém três áreas principais: Pública (acesso geral), Privada (utilizadores registados) e Administrativa (administradores da plataforma). 
                    </p>
                </main>

                <?php
            } else {
                include_once __DIR__ . '/../partials/_error.php';
            }
        }
        include_once '../partials/_footer.php';
        ?>
    </body>
</html>
