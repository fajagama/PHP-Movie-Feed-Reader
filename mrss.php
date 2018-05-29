<?php

include_once 'feed.php';

class Mrss extends Feed
{
	private $url = "http://link.brightcove.com/services/mrss/player835199013001/835233035001/new";

    public function __construct()
    {
        parent::__construct("http://link.brightcove.com/services/mrss/player835199013001/835233035001/new");
    }

    public function getData() : array
    {
        $this->getMovies();
        if(is_null(parent::getArray()))
            return array("chyba"); 
        else
            return parent::getArray();
    }

    protected function getMovies(){
		$obj = $this->loadData();

		foreach ($obj as $key => $value) {
            parent::addRow($value->title, 
                    $value->description, 
                     $this->getImages($value->children('media', 'http://search.yahoo.com/mrss/')->thumbnail), 
                    [], 
                    $value->pubDate);  
		}
    }

    private function getImages($images) : array{
    	$array = [];
    	foreach($images as $thumb) {
	      	$array[] = (string)$thumb->attributes()->url;
	    }
    	return $array;
    }

    protected function loadData() {
    	$rss = simplexml_load_file(parent::getFullUrl());
    	return $rss->channel->item;
    }
}
