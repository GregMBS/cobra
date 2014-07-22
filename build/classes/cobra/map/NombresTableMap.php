<?php



/**
 * This class defines the structure of the 'nombres' table.
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
class NombresTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'cobra.map.NombresTableMap';

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
        $this->setName('nombres');
        $this->setPhpName('Nombres');
        $this->setClassname('Nombres');
        $this->setPackage('cobra');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('USUARIA', 'Usuaria', 'VARCHAR', true, 20, null);
        $this->addColumn('INICIALES', 'Iniciales', 'VARCHAR', false, 20, null);
        $this->addColumn('COMPLETO', 'Completo', 'VARCHAR', false, 255, null);
        $this->addColumn('TIPO', 'Tipo', 'VARCHAR', false, 255, null);
        $this->addColumn('TICKET', 'Ticket', 'VARCHAR', false, 255, null);
        $this->addColumn('camp', 'Camp', 'INTEGER', true, null, 0);
        $this->addColumn('turno', 'Turno', 'VARCHAR', false, 255, null);
        $this->addColumn('authcode', 'Authcode', 'VARCHAR', false, 6, null);
        $this->addColumn('passw', 'Passw', 'VARCHAR', true, 50, 'adarc');
        $this->addColumn('policy', 'Policy', 'TINYINT', true, null, 0);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // NombresTableMap
