<?php
    
include('admin/connection.php');

$msg = "";

$query = "SELECT * FROM config_messages WHERE tipo = 2 ORDER BY id DESC LIMIT 1";
$query_result = mysqli_query($con, $query);
if ($row = mysqli_fetch_assoc($query_result)) {
    $msg = $row["message"];
}

?>
<html>
    <body>
        <center>
            <img src="https://emdn.cat/wp-content/uploads/2019/12/Logo-EMDN.png">
        </center>
        <center>
            <table border=3 bordercolor="orange" cellpadding=14 CELLSPACING=10>
                <tr>
                    <td>
                        <center>
                            <?php echo $msg; ?>
                        </center>
                    </td>
                </tr>
            </table>
        </center>
    </body>
</html>