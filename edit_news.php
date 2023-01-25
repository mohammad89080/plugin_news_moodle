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
//$action= optional_param('action','', PARAM_TEXT);


    $idnews = required_param('id',PARAM_INT);
    $titlenews = optional_param('title', '',PARAM_TEXT);
    $contentnews = optional_param('content','', PARAM_TEXT);
    $selectedcategory = optional_param('categoryid','',PARAM_TEXT);

$classform=new local_news_form();
$classform->getMyObject()->setDefault('newstitle',$titlenews);
$classform->getMyObject()->setDefault('newscontent',$contentnews);
$classform->getMyObject()->setDefault('selectedcategory',$selectedcategory);
$classform->getMyObject()->setDefault('id',$idnews);

if($data = $classform->get_data()) {
//    require_capability('local/greetings:postmessages', $context);
//    $idnews = required_param('id', PARAM_INT);
    $titlenews1 = required_param('newstitle', PARAM_TEXT);
    $contentnews1 = required_param('newscontent', PARAM_TEXT);
    $selectedcategory1 = required_param('selectedcategory', PARAM_TEXT);
//    $id = required_param('id', PARAM_TEXT);

    if (!empty($titlenews1) && !empty($contentnews1) && !empty($selectedcategory1)) {

        $record = new stdClass;
        $record->id = $idnews;
        $record->title = $titlenews1;
        $record->content = $contentnews1;
        $record->categoryid = $selectedcategory1;

        $record->timecreated = time();

        $DB->update_record('local_news', $record);

    }
}




echo $OUTPUT->header();
$classform->display();

//print($idnews);
//print( $classform->get_data());
echo $idnews;
echo $titlenews;
echo $OUTPUT->footer();