<?php

namespace src\DB;

use config;
use Exception;

/**
 * The class implements interaction with the database, methods that use queries
 */
class DB {

    const
        NUMBER_MOST_POPULAR_POSTS = 5,
        ARTICLES_PER_PAGE = 4;

    private $host;
    private $name;
    private $password;
    private $database;
    public $db;
    public $query;

    /**
     * @throws Exception
     */
    public function __construct ()
    {
        $configParams = new config\Conf();
        $databaseParameters = $configParams -> getConfigParameters();

        $this->host=$databaseParameters['host'];
        $this->name=$databaseParameters['name'];
        $this->password=$databaseParameters['password'];
        $this->database=$databaseParameters['database'];

        if (!($this->db=mysqli_connect($this->host,$this->name,$this->password))){
            throw new Exception ("Can't connect to the server.");
        }
        if (!mysqli_select_db($this->db, $this->database)){
            throw new Exception ("Can't connect to DB.");
        }
        return $this->db;
    }

    /**
     * @param $sqlQuery
     * @param string $getType
     * @return array
     * @throws Exception
     */
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

    /**
     * @return array
     * @throws Exception
     */
    public function getTopPublications(){
        $this->query( "SET CHARSET utf8" );
        $sql = 'SELECT * FROM articles ORDER BY views DESC LIMIT ' . self::NUMBER_MOST_POPULAR_POSTS;
        return $params = $this->query($sql);
    }

    /**
     * @param $page
     * @return mixed
     * @throws Exception
     */
    public function getPageListPublications($page){
        $this->query( "SET CHARSET utf8" );

        $page = (isset($page)) ? (int) $page : 1;

        $numberArticles = $this->query( "SELECT COUNT(id) AS numberArticles FROM articles" );
        $numberArticles = $numberArticles[0]['numberArticles'];

        $totalPages = ceil($numberArticles/self::ARTICLES_PER_PAGE );
        $page = (( $page <= 0 || $page > $totalPages )) ? 1 : $page;
        $offset = (self::ARTICLES_PER_PAGE * $page) - self::ARTICLES_PER_PAGE;

        $sql =
            " SELECT a.id, a.title, a.image, a.text, a.pubdate, a.author, a.views, c.count \n".
            " FROM articles a \n".
            " LEFT JOIN( \n".
            " SELECT COUNT(comments.articles_id) AS count, comments.articles_id \n".
            " FROM comments \n".
            " GROUP BY comments.articles_id \n".
            " ) c \n".
            " ON a.id = c.articles_id \n".
            " ORDER BY a.id DESC \n".
            " LIMIT $offset, " . self::ARTICLES_PER_PAGE;

        $params['numberArticles'] = $numberArticles;
        $params['page'] = $page;
        $params['totalPages'] = $totalPages;
        $params['articles'] = $this->query($sql);

        return $params;
    }

    /**
     * @return bool
     */
    public function imagePublicationUpload()
    {
        $configParams = new config\Conf();
        $uplPath = $configParams->getUploadFileParameters();
        $parameters = $configParams->getUploadFileParameters('fileUploadParameters');

        $uplTempNamePath = $parameters['uplTempNamePath'];
        $uplNamePath = $parameters['uplNamePath'];

        if (is_uploaded_file($uplTempNamePath)) {
            $uploadFile = $uplPath . basename($uplNamePath);
            copy($uplNamePath, $uploadFile);

            if (!$handle = fopen($uploadFile, 'a')) {
                echo "Can't open file($uploadFile)";
                exit;
            }
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function checkPostErrors()
    {
        $errors = array();
//article
        if (isset($_POST['do_post'])) {

            if ($_POST['name'] == '') {
                $errors[] = "Введите имя!";
            }

            if (!$this->imagePublicationUpload()){
                $errors[] = "Загрузите картинку!";
            }

            if ($_POST['title'] == '') {
                $errors[] = "Введите название публикации!";
            }

            if ($_POST['text'] == '') {
                $errors[] = "Введите текст публикации!";
            }
        }
//comment
        if (isset($_POST['do_comment'])) {

            if ($_POST['name'] == '') {
                $errors[] = "Введите имя!";
            }

            if ($_POST['nickname'] == '') {
                $errors[] = "Введите ник!";
            }

            if ($_POST['email'] == '') {
                $errors[] = "Введите email!";
            }

            if ($_POST['text'] == '') {
                $errors[] = "Введите текст комментария!";
            }
        }

        if (!empty($errors)){
            $params['post'] = $_POST;
            $params['errors'] = $errors;
            return $params;
        }
        return false;
    }

    /**
     * @param $id
     * @return array
     * @throws Exception
     */
    public function postPublication($id)
    {
        $this->query( "SET CHARSET utf8" );
        $sqlArticle = "INSERT INTO  articles ( author, title, image, text, pubdate ) VALUES ('".$_POST['name']."','".$_POST['title']."','".$_FILES['uploadfile']['name']."','".$_POST['text']."',NOW())";
        $sqlComment = "INSERT INTO  comments ( author, nickname, email, text, pubdate, articles_id ) VALUES ('".$_POST['name']."','".$_POST['nickname']."','".$_POST['email']."','".$_POST['text']."',NOW(),'".$id."')";
        $sql = (isset($id)) ? $sqlComment : $sqlArticle;
        return $params = $this->query($sql);
    }

    /**
     * @param $id
     * @return array
     * @throws Exception
     */
    public function getArticle($id){
        $this->query( "UPDATE articles SET views = views + 1 WHERE id = " . (int) $id );
        $this->query( "SET CHARSET utf8" );
        $sql =
            " SELECT a.id, a.title, a.image, a.text, a.pubdate, a.author, a.views, c.count \n".
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

    /**
     * @param $id
     * @return array
     * @throws Exception
     */
    public function getCommentsForPublicationById($id){
        $sql = 'SELECT * FROM comments WHERE articles_id =' . (int) $id . ' ORDER BY id DESC';
        return $params = $this->query($sql);
    }

}
?>