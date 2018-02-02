<?php

//get all books
$app->get('/api/books',function(){

   $sql = "SELECT * FROM books";

    try{
        $db = Connect::getInstance();

        $stmt = $db->query($sql);
        $books = $stmt->fetchAll(PDO::FETCH_OBJ);
        echo json_encode($books);


    }catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});

//get one book
$app->get('/api/books/{id}', function($request){
   $id = $request->getAttribute('id');

    $sql = "SELECT * FROM books WHERE id = $id";

    try{
        $db = Connect::getInstance();

        $stmt = $db->query($sql);
        $book = $stmt->fetch(PDO::FETCH_OBJ);
        echo json_encode($book);

    }catch(PDOException $e){
        echo '{"error":{"text": '.$e->getMessage().'}}';
    }
});

//Add book
$app->post('/api/books/add', function($request){
        $book_title = $request->getParsedBody()['book_title'];
        $author = $request->getParsedBody()['author'];
        $amazon_url = $request->getParsedBody()['amazon_url'];

   $sql = "INSERT INTO books (book_title, author, amazon_url) VALUES (?,?,?)";

    try{
        $db = Connect::getInstance();

        $stmt = $db->prepare($sql);
        $stmt->bindValue(1,$book_title);
        $stmt->bindValue(2,$author);
        $stmt->bindValue(3,$amazon_url);


        $stmt->execute();


    }catch(PDOException $e){
        echo '{"error":{"text": '.$e->getMessage().'}}';
    }

});

//Update book
$app->put('/api/books/update/{id}', function($request){
    $id = $request->getAttribute('id');
    $book_title = $request->getParsedBody()['book_title'];
    $author = $request->getParsedBody()['author'];
    $amazon_url = $request->getParsedBody()['amazon_url'];

    $sql = "UPDATE books SET book_title = ?, author = ?, amazon_url = ? WHERE id = $id";

    try{
        $db = Connect::getInstance();

        $stmt = $db->prepare($sql);
        $stmt->bindValue(1,$book_title);
        $stmt->bindValue(2,$author);
        $stmt->bindValue(3,$amazon_url);

        $stmt->execute();


    }catch(PDOException $e){
        echo '{"error":{"text": '.$e->getMessage().'}}';
    }
});

//Delete book
$app->delete('/api/books/delete/{id}', function($request){
   $id = $request->getAttribute('id');

    $sql = "DELETE FROM books WHERE id = $id";

    try{
        $db = Connect::getInstance();

        $stmt = $db->prepare($sql);
        $stmt->execute();


    }catch(PDOException $e){
        echo '{"error":{"text": '.$e->getMessage().'}}';
    }
});













