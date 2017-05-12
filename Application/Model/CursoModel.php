<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Curso
 *
 * @author José Bernardes
 */
class CursoModel {
  private $cursoID;
  private $cursoNome;
  
  function __construct($cursoID, $cursoNome) {
      $this->setCursoID($cursoID);
      $this->setCursoNome($cursoNome);
  }
  
  function getCursoID() {
      return $this->cursoID;
  }

  function getCursoNome() {
      return $this->cursoNome;
  }

  function setCursoID($cursoID) {
      $this->cursoID = $cursoID;
  }

  function setCursoNome($cursoNome) {
      $this->cursoNome = $cursoNome;
  }


  
}
