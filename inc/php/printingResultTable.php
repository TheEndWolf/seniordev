<?php
function getTable($data){
	//require_once 'HTML/Table.php';
	
	$attrs = array('width' => '600');
	$table = new HTML_Table($attrs);
	$table->setAutoGrow(true);
	$table->setAutoFill('n/a');

		for ($nr = 0; $nr < count($data); $nr++) {
		  $table->setHeaderContents($nr+1, 0, (string)$nr);
		  for ($i = 0; $i < 4; $i++) {
			if ('' != $data[$nr][$i]) {
			  $table->setCellContents($nr+1, $i+1, $data[$nr][$i]);
			}
		  }
		}
		$altRow = array('bgcolor' => 'red');
		$table->altRowAttributes(1, null, $altRow);
		
		$table->setHeaderContents(0, 0, '');
	$table->setHeaderContents(0, 1, 'Surname');
	$table->setHeaderContents(0, 2, 'Name');
	$table->setHeaderContents(0, 3, 'Website');
	$table->setHeaderContents(0, 4, 'EMail');
	$hrAttrs = array('bgcolor' => 'silver');
	$table->setRowAttributes(0, $hrAttrs, true);
	$table->setColAttributes(0, $hrAttrs);
	
	echo $table->toHtml();
}
//echo "starting..";
//$data = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");
//getTable($data);

function getTable1($data){
	//echo mysqli_num_fields($data);
	echo "<table class='table'>";
		foreach($data as $key => $val){
		echo "<th>".$key."<th>"."\n";
	}
	//echo "<thead>";
	//echo "";
	foreach($data as $key => $val){
		echo "<td>".$val."<td>"."<br>";
	}
	echo "</thead>";
	echo "</table>";
}

?>