<!DOCTYPE html>
<html lang='es'>
    <head>
        <title>CobraMas Nota Admin</title>
        <link href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="notabox">
            <table class="ui-widget" id="notahead">
                <thead class='ui-widget-header'>
                    <tr>
                        <th>GESTOR</th>
                        <th>FECHA</th>
                        <th>HORA</th>
                        <th colspan=5>NOTA</th>
                        <th>BORRAR</th>
                    </tr>
                </thead>
                <tbody class="ui-widget-content">
                    <?php
                    if ($rowsub) {
                        $i = 0;
                        foreach ($rowsub as $answer) {
                            $i++;
                            ?>
                            <tr>
                                <td><?php echo $answer['c_cvge']; ?></td>
                                <td><?php echo $answer['fecha']; ?></td>
                                <td><?php echo $answer['hora']; ?></td>
                                <td colspan=5><?php
                                    echo htmlentities($answer['nota'], null, 'utf-8');
                                    ?>
                                </td>
                                <td>
                                    <form action="/notadmin.php"
                                          method="get" name="lista<?php echo $answer['auto']; ?>">
                                        <input type="hidden" name="which" readonly="readonly" value=<?php echo $answer['auto']; ?> />
                                        <input type="hidden" name="capt" readonly="readonly" value=<?php echo $capt; ?> />
                                        <input type="hidden" name="C_CVGE" readonly="readonly" value=<?php echo $capt; ?> /><br>
                                        <input type="hidden" name="AUTO" readonly="readonly" value="" />
                                        <input type="submit" name="go" value="BORRAR">
                                    </form>
                                </td>

                            </tr>

                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
        }
        ?>
        <form action="/notadmin.php" method="get" name="notas">
            <span class="formcap">Gestor</span><SELECT NAME="target">
                <OPTION VALUE='todos'>todos</option>
<?php
foreach ($rowt as $answerT) {
    ?>
                    <option value='<?php echo $answerT['iniciales']; ?>'><?php echo $answerT[0]; ?></option>
                <?php } ?>
            </SELECT><br>
            <span class="formcap">Fecha</span><SELECT NAME="formDay">
                <OPTION VALUE='01'>1</option>
                <OPTION VALUE='02'>2</option>
                <OPTION VALUE='03'>3</option>
                <OPTION VALUE='04'>4</option>
                <OPTION VALUE='05'>5</option>
                <OPTION VALUE='06'>6</option>
                <OPTION VALUE='07'>7</option>
                <OPTION VALUE='08'>8</option>
                <OPTION VALUE='09'>9</option>
                <OPTION VALUE='10'>10</option>
                <OPTION VALUE='11'>11</option>
                <OPTION VALUE='12'>12</option>
                <OPTION VALUE='13'>13</option>
                <OPTION VALUE='14'>14</option>
                <OPTION VALUE='15'>15</option>
                <OPTION VALUE='16'>16</option>
                <OPTION VALUE='17'>17</option>
                <OPTION VALUE='18'>18</option>
                <OPTION VALUE='19'>19</option>
                <OPTION VALUE='20'>20</option>
                <OPTION VALUE='21'>21</option>
                <OPTION VALUE='22'>22</option>
                <OPTION VALUE='23'>23</option>
                <OPTION VALUE='24'>24</option>
                <OPTION VALUE='25'>25</option>
                <OPTION VALUE='26'>26</option>
                <OPTION VALUE='27'>27</option>
                <OPTION VALUE='28'>28</option>
                <OPTION VALUE='29'>29</option>
                <OPTION VALUE='30'>30</option>
                <OPTION VALUE='31'>31</option>
            </SELECT>
            <SELECT NAME="formMonth">
                <OPTION VALUE='01'>enero</option>
                <OPTION VALUE='02'>febrero</option>
                <OPTION VALUE='03'>marzo</option>
                <OPTION VALUE='04'>abril</option>
                <OPTION VALUE='05'>mayo</option>
                <OPTION VALUE='06'>junio</option>
                <OPTION VALUE='07'>julio</option>
                <OPTION VALUE='08'>agosto</option>
                <OPTION VALUE='09'>septiembre</option>
                <OPTION VALUE='10'>octubre</option>
                <OPTION VALUE='11'>noviembre</option>
                <OPTION VALUE='12'>diciembre</option>
            </SELECT>
            <SELECT NAME="formYear">
                <OPTION VALUE='2014'>2014</option>
                <OPTION VALUE='2015'>2015</option>
            </SELECT><br>
            <span class="formcap">Hora</span><select name='HORA'>
                <option value=''>&nbsp;</option>
                <option value='06:00:00'>6 AM</option>
                <option value='07:00:00'>7 AM</option>
                <option value='08:00:00'>8 AM</option>
                <option value='09:00:00'>9 AM</option>
                <option value='10:00:00'>10 AM</option>
                <option value='11:00:00'>11 AM</option>
                <option value='12:00:00'>12</option>
                <option value='13:00:00'>1 PM</option>
                <option value='14:00:00'>2 PM</option>
                <option value='15:00:00'>3 PM</option>
                <option value='16:00:00'>4 PM</option>
                <option value='17:00:00'>5 PM</option>
                <option value='18:00:00'>6 PM</option>
                <option value='19:00:00'>7 PM</option>
                <option value='20:00:00'>8 PM</option>
                <option value='21:00:00'>9 PM</option>
            </select><br>
            <span class="formcap">Nota</span>
            <textarea rows="2" cols="40" name="NOTA"></textarea><br>
            <input type="hidden" name="D_FECH" readonly="readonly" value=<?php echo date('Y-m-d'); ?> /><br>
            <input type="hidden" name="C_HORA" readonly="readonly" value=<?php echo date('H:i:s'); ?> /><br>
            <input type="hidden" name="C_CVGE" readonly="readonly" value=<?php echo $capt; ?> /><br>
            <input type="hidden" name="capt" readonly="readonly" value=<?php echo $capt; ?> /><br>
            <input type="hidden" name="AUTO" readonly="readonly" value="" /><br>
            <input type="submit" name="go" value="GUARDAR">
        </form>
    </body>
</html>
