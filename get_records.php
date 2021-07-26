<?php

$file_1 = file_get_contents('https://jsonplaceholder.typicode.com/posts');
$file_2 = file_get_contents('https://jsonplaceholder.typicode.com/comments');

try
{
    $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    $db_connection = new PDO('mysql:host=localhost;port=3307;dbname=blog', 'root', '', $options);

    if($file_1 && $file_2)
    {
        $posts = json_decode($file_1);
        $comments = json_decode($file_2);
        $post_count = 0;
        $com_count = 0;
        $error = 0;

        $sql = 'insert into post (user_id, id, title, body) values (:userId, :id, :title, :body)';
        $statement = $db_connection->prepare($sql);

        foreach ($posts as $post)
        {
            $params = (array) $post;
            try
            {
                if ($statement->execute($params))
                    $post_count++;
            }
            catch (Exception $e)
            {
                $error++;
            }
        }

        $sql = 'insert into comment (post_id, id, name, email, body) values (:postId, :id, :name, :email, :body)';
        $statement = $db_connection->prepare($sql);

        foreach ($comments as $comment)
        {
            $params = (array) $comment;
            try
            {
                if ($statement->execute($params))
                    $com_count++;
            }
            catch (Exception $e)
            {
                $error++;
            }
        }

        echo ("Загружено $post_count записей и $com_count комментариев");
    }
}
catch (Exception $e)
{
    echo 'Не удалось подключиться к базе данных';
}
