<?php
$directory = '';
$dest = '';
$from = readline("Da quale estensione devo convertire?"); 
$to = readline("In quale estensione devo convertire?"); 
$canzoni = glob($directory.'.'.$from);
foreach($canzoni as $song){
    $song = str_replace($directory, '', $song);
    $output = str_replace('.mp3', '', $song);
    echo "Converting ".$song." to $output.raw".PHP_EOL.PHP_EOL;
    @exec("ffmpeg -i '$directory$song' -f s16le -ac 1 -ar 48000 -acodec pcm_s16le '$dest$output.$to'");
    @exec("sudo rm '$directory$song'");
}
