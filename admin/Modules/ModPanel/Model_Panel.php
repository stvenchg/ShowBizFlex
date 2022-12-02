<?php

require_once('PDOConnection.php');
require_once('Alert.php');

class ModelPanel extends PDOConnection
{

    private $viewAlert;

    public function __construct()
    {
        $this->viewAlert = new Alert;
    }

    // Dashboard
    public function getCountUsers() {
        $stmt = parent::$db->prepare("SELECT COUNT(*) FROM User");
        $stmt->execute();
        $stmtResult = $stmt->fetch();
        return $stmtResult[0];
    }

    public function getCountShows() {
        $stmt = parent::$db->prepare("SELECT * FROM show");
        $stmt->execute();
        $stmtResult = $stmt->fetch();
        var_dump($stmtResult);
    }

    public function getCountComments() {
        $stmt = parent::$db->prepare("SELECT count(*) FROM comment");
        $stmt->execute();
        $stmtResult = $stmt->fetch();
        return $stmtResult[0];
    }

    public function getCountShowsInList() {
        $stmtCount1 = parent::$db->prepare("SELECT count(*) FROM towatchlatershows");
        $stmtCount1->execute();
        $count1 = $stmtCount1->fetch();

        $stmtCount2 = parent::$db->prepare("SELECT count(*) FROM followedshows");
        $stmtCount2->execute();
        $count2 = $stmtCount2->fetch();

        return $count1[0] + $count2[0];
    }
}
