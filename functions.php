<?php

function post_data($data) {
  $data['answered']= 0;
  $data['time'] = time();
  $sql = "INSERT INTO questions_table (subject, question, answered) VALUES (:subject, :question, :answered)";
  $stmt= $GLOBALS['dbh_mysql']->prepare($sql);
  $stmt->bindParam(':subject', htmlEntities($data['subject']));
  $stmt->bindParam(':question',htmlEntities($data['question']));
  $stmt->bindParam(':answered', $data['answered']);
  $stmt->execute();
}

function answered($data,$answered) {
  $sql = "update questions_table set answered = :answered, time = time where id = :id";
  $stmt= $GLOBALS['dbh_mysql']->prepare($sql);
  $stmt->bindParam(':answered', $answered);
  $stmt->bindParam(':id', $data);
  $stmt->execute();
}

function get_data() {
  $sql = "SELECT * from questions_table order by id DESC";
  $stmt= $GLOBALS['dbh_mysql']->prepare($sql);
  $stmt->execute();
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $data;
}

function utc_string_to_local_date ($date_string, $date_format = 'm/d/Y g:i a T', $target_tz = 'America/Chicago') {
	$formatted_date_string = '';

	if ( !empty($date_string) ) {

		$original_datetime = $date_string;
		$original_timezone = new DateTimeZone('UTC');

		// Instantiate the DateTime object, setting it's date, time and time zone.
		$datetime = new DateTime($original_datetime, $original_timezone);

		// Set the DateTime object's time zone to convert the time appropriately.
		$target_timezone = new DateTimeZone($target_tz);
		$datetime->setTimeZone($target_timezone);

		// Apply formatting
		$formatted_date_string = $datetime->format($date_format);

	}
	return $formatted_date_string;
}
