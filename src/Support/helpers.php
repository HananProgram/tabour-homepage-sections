<?php

// fallback بسيط إن لم تكن دالة trk موجودة في المشروع المستضيف
if (!function_exists('trk')) {
    function trk(string $key, string $fallback = '', string $group = 'ui'): string
    {
        return __($fallback);
    }
}
