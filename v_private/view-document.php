<?php require_once __DIR__ . '/../partials/_init.php'; ?>

<!DOCTYPE html>
<html>
    <head>
        <?php include_once '../partials/_head.php'; ?>
        <script src="../libs/jquery-3.2.1.js" type="text/javascript"></script>
        <script src="../scripts/details.js" type="text/javascript"></script>
        <title>"Titulo do documento"</title>
    </head>
    <body>
        <?php include_once '../partials/_header.php'; ?>
        <h1 id="main-title">"Titulo do documento"</h1>
        <main id="view-doc">
            <div id="top">
                <div id="details" class="noselect"><span>Detalhes</span><span>+</span></div>
                <div id="content">
                    <h3>Data de Criação</h3>
                    5 de Março de 2017
                    <h3>Categoria</h3>
                    Geografia
                    <h3>Palavras-Chave</h3>
                    eu, vi, um, sapo
                    <h3>Resumo</h3>
                    A empresa “Documentos ABC” pretende criar uma plataforma simples de gestão documental. Nesse sentido, uma das medidas definidas passa pelo desenvolvimento de um portal capaz de possibilitar a importação de documentos word e respetiva possibilidade de partilha pelos diferentes utilizadores da plataforma.

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
        <?php include_once '../partials/_footer.php'; ?>
    </body>
</html>
