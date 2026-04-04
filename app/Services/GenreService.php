<?php
namespace App\Services;

use App\Repositories\GenreRepository;

class GenreService
{
    protected $genreRepository;

    public function __construct(GenreRepository $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }
    public function getGenrePaginate(array $params)
    {
        $query = $this->genreRepository->getGenresWithQuery($params);
        
        return $query;
    }
    public function getGenreById($id)
    {
        return $this->genreRepository->find($id);
    }
    public function createGenre(array $data)
    {
        return $this->genreRepository->create($data);
    }
    public function updateGenre($id, array $data)
    {
        return $this->genreRepository->update($id, $data);
    }
    public function deleteGenre($id)
    {
        return $this->genreRepository->delete($id);
    }
}