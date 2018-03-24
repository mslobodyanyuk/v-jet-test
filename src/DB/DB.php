<?php

namespace src\DB;

use config;
use Exception;

class DB {

    const NUMBER_MOST_POPULAR_POSTS = 5;

    private $host;
    private $name;
    private $password;
    private $database;
    public $db;
    public $query;

    public function __construct ($host, $user, $psw, $db)
    {
        $this->host=$host;
        $this->name=$user;
        $this->password=$psw;
        $this->database=$db;
        if (!($this->db=mysqli_connect($this->host,$this->name,$this->password))){
            throw new Exception ("Can't connect to the server.");
        }
        if (!mysqli_select_db($this->db, $this->database)){
            throw new Exception ("Can't connect to DB.");
        }

        return $this->db;
    }

    public function query($sqlQuery, $getType = "assoc")
    {
        if (!($result = mysqli_query($this->db, $sqlQuery))){
            throw new Exception ("Can't execute query.".mysql_error());
        }
        $resultType = MYSQL_NUM;
        if ("assoc" == $getType) {
            $resultType = MYSQL_ASSOC;
        }
        while ($row = mysqli_fetch_array($result, $resultType)){
            $res[] = $row;
        }
        return $res;
    }

    public function getTopPublications(){
        $this->query( "SET CHARSET utf8" );
        $sql = 'SELECT * FROM articles ORDER BY views DESC LIMIT ' . self::NUMBER_MOST_POPULAR_POSTS;
        return $params = $this->query($sql);
    }

    public function getListPublications(){
        $this->query( "SET CHARSET utf8" );
        //$sql = 'SELECT * FROM articles ORDER BY id DESC';
        $sql =
                " SELECT a.id, a.title, a.image, a.text, a.pubdate, a.author, c.count \n".
                " FROM articles a \n".
                        " LEFT JOIN( \n".
                            " SELECT COUNT(comments.articles_id) AS count, comments.articles_id \n".
                            " FROM comments \n".
                            " GROUP BY comments.articles_id \n".
                        " ) c \n".
                " ON a.id = c.articles_id \n".
                " ORDER BY a.id DESC";

//echo "<pre>", var_dump($sql), "<pre/>";
        return $params = $this->query($sql);
    }








    public function postPublication(){
        $this->query( "SET CHARSET utf8" );
        $sqlArticle = "INSERT INTO  articles ( author, title, image, text, pubdate ) VALUES ('".$_POST['name']."','".$_POST['title']."','".$_FILES['uploadfile']['name']."','".$_POST['text']."',NOW())";
$id = 3;
        $sqlComment = "INSERT INTO  comments ( author, nickname, email, text, pubdate, articles_id ) VALUES ('".$_POST['name']."','".$_POST['nickname']."','".$_POST['email']."','".$_POST['text']."',NOW(),'".$id."')";

      //  $sql = (isset($_POST['id'])) ? $sqlComment : $sqlArticle;
        $sql = (isset($id)) ? $sqlComment : $sqlArticle;

echo "<pre>id = ", var_dump($_POST['id']), "<pre/>";
echo "<pre>image = ", var_dump($_FILES['uploadfile']['name']), "<pre/>";
echo "<pre>", var_dump($sql), "<pre/>";
        return $params = $this->query($sql);
    }








    public function getArticle(){
$id = 3;
        $this->query( "SET CHARSET utf8" );
        //$sql = 'SELECT * FROM articles WHERE  id ='. (int) $id;
        $sql =
            " SELECT a.id, a.title, a.image, a.text, a.pubdate, a.author, c.count \n".
            " FROM articles a \n".
            " LEFT JOIN( \n".
            " SELECT COUNT(comments.articles_id) AS count, comments.articles_id \n".
            " FROM comments \n".
            " GROUP BY comments.articles_id \n".
            " ) c \n".
            " ON a.id = c.articles_id \n".
            " WHERE a.id =" . (int) $id;

        return  $params = $this->query($sql);
    }

    public function getCommentsForPublicationById($id){
$id = 3;
        $sql = 'SELECT * FROM comments WHERE articles_id =' . (int) $id . ' ORDER BY id DESC';
        return $params = $this->query($sql);
    }


}
?>