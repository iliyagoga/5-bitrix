<?php
namespace Only\Site\Handlers;
require_once($_SERVER['DOCUMENT_ROOT'] . "/local/modules/dev.site/lib/Handlers/Iblock.php"); 

// Loader::includeModule('iblock');
\Bitrix\Main\Loader::includeModule('iblock');
$iblockHandler = new Iblock(); 
print(1);
exit;
AddEventHandler('iblock', 'OnAfterIBlockElementAdd', function (&$arFields) use ($iblockHandler) {
    // Вызываем метод addLog на экземпляре класса
    $iblockHandler->addLog($arFields); 
});

#)
// AddEventHandler('iblock','OnAfterIBlockElementUpdate','Iblock::addLog');
// Iblock::addLog($arFields);
// function createSection($iblockId, $sectionCode,$sectionName) {
//     $section = Iblock\SectionTable::getList([
//         'filter' => ['IBLOCK_ID' => $iblockId, 'NAME' => $sectionName],
//         'select' => ['ID']
//     ])->fetch();

//     if ($section) {
//         return $section['ID'];
//     }

//     $newSection = new CIBlockSection;

//     $res=$newSection->Add([
//         'IBLOCK_ID' => $iblockId,
//         'CODE'=>$sectionCode,
//         'NAME' => $sectionName,
//         'ACTIVE' => 'Y',
//         "IBLOCK_SECTION_ID"=>false
//     ]);
//     return $res;
     
   
// }

// function getSectionNam($iblockId) {
//     $res = Iblock\SectionTable::getList([
//         'filter' => ['IBLOCK_ID' => $iblockId],
//         'select' => ['NAME'],
//         'order' => ['SORT' => 'ASC']
//     ]);
//     $sections = [];
//     while ($section = $res->fetch()) {
//         $sections[] = $section['NAME'];
//     }
    
//     return implode(' -> ', $sections);
// }

// function LogElementChange(&$arFields){
//     $logIBlockCode = 'LOG'; 

//     $iblocks = CIBlock::GetList([], ['CODE' => $logIBlockCode]); 
//     $logIBlockID = $iblocks->Fetch()['ID']; 

//     if ($arFields['IBLOCK_ID'] != $logIBlockID) { 
//         // CIBlockSection::Delete(10);
//         $iblock = Iblock\IblockTable::getById($arFields['IBLOCK_ID'])->fetch();
//         $el = new CIBlockElement; 
//         $sectionName=getSectionNam($logIBlockID);
//         $sectionId=createSection($logIBlockID, $iblock['CODE']  ,$iblock["NAME"]);
     
//         $res=$el->Add([ 
//             "IBLOCK_ID" => $logIBlockID, 
//             'NAME' => $arFields['ID'], 
//             'ACTIVE_FROM' => date('d.m.Y H:i:s'),
//             'PREVIEW_TEXT' => "{$iblock['NAME']}  > {$sectionName} -> {$arFields['NAME']}",
//             'IBLOCK_SECTION_ID' => $sectionId
            
//         ]); 
//     } 

   
//  }
//  createAgent();
//  function createAgent(){
 
//         $result = CAgent::AddAgent(
//             "DeleteOldLog();",
//             "",
//             "Y",
//             10,
//             date('d.m.Y H:i:s',time()),
//             "Y",
//             date('d.m.Y H:i:s',time()+30),
//         );
//  }
   
//  function DeleteOldLog() {
//     CModule::IncludeModule('iblock');
//     $logIBlockCode = 'LOG';
//     $iblocks = CIBlock::GetList([], ['CODE' => $logIBlockCode]); 
//     $logIBlockID = $iblocks->Fetch()['ID']; 
//     $elements = Iblock\ElementTable::getList([
//         'filter' => ['IBLOCK_ID' => $logIBlockID],
//         'order' => ['ACTIVE_FROM' => 'DESC'],
//         'limit' => 10,
//         'select' => ['ID']
//     ])->fetchAll();


//     if (count($elements) > 10) {
//         foreach ($elements as $element) {
//             CIBlockElement::Delete($element['ID']);
//         }
//     }
//     return "DeleteOldLog();";
 
//  }
 
//  function GetIBlockIdByCode($code) {
//      $iblock = Iblock\IblockTable::getList([
//          'filter' => ['CODE' => $code],
//          'select' => ['ID']
//      ])->fetch();
 
//      return $iblock ? $iblock['ID'] : null;
//  }

// ?>