<?php


/**
 * Base static class for performing query and update operations on the 'rlook' table.
 *
 *
 *
 * @package propel.generator.cobra.om
 */
abstract class BaseRlookPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'cobra';

    /** the table name for this class */
    const TABLE_NAME = 'rlook';

    /** the related Propel class for this table */
    const OM_CLASS = 'Rlook';

    /** the related TableMap class for this table */
    const TM_CLASS = 'RlookTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 32;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 32;

    /** the column name for the id_cuenta field */
    const ID_CUENTA = 'rlook.id_cuenta';

    /** the column name for the numero_de_cuenta field */
    const NUMERO_DE_CUENTA = 'rlook.numero_de_cuenta';

    /** the column name for the nombre_deudor field */
    const NOMBRE_DEUDOR = 'rlook.nombre_deudor';

    /** the column name for the cliente field */
    const CLIENTE = 'rlook.cliente';

    /** the column name for the status_de_credito field */
    const STATUS_DE_CREDITO = 'rlook.status_de_credito';

    /** the column name for the nombre_referencia_1 field */
    const NOMBRE_REFERENCIA_1 = 'rlook.nombre_referencia_1';

    /** the column name for the nombre_referencia_2 field */
    const NOMBRE_REFERENCIA_2 = 'rlook.nombre_referencia_2';

    /** the column name for the nombre_referencia_3 field */
    const NOMBRE_REFERENCIA_3 = 'rlook.nombre_referencia_3';

    /** the column name for the nombre_referencia_4 field */
    const NOMBRE_REFERENCIA_4 = 'rlook.nombre_referencia_4';

    /** the column name for the tel_1 field */
    const TEL_1 = 'rlook.tel_1';

    /** the column name for the tel_2 field */
    const TEL_2 = 'rlook.tel_2';

    /** the column name for the tel_3 field */
    const TEL_3 = 'rlook.tel_3';

    /** the column name for the tel_4 field */
    const TEL_4 = 'rlook.tel_4';

    /** the column name for the tel_1_alterno field */
    const TEL_1_ALTERNO = 'rlook.tel_1_alterno';

    /** the column name for the tel_2_alterno field */
    const TEL_2_ALTERNO = 'rlook.tel_2_alterno';

    /** the column name for the tel_3_alterno field */
    const TEL_3_ALTERNO = 'rlook.tel_3_alterno';

    /** the column name for the tel_4_alterno field */
    const TEL_4_ALTERNO = 'rlook.tel_4_alterno';

    /** the column name for the tel_1_verif field */
    const TEL_1_VERIF = 'rlook.tel_1_verif';

    /** the column name for the tel_2_verif field */
    const TEL_2_VERIF = 'rlook.tel_2_verif';

    /** the column name for the tel_3_verif field */
    const TEL_3_VERIF = 'rlook.tel_3_verif';

    /** the column name for the tel_4_verif field */
    const TEL_4_VERIF = 'rlook.tel_4_verif';

    /** the column name for the tel_1_ref_1 field */
    const TEL_1_REF_1 = 'rlook.tel_1_ref_1';

    /** the column name for the tel_2_ref_1 field */
    const TEL_2_REF_1 = 'rlook.tel_2_ref_1';

    /** the column name for the tel_1_ref_2 field */
    const TEL_1_REF_2 = 'rlook.tel_1_ref_2';

    /** the column name for the tel_2_ref_2 field */
    const TEL_2_REF_2 = 'rlook.tel_2_ref_2';

    /** the column name for the tel_1_ref_3 field */
    const TEL_1_REF_3 = 'rlook.tel_1_ref_3';

    /** the column name for the tel_2_ref_3 field */
    const TEL_2_REF_3 = 'rlook.tel_2_ref_3';

    /** the column name for the tel_1_ref_4 field */
    const TEL_1_REF_4 = 'rlook.tel_1_ref_4';

    /** the column name for the tel_2_ref_4 field */
    const TEL_2_REF_4 = 'rlook.tel_2_ref_4';

    /** the column name for the tel_1_laboral field */
    const TEL_1_LABORAL = 'rlook.tel_1_laboral';

    /** the column name for the tel_2_laboral field */
    const TEL_2_LABORAL = 'rlook.tel_2_laboral';

    /** the column name for the telefonos_marcados field */
    const TELEFONOS_MARCADOS = 'rlook.telefonos_marcados';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of Rlook objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array Rlook[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. RlookPeer::$fieldNames[RlookPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('IdCuenta', 'NumeroDeCuenta', 'NombreDeudor', 'Cliente', 'StatusDeCredito', 'NombreReferencia1', 'NombreReferencia2', 'NombreReferencia3', 'NombreReferencia4', 'Tel1', 'Tel2', 'Tel3', 'Tel4', 'Tel1Alterno', 'Tel2Alterno', 'Tel3Alterno', 'Tel4Alterno', 'Tel1Verif', 'Tel2Verif', 'Tel3Verif', 'Tel4Verif', 'Tel1Ref1', 'Tel2Ref1', 'Tel1Ref2', 'Tel2Ref2', 'Tel1Ref3', 'Tel2Ref3', 'Tel1Ref4', 'Tel2Ref4', 'Tel1Laboral', 'Tel2Laboral', 'TelefonosMarcados', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('idCuenta', 'numeroDeCuenta', 'nombreDeudor', 'cliente', 'statusDeCredito', 'nombreReferencia1', 'nombreReferencia2', 'nombreReferencia3', 'nombreReferencia4', 'tel1', 'tel2', 'tel3', 'tel4', 'tel1Alterno', 'tel2Alterno', 'tel3Alterno', 'tel4Alterno', 'tel1Verif', 'tel2Verif', 'tel3Verif', 'tel4Verif', 'tel1Ref1', 'tel2Ref1', 'tel1Ref2', 'tel2Ref2', 'tel1Ref3', 'tel2Ref3', 'tel1Ref4', 'tel2Ref4', 'tel1Laboral', 'tel2Laboral', 'telefonosMarcados', ),
        BasePeer::TYPE_COLNAME => array (RlookPeer::ID_CUENTA, RlookPeer::NUMERO_DE_CUENTA, RlookPeer::NOMBRE_DEUDOR, RlookPeer::CLIENTE, RlookPeer::STATUS_DE_CREDITO, RlookPeer::NOMBRE_REFERENCIA_1, RlookPeer::NOMBRE_REFERENCIA_2, RlookPeer::NOMBRE_REFERENCIA_3, RlookPeer::NOMBRE_REFERENCIA_4, RlookPeer::TEL_1, RlookPeer::TEL_2, RlookPeer::TEL_3, RlookPeer::TEL_4, RlookPeer::TEL_1_ALTERNO, RlookPeer::TEL_2_ALTERNO, RlookPeer::TEL_3_ALTERNO, RlookPeer::TEL_4_ALTERNO, RlookPeer::TEL_1_VERIF, RlookPeer::TEL_2_VERIF, RlookPeer::TEL_3_VERIF, RlookPeer::TEL_4_VERIF, RlookPeer::TEL_1_REF_1, RlookPeer::TEL_2_REF_1, RlookPeer::TEL_1_REF_2, RlookPeer::TEL_2_REF_2, RlookPeer::TEL_1_REF_3, RlookPeer::TEL_2_REF_3, RlookPeer::TEL_1_REF_4, RlookPeer::TEL_2_REF_4, RlookPeer::TEL_1_LABORAL, RlookPeer::TEL_2_LABORAL, RlookPeer::TELEFONOS_MARCADOS, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID_CUENTA', 'NUMERO_DE_CUENTA', 'NOMBRE_DEUDOR', 'CLIENTE', 'STATUS_DE_CREDITO', 'NOMBRE_REFERENCIA_1', 'NOMBRE_REFERENCIA_2', 'NOMBRE_REFERENCIA_3', 'NOMBRE_REFERENCIA_4', 'TEL_1', 'TEL_2', 'TEL_3', 'TEL_4', 'TEL_1_ALTERNO', 'TEL_2_ALTERNO', 'TEL_3_ALTERNO', 'TEL_4_ALTERNO', 'TEL_1_VERIF', 'TEL_2_VERIF', 'TEL_3_VERIF', 'TEL_4_VERIF', 'TEL_1_REF_1', 'TEL_2_REF_1', 'TEL_1_REF_2', 'TEL_2_REF_2', 'TEL_1_REF_3', 'TEL_2_REF_3', 'TEL_1_REF_4', 'TEL_2_REF_4', 'TEL_1_LABORAL', 'TEL_2_LABORAL', 'TELEFONOS_MARCADOS', ),
        BasePeer::TYPE_FIELDNAME => array ('id_cuenta', 'numero_de_cuenta', 'nombre_deudor', 'cliente', 'status_de_credito', 'nombre_referencia_1', 'nombre_referencia_2', 'nombre_referencia_3', 'nombre_referencia_4', 'tel_1', 'tel_2', 'tel_3', 'tel_4', 'tel_1_alterno', 'tel_2_alterno', 'tel_3_alterno', 'tel_4_alterno', 'tel_1_verif', 'tel_2_verif', 'tel_3_verif', 'tel_4_verif', 'tel_1_ref_1', 'tel_2_ref_1', 'tel_1_ref_2', 'tel_2_ref_2', 'tel_1_ref_3', 'tel_2_ref_3', 'tel_1_ref_4', 'tel_2_ref_4', 'tel_1_laboral', 'tel_2_laboral', 'telefonos_marcados', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. RlookPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('IdCuenta' => 0, 'NumeroDeCuenta' => 1, 'NombreDeudor' => 2, 'Cliente' => 3, 'StatusDeCredito' => 4, 'NombreReferencia1' => 5, 'NombreReferencia2' => 6, 'NombreReferencia3' => 7, 'NombreReferencia4' => 8, 'Tel1' => 9, 'Tel2' => 10, 'Tel3' => 11, 'Tel4' => 12, 'Tel1Alterno' => 13, 'Tel2Alterno' => 14, 'Tel3Alterno' => 15, 'Tel4Alterno' => 16, 'Tel1Verif' => 17, 'Tel2Verif' => 18, 'Tel3Verif' => 19, 'Tel4Verif' => 20, 'Tel1Ref1' => 21, 'Tel2Ref1' => 22, 'Tel1Ref2' => 23, 'Tel2Ref2' => 24, 'Tel1Ref3' => 25, 'Tel2Ref3' => 26, 'Tel1Ref4' => 27, 'Tel2Ref4' => 28, 'Tel1Laboral' => 29, 'Tel2Laboral' => 30, 'TelefonosMarcados' => 31, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('idCuenta' => 0, 'numeroDeCuenta' => 1, 'nombreDeudor' => 2, 'cliente' => 3, 'statusDeCredito' => 4, 'nombreReferencia1' => 5, 'nombreReferencia2' => 6, 'nombreReferencia3' => 7, 'nombreReferencia4' => 8, 'tel1' => 9, 'tel2' => 10, 'tel3' => 11, 'tel4' => 12, 'tel1Alterno' => 13, 'tel2Alterno' => 14, 'tel3Alterno' => 15, 'tel4Alterno' => 16, 'tel1Verif' => 17, 'tel2Verif' => 18, 'tel3Verif' => 19, 'tel4Verif' => 20, 'tel1Ref1' => 21, 'tel2Ref1' => 22, 'tel1Ref2' => 23, 'tel2Ref2' => 24, 'tel1Ref3' => 25, 'tel2Ref3' => 26, 'tel1Ref4' => 27, 'tel2Ref4' => 28, 'tel1Laboral' => 29, 'tel2Laboral' => 30, 'telefonosMarcados' => 31, ),
        BasePeer::TYPE_COLNAME => array (RlookPeer::ID_CUENTA => 0, RlookPeer::NUMERO_DE_CUENTA => 1, RlookPeer::NOMBRE_DEUDOR => 2, RlookPeer::CLIENTE => 3, RlookPeer::STATUS_DE_CREDITO => 4, RlookPeer::NOMBRE_REFERENCIA_1 => 5, RlookPeer::NOMBRE_REFERENCIA_2 => 6, RlookPeer::NOMBRE_REFERENCIA_3 => 7, RlookPeer::NOMBRE_REFERENCIA_4 => 8, RlookPeer::TEL_1 => 9, RlookPeer::TEL_2 => 10, RlookPeer::TEL_3 => 11, RlookPeer::TEL_4 => 12, RlookPeer::TEL_1_ALTERNO => 13, RlookPeer::TEL_2_ALTERNO => 14, RlookPeer::TEL_3_ALTERNO => 15, RlookPeer::TEL_4_ALTERNO => 16, RlookPeer::TEL_1_VERIF => 17, RlookPeer::TEL_2_VERIF => 18, RlookPeer::TEL_3_VERIF => 19, RlookPeer::TEL_4_VERIF => 20, RlookPeer::TEL_1_REF_1 => 21, RlookPeer::TEL_2_REF_1 => 22, RlookPeer::TEL_1_REF_2 => 23, RlookPeer::TEL_2_REF_2 => 24, RlookPeer::TEL_1_REF_3 => 25, RlookPeer::TEL_2_REF_3 => 26, RlookPeer::TEL_1_REF_4 => 27, RlookPeer::TEL_2_REF_4 => 28, RlookPeer::TEL_1_LABORAL => 29, RlookPeer::TEL_2_LABORAL => 30, RlookPeer::TELEFONOS_MARCADOS => 31, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID_CUENTA' => 0, 'NUMERO_DE_CUENTA' => 1, 'NOMBRE_DEUDOR' => 2, 'CLIENTE' => 3, 'STATUS_DE_CREDITO' => 4, 'NOMBRE_REFERENCIA_1' => 5, 'NOMBRE_REFERENCIA_2' => 6, 'NOMBRE_REFERENCIA_3' => 7, 'NOMBRE_REFERENCIA_4' => 8, 'TEL_1' => 9, 'TEL_2' => 10, 'TEL_3' => 11, 'TEL_4' => 12, 'TEL_1_ALTERNO' => 13, 'TEL_2_ALTERNO' => 14, 'TEL_3_ALTERNO' => 15, 'TEL_4_ALTERNO' => 16, 'TEL_1_VERIF' => 17, 'TEL_2_VERIF' => 18, 'TEL_3_VERIF' => 19, 'TEL_4_VERIF' => 20, 'TEL_1_REF_1' => 21, 'TEL_2_REF_1' => 22, 'TEL_1_REF_2' => 23, 'TEL_2_REF_2' => 24, 'TEL_1_REF_3' => 25, 'TEL_2_REF_3' => 26, 'TEL_1_REF_4' => 27, 'TEL_2_REF_4' => 28, 'TEL_1_LABORAL' => 29, 'TEL_2_LABORAL' => 30, 'TELEFONOS_MARCADOS' => 31, ),
        BasePeer::TYPE_FIELDNAME => array ('id_cuenta' => 0, 'numero_de_cuenta' => 1, 'nombre_deudor' => 2, 'cliente' => 3, 'status_de_credito' => 4, 'nombre_referencia_1' => 5, 'nombre_referencia_2' => 6, 'nombre_referencia_3' => 7, 'nombre_referencia_4' => 8, 'tel_1' => 9, 'tel_2' => 10, 'tel_3' => 11, 'tel_4' => 12, 'tel_1_alterno' => 13, 'tel_2_alterno' => 14, 'tel_3_alterno' => 15, 'tel_4_alterno' => 16, 'tel_1_verif' => 17, 'tel_2_verif' => 18, 'tel_3_verif' => 19, 'tel_4_verif' => 20, 'tel_1_ref_1' => 21, 'tel_2_ref_1' => 22, 'tel_1_ref_2' => 23, 'tel_2_ref_2' => 24, 'tel_1_ref_3' => 25, 'tel_2_ref_3' => 26, 'tel_1_ref_4' => 27, 'tel_2_ref_4' => 28, 'tel_1_laboral' => 29, 'tel_2_laboral' => 30, 'telefonos_marcados' => 31, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, )
    );

    /**
     * Translates a fieldname to another type
     *
     * @param      string $name field name
     * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @param      string $toType   One of the class type constants
     * @return string          translated name of the field.
     * @throws PropelException - if the specified name could not be found in the fieldname mappings.
     */
    public static function translateFieldName($name, $fromType, $toType)
    {
        $toNames = RlookPeer::getFieldNames($toType);
        $key = isset(RlookPeer::$fieldKeys[$fromType][$name]) ? RlookPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(RlookPeer::$fieldKeys[$fromType], true));
        }

        return $toNames[$key];
    }

    /**
     * Returns an array of field names.
     *
     * @param      string $type The type of fieldnames to return:
     *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @return array           A list of field names
     * @throws PropelException - if the type is not valid.
     */
    public static function getFieldNames($type = BasePeer::TYPE_PHPNAME)
    {
        if (!array_key_exists($type, RlookPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return RlookPeer::$fieldNames[$type];
    }

    /**
     * Convenience method which changes table.column to alias.column.
     *
     * Using this method you can maintain SQL abstraction while using column aliases.
     * <code>
     *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
     *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
     * </code>
     * @param      string $alias The alias for the current table.
     * @param      string $column The column name for current table. (i.e. RlookPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(RlookPeer::TABLE_NAME.'.', $alias.'.', $column);
    }

    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param      Criteria $criteria object containing the columns to add.
     * @param      string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(RlookPeer::ID_CUENTA);
            $criteria->addSelectColumn(RlookPeer::NUMERO_DE_CUENTA);
            $criteria->addSelectColumn(RlookPeer::NOMBRE_DEUDOR);
            $criteria->addSelectColumn(RlookPeer::CLIENTE);
            $criteria->addSelectColumn(RlookPeer::STATUS_DE_CREDITO);
            $criteria->addSelectColumn(RlookPeer::NOMBRE_REFERENCIA_1);
            $criteria->addSelectColumn(RlookPeer::NOMBRE_REFERENCIA_2);
            $criteria->addSelectColumn(RlookPeer::NOMBRE_REFERENCIA_3);
            $criteria->addSelectColumn(RlookPeer::NOMBRE_REFERENCIA_4);
            $criteria->addSelectColumn(RlookPeer::TEL_1);
            $criteria->addSelectColumn(RlookPeer::TEL_2);
            $criteria->addSelectColumn(RlookPeer::TEL_3);
            $criteria->addSelectColumn(RlookPeer::TEL_4);
            $criteria->addSelectColumn(RlookPeer::TEL_1_ALTERNO);
            $criteria->addSelectColumn(RlookPeer::TEL_2_ALTERNO);
            $criteria->addSelectColumn(RlookPeer::TEL_3_ALTERNO);
            $criteria->addSelectColumn(RlookPeer::TEL_4_ALTERNO);
            $criteria->addSelectColumn(RlookPeer::TEL_1_VERIF);
            $criteria->addSelectColumn(RlookPeer::TEL_2_VERIF);
            $criteria->addSelectColumn(RlookPeer::TEL_3_VERIF);
            $criteria->addSelectColumn(RlookPeer::TEL_4_VERIF);
            $criteria->addSelectColumn(RlookPeer::TEL_1_REF_1);
            $criteria->addSelectColumn(RlookPeer::TEL_2_REF_1);
            $criteria->addSelectColumn(RlookPeer::TEL_1_REF_2);
            $criteria->addSelectColumn(RlookPeer::TEL_2_REF_2);
            $criteria->addSelectColumn(RlookPeer::TEL_1_REF_3);
            $criteria->addSelectColumn(RlookPeer::TEL_2_REF_3);
            $criteria->addSelectColumn(RlookPeer::TEL_1_REF_4);
            $criteria->addSelectColumn(RlookPeer::TEL_2_REF_4);
            $criteria->addSelectColumn(RlookPeer::TEL_1_LABORAL);
            $criteria->addSelectColumn(RlookPeer::TEL_2_LABORAL);
            $criteria->addSelectColumn(RlookPeer::TELEFONOS_MARCADOS);
        } else {
            $criteria->addSelectColumn($alias . '.id_cuenta');
            $criteria->addSelectColumn($alias . '.numero_de_cuenta');
            $criteria->addSelectColumn($alias . '.nombre_deudor');
            $criteria->addSelectColumn($alias . '.cliente');
            $criteria->addSelectColumn($alias . '.status_de_credito');
            $criteria->addSelectColumn($alias . '.nombre_referencia_1');
            $criteria->addSelectColumn($alias . '.nombre_referencia_2');
            $criteria->addSelectColumn($alias . '.nombre_referencia_3');
            $criteria->addSelectColumn($alias . '.nombre_referencia_4');
            $criteria->addSelectColumn($alias . '.tel_1');
            $criteria->addSelectColumn($alias . '.tel_2');
            $criteria->addSelectColumn($alias . '.tel_3');
            $criteria->addSelectColumn($alias . '.tel_4');
            $criteria->addSelectColumn($alias . '.tel_1_alterno');
            $criteria->addSelectColumn($alias . '.tel_2_alterno');
            $criteria->addSelectColumn($alias . '.tel_3_alterno');
            $criteria->addSelectColumn($alias . '.tel_4_alterno');
            $criteria->addSelectColumn($alias . '.tel_1_verif');
            $criteria->addSelectColumn($alias . '.tel_2_verif');
            $criteria->addSelectColumn($alias . '.tel_3_verif');
            $criteria->addSelectColumn($alias . '.tel_4_verif');
            $criteria->addSelectColumn($alias . '.tel_1_ref_1');
            $criteria->addSelectColumn($alias . '.tel_2_ref_1');
            $criteria->addSelectColumn($alias . '.tel_1_ref_2');
            $criteria->addSelectColumn($alias . '.tel_2_ref_2');
            $criteria->addSelectColumn($alias . '.tel_1_ref_3');
            $criteria->addSelectColumn($alias . '.tel_2_ref_3');
            $criteria->addSelectColumn($alias . '.tel_1_ref_4');
            $criteria->addSelectColumn($alias . '.tel_2_ref_4');
            $criteria->addSelectColumn($alias . '.tel_1_laboral');
            $criteria->addSelectColumn($alias . '.tel_2_laboral');
            $criteria->addSelectColumn($alias . '.telefonos_marcados');
        }
    }

    /**
     * Returns the number of rows matching criteria.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @return int Number of matching rows.
     */
    public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
    {
        // we may modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(RlookPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            RlookPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(RlookPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(RlookPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        // BasePeer returns a PDOStatement
        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }
    /**
     * Selects one object from the DB.
     *
     * @param      Criteria $criteria object used to create the SELECT statement.
     * @param      PropelPDO $con
     * @return                 Rlook
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = RlookPeer::doSelect($critcopy, $con);
        if ($objects) {
            return $objects[0];
        }

        return null;
    }
    /**
     * Selects several row from the DB.
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con
     * @return array           Array of selected Objects
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelect(Criteria $criteria, PropelPDO $con = null)
    {
        return RlookPeer::populateObjects(RlookPeer::doSelectStmt($criteria, $con));
    }
    /**
     * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
     *
     * Use this method directly if you want to work with an executed statement directly (for example
     * to perform your own object hydration).
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con The connection to use
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return PDOStatement The executed PDOStatement object.
     * @see        BasePeer::doSelect()
     */
    public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(RlookPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            RlookPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(RlookPeer::DATABASE_NAME);

        // BasePeer returns a PDOStatement
        return BasePeer::doSelect($criteria, $con);
    }
    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doSelect*()
     * methods in your stub classes -- you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by doSelect*()
     * and retrieveByPK*() calls.
     *
     * @param      Rlook $obj A Rlook object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getIdCuenta();
            } // if key === null
            RlookPeer::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param      mixed $value A Rlook object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof Rlook) {
                $key = (string) $value->getIdCuenta();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Rlook object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(RlookPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   Rlook Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(RlookPeer::$instances[$key])) {
                return RlookPeer::$instances[$key];
            }
        }

        return null; // just to be explicit
    }

    /**
     * Clear the instance pool.
     *
     * @return void
     */
    public static function clearInstancePool($and_clear_all_references = false)
    {
      if ($and_clear_all_references)
      {
        foreach (RlookPeer::$instances as $instance)
        {
          $instance->clearAllReferences(true);
        }
      }
        RlookPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to rlook
     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return string A string version of PK or null if the components of primary key in result array are all null.
     */
    public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
    {
        // If the PK cannot be derived from the row, return null.
        if ($row[$startcol] === null) {
            return null;
        }

        return (string) $row[$startcol];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $startcol = 0)
    {

        return (int) $row[$startcol];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function populateObjects(PDOStatement $stmt)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = RlookPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = RlookPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = RlookPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                RlookPeer::addInstanceToPool($obj, $key);
            } // if key exists
        }
        $stmt->closeCursor();

        return $results;
    }
    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return array (Rlook object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = RlookPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = RlookPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + RlookPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = RlookPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            RlookPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * Returns the TableMap related to this peer.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getDatabaseMap(RlookPeer::DATABASE_NAME)->getTable(RlookPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseRlookPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseRlookPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new RlookTableMap());
      }
    }

    /**
     * The class that the Peer will make instances of.
     *
     *
     * @return string ClassName
     */
    public static function getOMClass($row = 0, $colnum = 0)
    {
        return RlookPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a Rlook or Criteria object.
     *
     * @param      mixed $values Criteria or Rlook object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(RlookPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from Rlook object
        }


        // Set the correct dbName
        $criteria->setDbName(RlookPeer::DATABASE_NAME);

        try {
            // use transaction because $criteria could contain info
            // for more than one table (I guess, conceivably)
            $con->beginTransaction();
            $pk = BasePeer::doInsert($criteria, $con);
            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $pk;
    }

    /**
     * Performs an UPDATE on the database, given a Rlook or Criteria object.
     *
     * @param      mixed $values Criteria or Rlook object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(RlookPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(RlookPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(RlookPeer::ID_CUENTA);
            $value = $criteria->remove(RlookPeer::ID_CUENTA);
            if ($value) {
                $selectCriteria->add(RlookPeer::ID_CUENTA, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(RlookPeer::TABLE_NAME);
            }

        } else { // $values is Rlook object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(RlookPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the rlook table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(RlookPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(RlookPeer::TABLE_NAME, $con, RlookPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RlookPeer::clearInstancePool();
            RlookPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a Rlook or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or Rlook object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param      PropelPDO $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *				if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, PropelPDO $con = null)
     {
        if ($con === null) {
            $con = Propel::getConnection(RlookPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            RlookPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof Rlook) { // it's a model object
            // invalidate the cache for this single object
            RlookPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(RlookPeer::DATABASE_NAME);
            $criteria->add(RlookPeer::ID_CUENTA, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                RlookPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(RlookPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            RlookPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given Rlook object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      Rlook $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(RlookPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(RlookPeer::TABLE_NAME);

            if (! is_array($cols)) {
                $cols = array($cols);
            }

            foreach ($cols as $colName) {
                if ($tableMap->hasColumn($colName)) {
                    $get = 'get' . $tableMap->getColumn($colName)->getPhpName();
                    $columns[$colName] = $obj->$get();
                }
            }
        } else {

        }

        return BasePeer::doValidate(RlookPeer::DATABASE_NAME, RlookPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param      int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return Rlook
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = RlookPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(RlookPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(RlookPeer::DATABASE_NAME);
        $criteria->add(RlookPeer::ID_CUENTA, $pk);

        $v = RlookPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return Rlook[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(RlookPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(RlookPeer::DATABASE_NAME);
            $criteria->add(RlookPeer::ID_CUENTA, $pks, Criteria::IN);
            $objs = RlookPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseRlookPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseRlookPeer::buildTableMap();

