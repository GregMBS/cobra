<?php



/**
 * This class defines the structure of the 'grupos' table.
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
class GruposTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'cobra.map.GruposTableMap';

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
        $this->setName('grupos');
        $this->setPhpName('Grupos');
        $this->setClassname('Grupos');
        $this->setPackage('cobra');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('auto', 'Auto', 'INTEGER', true, 10, null);
        $this->addColumn('grupo', 'Grupo', 'VARCHAR', true, 255, null);
        $this->addColumn('pw', 'Pw', 'VARCHAR', false, 255, null);
        $this->addColumn('enlace', 'Enlace', 'VARCHAR', false, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // GruposTableMap
