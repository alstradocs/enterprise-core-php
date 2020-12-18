<?php

namespace Enterprise\Framework\Util;

class Alstradocs_File_Upload_Util
{
    public static $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public static function handle_upload($param_name)
    {
        if ($_FILES[$param_name]['name']) {
            if (!$_FILES[$param_name]['error']) {
                //validate the file
                $new_file_name = strtolower($_FILES[$param_name]['tmp_name']);
                //can't be larger than 3000 KB
                if ($_FILES[$param_name]['size'] > (3000000)) {
                    //wp_die generates a visually appealing message element
                    wp_die('Your file size is to large.');
                } else {
                    //the file has passed the test
                    if (! function_exists('wp_handle_upload')) {
                        require_once(ABSPATH . 'wp-admin/includes/file.php');
                    }
                    //These files need to be included as dependencies when on the front end.
                    // require_once( ABSPATH . 'wp-admin/includes/image.php' );
                    // require_once( ABSPATH . 'wp-admin/includes/file.php' );
                    // require_once( ABSPATH . 'wp-admin/includes/media.php' );

                    // Let WordPress handle the upload.
                    // Remember, $param_name is the name of our file input in our form above.
                    $uploaded_file = wp_handle_upload($_FILES[$param_name], array('test_form' => false));
                    $uploaded_file['size'] = $_FILES[$param_name]['size'];
                    $uploaded_file['name'] = $_FILES[$param_name]['name'];
                    return $uploaded_file;
                }
            } else {
                //set that to be the returned message
                wp_die('Error: '.$_FILES[$param_name]['error']);
            }
        }
    }

    public static function format_size_units($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
}
