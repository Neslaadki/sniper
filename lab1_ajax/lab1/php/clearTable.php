<?php
session_start();
if(isset($_SESSION['table'])){ 
    $_SESSION['table'] = array(); 
}

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