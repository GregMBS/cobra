<?php



/**
 * This class defines the structure of the 'sdhextras' table.
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
class SdhextrasTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'cobra.map.SdhextrasTableMap';

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
        $this->setName('sdhextras');
        $this->setPhpName('Sdhextras');
        $this->setClassname('Sdhextras');
        $this->setPackage('cobra');
        $this->setUseIdGenerator(true);
        // columns
        $this->addColumn('cuenta', 'Cuenta', 'VARCHAR', true, 10, null);
        $this->addColumn('productos', 'Productos', 'VARCHAR', true, 255, '');
        $this->addColumn('st', 'St', 'DECIMAL', true, null, 0);
        $this->addColumn('sv', 'Sv', 'DECIMAL', true, null, 0);
        $this->addColumn('sd', 'Sd', 'DECIMAL', true, null, 0);
        $this->addColumn('period', 'Period', 'VARCHAR', true, 10, '');
        $this->addColumn('monto', 'Monto', 'DECIMAL', true, null, 0);
        $this->addColumn('sdd', 'Sdd', 'DECIMAL', true, null, 0);
        $this->addColumn('subcuenta', 'Subcuenta', 'VARCHAR', true, 45, '0');
        $this->addColumn('gc', 'Gc', 'DECIMAL', true, null, 0);
        $this->addColumn('xmora', 'Xmora', 'INTEGER', true, null, 0);
        $this->addColumn('grupo', 'Grupo', 'INTEGER', true, null, 0);
        $this->addColumn('liquid', 'Liquid', 'INTEGER', true, null, 0);
        $this->addPrimaryKey('auto', 'Auto', 'INTEGER', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // SdhextrasTableMap
