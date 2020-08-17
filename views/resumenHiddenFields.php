<div class="noshow">
    <input type="hidden" name="error" readonly="readonly" value="1">
    <input type="hidden" name="C_HRFI" readonly="readonly" value="<?php
    if (isset($CT)) {
        echo $CT;
    }
    ?>">
    <input type="hidden" name="AUTO" readonly="readonly" value="">
    <input type="hidden" name="find" readonly="readonly" value="<?php
    if (isset($find)) {
        echo $find;
    }
    ?>">
    <input type="hidden" name="field" readonly="readonly" value="<?php
    if (isset($field)) {
        echo $field;
    }
    ?>">
    <input type="hidden" name="capt" readonly="readonly" value="<?php
    if (isset($capt)) {
        echo $capt;
    }
    ?>">
    <input type="hidden" name="camp" readonly="readonly" value="<?php
    if (isset($camp)) {
        echo $camp;
    }
    ?>">
    <input type="hidden" name="C_CVBA" readonly="readonly" value="<?php
    if (isset($cliente)) {
        echo $cliente;
    }
    ?>">
    <input type="hidden" name="C_ATTE" readonly="readonly" value="">
    <input type="hidden" name="C_CONT" readonly="readonly" value="<?php
    if (isset($id_cuenta)) {
        echo $id_cuenta;
    }
    ?>">
    <input type="hidden" name="C_CONTAN" readonly="readonly" value="<?php
    if (isset($status_aarsa)) {
        echo $status_aarsa;
    }
    ?>">
    <input type="hidden" name="CUENTA" readonly="readonly" value="<?php
    if (isset($numero_de_cuenta)) {
        echo $numero_de_cuenta;
    }
    ?>">
    <input type="hidden" name="C_EJE" readonly="readonly" value="<?php
    if (isset($ejecutivo_asignado_call_center)) {
        echo $ejecutivo_asignado_call_center;
    }
    ?>">
    <input type="hidden" name="oldGo" readonly="readonly" value="<?php echo $go; ?>">
</div>

