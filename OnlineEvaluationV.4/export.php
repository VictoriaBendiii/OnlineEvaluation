<?php 
include('connection.php'); 
$file = fopen('result.csv', 'w');
$hlist = array ("Students, Group Number, Criteria, Total, Remarks");
    foreach($hlist as $line){
        fputcsv($file,explode(",",$line));
    }
$list = array (
    array('Nix Andres', '1', 'aaa', 'bbb', 'This is a sentence.'),
    array('Bennie Santos', '1', 'ccc', 'ddd', 'A phrase')
);
foreach ($list as $fields) {
    fputcsv($file, $fields);
}
fclose($file);
$file = 'result.csv';
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.basename($file));
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file));
readfile($file);
exit();
?>