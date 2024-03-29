<?php
require_once __DIR__ . '/../partials/_init.php';
require_once Config::getApplicationManagerPath() . "DocumentManager.php";
require_once Config::getApplicationManagerPath() . "CategoryManager.php";
?>
<!DOCTYPE html>

<html>
    <head>
        <?php include_once '../partials/_head.php'; ?>
        <script src="../scripts/search.js" type="text/javascript"></script>
        <title>Documentos ABC</title>
    </head>
    <body>
        <?php include_once '../partials/_header.php'; ?>
        <main id="index">
            <div id="searchMain">
                <div id="search">
                    <input placeholder="Pesquise aqui os documentos" type="text" id="inputS"/>
                    <input type="button" id="addButton" value="⌕">
                    <div>
                        <input type="radio" id="radioUser" name="type" value="user"><label for="radioUser">Utilizador</label>
                        <input type="radio" checked id="radioTitle" name="type" value="title"><label for="radioTitle">Titulo</label>
                    </div>
                    <ul>
                    </ul>


                </div>
                <h3><span>0</span> Documento(s) Encontrado(s)</h3>
                <ul id="searchResults">
                    <!--resultados-->
                </ul>
            </div>


            <div class="topIndex leftNav">
                <div id="rightdiv">
                    <h3 id="lastAdd">Categorias</h3>
                    <ul id="leftul">
                        <?php
                        $cateMan = new CategoryManager();
                        $cate = $cateMan->getAllCategories();

                        foreach ($cate as $value) {
                            ?>
                            <li><a href="view-docs-by.php?type=category&id=<?= $value->getCategoryID() ?>"><?= $value->getCategoryNAME() ?></a></li>

                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>

            <div class="topIndex rightNav">
                <div>
                    <h3 id="lastAdd">Ultimos Documentos</h3>
                    <ul >

                        <?php
                        $docManager = new DocumentManager();
                        $docs = $docManager->getDocumentByLimitOrdered(10);

                        foreach ($docs as $value) {
                            ?>
                            <li><a href="view-document.php?id=<?= $value->getDocumentID() ?>"><?= $value->getDocumentTITLE() ?><span>(<?= $value->getDocumentDATE() ?>)</span></a></li>

                        <?php } ?>
                    </ul>
                </div>
                <div id="rightdiv">
                    <h3 id="lastAdd">Categorias</h3>
                    <ul id="leftul">
                        <?php
                        $cateMan = new CategoryManager();
                        $cate = $cateMan->getAllCategories();

                        foreach ($cate as $value) {
                            ?>
                            <li><a href="view-docs-by.php?type=category&id=<?= $value->getCategoryID() ?>"><?= $value->getCategoryNAME() ?></a></li>

                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </main>
        <?php include_once '../partials/_footer.php'; ?>
    </body>
</html>
