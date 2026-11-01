<?php
final class Database {
    private static ?PDO $connection=null;
    private function __construct() {}
    public static function connection(): PDO {
        if(self::$connection===null){
            $dsn='mysql:host=127.0.0.1;dbname=webapp_db;charset=utf8mb4';
            self::$connection=new PDO($dsn,'webapp_user','CHANGE_ME',[
                PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES=>false
            ]);
        }
        return self::$connection;
    }
}
final class ProductModel {
    public function __construct(private PDO $db) {}
    public function all(): array { return $this->db->query('SELECT * FROM products ORDER BY id DESC')->fetchAll(); }
    public function find(int $id): array|false {
        $s=$this->db->prepare('SELECT * FROM products WHERE id=?'); $s->execute([$id]); return $s->fetch();
    }
    public function create(string $name,string $category,float $price): int {
        $s=$this->db->prepare('INSERT INTO products(name,category,price) VALUES(?,?,?)');
        $s->execute([$name,$category,$price]); return (int)$this->db->lastInsertId();
    }
    public function update(int $id,string $name,string $category,float $price): bool {
        $s=$this->db->prepare('UPDATE products SET name=?,category=?,price=? WHERE id=?');
        return $s->execute([$name,$category,$price,$id]);
    }
    public function delete(int $id): bool {
        $s=$this->db->prepare('DELETE FROM products WHERE id=?'); return $s->execute([$id]);
    }
}
