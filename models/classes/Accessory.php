<?php

namespace CPMF\Models;

class Accessory extends Decoration
{
    public function __construct(int $id, string $label, string $filePath, int $pointsRequired)
    {
        parent::__construct($id, $label, $filePath, $pointsRequired);
    }
}