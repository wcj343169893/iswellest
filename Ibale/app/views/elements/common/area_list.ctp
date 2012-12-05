<?php
//エリアのプルダウンのリストを作成する
foreach($cities as $areaId => $areaName) {
	echo "<option value='".$areaId."'>".$areaName."</option>";
}
?>
