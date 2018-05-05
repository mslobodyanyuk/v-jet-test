<?php

namespace src\form;
use src\img\ImagePublicationUpload as ImagePublicationUpload;

/**
 * The class is designed to check the form filling
 */
class ArticleAndCommentFormSanitizer {

    const
    //article
        ARTICLE_MISSING_NAME_RU = "Введите имя!",
        ARTICLE_MISSING_IMAGE_RU = "Загрузите картинку!",
        ARTICLE_MISSING_TITLE_RU = "Введите название публикации!",
        ARTICLE_MISSING_TEXT_RU = "Введите текст публикации!",
    //comment
        COMMENT_MISSING_NAME_RU = "Введите имя!",
        COMMENT_MISSING_NICKNAME_RU = "Введите ник!",
        COMMENT_MISSING_EMAIL_RU = "Введите email!",
        COMMENT_MISSING_TEXT_RU = "Введите текст комментария!";

    /**
     * @return bool
     */
    public static function check()
    {
        $errors = array();

//article
        if (isset($_POST['do_post'])) {

            if ($_POST['name'] == '') {
                $errors[] = self::ARTICLE_MISSING_NAME_RU;
            }

            if (!ImagePublicationUpload::upload()){
                $errors[] = self::ARTICLE_MISSING_IMAGE_RU;
            }

            if ($_POST['title'] == '') {
                $errors[] = self::ARTICLE_MISSING_TITLE_RU;
            }

            if ($_POST['text'] == '') {
                $errors[] = self::ARTICLE_MISSING_TEXT_RU;
            }
        }
//comment
        if (isset($_POST['do_comment'])) {

            if ($_POST['name'] == '') {
                $errors[] = self::COMMENT_MISSING_NAME_RU;
            }

            if ($_POST['nickname'] == '') {
                $errors[] = self::COMMENT_MISSING_NICKNAME_RU;
            }

            if ($_POST['email'] == '') {
                $errors[] = self::COMMENT_MISSING_EMAIL_RU;
            }

            if ($_POST['text'] == '') {
                $errors[] = self::COMMENT_MISSING_TEXT_RU;
            }
        }

        if (!empty($errors)){
           // $params['post'] = $_POST;
            //$params['errors'] = $errors;
            $params = ($errors);
            return $params;
        }
        return false;
    }
}