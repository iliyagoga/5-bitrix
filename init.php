<?php
namespace Only\Site;
use Bitrix\Main\Loader;
require_once($_SERVER['DOCUMENT_ROOT'] . "/local/modules/dev.site/lib/Handlers/Iblock.php"); 
require_once($_SERVER['DOCUMENT_ROOT'] . "/local/modules/dev.site/lib/Agents/Agent.php"); 
Loader::includeModule('iblock');
$iblockHandler = new Handlers\Iblock(); 
$Agent = new Agents\Agent(); 
AddEventHandler('iblock', 'OnAfterIBlockElementAdd', function (&$arFields) use ($iblockHandler) {
    $iblockHandler->addLog($arFields); 
});

\CAgent::AddAgent(
    "\\Only\\Site\\Agents\\Agent::clearOldLogs();",
    "",
    "Y",
    3600,
    date('d.m.Y H:i:s',time()),
    "Y",
    date('d.m.Y H:i:s',time()+30),
);
 
?>