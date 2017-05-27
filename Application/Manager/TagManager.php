<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TagManager
 *
 * @author Pc
 */
class TagManager extends MyDataAccessPDO {

    const TABLE_NAME = 'document_tag';

    public function add(TagModel $a) {
        $ins = array();
        $ins['TagID'] = $a->getTagID();
        $ins['TagNAME'] = $a->getTagNAME();
        $this->insert(self::TABLE_NAME, $ins);
    }

    public function addTagtoDocument(TagModel $tag, DocumentModel $document) {
        $ins = array();
        $ins['TagID'] = $tag->getTagID();
        $ins['DocumentID'] = $document->getDocumentID();
        $this->insert(self::TABLE_DOCUMENT_TAG, $ins);
    }

}
