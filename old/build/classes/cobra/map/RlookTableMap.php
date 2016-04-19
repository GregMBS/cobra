<?php



/**
 * This class defines the structure of the 'rlook' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.cobra.map
 */
class RlookTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'cobra.map.RlookTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('rlook');
        $this->setPhpName('Rlook');
        $this->setClassname('Rlook');
        $this->setPackage('cobra');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('id_cuenta', 'IdCuenta', 'INTEGER', true, null, 0);
        $this->addColumn('numero_de_cuenta', 'NumeroDeCuenta', 'VARCHAR', true, 255, '0');
        $this->addColumn('nombre_deudor', 'NombreDeudor', 'VARCHAR', false, 255, null);
        $this->addColumn('cliente', 'Cliente', 'VARCHAR', false, 255, null);
        $this->addColumn('status_de_credito', 'StatusDeCredito', 'VARCHAR', false, 50, null);
        $this->addColumn('nombre_referencia_1', 'NombreReferencia1', 'VARCHAR', false, 255, null);
        $this->addColumn('nombre_referencia_2', 'NombreReferencia2', 'VARCHAR', false, 255, null);
        $this->addColumn('nombre_referencia_3', 'NombreReferencia3', 'VARCHAR', false, 255, null);
        $this->addColumn('nombre_referencia_4', 'NombreReferencia4', 'VARCHAR', false, 255, null);
        $this->addColumn('tel_1', 'Tel1', 'VARCHAR', false, 20, null);
        $this->addColumn('tel_2', 'Tel2', 'VARCHAR', false, 20, null);
        $this->addColumn('tel_3', 'Tel3', 'VARCHAR', false, 20, null);
        $this->addColumn('tel_4', 'Tel4', 'VARCHAR', false, 20, null);
        $this->addColumn('tel_1_alterno', 'Tel1Alterno', 'VARCHAR', false, 20, null);
        $this->addColumn('tel_2_alterno', 'Tel2Alterno', 'VARCHAR', false, 20, null);
        $this->addColumn('tel_3_alterno', 'Tel3Alterno', 'VARCHAR', false, 20, null);
        $this->addColumn('tel_4_alterno', 'Tel4Alterno', 'VARCHAR', false, 20, null);
        $this->addColumn('tel_1_verif', 'Tel1Verif', 'VARCHAR', false, 20, null);
        $this->addColumn('tel_2_verif', 'Tel2Verif', 'VARCHAR', false, 20, null);
        $this->addColumn('tel_3_verif', 'Tel3Verif', 'VARCHAR', false, 20, null);
        $this->addColumn('tel_4_verif', 'Tel4Verif', 'VARCHAR', false, 20, null);
        $this->addColumn('tel_1_ref_1', 'Tel1Ref1', 'VARCHAR', false, 20, null);
        $this->addColumn('tel_2_ref_1', 'Tel2Ref1', 'VARCHAR', false, 20, null);
        $this->addColumn('tel_1_ref_2', 'Tel1Ref2', 'VARCHAR', false, 20, null);
        $this->addColumn('tel_2_ref_2', 'Tel2Ref2', 'VARCHAR', false, 20, null);
        $this->addColumn('tel_1_ref_3', 'Tel1Ref3', 'VARCHAR', false, 20, null);
        $this->addColumn('tel_2_ref_3', 'Tel2Ref3', 'VARCHAR', false, 20, null);
        $this->addColumn('tel_1_ref_4', 'Tel1Ref4', 'VARCHAR', false, 20, null);
        $this->addColumn('tel_2_ref_4', 'Tel2Ref4', 'VARCHAR', false, 20, null);
        $this->addColumn('tel_1_laboral', 'Tel1Laboral', 'VARCHAR', false, 20, null);
        $this->addColumn('tel_2_laboral', 'Tel2Laboral', 'VARCHAR', false, 20, null);
        $this->addColumn('telefonos_marcados', 'TelefonosMarcados', 'VARCHAR', false, 20, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // RlookTableMap
