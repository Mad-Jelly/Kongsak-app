<?php
$html = "X-RAY KXR 50 +หลอด 300kHU.+  CEILING +เตียง 6 WAYS + สาย H.T. 12 ม. + Bucky Stand + Collimator";
$needle = "+";
$lastPos = 0;
$positions = array();

if($lastPos = strpos($html, $needle, $lastPos)!== false)
{
    while (($lastPos = strpos($html, $needle, $lastPos))!== false) 
    {
        $positions[] = $lastPos;
        $lastPos = $lastPos + strlen($needle);
    }
    
}
else{
    echo "TRUE";
}

// Displays 3 and 10
foreach ($positions as $value) {
    echo $value ."<br />";
}



$c=0;
$i=0;
$s=0;
echo'<table border="1">
<tr>
<td>';

foreach ($positions as $value)
{
    $i=$value;
    $s=$i-$c;
        if($i==$value)
        {
            echo substr($html,$c,$s);
            echo"</br>";            
        }
        $c=$value;
        
        
         
}
echo substr($html,$i); 
echo'</td>
</tr>
</table>';

?>