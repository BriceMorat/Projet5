<?php
namespace Projet5\Model;

require_once('Manager.php');

/** 

* Class ReportManager

* Used to report comments and delete reports

**/

class ReportManager extends Manager {

	/**

	* @param $commentId integer 

	* @param $memberId integer 

	* return string

	**/
	public function reports(int $commentId, int $memberId) {
		$db = $this->dbConnect();
		$req = $db->prepare('INSERT INTO report(comment_id, member_id, date_report) VALUES(?, ?, NOW())');
		$reported = $req->execute([$commentId, $memberId]);

		return $reported;
	}

	/**

	* @param $memberId integer 

	*return array

	**/
	public function getIdReport(int $memberId) {
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT comment_id FROM report WHERE member_id = ?');
		$req->execute([$memberId]);
		$reports = $req->fetchAll(\PDO::FETCH_ASSOC);
		$idComment = array();
		foreach ($reports as $value) {
			$idComment[] = $value['comment_id'];
		}

		return $idComment;
	}


	public function getReports() {
		$db = $this->dbConnect();
		$reports = $db->query('SELECT COUNT(*) AS reports_nb, comment_id, author, content, DATE_FORMAT(date_comments, "%d/%m/%Y %H:%i") AS date_c FROM report INNER JOIN comment ON report.comment_id = comment.id GROUP BY comment_id ORDER BY reports_nb DESC');

		return $reports;
	}

	/**

	* @param $reportId integer 

	*return integer

	**/
	public function deleteReports(int $reportId) {
		$db = $this->dbConnect();
		$req = $db->prepare('DELETE FROM report WHERE comment_id = ?');
		$deletedReports = $req->execute([$reportId]);

		return $deletedReports;
	}
}