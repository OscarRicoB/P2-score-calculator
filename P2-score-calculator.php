<?php
//Starting test
define("FILE_ROUTE","test-files/");
//Define the file to read
$file_to_decrypt = isset($_POST['score_file']) ? $_POST['score_file']:(isset($_GET['score_file'])? $_GET['score_file']:"file1.txt");

$advantage = [
  "p1" => [],
  "p2" => [],
];

$fh = @fopen(FILE_ROUTE.$file_to_decrypt,'r');
$ln = (int)rtrim(fgets($fh));

for ($i=0; $i < $ln; $i++) {
  $tempScore = explode(" ", rtrim(fgets($fh)));
  // var_dump($tempScore);
  $higher = array_keys($tempScore,max($tempScore))[0] + 1;
  $advantage["p".$higher][] = abs($tempScore[0] - $tempScore[1]);
  // echo "p{$higher} is the winner of the round with ".abs($tempScore[0] - $tempScore[1])." advantage<hr>";
}

// var_dump($advantage);
// echo "<hr>max of p1 = ".max($advantage["p1"]);
// echo "<hr>max of p2 = ".max($advantage["p2"]);

if ( max($advantage["p1"]) > max($advantage["p2"]) ) {
  echo "1 ".max($advantage["p1"]) ;
}else {
  echo "2 ".max($advantage["p1"]) ;
}
