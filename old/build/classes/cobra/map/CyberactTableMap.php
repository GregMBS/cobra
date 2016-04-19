<?php



/**
 * This class defines the structure of the 'cyberact' table.
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
class CyberactTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'cobra.map.CyberactTableMap';

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
        $this->setName('cyberact');
        $this->setPhpName('Cyberact');
        $this->setClassname('Cyberact');
        $this->setPackage('cobra');
        $this->setUseIdGenerator(true);
        // columns
        $this->addColumn('accion', 'Accion', 'VARCHAR', true, 255, null);
        $this->addColumn('descripcion', 'Descripcion', 'VARCHAR', false, 255, null);
        $this->addColumn('codigo', 'Codigo', 'VARCHAR', false, 25, null);
        $this->addPrimaryKey('auto', 'Auto', 'INTEGER', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // CyberactTableMap
