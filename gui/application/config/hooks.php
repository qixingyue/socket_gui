<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/

$hook['pre_system'][] = array(
                                'class'    => 'HookL',
                                'function' => 'pre_system',
                                'filename' => 'HookL.php',
                                'filepath' => 'hooks',
                                );
                                
$hook['pre_controller'][] = array(
                                'class'    => 'HookL',
                                'function' => 'pre_controller',
                                'filename' => 'HookL.php',
                                'filepath' => 'hooks',
                                );

$hook['post_controller_constructor'][] = array(
                                'class'    => 'HookL',
                                'function' => 'post_controller_constructor',
                                'filename' => 'HookL.php',
                                'filepath' => 'hooks',
                                );

$hook['post_controller'][] = array(
                                'class'    => 'HookL',
                                'function' => 'post_controller',
                                'filename' => 'HookL.php',
                                'filepath' => 'hooks',
                                );

$hook['display_override'][] = array(
                                'class'    => 'HookL',
                                'function' => 'display_override',
                                'filename' => 'HookL.php',
                                'filepath' => 'hooks',
                                );

$hook['cache_override'][] = array(
                                'class'    => 'HookL',
                                'function' => 'cache_override',
                                'filename' => 'HookL.php',
                                'filepath' => 'hooks',
                                );
                                
$hook['post_system'][] = array(
                                'class'    => 'HookL',
                                'function' => 'post_system',
                                'filename' => 'HookL.php',
                                'filepath' => 'hooks',
                                );



/* End of file hooks.php */
/* Location: ./application/config/hooks.php */