<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');
$el = new CIBlockElement;
$question = "";


$arSelect = Array("ID", "IBLOCK_SECTION_ID", "NAME", "DATE_ACTIVE_FROM");
$arFilter = Array("IBLOCK_ID"=>4, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
while($ob = $res->GetNextElement()){ 
	$arFields = $ob->GetFields();  
  if(!empty($_REQUEST["direction_".$arFields["ID"]])){
    $arFilter = Array('IBLOCK_ID'=>4, 'GLOBAL_ACTIVE'=>'Y', "ID"=>$arFields["IBLOCK_SECTION_ID"]);
    $db_list = CIBlockSection::GetList(Array(), $arFilter, true, array('ID','UF_*', "DESCRIPTION", "NAME"));
    
    while($ar_result = $db_list->GetNext()){ 
      $question.= $ar_result["UF_DESCRIPTION_2"]." : ".$arFields["NAME"]." <br> ";
    }
  }
}


$arLoadProductArray = Array(
  "MODIFIED_BY"    => 1,
  "IBLOCK_SECTION_ID" => false,
  "IBLOCK_ID"      => 5,  
  "NAME"           => htmlspecialcharsbx($_REQUEST["name"]),
  "PREVIEW_TEXT"   => ($_REQUEST["phone"]." <br> ".$_REQUEST["city"]." <br> ".$_REQUEST["mail"]." <br> ".$question),  
  "ACTIVE"         => "Y",  
  );
if($PRODUCT_ID = $el->Add($arLoadProductArray)) {
  echo "New ID: ".$PRODUCT_ID; 
}
else
  echo "Error: ".$el->LAST_ERROR;
?>