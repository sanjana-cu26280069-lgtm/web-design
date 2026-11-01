<?php
$https=(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS']!=='off');
session_set_cookie_params([
    'lifetime'=>0,'path'=>'/','domain'=>'',
    'secure'=>$https,'httponly'=>true,'samesite'=>'Lax'
]);
ini_set('session.use_strict_mode','1');
session_start();
// Call immediately after successful authentication:
function on_login_success(): void {
    session_regenerate_id(true);
}
