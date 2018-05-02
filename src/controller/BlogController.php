<?php
namespace src\controller;
error_reporting(E_ALL & ~(E_NOTICE| E_WARNING ));

use config;
use src\db\BlogPublicationsQueries as BlogPublicationsQueries;
use src\form\ArticleAndCommentFormSanitizer as ArticleAndCommentFormSanitizer;

/**
 * Class Controller, the controller performs Actions.
 */
class BlogController {

    /**
     * @return mixed
     */
    public function indexAction() {
        $db = new BlogPublicationsQueries;
        $params['topPublications'] = $db->getTopPublications();
        $params['listArticlesParams'] = $db->getPageListPublications($page = null);
        return $params;
	}

    /**
     * @param string $page
     * @return mixed
     */
    public function pageAction($page) {
        $db = new BlogPublicationsQueries;
        $params['topPublications'] = $db->getTopPublications();
        $params['listArticlesParams'] = $db->getPageListPublications($page);
        return $params;
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function cartAction($id) {
        $db = new BlogPublicationsQueries;
        $params['article'] = $db->getArticle($id);
        $params['comments'] = $db->getCommentsForPublicationById($id);
        return $params;
    }

    /**
     * @param string $id
     * @return array|bool
     */
    public function uploadAction($id) {
        $db = new BlogPublicationsQueries;
        $errors = ArticleAndCommentFormSanitizer::check();
        return (!empty($errors)) ? $errors : $db->postPublication($id);
    }

}