 <?php
		define('BASEPATH', 'yangdali');
		require '../../application/config/database.php';
		
		$conn = mysql_connect($db['default']['hostname'],$db['default']['username'],$db['default']['password']) or die('连接失败:'.mysql_error);
		mysql_select_db($db['default']['database'],$conn) or die('数据库选择失败:'.mysql_error);
		mysql_query("set names utf8");
		
		$sql = "INSERT INTO `".$db['default']['dbprefix']."works` VALUES (NULL, NULL, NULL,NULL,'1','1',NULL)";
		mysql_query($sql);
		$getID = mysql_insert_id();
		echo $getID;
		mysql_close($conn);
?>