<?php

namespace Box\Spout\Writer;

/**
 * Class Sheet
 * Represents a worksheet within a XLSX file
 *
 * @package Box\Spout\Writer
 */
class Sheet
{
    const DEFAULT_SHEET_NAME_PREFIX = 'Sheet';

    /** @var int Index of the sheet, based on order of creation (zero-based) */
    protected $index;

    /** @var string Name of the sheet */
    protected $name;

    /**
     * @param int $sheetIndex Index of the sheet, based on order of creation (zero-based)
     */
    function __construct($sheetIndex)
    {
        $this->index = $sheetIndex;
        $this->name = self::DEFAULT_SHEET_NAME_PREFIX . ($sheetIndex + 1);
    }

    /**
     * @return int Index of the sheet, based on order of creation (zero-based)
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * @return string Name of the sheet
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name Name of the sheet
     * @return \Box\Spout\Writer\Sheet
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}
