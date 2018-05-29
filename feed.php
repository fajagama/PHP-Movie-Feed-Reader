<?php

abstract class Feed{

	private $url;
	private $returnArray = [];

	abstract public function getData();
	abstract protected function loadData();

	public function __construct($url)
	{
		$this->url = $url;
	}

	protected function getFullUrl(){
		return $this->url;
	}

	protected function addRow(string $title, string $description, array $images, array $genres, string $releaseDate){
		$this->returnArray[] = array("title" => $title, 
								"description" => $description,  
								"images" => $images,
								"genres" => $genres,  
								"releaseDate" => strtotime($releaseDate), 
								); 
	}

	protected function getArray() : array{
		return $this->returnArray;
	}

}