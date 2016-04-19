<?php



/**
 * This class defines the structure of the 'reboot' table.
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
class RebootTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'cobra.map.RebootTableMap';

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
        $this->setName('reboot');
        $this->setPhpName('Reboot');
        $this->setClassname('Reboot');
        $this->setPackage('cobra');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('numero_de_cuenta', 'NumeroDeCuenta', 'VARCHAR', true, 255, null);
        $this->addColumn('ejecutivo_asignado_call_center', 'EjecutivoAsignadoCallCenter', 'VARCHAR', false, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // RebootTableMap
