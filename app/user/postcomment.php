<?php
session_start();
if (isset($_POST['comment'], $_GET['id'])) {
    $postId = $_GET['id'];
    if (isset($_SESSION['user'])) {

        $content = $_POST['comment'];
        $userId = $_SESSION['user']['id'];




        $pdo = new PDO('sqlite:../database/hacker.sqlite');

        $statement = $pdo->prepare('INSERT INTO Comments(post_id, content, user_id)
    VALUES(:postId, :content, :userId)');


        $statement->bindparam(':content', $content, PDO::PARAM_STR);
        $statement->bindparam(':userId', $userId, PDO::PARAM_INT);
        $statement->bindparam(':postId', $postId, PDO::PARAM_INT);

        $statement->execute();

        header("Location: /views/post.php?id=" . $postId);
    } else {
        header("Location: /views/login.php");
    }
}
