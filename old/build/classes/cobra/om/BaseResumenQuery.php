<?php


/**
 * Base class that represents a query for the 'resumen' table.
 *
 *
 *
 * @method ResumenQuery orderByNombreDeudor($order = Criteria::ASC) Order by the nombre_deudor column
 * @method ResumenQuery orderByDomicilioDeudor($order = Criteria::ASC) Order by the domicilio_deudor column
 * @method ResumenQuery orderByColoniaDeudor($order = Criteria::ASC) Order by the colonia_deudor column
 * @method ResumenQuery orderByCiudadDeudor($order = Criteria::ASC) Order by the ciudad_deudor column
 * @method ResumenQuery orderByEstadoDeudor($order = Criteria::ASC) Order by the estado_deudor column
 * @method ResumenQuery orderByCpDeudor($order = Criteria::ASC) Order by the cp_deudor column
 * @method ResumenQuery orderByPlanoGuiaRoji($order = Criteria::ASC) Order by the plano_guia_roji column
 * @method ResumenQuery orderByCuadranteGuiaRoji($order = Criteria::ASC) Order by the cuadrante_guia_roji column
 * @method ResumenQuery orderByTel1($order = Criteria::ASC) Order by the tel_1 column
 * @method ResumenQuery orderByTel2($order = Criteria::ASC) Order by the tel_2 column
 * @method ResumenQuery orderByTel3($order = Criteria::ASC) Order by the tel_3 column
 * @method ResumenQuery orderByTel4($order = Criteria::ASC) Order by the tel_4 column
 * @method ResumenQuery orderByNombreDeudorAlterno($order = Criteria::ASC) Order by the nombre_deudor_alterno column
 * @method ResumenQuery orderByDomicilioDeudorAlterno($order = Criteria::ASC) Order by the domicilio_deudor_alterno column
 * @method ResumenQuery orderByColoniaDeudorAlterno($order = Criteria::ASC) Order by the colonia_deudor_alterno column
 * @method ResumenQuery orderByCiudadDeudorAlterno($order = Criteria::ASC) Order by the ciudad_deudor_alterno column
 * @method ResumenQuery orderByEstadoDeudorAlterno($order = Criteria::ASC) Order by the estado_deudor_alterno column
 * @method ResumenQuery orderByCpDeudorAterno($order = Criteria::ASC) Order by the cp_deudor_aterno column
 * @method ResumenQuery orderByTel1Alterno($order = Criteria::ASC) Order by the tel_1_alterno column
 * @method ResumenQuery orderByTel2Alterno($order = Criteria::ASC) Order by the tel_2_alterno column
 * @method ResumenQuery orderByTel3Alterno($order = Criteria::ASC) Order by the tel_3_alterno column
 * @method ResumenQuery orderByTel4Alterno($order = Criteria::ASC) Order by the tel_4_alterno column
 * @method ResumenQuery orderByPlanoGuiaRojiAlterno($order = Criteria::ASC) Order by the plano_guia_roji_alterno column
 * @method ResumenQuery orderByCuadranteGuiaRojiAlterno($order = Criteria::ASC) Order by the cuadrante_guia_roji_alterno column
 * @method ResumenQuery orderByStatusAarsa($order = Criteria::ASC) Order by the status_aarsa column
 * @method ResumenQuery orderByAvapar($order = Criteria::ASC) Order by the avapar column
 * @method ResumenQuery orderByParentescoRef1($order = Criteria::ASC) Order by the parentesco_ref_1 column
 * @method ResumenQuery orderByNombreReferencia1($order = Criteria::ASC) Order by the nombre_referencia_1 column
 * @method ResumenQuery orderByDomicilioReferencia1($order = Criteria::ASC) Order by the domicilio_referencia_1 column
 * @method ResumenQuery orderByColoniaReferencia1($order = Criteria::ASC) Order by the colonia_referencia_1 column
 * @method ResumenQuery orderByCiudadReferencia1($order = Criteria::ASC) Order by the ciudad_referencia_1 column
 * @method ResumenQuery orderByEstadoReferencia1($order = Criteria::ASC) Order by the estado_referencia_1 column
 * @method ResumenQuery orderByCpReferencia1($order = Criteria::ASC) Order by the cp_referencia_1 column
 * @method ResumenQuery orderByTel1Ref1($order = Criteria::ASC) Order by the tel_1_ref_1 column
 * @method ResumenQuery orderByTel2Ref1($order = Criteria::ASC) Order by the tel_2_ref_1 column
 * @method ResumenQuery orderByParentescoRef2($order = Criteria::ASC) Order by the parentesco_ref_2 column
 * @method ResumenQuery orderByNombreReferencia2($order = Criteria::ASC) Order by the nombre_referencia_2 column
 * @method ResumenQuery orderByDomicilioReferencia2($order = Criteria::ASC) Order by the domicilio_referencia_2 column
 * @method ResumenQuery orderByColoniaReferencia2($order = Criteria::ASC) Order by the colonia_referencia_2 column
 * @method ResumenQuery orderByCiudadReferencia2($order = Criteria::ASC) Order by the ciudad_referencia_2 column
 * @method ResumenQuery orderByEstadoReferencia2($order = Criteria::ASC) Order by the estado_referencia_2 column
 * @method ResumenQuery orderByCpReferencia2($order = Criteria::ASC) Order by the cp_referencia_2 column
 * @method ResumenQuery orderByTel1Ref2($order = Criteria::ASC) Order by the tel_1_ref_2 column
 * @method ResumenQuery orderByTel2Ref2($order = Criteria::ASC) Order by the tel_2_ref_2 column
 * @method ResumenQuery orderByParentescoRef3($order = Criteria::ASC) Order by the parentesco_ref_3 column
 * @method ResumenQuery orderByNombreReferencia3($order = Criteria::ASC) Order by the nombre_referencia_3 column
 * @method ResumenQuery orderByDomicilioReferencia3($order = Criteria::ASC) Order by the domicilio_referencia_3 column
 * @method ResumenQuery orderByColoniaReferencia3($order = Criteria::ASC) Order by the colonia_referencia_3 column
 * @method ResumenQuery orderByCiudadReferencia3($order = Criteria::ASC) Order by the ciudad_referencia_3 column
 * @method ResumenQuery orderByEstadoReferencia3($order = Criteria::ASC) Order by the estado_referencia_3 column
 * @method ResumenQuery orderByCpReferencia3($order = Criteria::ASC) Order by the cp_referencia_3 column
 * @method ResumenQuery orderByTel1Ref3($order = Criteria::ASC) Order by the tel_1_ref_3 column
 * @method ResumenQuery orderByTel2Ref3($order = Criteria::ASC) Order by the tel_2_ref_3 column
 * @method ResumenQuery orderByParentescoRef4($order = Criteria::ASC) Order by the parentesco_ref_4 column
 * @method ResumenQuery orderByNombreReferencia4($order = Criteria::ASC) Order by the nombre_referencia_4 column
 * @method ResumenQuery orderByDomicilioDeudor2($order = Criteria::ASC) Order by the domicilio_deudor_2 column
 * @method ResumenQuery orderByFrecuencia($order = Criteria::ASC) Order by the frecuencia column
 * @method ResumenQuery orderByOriginacion($order = Criteria::ASC) Order by the originacion column
 * @method ResumenQuery orderBySucursalCliente($order = Criteria::ASC) Order by the sucursal_cliente column
 * @method ResumenQuery orderByCpReferencia4($order = Criteria::ASC) Order by the cp_referencia_4 column
 * @method ResumenQuery orderByTel1Ref4($order = Criteria::ASC) Order by the tel_1_ref_4 column
 * @method ResumenQuery orderByTel2Ref4($order = Criteria::ASC) Order by the tel_2_ref_4 column
 * @method ResumenQuery orderByDomicilioLaboral($order = Criteria::ASC) Order by the domicilio_laboral column
 * @method ResumenQuery orderByColoniaLaboral($order = Criteria::ASC) Order by the colonia_laboral column
 * @method ResumenQuery orderByCiudadLaboral($order = Criteria::ASC) Order by the ciudad_laboral column
 * @method ResumenQuery orderByEstadoLaboral($order = Criteria::ASC) Order by the estado_laboral column
 * @method ResumenQuery orderByCpLaboral($order = Criteria::ASC) Order by the cp_laboral column
 * @method ResumenQuery orderByTel1Laboral($order = Criteria::ASC) Order by the tel_1_laboral column
 * @method ResumenQuery orderByTel2Laboral($order = Criteria::ASC) Order by the tel_2_laboral column
 * @method ResumenQuery orderBySaldoCorriente($order = Criteria::ASC) Order by the saldo_corriente column
 * @method ResumenQuery orderByFechaDeActualizacion($order = Criteria::ASC) Order by the fecha_de_actualizacion column
 * @method ResumenQuery orderByNumeroDeCuenta($order = Criteria::ASC) Order by the numero_de_cuenta column
 * @method ResumenQuery orderByNumeroDeCredito($order = Criteria::ASC) Order by the numero_de_credito column
 * @method ResumenQuery orderByContrato($order = Criteria::ASC) Order by the contrato column
 * @method ResumenQuery orderBySaldoTotal($order = Criteria::ASC) Order by the saldo_total column
 * @method ResumenQuery orderBySaldoVencido($order = Criteria::ASC) Order by the saldo_vencido column
 * @method ResumenQuery orderBySaldoDescuento1($order = Criteria::ASC) Order by the saldo_descuento_1 column
 * @method ResumenQuery orderBySaldoDescuento2($order = Criteria::ASC) Order by the saldo_descuento_2 column
 * @method ResumenQuery orderByFechaCorte($order = Criteria::ASC) Order by the fecha_corte column
 * @method ResumenQuery orderByFechaLimite($order = Criteria::ASC) Order by the fecha_limite column
 * @method ResumenQuery orderByFechaDeUltimoPago($order = Criteria::ASC) Order by the fecha_de_ultimo_pago column
 * @method ResumenQuery orderByMontoUltimoPago($order = Criteria::ASC) Order by the monto_ultimo_pago column
 * @method ResumenQuery orderByProducto($order = Criteria::ASC) Order by the producto column
 * @method ResumenQuery orderBySubproducto($order = Criteria::ASC) Order by the subproducto column
 * @method ResumenQuery orderByCliente($order = Criteria::ASC) Order by the cliente column
 * @method ResumenQuery orderByStatusDeCredito($order = Criteria::ASC) Order by the status_de_credito column
 * @method ResumenQuery orderByPagosVencidos($order = Criteria::ASC) Order by the pagos_vencidos column
 * @method ResumenQuery orderByMontoAdeudado($order = Criteria::ASC) Order by the monto_adeudado column
 * @method ResumenQuery orderByFechaDeAsignacion($order = Criteria::ASC) Order by the fecha_de_asignacion column
 * @method ResumenQuery orderByFechaDeDeasignacion($order = Criteria::ASC) Order by the fecha_de_deasignacion column
 * @method ResumenQuery orderByCuentaConcentradora1($order = Criteria::ASC) Order by the cuenta_concentradora_1 column
 * @method ResumenQuery orderBySaldoCuota($order = Criteria::ASC) Order by the saldo_cuota column
 * @method ResumenQuery orderByEmailDeudor($order = Criteria::ASC) Order by the email_deudor column
 * @method ResumenQuery orderByIdCuenta($order = Criteria::ASC) Order by the id_cuenta column
 * @method ResumenQuery orderByNss($order = Criteria::ASC) Order by the nss column
 * @method ResumenQuery orderByRfcDeudor($order = Criteria::ASC) Order by the rfc_deudor column
 * @method ResumenQuery orderByTelefonosMarcados($order = Criteria::ASC) Order by the telefonos_marcados column
 * @method ResumenQuery orderByTel1Verif($order = Criteria::ASC) Order by the tel_1_verif column
 * @method ResumenQuery orderByTel2Verif($order = Criteria::ASC) Order by the tel_2_verif column
 * @method ResumenQuery orderByTel3Verif($order = Criteria::ASC) Order by the tel_3_verif column
 * @method ResumenQuery orderByTel4Verif($order = Criteria::ASC) Order by the tel_4_verif column
 * @method ResumenQuery orderByTelefonoDeUltimoContacto($order = Criteria::ASC) Order by the telefono_de_ultimo_contacto column
 * @method ResumenQuery orderByDiasVencidos($order = Criteria::ASC) Order by the dias_vencidos column
 * @method ResumenQuery orderByEjecutivoAsignadoCallCenter($order = Criteria::ASC) Order by the ejecutivo_asignado_call_center column
 * @method ResumenQuery orderByEjecutivoAsignadoDomiciliario($order = Criteria::ASC) Order by the ejecutivo_asignado_domiciliario column
 * @method ResumenQuery orderByPrioridadDeGestion($order = Criteria::ASC) Order by the prioridad_de_gestion column
 * @method ResumenQuery orderByNrpp($order = Criteria::ASC) Order by the nrpp column
 * @method ResumenQuery orderByParentescoAval($order = Criteria::ASC) Order by the parentesco_aval column
 * @method ResumenQuery orderByLocalizar($order = Criteria::ASC) Order by the localizar column
 * @method ResumenQuery orderByFechaUltimaGestion($order = Criteria::ASC) Order by the fecha_ultima_gestion column
 * @method ResumenQuery orderByEmpresa($order = Criteria::ASC) Order by the empresa column
 * @method ResumenQuery orderByTimelock($order = Criteria::ASC) Order by the timelock column
 * @method ResumenQuery orderByLocker($order = Criteria::ASC) Order by the locker column
 * @method ResumenQuery orderByFechaConvenio($order = Criteria::ASC) Order by the fecha_convenio column
 * @method ResumenQuery orderByEspecial($order = Criteria::ASC) Order by the especial column
 * @method ResumenQuery orderByDireccionNueva($order = Criteria::ASC) Order by the direccion_nueva column
 * @method ResumenQuery orderByNorobot($order = Criteria::ASC) Order by the norobot column
 *
 * @method ResumenQuery groupByNombreDeudor() Group by the nombre_deudor column
 * @method ResumenQuery groupByDomicilioDeudor() Group by the domicilio_deudor column
 * @method ResumenQuery groupByColoniaDeudor() Group by the colonia_deudor column
 * @method ResumenQuery groupByCiudadDeudor() Group by the ciudad_deudor column
 * @method ResumenQuery groupByEstadoDeudor() Group by the estado_deudor column
 * @method ResumenQuery groupByCpDeudor() Group by the cp_deudor column
 * @method ResumenQuery groupByPlanoGuiaRoji() Group by the plano_guia_roji column
 * @method ResumenQuery groupByCuadranteGuiaRoji() Group by the cuadrante_guia_roji column
 * @method ResumenQuery groupByTel1() Group by the tel_1 column
 * @method ResumenQuery groupByTel2() Group by the tel_2 column
 * @method ResumenQuery groupByTel3() Group by the tel_3 column
 * @method ResumenQuery groupByTel4() Group by the tel_4 column
 * @method ResumenQuery groupByNombreDeudorAlterno() Group by the nombre_deudor_alterno column
 * @method ResumenQuery groupByDomicilioDeudorAlterno() Group by the domicilio_deudor_alterno column
 * @method ResumenQuery groupByColoniaDeudorAlterno() Group by the colonia_deudor_alterno column
 * @method ResumenQuery groupByCiudadDeudorAlterno() Group by the ciudad_deudor_alterno column
 * @method ResumenQuery groupByEstadoDeudorAlterno() Group by the estado_deudor_alterno column
 * @method ResumenQuery groupByCpDeudorAterno() Group by the cp_deudor_aterno column
 * @method ResumenQuery groupByTel1Alterno() Group by the tel_1_alterno column
 * @method ResumenQuery groupByTel2Alterno() Group by the tel_2_alterno column
 * @method ResumenQuery groupByTel3Alterno() Group by the tel_3_alterno column
 * @method ResumenQuery groupByTel4Alterno() Group by the tel_4_alterno column
 * @method ResumenQuery groupByPlanoGuiaRojiAlterno() Group by the plano_guia_roji_alterno column
 * @method ResumenQuery groupByCuadranteGuiaRojiAlterno() Group by the cuadrante_guia_roji_alterno column
 * @method ResumenQuery groupByStatusAarsa() Group by the status_aarsa column
 * @method ResumenQuery groupByAvapar() Group by the avapar column
 * @method ResumenQuery groupByParentescoRef1() Group by the parentesco_ref_1 column
 * @method ResumenQuery groupByNombreReferencia1() Group by the nombre_referencia_1 column
 * @method ResumenQuery groupByDomicilioReferencia1() Group by the domicilio_referencia_1 column
 * @method ResumenQuery groupByColoniaReferencia1() Group by the colonia_referencia_1 column
 * @method ResumenQuery groupByCiudadReferencia1() Group by the ciudad_referencia_1 column
 * @method ResumenQuery groupByEstadoReferencia1() Group by the estado_referencia_1 column
 * @method ResumenQuery groupByCpReferencia1() Group by the cp_referencia_1 column
 * @method ResumenQuery groupByTel1Ref1() Group by the tel_1_ref_1 column
 * @method ResumenQuery groupByTel2Ref1() Group by the tel_2_ref_1 column
 * @method ResumenQuery groupByParentescoRef2() Group by the parentesco_ref_2 column
 * @method ResumenQuery groupByNombreReferencia2() Group by the nombre_referencia_2 column
 * @method ResumenQuery groupByDomicilioReferencia2() Group by the domicilio_referencia_2 column
 * @method ResumenQuery groupByColoniaReferencia2() Group by the colonia_referencia_2 column
 * @method ResumenQuery groupByCiudadReferencia2() Group by the ciudad_referencia_2 column
 * @method ResumenQuery groupByEstadoReferencia2() Group by the estado_referencia_2 column
 * @method ResumenQuery groupByCpReferencia2() Group by the cp_referencia_2 column
 * @method ResumenQuery groupByTel1Ref2() Group by the tel_1_ref_2 column
 * @method ResumenQuery groupByTel2Ref2() Group by the tel_2_ref_2 column
 * @method ResumenQuery groupByParentescoRef3() Group by the parentesco_ref_3 column
 * @method ResumenQuery groupByNombreReferencia3() Group by the nombre_referencia_3 column
 * @method ResumenQuery groupByDomicilioReferencia3() Group by the domicilio_referencia_3 column
 * @method ResumenQuery groupByColoniaReferencia3() Group by the colonia_referencia_3 column
 * @method ResumenQuery groupByCiudadReferencia3() Group by the ciudad_referencia_3 column
 * @method ResumenQuery groupByEstadoReferencia3() Group by the estado_referencia_3 column
 * @method ResumenQuery groupByCpReferencia3() Group by the cp_referencia_3 column
 * @method ResumenQuery groupByTel1Ref3() Group by the tel_1_ref_3 column
 * @method ResumenQuery groupByTel2Ref3() Group by the tel_2_ref_3 column
 * @method ResumenQuery groupByParentescoRef4() Group by the parentesco_ref_4 column
 * @method ResumenQuery groupByNombreReferencia4() Group by the nombre_referencia_4 column
 * @method ResumenQuery groupByDomicilioDeudor2() Group by the domicilio_deudor_2 column
 * @method ResumenQuery groupByFrecuencia() Group by the frecuencia column
 * @method ResumenQuery groupByOriginacion() Group by the originacion column
 * @method ResumenQuery groupBySucursalCliente() Group by the sucursal_cliente column
 * @method ResumenQuery groupByCpReferencia4() Group by the cp_referencia_4 column
 * @method ResumenQuery groupByTel1Ref4() Group by the tel_1_ref_4 column
 * @method ResumenQuery groupByTel2Ref4() Group by the tel_2_ref_4 column
 * @method ResumenQuery groupByDomicilioLaboral() Group by the domicilio_laboral column
 * @method ResumenQuery groupByColoniaLaboral() Group by the colonia_laboral column
 * @method ResumenQuery groupByCiudadLaboral() Group by the ciudad_laboral column
 * @method ResumenQuery groupByEstadoLaboral() Group by the estado_laboral column
 * @method ResumenQuery groupByCpLaboral() Group by the cp_laboral column
 * @method ResumenQuery groupByTel1Laboral() Group by the tel_1_laboral column
 * @method ResumenQuery groupByTel2Laboral() Group by the tel_2_laboral column
 * @method ResumenQuery groupBySaldoCorriente() Group by the saldo_corriente column
 * @method ResumenQuery groupByFechaDeActualizacion() Group by the fecha_de_actualizacion column
 * @method ResumenQuery groupByNumeroDeCuenta() Group by the numero_de_cuenta column
 * @method ResumenQuery groupByNumeroDeCredito() Group by the numero_de_credito column
 * @method ResumenQuery groupByContrato() Group by the contrato column
 * @method ResumenQuery groupBySaldoTotal() Group by the saldo_total column
 * @method ResumenQuery groupBySaldoVencido() Group by the saldo_vencido column
 * @method ResumenQuery groupBySaldoDescuento1() Group by the saldo_descuento_1 column
 * @method ResumenQuery groupBySaldoDescuento2() Group by the saldo_descuento_2 column
 * @method ResumenQuery groupByFechaCorte() Group by the fecha_corte column
 * @method ResumenQuery groupByFechaLimite() Group by the fecha_limite column
 * @method ResumenQuery groupByFechaDeUltimoPago() Group by the fecha_de_ultimo_pago column
 * @method ResumenQuery groupByMontoUltimoPago() Group by the monto_ultimo_pago column
 * @method ResumenQuery groupByProducto() Group by the producto column
 * @method ResumenQuery groupBySubproducto() Group by the subproducto column
 * @method ResumenQuery groupByCliente() Group by the cliente column
 * @method ResumenQuery groupByStatusDeCredito() Group by the status_de_credito column
 * @method ResumenQuery groupByPagosVencidos() Group by the pagos_vencidos column
 * @method ResumenQuery groupByMontoAdeudado() Group by the monto_adeudado column
 * @method ResumenQuery groupByFechaDeAsignacion() Group by the fecha_de_asignacion column
 * @method ResumenQuery groupByFechaDeDeasignacion() Group by the fecha_de_deasignacion column
 * @method ResumenQuery groupByCuentaConcentradora1() Group by the cuenta_concentradora_1 column
 * @method ResumenQuery groupBySaldoCuota() Group by the saldo_cuota column
 * @method ResumenQuery groupByEmailDeudor() Group by the email_deudor column
 * @method ResumenQuery groupByIdCuenta() Group by the id_cuenta column
 * @method ResumenQuery groupByNss() Group by the nss column
 * @method ResumenQuery groupByRfcDeudor() Group by the rfc_deudor column
 * @method ResumenQuery groupByTelefonosMarcados() Group by the telefonos_marcados column
 * @method ResumenQuery groupByTel1Verif() Group by the tel_1_verif column
 * @method ResumenQuery groupByTel2Verif() Group by the tel_2_verif column
 * @method ResumenQuery groupByTel3Verif() Group by the tel_3_verif column
 * @method ResumenQuery groupByTel4Verif() Group by the tel_4_verif column
 * @method ResumenQuery groupByTelefonoDeUltimoContacto() Group by the telefono_de_ultimo_contacto column
 * @method ResumenQuery groupByDiasVencidos() Group by the dias_vencidos column
 * @method ResumenQuery groupByEjecutivoAsignadoCallCenter() Group by the ejecutivo_asignado_call_center column
 * @method ResumenQuery groupByEjecutivoAsignadoDomiciliario() Group by the ejecutivo_asignado_domiciliario column
 * @method ResumenQuery groupByPrioridadDeGestion() Group by the prioridad_de_gestion column
 * @method ResumenQuery groupByNrpp() Group by the nrpp column
 * @method ResumenQuery groupByParentescoAval() Group by the parentesco_aval column
 * @method ResumenQuery groupByLocalizar() Group by the localizar column
 * @method ResumenQuery groupByFechaUltimaGestion() Group by the fecha_ultima_gestion column
 * @method ResumenQuery groupByEmpresa() Group by the empresa column
 * @method ResumenQuery groupByTimelock() Group by the timelock column
 * @method ResumenQuery groupByLocker() Group by the locker column
 * @method ResumenQuery groupByFechaConvenio() Group by the fecha_convenio column
 * @method ResumenQuery groupByEspecial() Group by the especial column
 * @method ResumenQuery groupByDireccionNueva() Group by the direccion_nueva column
 * @method ResumenQuery groupByNorobot() Group by the norobot column
 *
 * @method ResumenQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method ResumenQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method ResumenQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Resumen findOne(PropelPDO $con = null) Return the first Resumen matching the query
 * @method Resumen findOneOrCreate(PropelPDO $con = null) Return the first Resumen matching the query, or a new Resumen object populated from the query conditions when no match is found
 *
 * @method Resumen findOneByNombreDeudor(string $nombre_deudor) Return the first Resumen filtered by the nombre_deudor column
 * @method Resumen findOneByDomicilioDeudor(string $domicilio_deudor) Return the first Resumen filtered by the domicilio_deudor column
 * @method Resumen findOneByColoniaDeudor(string $colonia_deudor) Return the first Resumen filtered by the colonia_deudor column
 * @method Resumen findOneByCiudadDeudor(string $ciudad_deudor) Return the first Resumen filtered by the ciudad_deudor column
 * @method Resumen findOneByEstadoDeudor(string $estado_deudor) Return the first Resumen filtered by the estado_deudor column
 * @method Resumen findOneByCpDeudor(string $cp_deudor) Return the first Resumen filtered by the cp_deudor column
 * @method Resumen findOneByPlanoGuiaRoji(string $plano_guia_roji) Return the first Resumen filtered by the plano_guia_roji column
 * @method Resumen findOneByCuadranteGuiaRoji(string $cuadrante_guia_roji) Return the first Resumen filtered by the cuadrante_guia_roji column
 * @method Resumen findOneByTel1(string $tel_1) Return the first Resumen filtered by the tel_1 column
 * @method Resumen findOneByTel2(string $tel_2) Return the first Resumen filtered by the tel_2 column
 * @method Resumen findOneByTel3(string $tel_3) Return the first Resumen filtered by the tel_3 column
 * @method Resumen findOneByTel4(string $tel_4) Return the first Resumen filtered by the tel_4 column
 * @method Resumen findOneByNombreDeudorAlterno(string $nombre_deudor_alterno) Return the first Resumen filtered by the nombre_deudor_alterno column
 * @method Resumen findOneByDomicilioDeudorAlterno(string $domicilio_deudor_alterno) Return the first Resumen filtered by the domicilio_deudor_alterno column
 * @method Resumen findOneByColoniaDeudorAlterno(string $colonia_deudor_alterno) Return the first Resumen filtered by the colonia_deudor_alterno column
 * @method Resumen findOneByCiudadDeudorAlterno(string $ciudad_deudor_alterno) Return the first Resumen filtered by the ciudad_deudor_alterno column
 * @method Resumen findOneByEstadoDeudorAlterno(string $estado_deudor_alterno) Return the first Resumen filtered by the estado_deudor_alterno column
 * @method Resumen findOneByCpDeudorAterno(string $cp_deudor_aterno) Return the first Resumen filtered by the cp_deudor_aterno column
 * @method Resumen findOneByTel1Alterno(string $tel_1_alterno) Return the first Resumen filtered by the tel_1_alterno column
 * @method Resumen findOneByTel2Alterno(string $tel_2_alterno) Return the first Resumen filtered by the tel_2_alterno column
 * @method Resumen findOneByTel3Alterno(string $tel_3_alterno) Return the first Resumen filtered by the tel_3_alterno column
 * @method Resumen findOneByTel4Alterno(string $tel_4_alterno) Return the first Resumen filtered by the tel_4_alterno column
 * @method Resumen findOneByPlanoGuiaRojiAlterno(string $plano_guia_roji_alterno) Return the first Resumen filtered by the plano_guia_roji_alterno column
 * @method Resumen findOneByCuadranteGuiaRojiAlterno(string $cuadrante_guia_roji_alterno) Return the first Resumen filtered by the cuadrante_guia_roji_alterno column
 * @method Resumen findOneByStatusAarsa(string $status_aarsa) Return the first Resumen filtered by the status_aarsa column
 * @method Resumen findOneByAvapar(string $avapar) Return the first Resumen filtered by the avapar column
 * @method Resumen findOneByParentescoRef1(string $parentesco_ref_1) Return the first Resumen filtered by the parentesco_ref_1 column
 * @method Resumen findOneByNombreReferencia1(string $nombre_referencia_1) Return the first Resumen filtered by the nombre_referencia_1 column
 * @method Resumen findOneByDomicilioReferencia1(string $domicilio_referencia_1) Return the first Resumen filtered by the domicilio_referencia_1 column
 * @method Resumen findOneByColoniaReferencia1(string $colonia_referencia_1) Return the first Resumen filtered by the colonia_referencia_1 column
 * @method Resumen findOneByCiudadReferencia1(string $ciudad_referencia_1) Return the first Resumen filtered by the ciudad_referencia_1 column
 * @method Resumen findOneByEstadoReferencia1(string $estado_referencia_1) Return the first Resumen filtered by the estado_referencia_1 column
 * @method Resumen findOneByCpReferencia1(string $cp_referencia_1) Return the first Resumen filtered by the cp_referencia_1 column
 * @method Resumen findOneByTel1Ref1(string $tel_1_ref_1) Return the first Resumen filtered by the tel_1_ref_1 column
 * @method Resumen findOneByTel2Ref1(string $tel_2_ref_1) Return the first Resumen filtered by the tel_2_ref_1 column
 * @method Resumen findOneByParentescoRef2(string $parentesco_ref_2) Return the first Resumen filtered by the parentesco_ref_2 column
 * @method Resumen findOneByNombreReferencia2(string $nombre_referencia_2) Return the first Resumen filtered by the nombre_referencia_2 column
 * @method Resumen findOneByDomicilioReferencia2(string $domicilio_referencia_2) Return the first Resumen filtered by the domicilio_referencia_2 column
 * @method Resumen findOneByColoniaReferencia2(string $colonia_referencia_2) Return the first Resumen filtered by the colonia_referencia_2 column
 * @method Resumen findOneByCiudadReferencia2(string $ciudad_referencia_2) Return the first Resumen filtered by the ciudad_referencia_2 column
 * @method Resumen findOneByEstadoReferencia2(string $estado_referencia_2) Return the first Resumen filtered by the estado_referencia_2 column
 * @method Resumen findOneByCpReferencia2(string $cp_referencia_2) Return the first Resumen filtered by the cp_referencia_2 column
 * @method Resumen findOneByTel1Ref2(string $tel_1_ref_2) Return the first Resumen filtered by the tel_1_ref_2 column
 * @method Resumen findOneByTel2Ref2(string $tel_2_ref_2) Return the first Resumen filtered by the tel_2_ref_2 column
 * @method Resumen findOneByParentescoRef3(string $parentesco_ref_3) Return the first Resumen filtered by the parentesco_ref_3 column
 * @method Resumen findOneByNombreReferencia3(string $nombre_referencia_3) Return the first Resumen filtered by the nombre_referencia_3 column
 * @method Resumen findOneByDomicilioReferencia3(string $domicilio_referencia_3) Return the first Resumen filtered by the domicilio_referencia_3 column
 * @method Resumen findOneByColoniaReferencia3(string $colonia_referencia_3) Return the first Resumen filtered by the colonia_referencia_3 column
 * @method Resumen findOneByCiudadReferencia3(string $ciudad_referencia_3) Return the first Resumen filtered by the ciudad_referencia_3 column
 * @method Resumen findOneByEstadoReferencia3(string $estado_referencia_3) Return the first Resumen filtered by the estado_referencia_3 column
 * @method Resumen findOneByCpReferencia3(string $cp_referencia_3) Return the first Resumen filtered by the cp_referencia_3 column
 * @method Resumen findOneByTel1Ref3(string $tel_1_ref_3) Return the first Resumen filtered by the tel_1_ref_3 column
 * @method Resumen findOneByTel2Ref3(string $tel_2_ref_3) Return the first Resumen filtered by the tel_2_ref_3 column
 * @method Resumen findOneByParentescoRef4(string $parentesco_ref_4) Return the first Resumen filtered by the parentesco_ref_4 column
 * @method Resumen findOneByNombreReferencia4(string $nombre_referencia_4) Return the first Resumen filtered by the nombre_referencia_4 column
 * @method Resumen findOneByDomicilioDeudor2(string $domicilio_deudor_2) Return the first Resumen filtered by the domicilio_deudor_2 column
 * @method Resumen findOneByFrecuencia(string $frecuencia) Return the first Resumen filtered by the frecuencia column
 * @method Resumen findOneByOriginacion(string $originacion) Return the first Resumen filtered by the originacion column
 * @method Resumen findOneBySucursalCliente(string $sucursal_cliente) Return the first Resumen filtered by the sucursal_cliente column
 * @method Resumen findOneByCpReferencia4(string $cp_referencia_4) Return the first Resumen filtered by the cp_referencia_4 column
 * @method Resumen findOneByTel1Ref4(string $tel_1_ref_4) Return the first Resumen filtered by the tel_1_ref_4 column
 * @method Resumen findOneByTel2Ref4(string $tel_2_ref_4) Return the first Resumen filtered by the tel_2_ref_4 column
 * @method Resumen findOneByDomicilioLaboral(string $domicilio_laboral) Return the first Resumen filtered by the domicilio_laboral column
 * @method Resumen findOneByColoniaLaboral(string $colonia_laboral) Return the first Resumen filtered by the colonia_laboral column
 * @method Resumen findOneByCiudadLaboral(string $ciudad_laboral) Return the first Resumen filtered by the ciudad_laboral column
 * @method Resumen findOneByEstadoLaboral(string $estado_laboral) Return the first Resumen filtered by the estado_laboral column
 * @method Resumen findOneByCpLaboral(string $cp_laboral) Return the first Resumen filtered by the cp_laboral column
 * @method Resumen findOneByTel1Laboral(string $tel_1_laboral) Return the first Resumen filtered by the tel_1_laboral column
 * @method Resumen findOneByTel2Laboral(string $tel_2_laboral) Return the first Resumen filtered by the tel_2_laboral column
 * @method Resumen findOneBySaldoCorriente(string $saldo_corriente) Return the first Resumen filtered by the saldo_corriente column
 * @method Resumen findOneByFechaDeActualizacion(string $fecha_de_actualizacion) Return the first Resumen filtered by the fecha_de_actualizacion column
 * @method Resumen findOneByNumeroDeCuenta(string $numero_de_cuenta) Return the first Resumen filtered by the numero_de_cuenta column
 * @method Resumen findOneByNumeroDeCredito(string $numero_de_credito) Return the first Resumen filtered by the numero_de_credito column
 * @method Resumen findOneByContrato(string $contrato) Return the first Resumen filtered by the contrato column
 * @method Resumen findOneBySaldoTotal(string $saldo_total) Return the first Resumen filtered by the saldo_total column
 * @method Resumen findOneBySaldoVencido(string $saldo_vencido) Return the first Resumen filtered by the saldo_vencido column
 * @method Resumen findOneBySaldoDescuento1(string $saldo_descuento_1) Return the first Resumen filtered by the saldo_descuento_1 column
 * @method Resumen findOneBySaldoDescuento2(string $saldo_descuento_2) Return the first Resumen filtered by the saldo_descuento_2 column
 * @method Resumen findOneByFechaCorte(string $fecha_corte) Return the first Resumen filtered by the fecha_corte column
 * @method Resumen findOneByFechaLimite(string $fecha_limite) Return the first Resumen filtered by the fecha_limite column
 * @method Resumen findOneByFechaDeUltimoPago(string $fecha_de_ultimo_pago) Return the first Resumen filtered by the fecha_de_ultimo_pago column
 * @method Resumen findOneByMontoUltimoPago(string $monto_ultimo_pago) Return the first Resumen filtered by the monto_ultimo_pago column
 * @method Resumen findOneByProducto(string $producto) Return the first Resumen filtered by the producto column
 * @method Resumen findOneBySubproducto(string $subproducto) Return the first Resumen filtered by the subproducto column
 * @method Resumen findOneByCliente(string $cliente) Return the first Resumen filtered by the cliente column
 * @method Resumen findOneByStatusDeCredito(string $status_de_credito) Return the first Resumen filtered by the status_de_credito column
 * @method Resumen findOneByPagosVencidos(int $pagos_vencidos) Return the first Resumen filtered by the pagos_vencidos column
 * @method Resumen findOneByMontoAdeudado(string $monto_adeudado) Return the first Resumen filtered by the monto_adeudado column
 * @method Resumen findOneByFechaDeAsignacion(string $fecha_de_asignacion) Return the first Resumen filtered by the fecha_de_asignacion column
 * @method Resumen findOneByFechaDeDeasignacion(string $fecha_de_deasignacion) Return the first Resumen filtered by the fecha_de_deasignacion column
 * @method Resumen findOneByCuentaConcentradora1(string $cuenta_concentradora_1) Return the first Resumen filtered by the cuenta_concentradora_1 column
 * @method Resumen findOneBySaldoCuota(string $saldo_cuota) Return the first Resumen filtered by the saldo_cuota column
 * @method Resumen findOneByEmailDeudor(string $email_deudor) Return the first Resumen filtered by the email_deudor column
 * @method Resumen findOneByNss(string $nss) Return the first Resumen filtered by the nss column
 * @method Resumen findOneByRfcDeudor(string $rfc_deudor) Return the first Resumen filtered by the rfc_deudor column
 * @method Resumen findOneByTelefonosMarcados(string $telefonos_marcados) Return the first Resumen filtered by the telefonos_marcados column
 * @method Resumen findOneByTel1Verif(string $tel_1_verif) Return the first Resumen filtered by the tel_1_verif column
 * @method Resumen findOneByTel2Verif(string $tel_2_verif) Return the first Resumen filtered by the tel_2_verif column
 * @method Resumen findOneByTel3Verif(string $tel_3_verif) Return the first Resumen filtered by the tel_3_verif column
 * @method Resumen findOneByTel4Verif(string $tel_4_verif) Return the first Resumen filtered by the tel_4_verif column
 * @method Resumen findOneByTelefonoDeUltimoContacto(string $telefono_de_ultimo_contacto) Return the first Resumen filtered by the telefono_de_ultimo_contacto column
 * @method Resumen findOneByDiasVencidos(int $dias_vencidos) Return the first Resumen filtered by the dias_vencidos column
 * @method Resumen findOneByEjecutivoAsignadoCallCenter(string $ejecutivo_asignado_call_center) Return the first Resumen filtered by the ejecutivo_asignado_call_center column
 * @method Resumen findOneByEjecutivoAsignadoDomiciliario(string $ejecutivo_asignado_domiciliario) Return the first Resumen filtered by the ejecutivo_asignado_domiciliario column
 * @method Resumen findOneByPrioridadDeGestion(int $prioridad_de_gestion) Return the first Resumen filtered by the prioridad_de_gestion column
 * @method Resumen findOneByNrpp(string $nrpp) Return the first Resumen filtered by the nrpp column
 * @method Resumen findOneByParentescoAval(string $parentesco_aval) Return the first Resumen filtered by the parentesco_aval column
 * @method Resumen findOneByLocalizar(boolean $localizar) Return the first Resumen filtered by the localizar column
 * @method Resumen findOneByFechaUltimaGestion(string $fecha_ultima_gestion) Return the first Resumen filtered by the fecha_ultima_gestion column
 * @method Resumen findOneByEmpresa(string $empresa) Return the first Resumen filtered by the empresa column
 * @method Resumen findOneByTimelock(string $timelock) Return the first Resumen filtered by the timelock column
 * @method Resumen findOneByLocker(string $locker) Return the first Resumen filtered by the locker column
 * @method Resumen findOneByFechaConvenio(string $fecha_convenio) Return the first Resumen filtered by the fecha_convenio column
 * @method Resumen findOneByEspecial(boolean $especial) Return the first Resumen filtered by the especial column
 * @method Resumen findOneByDireccionNueva(string $direccion_nueva) Return the first Resumen filtered by the direccion_nueva column
 * @method Resumen findOneByNorobot(string $norobot) Return the first Resumen filtered by the norobot column
 *
 * @method array findByNombreDeudor(string $nombre_deudor) Return Resumen objects filtered by the nombre_deudor column
 * @method array findByDomicilioDeudor(string $domicilio_deudor) Return Resumen objects filtered by the domicilio_deudor column
 * @method array findByColoniaDeudor(string $colonia_deudor) Return Resumen objects filtered by the colonia_deudor column
 * @method array findByCiudadDeudor(string $ciudad_deudor) Return Resumen objects filtered by the ciudad_deudor column
 * @method array findByEstadoDeudor(string $estado_deudor) Return Resumen objects filtered by the estado_deudor column
 * @method array findByCpDeudor(string $cp_deudor) Return Resumen objects filtered by the cp_deudor column
 * @method array findByPlanoGuiaRoji(string $plano_guia_roji) Return Resumen objects filtered by the plano_guia_roji column
 * @method array findByCuadranteGuiaRoji(string $cuadrante_guia_roji) Return Resumen objects filtered by the cuadrante_guia_roji column
 * @method array findByTel1(string $tel_1) Return Resumen objects filtered by the tel_1 column
 * @method array findByTel2(string $tel_2) Return Resumen objects filtered by the tel_2 column
 * @method array findByTel3(string $tel_3) Return Resumen objects filtered by the tel_3 column
 * @method array findByTel4(string $tel_4) Return Resumen objects filtered by the tel_4 column
 * @method array findByNombreDeudorAlterno(string $nombre_deudor_alterno) Return Resumen objects filtered by the nombre_deudor_alterno column
 * @method array findByDomicilioDeudorAlterno(string $domicilio_deudor_alterno) Return Resumen objects filtered by the domicilio_deudor_alterno column
 * @method array findByColoniaDeudorAlterno(string $colonia_deudor_alterno) Return Resumen objects filtered by the colonia_deudor_alterno column
 * @method array findByCiudadDeudorAlterno(string $ciudad_deudor_alterno) Return Resumen objects filtered by the ciudad_deudor_alterno column
 * @method array findByEstadoDeudorAlterno(string $estado_deudor_alterno) Return Resumen objects filtered by the estado_deudor_alterno column
 * @method array findByCpDeudorAterno(string $cp_deudor_aterno) Return Resumen objects filtered by the cp_deudor_aterno column
 * @method array findByTel1Alterno(string $tel_1_alterno) Return Resumen objects filtered by the tel_1_alterno column
 * @method array findByTel2Alterno(string $tel_2_alterno) Return Resumen objects filtered by the tel_2_alterno column
 * @method array findByTel3Alterno(string $tel_3_alterno) Return Resumen objects filtered by the tel_3_alterno column
 * @method array findByTel4Alterno(string $tel_4_alterno) Return Resumen objects filtered by the tel_4_alterno column
 * @method array findByPlanoGuiaRojiAlterno(string $plano_guia_roji_alterno) Return Resumen objects filtered by the plano_guia_roji_alterno column
 * @method array findByCuadranteGuiaRojiAlterno(string $cuadrante_guia_roji_alterno) Return Resumen objects filtered by the cuadrante_guia_roji_alterno column
 * @method array findByStatusAarsa(string $status_aarsa) Return Resumen objects filtered by the status_aarsa column
 * @method array findByAvapar(string $avapar) Return Resumen objects filtered by the avapar column
 * @method array findByParentescoRef1(string $parentesco_ref_1) Return Resumen objects filtered by the parentesco_ref_1 column
 * @method array findByNombreReferencia1(string $nombre_referencia_1) Return Resumen objects filtered by the nombre_referencia_1 column
 * @method array findByDomicilioReferencia1(string $domicilio_referencia_1) Return Resumen objects filtered by the domicilio_referencia_1 column
 * @method array findByColoniaReferencia1(string $colonia_referencia_1) Return Resumen objects filtered by the colonia_referencia_1 column
 * @method array findByCiudadReferencia1(string $ciudad_referencia_1) Return Resumen objects filtered by the ciudad_referencia_1 column
 * @method array findByEstadoReferencia1(string $estado_referencia_1) Return Resumen objects filtered by the estado_referencia_1 column
 * @method array findByCpReferencia1(string $cp_referencia_1) Return Resumen objects filtered by the cp_referencia_1 column
 * @method array findByTel1Ref1(string $tel_1_ref_1) Return Resumen objects filtered by the tel_1_ref_1 column
 * @method array findByTel2Ref1(string $tel_2_ref_1) Return Resumen objects filtered by the tel_2_ref_1 column
 * @method array findByParentescoRef2(string $parentesco_ref_2) Return Resumen objects filtered by the parentesco_ref_2 column
 * @method array findByNombreReferencia2(string $nombre_referencia_2) Return Resumen objects filtered by the nombre_referencia_2 column
 * @method array findByDomicilioReferencia2(string $domicilio_referencia_2) Return Resumen objects filtered by the domicilio_referencia_2 column
 * @method array findByColoniaReferencia2(string $colonia_referencia_2) Return Resumen objects filtered by the colonia_referencia_2 column
 * @method array findByCiudadReferencia2(string $ciudad_referencia_2) Return Resumen objects filtered by the ciudad_referencia_2 column
 * @method array findByEstadoReferencia2(string $estado_referencia_2) Return Resumen objects filtered by the estado_referencia_2 column
 * @method array findByCpReferencia2(string $cp_referencia_2) Return Resumen objects filtered by the cp_referencia_2 column
 * @method array findByTel1Ref2(string $tel_1_ref_2) Return Resumen objects filtered by the tel_1_ref_2 column
 * @method array findByTel2Ref2(string $tel_2_ref_2) Return Resumen objects filtered by the tel_2_ref_2 column
 * @method array findByParentescoRef3(string $parentesco_ref_3) Return Resumen objects filtered by the parentesco_ref_3 column
 * @method array findByNombreReferencia3(string $nombre_referencia_3) Return Resumen objects filtered by the nombre_referencia_3 column
 * @method array findByDomicilioReferencia3(string $domicilio_referencia_3) Return Resumen objects filtered by the domicilio_referencia_3 column
 * @method array findByColoniaReferencia3(string $colonia_referencia_3) Return Resumen objects filtered by the colonia_referencia_3 column
 * @method array findByCiudadReferencia3(string $ciudad_referencia_3) Return Resumen objects filtered by the ciudad_referencia_3 column
 * @method array findByEstadoReferencia3(string $estado_referencia_3) Return Resumen objects filtered by the estado_referencia_3 column
 * @method array findByCpReferencia3(string $cp_referencia_3) Return Resumen objects filtered by the cp_referencia_3 column
 * @method array findByTel1Ref3(string $tel_1_ref_3) Return Resumen objects filtered by the tel_1_ref_3 column
 * @method array findByTel2Ref3(string $tel_2_ref_3) Return Resumen objects filtered by the tel_2_ref_3 column
 * @method array findByParentescoRef4(string $parentesco_ref_4) Return Resumen objects filtered by the parentesco_ref_4 column
 * @method array findByNombreReferencia4(string $nombre_referencia_4) Return Resumen objects filtered by the nombre_referencia_4 column
 * @method array findByDomicilioDeudor2(string $domicilio_deudor_2) Return Resumen objects filtered by the domicilio_deudor_2 column
 * @method array findByFrecuencia(string $frecuencia) Return Resumen objects filtered by the frecuencia column
 * @method array findByOriginacion(string $originacion) Return Resumen objects filtered by the originacion column
 * @method array findBySucursalCliente(string $sucursal_cliente) Return Resumen objects filtered by the sucursal_cliente column
 * @method array findByCpReferencia4(string $cp_referencia_4) Return Resumen objects filtered by the cp_referencia_4 column
 * @method array findByTel1Ref4(string $tel_1_ref_4) Return Resumen objects filtered by the tel_1_ref_4 column
 * @method array findByTel2Ref4(string $tel_2_ref_4) Return Resumen objects filtered by the tel_2_ref_4 column
 * @method array findByDomicilioLaboral(string $domicilio_laboral) Return Resumen objects filtered by the domicilio_laboral column
 * @method array findByColoniaLaboral(string $colonia_laboral) Return Resumen objects filtered by the colonia_laboral column
 * @method array findByCiudadLaboral(string $ciudad_laboral) Return Resumen objects filtered by the ciudad_laboral column
 * @method array findByEstadoLaboral(string $estado_laboral) Return Resumen objects filtered by the estado_laboral column
 * @method array findByCpLaboral(string $cp_laboral) Return Resumen objects filtered by the cp_laboral column
 * @method array findByTel1Laboral(string $tel_1_laboral) Return Resumen objects filtered by the tel_1_laboral column
 * @method array findByTel2Laboral(string $tel_2_laboral) Return Resumen objects filtered by the tel_2_laboral column
 * @method array findBySaldoCorriente(string $saldo_corriente) Return Resumen objects filtered by the saldo_corriente column
 * @method array findByFechaDeActualizacion(string $fecha_de_actualizacion) Return Resumen objects filtered by the fecha_de_actualizacion column
 * @method array findByNumeroDeCuenta(string $numero_de_cuenta) Return Resumen objects filtered by the numero_de_cuenta column
 * @method array findByNumeroDeCredito(string $numero_de_credito) Return Resumen objects filtered by the numero_de_credito column
 * @method array findByContrato(string $contrato) Return Resumen objects filtered by the contrato column
 * @method array findBySaldoTotal(string $saldo_total) Return Resumen objects filtered by the saldo_total column
 * @method array findBySaldoVencido(string $saldo_vencido) Return Resumen objects filtered by the saldo_vencido column
 * @method array findBySaldoDescuento1(string $saldo_descuento_1) Return Resumen objects filtered by the saldo_descuento_1 column
 * @method array findBySaldoDescuento2(string $saldo_descuento_2) Return Resumen objects filtered by the saldo_descuento_2 column
 * @method array findByFechaCorte(string $fecha_corte) Return Resumen objects filtered by the fecha_corte column
 * @method array findByFechaLimite(string $fecha_limite) Return Resumen objects filtered by the fecha_limite column
 * @method array findByFechaDeUltimoPago(string $fecha_de_ultimo_pago) Return Resumen objects filtered by the fecha_de_ultimo_pago column
 * @method array findByMontoUltimoPago(string $monto_ultimo_pago) Return Resumen objects filtered by the monto_ultimo_pago column
 * @method array findByProducto(string $producto) Return Resumen objects filtered by the producto column
 * @method array findBySubproducto(string $subproducto) Return Resumen objects filtered by the subproducto column
 * @method array findByCliente(string $cliente) Return Resumen objects filtered by the cliente column
 * @method array findByStatusDeCredito(string $status_de_credito) Return Resumen objects filtered by the status_de_credito column
 * @method array findByPagosVencidos(int $pagos_vencidos) Return Resumen objects filtered by the pagos_vencidos column
 * @method array findByMontoAdeudado(string $monto_adeudado) Return Resumen objects filtered by the monto_adeudado column
 * @method array findByFechaDeAsignacion(string $fecha_de_asignacion) Return Resumen objects filtered by the fecha_de_asignacion column
 * @method array findByFechaDeDeasignacion(string $fecha_de_deasignacion) Return Resumen objects filtered by the fecha_de_deasignacion column
 * @method array findByCuentaConcentradora1(string $cuenta_concentradora_1) Return Resumen objects filtered by the cuenta_concentradora_1 column
 * @method array findBySaldoCuota(string $saldo_cuota) Return Resumen objects filtered by the saldo_cuota column
 * @method array findByEmailDeudor(string $email_deudor) Return Resumen objects filtered by the email_deudor column
 * @method array findByIdCuenta(int $id_cuenta) Return Resumen objects filtered by the id_cuenta column
 * @method array findByNss(string $nss) Return Resumen objects filtered by the nss column
 * @method array findByRfcDeudor(string $rfc_deudor) Return Resumen objects filtered by the rfc_deudor column
 * @method array findByTelefonosMarcados(string $telefonos_marcados) Return Resumen objects filtered by the telefonos_marcados column
 * @method array findByTel1Verif(string $tel_1_verif) Return Resumen objects filtered by the tel_1_verif column
 * @method array findByTel2Verif(string $tel_2_verif) Return Resumen objects filtered by the tel_2_verif column
 * @method array findByTel3Verif(string $tel_3_verif) Return Resumen objects filtered by the tel_3_verif column
 * @method array findByTel4Verif(string $tel_4_verif) Return Resumen objects filtered by the tel_4_verif column
 * @method array findByTelefonoDeUltimoContacto(string $telefono_de_ultimo_contacto) Return Resumen objects filtered by the telefono_de_ultimo_contacto column
 * @method array findByDiasVencidos(int $dias_vencidos) Return Resumen objects filtered by the dias_vencidos column
 * @method array findByEjecutivoAsignadoCallCenter(string $ejecutivo_asignado_call_center) Return Resumen objects filtered by the ejecutivo_asignado_call_center column
 * @method array findByEjecutivoAsignadoDomiciliario(string $ejecutivo_asignado_domiciliario) Return Resumen objects filtered by the ejecutivo_asignado_domiciliario column
 * @method array findByPrioridadDeGestion(int $prioridad_de_gestion) Return Resumen objects filtered by the prioridad_de_gestion column
 * @method array findByNrpp(string $nrpp) Return Resumen objects filtered by the nrpp column
 * @method array findByParentescoAval(string $parentesco_aval) Return Resumen objects filtered by the parentesco_aval column
 * @method array findByLocalizar(boolean $localizar) Return Resumen objects filtered by the localizar column
 * @method array findByFechaUltimaGestion(string $fecha_ultima_gestion) Return Resumen objects filtered by the fecha_ultima_gestion column
 * @method array findByEmpresa(string $empresa) Return Resumen objects filtered by the empresa column
 * @method array findByTimelock(string $timelock) Return Resumen objects filtered by the timelock column
 * @method array findByLocker(string $locker) Return Resumen objects filtered by the locker column
 * @method array findByFechaConvenio(string $fecha_convenio) Return Resumen objects filtered by the fecha_convenio column
 * @method array findByEspecial(boolean $especial) Return Resumen objects filtered by the especial column
 * @method array findByDireccionNueva(string $direccion_nueva) Return Resumen objects filtered by the direccion_nueva column
 * @method array findByNorobot(string $norobot) Return Resumen objects filtered by the norobot column
 *
 * @package    propel.generator.cobra.om
 */
