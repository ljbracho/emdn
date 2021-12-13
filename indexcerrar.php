<?php
    
include('admin/connection.php');
    
$query = "select * from config_messages where tipo = 2";
$query_result = mysqli_query($con, $query);
if ($row =  mysqli_fetch_assoc($query_result)) {
    $msg = $row["message"];
} else {
    $msg = "";
    $id = $status = 0;

}

?>


<html >
<body>
<center><img src="https://emdn.cat/wp-content/uploads/2019/12/Logo-EMDN.png"></center><p>
<BR><P>
<center>
<table border=3 bordercolor="orange" cellpadding=14 CELLSPACING=10>
<tr>
<td>
<center>
    <?= $msg ?>

</center>
</td>
</tr>
</table>
</body>
</html>