<?php
require_once 'admin.php';
require_once 'framework/class/class.dbpdo.php';
require_once 'setting.php';

$_SERVER['HTTP_REFERER'] = $_SERVER['HTTP_HOST'];

$table = 'ref_role';
$field = 'rr_id, rr_description';
//$data = array('rr_description' => 'CADE /EDIT', 'rr_acronym' => "cade ' edit ");
$condition = "rr_id='10'";
try {
    Db::delete($table, $condition,'N','Y');
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

$data = Db::data_list($table, $field);
echo "<pre>";
print_r($data);
echo "</pre>";

$conn = null;

?>