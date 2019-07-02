<?php
/**
 * This script handles Display of the People who registered
 *
 * PHP version 7.2
 *
 * @category Registration_Display
 * @package  Registration_Display
 * @author   Benson Imoh,ST <benson@stbensonimoh.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://stbensonimoh.com
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

// echo json_encode($_POST);
//pull in the database
require '../config.php';
require './DB.php';

// Capture Post Data that is coming from the form
$_POST = json_decode(file_get_contents('php://input'), true);
// $referrer = $_POST['referrer'];

$db = new DB($host, $db, $username, $password);

// if (strpos($referrer, 'iys_participation') !== false) {
//     $registeredusers = $db->query("SELECT * FROM AWLCRwanda2019");
// } else {
$registeredusers = $db->query("SELECT * FROM iys_participation");
// }

$data = $registeredusers->fetchAll();


echo json_encode($data);
