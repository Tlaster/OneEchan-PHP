<?php 
namespace App\Http\Controllers;
use DB;
use App\Comment;

abstract class BaseController extends Controller
{
    private $pageCount = 40;
    protected function getLangName($prefLang)
    {
        $lang = strtolower(substr($prefLang, 0, 2));
        if ($lang == 'en') {
            $lang = 'Name';
        } else if ($lang == 'zh') {
            $lang = 'CName';
        } else if ($lang == 'ru') {
            $lang = 'RName';
        } else {
            $lang = 'JName';
        }
        return $lang;
    }
    protected function getLang($prefLang)
    {
        $lang = strtolower(substr($prefLang, 0, 2));
        if ($lang == 'jp') {
            $lang = 'JP';
        } else if ($lang == 'zh') {
            $lang = 'ZH';
        } else if ($lang == 'ru') {
            $lang = 'RU';
        } else {
            $lang = 'EN';
        }
        return $lang;
    }
    public function mainList($prefLang)
    {
        $lang = $this->getLangName($prefLang);
        $items = DB::connection('sqlsrv')->table('AnimateList')
                ->select('ID',$lang.' as Name','Name as EN','JName as JP','LastUpdate')
                ->orderBy('LastUpdate','desc')
                ->paginate($this->pageCount);
        $collection = $items->items();
        foreach ($collection as $value) {
            if ($value->Name == null) {
                $value->Name = $value->JP == null ? $value->EN : $value->JP ;
            }
            unset($value->JP);
            unset($value->EN);
        }
        $items->setItems($collection);
        return $items;
    }
    
    public function detailItem($prefLang,$id)
    {
        if (!filter_var($id,FILTER_VALIDATE_INT)) return;
        $lang = $this->getLangName($prefLang);
        $items = DB::connection('sqlsrv')->table('SetDetail')
                ->join('AnimateList','SetDetail.ID' ,'=', 'AnimateList.ID')
                ->select('SetDetail.ID','AnimateList.'.$lang.' as Name','AnimateList.Name as EN','AnimateList.JName as JP','SetDetail.FileName','SetDetail.FileThumb','SetDetail.ClickCount')
                ->where('SetDetail.ID',$id)
                ->get();
        foreach ($items as $value) {
            if ($value->Name == null) {
                $value->Name = $value->JP == null ? $value->EN : $value->JP ;
            }
            unset($value->JP);
            unset($value->EN);
        }
        return $items;
    }
    public function playItem($prefLang,$id,$filename)
    {
        if (!filter_var($id,FILTER_VALIDATE_INT) || !filter_var($filename,FILTER_VALIDATE_FLOAT)) return;
        $lang = $this->getLangName($prefLang);
        $item = DB::connection('sqlsrv')->table('SetDetail')
                ->join('AnimateList','SetDetail.ID' ,'=', 'AnimateList.ID')
                ->select('SetDetail.ID','AnimateList.'.$lang.' as Name','AnimateList.Name as EN','AnimateList.JName as JP','SetDetail.FileName','SetDetail.FilePath','SetDetail.ClickCount')
                ->where('SetDetail.ID',$id)
                ->where('SetDetail.FileName',$filename)
                ->get()[0];
        $count = (int)($item->ClickCount) + 1;
        DB::connection('sqlsrv')->table('SetDetail')
            ->where('ID', $id)
            ->where("FileName", $filename)
            ->update(['ClickCount' => $count]);
        if ($item->Name == null) {
            $item->Name = $item->JP == null ? $item->EN : $item->JP ;
        }
        unset($item->JP);
        unset($item->EN);
        return $item;
    }
    public function searchItem($prefLang,$title)
    {
        $lang = $this->getLangName($prefLang);
        $items = DB::connection('sqlsrv')->table('AnimateList')
                ->select('ID',$lang.' as Name','Name as EN','JName as JP','LastUpdate')
                ->where($lang, 'like','%'.$title.'%')
                ->orwhere('Name', 'like', '%'.$title.'%')
                ->orwhere('JName', 'like', '%'.$title.'%')
                ->orderBy('LastUpdate','desc')
                ->paginate($this->pageCount);
        $collection = $items->items();
        foreach ($collection as $value) {
            if ($value->Name == null) {
                $value->Name = $value->JP == null ? $value->EN : $value->JP ;
            }
            unset($value->JP);
            unset($value->EN);
        }
        $items->setItems($collection);
        return $items;
    }
    public function getComments($prefLang,$id,$filename)
    {
        return  Comment::join('users','comments.userid','=','users.id')
                ->select('comments.body','comments.created_at','users.name')
                ->where('setid',$id)
                ->where('setname', $filename)
                ->where('language', $this->getLang($prefLang))
                ->orderBy('comments.created_at')
                ->get();
    }
    public function setComment($prefLang,$id,$filename,$userid,$body)
    {
        if (!filter_var($body,FILTER_UNSAFE_RAW) || !filter_var($userid,FILTER_VALIDATE_INT) || !filter_var($id,FILTER_VALIDATE_INT) || !filter_var($filename,FILTER_VALIDATE_FLOAT)) return false;
        $comment = new Comment;
        $comment->body = $body;
        $comment->userid = $userid;
        $comment->setid = $id;
        $comment->setname = $filename;
        $comment->language = $this->getLang($prefLang);
        $comment->save();
        return $comment;
    }
}