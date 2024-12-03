<?php 
/** 
 * Hello World 
 * @package HelloWorld 
 * @author James
 * @copyright 2020 Your Name 
 * @license GPL-2.0-or-later 
 * @wordpress-plugin 
 * Plugin Name: Hello World 
 * Plugin URI: https://mysite.com/hello-world 
 * Description: Prints "Hello World" in WordPress admin. 
 * Version: 3.0
 * Author: James
 * Author URI: https://mysite.com 
 * Text Domain: hello-world 
 * License: GPL v2 or later 
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt */

 function print_hello_world_title() {
   echo "<h1>Hello World</h1>"; 
 }
 
 function hello_world_admin_menu() {
   add_menu_page(
     'Hello World',        // page title  
     'Hello World Menu Title', // menu title
     'manage_options',     // capability  
     'hello-world',        // menu slug  
     'print_hello_world_title' // callback function  
   );  
 }  

 add_action()('admin_menu', 'hello_world_admin_menu');
 // ... (you can continue with the rest of your code)
 ?>
 
 