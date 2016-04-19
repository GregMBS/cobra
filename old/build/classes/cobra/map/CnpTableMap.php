<?php



/**
 * This class defines the structure of the 'cnp' table.
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
class CnpTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'cobra.map.CnpTableMap';

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
        $this->setName('cnp');
        $this->setPhpName('Cnp');
        $this->setClassname('Cnp');
        $this->setPackage('cobra');
        $this->setUseIdGenerator(true);
        // columns
        $this->addColumn('status', 'Status', 'VARCHAR', false, 255, null);
        $this->addPrimaryKey('auto', 'Auto', 'INTEGER', true, 10, null);
        $this->addColumn('acr', 'Acr', 'VARCHAR', false, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // CnpTableMap
