<?php

require_once('PDOConnection.php');

class ModelProfile extends PDOConnection
{

    public function __construct()
    {
    }

    public function getUserDetails() {

        $id = htmlspecialchars($_GET['id']);
        
        try{
            $stmt = parent::$db->prepare("SELECT * FROM User WHERE id = $id");
            $stmt->execute();
            return $stmt->fetchAll();

        } catch (Exception $e) {
            echo 'Erreur survenue : ',  $e->getMessage(), "\n";
        }
    }

    public function getUserShowInListsCount() {

        $id = htmlspecialchars($_GET['id']);

        try{
            $stmt1 = parent::$db->prepare("SELECT count(*) FROM towatchlatershows WHERE idUser=$id");
            $stmt1->execute();
            $results1 = $stmt1->fetch();

            $stmt2 = parent::$db->prepare("SELECT count(*) FROM followedshows WHERE idUser=$id");
            $stmt2->execute();
            $results2 = $stmt2->fetch();

            return $results1[0] + $results2[0];

        } catch (Exception $e) {
            echo 'Erreur survenue : ',  $e->getMessage(), "\n";
        }
    }

    public function getUserComments() {

        $id = htmlspecialchars($_GET['id']);

        try{
            $stmt = parent::$db->prepare("SELECT count(*) FROM comment WHERE id=$id");
            $stmt->execute();
            $results = $stmt->fetch();

            return $results[0];

        } catch (Exception $e) {
            echo 'Erreur survenue : ',  $e->getMessage(), "\n";
        }
    }

}