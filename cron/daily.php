<?php
// cron journalié pour récupérer les datas sur l'api du grand lyon
$path = dirname(__FILE__).'/../assets/json/data.json';
$data = file_get_contents('https://download.data.grandlyon.com/wfs/rdata?SERVICE=WFS&VERSION=2.0.0&outputformat=GEOJSON&request=GetFeature&typename=sit_sitra.sittourisme');
file_put_contents($path, $data);
?>