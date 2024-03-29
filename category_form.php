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

defined('MOODLE_INTERNAL') || die();
global $CFG;

require_once($CFG->libdir . '/formslib.php');

class local_news_category_form extends moodleform {
    /**
     * Define the form.
     */
    public function definition() {
        global $DB;
        $mform    = $this->_form; // Don't forget the underscore!
        //fields Sub-Categories
        $sql = "SELECT id, category_name FROM {local_news_categories}  WHERE parent_id IS NULL";
        $records = $DB->get_records_sql($sql);
//        $records=$DB->get_records('local_news_categories');

        $categories=array();

        $categories[]='null';
        foreach($records as $record)
        {
            $categories[$record->id]=$record->category_name;
        }
        $mform->addElement('select', 'selectedcategory',get_string('choosecategory','local_news'),$categories); // Add elements to your form.
        $mform->setDefault('selectedsubcategory','null');

        //fields Categories
        $mform->addElement('textarea', 'namecategory', get_string('yourmessage', 'local_news')); // Add elements to your form.
        $mform->setType('namecategory', PARAM_TEXT); // Set type of element.

        $submitlabel = get_string('submit');
        $mform->addElement('submit', 'submitmessage', $submitlabel);

    }
}
