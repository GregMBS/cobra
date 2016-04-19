<?php



/**
 * This class defines the structure of the 'shortzips' table.
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
class ShortzipsTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'cobra.map.ShortzipsTableMap';

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
        $this->setName('shortzips');
        $this->setPhpName('Shortzips');
        $this->setClassname('Shortzips');
        $this->setPackage('cobra');
        $this->setUseIdGenerator(true);
        // columns
        $this->addColumn('estado_deudor', 'EstadoDeudor', 'VARCHAR', false, 25, null);
        $this->addColumn('ciudad_deudor', 'CiudadDeudor', 'VARCHAR', false, 255, null);
        $this->addColumn('cp_deudor', 'CpDeudor', 'VARCHAR', false, 5, null);
        $this->addPrimaryKey('auto', 'Auto', 'INTEGER', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // ShortzipsTableMap
