<?php
namespace src\controller;
error_reporting(E_ALL & ~(E_NOTICE| E_WARNING ));

use config;
use src\DB\DB as DB;

/**
 * Class Controller, the controller performs Actions.
 */
class BlogController {

    /**
     * @return mixed
     */
    public function indexAction() {
        $db = new DB;
        $params['top_publications'] = $db->getTopPublications();
        $params['list_articles_params'] = $db->getPageListPublications($page = null);
        return $params;
	}

    /**
     * @param $page
     * @return mixed
     */
    public function pageAction($page) {
        $db = new DB;
        $params['top_publications'] = $db->getTopPublications();
        $params['list_articles_params'] = $db->getPageListPublications($page);
        return $params;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function cartAction($id) {
        $db = new DB;
        $params['article'] = $db->getArticle($id);
        $params['comments'] = $db->getCommentsForPublicationById($id);
        return $params;
    }

    /**
     * @param $id
     * @return array|bool
     */
    public function uploadAction($id) {
        $db = new DB;
        $errors = $db->checkPostErrors();
        return (!empty($errors)) ? $errors : $db->postPublication($id);
    }

}