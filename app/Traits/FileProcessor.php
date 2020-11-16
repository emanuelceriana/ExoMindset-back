<?php

namespace App\Traits;

use Rap2hpoutre\FastExcel\FastExcel;

trait FileProcessor
{
    private function processFile($file)
    {
        return (new FastExcel)->import($file);
    }

    private function generateFile($list)
    {
        return (new FastExcel($list));
    }
}
