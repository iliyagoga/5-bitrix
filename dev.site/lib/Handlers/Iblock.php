<?php

namespace Only\Site\Handlers;
use Bitrix\Main\Loader;
use \Bitrix\Iblock\SectionTable;

class Iblock
{
    private function createSection($iblockId, $sectionCode,$sectionName) {
        $section = SectionTable::getList([
            'filter' => ['IBLOCK_ID' => $iblockId, 'NAME' => $sectionName],
            'select' => ['ID']
        ])->fetch();
    
        if ($section) {
            return $section['ID'];
        }
    
        $newSection = new \CIBlockSection;
    
        $res=$newSection->Add([
            'IBLOCK_ID' => $iblockId,
            'CODE'=>$sectionCode,
            'NAME' => $sectionName,
            'ACTIVE' => 'Y',
            "IBLOCK_SECTION_ID"=>false
        ]);
        return $res;
         
       
    }
    
    private function getSectionNam($iblockId) {
        $res = SectionTable::getList([
            'filter' => ['IBLOCK_ID' => $iblockId],
            'select' => ['NAME'],
            'order' => ['SORT' => 'ASC']
        ]);
        $sections = [];
        while ($section = $res->fetch()) {
            $sections[] = $section['NAME'];
        }
        
        return implode(' -> ', $sections);
    }
    public function addLog($arFields)
    {
        $logIBlockCode = 'LOG'; 

        $iblocks = \CIBlock::GetList([], ['CODE' => $logIBlockCode]); 
        $logIBlockID = $iblocks->Fetch()['ID']; 
    
        if ($arFields['IBLOCK_ID'] != $logIBlockID) { 
            $iblock  = \CIBlock::GetList([], ['IBLOCK_ID' => $arFields['IBLOCK_ID']])->Fetch(); 
            $el = new \CIBlockElement; 
            $sectionName=$this->getSectionNam($logIBlockID);
            $sectionId=$this->createSection($logIBlockID, $iblock['CODE']  ,$iblock["NAME"]);
         
            $res=$el->Add([ 
                "IBLOCK_ID" => $logIBlockID, 
                'NAME' => $arFields['ID'], 
                'ACTIVE_FROM' => date('d.m.Y H:i:s'),
                'PREVIEW_TEXT' => "{$iblock['NAME']}  > {$sectionName} -> {$arFields['NAME']}",
                'IBLOCK_SECTION_ID' => $sectionId
                
            ]); 
        } 
    }

    
}
