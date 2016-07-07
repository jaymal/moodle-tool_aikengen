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
 * @package    tool
 * @package aikengen
 * @copyright  2016 Jamal Aruna <it@iou.edu.gm> 
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 /**
 *deletes questions from the table
 *
 **/
require_once('../../../config.php');
require_once('locallib.php');
require_login();
global $DB;
$data = json_decode(file_get_contents("php://input"));
$id = $data->id;



if (user_own_aiken_question_id($USER->id,$id)){
	
	 $DB->delete_records('c_aiken_question', array ('id' => $id)) ;
 }




?>