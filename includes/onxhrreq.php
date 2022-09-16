<?php 
require_once('./_base.php');
require_once('./_functions.php');
$user = new Users($db);

if(isset($_REQUEST)){
    if(isset($_GET['action'])){
        switch ($_GET['action']) {
            case 'add':
                # code...
                break;
            case 'delete':
                if(isset($_GET['item']) && is_numeric($_GET['item']) && isset($_GET['table']) && !empty($_GET['table'])){
                    $mess = $user->onDelete((int)$_GET['item'], $_GET['table']);
                    if((int) $mess['status'] === 200) 
                    echo(json_encode(array("status" => 200, "message" => "item deleted"), JSON_PRETTY_PRINT));
                    else echo(json_encode(array("status" => 500, "message" => "missing param item"), JSON_PRETTY_PRINT));
                }else echo(json_encode(array("status" => 500, "message" => "missing param item or table"), JSON_PRETTY_PRINT));
                break;
            case 'update':
                break;
            case 'select':
                break;
            default:
                # code...
                break;
        }
    }else echo('not allowed method');
}
?>