<title>view upload</title>
<?php
/**
 * upload
 * view/Blog/upload.php - displays the result of the method upload of controller in the BlogController
 */
header('Content-Type: text/html; charset=utf-8');
$params = $controllerParams;

echo (!empty($params['errors'])) ? '<span style="color: red;font-weight: bold"><h3>' . $params['errors'][0] . '</h3></span><br />' : '<span style="color: green;font-weight: bold"><h3>Статья или комментарий успешно добавлен.</h3></span><br />';
?>

<a href="/">&laquo Вернуться на главную</a>