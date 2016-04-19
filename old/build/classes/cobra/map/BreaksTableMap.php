<?php



/**
 * This class defines the structure of the 'breaks' table.
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
class BreaksTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'cobra.map.BreaksTableMap';

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
        $this->setName('breaks');
        $this->setPhpName('Breaks');
        $this->setClassname('Breaks');
        $this->setPackage('cobra');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('auto', 'Auto', 'INTEGER', true, null, null);
        $this->addColumn('gestor', 'Gestor', 'VARCHAR', true, 50, null);
        $this->addColumn('tipo', 'Tipo', 'VARCHAR', true, 50, null);
        $this->addColumn('empieza', 'Empieza', 'TIME', true, null, null);
        $this->addColumn('termina', 'Termina', 'TIME', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // BreaksTableMap
