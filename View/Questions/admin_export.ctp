<?

$i=0;
$len=count($data[0]['Answer']);
foreach ($data[0]['Answer'] as $header=>$val){
	echo '"'.$header.'"';
	$i++;
	if ($i==$len) echo "\n";
	else echo ',';
}
foreach ($data as $row):
	/*
	sj - this was from article and is not necessary for this controlled data
	foreach ($row['Answer'] as &$cell):
		// Escape double quotation marks
		$cell = '"' . preg_replace('/"/','""',$cell) . '"';
	endforeach;
	*/
	//this explode makes it choke on max execution, not sure why, so who cares...
	//$row['Answer']=explode('_',$row['Answer']);
	echo implode(',', $row['Answer']) . "\n";
endforeach;