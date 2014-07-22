<?php



/**
 * This class defines the structure of the 'trouble' table.
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
class TroubleTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'cobra.map.TroubleTableMap';

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
        $this->setName('trouble');
        $this->setPhpName('Trouble');
        $this->setClassname('Trouble');
        $this->setPackage('cobra');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('auto', 'Auto', 'INTEGER', true, null, null);
        $this->addColumn('fechahora', 'Fechahora', 'TIMESTAMP', true, null, null);
        $this->addColumn('sistema', 'Sistema', 'VARCHAR', true, 15, null);
        $this->addColumn('usuario', 'Usuario', 'VARCHAR', false, 255, null);
        $this->addColumn('fuente', 'Fuente', 'VARCHAR', false, 255, null);
        $this->addColumn('descripcion', 'Descripcion', 'VARCHAR', false, 255, null);
        $this->addColumn('error_msg', 'ErrorMsg', 'VARCHAR', false, 255, null);
        $this->addColumn('fechacomp', 'Fechacomp', 'TIMESTAMP', true, null, '0000-00-00 00:00:00');
        $this->addColumn('it_guy', 'ItGuy', 'VARCHAR', false, 255, null);
        $this->addColumn('reparacion', 'Reparacion', 'VARCHAR', false, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // TroubleTableMap
