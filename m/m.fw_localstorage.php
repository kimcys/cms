<?php
    $datax = array('a' => 1, 'b' => 2);
    $data = json_encode($datax);
?>
    <div id="setls"></div>
    <div id="readls"></div>
        <textarea id="lsvalue" name="lsvalue"><?php echo $data ?></textarea>
        <button type="button" onclick="ajaxSetLS('lskey','lsvalue','setls','framework/localstorage.php')">Try Set</button>
    <button type="button" onclick="ajaxReadLS('lskey','readls','framework/localstorage.php')">Try Read</button>
    <button type="button" onclick="ajaxRemoveLS('lskey','readls','framework/localstorage.php')">Remove Read</button>
    