
<?php
header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Origin, Content-Type, Accept, Authorization, X-Request-With');
header('Access-Control-Allow-Origin: *');

date_default_timezone_set('Europe/Moscow');

session_start();


$time = microtime(true);
$x =  (int) $_POST["x"];
$y = (double) str_replace(',', '.', $_POST['y']);
if ($_POST["y"]=="-0.0"||$_POST["y"]=="-0.00"||$_POST["y"]=="-0"||$_POST["y"]=="0") $y=(double) 0.0; 
// $y =  (double) $_POST["y"];
$r =  (int) $_POST["r"];



$is_catch= "Не попал";
$answer="";
$currentTime = date("H:i:s");

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    http_response_code(400);
    exit;
}

if (is_numeric($x) && is_numeric($y) && is_numeric($r) && in_array($x,array('-3','-2', '-1','0','1', '2','3','4', '5')) && ($y >= -5 && $y <= 5) && in_array($r,array('1', '2','3','4', '5'))) {

    if ($x >= 0 && $y >= 0 && ($x * $x + $y * $y) <= ($r / 2) * ($r / 2) 
    || ($x >= 0 && $y <= 0 && $x <= $r && $y <= $r)
    || ($x <= 0 && $y >= 0 && $y <= ($x+$r)/2)) {
        $is_catch = "Попал";
    }
    
    $time = microtime(true) - $start;
    // $answer= "<tr> <td>$x</td> <td>$y</td> <td>$r</td> <td><b>$is_catch</b></td> <td>$currentTime</td> <td>$time</td> </tr>";
    $result_table = array($x,$y,$r,$is_catch,$currentTime,$time);

    if(!isset($_SESSION['table'])){ 
        $_SESSION['table'] = array(); 
    } 

    array_push($_SESSION['table'],$result_table);

    echo '<table class="iksweb" id="resultTable"> 
            <thead>
                <tr>
                    <th>X</th>
                    <th>Y</th>
                    <th>R</th>
                    <th>Попал?</th>
                    <th>Время</th>
                    <th>Время выполнения</th>
                </tr>
            </thead>
            <tbody>';
            foreach ($_SESSION['table'] as $table){ 
                echo "<tr> 
                        <td>$table[0]</td> 
                        <td>$table[1]</td> 
                        <td>$table[2]</td> 
                        <td>$table[3]</td> 
                        <td>$table[4]</td> 
                        <td>$table[5]</td> 
                    </tr>";} 
    echo'   </tbody>
        </table>'; 
} 
else{
    $answer= "<tr> <td>INVALID DATA</td> </tr>";
}


?>

