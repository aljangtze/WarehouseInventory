<?php
$page_title = '添加分组';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(1);
if (isset($_GET['product_name'])) {
    if ($_GET['product_name'] === "") {
        $arr['items'] = "";
        $arr['result'] = 'undefined';
        $arr['info'] = 'params error';

        $json = urldecode(json_encode($arr));

        echo $json;
        return;
    }

    $products = find_specifications_by_name($_GET['product_name']);

    $returnInnerXml = "";
    $isFirst = true;
    $arrItems = array();
    $arr = array();
    $count = 0;
    foreach ($products as $product) {
        $count = $count + 1;
        $item = array('name' => $product['name'], 'specification' => $product['specification']);

        array_push($arrItems, $item);
        /*   if($isFirst)
               $returnInnerXml = $returnInnerXml."<option value=".$product['specification']." selected='selected' data-id=".$product['id']."></option>";
           else
               $returnInnerXml = $returnInnerXml."<option value=".$product['specification'] ." data-id=".$product['id']."></option>";*/
    }

    $arr['items'] = $arrItems;

    $arr['info'] = '';
    if($count == 0)
    {
        $arr['result'] = 'undefined';
    }
    else
    {
        $arr['result'] = 'success';
    }
    $arr['count'] = $count;

    $json = urldecode(json_encode($arr));

    echo $json;
    //echo $returnInnerXml;
} else {
    $arr['items'] = "";
    $arr['result'] = 'error';
    $arr['info'] = 'params error';

    $json = urldecode(json_encode($arr));

    echo $json;
}
?>