<p>
<form action="carga2.php" method="post" name="clientepick">
    <table summary="Eligir cliente">
        <tr><td>Client</td>
            <td><input type="text" name="cliente" />
                <input type="hidden" name="filename" value="<?php
                echo $deststr
                ?>" />
                <input type="hidden" name="capt" value="<?php echo $capt ?>" />
            </td></tr>

    </table>
    <button type="submit" name="go" value="clientepick">Elegir cliente</button>
</form>
