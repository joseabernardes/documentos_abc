<?php
require_once __DIR__ . '/../Config.php';
require_once Config::getApplicationManagerPath() . 'SessionManager.php';
require_once Config::getApplicationManagerPath() . 'UserManager.php';
$userManager = new UserManager();
SessionManager::startSession();