
<?php

$dir    = 'images/';
$files1 = scandir($dir);
$files2 = scandir($dir, 1);
// print_r($files2);
$i=1;
foreach($files2 as $val){
	if($val <> '.' && $val <> '..' ){
		$data2[] = array('thumb'=>'json/images/'.$val,'image'=>'json/images/'.$val,'title'=>$i,'folder'=>'Folder 1');
		$i++;
	}
}
echo json_encode($data2);
	

?>