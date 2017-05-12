<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Aluno
 *
 * @author José Bernardes
 */
class AlunoModel{
    private $alunoID;
    private $alunoNome;
    private $codCurso;
    
    
    function __construct($alunoID, $alunoNome, $codCurso) {
        $this->setAlunoID($alunoID);
        $this->setAlunoNome($alunoNome);
        $this->setCodCurso($codCurso);
    }

    
    function getAlunoID() {
        return $this->alunoID;
    }

    function getAlunoNome() {
        return $this->alunoNome;
    }

    function getCodCurso() {
        return $this->codCurso;
    }

    function setAlunoID($alunoID) {
        $this->alunoID = $alunoID;
    }

    function setAlunoNome($alunoNome) {
        $this->alunoNome = $alunoNome;
    }

    function setCodCurso($codCurso) {
        $this->codCurso = $codCurso;
    }


}
