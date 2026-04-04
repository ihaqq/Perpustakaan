<?php



namespace App\RepositoriesInterface;

interface KelasRepositoryInterface
{
    public function all();
    public function find($id);
    public function findById($id);     
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function getBooksWithQuery(array $params);
}
