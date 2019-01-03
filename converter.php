<?php
$lang = readline("What language should I use? [it/en]");
if(empty($lang) or !in_array($lang, ['en', 'it'])) die("Error.");
$directory = '';
$dest = '';
$from = PHP_EOL.readline(['it' => "Da quale estensione devo convertire?", 'en' => "What extension should I convert?"][$lang]); 
$to = PHP_EOL.readline(['it' => "In quale estensione devo convertire?", 'en' => "In what extension do I have to convert?"][$lang]); 
if(empty($from) or empty($to)) die(['it' => 'Errore.', 'en' => 'Error.'][$lang]);
$canzoni = glob($directory.'.*'.$from);
foreach($canzoni as $song){
    $song = str_replace($directory, '', $song);
    $output = str_replace('.'.$to, '', $song);
    echo PHP_EOL.['en' => "Converting ".$song." to $output.$to", 'it' => "Conversione ".$song." in $output.$to"][$lang].PHP_EOL.PHP_EOL;
    @exec("ffmpeg -i '$directory$song' -f s16le -ac 1 -ar 48000 -acodec pcm_s16le '$dest$output.$to'");
    @exec("sudo rm '$directory$song'");
}
echo PHP_EOL.['en' => 'Finish!', 'it' => 'Finito!'][$lang];
