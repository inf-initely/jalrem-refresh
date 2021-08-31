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
            return null;
        }

        // 4 number unique code
        $text = $text . '-' . rand(1000, 9999);

        return $text;
    }
}

if( !function_exists('upload_file') ) {
    function upload_file($path, $file)
    {
        // try {
        //     $fileSystem = new Filesystem();
            
        //     if( !$fileSystem->exists($path) ) {
        //         File::makeDirectory($path);
        //     }



            $tujuan_upload_file = storage_path($path);
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($tujuan_upload_file, $filename);

            return $filename;    
        // }catch(\Exception $e) {
        // }
    }
}

if( !function_exists('get_asset_path') ) {
    function get_asset_path($table, $image, $type = 'thumbnail')
    {
        return 'storage/assets/' . substr_replace($table ,"",-1) . '/' .$type. '/' . $image;
    }
}

if( !function_exists('generate_route_content') ) {
    function generate_route_content($table)
    {
        switch($table)
        {
            case 'artikels':
                return 'article';
            case 'publikasis':
                return 'publication';
            case 'kegiatans':
                return 'event';
            case 'kerjasamas':
                return 'kerjasama';
            default:
                return '';
        }
    }
}
