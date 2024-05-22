<?php

/**
 * Convert tiptap json to html
 *
 * @return response()
 */

use Illuminate\Database\Eloquent\Casts\Json;

if (!function_exists('convert_tiptap_json_to_html')) {
    function convert_tiptap_json_to_html(Json $json)
    {
        return app('tiptap')->toHtml($json);
    }
}
