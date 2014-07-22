<?php



/**
 * This class defines the structure of the 'sdhmerc' table.
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
class SdhmercTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'cobra.map.SdhmercTableMap';

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
        $this->setName('sdhmerc');
        $this->setPhpName('Sdhmerc');
        $this->setClassname('Sdhmerc');
        $this->setPackage('cobra');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('auto', 'Auto', 'INTEGER', true, null, null);
        $this->addColumn('id_cuenta', 'IdCuenta', 'INTEGER', true, null, null);
        $this->addColumn('merc', 'Merc', 'VARCHAR', true, 255, null);
        $this->addColumn('fechamerc', 'Fechamerc', 'DATE', true, null, null);
        $this->addColumn('fechacapt', 'Fechacapt', 'TIMESTAMP', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // SdhmercTableMap
