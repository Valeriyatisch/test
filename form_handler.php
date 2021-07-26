<?php

$value = $_POST['text'];

try
{
    $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    $db_connection = new PDO('mysql:host=localhost;port=3307;dbname=blog', 'root', '', $options);

    if(strlen($value) >= 3)
    {
        $sql = "select comment.body, post.title from comment inner join post on post.id = comment.post_id where comment.body like :text";

        $params = ['text' => '%' . $value . '%'];
        $statement = $db_connection->prepare($sql);
        $statement->execute($params);
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($data);
    }
    else echo '[]';
}
catch (Exception $e)
{
    echo json_encode("Не удалось подключиться к базе данных");
}




