<?php 
namespace App\Http\Controllers;
use DB;
use Auth;
use Request;
class ViewController extends BaseController
{
    public function index()
    {
        return view('pages.mainpage',['items' => $this->mainList($_SERVER['HTTP_ACCEPT_LANGUAGE']),'title' => 'OneEchan']);
    }
    public function detail($id)
    {
        $items = $this->detailItem($_SERVER['HTTP_ACCEPT_LANGUAGE'],$id);
        return view('pages.detail',['items' => $items, 'title' => $items[0]->Name]);
    }
    public function play($id,$filename)
    {
        $item = $this->playItem($_SERVER['HTTP_ACCEPT_LANGUAGE'],$id,$filename);
        $title = $item->Name.' - '.($filename);
        return view('pages.play', ['item' => $item, 'title' => $title, 'comments' => $this->getComments($_SERVER['HTTP_ACCEPT_LANGUAGE'],$id,$filename)]);
    }
    public function postComment($id,$filename)
    {
        $body = Request::get('body');
        $userid = Auth::user()->id;
        $status = $this->setComment($_SERVER['HTTP_ACCEPT_LANGUAGE'],$id,$filename,$userid,$body);
        return $this->play($id,$filename);
    }
    public function search()
    {
        $title = Request::get('title');
        return view('pages.mainpage',['items' => $this->searchItem($_SERVER['HTTP_ACCEPT_LANGUAGE'],$title),'title' => 'OneEchan - '.$title, 'searchText' => $title]);
    }
}
