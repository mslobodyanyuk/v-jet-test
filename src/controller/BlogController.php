<?php
namespace src\controller;
error_reporting(E_ALL & ~(E_NOTICE| E_WARNING ));
//error_reporting(E_ALL);

use config;
use src\DB\DB as DB;

/**
 * Class Controller, the controller performs Actions.
 */
class BlogController {

    /**
     * Method (Action) indexAction() of controller is executed by default
     */
	public function indexAction() {
        $configParams = new config\Conf();
        $databaseParameters = $configParams -> getConfigParameters();
        $db = new DB($databaseParameters['host'], $databaseParameters['name'], $databaseParameters['password'], $databaseParameters['database']);

        $params['top_publications'] = $db->getTopPublications();
        $params['articles'] = $db->getListPublications();
        return $params;
	}

    public function uploadAction() {
        $configParams = new config\Conf();
        $databaseParameters = $configParams -> getConfigParameters();
        $db = new DB($databaseParameters['host'], $databaseParameters['name'], $databaseParameters['password'], $databaseParameters['database']);



        $uplPath = $configParams -> getUploadFileParameters();
        $parameters = $configParams -> getUploadFileParameters('fileUploadParameters');

        $uplTempNamePath = $parameters['uplTempNamePath'];
        $uplNamePath = $parameters['uplNamePath'];

        if (is_uploaded_file($uplTempNamePath)) {
            $uploadfile = $uplPath . basename($uplNamePath);
            copy($uplNamePath, $uploadfile);

echo "<pre>uploadfile = ", var_dump($uploadfile), "<pre/>";
echo "<pre>uplNamePath = ", var_dump($uplNamePath), "<pre/>";

            if (!$handle = fopen($uploadfile, 'a')) {
                echo "Can't open file($uploadfile)";
                exit;
            }
        }

        return $params = $db->postPublication();
    }


	public function cartAction() {
        $configParams = new config\Conf();
        $databaseParameters = $configParams -> getConfigParameters();
        $db = new DB($databaseParameters['host'], $databaseParameters['name'], $databaseParameters['password'], $databaseParameters['database']);

        $params['article'] = $db->getArticle();
$id = 3;
        $params['comments'] = $db->getCommentsForPublicationById($id);

        return $params;
	}


	
}