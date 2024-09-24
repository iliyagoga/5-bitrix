<?php

namespace Only\Site\Agents;

use Bitrix\Main\Loader;
class Agent
{
           
 
    private function GetIBlockIdByCode($code) {
        $iblock = Iblock\IblockTable::getList([
            'filter' => ['CODE' => $code],
            'select' => ['ID']
        ])->fetch();

        return $iblock ? $iblock['ID'] : null;
    }


    public static function clearOldLogs()
    {
        \Bitrix\Main\Loader::includeModule('iblock');
      
    $logIBlockCode = 'LOG';
    $iblocks =  \Bitrix\Iblock\IblockTable::getList([
        'filter'=>['CODE'=>"LOG"],
        'select'=>['ID']
       
    ]);
    $logIBlockID = $iblocks->Fetch(); 
    $elements = \Bitrix\Iblock\ElementTable::getList([
        'filter' => ['IBLOCK_ID' => $logIBlockID],
        'order' => ['ACTIVE_FROM' => 'DESC'],
        'limit' => 10,
        'select' => ['ID']
    ])->fetchAll();

    if (count($elements) >= 10) {
        foreach ($elements as $element) {
            \CIBlockElement::Delete($element['ID']);
        }
    }
    return '\\' . __CLASS__ . '::' . __FUNCTION__ . '();';
    }

}
