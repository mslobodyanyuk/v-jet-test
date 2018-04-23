<title>v-jet test Blog</title>
<?php
/**
 * index - default
 * view/Blog/index.php - displays the result of the method index of controller in the BlogController
 */
use src\DB\DB as DB;
header('Content-Type: text/html; charset=utf-8');
$params = $controllerParams;

if( $params['listArticlesParams']['numberArticles'] > 0 ) {
    echo '<h1>Топ "' .  DB::NUMBER_MOST_POPULAR_POSTS . '" читаемых статей:</h1>';
     foreach($params['topPublications'] as $item) {
        echo '<div>';
            echo '<div>';
                 echo '<a href="/cart/' . $item['id'] . '"><h3>', $item['title'], '</h3></a>';
                 echo '<img src="/upl/images/' . $item['image'] . '"/>';
            echo '</div>';
            echo '<div>';
                  echo mb_substr(strip_tags($item['text']), 0, 100), '...';
            echo '</div>';
        echo '</div>';
     }

    echo '<h1>Список публикаций в блог:</h1>';
    echo "<hr>";
    foreach($params['listArticlesParams']['articles'] as $item) {
        echo '<div>';
            echo '<div>';
                echo "<h2>", $item['title'], "</h2>";
                echo '<img src="/upl/images/' . $item['image'] . '"/>';
            echo '</div>';
            echo '<div>';
                echo mb_substr(strip_tags($item['text']), 0, 100), '...';
                echo "<br/>кол-во просмотров: ", $item['views'];
                echo "<br/>автор: ", $item['author'];
                echo "<br/>дата публикации: ", date('d.m.Y', strtotime($item['pubdate'])), "<br/>";
                echo "комментариев: ", $item['count'];
            echo '</div>';
            echo '<div>';
                echo '<a href="/cart/' . $item['id'] . '">Читать больше</a>';
            echo '</div>';
        echo '</div>';
    echo "<hr>";
    }

    //paginator
        echo '<div  class="paginator">';
            if($params['listArticlesParams']['page'] > 1) {
                echo '<a href="/page/' . ($params['listArticlesParams']['page'] - 1) . '">&laquo; Предыдущая страница </a>';
            }

            if($params['listArticlesParams']['page'] < $params['listArticlesParams']['totalPages'] ) {
                echo '<a href="/page/' . ($params['listArticlesParams']['page'] + 1) . '"> Следующая страница &raquo;</a>';
            }
        echo '</div>';
 }else{
        echo '<span style="color: red;font-weight: bold"><h3>Нет публикаций.</h3></span>';
 }
    //paginator
?>

<div id="article-add-form">
    <h3>Добавить статью</h3>
<form action="/upload" method="post" enctype="multipart/form-data">
    <div>
        <input type="text" name="name" placeholder="Имя">
    </div>
    <div>
        Изображение
        <input type="file" name="uploadfile">
    </div>
    <div>
        <input type="text" name="title" placeholder="Название публикации">
    </div>
    <div>
        <textarea name="text" placeholder="Текст публикации ..."></textarea>
    </div>
    <div>
        <input type="submit" name="do_post" value="Добавить публикацию">
    </div>
</form>
