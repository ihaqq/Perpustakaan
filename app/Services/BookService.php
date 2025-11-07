<?php
namespace App\Services;

use App\Repositories\BookRepositoryInterface;

class BookService
{
    protected $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }
    public function getAllBooks()
    {
        return $this->bookRepository->all();
    }

    public function createBook(array $data)
    {
        return $this->bookRepository->create($data);
    }

    
}
