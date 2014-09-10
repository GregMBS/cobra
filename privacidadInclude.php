<?php
$afirme = array(
    'Credito Si',
    'Surtidor del Hogar',
    'Surtifirme',
    'Banco Afirme'
);
if (in_array($cliente, $afirme)) {
    $privText = "Afirme Grupo Financiero, S.A. de C.V. y sus filiales, con domicilio en "
        ."Juárez No. 800 Sur, Colonia Centro, Código Postal 64000, Monterrey, Nuevo León, "
        ."le informa que sus datos serán tratados para los fines de los productos y servicios "
        ."financieros ofrecidos. Para más información consulte nuestro aviso de privacidad "
        ."a través de www.afirme.com";
    ?>
    <button class="buttons" type="button" value="privacidad"
            onclick="alert('<?php echo $privText; ?>');">Privacidad</button>

    <?php
}
