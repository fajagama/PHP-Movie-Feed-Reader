<?php

include_once 'feed.php';
include_once 'config.php';

abstract class Json extends Feed
{
	public function __construct(string $url, string $lang, string $other = null)
	{
		parent::__construct("https://api.themoviedb.org/3/" . $url . "?api_key=" . API_KEY . "&language=" . $lang . $other);
	}

	protected function loadData() {
		$json = file_get_contents(parent::getFullUrl());
		return json_decode($json);
	}
}


class JsonMovie extends Json
{	
	private $genres = null;

	public function __construct(int $page = 1, string $lang = "en-US")
	{
		parent::__construct("movie/popular", $lang, "&page=". $page);
		$this->genres = new JsonGenre($lang);
	}

	public function getData() : array
	{
		$this->getMovies();
		if(is_null(parent::getArray()))
			return array("chyba"); 
		else
			return parent::getArray();
	}

	private function getMovies(){
		$obj = parent::loadData();

		foreach ($obj->results as $key => $value) {
			$images = array($value->poster_path, $value->backdrop_path);

			parent::addRow($value->title, 
					$value->overview, 
					$images, 
					$this->getGenres($value->genre_ids), 
					$value->release_date);			
		}
	}

	private function getGenres(array $genres) : array{
		$returnArray = [];
		
		foreach ($genres as $key => $value) {
			$returnArray[] = $this->findGenre($this->genres->getData(), $value);
		}

		return $returnArray;
	}

	private function findGenre(array $genres, int $id) : string{
		$var = array_filter($genres, function($item) use ($id){
			return $item->id == $id;
		});
		return current($var)->name;
	}
}

class JsonGenre extends Json
{
	private $data = null;

	public function __construct(string $lang = "en-US")
	{
		parent::__construct("genre/movie/list", $lang);
		$this->data = parent::loadData()->genres;
	}

	public function getData() : array{
		if(is_null($this->data))
			return array("chyba"); 
		else
			return $this->data;
	}
}