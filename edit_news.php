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
 * @copyright  2022 Your name <your@email>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


global $CFG;
global $PAGE;
global $SITE;
global $OUTPUT;
global $DB;
require_once('../../config.php');
//require_once($CFG->dirroot . '/local/greetings/lib.php');
require_once($CFG->dirroot . '/local/news/news_form.php');

$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_url(new moodle_url('/local/news/create_news.php'));
$PAGE->set_pagelayout('standard');
$PAGE->set_title($SITE->fullname);
$PAGE->set_heading(get_string('pluginname', 'local_news'));
$classform=new local_news_form();
$objectform = $classform->getMyObject();
;
$sql = "SELECT m.id, m.title,m.content, m.timecreated, m.categoryid, u.category_name
              FROM {local_news} m  LEFT JOIN {local_news_categories} u 
              ON u.id = m.categoryid WHERE m.id=?";
$id = required_param('id', PARAM_TEXT);
$news = $DB->get_record_sql($sql,array($id));
$objectform->setDefault('newstitle',$news->title);

//if($data = $newsform->get_data()) {
////    require_capability('local/greetings:postmessages', $context);
//
//    $titlenews = required_param('newstitle', PARAM_TEXT, value);
//    $contentnews = required_param('newscontent', PARAM_TEXT);
//    $selectedcategory = required_param('selectedcategory', 	PARAM_TEXT);
//
//    if (!empty($titlenews)&&!empty($contentnews)&&!empty($selectedcategory)) {
//
//        $record = new stdClass;
//        $record->title = $titlenews;
//        $record->content = $contentnews;
//        $record->categoryid =$selectedcategory;
//
//        $record->timecreated = time();
//
//        $DB->insert_record('local_news', $record);
//
//    }
//}


echo $OUTPUT->header();
$classform->display();

echo $OUTPUT->footer();