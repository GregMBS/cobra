<?php



/**
 * This class defines the structure of the 'dictamenes' table.
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
class DictamenesTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'cobra.map.DictamenesTableMap';

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
        $this->setName('dictamenes');
        $this->setPhpName('Dictamenes');
        $this->setClassname('Dictamenes');
        $this->setPackage('cobra');
        $this->setUseIdGenerator(true);
        // columns
        $this->addColumn('dictamen', 'Dictamen', 'VARCHAR', true, 255, null);
        $this->addColumn('visitas', 'Visitas', 'BOOLEAN', false, 1, false);
        $this->addColumn('callcenter', 'Callcenter', 'BOOLEAN', false, 1, false);
        $this->addColumn('judicial', 'Judicial', 'BOOLEAN', false, 1, false);
        $this->addColumn('promo', 'Promo', 'BOOLEAN', false, 1, false);
        $this->addPrimaryKey('auto', 'Auto', 'INTEGER', true, 10, null);
        $this->addColumn('v_cc', 'VCc', 'INTEGER', true, 10, 99);
        $this->addColumn('v_v', 'VV', 'INTEGER', true, 10, 99);
        $this->addColumn('v_j', 'VJ', 'INTEGER', true, 10, 99);
        $this->addColumn('queue', 'Queue', 'VARCHAR', false, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // DictamenesTableMap
