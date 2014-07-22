<?php



/**
 * This class defines the structure of the 'csidict' table.
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
class CsidictTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'cobra.map.CsidictTableMap';

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
        $this->setName('csidict');
        $this->setPhpName('Csidict');
        $this->setClassname('Csidict');
        $this->setPackage('cobra');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('dictamen', 'Dictamen', 'VARCHAR', true, 255, null);
        $this->addColumn('csi_cr', 'CsiCr', 'VARCHAR', false, 255, null);
        $this->addColumn('csi_res', 'CsiRes', 'VARCHAR', false, 255, null);
        $this->addColumn('csi_tipo', 'CsiTipo', 'VARCHAR', false, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // CsidictTableMap
