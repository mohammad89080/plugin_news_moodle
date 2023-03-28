<?php
// This file is part of Moodle - http://moodle.org/
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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * ${PLUGINNAME} file description here.
 *
 * @package    ${PLUGINNAME}
 * @copyright  2023 Islam <${USEREMAIL}>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
use core_completion\progress;
global $CFG;
require_once(__DIR__.'/../../config.php');
require_once($CFG->libdir.'/externallib.php');
class local_news_service_external extends external_api {
    public static function get_news($categoryid='') {
        global $DB;

        if(!empty($categoryid)) {
            $params['categoryid'] = $categoryid;
            $where = 'WHERE categoryid = :categoryid';
            $records = $DB->get_records_sql("SELECT * FROM {local_news} $where", $params);;
        }
        else {
            $records = $DB->get_records('local_news');
        }
        foreach($records as  $row) {
            $record = array();
            $record["ID"] = $row->id;
            $record["Title"] = $row->title;
            $record["Content"] = $row->content;
            $record["category_ID"] = $row->categoryid;
            $record["Image_URL"] = $row->image;
            $record["Time_Created"] =date('Y-m-d H:i:s',$row->timecreated);
            $data[] = $record;

        }
        return $data;
    }
    public static function get_news_parameters() {
        return new external_function_parameters(
            array(
                'categoryid' => new external_value(PARAM_TEXT, 'Category ID',VALUE_OPTIONAL)
            ),
        );
    }


    public static function get_news_returns() {
        return new external_multiple_structure(
            new external_single_structure(
                array(
                    'ID' => new external_value(PARAM_TEXT, 'ID'),
                    'Title' => new external_value(PARAM_TEXT, 'Title'),
                    'Content'=> new external_value(PARAM_TEXT, ' content'),
                    'category_ID'=>new external_value(PARAM_TEXT,'category ID'),
                    'Image_URL'=>new external_value(PARAM_TEXT,'Image URL'),
                    'Time_Created'=>new external_value(PARAM_TEXT,'Time Created')
                ),
            ));
    }


    public static function get_category() {
        global $DB;
        $activities_raw = $DB->get_records('local_news_categories',);
        $data = array();
        foreach($activities_raw as  $activity_raw) {
            $record = array();
            $record["ID"] = $activity_raw->id;
            $record["Category_Name"] = $activity_raw->category_name;
            $record["Parent_ID"] = $activity_raw->parent_id;
            $record["Time_Created"] =$activity_raw->timecreated;
            $data[] = $record;

        }

        return $data;

    }
    public static function get_category_returns() {
        return new external_multiple_structure(
            new external_single_structure(
                array(
                    'ID' => new external_value(PARAM_TEXT, 'ID'),
                    'Category_Name'=> new external_value(PARAM_TEXT, ' Category Name'),
                    'Parent_ID'=> new external_value(PARAM_TEXT, ' Parent ID'),
                    'Time_Created'=>new external_value(PARAM_TEXT,'Time Created')
                ),
            ));
    }
    public static function get_category_parameters() {
        return new external_function_parameters(
            array(
            ),
        );
    }
}

