<?php
$page_title = '添加分组';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(1);
if (isset($_GET['product_name']) && isset($_GET['specification'])) {
    $products = find_model_number_by_name($_GET['product_name'], $_GET['specification']);

    $arr = array();
    $returnInnerXml = "";
    $isFirst = true;
    $count = 0;
    $arrItems = array();
    foreach ($products as $product) {
        $count = $count + 1;
        $item = array('id' => $product['id'], 'name' => $product['name'], 'specification' => $product['specification'],
            'model_number' => $product['model_number'], 'unit' => $product['unit'],
            'type' => $product['type'], 'initiator' => $product['initiator']);

        if ($isFirst) {
            //$arr['first'] = $pro;
            $isFirst = true;
        }

        array_push($arrItems, $item);
    }


    $arr['items'] = $arrItems;
    if($count == 0)
    {
        $arr['result'] = 'undefined';
    }
    else
    {
        $arr['result'] = 'success';
    }

    $arr['count'] = $count;
    $arr['info'] = '';

    $json = urldecode(json_encode($arr));

    echo $json;
} else {
    $arr['items'] = "";
    $arr['result'] = 'error';
    $arr['count'] = 0;
    $arr['info'] = '';
    $arr['first'] = '';

    $json = urldecode(json_encode($arr));

    echo $json;
}
?>