<?php



/**
 * This class defines the structure of the 'motivadores' table.
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
class MotivadoresTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'cobra.map.MotivadoresTableMap';

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
        $this->setName('motivadores');
        $this->setPhpName('Motivadores');
        $this->setClassname('Motivadores');
        $this->setPackage('cobra');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('motiv', 'Motiv', 'VARCHAR', true, 255, null);
        $this->addColumn('callcenter', 'Callcenter', 'BOOLEAN', false, 1, null);
        $this->addColumn('visitas', 'Visitas', 'BOOLEAN', false, 1, null);
        $this->addColumn('judicial', 'Judicial', 'BOOLEAN', false, 1, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // MotivadoresTableMap