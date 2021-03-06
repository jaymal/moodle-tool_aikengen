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
 * Insert questions into the table
 * @package     tool_aikengen
 * @copyright  2016 Jamal Aruna <it@iou.edu.gm>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../../config.php');
require_once('locallib.php');
require_login();
require_capability('tool/aikengen:view', context_system::instance());
global $DB;

$sesskey = optional_param('sesskey', '__notpresent__', PARAM_RAW);

$data = json_decode(file_get_contents("php://input"));

$operation = $data->operation;
$question = $data->full_questiontext;
$fileid = intval($data->filename);


if (tool_aikengen_user_own_aiken_file_id($USER->id, $fileid)) {
    if ($operation == 'Insert') {

        $record = new stdClass();
        $record->question = $question;
        $record->option_a = $data->option_a;
        $record->option_b = $data->option_b;
        $record->option_c = $data->option_c;
        $record->option_d = $data->option_d;
        $record->option_e = $data->option_e;
        $record->answer = $data->correct_answer;
        $record->fileid = $fileid;

        $recordentered = $DB->insert_record('tool_aiken_question', $record);
    } else if ($operation == 'Update') {

        $record = new stdClass();
        $record->id  = $data->id;
        $record->question = $question;
        $record->option_a = $data->option_a;
        $record->option_b = $data->option_b;
        $record->option_c = $data->option_c;
        $record->option_d = $data->option_d;
        $record->option_e = $data->option_e;
        $record->answer = $data->correct_answer;
        $record->fileid = $fileid;
        $DB->update_record('tool_aiken_question', $record);
    }

} else {
    print_error("noinsertupdatepermission", 'tool_aikengen');
}