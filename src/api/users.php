<?php

//Get all users
$app->get('/api/users',function(){
   $sql = "SELECT * FROM users";

    try{
        $db = Connect::getInstance();
        $stmt = $db->query($sql);
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        echo json_encode($users);
    }catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});

//Get one user
$app->get('/api/users/{id}',function($request){
   $id = $request->getAttribute('id');

    $sql = "SELECT * FROM users WHERE id = $id";

    try{
        $db = Connect::getInstance();
        $stmt = $db->query($sql);
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        echo json_encode($user);
    }catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});

//Add user
$app->post('/api/users/add',function($request){
    $first_name = $request->getParsedBody()['first_name'];
    $last_name = $request->getParsedBody()['last_name'];
    $email = $request->getParsedBody()['email'];
    $password = $request->getParsedBody()['password'];
    $avatar = $request->getParsedBody()['avatar'];

    $sql = "INSERT INTO users (first_name,last_name,email,password,avatar) VALUES (?,?,?,?,?)";

    try{
        $db = Connect::getInstance();

        $stmt = $db->prepare($sql);
        $stmt->bindValue(1,$first_name);
        $stmt->bindValue(2,$last_name);
        $stmt->bindValue(3,$email);
        $stmt->bindValue(4,$password);
        $stmt->bindValue(5,$avatar);
        $stmt->execute();

    }catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});

//Update user
$app->put('/api/users/update/{id}',function($request){
    $id = $request->getAttribute('id');
    $first_name = $request->getParsedBody()['first_name'];
    $last_name = $request->getParsedBody()['last_name'];
    $email = $request->getParsedBody()['email'];
    $password = $request->getParsedBody()['password'];
    $avatar = $request->getParsedBody()['avatar'];

    $sql = "UPDATE users SET first_name = ?, last_name = ?, email = ?, password = ?, avatar = ? WHERE id = $id";

    try{
        $db = Connect::getInstance();

        $stmt = $db->prepare($sql);
        $stmt->bindValue(1,$first_name);
        $stmt->bindValue(2,$last_name);
        $stmt->bindValue(3,$email);
        $stmt->bindValue(4,$password);
        $stmt->bindValue(5,$avatar);
        $stmt->execute();

    }catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});

//Delete user
$app->delete('/api/users/delete/{id}',function($request){
   $id = $request->getAttribute('id');

    $sql = "DELETE FROM users WHERE id = $id";

    try{
        $db = Connect::getInstance();

        $stmt = $db->prepare($sql);
        $stmt->execute();

    }catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});



















