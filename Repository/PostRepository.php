<?php
require_once("Repository.php");
require_once(realpath(dirname(__FILE__) . '/../Models/Post.php'));
class PostRepository extends Repository
{
    function like($postId)
    {
        $wasSuccessful = FALSE;
        $sql = "UPDATE posts SET rating = rating + 1 WHERE postId = '".$postId."'";
        if ($this->conn->query($sql) === TRUE) {
            $wasSuccessful = TRUE;
        } else {
            echo "Error updating record: " . $conn->error;
        }
        return $wasSuccessful;
    }
    function dislike($postId)
    {
        $wasSuccessful = FALSE;
        $sql = "UPDATE posts SET rating = rating - 1 WHERE postId = '".$postId."'";
        if ($this->conn->query($sql) === TRUE) {
            $wasSuccessful = TRUE;
        } else {
            echo "Error updating record: " . $conn->error;
        }
        return $wasSuccessful;
    }
    function getUserPosts($userId)
    {
        $postArray = array();
        $sql = "SELECT postId, content, timestamp, rating FROM posts WHERE userId = '".$userId."'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
            {
                $post = new Post();
                $post->UserId = $userId;
                $post->PostId = $row["postId"];
                $post->Content = $row["content"];
                $post->PostDate = $row["timestamp"];
                $post->Rating = $row["rating"];
                $postArray[] = $post;
            }
        } 
        else {
            return $postArray;
        }
        $postArray = array_reverse($postArray);
        return $postArray;
    }
    function addPost($userId, $content)
    {
        $content = trim($content);
        $content = str_replace("'","",$content);
        $sql = "INSERT INTO posts (userId, content) VALUES ('".$userId."', '".$content."')";
        if (mysqli_query($this->conn, $sql)) {
            return TRUE;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
        }
    }
    function removePost($postId)
    {
        $wasSuccessful = FALSE;
        $sql = "DELETE FROM posts WHERE postId = '".$postId."'";
        if ($this->conn->query($sql) === TRUE) {
            $wasSuccessful = TRUE;
        } else {
            echo "Error removing record: " . $conn->error;
        }
        return $wasSuccessful;
    }
    function editPost($postId, $content)
    {
        $wasSuccessful = FALSE;
        $content = trim($content);
        $content = str_replace("'","",$content);
        $sql = "UPDATE posts SET content = '".$content."' WHERE postId = ".$postId;
        if ($this->conn->query($sql) === TRUE) {
            $wasSuccessful = TRUE;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
        }
        return $wasSuccessful;
    }
    function getSinglePost($userId, $postId)
    {

    }

}

?>