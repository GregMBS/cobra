
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- acciones
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `acciones`;

CREATE TABLE `acciones`
(
    `accion` VARCHAR(255) NOT NULL,
    `callcenter` TINYINT(1),
    `visitas` TINYINT(1),
    `judicial` TINYINT(1),
    `promo` TINYINT(1) DEFAULT 0,
    PRIMARY KEY (`accion`),
    INDEX `cc` (`callcenter`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- breaks
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `breaks`;

CREATE TABLE `breaks`
(
    `auto` INTEGER NOT NULL AUTO_INCREMENT,
    `gestor` VARCHAR(50) NOT NULL,
    `tipo` VARCHAR(50) NOT NULL,
    `empieza` TIME NOT NULL,
    `termina` TIME NOT NULL,
    PRIMARY KEY (`auto`),
    INDEX `new_index` (`gestor`),
    INDEX `new_index2` (`empieza`, `termina`),
    INDEX `new_index3` (`gestor`, `empieza`, `termina`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- callme
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `callme`;

CREATE TABLE `callme`
(
    `auto` INTEGER NOT NULL AUTO_INCREMENT,
    `gestor` VARCHAR(255) NOT NULL,
    `cuenta` VARCHAR(255) NOT NULL,
    `tel` VARCHAR(255) NOT NULL,
    `ext` VARCHAR(255) DEFAULT '0' NOT NULL,
    `tiempo` DATETIME NOT NULL,
    `completado` TINYINT DEFAULT 0 NOT NULL,
    PRIMARY KEY (`auto`),
    INDEX `c_tele` (`tel`),
    INDEX `fini` (`completado`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- cargadex
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `cargadex`;

CREATE TABLE `cargadex`
(
    `auto` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `field` VARCHAR(255) NOT NULL,
    `type` VARCHAR(255),
    `nullok` VARCHAR(255),
    `position` int(10) unsigned,
    `cliente` VARCHAR(255) NOT NULL,
    `ktable` VARCHAR(255),
    PRIMARY KEY (`auto`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- clientes
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes`
(
    `cliente` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`cliente`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- cnp
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `cnp`;

CREATE TABLE `cnp`
(
    `status` VARCHAR(255),
    `auto` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `acr` VARCHAR(255),
    PRIMARY KEY (`auto`),
    INDEX `cnpdex` (`status`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- csi_cobradores
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `csi_cobradores`;

CREATE TABLE `csi_cobradores`
(
    `sdc` VARCHAR(255) NOT NULL,
    `cobrador` INTEGER NOT NULL,
    PRIMARY KEY (`sdc`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- csidict
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `csidict`;

CREATE TABLE `csidict`
(
    `dictamen` VARCHAR(255) NOT NULL,
    `csi_cr` VARCHAR(255),
    `csi_res` VARCHAR(255),
    `csi_tipo` VARCHAR(255),
    PRIMARY KEY (`dictamen`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- csilugar
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `csilugar`;

CREATE TABLE `csilugar`
(
    `accion` VARCHAR(255) NOT NULL,
    `lugar` VARCHAR(255),
    `codigo` VARCHAR(25),
    PRIMARY KEY (`accion`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- csisdact
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `csisdact`;

CREATE TABLE `csisdact`
(
    `ndc` INTEGER NOT NULL,
    `sd1` DECIMAL NOT NULL,
    `sd2` DECIMAL NOT NULL,
    PRIMARY KEY (`ndc`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- cyberact
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `cyberact`;

CREATE TABLE `cyberact`
(
    `accion` VARCHAR(255) NOT NULL,
    `descripcion` VARCHAR(255),
    `codigo` VARCHAR(25),
    `auto` INTEGER NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (`auto`),
    INDEX `new_index` (`accion`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- cyberres
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `cyberres`;

CREATE TABLE `cyberres`
(
    `dictamen` VARCHAR(255) NOT NULL,
    `csi_cr` VARCHAR(255),
    `csi_res` VARCHAR(255),
    `auto` INTEGER NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (`auto`),
    INDEX `new_index` (`csi_cr`, `dictamen`),
    INDEX `new_index2` (`dictamen`, `csi_cr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- deadlines
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `deadlines`;

CREATE TABLE `deadlines`
(
    `c_tele` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`c_tele`),
    INDEX `new_index` (`c_tele`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- dictamenes
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `dictamenes`;

CREATE TABLE `dictamenes`
(
    `dictamen` VARCHAR(255) NOT NULL,
    `visitas` TINYINT(1) DEFAULT 0,
    `callcenter` TINYINT(1) DEFAULT 0,
    `judicial` TINYINT(1) DEFAULT 0,
    `promo` TINYINT(1) DEFAULT 0,
    `auto` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `v_cc` int(10) unsigned DEFAULT 99 NOT NULL,
    `v_v` int(10) unsigned DEFAULT 99 NOT NULL,
    `v_j` int(10) unsigned DEFAULT 99 NOT NULL,
    `queue` VARCHAR(255),
    PRIMARY KEY (`auto`),
    INDEX `value` (`v_cc`),
    INDEX `q` (`queue`),
    INDEX `cstats` (`dictamen`),
    INDEX `cc` (`callcenter`),
    INDEX `sa` (`dictamen`, `v_cc`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- encuesta
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `encuesta`;

CREATE TABLE `encuesta`
(
    `id` VARCHAR(255) DEFAULT '0' NOT NULL,
    `auto` INTEGER NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (`auto`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- extradex
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `extradex`;

CREATE TABLE `extradex`
(
    `auto` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `field` VARCHAR(255) NOT NULL,
    `type` VARCHAR(255),
    `nullok` VARCHAR(255),
    `position` int(10) unsigned,
    PRIMARY KEY (`auto`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- foliolist
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `foliolist`;

CREATE TABLE `foliolist`
(
    `cliente` VARCHAR(255) NOT NULL,
    `folio` INTEGER NOT NULL,
    `enviado` TINYINT(1) DEFAULT 0 NOT NULL,
    `upda` INTEGER DEFAULT 0,
    `crear` CHAR DEFAULT '' NOT NULL,
    `cuenta` VARCHAR(255) DEFAULT '' NOT NULL,
    `nombre_deudor` VARCHAR(255),
    `capital` DECIMAL DEFAULT 0.00 NOT NULL,
    `saldo_can` DECIMAL DEFAULT 0.00 NOT NULL,
    `mora` INTEGER DEFAULT 0 NOT NULL,
    `n_prom` DECIMAL,
    `d_prom1` DATE,
    `n_prom1` DECIMAL,
    `d_prom2` DATE,
    `n_prom2` DECIMAL,
    `cuenta_concentradora_1` VARCHAR(25),
    `d_fech` DATE,
    `id_cuenta` INTEGER DEFAULT 0 NOT NULL,
    `cnp` VARCHAR(255),
    `auto` INTEGER DEFAULT 0 NOT NULL,
    `ciudad_deudor` VARCHAR(255),
    `estado_deudor` VARCHAR(25),
    `gestor` VARCHAR(255),
    `sdc` VARCHAR(50),
    `upd` CHAR DEFAULT '' NOT NULL,
    `c_prom` VARCHAR(255),
    `c_freq` VARCHAR(20),
    `diff` INTEGER(7),
    PRIMARY KEY (`cliente`,`folio`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- folios
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `folios`;

CREATE TABLE `folios`
(
    `folio` INTEGER NOT NULL,
    `usado` TINYINT(1) DEFAULT 0 NOT NULL,
    `cuenta` VARCHAR(16),
    `gestor` VARCHAR(255),
    `enviado` TINYINT(1) DEFAULT 0 NOT NULL,
    `fecha` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `mora` INTEGER DEFAULT 0 NOT NULL,
    `capital` DECIMAL DEFAULT 0.00 NOT NULL,
    `saldo_can` DECIMAL DEFAULT 0.00 NOT NULL,
    `cliente` VARCHAR(255) NOT NULL,
    `auto` INTEGER NOT NULL AUTO_INCREMENT,
    `mercancia` TINYINT DEFAULT 0 NOT NULL,
    `id` INTEGER DEFAULT 0 NOT NULL,
    PRIMARY KEY (`auto`),
    UNIQUE INDEX `ufol` (`folio`, `cliente`),
    INDEX `cta` (`cuenta`),
    INDEX `ccmatch` (`cuenta`, `cliente`),
    INDEX `propuesta` (`folio`),
    INDEX `d_fech` (`fecha`),
    INDEX `idc` (`id`, `cliente`, `enviado`, `folio`),
    INDEX `bigsearch` (`enviado`, `cliente`, `folio`),
    INDEX `cli` (`cliente`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- gchangelog
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `gchangelog`;

CREATE TABLE `gchangelog`
(
    `auto` INTEGER NOT NULL AUTO_INCREMENT,
    `id_cuenta` INTEGER NOT NULL,
    `fechahora` DATETIME NOT NULL,
    `gestor_old` VARCHAR(255),
    `gestor_new` VARCHAR(255),
    PRIMARY KEY (`auto`),
    INDEX `c_cont` (`id_cuenta`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- grupos
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `grupos`;

CREATE TABLE `grupos`
(
    `auto` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `grupo` VARCHAR(255) NOT NULL,
    `pw` VARCHAR(255),
    `enlace` VARCHAR(255),
    PRIMARY KEY (`auto`),
    INDEX `tipo` (`grupo`),
    INDEX `pwd` (`pw`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- histdate
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `histdate`;

CREATE TABLE `histdate`
(
    `auto` INTEGER DEFAULT 0 NOT NULL,
    `d_fech` DATE,
    PRIMARY KEY (`auto`),
    INDEX `fecha` (`d_fech`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- histels
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `histels`;

CREATE TABLE `histels`
(
    `htel` VARCHAR(8) DEFAULT '' NOT NULL,
    PRIMARY KEY (`htel`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- histgest
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `histgest`;

CREATE TABLE `histgest`
(
    `auto` INTEGER DEFAULT 0 NOT NULL,
    `c_cvge` VARCHAR(255),
    PRIMARY KEY (`auto`),
    INDEX `new_index` (`auto`),
    INDEX `new_index2` (`c_cvge`),
    INDEX `cover` (`auto`, `c_cvge`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- historia
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `historia`;

CREATE TABLE `historia`
(
    `Auto` INTEGER NOT NULL AUTO_INCREMENT,
    `C_CVGE` VARCHAR(255),
    `C_CVBA` VARCHAR(255),
    `C_CONT` INTEGER DEFAULT 0 NOT NULL,
    `C_CVST` VARCHAR(255),
    `D_FECH` DATE,
    `C_HRIN` TIME,
    `C_HRFI` TIME,
    `C_TELE` VARCHAR(255),
    `C_MSGE` VARCHAR(255),
    `CUENTA` VARCHAR(50) DEFAULT '0' NOT NULL,
    `C_OBSE1` VARCHAR(255),
    `C_OBSE2` VARCHAR(255),
    `C_CONTAN` VARCHAR(255),
    `C_NSE` VARCHAR(255),
    `C_VISIT` VARCHAR(255),
    `C_ATTE` VARCHAR(255),
    `C_CNIV` VARCHAR(255),
    `C_CARG` VARCHAR(255),
    `C_CFAC` VARCHAR(255),
    `C_CPTA` VARCHAR(255),
    `C_RCON` VARCHAR(2),
    `AUTH` VARCHAR(255),
    `CARGADO` VARCHAR(255),
    `CUANDO` VARCHAR(255),
    `D_PROM` DATE,
    `C_PROM` VARCHAR(255),
    `N_PROM` DECIMAL,
    `C_CALLE1` VARCHAR(255),
    `C_CALLE2` VARCHAR(255),
    `C_CNP` VARCHAR(255),
    `C_EMAIL` VARCHAR(255),
    `C_NTEL` VARCHAR(255),
    `C_NDIR` VARCHAR(255),
    `C_FREQ` VARCHAR(20),
    `C_CTIPO` VARCHAR(255),
    `C_COWN` VARCHAR(255),
    `C_CSTAT` VARCHAR(255),
    `C_CREJ` VARCHAR(255),
    `C_CPAT` VARCHAR(255),
    `C_ACCION` VARCHAR(255),
    `C_MOTIV` VARCHAR(255),
    `C_CAMP` VARCHAR(20) DEFAULT '0' NOT NULL,
    `D_PROM1` DATE,
    `N_PROM1` DECIMAL,
    `D_PROM2` DATE,
    `N_PROM2` DECIMAL,
    `C_EJE` VARCHAR(255),
    `error` INTEGER DEFAULT 0 NOT NULL,
    PRIMARY KEY (`Auto`),
    INDEX `tel` (`C_TELE`, `C_NTEL`),
    INDEX `status_aarsa` (`C_CVST`),
    INDEX `cliente` (`C_CVBA`),
    INDEX `prom` (`N_PROM`, `D_PROM`),
    INDEX `whowhen` (`C_CONT`, `D_FECH`),
    INDEX `misc` (`C_MSGE`),
    INDEX `gestion` (`C_OBSE1`),
    INDEX `visitador` (`C_VISIT`),
    INDEX `timing` (`D_FECH`, `C_HRIN`, `C_HRFI`),
    INDEX `duplicates` (`C_CONT`, `C_HRIN`, `D_FECH`),
    INDEX `misdup` (`C_CONT`, `C_CVBA`),
    INDEX `ccmatch` (`CUENTA`, `C_CVGE`),
    INDEX `gwhen` (`C_CVGE`, `D_FECH`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- livelines
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `livelines`;

CREATE TABLE `livelines`
(
    `c_tele` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`c_tele`),
    INDEX `new_index` (`c_tele`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- locales
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `locales`;

CREATE TABLE `locales`
(
    `ciudad` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`ciudad`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- motivadores
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `motivadores`;

CREATE TABLE `motivadores`
(
    `motiv` VARCHAR(255) NOT NULL,
    `callcenter` TINYINT(1),
    `visitas` TINYINT(1),
    `judicial` TINYINT(1),
    PRIMARY KEY (`motiv`),
    INDEX `cc` (`callcenter`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- nombres
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `nombres`;

CREATE TABLE `nombres`
(
    `USUARIA` VARCHAR(20) NOT NULL,
    `INICIALES` VARCHAR(20),
    `COMPLETO` VARCHAR(255),
    `TIPO` VARCHAR(255),
    `TICKET` VARCHAR(255),
    `camp` INTEGER DEFAULT 0 NOT NULL,
    `turno` VARCHAR(255),
    `authcode` VARCHAR(6),
    `passw` VARCHAR(50) DEFAULT 'adarc' NOT NULL,
    `policy` TINYINT DEFAULT 0 NOT NULL,
    PRIMARY KEY (`USUARIA`),
    INDEX `c_cvge` (`INICIALES`),
    INDEX `grupo` (`TIPO`),
    INDEX `eje` (`USUARIA`),
    INDEX `ac` (`authcode`),
    INDEX `fullname` (`COMPLETO`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- notas
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `notas`;

CREATE TABLE `notas`
(
    `auto` INTEGER NOT NULL AUTO_INCREMENT,
    `c_cvge` VARCHAR(255) NOT NULL,
    `d_fech` DATE NOT NULL,
    `c_hora` TIME NOT NULL,
    `fecha` DATE,
    `hora` TIME,
    `nota` VARCHAR(255),
    `borrado` TINYINT(1) DEFAULT 0 NOT NULL,
    `cuenta` INTEGER,
    `fuente` VARCHAR(255),
    `c_cont` INTEGER NOT NULL,
    PRIMARY KEY (`auto`),
    INDEX `normdex` (`c_cvge`, `borrado`),
    INDEX `id_cuenta` (`c_cont`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- novis
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `novis`;

CREATE TABLE `novis`
(
    `c_cont` INTEGER DEFAULT 0 NOT NULL,
    PRIMARY KEY (`c_cont`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- pagos
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `pagos`;

CREATE TABLE `pagos`
(
    `auto` INTEGER NOT NULL AUTO_INCREMENT,
    `cuenta` VARCHAR(50) DEFAULT '0' NOT NULL,
    `fecha` DATE DEFAULT '0000-00-00' NOT NULL,
    `monto` DECIMAL DEFAULT 0.00 NOT NULL,
    `cliente` VARCHAR(255) NOT NULL,
    `gestor` VARCHAR(255),
    `confirmado` TINYINT(1) DEFAULT 0 NOT NULL,
    `credito` VARCHAR(50),
    `id_cuenta` INTEGER DEFAULT 0 NOT NULL,
    PRIMARY KEY (`auto`),
    INDEX `numero_cuenta` (`cuenta`),
    INDEX `p_fech` (`fecha`),
    INDEX `cc` (`cuenta`, `cliente`),
    INDEX `cf` (`confirmado`),
    INDEX `c_cont` (`id_cuenta`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- permalog
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `permalog`;

CREATE TABLE `permalog`
(
    `auto` INTEGER NOT NULL AUTO_INCREMENT,
    `usuario` VARCHAR(255) NOT NULL,
    `tipo` VARCHAR(10) NOT NULL,
    `fechahora` DATETIME NOT NULL,
    `gestor` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`auto`),
    INDEX `user` (`usuario`),
    INDEX `c_cvge` (`gestor`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- queuelist
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `queuelist`;

CREATE TABLE `queuelist`
(
    `auto` INTEGER NOT NULL AUTO_INCREMENT,
    `gestor` VARCHAR(255) NOT NULL,
    `cliente` VARCHAR(80) NOT NULL,
    `status_aarsa` VARCHAR(255) DEFAULT '.' NOT NULL,
    `camp` INTEGER DEFAULT 0 NOT NULL,
    `orden1` VARCHAR(255) DEFAULT 'id_cuenta' NOT NULL,
    `updown1` TINYINT(1) DEFAULT 0 NOT NULL,
    `orden2` VARCHAR(255),
    `updown2` TINYINT(1) DEFAULT 0 NOT NULL,
    `orden3` VARCHAR(255),
    `updown3` TINYINT(1) DEFAULT 0 NOT NULL,
    `sdc` VARCHAR(80),
    `bloqueado` TINYINT(1) DEFAULT 0 NOT NULL,
    PRIMARY KEY (`auto`),
    INDEX `queue` (`status_aarsa`),
    INDEX `dups` (`cliente`, `sdc`, `status_aarsa`),
    INDEX `blocks` (`bloqueado`),
    INDEX `csort` (`camp`),
    INDEX `sortby` (`gestor`, `camp`),
    INDEX `sortwho` (`gestor`, `cliente`),
    INDEX `big` (`gestor`, `cliente`, `sdc`, `camp`),
    INDEX `mtch` (`cliente`, `sdc`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- reboot
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `reboot`;

CREATE TABLE `reboot`
(
    `numero_de_cuenta` VARCHAR(255) NOT NULL,
    `ejecutivo_asignado_call_center` VARCHAR(255),
    PRIMARY KEY (`numero_de_cuenta`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- replic
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `replic`;

CREATE TABLE `replic`
(
    `auto` INTEGER NOT NULL,
    PRIMARY KEY (`auto`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- resumen
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `resumen`;

CREATE TABLE `resumen`
(
    `nombre_deudor` VARCHAR(255),
    `domicilio_deudor` VARCHAR(255),
    `colonia_deudor` VARCHAR(255),
    `ciudad_deudor` VARCHAR(255),
    `estado_deudor` VARCHAR(25),
    `cp_deudor` VARCHAR(5),
    `plano_guia_roji` VARCHAR(4),
    `cuadrante_guia_roji` VARCHAR(4),
    `tel_1` VARCHAR(20),
    `tel_2` VARCHAR(20),
    `tel_3` VARCHAR(20),
    `tel_4` VARCHAR(20),
    `nombre_deudor_alterno` VARCHAR(255),
    `domicilio_deudor_alterno` VARCHAR(255),
    `colonia_deudor_alterno` VARCHAR(255),
    `ciudad_deudor_alterno` VARCHAR(255),
    `estado_deudor_alterno` VARCHAR(25),
    `cp_deudor_aterno` VARCHAR(5),
    `tel_1_alterno` VARCHAR(20),
    `tel_2_alterno` VARCHAR(20),
    `tel_3_alterno` VARCHAR(20),
    `tel_4_alterno` VARCHAR(20),
    `plano_guia_roji_alterno` VARCHAR(4),
    `cuadrante_guia_roji_alterno` VARCHAR(4),
    `status_aarsa` VARCHAR(50) DEFAULT '' NOT NULL,
    `avapar` VARCHAR(255),
    `parentesco_ref_1` VARCHAR(255),
    `nombre_referencia_1` VARCHAR(255),
    `domicilio_referencia_1` VARCHAR(255),
    `colonia_referencia_1` VARCHAR(255),
    `ciudad_referencia_1` VARCHAR(255),
    `estado_referencia_1` VARCHAR(25),
    `cp_referencia_1` VARCHAR(5),
    `tel_1_ref_1` VARCHAR(20),
    `tel_2_ref_1` VARCHAR(20),
    `parentesco_ref_2` VARCHAR(255),
    `nombre_referencia_2` VARCHAR(255),
    `domicilio_referencia_2` VARCHAR(255),
    `colonia_referencia_2` VARCHAR(255),
    `ciudad_referencia_2` VARCHAR(255),
    `estado_referencia_2` VARCHAR(25),
    `cp_referencia_2` VARCHAR(5),
    `tel_1_ref_2` VARCHAR(20),
    `tel_2_ref_2` VARCHAR(20),
    `parentesco_ref_3` VARCHAR(255),
    `nombre_referencia_3` VARCHAR(255),
    `domicilio_referencia_3` VARCHAR(255),
    `colonia_referencia_3` VARCHAR(255),
    `ciudad_referencia_3` VARCHAR(255),
    `estado_referencia_3` VARCHAR(25),
    `cp_referencia_3` VARCHAR(5),
    `tel_1_ref_3` VARCHAR(20),
    `tel_2_ref_3` VARCHAR(20),
    `parentesco_ref_4` VARCHAR(255),
    `nombre_referencia_4` VARCHAR(255),
    `domicilio_deudor_2` VARCHAR(255),
    `frecuencia` VARCHAR(255),
    `originacion` VARCHAR(255),
    `sucursal_cliente` VARCHAR(25),
    `cp_referencia_4` VARCHAR(5),
    `tel_1_ref_4` VARCHAR(20),
    `tel_2_ref_4` VARCHAR(20),
    `domicilio_laboral` VARCHAR(255),
    `colonia_laboral` VARCHAR(255),
    `ciudad_laboral` VARCHAR(255),
    `estado_laboral` VARCHAR(25),
    `cp_laboral` VARCHAR(5),
    `tel_1_laboral` VARCHAR(20),
    `tel_2_laboral` VARCHAR(20),
    `saldo_corriente` DECIMAL,
    `fecha_de_actualizacion` DATE,
    `numero_de_cuenta` VARCHAR(255) DEFAULT '0' NOT NULL,
    `numero_de_credito` VARCHAR(255),
    `contrato` VARCHAR(255),
    `saldo_total` DECIMAL DEFAULT 0.00 NOT NULL,
    `saldo_vencido` DECIMAL DEFAULT 0.00 NOT NULL,
    `saldo_descuento_1` DECIMAL DEFAULT 0.00 NOT NULL,
    `saldo_descuento_2` DECIMAL DEFAULT 0.00 NOT NULL,
    `fecha_corte` DATE,
    `fecha_limite` DATE,
    `fecha_de_ultimo_pago` DATE,
    `monto_ultimo_pago` DECIMAL DEFAULT 0.00 NOT NULL,
    `producto` VARCHAR(255),
    `subproducto` VARCHAR(255),
    `cliente` VARCHAR(255),
    `status_de_credito` VARCHAR(50) DEFAULT '',
    `pagos_vencidos` INTEGER,
    `monto_adeudado` DECIMAL DEFAULT 0.00 NOT NULL,
    `fecha_de_asignacion` DATE,
    `fecha_de_deasignacion` DATE,
    `cuenta_concentradora_1` VARCHAR(25),
    `saldo_cuota` DECIMAL,
    `email_deudor` VARCHAR(255),
    `id_cuenta` INTEGER NOT NULL AUTO_INCREMENT,
    `nss` VARCHAR(11),
    `rfc_deudor` VARCHAR(255),
    `telefonos_marcados` VARCHAR(20),
    `tel_1_verif` VARCHAR(20),
    `tel_2_verif` VARCHAR(20),
    `tel_3_verif` VARCHAR(20),
    `tel_4_verif` VARCHAR(20),
    `telefono_de_ultimo_contacto` VARCHAR(20),
    `dias_vencidos` INTEGER DEFAULT 0,
    `ejecutivo_asignado_call_center` VARCHAR(255) DEFAULT 'sinasig' NOT NULL,
    `ejecutivo_asignado_domiciliario` VARCHAR(255),
    `prioridad_de_gestion` INTEGER,
    `nrpp` VARCHAR(11),
    `parentesco_aval` VARCHAR(255),
    `localizar` TINYINT(1),
    `fecha_ultima_gestion` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `empresa` VARCHAR(255),
    `timelock` DATETIME,
    `locker` VARCHAR(255),
    `fecha_convenio` DATE,
    `especial` TINYINT(1) DEFAULT 0 NOT NULL,
    `direccion_nueva` VARCHAR(255),
    `norobot` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`id_cuenta`),
    UNIQUE INDEX `ccred` (`cliente`, `numero_de_cuenta`),
    INDEX `capturista` (`ejecutivo_asignado_call_center`),
    INDEX `nombre` (`nombre_deudor`),
    INDEX `locking` (`locker`, `timelock`),
    INDEX `tels` (`tel_1`, `tel_2`, `tel_1_verif`, `tel_2_verif`),
    INDEX `actualizado` (`tel_1_verif`),
    INDEX `codpost` (`cp_deudor`),
    INDEX `direccion` (`colonia_deudor`, `ciudad_deudor`, `estado_deudor`, `cp_deudor`),
    INDEX `cuenta` (`numero_de_cuenta`),
    INDEX `fecha` (`fecha_ultima_gestion`),
    INDEX `queuesort` (`status_aarsa`),
    INDEX `ql` (`ejecutivo_asignado_call_center`, `cliente`, `status_de_credito`),
    INDEX `prod` (`producto`, `subproducto`),
    INDEX `statussort` (`status_de_credito`),
    INDEX `tops` (`ejecutivo_asignado_call_center`, `saldo_total`),
    INDEX `queuesg` (`status_de_credito`, `ejecutivo_asignado_call_center`, `cliente`, `status_aarsa`),
    INDEX `icl` (`id_cuenta`, `cliente`),
    INDEX `actual` (`fecha_de_actualizacion`),
    INDEX `defaultSort` (`status_de_credito`, `fecha_ultima_gestion`, `saldo_total`),
    INDEX `saldo` (`saldo_total`),
    INDEX `robot` (`norobot`),
    INDEX `cligest` (`cliente`, `status_de_credito`, `status_aarsa`),
    INDEX `defaultsort2` (`cliente`, `fecha_de_actualizacion`),
    INDEX `idtel` (`id_cuenta`, `tel_1`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- retirar
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `retirar`;

CREATE TABLE `retirar`
(
    `cta` INTEGER NOT NULL,
    PRIMARY KEY (`cta`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- rlook
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `rlook`;

CREATE TABLE `rlook`
(
    `id_cuenta` INTEGER DEFAULT 0 NOT NULL,
    `numero_de_cuenta` VARCHAR(255) DEFAULT '0' NOT NULL,
    `nombre_deudor` VARCHAR(255),
    `cliente` VARCHAR(255),
    `status_de_credito` VARCHAR(50),
    `nombre_referencia_1` VARCHAR(255),
    `nombre_referencia_2` VARCHAR(255),
    `nombre_referencia_3` VARCHAR(255),
    `nombre_referencia_4` VARCHAR(255),
    `tel_1` VARCHAR(20),
    `tel_2` VARCHAR(20),
    `tel_3` VARCHAR(20),
    `tel_4` VARCHAR(20),
    `tel_1_alterno` VARCHAR(20),
    `tel_2_alterno` VARCHAR(20),
    `tel_3_alterno` VARCHAR(20),
    `tel_4_alterno` VARCHAR(20),
    `tel_1_verif` VARCHAR(20),
    `tel_2_verif` VARCHAR(20),
    `tel_3_verif` VARCHAR(20),
    `tel_4_verif` VARCHAR(20),
    `tel_1_ref_1` VARCHAR(20),
    `tel_2_ref_1` VARCHAR(20),
    `tel_1_ref_2` VARCHAR(20),
    `tel_2_ref_2` VARCHAR(20),
    `tel_1_ref_3` VARCHAR(20),
    `tel_2_ref_3` VARCHAR(20),
    `tel_1_ref_4` VARCHAR(20),
    `tel_2_ref_4` VARCHAR(20),
    `tel_1_laboral` VARCHAR(20),
    `tel_2_laboral` VARCHAR(20),
    `telefonos_marcados` VARCHAR(20),
    PRIMARY KEY (`id_cuenta`),
    INDEX `cuenta` (`numero_de_cuenta`),
    INDEX `id` (`id_cuenta`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- rslice
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `rslice`;

CREATE TABLE `rslice`
(
    `nombre_deudor` VARCHAR(255),
    `domicilio_deudor` VARCHAR(255),
    `colonia_deudor` VARCHAR(255),
    `ciudad_deudor` VARCHAR(255),
    `estado_deudor` VARCHAR(25),
    `cp_deudor` VARCHAR(5),
    `plano_guia_roji` VARCHAR(4),
    `cuadrante_guia_roji` VARCHAR(4),
    `tel_1` VARCHAR(20),
    `tel_2` VARCHAR(20),
    `tel_3` VARCHAR(20),
    `tel_4` VARCHAR(20),
    `nombre_deudor_alterno` VARCHAR(255),
    `domicilio_deudor_alterno` VARCHAR(255),
    `colonia_deudor_alterno` VARCHAR(255),
    `ciudad_deudor_alterno` VARCHAR(255),
    `estado_deudor_alterno` VARCHAR(25),
    `cp_deudor_aterno` VARCHAR(5),
    `tel_1_alterno` VARCHAR(20),
    `tel_2_alterno` VARCHAR(20),
    `tel_3_alterno` VARCHAR(20),
    `tel_4_alterno` VARCHAR(20),
    `plano_guia_roji_alterno` VARCHAR(4),
    `cuadrante_guia_roji_alterno` VARCHAR(4),
    `status_aarsa` VARCHAR(50) DEFAULT '' NOT NULL,
    `sucursal_cliente` VARCHAR(255),
    `parentesco_ref_1` VARCHAR(255),
    `nombre_referencia_1` VARCHAR(255),
    `domicilio_referencia_1` VARCHAR(255),
    `colonia_referencia_1` VARCHAR(255),
    `ciudad_referencia_1` VARCHAR(255),
    `estado_referencia_1` VARCHAR(25),
    `cp_referencia_1` VARCHAR(5),
    `tel_1_ref_1` VARCHAR(20),
    `tel_2_ref_1` VARCHAR(20),
    `parentesco_ref_2` VARCHAR(255),
    `nombre_referencia_2` VARCHAR(255),
    `domicilio_referencia_2` VARCHAR(255),
    `colonia_referencia_2` VARCHAR(255),
    `ciudad_referencia_2` VARCHAR(255),
    `estado_referencia_2` VARCHAR(25),
    `cp_referencia_2` VARCHAR(5),
    `tel_1_ref_2` VARCHAR(20),
    `tel_2_ref_2` VARCHAR(20),
    `parentesco_ref_3` VARCHAR(255),
    `nombre_referencia_3` VARCHAR(255),
    `domicilio_referencia_3` VARCHAR(255),
    `colonia_referencia_3` VARCHAR(255),
    `ciudad_referencia_3` VARCHAR(255),
    `estado_referencia_3` VARCHAR(25),
    `cp_referencia_3` VARCHAR(5),
    `tel_1_ref_3` VARCHAR(20),
    `tel_2_ref_3` VARCHAR(20),
    `parentesco_ref_4` VARCHAR(255),
    `nombre_referencia_4` VARCHAR(255),
    `domicilio_referencia_4` VARCHAR(255),
    `colonia_referencia_4` VARCHAR(255),
    `ciudad_referencia_4` VARCHAR(255),
    `estado_referencia_4` VARCHAR(25),
    `cp_referencia_4` VARCHAR(5),
    `tel_1_ref_4` VARCHAR(20),
    `tel_2_ref_4` VARCHAR(20),
    `domicilio_laboral` VARCHAR(255),
    `colonia_laboral` VARCHAR(255),
    `ciudad_laboral` VARCHAR(255),
    `estado_laboral` VARCHAR(25),
    `cp_laboral` VARCHAR(5),
    `tel_1_laboral` VARCHAR(20),
    `tel_2_laboral` VARCHAR(20),
    `saldo_corriente` DECIMAL,
    `fecha_de_actualizacion` DATE,
    `numero_de_cuenta` VARCHAR(255) DEFAULT '0' NOT NULL,
    `numero_de_credito` VARCHAR(255),
    `contrato` VARCHAR(255),
    `saldo_total` DECIMAL DEFAULT 0.00 NOT NULL,
    `saldo_vencido` DECIMAL DEFAULT 0.00 NOT NULL,
    `saldo_descuento_1` DECIMAL DEFAULT 0.00 NOT NULL,
    `saldo_descuento_2` DECIMAL DEFAULT 0.00 NOT NULL,
    `fecha_corte` DATE,
    `fecha_limite` DATE,
    `fecha_de_ultimo_pago` DATE,
    `monto_ultimo_pago` DECIMAL DEFAULT 0.00 NOT NULL,
    `producto` VARCHAR(255),
    `subproducto` VARCHAR(255),
    `cliente` VARCHAR(255),
    `status_de_credito` VARCHAR(50),
    `pagos_vencidos` INTEGER,
    `monto_adeudado` DECIMAL DEFAULT 0.00 NOT NULL,
    `fecha_de_asignacion` DATE,
    `fecha_de_deasignacion` DATE,
    `cuenta_concentradora_1` VARCHAR(25),
    `saldo_cuota` DECIMAL,
    `email_deudor` VARCHAR(255),
    `id_cuenta` INTEGER NOT NULL AUTO_INCREMENT,
    `pago_pactado` VARCHAR(255),
    `rfc_deudor` VARCHAR(255),
    `telefonos_marcados` VARCHAR(20),
    `tel_1_verif` VARCHAR(20),
    `tel_2_verif` VARCHAR(20),
    `tel_3_verif` VARCHAR(20),
    `tel_4_verif` VARCHAR(20),
    `telefono_de_ultimo_contacto` VARCHAR(20),
    `dias_vencidos` INTEGER DEFAULT 0,
    `ejecutivo_asignado_call_center` VARCHAR(255) DEFAULT 'sinasig' NOT NULL,
    `ejecutivo_asignado_domiciliario` VARCHAR(255),
    `prioridad_de_gestion` INTEGER,
    `region_aarsa` VARCHAR(255),
    `parentesco_aval` VARCHAR(255),
    `localizar` TINYINT(1),
    `fecha_ultima_gestion` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `empresa` VARCHAR(255),
    `timelock` DATETIME,
    `locker` VARCHAR(255),
    `fecha_de_venta` DATE,
    `especial` TINYINT(1) DEFAULT 0 NOT NULL,
    `direccion_nueva` VARCHAR(255),
    `norobot` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `user` VARCHAR(50) NOT NULL,
    `timeuser` DATETIME,
    PRIMARY KEY (`id_cuenta`),
    INDEX `capturista` (`ejecutivo_asignado_call_center`),
    INDEX `nombre` (`nombre_deudor`),
    INDEX `locking` (`locker`, `timelock`),
    INDEX `tels` (`tel_1`, `tel_2`, `tel_1_verif`, `tel_2_verif`),
    INDEX `actualizado` (`tel_1_verif`),
    INDEX `codpost` (`cp_deudor`),
    INDEX `direccion` (`colonia_deudor`, `ciudad_deudor`, `estado_deudor`, `cp_deudor`),
    INDEX `cuenta` (`numero_de_cuenta`),
    INDEX `fecha` (`fecha_ultima_gestion`),
    INDEX `queuesort` (`status_aarsa`),
    INDEX `defaultsort2` (`cliente`, `ejecutivo_asignado_call_center`),
    INDEX `ql` (`ejecutivo_asignado_call_center`, `cliente`, `status_de_credito`),
    INDEX `prod` (`producto`, `subproducto`),
    INDEX `statussort` (`status_de_credito`),
    INDEX `tops` (`ejecutivo_asignado_call_center`, `saldo_total`),
    INDEX `queuesg` (`status_de_credito`, `ejecutivo_asignado_call_center`, `cliente`, `status_aarsa`),
    INDEX `ccred` (`cliente`, `numero_de_cuenta`, `numero_de_credito`),
    INDEX `icl` (`id_cuenta`, `cliente`),
    INDEX `actual` (`fecha_de_actualizacion`),
    INDEX `defaultSort` (`status_de_credito`, `fecha_ultima_gestion`, `saldo_total`),
    INDEX `saldo` (`saldo_total`),
    INDEX `robot` (`norobot`),
    INDEX `cligest` (`cliente`, `status_de_credito`, `status_aarsa`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- sdc
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sdc`;

CREATE TABLE `sdc`
(
    `cta` INTEGER NOT NULL,
    `sdc` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`cta`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- sdcs
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sdcs`;

CREATE TABLE `sdcs`
(
    `status_de_credito` VARCHAR(50) DEFAULT '' NOT NULL,
    PRIMARY KEY (`status_de_credito`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- sdhextras
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sdhextras`;

CREATE TABLE `sdhextras`
(
    `cuenta` VARCHAR(10) NOT NULL,
    `productos` VARCHAR(255) DEFAULT '' NOT NULL,
    `st` DECIMAL DEFAULT 0.00 NOT NULL,
    `sv` DECIMAL DEFAULT 0.00 NOT NULL,
    `sd` DECIMAL DEFAULT 0.00 NOT NULL,
    `period` VARCHAR(10) DEFAULT '' NOT NULL,
    `monto` DECIMAL DEFAULT 0.00 NOT NULL,
    `sdd` DECIMAL DEFAULT 0.00 NOT NULL,
    `subcuenta` VARCHAR(45) DEFAULT '0' NOT NULL,
    `gc` DECIMAL DEFAULT 0.00 NOT NULL,
    `xmora` INTEGER DEFAULT 0 NOT NULL,
    `grupo` INTEGER DEFAULT 0 NOT NULL,
    `liquid` INTEGER DEFAULT 0 NOT NULL,
    `auto` INTEGER NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (`auto`),
    INDEX `cta` (`cuenta`, `subcuenta`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- sdhmerc
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sdhmerc`;

CREATE TABLE `sdhmerc`
(
    `auto` INTEGER NOT NULL AUTO_INCREMENT,
    `id_cuenta` INTEGER NOT NULL,
    `merc` VARCHAR(255) NOT NULL,
    `fechamerc` DATE NOT NULL,
    `fechacapt` DATETIME NOT NULL,
    PRIMARY KEY (`auto`),
    INDEX `c_cont` (`id_cuenta`),
    INDEX `dcapt` (`fechacapt`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- shortzips
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shortzips`;

CREATE TABLE `shortzips`
(
    `estado_deudor` VARCHAR(25),
    `ciudad_deudor` VARCHAR(255),
    `cp_deudor` VARCHAR(5),
    `auto` INTEGER NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (`auto`),
    INDEX `dups` (`estado_deudor`, `ciudad_deudor`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- specdate
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `specdate`;

CREATE TABLE `specdate`
(
    `c_cont` INTEGER DEFAULT 0 NOT NULL,
    `mdf` DATE,
    PRIMARY KEY (`c_cont`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- stj
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `stj`;

CREATE TABLE `stj`
(
    `cuenta` INTEGER NOT NULL,
    `status` VARCHAR(20) NOT NULL,
    PRIMARY KEY (`cuenta`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- trouble
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `trouble`;

CREATE TABLE `trouble`
(
    `auto` INTEGER NOT NULL AUTO_INCREMENT,
    `fechahora` DATETIME NOT NULL,
    `sistema` VARCHAR(15) NOT NULL,
    `usuario` VARCHAR(255),
    `fuente` VARCHAR(255),
    `descripcion` VARCHAR(255),
    `error_msg` VARCHAR(255),
    `fechacomp` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `it_guy` VARCHAR(255),
    `reparacion` VARCHAR(255),
    PRIMARY KEY (`auto`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- uninames
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `uninames`;

CREATE TABLE `uninames`
(
    `nombre_deudor` VARCHAR(255) DEFAULT '' NOT NULL,
    PRIMARY KEY (`nombre_deudor`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- userlog
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `userlog`;

CREATE TABLE `userlog`
(
    `auto` INTEGER NOT NULL AUTO_INCREMENT,
    `usuario` VARCHAR(255) NOT NULL,
    `tipo` VARCHAR(10) NOT NULL,
    `fechahora` DATETIME NOT NULL,
    `gestor` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`auto`),
    INDEX `user` (`usuario`),
    INDEX `c_cvge` (`gestor`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- vasign
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `vasign`;

CREATE TABLE `vasign`
(
    `auto` INTEGER NOT NULL AUTO_INCREMENT,
    `cuenta` VARCHAR(255) NOT NULL,
    `gestor` VARCHAR(255) NOT NULL,
    `fechaout` DATETIME NOT NULL,
    `fechain` DATETIME,
    `c_cont` INTEGER NOT NULL,
    PRIMARY KEY (`auto`),
    INDEX `cta` (`cuenta`),
    INDEX `fechas` (`fechaout`, `fechain`),
    INDEX `reverse` (`fechain`, `fechaout`),
    INDEX `visitador` (`gestor`),
    INDEX `bigsort` (`cuenta`, `fechaout`),
    INDEX `cc` (`c_cont`),
    INDEX `dups2` (`c_cont`, `gestor`),
    INDEX `dups` (`c_cont`, `gestor`, `fechaout`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- visitados
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `visitados`;

CREATE TABLE `visitados`
(
    `cta` INTEGER NOT NULL,
    PRIMARY KEY (`cta`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- zips
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `zips`;

CREATE TABLE `zips`
(
    `estado_deudor` VARCHAR(25),
    `ciudad_deudor` VARCHAR(255),
    `colonia_deudor` VARCHAR(255),
    `cp_deudor` VARCHAR(5),
    `auto` INTEGER NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (`auto`),
    INDEX `dups` (`estado_deudor`, `ciudad_deudor`, `colonia_deudor`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
