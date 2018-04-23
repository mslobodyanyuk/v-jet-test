<title>view cart</title>
<?php
/**
 * cart
 * view/Blog/cart.php - displays the result of the method cart of controller in the BlogController
 */
header('Content-Type: text/html; charset=utf-8');
$params = $controllerParams;

echo "<h1>", $params['article'][0]['title'], "</h1>";
    echo '<div>';
        echo "кол-во просмотров: ", $params['article'][0]['views'], "<br/>";
        echo "автор: ", $params['article'][0]['author'], "<br/>";
        echo "дата публикации: ", date('d.m.Y', strtotime($params['article'][0]['pubdate'])), "<br/>";
        echo "комментариев: ", $params['article'][0]['count'], "<br/>";
    echo '</div>';
    echo '<div>';
         echo '<img src="/upl/images/' . $params['article'][0]['image'] . '"/>';
    echo '</div>';
    echo '<div>';
         echo strip_tags($params['article'][0]['text']);
    echo '</div>';

echo '<h2>Список комментариев к статье:</h2>';
echo "<hr>";
foreach($params['comments'] as $item) {
    echo '<div>';
        echo "автор: ", $item['author'], "<br/>";
        echo "nickname: ", $item['nickname'], "<br/>";
        echo "email: ", $item['email'], "<br/>";
    echo '</div>';
        echo "дата: ", date('d.m.Y', strtotime($item['pubdate']));
    echo '<div>';
        echo " <h3>комментарий: " . $item['text'], "</h3>";
    echo '</div>';
echo "<hr>";
}
?>

<div id="article-add-form">
    <h3>Добавить комментарий</h3>
    <form action="/upload/<?php echo $params['article'][0]['id'] ?>" method="post" enctype="multipart/form-data">
        <div>
            <input type="text" name="name" placeholder="Имя">
            <input type="text" name="nickname" placeholder="nickname">
            <input type="text" name="email" placeholder="email">
        </div>
        <div>
            <textarea name="text" placeholder="Текст комментария ..."></textarea>
        </div>
        <div>
            <input type="submit" name="do_comment" value="Добавить комментарий">
        </div>
    </form>
</div>

<a href="/">&laquo Вернуться на главную</a>