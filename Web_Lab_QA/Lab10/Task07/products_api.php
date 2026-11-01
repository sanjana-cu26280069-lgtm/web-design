<?php
require_once __DIR__ . '/../shared/config/database.php';
header('Content-Type: application/json; charset=utf-8');
$method=$_SERVER['REQUEST_METHOD'];
try{
    if($method==='GET'){
        if(isset($_GET['id'])){$s=$pdo->prepare('SELECT * FROM products WHERE id=?');$s->execute([(int)$_GET['id']]);$data=$s->fetch();}
        else $data=$pdo->query('SELECT * FROM products')->fetchAll();
        echo json_encode($data); exit;
    }
    $input=json_decode(file_get_contents('php://input'),true) ?? [];
    if($method==='POST'){
        $s=$pdo->prepare('INSERT INTO products(name,category,price) VALUES(?,?,?)');
        $s->execute([$input['name']??'', $input['category']??'', $input['price']??0]);
        http_response_code(201); echo json_encode(['id'=>(int)$pdo->lastInsertId()]); exit;
    }
    if($method==='PUT'){
        $s=$pdo->prepare('UPDATE products SET name=?,category=?,price=? WHERE id=?');
        $s->execute([$input['name']??'', $input['category']??'', $input['price']??0, (int)($input['id']??0)]);
        echo json_encode(['updated'=>$s->rowCount()]); exit;
    }
    if($method==='DELETE'){
        $s=$pdo->prepare('DELETE FROM products WHERE id=?'); $s->execute([(int)($input['id']??0)]);
        echo json_encode(['deleted'=>$s->rowCount()]); exit;
    }
    header('Allow: GET, POST, PUT, DELETE'); http_response_code(405); echo json_encode(['error'=>'Method not allowed']);
}catch(Throwable $e){error_log($e->getMessage());http_response_code(500);echo json_encode(['error'=>'Server error']);}
