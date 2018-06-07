<?php

namespace src\db;

use config;
use Exception;

/**
 * The class implements interaction with the blog database, methods that use queries
 */
class BlogPublicationsQueries {

    const
        NUMBER_MOST_POPULAR_POSTS = 5,
        ARTICLES_PER_PAGE = 4;

    /**
     * @return array
     * @throws Exception
     */
    public function getTopPublications(){
        $db = new DB();
        $db->query( "SET CHARSET utf8" );
        $sql = 'SELECT * FROM articles ORDER BY views DESC LIMIT ' . self::NUMBER_MOST_POPULAR_POSTS;
        return $params = $db->query($sql);
    }

    /**
     * @param string $page
     * @return mixed
     * @throws Exception
     */
    public function getPageListPublications($page){
        $db = new DB();
        $db->query( "SET CHARSET utf8" );

        $page = (isset($page)) ? (int) $page : 1;

        $numberArticles = $db->query( "SELECT COUNT(id) AS numberArticles FROM articles" );
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
        $params['articles'] = $db->query($sql);

        return $params;
    }

    /**
     * @param string $id
     * @return array
     * @throws Exception
     */
    public function postPublication($id)
    {
        $db = new DB();
        $db->query( "SET CHARSET utf8" );
        $sqlArticle = "INSERT INTO articles ( author, title, image, text, pubdate ) VALUES ('".$_POST['name']."','".$_POST['title']."','".$_FILES['uploadfile']['name']."','".$_POST['text']."',NOW())";
        $sqlComment = "INSERT INTO comments ( author, nickname, email, text, pubdate, articles_id ) VALUES ('".$_POST['name']."','".$_POST['nickname']."','".$_POST['email']."','".$_POST['text']."',NOW(),'".$id."')";
        $_POST = '';
        $sql = (isset($id)) ? $sqlComment : $sqlArticle;
        return $params = $db->query($sql);
    }

    /**
     * @param string $id
     * @return array
     * @throws Exception
     */
    public function getArticle($id){
        $db = new DB();
        $db->query( "UPDATE articles SET views = views + 1 WHERE id = " . (int) $id );
        $db->query( "SET CHARSET utf8" );
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
        return  $params = $db->query($sql);
    }

    /**
     * @param string $id
     * @return array
     * @throws Exception
     */
    public function getCommentsForPublicationById($id){
        $db = new DB();
        $db->query( "SET CHARSET utf8" );
        $sql = 'SELECT * FROM comments WHERE articles_id =' . (int) $id . ' ORDER BY id DESC';
        return $params = $db->query($sql);
    }

}
