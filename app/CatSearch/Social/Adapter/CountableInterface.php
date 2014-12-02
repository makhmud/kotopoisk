<?php
namespace CatSearch\Social\Adapter;


interface CountableInterface {

    public function getSharedCount($url);

    public function buildSharedCountRequest($url);

    public function proceedSharedCountResponse($url);

} 