abstract class BaseResumenQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseResumenQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cobra', $modelName = 'Resumen', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ResumenQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   ResumenQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return ResumenQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ResumenQuery) {
            return $criteria;
        }
        $query = new ResumenQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Resumen|Resumen[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ResumenPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(ResumenPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Resumen A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByIdCuenta($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Resumen A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `nombre_deudor`, `domicilio_deudor`, `colonia_deudor`, `ciudad_deudor`, `estado_deudor`, `cp_deudor`, `plano_guia_roji`, `cuadrante_guia_roji`, `tel_1`, `tel_2`, `tel_3`, `tel_4`, `nombre_deudor_alterno`, `domicilio_deudor_alterno`, `colonia_deudor_alterno`, `ciudad_deudor_alterno`, `estado_deudor_alterno`, `cp_deudor_aterno`, `tel_1_alterno`, `tel_2_alterno`, `tel_3_alterno`, `tel_4_alterno`, `plano_guia_roji_alterno`, `cuadrante_guia_roji_alterno`, `status_aarsa`, `avapar`, `parentesco_ref_1`, `nombre_referencia_1`, `domicilio_referencia_1`, `colonia_referencia_1`, `ciudad_referencia_1`, `estado_referencia_1`, `cp_referencia_1`, `tel_1_ref_1`, `tel_2_ref_1`, `parentesco_ref_2`, `nombre_referencia_2`, `domicilio_referencia_2`, `colonia_referencia_2`, `ciudad_referencia_2`, `estado_referencia_2`, `cp_referencia_2`, `tel_1_ref_2`, `tel_2_ref_2`, `parentesco_ref_3`, `nombre_referencia_3`, `domicilio_referencia_3`, `colonia_referencia_3`, `ciudad_referencia_3`, `estado_referencia_3`, `cp_referencia_3`, `tel_1_ref_3`, `tel_2_ref_3`, `parentesco_ref_4`, `nombre_referencia_4`, `domicilio_deudor_2`, `frecuencia`, `originacion`, `sucursal_cliente`, `cp_referencia_4`, `tel_1_ref_4`, `tel_2_ref_4`, `domicilio_laboral`, `colonia_laboral`, `ciudad_laboral`, `estado_laboral`, `cp_laboral`, `tel_1_laboral`, `tel_2_laboral`, `saldo_corriente`, `fecha_de_actualizacion`, `numero_de_cuenta`, `numero_de_credito`, `contrato`, `saldo_total`, `saldo_vencido`, `saldo_descuento_1`, `saldo_descuento_2`, `fecha_corte`, `fecha_limite`, `fecha_de_ultimo_pago`, `monto_ultimo_pago`, `producto`, `subproducto`, `cliente`, `status_de_credito`, `pagos_vencidos`, `monto_adeudado`, `fecha_de_asignacion`, `fecha_de_deasignacion`, `cuenta_concentradora_1`, `saldo_cuota`, `email_deudor`, `id_cuenta`, `nss`, `rfc_deudor`, `telefonos_marcados`, `tel_1_verif`, `tel_2_verif`, `tel_3_verif`, `tel_4_verif`, `telefono_de_ultimo_contacto`, `dias_vencidos`, `ejecutivo_asignado_call_center`, `ejecutivo_asignado_domiciliario`, `prioridad_de_gestion`, `nrpp`, `parentesco_aval`, `localizar`, `fecha_ultima_gestion`, `empresa`, `timelock`, `locker`, `fecha_convenio`, `especial`, `direccion_nueva`, `norobot` FROM `resumen` WHERE `id_cuenta` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Resumen();
            $obj->hydrate($row);
            ResumenPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return Resumen|Resumen[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Resumen[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ResumenPeer::ID_CUENTA, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ResumenPeer::ID_CUENTA, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the nombre_deudor column
     *
     * Example usage:
     * <code>
     * $query->filterByNombreDeudor('fooValue');   // WHERE nombre_deudor = 'fooValue'
     * $query->filterByNombreDeudor('%fooValue%'); // WHERE nombre_deudor LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombreDeudor The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByNombreDeudor($nombreDeudor = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombreDeudor)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nombreDeudor)) {
                $nombreDeudor = str_replace('*', '%', $nombreDeudor);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::NOMBRE_DEUDOR, $nombreDeudor, $comparison);
    }

    /**
     * Filter the query on the domicilio_deudor column
     *
     * Example usage:
     * <code>
     * $query->filterByDomicilioDeudor('fooValue');   // WHERE domicilio_deudor = 'fooValue'
     * $query->filterByDomicilioDeudor('%fooValue%'); // WHERE domicilio_deudor LIKE '%fooValue%'
     * </code>
     *
     * @param     string $domicilioDeudor The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByDomicilioDeudor($domicilioDeudor = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($domicilioDeudor)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $domicilioDeudor)) {
                $domicilioDeudor = str_replace('*', '%', $domicilioDeudor);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::DOMICILIO_DEUDOR, $domicilioDeudor, $comparison);
    }

    /**
     * Filter the query on the colonia_deudor column
     *
     * Example usage:
     * <code>
     * $query->filterByColoniaDeudor('fooValue');   // WHERE colonia_deudor = 'fooValue'
     * $query->filterByColoniaDeudor('%fooValue%'); // WHERE colonia_deudor LIKE '%fooValue%'
     * </code>
     *
     * @param     string $coloniaDeudor The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByColoniaDeudor($coloniaDeudor = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($coloniaDeudor)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $coloniaDeudor)) {
                $coloniaDeudor = str_replace('*', '%', $coloniaDeudor);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::COLONIA_DEUDOR, $coloniaDeudor, $comparison);
    }

    /**
     * Filter the query on the ciudad_deudor column
     *
     * Example usage:
     * <code>
     * $query->filterByCiudadDeudor('fooValue');   // WHERE ciudad_deudor = 'fooValue'
     * $query->filterByCiudadDeudor('%fooValue%'); // WHERE ciudad_deudor LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ciudadDeudor The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByCiudadDeudor($ciudadDeudor = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ciudadDeudor)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ciudadDeudor)) {
                $ciudadDeudor = str_replace('*', '%', $ciudadDeudor);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::CIUDAD_DEUDOR, $ciudadDeudor, $comparison);
    }

    /**
     * Filter the query on the estado_deudor column
     *
     * Example usage:
     * <code>
     * $query->filterByEstadoDeudor('fooValue');   // WHERE estado_deudor = 'fooValue'
     * $query->filterByEstadoDeudor('%fooValue%'); // WHERE estado_deudor LIKE '%fooValue%'
     * </code>
     *
     * @param     string $estadoDeudor The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByEstadoDeudor($estadoDeudor = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($estadoDeudor)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $estadoDeudor)) {
                $estadoDeudor = str_replace('*', '%', $estadoDeudor);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::ESTADO_DEUDOR, $estadoDeudor, $comparison);
    }

    /**
     * Filter the query on the cp_deudor column
     *
     * Example usage:
     * <code>
     * $query->filterByCpDeudor('fooValue');   // WHERE cp_deudor = 'fooValue'
     * $query->filterByCpDeudor('%fooValue%'); // WHERE cp_deudor LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cpDeudor The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByCpDeudor($cpDeudor = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cpDeudor)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cpDeudor)) {
                $cpDeudor = str_replace('*', '%', $cpDeudor);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::CP_DEUDOR, $cpDeudor, $comparison);
    }

    /**
     * Filter the query on the plano_guia_roji column
     *
     * Example usage:
     * <code>
     * $query->filterByPlanoGuiaRoji('fooValue');   // WHERE plano_guia_roji = 'fooValue'
     * $query->filterByPlanoGuiaRoji('%fooValue%'); // WHERE plano_guia_roji LIKE '%fooValue%'
     * </code>
     *
     * @param     string $planoGuiaRoji The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByPlanoGuiaRoji($planoGuiaRoji = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($planoGuiaRoji)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $planoGuiaRoji)) {
                $planoGuiaRoji = str_replace('*', '%', $planoGuiaRoji);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::PLANO_GUIA_ROJI, $planoGuiaRoji, $comparison);
    }

    /**
     * Filter the query on the cuadrante_guia_roji column
     *
     * Example usage:
     * <code>
     * $query->filterByCuadranteGuiaRoji('fooValue');   // WHERE cuadrante_guia_roji = 'fooValue'
     * $query->filterByCuadranteGuiaRoji('%fooValue%'); // WHERE cuadrante_guia_roji LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cuadranteGuiaRoji The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByCuadranteGuiaRoji($cuadranteGuiaRoji = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cuadranteGuiaRoji)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cuadranteGuiaRoji)) {
                $cuadranteGuiaRoji = str_replace('*', '%', $cuadranteGuiaRoji);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::CUADRANTE_GUIA_ROJI, $cuadranteGuiaRoji, $comparison);
    }

    /**
     * Filter the query on the tel_1 column
     *
     * Example usage:
     * <code>
     * $query->filterByTel1('fooValue');   // WHERE tel_1 = 'fooValue'
     * $query->filterByTel1('%fooValue%'); // WHERE tel_1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByTel1($tel1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel1)) {
                $tel1 = str_replace('*', '%', $tel1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::TEL_1, $tel1, $comparison);
    }

    /**
     * Filter the query on the tel_2 column
     *
     * Example usage:
     * <code>
     * $query->filterByTel2('fooValue');   // WHERE tel_2 = 'fooValue'
     * $query->filterByTel2('%fooValue%'); // WHERE tel_2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByTel2($tel2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel2)) {
                $tel2 = str_replace('*', '%', $tel2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::TEL_2, $tel2, $comparison);
    }

    /**
     * Filter the query on the tel_3 column
     *
     * Example usage:
     * <code>
     * $query->filterByTel3('fooValue');   // WHERE tel_3 = 'fooValue'
     * $query->filterByTel3('%fooValue%'); // WHERE tel_3 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel3 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByTel3($tel3 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel3)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel3)) {
                $tel3 = str_replace('*', '%', $tel3);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::TEL_3, $tel3, $comparison);
    }

    /**
     * Filter the query on the tel_4 column
     *
     * Example usage:
     * <code>
     * $query->filterByTel4('fooValue');   // WHERE tel_4 = 'fooValue'
     * $query->filterByTel4('%fooValue%'); // WHERE tel_4 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel4 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByTel4($tel4 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel4)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel4)) {
                $tel4 = str_replace('*', '%', $tel4);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::TEL_4, $tel4, $comparison);
    }

    /**
     * Filter the query on the nombre_deudor_alterno column
     *
     * Example usage:
     * <code>
     * $query->filterByNombreDeudorAlterno('fooValue');   // WHERE nombre_deudor_alterno = 'fooValue'
     * $query->filterByNombreDeudorAlterno('%fooValue%'); // WHERE nombre_deudor_alterno LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombreDeudorAlterno The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByNombreDeudorAlterno($nombreDeudorAlterno = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombreDeudorAlterno)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nombreDeudorAlterno)) {
                $nombreDeudorAlterno = str_replace('*', '%', $nombreDeudorAlterno);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::NOMBRE_DEUDOR_ALTERNO, $nombreDeudorAlterno, $comparison);
    }

    /**
     * Filter the query on the domicilio_deudor_alterno column
     *
     * Example usage:
     * <code>
     * $query->filterByDomicilioDeudorAlterno('fooValue');   // WHERE domicilio_deudor_alterno = 'fooValue'
     * $query->filterByDomicilioDeudorAlterno('%fooValue%'); // WHERE domicilio_deudor_alterno LIKE '%fooValue%'
     * </code>
     *
     * @param     string $domicilioDeudorAlterno The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByDomicilioDeudorAlterno($domicilioDeudorAlterno = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($domicilioDeudorAlterno)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $domicilioDeudorAlterno)) {
                $domicilioDeudorAlterno = str_replace('*', '%', $domicilioDeudorAlterno);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::DOMICILIO_DEUDOR_ALTERNO, $domicilioDeudorAlterno, $comparison);
    }

    /**
     * Filter the query on the colonia_deudor_alterno column
     *
     * Example usage:
     * <code>
     * $query->filterByColoniaDeudorAlterno('fooValue');   // WHERE colonia_deudor_alterno = 'fooValue'
     * $query->filterByColoniaDeudorAlterno('%fooValue%'); // WHERE colonia_deudor_alterno LIKE '%fooValue%'
     * </code>
     *
     * @param     string $coloniaDeudorAlterno The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByColoniaDeudorAlterno($coloniaDeudorAlterno = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($coloniaDeudorAlterno)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $coloniaDeudorAlterno)) {
                $coloniaDeudorAlterno = str_replace('*', '%', $coloniaDeudorAlterno);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::COLONIA_DEUDOR_ALTERNO, $coloniaDeudorAlterno, $comparison);
    }

    /**
     * Filter the query on the ciudad_deudor_alterno column
     *
     * Example usage:
     * <code>
     * $query->filterByCiudadDeudorAlterno('fooValue');   // WHERE ciudad_deudor_alterno = 'fooValue'
     * $query->filterByCiudadDeudorAlterno('%fooValue%'); // WHERE ciudad_deudor_alterno LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ciudadDeudorAlterno The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByCiudadDeudorAlterno($ciudadDeudorAlterno = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ciudadDeudorAlterno)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ciudadDeudorAlterno)) {
                $ciudadDeudorAlterno = str_replace('*', '%', $ciudadDeudorAlterno);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::CIUDAD_DEUDOR_ALTERNO, $ciudadDeudorAlterno, $comparison);
    }

    /**
     * Filter the query on the estado_deudor_alterno column
     *
     * Example usage:
     * <code>
     * $query->filterByEstadoDeudorAlterno('fooValue');   // WHERE estado_deudor_alterno = 'fooValue'
     * $query->filterByEstadoDeudorAlterno('%fooValue%'); // WHERE estado_deudor_alterno LIKE '%fooValue%'
     * </code>
     *
     * @param     string $estadoDeudorAlterno The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByEstadoDeudorAlterno($estadoDeudorAlterno = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($estadoDeudorAlterno)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $estadoDeudorAlterno)) {
                $estadoDeudorAlterno = str_replace('*', '%', $estadoDeudorAlterno);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::ESTADO_DEUDOR_ALTERNO, $estadoDeudorAlterno, $comparison);
    }

    /**
     * Filter the query on the cp_deudor_aterno column
     *
     * Example usage:
     * <code>
     * $query->filterByCpDeudorAterno('fooValue');   // WHERE cp_deudor_aterno = 'fooValue'
     * $query->filterByCpDeudorAterno('%fooValue%'); // WHERE cp_deudor_aterno LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cpDeudorAterno The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByCpDeudorAterno($cpDeudorAterno = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cpDeudorAterno)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cpDeudorAterno)) {
                $cpDeudorAterno = str_replace('*', '%', $cpDeudorAterno);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::CP_DEUDOR_ATERNO, $cpDeudorAterno, $comparison);
    }

    /**
     * Filter the query on the tel_1_alterno column
     *
     * Example usage:
     * <code>
     * $query->filterByTel1Alterno('fooValue');   // WHERE tel_1_alterno = 'fooValue'
     * $query->filterByTel1Alterno('%fooValue%'); // WHERE tel_1_alterno LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel1Alterno The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByTel1Alterno($tel1Alterno = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel1Alterno)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel1Alterno)) {
                $tel1Alterno = str_replace('*', '%', $tel1Alterno);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::TEL_1_ALTERNO, $tel1Alterno, $comparison);
    }

    /**
     * Filter the query on the tel_2_alterno column
     *
     * Example usage:
     * <code>
     * $query->filterByTel2Alterno('fooValue');   // WHERE tel_2_alterno = 'fooValue'
     * $query->filterByTel2Alterno('%fooValue%'); // WHERE tel_2_alterno LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel2Alterno The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByTel2Alterno($tel2Alterno = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel2Alterno)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel2Alterno)) {
                $tel2Alterno = str_replace('*', '%', $tel2Alterno);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::TEL_2_ALTERNO, $tel2Alterno, $comparison);
    }

    /**
     * Filter the query on the tel_3_alterno column
     *
     * Example usage:
     * <code>
     * $query->filterByTel3Alterno('fooValue');   // WHERE tel_3_alterno = 'fooValue'
     * $query->filterByTel3Alterno('%fooValue%'); // WHERE tel_3_alterno LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel3Alterno The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByTel3Alterno($tel3Alterno = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel3Alterno)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel3Alterno)) {
                $tel3Alterno = str_replace('*', '%', $tel3Alterno);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::TEL_3_ALTERNO, $tel3Alterno, $comparison);
    }

    /**
     * Filter the query on the tel_4_alterno column
     *
     * Example usage:
     * <code>
     * $query->filterByTel4Alterno('fooValue');   // WHERE tel_4_alterno = 'fooValue'
     * $query->filterByTel4Alterno('%fooValue%'); // WHERE tel_4_alterno LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel4Alterno The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByTel4Alterno($tel4Alterno = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel4Alterno)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel4Alterno)) {
                $tel4Alterno = str_replace('*', '%', $tel4Alterno);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::TEL_4_ALTERNO, $tel4Alterno, $comparison);
    }

    /**
     * Filter the query on the plano_guia_roji_alterno column
     *
     * Example usage:
     * <code>
     * $query->filterByPlanoGuiaRojiAlterno('fooValue');   // WHERE plano_guia_roji_alterno = 'fooValue'
     * $query->filterByPlanoGuiaRojiAlterno('%fooValue%'); // WHERE plano_guia_roji_alterno LIKE '%fooValue%'
     * </code>
     *
     * @param     string $planoGuiaRojiAlterno The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByPlanoGuiaRojiAlterno($planoGuiaRojiAlterno = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($planoGuiaRojiAlterno)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $planoGuiaRojiAlterno)) {
                $planoGuiaRojiAlterno = str_replace('*', '%', $planoGuiaRojiAlterno);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::PLANO_GUIA_ROJI_ALTERNO, $planoGuiaRojiAlterno, $comparison);
    }

    /**
     * Filter the query on the cuadrante_guia_roji_alterno column
     *
     * Example usage:
     * <code>
     * $query->filterByCuadranteGuiaRojiAlterno('fooValue');   // WHERE cuadrante_guia_roji_alterno = 'fooValue'
     * $query->filterByCuadranteGuiaRojiAlterno('%fooValue%'); // WHERE cuadrante_guia_roji_alterno LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cuadranteGuiaRojiAlterno The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByCuadranteGuiaRojiAlterno($cuadranteGuiaRojiAlterno = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cuadranteGuiaRojiAlterno)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cuadranteGuiaRojiAlterno)) {
                $cuadranteGuiaRojiAlterno = str_replace('*', '%', $cuadranteGuiaRojiAlterno);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::CUADRANTE_GUIA_ROJI_ALTERNO, $cuadranteGuiaRojiAlterno, $comparison);
    }

    /**
     * Filter the query on the status_aarsa column
     *
     * Example usage:
     * <code>
     * $query->filterByStatusAarsa('fooValue');   // WHERE status_aarsa = 'fooValue'
     * $query->filterByStatusAarsa('%fooValue%'); // WHERE status_aarsa LIKE '%fooValue%'
     * </code>
     *
     * @param     string $statusAarsa The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByStatusAarsa($statusAarsa = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($statusAarsa)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $statusAarsa)) {
                $statusAarsa = str_replace('*', '%', $statusAarsa);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::STATUS_AARSA, $statusAarsa, $comparison);
    }

    /**
     * Filter the query on the avapar column
     *
     * Example usage:
     * <code>
     * $query->filterByAvapar('fooValue');   // WHERE avapar = 'fooValue'
     * $query->filterByAvapar('%fooValue%'); // WHERE avapar LIKE '%fooValue%'
     * </code>
     *
     * @param     string $avapar The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByAvapar($avapar = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($avapar)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $avapar)) {
                $avapar = str_replace('*', '%', $avapar);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::AVAPAR, $avapar, $comparison);
    }

    /**
     * Filter the query on the parentesco_ref_1 column
     *
     * Example usage:
     * <code>
     * $query->filterByParentescoRef1('fooValue');   // WHERE parentesco_ref_1 = 'fooValue'
     * $query->filterByParentescoRef1('%fooValue%'); // WHERE parentesco_ref_1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $parentescoRef1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByParentescoRef1($parentescoRef1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($parentescoRef1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $parentescoRef1)) {
                $parentescoRef1 = str_replace('*', '%', $parentescoRef1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::PARENTESCO_REF_1, $parentescoRef1, $comparison);
    }

    /**
     * Filter the query on the nombre_referencia_1 column
     *
     * Example usage:
     * <code>
     * $query->filterByNombreReferencia1('fooValue');   // WHERE nombre_referencia_1 = 'fooValue'
     * $query->filterByNombreReferencia1('%fooValue%'); // WHERE nombre_referencia_1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombreReferencia1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByNombreReferencia1($nombreReferencia1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombreReferencia1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nombreReferencia1)) {
                $nombreReferencia1 = str_replace('*', '%', $nombreReferencia1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::NOMBRE_REFERENCIA_1, $nombreReferencia1, $comparison);
    }

    /**
     * Filter the query on the domicilio_referencia_1 column
     *
     * Example usage:
     * <code>
     * $query->filterByDomicilioReferencia1('fooValue');   // WHERE domicilio_referencia_1 = 'fooValue'
     * $query->filterByDomicilioReferencia1('%fooValue%'); // WHERE domicilio_referencia_1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $domicilioReferencia1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByDomicilioReferencia1($domicilioReferencia1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($domicilioReferencia1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $domicilioReferencia1)) {
                $domicilioReferencia1 = str_replace('*', '%', $domicilioReferencia1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::DOMICILIO_REFERENCIA_1, $domicilioReferencia1, $comparison);
    }

    /**
     * Filter the query on the colonia_referencia_1 column
     *
     * Example usage:
     * <code>
     * $query->filterByColoniaReferencia1('fooValue');   // WHERE colonia_referencia_1 = 'fooValue'
     * $query->filterByColoniaReferencia1('%fooValue%'); // WHERE colonia_referencia_1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $coloniaReferencia1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByColoniaReferencia1($coloniaReferencia1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($coloniaReferencia1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $coloniaReferencia1)) {
                $coloniaReferencia1 = str_replace('*', '%', $coloniaReferencia1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::COLONIA_REFERENCIA_1, $coloniaReferencia1, $comparison);
    }

    /**
     * Filter the query on the ciudad_referencia_1 column
     *
     * Example usage:
     * <code>
     * $query->filterByCiudadReferencia1('fooValue');   // WHERE ciudad_referencia_1 = 'fooValue'
     * $query->filterByCiudadReferencia1('%fooValue%'); // WHERE ciudad_referencia_1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ciudadReferencia1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByCiudadReferencia1($ciudadReferencia1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ciudadReferencia1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ciudadReferencia1)) {
                $ciudadReferencia1 = str_replace('*', '%', $ciudadReferencia1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::CIUDAD_REFERENCIA_1, $ciudadReferencia1, $comparison);
    }

    /**
     * Filter the query on the estado_referencia_1 column
     *
     * Example usage:
     * <code>
     * $query->filterByEstadoReferencia1('fooValue');   // WHERE estado_referencia_1 = 'fooValue'
     * $query->filterByEstadoReferencia1('%fooValue%'); // WHERE estado_referencia_1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $estadoReferencia1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByEstadoReferencia1($estadoReferencia1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($estadoReferencia1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $estadoReferencia1)) {
                $estadoReferencia1 = str_replace('*', '%', $estadoReferencia1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::ESTADO_REFERENCIA_1, $estadoReferencia1, $comparison);
    }

    /**
     * Filter the query on the cp_referencia_1 column
     *
     * Example usage:
     * <code>
     * $query->filterByCpReferencia1('fooValue');   // WHERE cp_referencia_1 = 'fooValue'
     * $query->filterByCpReferencia1('%fooValue%'); // WHERE cp_referencia_1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cpReferencia1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByCpReferencia1($cpReferencia1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cpReferencia1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cpReferencia1)) {
                $cpReferencia1 = str_replace('*', '%', $cpReferencia1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::CP_REFERENCIA_1, $cpReferencia1, $comparison);
    }

    /**
     * Filter the query on the tel_1_ref_1 column
     *
     * Example usage:
     * <code>
     * $query->filterByTel1Ref1('fooValue');   // WHERE tel_1_ref_1 = 'fooValue'
     * $query->filterByTel1Ref1('%fooValue%'); // WHERE tel_1_ref_1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel1Ref1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByTel1Ref1($tel1Ref1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel1Ref1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel1Ref1)) {
                $tel1Ref1 = str_replace('*', '%', $tel1Ref1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::TEL_1_REF_1, $tel1Ref1, $comparison);
    }

    /**
     * Filter the query on the tel_2_ref_1 column
     *
     * Example usage:
     * <code>
     * $query->filterByTel2Ref1('fooValue');   // WHERE tel_2_ref_1 = 'fooValue'
     * $query->filterByTel2Ref1('%fooValue%'); // WHERE tel_2_ref_1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel2Ref1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByTel2Ref1($tel2Ref1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel2Ref1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel2Ref1)) {
                $tel2Ref1 = str_replace('*', '%', $tel2Ref1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::TEL_2_REF_1, $tel2Ref1, $comparison);
    }

    /**
     * Filter the query on the parentesco_ref_2 column
     *
     * Example usage:
     * <code>
     * $query->filterByParentescoRef2('fooValue');   // WHERE parentesco_ref_2 = 'fooValue'
     * $query->filterByParentescoRef2('%fooValue%'); // WHERE parentesco_ref_2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $parentescoRef2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByParentescoRef2($parentescoRef2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($parentescoRef2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $parentescoRef2)) {
                $parentescoRef2 = str_replace('*', '%', $parentescoRef2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::PARENTESCO_REF_2, $parentescoRef2, $comparison);
    }

    /**
     * Filter the query on the nombre_referencia_2 column
     *
     * Example usage:
     * <code>
     * $query->filterByNombreReferencia2('fooValue');   // WHERE nombre_referencia_2 = 'fooValue'
     * $query->filterByNombreReferencia2('%fooValue%'); // WHERE nombre_referencia_2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombreReferencia2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByNombreReferencia2($nombreReferencia2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombreReferencia2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nombreReferencia2)) {
                $nombreReferencia2 = str_replace('*', '%', $nombreReferencia2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::NOMBRE_REFERENCIA_2, $nombreReferencia2, $comparison);
    }

    /**
     * Filter the query on the domicilio_referencia_2 column
     *
     * Example usage:
     * <code>
     * $query->filterByDomicilioReferencia2('fooValue');   // WHERE domicilio_referencia_2 = 'fooValue'
     * $query->filterByDomicilioReferencia2('%fooValue%'); // WHERE domicilio_referencia_2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $domicilioReferencia2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByDomicilioReferencia2($domicilioReferencia2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($domicilioReferencia2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $domicilioReferencia2)) {
                $domicilioReferencia2 = str_replace('*', '%', $domicilioReferencia2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::DOMICILIO_REFERENCIA_2, $domicilioReferencia2, $comparison);
    }

    /**
     * Filter the query on the colonia_referencia_2 column
     *
     * Example usage:
     * <code>
     * $query->filterByColoniaReferencia2('fooValue');   // WHERE colonia_referencia_2 = 'fooValue'
     * $query->filterByColoniaReferencia2('%fooValue%'); // WHERE colonia_referencia_2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $coloniaReferencia2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByColoniaReferencia2($coloniaReferencia2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($coloniaReferencia2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $coloniaReferencia2)) {
                $coloniaReferencia2 = str_replace('*', '%', $coloniaReferencia2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::COLONIA_REFERENCIA_2, $coloniaReferencia2, $comparison);
    }

    /**
     * Filter the query on the ciudad_referencia_2 column
     *
     * Example usage:
     * <code>
     * $query->filterByCiudadReferencia2('fooValue');   // WHERE ciudad_referencia_2 = 'fooValue'
     * $query->filterByCiudadReferencia2('%fooValue%'); // WHERE ciudad_referencia_2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ciudadReferencia2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByCiudadReferencia2($ciudadReferencia2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ciudadReferencia2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ciudadReferencia2)) {
                $ciudadReferencia2 = str_replace('*', '%', $ciudadReferencia2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::CIUDAD_REFERENCIA_2, $ciudadReferencia2, $comparison);
    }

    /**
     * Filter the query on the estado_referencia_2 column
     *
     * Example usage:
     * <code>
     * $query->filterByEstadoReferencia2('fooValue');   // WHERE estado_referencia_2 = 'fooValue'
     * $query->filterByEstadoReferencia2('%fooValue%'); // WHERE estado_referencia_2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $estadoReferencia2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByEstadoReferencia2($estadoReferencia2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($estadoReferencia2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $estadoReferencia2)) {
                $estadoReferencia2 = str_replace('*', '%', $estadoReferencia2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::ESTADO_REFERENCIA_2, $estadoReferencia2, $comparison);
    }

    /**
     * Filter the query on the cp_referencia_2 column
     *
     * Example usage:
     * <code>
     * $query->filterByCpReferencia2('fooValue');   // WHERE cp_referencia_2 = 'fooValue'
     * $query->filterByCpReferencia2('%fooValue%'); // WHERE cp_referencia_2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cpReferencia2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByCpReferencia2($cpReferencia2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cpReferencia2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cpReferencia2)) {
                $cpReferencia2 = str_replace('*', '%', $cpReferencia2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::CP_REFERENCIA_2, $cpReferencia2, $comparison);
    }

    /**
     * Filter the query on the tel_1_ref_2 column
     *
     * Example usage:
     * <code>
     * $query->filterByTel1Ref2('fooValue');   // WHERE tel_1_ref_2 = 'fooValue'
     * $query->filterByTel1Ref2('%fooValue%'); // WHERE tel_1_ref_2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel1Ref2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByTel1Ref2($tel1Ref2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel1Ref2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel1Ref2)) {
                $tel1Ref2 = str_replace('*', '%', $tel1Ref2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::TEL_1_REF_2, $tel1Ref2, $comparison);
    }

    /**
     * Filter the query on the tel_2_ref_2 column
     *
     * Example usage:
     * <code>
     * $query->filterByTel2Ref2('fooValue');   // WHERE tel_2_ref_2 = 'fooValue'
     * $query->filterByTel2Ref2('%fooValue%'); // WHERE tel_2_ref_2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel2Ref2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByTel2Ref2($tel2Ref2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel2Ref2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel2Ref2)) {
                $tel2Ref2 = str_replace('*', '%', $tel2Ref2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::TEL_2_REF_2, $tel2Ref2, $comparison);
    }

    /**
     * Filter the query on the parentesco_ref_3 column
     *
     * Example usage:
     * <code>
     * $query->filterByParentescoRef3('fooValue');   // WHERE parentesco_ref_3 = 'fooValue'
     * $query->filterByParentescoRef3('%fooValue%'); // WHERE parentesco_ref_3 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $parentescoRef3 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByParentescoRef3($parentescoRef3 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($parentescoRef3)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $parentescoRef3)) {
                $parentescoRef3 = str_replace('*', '%', $parentescoRef3);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::PARENTESCO_REF_3, $parentescoRef3, $comparison);
    }

    /**
     * Filter the query on the nombre_referencia_3 column
     *
     * Example usage:
     * <code>
     * $query->filterByNombreReferencia3('fooValue');   // WHERE nombre_referencia_3 = 'fooValue'
     * $query->filterByNombreReferencia3('%fooValue%'); // WHERE nombre_referencia_3 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombreReferencia3 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByNombreReferencia3($nombreReferencia3 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombreReferencia3)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nombreReferencia3)) {
                $nombreReferencia3 = str_replace('*', '%', $nombreReferencia3);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::NOMBRE_REFERENCIA_3, $nombreReferencia3, $comparison);
    }

    /**
     * Filter the query on the domicilio_referencia_3 column
     *
     * Example usage:
     * <code>
     * $query->filterByDomicilioReferencia3('fooValue');   // WHERE domicilio_referencia_3 = 'fooValue'
     * $query->filterByDomicilioReferencia3('%fooValue%'); // WHERE domicilio_referencia_3 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $domicilioReferencia3 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByDomicilioReferencia3($domicilioReferencia3 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($domicilioReferencia3)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $domicilioReferencia3)) {
                $domicilioReferencia3 = str_replace('*', '%', $domicilioReferencia3);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::DOMICILIO_REFERENCIA_3, $domicilioReferencia3, $comparison);
    }

    /**
     * Filter the query on the colonia_referencia_3 column
     *
     * Example usage:
     * <code>
     * $query->filterByColoniaReferencia3('fooValue');   // WHERE colonia_referencia_3 = 'fooValue'
     * $query->filterByColoniaReferencia3('%fooValue%'); // WHERE colonia_referencia_3 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $coloniaReferencia3 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByColoniaReferencia3($coloniaReferencia3 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($coloniaReferencia3)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $coloniaReferencia3)) {
                $coloniaReferencia3 = str_replace('*', '%', $coloniaReferencia3);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::COLONIA_REFERENCIA_3, $coloniaReferencia3, $comparison);
    }

    /**
     * Filter the query on the ciudad_referencia_3 column
     *
     * Example usage:
     * <code>
     * $query->filterByCiudadReferencia3('fooValue');   // WHERE ciudad_referencia_3 = 'fooValue'
     * $query->filterByCiudadReferencia3('%fooValue%'); // WHERE ciudad_referencia_3 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ciudadReferencia3 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByCiudadReferencia3($ciudadReferencia3 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ciudadReferencia3)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ciudadReferencia3)) {
                $ciudadReferencia3 = str_replace('*', '%', $ciudadReferencia3);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::CIUDAD_REFERENCIA_3, $ciudadReferencia3, $comparison);
    }

    /**
     * Filter the query on the estado_referencia_3 column
     *
     * Example usage:
     * <code>
     * $query->filterByEstadoReferencia3('fooValue');   // WHERE estado_referencia_3 = 'fooValue'
     * $query->filterByEstadoReferencia3('%fooValue%'); // WHERE estado_referencia_3 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $estadoReferencia3 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByEstadoReferencia3($estadoReferencia3 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($estadoReferencia3)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $estadoReferencia3)) {
                $estadoReferencia3 = str_replace('*', '%', $estadoReferencia3);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::ESTADO_REFERENCIA_3, $estadoReferencia3, $comparison);
    }

    /**
     * Filter the query on the cp_referencia_3 column
     *
     * Example usage:
     * <code>
     * $query->filterByCpReferencia3('fooValue');   // WHERE cp_referencia_3 = 'fooValue'
     * $query->filterByCpReferencia3('%fooValue%'); // WHERE cp_referencia_3 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cpReferencia3 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByCpReferencia3($cpReferencia3 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cpReferencia3)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cpReferencia3)) {
                $cpReferencia3 = str_replace('*', '%', $cpReferencia3);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::CP_REFERENCIA_3, $cpReferencia3, $comparison);
    }

    /**
     * Filter the query on the tel_1_ref_3 column
     *
     * Example usage:
     * <code>
     * $query->filterByTel1Ref3('fooValue');   // WHERE tel_1_ref_3 = 'fooValue'
     * $query->filterByTel1Ref3('%fooValue%'); // WHERE tel_1_ref_3 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel1Ref3 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByTel1Ref3($tel1Ref3 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel1Ref3)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel1Ref3)) {
                $tel1Ref3 = str_replace('*', '%', $tel1Ref3);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::TEL_1_REF_3, $tel1Ref3, $comparison);
    }

    /**
     * Filter the query on the tel_2_ref_3 column
     *
     * Example usage:
     * <code>
     * $query->filterByTel2Ref3('fooValue');   // WHERE tel_2_ref_3 = 'fooValue'
     * $query->filterByTel2Ref3('%fooValue%'); // WHERE tel_2_ref_3 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel2Ref3 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByTel2Ref3($tel2Ref3 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel2Ref3)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel2Ref3)) {
                $tel2Ref3 = str_replace('*', '%', $tel2Ref3);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::TEL_2_REF_3, $tel2Ref3, $comparison);
    }

    /**
     * Filter the query on the parentesco_ref_4 column
     *
     * Example usage:
     * <code>
     * $query->filterByParentescoRef4('fooValue');   // WHERE parentesco_ref_4 = 'fooValue'
     * $query->filterByParentescoRef4('%fooValue%'); // WHERE parentesco_ref_4 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $parentescoRef4 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByParentescoRef4($parentescoRef4 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($parentescoRef4)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $parentescoRef4)) {
                $parentescoRef4 = str_replace('*', '%', $parentescoRef4);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::PARENTESCO_REF_4, $parentescoRef4, $comparison);
    }

    /**
     * Filter the query on the nombre_referencia_4 column
     *
     * Example usage:
     * <code>
     * $query->filterByNombreReferencia4('fooValue');   // WHERE nombre_referencia_4 = 'fooValue'
     * $query->filterByNombreReferencia4('%fooValue%'); // WHERE nombre_referencia_4 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombreReferencia4 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByNombreReferencia4($nombreReferencia4 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombreReferencia4)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nombreReferencia4)) {
                $nombreReferencia4 = str_replace('*', '%', $nombreReferencia4);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::NOMBRE_REFERENCIA_4, $nombreReferencia4, $comparison);
    }

    /**
     * Filter the query on the domicilio_deudor_2 column
     *
     * Example usage:
     * <code>
     * $query->filterByDomicilioDeudor2('fooValue');   // WHERE domicilio_deudor_2 = 'fooValue'
     * $query->filterByDomicilioDeudor2('%fooValue%'); // WHERE domicilio_deudor_2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $domicilioDeudor2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByDomicilioDeudor2($domicilioDeudor2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($domicilioDeudor2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $domicilioDeudor2)) {
                $domicilioDeudor2 = str_replace('*', '%', $domicilioDeudor2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::DOMICILIO_DEUDOR_2, $domicilioDeudor2, $comparison);
    }

    /**
     * Filter the query on the frecuencia column
     *
     * Example usage:
     * <code>
     * $query->filterByFrecuencia('fooValue');   // WHERE frecuencia = 'fooValue'
     * $query->filterByFrecuencia('%fooValue%'); // WHERE frecuencia LIKE '%fooValue%'
     * </code>
     *
     * @param     string $frecuencia The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByFrecuencia($frecuencia = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($frecuencia)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $frecuencia)) {
                $frecuencia = str_replace('*', '%', $frecuencia);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::FRECUENCIA, $frecuencia, $comparison);
    }

    /**
     * Filter the query on the originacion column
     *
     * Example usage:
     * <code>
     * $query->filterByOriginacion('fooValue');   // WHERE originacion = 'fooValue'
     * $query->filterByOriginacion('%fooValue%'); // WHERE originacion LIKE '%fooValue%'
     * </code>
     *
     * @param     string $originacion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByOriginacion($originacion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($originacion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $originacion)) {
                $originacion = str_replace('*', '%', $originacion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::ORIGINACION, $originacion, $comparison);
    }

    /**
     * Filter the query on the sucursal_cliente column
     *
     * Example usage:
     * <code>
     * $query->filterBySucursalCliente('fooValue');   // WHERE sucursal_cliente = 'fooValue'
     * $query->filterBySucursalCliente('%fooValue%'); // WHERE sucursal_cliente LIKE '%fooValue%'
     * </code>
     *
     * @param     string $sucursalCliente The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterBySucursalCliente($sucursalCliente = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sucursalCliente)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $sucursalCliente)) {
                $sucursalCliente = str_replace('*', '%', $sucursalCliente);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::SUCURSAL_CLIENTE, $sucursalCliente, $comparison);
    }

    /**
     * Filter the query on the cp_referencia_4 column
     *
     * Example usage:
     * <code>
     * $query->filterByCpReferencia4('fooValue');   // WHERE cp_referencia_4 = 'fooValue'
     * $query->filterByCpReferencia4('%fooValue%'); // WHERE cp_referencia_4 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cpReferencia4 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByCpReferencia4($cpReferencia4 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cpReferencia4)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cpReferencia4)) {
                $cpReferencia4 = str_replace('*', '%', $cpReferencia4);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::CP_REFERENCIA_4, $cpReferencia4, $comparison);
    }

    /**
     * Filter the query on the tel_1_ref_4 column
     *
     * Example usage:
     * <code>
     * $query->filterByTel1Ref4('fooValue');   // WHERE tel_1_ref_4 = 'fooValue'
     * $query->filterByTel1Ref4('%fooValue%'); // WHERE tel_1_ref_4 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel1Ref4 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByTel1Ref4($tel1Ref4 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel1Ref4)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel1Ref4)) {
                $tel1Ref4 = str_replace('*', '%', $tel1Ref4);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::TEL_1_REF_4, $tel1Ref4, $comparison);
    }

    /**
     * Filter the query on the tel_2_ref_4 column
     *
     * Example usage:
     * <code>
     * $query->filterByTel2Ref4('fooValue');   // WHERE tel_2_ref_4 = 'fooValue'
     * $query->filterByTel2Ref4('%fooValue%'); // WHERE tel_2_ref_4 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel2Ref4 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByTel2Ref4($tel2Ref4 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel2Ref4)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel2Ref4)) {
                $tel2Ref4 = str_replace('*', '%', $tel2Ref4);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::TEL_2_REF_4, $tel2Ref4, $comparison);
    }

    /**
     * Filter the query on the domicilio_laboral column
     *
     * Example usage:
     * <code>
     * $query->filterByDomicilioLaboral('fooValue');   // WHERE domicilio_laboral = 'fooValue'
     * $query->filterByDomicilioLaboral('%fooValue%'); // WHERE domicilio_laboral LIKE '%fooValue%'
     * </code>
     *
     * @param     string $domicilioLaboral The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByDomicilioLaboral($domicilioLaboral = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($domicilioLaboral)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $domicilioLaboral)) {
                $domicilioLaboral = str_replace('*', '%', $domicilioLaboral);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::DOMICILIO_LABORAL, $domicilioLaboral, $comparison);
    }

    /**
     * Filter the query on the colonia_laboral column
     *
     * Example usage:
     * <code>
     * $query->filterByColoniaLaboral('fooValue');   // WHERE colonia_laboral = 'fooValue'
     * $query->filterByColoniaLaboral('%fooValue%'); // WHERE colonia_laboral LIKE '%fooValue%'
     * </code>
     *
     * @param     string $coloniaLaboral The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByColoniaLaboral($coloniaLaboral = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($coloniaLaboral)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $coloniaLaboral)) {
                $coloniaLaboral = str_replace('*', '%', $coloniaLaboral);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::COLONIA_LABORAL, $coloniaLaboral, $comparison);
    }

    /**
     * Filter the query on the ciudad_laboral column
     *
     * Example usage:
     * <code>
     * $query->filterByCiudadLaboral('fooValue');   // WHERE ciudad_laboral = 'fooValue'
     * $query->filterByCiudadLaboral('%fooValue%'); // WHERE ciudad_laboral LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ciudadLaboral The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByCiudadLaboral($ciudadLaboral = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ciudadLaboral)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ciudadLaboral)) {
                $ciudadLaboral = str_replace('*', '%', $ciudadLaboral);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::CIUDAD_LABORAL, $ciudadLaboral, $comparison);
    }

    /**
     * Filter the query on the estado_laboral column
     *
     * Example usage:
     * <code>
     * $query->filterByEstadoLaboral('fooValue');   // WHERE estado_laboral = 'fooValue'
     * $query->filterByEstadoLaboral('%fooValue%'); // WHERE estado_laboral LIKE '%fooValue%'
     * </code>
     *
     * @param     string $estadoLaboral The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByEstadoLaboral($estadoLaboral = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($estadoLaboral)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $estadoLaboral)) {
                $estadoLaboral = str_replace('*', '%', $estadoLaboral);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::ESTADO_LABORAL, $estadoLaboral, $comparison);
    }

    /**
     * Filter the query on the cp_laboral column
     *
     * Example usage:
     * <code>
     * $query->filterByCpLaboral('fooValue');   // WHERE cp_laboral = 'fooValue'
     * $query->filterByCpLaboral('%fooValue%'); // WHERE cp_laboral LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cpLaboral The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByCpLaboral($cpLaboral = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cpLaboral)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cpLaboral)) {
                $cpLaboral = str_replace('*', '%', $cpLaboral);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::CP_LABORAL, $cpLaboral, $comparison);
    }

    /**
     * Filter the query on the tel_1_laboral column
     *
     * Example usage:
     * <code>
     * $query->filterByTel1Laboral('fooValue');   // WHERE tel_1_laboral = 'fooValue'
     * $query->filterByTel1Laboral('%fooValue%'); // WHERE tel_1_laboral LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel1Laboral The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByTel1Laboral($tel1Laboral = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel1Laboral)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel1Laboral)) {
                $tel1Laboral = str_replace('*', '%', $tel1Laboral);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::TEL_1_LABORAL, $tel1Laboral, $comparison);
    }

    /**
     * Filter the query on the tel_2_laboral column
     *
     * Example usage:
     * <code>
     * $query->filterByTel2Laboral('fooValue');   // WHERE tel_2_laboral = 'fooValue'
     * $query->filterByTel2Laboral('%fooValue%'); // WHERE tel_2_laboral LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel2Laboral The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByTel2Laboral($tel2Laboral = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel2Laboral)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel2Laboral)) {
                $tel2Laboral = str_replace('*', '%', $tel2Laboral);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::TEL_2_LABORAL, $tel2Laboral, $comparison);
    }

    /**
     * Filter the query on the saldo_corriente column
     *
     * Example usage:
     * <code>
     * $query->filterBySaldoCorriente(1234); // WHERE saldo_corriente = 1234
     * $query->filterBySaldoCorriente(array(12, 34)); // WHERE saldo_corriente IN (12, 34)
     * $query->filterBySaldoCorriente(array('min' => 12)); // WHERE saldo_corriente >= 12
     * $query->filterBySaldoCorriente(array('max' => 12)); // WHERE saldo_corriente <= 12
     * </code>
     *
     * @param     mixed $saldoCorriente The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterBySaldoCorriente($saldoCorriente = null, $comparison = null)
    {
        if (is_array($saldoCorriente)) {
            $useMinMax = false;
            if (isset($saldoCorriente['min'])) {
                $this->addUsingAlias(ResumenPeer::SALDO_CORRIENTE, $saldoCorriente['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($saldoCorriente['max'])) {
                $this->addUsingAlias(ResumenPeer::SALDO_CORRIENTE, $saldoCorriente['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResumenPeer::SALDO_CORRIENTE, $saldoCorriente, $comparison);
    }

    /**
     * Filter the query on the fecha_de_actualizacion column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaDeActualizacion('2011-03-14'); // WHERE fecha_de_actualizacion = '2011-03-14'
     * $query->filterByFechaDeActualizacion('now'); // WHERE fecha_de_actualizacion = '2011-03-14'
     * $query->filterByFechaDeActualizacion(array('max' => 'yesterday')); // WHERE fecha_de_actualizacion > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaDeActualizacion The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByFechaDeActualizacion($fechaDeActualizacion = null, $comparison = null)
    {
        if (is_array($fechaDeActualizacion)) {
            $useMinMax = false;
            if (isset($fechaDeActualizacion['min'])) {
                $this->addUsingAlias(ResumenPeer::FECHA_DE_ACTUALIZACION, $fechaDeActualizacion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaDeActualizacion['max'])) {
                $this->addUsingAlias(ResumenPeer::FECHA_DE_ACTUALIZACION, $fechaDeActualizacion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResumenPeer::FECHA_DE_ACTUALIZACION, $fechaDeActualizacion, $comparison);
    }

    /**
     * Filter the query on the numero_de_cuenta column
     *
     * Example usage:
     * <code>
     * $query->filterByNumeroDeCuenta('fooValue');   // WHERE numero_de_cuenta = 'fooValue'
     * $query->filterByNumeroDeCuenta('%fooValue%'); // WHERE numero_de_cuenta LIKE '%fooValue%'
     * </code>
     *
     * @param     string $numeroDeCuenta The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByNumeroDeCuenta($numeroDeCuenta = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($numeroDeCuenta)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $numeroDeCuenta)) {
                $numeroDeCuenta = str_replace('*', '%', $numeroDeCuenta);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::NUMERO_DE_CUENTA, $numeroDeCuenta, $comparison);
    }

    /**
     * Filter the query on the numero_de_credito column
     *
     * Example usage:
     * <code>
     * $query->filterByNumeroDeCredito('fooValue');   // WHERE numero_de_credito = 'fooValue'
     * $query->filterByNumeroDeCredito('%fooValue%'); // WHERE numero_de_credito LIKE '%fooValue%'
     * </code>
     *
     * @param     string $numeroDeCredito The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByNumeroDeCredito($numeroDeCredito = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($numeroDeCredito)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $numeroDeCredito)) {
                $numeroDeCredito = str_replace('*', '%', $numeroDeCredito);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::NUMERO_DE_CREDITO, $numeroDeCredito, $comparison);
    }

    /**
     * Filter the query on the contrato column
     *
     * Example usage:
     * <code>
     * $query->filterByContrato('fooValue');   // WHERE contrato = 'fooValue'
     * $query->filterByContrato('%fooValue%'); // WHERE contrato LIKE '%fooValue%'
     * </code>
     *
     * @param     string $contrato The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByContrato($contrato = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($contrato)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $contrato)) {
                $contrato = str_replace('*', '%', $contrato);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::CONTRATO, $contrato, $comparison);
    }

    /**
     * Filter the query on the saldo_total column
     *
     * Example usage:
     * <code>
     * $query->filterBySaldoTotal(1234); // WHERE saldo_total = 1234
     * $query->filterBySaldoTotal(array(12, 34)); // WHERE saldo_total IN (12, 34)
     * $query->filterBySaldoTotal(array('min' => 12)); // WHERE saldo_total >= 12
     * $query->filterBySaldoTotal(array('max' => 12)); // WHERE saldo_total <= 12
     * </code>
     *
     * @param     mixed $saldoTotal The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterBySaldoTotal($saldoTotal = null, $comparison = null)
    {
        if (is_array($saldoTotal)) {
            $useMinMax = false;
            if (isset($saldoTotal['min'])) {
                $this->addUsingAlias(ResumenPeer::SALDO_TOTAL, $saldoTotal['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($saldoTotal['max'])) {
                $this->addUsingAlias(ResumenPeer::SALDO_TOTAL, $saldoTotal['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResumenPeer::SALDO_TOTAL, $saldoTotal, $comparison);
    }

    /**
     * Filter the query on the saldo_vencido column
     *
     * Example usage:
     * <code>
     * $query->filterBySaldoVencido(1234); // WHERE saldo_vencido = 1234
     * $query->filterBySaldoVencido(array(12, 34)); // WHERE saldo_vencido IN (12, 34)
     * $query->filterBySaldoVencido(array('min' => 12)); // WHERE saldo_vencido >= 12
     * $query->filterBySaldoVencido(array('max' => 12)); // WHERE saldo_vencido <= 12
     * </code>
     *
     * @param     mixed $saldoVencido The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterBySaldoVencido($saldoVencido = null, $comparison = null)
    {
        if (is_array($saldoVencido)) {
            $useMinMax = false;
            if (isset($saldoVencido['min'])) {
                $this->addUsingAlias(ResumenPeer::SALDO_VENCIDO, $saldoVencido['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($saldoVencido['max'])) {
                $this->addUsingAlias(ResumenPeer::SALDO_VENCIDO, $saldoVencido['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResumenPeer::SALDO_VENCIDO, $saldoVencido, $comparison);
    }

    /**
     * Filter the query on the saldo_descuento_1 column
     *
     * Example usage:
     * <code>
     * $query->filterBySaldoDescuento1(1234); // WHERE saldo_descuento_1 = 1234
     * $query->filterBySaldoDescuento1(array(12, 34)); // WHERE saldo_descuento_1 IN (12, 34)
     * $query->filterBySaldoDescuento1(array('min' => 12)); // WHERE saldo_descuento_1 >= 12
     * $query->filterBySaldoDescuento1(array('max' => 12)); // WHERE saldo_descuento_1 <= 12
     * </code>
     *
     * @param     mixed $saldoDescuento1 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterBySaldoDescuento1($saldoDescuento1 = null, $comparison = null)
    {
        if (is_array($saldoDescuento1)) {
            $useMinMax = false;
            if (isset($saldoDescuento1['min'])) {
                $this->addUsingAlias(ResumenPeer::SALDO_DESCUENTO_1, $saldoDescuento1['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($saldoDescuento1['max'])) {
                $this->addUsingAlias(ResumenPeer::SALDO_DESCUENTO_1, $saldoDescuento1['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResumenPeer::SALDO_DESCUENTO_1, $saldoDescuento1, $comparison);
    }

    /**
     * Filter the query on the saldo_descuento_2 column
     *
     * Example usage:
     * <code>
     * $query->filterBySaldoDescuento2(1234); // WHERE saldo_descuento_2 = 1234
     * $query->filterBySaldoDescuento2(array(12, 34)); // WHERE saldo_descuento_2 IN (12, 34)
     * $query->filterBySaldoDescuento2(array('min' => 12)); // WHERE saldo_descuento_2 >= 12
     * $query->filterBySaldoDescuento2(array('max' => 12)); // WHERE saldo_descuento_2 <= 12
     * </code>
     *
     * @param     mixed $saldoDescuento2 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterBySaldoDescuento2($saldoDescuento2 = null, $comparison = null)
    {
        if (is_array($saldoDescuento2)) {
            $useMinMax = false;
            if (isset($saldoDescuento2['min'])) {
                $this->addUsingAlias(ResumenPeer::SALDO_DESCUENTO_2, $saldoDescuento2['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($saldoDescuento2['max'])) {
                $this->addUsingAlias(ResumenPeer::SALDO_DESCUENTO_2, $saldoDescuento2['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResumenPeer::SALDO_DESCUENTO_2, $saldoDescuento2, $comparison);
    }

    /**
     * Filter the query on the fecha_corte column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaCorte('2011-03-14'); // WHERE fecha_corte = '2011-03-14'
     * $query->filterByFechaCorte('now'); // WHERE fecha_corte = '2011-03-14'
     * $query->filterByFechaCorte(array('max' => 'yesterday')); // WHERE fecha_corte > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaCorte The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByFechaCorte($fechaCorte = null, $comparison = null)
    {
        if (is_array($fechaCorte)) {
            $useMinMax = false;
            if (isset($fechaCorte['min'])) {
                $this->addUsingAlias(ResumenPeer::FECHA_CORTE, $fechaCorte['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaCorte['max'])) {
                $this->addUsingAlias(ResumenPeer::FECHA_CORTE, $fechaCorte['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResumenPeer::FECHA_CORTE, $fechaCorte, $comparison);
    }

    /**
     * Filter the query on the fecha_limite column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaLimite('2011-03-14'); // WHERE fecha_limite = '2011-03-14'
     * $query->filterByFechaLimite('now'); // WHERE fecha_limite = '2011-03-14'
     * $query->filterByFechaLimite(array('max' => 'yesterday')); // WHERE fecha_limite > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaLimite The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByFechaLimite($fechaLimite = null, $comparison = null)
    {
        if (is_array($fechaLimite)) {
            $useMinMax = false;
            if (isset($fechaLimite['min'])) {
                $this->addUsingAlias(ResumenPeer::FECHA_LIMITE, $fechaLimite['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaLimite['max'])) {
                $this->addUsingAlias(ResumenPeer::FECHA_LIMITE, $fechaLimite['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResumenPeer::FECHA_LIMITE, $fechaLimite, $comparison);
    }

    /**
     * Filter the query on the fecha_de_ultimo_pago column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaDeUltimoPago('2011-03-14'); // WHERE fecha_de_ultimo_pago = '2011-03-14'
     * $query->filterByFechaDeUltimoPago('now'); // WHERE fecha_de_ultimo_pago = '2011-03-14'
     * $query->filterByFechaDeUltimoPago(array('max' => 'yesterday')); // WHERE fecha_de_ultimo_pago > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaDeUltimoPago The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByFechaDeUltimoPago($fechaDeUltimoPago = null, $comparison = null)
    {
        if (is_array($fechaDeUltimoPago)) {
            $useMinMax = false;
            if (isset($fechaDeUltimoPago['min'])) {
                $this->addUsingAlias(ResumenPeer::FECHA_DE_ULTIMO_PAGO, $fechaDeUltimoPago['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaDeUltimoPago['max'])) {
                $this->addUsingAlias(ResumenPeer::FECHA_DE_ULTIMO_PAGO, $fechaDeUltimoPago['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResumenPeer::FECHA_DE_ULTIMO_PAGO, $fechaDeUltimoPago, $comparison);
    }

    /**
     * Filter the query on the monto_ultimo_pago column
     *
     * Example usage:
     * <code>
     * $query->filterByMontoUltimoPago(1234); // WHERE monto_ultimo_pago = 1234
     * $query->filterByMontoUltimoPago(array(12, 34)); // WHERE monto_ultimo_pago IN (12, 34)
     * $query->filterByMontoUltimoPago(array('min' => 12)); // WHERE monto_ultimo_pago >= 12
     * $query->filterByMontoUltimoPago(array('max' => 12)); // WHERE monto_ultimo_pago <= 12
     * </code>
     *
     * @param     mixed $montoUltimoPago The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByMontoUltimoPago($montoUltimoPago = null, $comparison = null)
    {
        if (is_array($montoUltimoPago)) {
            $useMinMax = false;
            if (isset($montoUltimoPago['min'])) {
                $this->addUsingAlias(ResumenPeer::MONTO_ULTIMO_PAGO, $montoUltimoPago['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($montoUltimoPago['max'])) {
                $this->addUsingAlias(ResumenPeer::MONTO_ULTIMO_PAGO, $montoUltimoPago['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResumenPeer::MONTO_ULTIMO_PAGO, $montoUltimoPago, $comparison);
    }

    /**
     * Filter the query on the producto column
     *
     * Example usage:
     * <code>
     * $query->filterByProducto('fooValue');   // WHERE producto = 'fooValue'
     * $query->filterByProducto('%fooValue%'); // WHERE producto LIKE '%fooValue%'
     * </code>
     *
     * @param     string $producto The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByProducto($producto = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($producto)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $producto)) {
                $producto = str_replace('*', '%', $producto);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::PRODUCTO, $producto, $comparison);
    }

    /**
     * Filter the query on the subproducto column
     *
     * Example usage:
     * <code>
     * $query->filterBySubproducto('fooValue');   // WHERE subproducto = 'fooValue'
     * $query->filterBySubproducto('%fooValue%'); // WHERE subproducto LIKE '%fooValue%'
     * </code>
     *
     * @param     string $subproducto The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterBySubproducto($subproducto = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($subproducto)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $subproducto)) {
                $subproducto = str_replace('*', '%', $subproducto);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::SUBPRODUCTO, $subproducto, $comparison);
    }

    /**
     * Filter the query on the cliente column
     *
     * Example usage:
     * <code>
     * $query->filterByCliente('fooValue');   // WHERE cliente = 'fooValue'
     * $query->filterByCliente('%fooValue%'); // WHERE cliente LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cliente The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByCliente($cliente = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cliente)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cliente)) {
                $cliente = str_replace('*', '%', $cliente);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::CLIENTE, $cliente, $comparison);
    }

    /**
     * Filter the query on the status_de_credito column
     *
     * Example usage:
     * <code>
     * $query->filterByStatusDeCredito('fooValue');   // WHERE status_de_credito = 'fooValue'
     * $query->filterByStatusDeCredito('%fooValue%'); // WHERE status_de_credito LIKE '%fooValue%'
     * </code>
     *
     * @param     string $statusDeCredito The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByStatusDeCredito($statusDeCredito = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($statusDeCredito)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $statusDeCredito)) {
                $statusDeCredito = str_replace('*', '%', $statusDeCredito);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::STATUS_DE_CREDITO, $statusDeCredito, $comparison);
    }

    /**
     * Filter the query on the pagos_vencidos column
     *
     * Example usage:
     * <code>
     * $query->filterByPagosVencidos(1234); // WHERE pagos_vencidos = 1234
     * $query->filterByPagosVencidos(array(12, 34)); // WHERE pagos_vencidos IN (12, 34)
     * $query->filterByPagosVencidos(array('min' => 12)); // WHERE pagos_vencidos >= 12
     * $query->filterByPagosVencidos(array('max' => 12)); // WHERE pagos_vencidos <= 12
     * </code>
     *
     * @param     mixed $pagosVencidos The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByPagosVencidos($pagosVencidos = null, $comparison = null)
    {
        if (is_array($pagosVencidos)) {
            $useMinMax = false;
            if (isset($pagosVencidos['min'])) {
                $this->addUsingAlias(ResumenPeer::PAGOS_VENCIDOS, $pagosVencidos['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pagosVencidos['max'])) {
                $this->addUsingAlias(ResumenPeer::PAGOS_VENCIDOS, $pagosVencidos['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResumenPeer::PAGOS_VENCIDOS, $pagosVencidos, $comparison);
    }

    /**
     * Filter the query on the monto_adeudado column
     *
     * Example usage:
     * <code>
     * $query->filterByMontoAdeudado(1234); // WHERE monto_adeudado = 1234
     * $query->filterByMontoAdeudado(array(12, 34)); // WHERE monto_adeudado IN (12, 34)
     * $query->filterByMontoAdeudado(array('min' => 12)); // WHERE monto_adeudado >= 12
     * $query->filterByMontoAdeudado(array('max' => 12)); // WHERE monto_adeudado <= 12
     * </code>
     *
     * @param     mixed $montoAdeudado The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByMontoAdeudado($montoAdeudado = null, $comparison = null)
    {
        if (is_array($montoAdeudado)) {
            $useMinMax = false;
            if (isset($montoAdeudado['min'])) {
                $this->addUsingAlias(ResumenPeer::MONTO_ADEUDADO, $montoAdeudado['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($montoAdeudado['max'])) {
                $this->addUsingAlias(ResumenPeer::MONTO_ADEUDADO, $montoAdeudado['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResumenPeer::MONTO_ADEUDADO, $montoAdeudado, $comparison);
    }

    /**
     * Filter the query on the fecha_de_asignacion column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaDeAsignacion('2011-03-14'); // WHERE fecha_de_asignacion = '2011-03-14'
     * $query->filterByFechaDeAsignacion('now'); // WHERE fecha_de_asignacion = '2011-03-14'
     * $query->filterByFechaDeAsignacion(array('max' => 'yesterday')); // WHERE fecha_de_asignacion > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaDeAsignacion The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByFechaDeAsignacion($fechaDeAsignacion = null, $comparison = null)
    {
        if (is_array($fechaDeAsignacion)) {
            $useMinMax = false;
            if (isset($fechaDeAsignacion['min'])) {
                $this->addUsingAlias(ResumenPeer::FECHA_DE_ASIGNACION, $fechaDeAsignacion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaDeAsignacion['max'])) {
                $this->addUsingAlias(ResumenPeer::FECHA_DE_ASIGNACION, $fechaDeAsignacion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResumenPeer::FECHA_DE_ASIGNACION, $fechaDeAsignacion, $comparison);
    }

    /**
     * Filter the query on the fecha_de_deasignacion column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaDeDeasignacion('2011-03-14'); // WHERE fecha_de_deasignacion = '2011-03-14'
     * $query->filterByFechaDeDeasignacion('now'); // WHERE fecha_de_deasignacion = '2011-03-14'
     * $query->filterByFechaDeDeasignacion(array('max' => 'yesterday')); // WHERE fecha_de_deasignacion > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaDeDeasignacion The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByFechaDeDeasignacion($fechaDeDeasignacion = null, $comparison = null)
    {
        if (is_array($fechaDeDeasignacion)) {
            $useMinMax = false;
            if (isset($fechaDeDeasignacion['min'])) {
                $this->addUsingAlias(ResumenPeer::FECHA_DE_DEASIGNACION, $fechaDeDeasignacion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaDeDeasignacion['max'])) {
                $this->addUsingAlias(ResumenPeer::FECHA_DE_DEASIGNACION, $fechaDeDeasignacion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResumenPeer::FECHA_DE_DEASIGNACION, $fechaDeDeasignacion, $comparison);
    }

    /**
     * Filter the query on the cuenta_concentradora_1 column
     *
     * Example usage:
     * <code>
     * $query->filterByCuentaConcentradora1('fooValue');   // WHERE cuenta_concentradora_1 = 'fooValue'
     * $query->filterByCuentaConcentradora1('%fooValue%'); // WHERE cuenta_concentradora_1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cuentaConcentradora1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByCuentaConcentradora1($cuentaConcentradora1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cuentaConcentradora1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cuentaConcentradora1)) {
                $cuentaConcentradora1 = str_replace('*', '%', $cuentaConcentradora1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::CUENTA_CONCENTRADORA_1, $cuentaConcentradora1, $comparison);
    }

    /**
     * Filter the query on the saldo_cuota column
     *
     * Example usage:
     * <code>
     * $query->filterBySaldoCuota(1234); // WHERE saldo_cuota = 1234
     * $query->filterBySaldoCuota(array(12, 34)); // WHERE saldo_cuota IN (12, 34)
     * $query->filterBySaldoCuota(array('min' => 12)); // WHERE saldo_cuota >= 12
     * $query->filterBySaldoCuota(array('max' => 12)); // WHERE saldo_cuota <= 12
     * </code>
     *
     * @param     mixed $saldoCuota The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterBySaldoCuota($saldoCuota = null, $comparison = null)
    {
        if (is_array($saldoCuota)) {
            $useMinMax = false;
            if (isset($saldoCuota['min'])) {
                $this->addUsingAlias(ResumenPeer::SALDO_CUOTA, $saldoCuota['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($saldoCuota['max'])) {
                $this->addUsingAlias(ResumenPeer::SALDO_CUOTA, $saldoCuota['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResumenPeer::SALDO_CUOTA, $saldoCuota, $comparison);
    }

    /**
     * Filter the query on the email_deudor column
     *
     * Example usage:
     * <code>
     * $query->filterByEmailDeudor('fooValue');   // WHERE email_deudor = 'fooValue'
     * $query->filterByEmailDeudor('%fooValue%'); // WHERE email_deudor LIKE '%fooValue%'
     * </code>
     *
     * @param     string $emailDeudor The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByEmailDeudor($emailDeudor = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($emailDeudor)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $emailDeudor)) {
                $emailDeudor = str_replace('*', '%', $emailDeudor);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::EMAIL_DEUDOR, $emailDeudor, $comparison);
    }

    /**
     * Filter the query on the id_cuenta column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCuenta(1234); // WHERE id_cuenta = 1234
     * $query->filterByIdCuenta(array(12, 34)); // WHERE id_cuenta IN (12, 34)
     * $query->filterByIdCuenta(array('min' => 12)); // WHERE id_cuenta >= 12
     * $query->filterByIdCuenta(array('max' => 12)); // WHERE id_cuenta <= 12
     * </code>
     *
     * @param     mixed $idCuenta The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByIdCuenta($idCuenta = null, $comparison = null)
    {
        if (is_array($idCuenta)) {
            $useMinMax = false;
            if (isset($idCuenta['min'])) {
                $this->addUsingAlias(ResumenPeer::ID_CUENTA, $idCuenta['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCuenta['max'])) {
                $this->addUsingAlias(ResumenPeer::ID_CUENTA, $idCuenta['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResumenPeer::ID_CUENTA, $idCuenta, $comparison);
    }

    /**
     * Filter the query on the nss column
     *
     * Example usage:
     * <code>
     * $query->filterByNss('fooValue');   // WHERE nss = 'fooValue'
     * $query->filterByNss('%fooValue%'); // WHERE nss LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nss The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByNss($nss = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nss)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nss)) {
                $nss = str_replace('*', '%', $nss);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::NSS, $nss, $comparison);
    }

    /**
     * Filter the query on the rfc_deudor column
     *
     * Example usage:
     * <code>
     * $query->filterByRfcDeudor('fooValue');   // WHERE rfc_deudor = 'fooValue'
     * $query->filterByRfcDeudor('%fooValue%'); // WHERE rfc_deudor LIKE '%fooValue%'
     * </code>
     *
     * @param     string $rfcDeudor The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByRfcDeudor($rfcDeudor = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rfcDeudor)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $rfcDeudor)) {
                $rfcDeudor = str_replace('*', '%', $rfcDeudor);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::RFC_DEUDOR, $rfcDeudor, $comparison);
    }

    /**
     * Filter the query on the telefonos_marcados column
     *
     * Example usage:
     * <code>
     * $query->filterByTelefonosMarcados('fooValue');   // WHERE telefonos_marcados = 'fooValue'
     * $query->filterByTelefonosMarcados('%fooValue%'); // WHERE telefonos_marcados LIKE '%fooValue%'
     * </code>
     *
     * @param     string $telefonosMarcados The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByTelefonosMarcados($telefonosMarcados = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($telefonosMarcados)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $telefonosMarcados)) {
                $telefonosMarcados = str_replace('*', '%', $telefonosMarcados);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::TELEFONOS_MARCADOS, $telefonosMarcados, $comparison);
    }

    /**
     * Filter the query on the tel_1_verif column
     *
     * Example usage:
     * <code>
     * $query->filterByTel1Verif('fooValue');   // WHERE tel_1_verif = 'fooValue'
     * $query->filterByTel1Verif('%fooValue%'); // WHERE tel_1_verif LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel1Verif The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByTel1Verif($tel1Verif = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel1Verif)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel1Verif)) {
                $tel1Verif = str_replace('*', '%', $tel1Verif);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::TEL_1_VERIF, $tel1Verif, $comparison);
    }

    /**
     * Filter the query on the tel_2_verif column
     *
     * Example usage:
     * <code>
     * $query->filterByTel2Verif('fooValue');   // WHERE tel_2_verif = 'fooValue'
     * $query->filterByTel2Verif('%fooValue%'); // WHERE tel_2_verif LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel2Verif The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByTel2Verif($tel2Verif = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel2Verif)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel2Verif)) {
                $tel2Verif = str_replace('*', '%', $tel2Verif);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::TEL_2_VERIF, $tel2Verif, $comparison);
    }

    /**
     * Filter the query on the tel_3_verif column
     *
     * Example usage:
     * <code>
     * $query->filterByTel3Verif('fooValue');   // WHERE tel_3_verif = 'fooValue'
     * $query->filterByTel3Verif('%fooValue%'); // WHERE tel_3_verif LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel3Verif The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByTel3Verif($tel3Verif = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel3Verif)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel3Verif)) {
                $tel3Verif = str_replace('*', '%', $tel3Verif);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::TEL_3_VERIF, $tel3Verif, $comparison);
    }

    /**
     * Filter the query on the tel_4_verif column
     *
     * Example usage:
     * <code>
     * $query->filterByTel4Verif('fooValue');   // WHERE tel_4_verif = 'fooValue'
     * $query->filterByTel4Verif('%fooValue%'); // WHERE tel_4_verif LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tel4Verif The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByTel4Verif($tel4Verif = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tel4Verif)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tel4Verif)) {
                $tel4Verif = str_replace('*', '%', $tel4Verif);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::TEL_4_VERIF, $tel4Verif, $comparison);
    }

    /**
     * Filter the query on the telefono_de_ultimo_contacto column
     *
     * Example usage:
     * <code>
     * $query->filterByTelefonoDeUltimoContacto('fooValue');   // WHERE telefono_de_ultimo_contacto = 'fooValue'
     * $query->filterByTelefonoDeUltimoContacto('%fooValue%'); // WHERE telefono_de_ultimo_contacto LIKE '%fooValue%'
     * </code>
     *
     * @param     string $telefonoDeUltimoContacto The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByTelefonoDeUltimoContacto($telefonoDeUltimoContacto = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($telefonoDeUltimoContacto)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $telefonoDeUltimoContacto)) {
                $telefonoDeUltimoContacto = str_replace('*', '%', $telefonoDeUltimoContacto);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::TELEFONO_DE_ULTIMO_CONTACTO, $telefonoDeUltimoContacto, $comparison);
    }

    /**
     * Filter the query on the dias_vencidos column
     *
     * Example usage:
     * <code>
     * $query->filterByDiasVencidos(1234); // WHERE dias_vencidos = 1234
     * $query->filterByDiasVencidos(array(12, 34)); // WHERE dias_vencidos IN (12, 34)
     * $query->filterByDiasVencidos(array('min' => 12)); // WHERE dias_vencidos >= 12
     * $query->filterByDiasVencidos(array('max' => 12)); // WHERE dias_vencidos <= 12
     * </code>
     *
     * @param     mixed $diasVencidos The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByDiasVencidos($diasVencidos = null, $comparison = null)
    {
        if (is_array($diasVencidos)) {
            $useMinMax = false;
            if (isset($diasVencidos['min'])) {
                $this->addUsingAlias(ResumenPeer::DIAS_VENCIDOS, $diasVencidos['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($diasVencidos['max'])) {
                $this->addUsingAlias(ResumenPeer::DIAS_VENCIDOS, $diasVencidos['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResumenPeer::DIAS_VENCIDOS, $diasVencidos, $comparison);
    }

    /**
     * Filter the query on the ejecutivo_asignado_call_center column
     *
     * Example usage:
     * <code>
     * $query->filterByEjecutivoAsignadoCallCenter('fooValue');   // WHERE ejecutivo_asignado_call_center = 'fooValue'
     * $query->filterByEjecutivoAsignadoCallCenter('%fooValue%'); // WHERE ejecutivo_asignado_call_center LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ejecutivoAsignadoCallCenter The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByEjecutivoAsignadoCallCenter($ejecutivoAsignadoCallCenter = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ejecutivoAsignadoCallCenter)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ejecutivoAsignadoCallCenter)) {
                $ejecutivoAsignadoCallCenter = str_replace('*', '%', $ejecutivoAsignadoCallCenter);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::EJECUTIVO_ASIGNADO_CALL_CENTER, $ejecutivoAsignadoCallCenter, $comparison);
    }

    /**
     * Filter the query on the ejecutivo_asignado_domiciliario column
     *
     * Example usage:
     * <code>
     * $query->filterByEjecutivoAsignadoDomiciliario('fooValue');   // WHERE ejecutivo_asignado_domiciliario = 'fooValue'
     * $query->filterByEjecutivoAsignadoDomiciliario('%fooValue%'); // WHERE ejecutivo_asignado_domiciliario LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ejecutivoAsignadoDomiciliario The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByEjecutivoAsignadoDomiciliario($ejecutivoAsignadoDomiciliario = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ejecutivoAsignadoDomiciliario)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ejecutivoAsignadoDomiciliario)) {
                $ejecutivoAsignadoDomiciliario = str_replace('*', '%', $ejecutivoAsignadoDomiciliario);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::EJECUTIVO_ASIGNADO_DOMICILIARIO, $ejecutivoAsignadoDomiciliario, $comparison);
    }

    /**
     * Filter the query on the prioridad_de_gestion column
     *
     * Example usage:
     * <code>
     * $query->filterByPrioridadDeGestion(1234); // WHERE prioridad_de_gestion = 1234
     * $query->filterByPrioridadDeGestion(array(12, 34)); // WHERE prioridad_de_gestion IN (12, 34)
     * $query->filterByPrioridadDeGestion(array('min' => 12)); // WHERE prioridad_de_gestion >= 12
     * $query->filterByPrioridadDeGestion(array('max' => 12)); // WHERE prioridad_de_gestion <= 12
     * </code>
     *
     * @param     mixed $prioridadDeGestion The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByPrioridadDeGestion($prioridadDeGestion = null, $comparison = null)
    {
        if (is_array($prioridadDeGestion)) {
            $useMinMax = false;
            if (isset($prioridadDeGestion['min'])) {
                $this->addUsingAlias(ResumenPeer::PRIORIDAD_DE_GESTION, $prioridadDeGestion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($prioridadDeGestion['max'])) {
                $this->addUsingAlias(ResumenPeer::PRIORIDAD_DE_GESTION, $prioridadDeGestion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResumenPeer::PRIORIDAD_DE_GESTION, $prioridadDeGestion, $comparison);
    }

    /**
     * Filter the query on the nrpp column
     *
     * Example usage:
     * <code>
     * $query->filterByNrpp('fooValue');   // WHERE nrpp = 'fooValue'
     * $query->filterByNrpp('%fooValue%'); // WHERE nrpp LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nrpp The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByNrpp($nrpp = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nrpp)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nrpp)) {
                $nrpp = str_replace('*', '%', $nrpp);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::NRPP, $nrpp, $comparison);
    }

    /**
     * Filter the query on the parentesco_aval column
     *
     * Example usage:
     * <code>
     * $query->filterByParentescoAval('fooValue');   // WHERE parentesco_aval = 'fooValue'
     * $query->filterByParentescoAval('%fooValue%'); // WHERE parentesco_aval LIKE '%fooValue%'
     * </code>
     *
     * @param     string $parentescoAval The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByParentescoAval($parentescoAval = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($parentescoAval)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $parentescoAval)) {
                $parentescoAval = str_replace('*', '%', $parentescoAval);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::PARENTESCO_AVAL, $parentescoAval, $comparison);
    }

    /**
     * Filter the query on the localizar column
     *
     * Example usage:
     * <code>
     * $query->filterByLocalizar(true); // WHERE localizar = true
     * $query->filterByLocalizar('yes'); // WHERE localizar = true
     * </code>
     *
     * @param     boolean|string $localizar The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByLocalizar($localizar = null, $comparison = null)
    {
        if (is_string($localizar)) {
            $localizar = in_array(strtolower($localizar), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ResumenPeer::LOCALIZAR, $localizar, $comparison);
    }

    /**
     * Filter the query on the fecha_ultima_gestion column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaUltimaGestion('2011-03-14'); // WHERE fecha_ultima_gestion = '2011-03-14'
     * $query->filterByFechaUltimaGestion('now'); // WHERE fecha_ultima_gestion = '2011-03-14'
     * $query->filterByFechaUltimaGestion(array('max' => 'yesterday')); // WHERE fecha_ultima_gestion > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaUltimaGestion The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByFechaUltimaGestion($fechaUltimaGestion = null, $comparison = null)
    {
        if (is_array($fechaUltimaGestion)) {
            $useMinMax = false;
            if (isset($fechaUltimaGestion['min'])) {
                $this->addUsingAlias(ResumenPeer::FECHA_ULTIMA_GESTION, $fechaUltimaGestion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaUltimaGestion['max'])) {
                $this->addUsingAlias(ResumenPeer::FECHA_ULTIMA_GESTION, $fechaUltimaGestion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResumenPeer::FECHA_ULTIMA_GESTION, $fechaUltimaGestion, $comparison);
    }

    /**
     * Filter the query on the empresa column
     *
     * Example usage:
     * <code>
     * $query->filterByEmpresa('fooValue');   // WHERE empresa = 'fooValue'
     * $query->filterByEmpresa('%fooValue%'); // WHERE empresa LIKE '%fooValue%'
     * </code>
     *
     * @param     string $empresa The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByEmpresa($empresa = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($empresa)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $empresa)) {
                $empresa = str_replace('*', '%', $empresa);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::EMPRESA, $empresa, $comparison);
    }

    /**
     * Filter the query on the timelock column
     *
     * Example usage:
     * <code>
     * $query->filterByTimelock('2011-03-14'); // WHERE timelock = '2011-03-14'
     * $query->filterByTimelock('now'); // WHERE timelock = '2011-03-14'
     * $query->filterByTimelock(array('max' => 'yesterday')); // WHERE timelock > '2011-03-13'
     * </code>
     *
     * @param     mixed $timelock The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByTimelock($timelock = null, $comparison = null)
    {
        if (is_array($timelock)) {
            $useMinMax = false;
            if (isset($timelock['min'])) {
                $this->addUsingAlias(ResumenPeer::TIMELOCK, $timelock['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($timelock['max'])) {
                $this->addUsingAlias(ResumenPeer::TIMELOCK, $timelock['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResumenPeer::TIMELOCK, $timelock, $comparison);
    }

    /**
     * Filter the query on the locker column
     *
     * Example usage:
     * <code>
     * $query->filterByLocker('fooValue');   // WHERE locker = 'fooValue'
     * $query->filterByLocker('%fooValue%'); // WHERE locker LIKE '%fooValue%'
     * </code>
     *
     * @param     string $locker The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByLocker($locker = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($locker)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $locker)) {
                $locker = str_replace('*', '%', $locker);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::LOCKER, $locker, $comparison);
    }

    /**
     * Filter the query on the fecha_convenio column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaConvenio('2011-03-14'); // WHERE fecha_convenio = '2011-03-14'
     * $query->filterByFechaConvenio('now'); // WHERE fecha_convenio = '2011-03-14'
     * $query->filterByFechaConvenio(array('max' => 'yesterday')); // WHERE fecha_convenio > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaConvenio The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByFechaConvenio($fechaConvenio = null, $comparison = null)
    {
        if (is_array($fechaConvenio)) {
            $useMinMax = false;
            if (isset($fechaConvenio['min'])) {
                $this->addUsingAlias(ResumenPeer::FECHA_CONVENIO, $fechaConvenio['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaConvenio['max'])) {
                $this->addUsingAlias(ResumenPeer::FECHA_CONVENIO, $fechaConvenio['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResumenPeer::FECHA_CONVENIO, $fechaConvenio, $comparison);
    }

    /**
     * Filter the query on the especial column
     *
     * Example usage:
     * <code>
     * $query->filterByEspecial(true); // WHERE especial = true
     * $query->filterByEspecial('yes'); // WHERE especial = true
     * </code>
     *
     * @param     boolean|string $especial The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByEspecial($especial = null, $comparison = null)
    {
        if (is_string($especial)) {
            $especial = in_array(strtolower($especial), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ResumenPeer::ESPECIAL, $especial, $comparison);
    }

    /**
     * Filter the query on the direccion_nueva column
     *
     * Example usage:
     * <code>
     * $query->filterByDireccionNueva('fooValue');   // WHERE direccion_nueva = 'fooValue'
     * $query->filterByDireccionNueva('%fooValue%'); // WHERE direccion_nueva LIKE '%fooValue%'
     * </code>
     *
     * @param     string $direccionNueva The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByDireccionNueva($direccionNueva = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($direccionNueva)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $direccionNueva)) {
                $direccionNueva = str_replace('*', '%', $direccionNueva);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResumenPeer::DIRECCION_NUEVA, $direccionNueva, $comparison);
    }

    /**
     * Filter the query on the norobot column
     *
     * Example usage:
     * <code>
     * $query->filterByNorobot('2011-03-14'); // WHERE norobot = '2011-03-14'
     * $query->filterByNorobot('now'); // WHERE norobot = '2011-03-14'
     * $query->filterByNorobot(array('max' => 'yesterday')); // WHERE norobot > '2011-03-13'
     * </code>
     *
     * @param     mixed $norobot The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function filterByNorobot($norobot = null, $comparison = null)
    {
        if (is_array($norobot)) {
            $useMinMax = false;
            if (isset($norobot['min'])) {
                $this->addUsingAlias(ResumenPeer::NOROBOT, $norobot['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($norobot['max'])) {
                $this->addUsingAlias(ResumenPeer::NOROBOT, $norobot['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResumenPeer::NOROBOT, $norobot, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Resumen $resumen Object to remove from the list of results
     *
     * @return ResumenQuery The current query, for fluid interface
     */
    public function prune($resumen = null)
    {
        if ($resumen) {
            $this->addUsingAlias(ResumenPeer::ID_CUENTA, $resumen->getIdCuenta(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
