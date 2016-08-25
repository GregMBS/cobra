<?php



/**
 * This class defines the structure of the 'gchangelog' table.
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
class GchangelogTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'cobra.map.GchangelogTableMap';

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
        $this->setName('gchangelog');
        $this->setPhpName('Gchangelog');
        $this->setClassname('Gchangelog');
        $this->setPackage('cobra');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('auto', 'Auto', 'INTEGER', true, null, null);
        $this->addColumn('id_cuenta', 'IdCuenta', 'INTEGER', true, null, null);
        $this->addColumn('fechahora', 'Fechahora', 'TIMESTAMP', true, null, null);
        $this->addColumn('gestor_old', 'GestorOld', 'VARCHAR', false, 255, null);
        $this->addColumn('gestor_new', 'GestorNew', 'VARCHAR', false, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // GchangelogTableMap