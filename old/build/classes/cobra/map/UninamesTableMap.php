<?php



/**
 * This class defines the structure of the 'uninames' table.
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
class UninamesTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'cobra.map.UninamesTableMap';

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
        $this->setName('uninames');
        $this->setPhpName('Uninames');
        $this->setClassname('Uninames');
        $this->setPackage('cobra');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('nombre_deudor', 'NombreDeudor', 'VARCHAR', true, 255, '');
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // UninamesTableMap
