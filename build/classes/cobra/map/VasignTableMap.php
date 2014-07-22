<?php



/**
 * This class defines the structure of the 'vasign' table.
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
class VasignTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'cobra.map.VasignTableMap';

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
        $this->setName('vasign');
        $this->setPhpName('Vasign');
        $this->setClassname('Vasign');
        $this->setPackage('cobra');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('auto', 'Auto', 'INTEGER', true, null, null);
        $this->addColumn('cuenta', 'Cuenta', 'VARCHAR', true, 255, null);
        $this->addColumn('gestor', 'Gestor', 'VARCHAR', true, 255, null);
        $this->addColumn('fechaout', 'Fechaout', 'TIMESTAMP', true, null, null);
        $this->addColumn('fechain', 'Fechain', 'TIMESTAMP', false, null, null);
        $this->addColumn('c_cont', 'CCont', 'INTEGER', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // VasignTableMap
