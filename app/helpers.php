<?php 

if( !function_exists('generate_slug') ) {
    function generate_slug($text, $divider) {
        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, $divider);

        // remove duplicate divider
        $text = preg_replace('~-+~', $divider, $text);

        // lowercase
        $text = strtolower($text);
        
        if (empty($text)) {
            return 'n-a';
        }

        // 4 number unique code
        $text = $text . '-' . rand(1000, 9999);

        return $text;
    }
}