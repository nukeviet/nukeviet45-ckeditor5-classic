<?php

/**
 * NukeViet Content Management System
 * @version 4.x
 * @author VINADES.,JSC <contact@vinades.vn>
 * @copyright (C) 2009-2023 VINADES.,JSC. All rights reserved
 * @license GNU/GPL version 2 or any later version
 * @see https://github.com/nukeviet The NukeViet CMS GitHub project
 */

define('NV_SYSTEM', true);
define('NV_ROOTDIR', pathinfo(str_replace(DIRECTORY_SEPARATOR, '/', __FILE__), PATHINFO_DIRNAME));

file_put_contents(NV_ROOTDIR . '/debug.log', print_r($_FILES, true), FILE_APPEND);

header('Content-Type: application/json');

$error = '{
    "error": {
        "message": "The image upload failed because the image was too big (max 1.5MB)."
    }
}';

$success = '{
    "url": "/ckeditor/ckeditor5-online-build/test/uploads/Leo-Nui.jpg"
}';

echo $success;
