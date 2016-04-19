<?php



/**
 * This class defines the structure of the 'notas' table.
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
class NotasTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'cobra.map.NotasTableMap';

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
        $this->setName('notas');
        $this->setPhpName('Notas');
        $this->setClassname('Notas');
        $this->setPackage('cobra');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('auto', 'Auto', 'INTEGER', true, null, null);
        $this->addColumn('c_cvge', 'CCvge', 'VARCHAR', true, 255, null);
        $this->addColumn('d_fech', 'DFech', 'DATE', true, null, null);
        $this->addColumn('c_hora', 'CHora', 'TIME', true, null, null);
        $this->addColumn('fecha', 'Fecha', 'DATE', false, null, null);
        $this->addColumn('hora', 'Hora', 'TIME', false, null, null);
        $this->addColumn('nota', 'Nota', 'VARCHAR', false, 255, null);
        $this->addColumn('borrado', 'Borrado', 'BOOLEAN', true, 1, false);
        $this->addColumn('cuenta', 'Cuenta', 'INTEGER', false, null, null);
        $this->addColumn('fuente', 'Fuente', 'VARCHAR', false, 255, null);
        $this->addColumn('c_cont', 'CCont', 'INTEGER', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // NotasTableMap
