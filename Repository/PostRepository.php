<?php
require_once("Repository.php");
require_once(realpath(dirname(__FILE__) . '/../Models/Post.php'));
class PostRepository extends Repository
{
    function like($userId, $postId)
    {
        $wasSuccessful = FALSE;
        if(!$this->hasBeenRated($userId, $postId))
        {
            $sql = "UPDATE posts SET rating = rating + 1 WHERE postId = '".$postId."'";
            if ($this->conn->query($sql) === TRUE) 
            {
                $wasSuccessful = TRUE;
            } 
            else 
            {
                echo "Error updating record: " . $conn->error;
            }
            $sql = "INSERT INTO postsrating (userId, postId) VALUES ('".$userId."', '".$postId."')";
            $this->conn->query($sql);
        }
        else
        {
            #If the person has already liked the post 
            $sql = "UPDATE posts SET rating = rating - 1 WHERE postId = '".$postId."'";
            if ($this->conn->query($sql) === TRUE) 
            {
                $wasSuccessful = TRUE;
            } 
            else 
            {
                echo "Error updating record: " . $conn->error;
            }
            $sql = "DELETE FROM postsrating WHERE userId = '".$userId."' AND postId = '".$postId."'";
            $this->conn->query($sql);
        }
        return $wasSuccessful;
    }
    function dislike($userId, $postId)
    {
        $wasSuccessful = FALSE;
        if(!$this->hasBeenRated($userId, $postId))
        {
            #If the person has not liked the post
            $sql = "UPDATE posts SET rating = rating - 1 WHERE postId = '".$postId."'";
            if ($this->conn->query($sql) === TRUE) 
            {
                $wasSuccessful = TRUE;
            } 
            else 
            {
                echo "Error updating record: " . $conn->error;
            }
            $sql = "INSERT INTO postsrating (userId, postId) VALUES ('".$userId."', '".$postId."')";
            $this->conn->query($sql);
        }
        else
        {
            #If the person has already liked the post 
            $sql = "UPDATE posts SET rating = rating + 1 WHERE postId = '".$postId."'";
            if ($this->conn->query($sql) === TRUE) 
            {
                $wasSuccessful = TRUE;
            } 
            else 
            {
                echo "Error updating record: " . $conn->error;
            }
            $sql = "DELETE FROM postsrating WHERE userId = '".$userId."' AND postId = '".$postId."'";
            $this->conn->query($sql);
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
    function getSinglePost($postId)
    {
        $sql = "SELECT content, timestamp, rating FROM posts WHERE postId = '".$postId."'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
            {
                $post = new Post();
                $post->Content = $row["content"];
                $post->PostDate = $row["timestamp"];
                $post->Rating = $row["rating"];
            }
        } 
        else 
        {
            echo "Error getting posts: " . $conn->error;
        }
        return $post;
    }
    function hasBeenRated($userId, $postId)
    {
        $hasBeenRated = FALSE; 
        $sql = "SELECT * FROM postsrating WHERE userId = '".$userId."' AND postId = '".$postId."'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) 
        {
            $hasBeenRated = TRUE;
        } 
        else 
        {
            #echo "Error getting posts: " . $conn->error;
        }
        return $hasBeenRated;
    }
    function getNewsfeed($idArray)
    {
        $postArray = array();
        $sql = "SELECT userId, postId, content, timestamp, rating FROM posts WHERE ";
        foreach($idArray as $id)
        {
            $sql .= "userId = '";
            $sql .= $id;
            $sql .= "' OR ";
        }
        $sql = chop($sql);
        $sql .= "DER BY timestamp";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
            {
                $post = new Post();
                $post->UserId = $row["userId"];
                $post->PostId = $row["postId"];
                $post->Content = $row["content"];
                $post->PostDate = $row["timestamp"];
                $post->Rating = $row["rating"];
                $postArray[] = $post;
            }
        } 
        else {
            //echo "Error getting posts: " . $conn->error;
        }
        return $postArray;
    }
}

?>