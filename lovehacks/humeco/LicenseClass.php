<?php

class LicenseClass {
    /**********************************************************************/
    /* FUNCIONES PARA CALCULAR LA CONTRACLAVE                             */
    /**********************************************************************/

    // Auxiliar, le añade la fecha a un hash.
    private function append_date($hash, $time) {
        return $hash . ':' . date('y', $time) . ':' . date('m', $time) . ':' . date('d', $time);
    }
    
    // Auxiliar, calcula la contraclave sencilla de la versión 1 de Ecotext.
    private function rehash($hash) {
        $hash .= ":" . strrev($hash);
        $hash = str_replace(':', '', $hash);
        $initial = $hash[0];
        $hash = substr($hash, 1) . $initial;
        $hash = chunk_split($hash, 2, ':');
        $parts = explode(':', $hash);
        for ($i = 0; $i < count($parts) - 1; $i++) {
            $hex = hexdec($parts[$i]);
            $hex = ($hex * 1) + ($hex * 3) + ($hex * 5) + ($hex * 7) + ($hex * $i);
            $hex = $hex % 256;
            $hex = abs($hex);
            $parts[$i] = dechex($hex);
            $parts[$i] = str_pad($parts[$i], 2, '0', STR_PAD_LEFT);
        }
        return trim(implode(':', $parts), ':');    
    }
    
    // Auxiliar, embebe la fecha de inicio en la contraclave.
    private function embed_date($hash, $time) {
        $year = date('y', $time);
        $month = date('m', $time);
        $day = date('d', $time);

        $hash[72] = $year[0];
        $hash[4] = $year[1];
        $hash[42] = $month[0];
        $hash[58] = $month[1];
        $hash[12] = $day[0];
        $hash[94] = $day[1];
        return $hash;
    }
    
    // Principal: calcula la contraclave compleja con fechas para versión nueva de Ecotext.
    public function counter_key($hash, $time = NULL) {
        $time = $time ? $time : time();
        $hash = $this->append_date($hash, $time);
        $hash = $this->rehash($this->rehash($hash));
        $hash = sha1($hash) . md5($hash);
        $hash = rtrim(chunk_split($hash, 2, ':'), ':');
        $hash = $this->embed_date($hash, $time);
        return $hash;
    }
    
    /**********************************************************************/
    /* FUNCIONES PARA COMPROBAR LA CADUCIDAD DE LA CONTRACLAVE            */
    /**********************************************************************/

    // Auxiliar, extrae la fecha de inicio de la contraclave.
    private function extract_initial_date_from_counter_key($code) {
        return strtotime($code[72] . $code[4] . '-' . $code[42] . $code[58] . '-' . $code[12] . $code[94]);
    }

    // Principal: comprueba si la contraclave entra en el intervalo de año en la fecha dada.
    public function check_date_validity($code, $time = NULL) {
        $time = $time ? $time : time();
        $initial = $this->extract_initial_date_from_counter_key($code);
        $end = strtotime('+1 year', $initial);
        if ($time >= $initial && $end >= $time) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

class ParseCsvTest{
    private $fileArray = array();
    private $file;
    
    function __construct($file){
        $this->file = $file;
        $this->fileArray = file($this->file);
    }
    
    public function show(){
        var_dump($this->fileArray);
    }
    
    public function parse(){
        $array = array();
        for ($x = 1;$x < count($this->fileArray);++$x) {
            $row = explode(',', $this->fileArray[$x]);
            $array[] = array(
                'time' => strtotime($row[1]),
                'code' => $row[0],
                'result' => '',
                'expired' => false
            );
        }
        return $array;
    }
    
}

/**********************************************************************/
/* TESTS                                                              */
/**********************************************************************/
/*
$tests = array(
    array(
        'time' => strtotime('2017-01-19'),
        'code' => 'b8:88:e3:1e:e4:4f',
        'result' => '9a:07:8d:e8:1d:3e:83:f4:b2:a0:28:79:b4:52:06:51:e1:4d:59:31:c0:02:79:c3:1b:e5:d8:0b:e0:60:4b:49:17:90:8b:5e',
        'expired' => FALSE,
    )
);
*/

$license = new LicenseClass();
$parseCsvTest = new ParseCsvTest('test.csv');

$tests = $parseCsvTest->parse();
for ($x = 0;$x<count($tests);$x++){
    $tests[$x]['result'] = $license->counter_key($tests[$x]['code'],$tests[$x]['time']);
}

var_dump($tests);

$errors = 0;
$valids = 0;

foreach ($tests as $test) {
    $calculated = $license->counter_key($test['code'], $test['time']);
    echo $test['code'] . ' - ' . $calculated;
    echo '<br/>';
    if ($calculated === $test['result']) {
      echo '<span style="color: #0F0">* Clave v&aacute;lida</span>';
    } else {
      echo '<span style="color: #F00">! Clave no v&aacute;lida</span>';
      $errors++;
    }
    echo '<br/>';
    if ($license->check_date_validity($calculated)) {
      if (!$test['expired']) {
          echo '<span style="color: #0F0">* En fechas est&aacute; OK</span>',' (',date('m/d/Y', $test['time']),')';
      } else {
        echo '<span style="color: #F00">! En fechas est&aacute; OK</span>',' (',date('m/d/Y', $test['time']),')';
        $errors++;
      }
    } else {
      if (!$test['expired']) {
        echo '<span style="color: #F00">! Caducado o es muy pronto</span>',' (',date('m/d/Y', $test['time']),')';
        $errors++;
      } else {
        echo '<span style="color: #0F0">* Caducado o es muy pronto</span>',' (',date('m/d/Y', $test['time']),')';
      }
    }
    echo '<hr/>';
    if ($calculated === $test['result'] && $license->check_date_validity($calculated)){
        $valids++;
    }
}
echo '<strong>Tests realizados: ' , count($tests) , ' tests</strong><br>';
echo '<strong style="color: #F00">Tests no v&aacute;lidos: ' . $errors . ' error(es).</strong><br>';
echo '<strong style="color: #0F0">Test v&aacute;lidos: ' . $valids . ' ok.</strong>';
