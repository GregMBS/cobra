<?php



/**
 * This class defines the structure of the 'cargadex' table.
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
class CargadexTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'cobra.map.CargadexTableMap';

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
        $this->setName('cargadex');
        $this->setPhpName('Cargadex');
        $this->setClassname('Cargadex');
        $this->setPackage('cobra');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('auto', 'Auto', 'INTEGER', true, 10, null);
        $this->addColumn('field', 'Field', 'VARCHAR', true, 255, null);
        $this->addColumn('type', 'Type', 'VARCHAR', false, 255, null);
        $this->addColumn('nullok', 'Nullok', 'VARCHAR', false, 255, null);
        $this->addColumn('position', 'Position', 'INTEGER', false, 10, null);
        $this->addColumn('cliente', 'Cliente', 'VARCHAR', true, 255, null);
        $this->addColumn('ktable', 'Ktable', 'VARCHAR', false, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // CargadexTableMap
