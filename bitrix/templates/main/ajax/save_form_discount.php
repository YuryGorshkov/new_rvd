<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');
$el = new CIBlockElement;

$arLoadProductArray = Array(
  "MODIFIED_BY"    => 1,
  "IBLOCK_SECTION_ID" => false,
  "IBLOCK_ID"      => 6,  
  "NAME"           => htmlspecialcharsbx($_REQUEST["phone"]),
  "ACTIVE"         => "Y",  
  );
if($PRODUCT_ID = $el->Add($arLoadProductArray)) {
  echo "New ID: ".$PRODUCT_ID; 
}
else
  echo "Error: ".$el->LAST_ERROR;
?>