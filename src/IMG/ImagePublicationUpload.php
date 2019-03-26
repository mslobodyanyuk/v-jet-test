<?php

namespace src\IMG;
use config;

/**
 * The class is designed to load images into an article
 */
class ImagePublicationUpload {
    /**
     * @return bool
     */
    public static function upload()
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
                return false;
            }

            return true;
        }
        return false;
    }
}