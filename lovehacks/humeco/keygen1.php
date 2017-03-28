<?php

function debug() {
  if (!empty($_GET['debug'])) echo implode(func_get_args(), '');
}

/**********************************************************************/
/* FUNCIONES PARA CALCULAR LA CONTRACLAVE                             */
/**********************************************************************/

// Auxiliar, le añade la fecha a un hash.
function append_date($hash, $time) {
    return $hash . ':' . date('y', $time) . ':' . date('m', $time) . ':' . date('d', $time);
}

// Auxiliar, calcula la contraclave sencilla de la versión 1 de Ecotext.
function rehash($hash) {
    debug('<b>entrada en rehash: </b>',$hash,'<br>');
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
    debug('<b>salida en rehash: </b>',$hash,'<br>');
    return trim(implode(':', $parts), ':');    
}

// Auxiliar, embebe la fecha de inicio en la contraclave.
function embed_date($hash, $time) {
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
function counter_key($hash, $time = NULL) {
    $time = $time ? $time : time();
    debug('<b>entrada en "append_date": </b>',$hash,'<br>');
    $hash = append_date($hash, $time);
    $hash = rehash(rehash($hash));
    debug('<b>$hash": </b>',$hash,'<br>');
    debug('<b>sha1($hash)": </b>',sha1($hash),'<br>');
    debug('<b>md5($hash)": </b>',md5($hash),'<br>');
    debug('<b>sha1($hash) . md5($hash)": </b>',sha1($hash) . md5($hash),'<br>');
    $hash = sha1($hash) . md5($hash);
    debug('<b>chunk_split($hash, 2, ":"): </b>',chunk_split($hash, 2, ':'),'<br>');
    debug('<b>rtrim(chunk_split($hash, 2, ":"), ":"):</b> ',rtrim(chunk_split($hash, 2, ':'), ':'),'<br>');
    $hash = rtrim(chunk_split($hash, 2, ':'), ':');
    $hash = embed_date($hash, $time);
    return $hash;
}

/**********************************************************************/
/* FUNCIONES PARA COMPROBAR LA CADUCIDAD DE LA CONTRACLAVE            */
/**********************************************************************/

// Auxiliar, extrae la fecha de inicio de la contraclave.
function extract_initial_date_from_counter_key($code) {
    return strtotime($code[72] . $code[4] . '-' . $code[42] . $code[58] . '-' . $code[12] . $code[94]);
}

// Principal: comprueba si la contraclave entra en el intervalo de año en la fecha dada.
function check_date_validity($code, $time = NULL) {
    $time = $time ? $time : time();
    $initial = extract_initial_date_from_counter_key($code);
    $end = strtotime('+1 year', $initial);
    if ($time >= $initial && $end >= $time) {
        return TRUE;
    } else {
        return FALSE;
    }
}

/**********************************************************************/
/* TESTS                                                              */
/**********************************************************************/
$tests = array(
    array(
        'time' => strtotime('2017-01-19'),
        'code' => 'b8:88:e3:1e:e4:4f',
        'result' => '9a:07:8d:e8:1d:3e:83:f4:b2:a0:28:79:b4:52:06:51:e1:4d:59:31:c0:02:79:c3:1b:e5:d8:0b:e0:60:4b:49:17:90:8b:5e',
        'expired' => FALSE,
    ),
    array(
        'time' => strtotime('2017-03-15'),
        'code' => '60:6c:66:2b:4c:42',
        'result' => '9b:e7:5d:bc:15:d6:ae:e0:f9:9b:9b:98:12:6b:0c:e9:50:4a:58:f3:4f:da:fd:e5:1f:78:f5:82:ae:ad:0d:65:77:c5:27:06',
        'expired' => FALSE,
    ),
    array(
        'time' => strtotime('2016-09-15'),
        'code' => '95-57-b4-a7-de-ee',
        'result' => 'ec:d6:31:a9:15:28:13:76:7e:77:cc:1e:d5:ec:06:62:2c:71:3c:59:26:05:64:60:1c:3b:fd:7e:a5:dd:a3:85:5d:ad:74:3d',
        'expired' => FALSE,
    ),
    array(
        'time' => strtotime('2016-04-19'),
        'code' => '8f-09-7a-d3-f8-19',
        'result' => '5d:76:ff:ee:1c:6b:1a:6c:c8:a9:c6:12:42:d0:05:d9:5d:d4:c3:54:9e:3a:97:bb:13:a2:d2:6d:21:02:34:c9:a0:5d:cd:20',
        'expired' => FALSE,
    ),
    array(
        'time' => strtotime('2016-01-19'),
        'code' => 'f2-3a-64-68-4c-c5',
        'result' => '3a:66:c2:62:1d:83:a1:b9:e7:22:9f:86:9a:f5:09:19:68:80:16:51:24:e5:97:5e:1c:c4:a0:a1:31:51:76:19:10:da:09:af',
        'expired' => TRUE,
    ),
    array(
        'time' => strtotime('2019-08-19'),
        'code' => '56-c5-e6-b1-68-6c',
        'result' => '2c:39:45:47:14:22:b1:25:b3:d9:68:5a:e8:24:05:2c:05:57:59:18:67:ee:29:61:15:ff:cf:bd:ab:12:13:c9:f1:55:5a:f8',
        'expired' => TRUE,
    ),
    // TODO: más tests...
);

function codeTestGenerator(){
    
}

$errors = 0;
foreach ($tests as $test) {
    $calculated = counter_key($test['code'], $test['time']);
    echo $test['code'] . ' - ' . $calculated;
    echo '<br/>';
    if ($calculated === $test['result']) {
      echo '<span style="color: #0F0">* Clave v&aacute;lida</span>';
    } else {
      echo '<span style="color: #F00">! Clave no v&aacute;lida</span>';
      $errors++;
    }
    echo '<br/>';
    if (check_date_validity($calculated)) {
      if (!$test['expired']) {
        echo '<span style="color: #0F0">* En fechas est&aacute; OK</span>';
      } else {
        echo '<span style="color: #F00">! En fechas est&aacute; OK</span>';
        $errors++;
      }
    } else {
      if (!$test['expired']) {
        echo '<span style="color: #F00">! Caducado o es muy pronto</span>';
        $errors++;
      } else {
        echo '<span style="color: #0F0">* Caducado o es muy pronto</span>';
      }
    }
    echo '<hr/>';
}
if ($errors) {
  echo '<strong style="color: #F00">Tests no v&aacute;lidos: ' . $errors . ' error(es).</strong>';
} else {
  echo '<strong style="color: #0F0">Tests v&aacute;lidos.</strong>';
}
