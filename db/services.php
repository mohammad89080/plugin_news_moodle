<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Plugin version and other meta-data are defined here.
 *
 * @package     local_news
 * @copyright   2023 Mohammad <mohammad.bakkar89080@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();
$functions = array(

    'local_news_get_news' => array(
        'classname' => 'local_news_service_external',
        'methodname' => 'get_news',
        'classpath' => 'local/news/externallib.php',
        'description' => ' get_news',
        'type' => 'read',
        'ajax' => true,
    ),
    'local_news_get_categories' => array(
        'classname' => 'local_custom_service_external',
        'methodname' => 'get_category',
        'classpath' => 'local/news/externallib.php',
        'description' => 'get_category',
        'type' => 'read',
        'ajax' => true,
    )
);

$services = array(
    'My service' => array(
        'functions' => array(
            'local_news_get_news',
            'local_news_get_categories'
        ),
        'restrictedusers' => 0,
        'enabled' => 1,
        'shortname'=>'custom_web_services'
    )
);