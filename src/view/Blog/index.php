<title>v-jet test Blog</title>
<?php
use src\DB\DB as DB;
header('Content-Type: text/html; charset=utf-8');
/** Index - default
 * view/Blog/index.php - displays the result of the method index of controller in the BlogController
 */
$params = $controllerParams;
echo '<h1>Топ "' .  DB::NUMBER_MOST_POPULAR_POSTS . '" читаемых статей:</h1>';
//echo "<pre>", var_dump($params['top_publications']), "<pre/>";
 foreach($params['top_publications'] as $item) {
    echo '<div>';
        echo '<div>';
             echo '<a href="/cart?id=' . $item['id'] . '"><h3>', $item['title'], '</h3></a>';//ссылка на статью, должно переходить на статью при нажатии на названии статьи как и "Читать больше"
             echo '<img src="/upl/images/' . $item['image'] . '"/>';
        echo '</div>';
        echo '<div>';
              echo mb_substr(strip_tags($item['text']), 0, 100), '...';
        echo '</div>';
    echo '</div>';
 }

//echo "<pre>", var_dump($params['articles']), "<pre/>";

echo '<h1>Список публикаций в блог:</h1>';
echo "<hr>";
foreach($params['articles'] as $item) {
    echo '<div>';
        echo '<div>';
            echo "<h2>", $item['title'], "</h2>";
            echo '<img src="/upl/images/' . $item['image'] . '"/>';
        echo '</div>';
        echo '<div>';
            echo mb_substr(strip_tags($item['text']), 0, 100), '...';
            echo "<br/>автор: ", $item['author'];
            echo "<br/>дата публикации: ", date('d.m.Y', strtotime($item['pubdate'])), "<br/>";
            echo "комментариев: ", $item['count'];
        echo '</div>';
        echo '<div>';
            echo '<a href="/cart.php?id=' . $item['id'] . '">Читать больше</a>';//ссылка на статью, должно переходить на статью при нажатии на "Читать больше"
        echo '</div>';
    echo '</div>';
echo "<hr>";
}
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
        <input type="submit" value="Добавить публикацию">
    </div>
</form>


