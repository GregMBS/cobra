<?php



/**
 * This class defines the structure of the 'pagos' table.
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
class PagosTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'cobra.map.PagosTableMap';

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
        $this->setName('pagos');
        $this->setPhpName('Pagos');
        $this->setClassname('Pagos');
        $this->setPackage('cobra');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('auto', 'Auto', 'INTEGER', true, null, null);
        $this->addColumn('cuenta', 'Cuenta', 'VARCHAR', true, 50, '0');
        $this->addColumn('fecha', 'Fecha', 'DATE', true, null, '0000-00-00');
        $this->addColumn('monto', 'Monto', 'DECIMAL', true, null, 0);
        $this->addColumn('cliente', 'Cliente', 'VARCHAR', true, 255, null);
        $this->addColumn('gestor', 'Gestor', 'VARCHAR', false, 255, null);
        $this->addColumn('confirmado', 'Confirmado', 'BOOLEAN', true, 1, false);
        $this->addColumn('credito', 'Credito', 'VARCHAR', false, 50, null);
        $this->addColumn('id_cuenta', 'IdCuenta', 'INTEGER', true, null, 0);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // PagosTableMap
