<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');
$el = new CIBlockElement;

$arLoadProductArray = Array(
  "MODIFIED_BY"    => 1,
  "IBLOCK_SECTION_ID" => false,
  "IBLOCK_ID"      => 16,  
  "NAME"           => htmlspecialcharsbx($_REQUEST["name"]),
  "PREVIEW_TEXT"           => htmlspecialcharsbx($_REQUEST["phone"]),
  "DETAIL_TEXT"           => htmlspecialcharsbx($_REQUEST["itemname"]),
  "ACTIVE"         => "Y",  
  );
if($PRODUCT_ID = $el->Add($arLoadProductArray)) {
  echo "New ID: ".$PRODUCT_ID; 
}
else
  echo "Error: ".$el->LAST_ERROR;
?>