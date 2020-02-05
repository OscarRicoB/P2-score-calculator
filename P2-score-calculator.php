<?php
//Starting test
define("FILE_ROUTE","test-files/");
//Get the file and save it
if(!empty($_FILES['uploaded_file']))
{
  $path = FILE_ROUTE . basename( $_FILES['uploaded_file']['name']);

  if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
    $_POST['score_file'] =basename( $_FILES['uploaded_file']['name']);
  } else{
      echo "There was an error uploading the file, please try again!<br>";
      exit;
  }
}
//Define the file to read
$score_file = isset($_POST['score_file']) ? $_POST['score_file']:(isset($_GET['score_file'])? $_GET['score_file']:"file1.txt");

$advantage = [
  "p1" => [],
  "p2" => [],
];

$fh = @fopen(FILE_ROUTE.$score_file,'r');
$ln = (int)rtrim(fgets($fh));
if($ln < 0 || $ln > 10000)
  exit("Error: the first line need to be an integer equal or lower than 10000");
$arr = file(FILE_ROUTE.$score_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$c = ( false === $arr) ? 0 : count($arr);
if($c != ($ln + 1))
 exit("Error: the file needs to have {$ln} rounds but it has ".($c - 1));
$validcases = 0;
for ($i=0; $i < $ln; $i++) {
  $lineround = rtrim(fgets($fh));
  if ( preg_match ("/^\d+\s\d+/", $lineround) ){
    // echo "{$lineround}<hr>";
    $tempScore = explode(" ", $lineround);
    // var_dump($tempScore);
    $higher = array_keys($tempScore,max($tempScore))[0] + 1;
    $advantage["p".$higher][] = abs($tempScore[0] - $tempScore[1]);
    $validcases++;
    // echo "p{$higher} is the winner of the round with ".abs($tempScore[0] - $tempScore[1])." advantage<hr>";
  }else {
    $i--;
    // echo "{$lineround} !!<hr>";
  }
}
if ($ln != $validcases) {
  exit("Error: one of the rounds have an invalid format it has to be two numbers separated by a space");
}

$outputFile = fopen(FILE_ROUTE."outputP2.txt", "w");
if ( max($advantage["p1"]) > max($advantage["p2"]) ) {
  fwrite($outputFile, "1 ".max($advantage["p1"]));
}else {
  fwrite($outputFile, "2 ".max($advantage["p2"]));
}
fclose($outputFile);

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.basename(FILE_ROUTE."outputP2.txt"));
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize(FILE_ROUTE."outputP2.txt"));
readfile(FILE_ROUTE."outputP2.txt");
exit;
