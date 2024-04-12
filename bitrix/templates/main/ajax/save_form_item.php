<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');
$el = new CIBlockElement;

$PROP = array();
if (!empty($_REQUEST["model"])){
    $PROP["PRODUCT_NAME"] = explode("|", $_REQUEST["model"])[0];
    $PROP["ARTNUMBER"] = explode("|", $_REQUEST["model"])[1];
}
if (!empty($_REQUEST["name"]))
    $PROP["CLIENT_NAME"] = $_REQUEST["name"];


$arLoadProductArray = Array(
  "MODIFIED_BY"    => 1,
  "IBLOCK_SECTION_ID" => false,
  "IBLOCK_ID"      => 22,  
  "NAME"           => htmlspecialcharsbx($_REQUEST["phone"]),
  "PREVIEW_TEXT"   => htmlspecialcharsbx($_REQUEST["comment"]),
  "ACTIVE"         => "Y", 
  "PROPERTY_VALUES"=> $PROP, 
  );
if($PRODUCT_ID = $el->Add($arLoadProductArray)) {
  echo "New ID: ".$PRODUCT_ID; 
}
else
  echo "Error: ".$el->LAST_ERROR;
?>