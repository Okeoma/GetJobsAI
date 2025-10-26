<?php

use PhpOffice\PhpWord\IOFactory;
use Smalot\PdfParser\Parser;

if (! function_exists('extractTextFromCv')) {
    function extractTextFromCv($filePath)
    {
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);

        if ($extension === 'pdf') {
            $parser = new Parser;
            $pdf = $parser->parseFile(storage_path('app/public/'.$filePath));

            return $pdf->getText();
        }

        if (in_array($extension, ['doc', 'docx'])) {
            $phpWord = IOFactory::load(storage_path('app/public/'.$filePath));
            $text = '';

            foreach ($phpWord->getSections() as $section) {
                foreach ($section->getElements() as $element) {
                    if (method_exists($element, 'getText')) {
                        $text .= $element->getText()."\n";
                    }
                }
            }

            return $text;
        }

        return null;
    }
}
