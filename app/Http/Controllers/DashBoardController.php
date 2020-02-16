<?php

namespace App\Http\Controllers;

use DummyFullModelClass;
use App\lain;
use Illuminate\Http\Request;
use App\TreeModel;

class DashBoardController extends Controller
{
    public function __constructor () {
        $this.load.helper('database');
    }
    /**
     * Display a listing of the resource.
     *
     * @param  \App\lain  $lain
     * @return \Illuminate\Http\Response
     */

    public function index(lain $lain)
    {
        return session('login')?  view('dashboard') : redirect('/') ;
    }

    public function getProjects(Request $req){
        if(!session('login')) return redirect('/');

        $userID = session("userID");
        $nodes = TreeModel::where('pid', '#')->get();
        $data = array();
        foreach($nodes as $node){
            $data[] = array(
                'id' => $node->tid,
                'text' => $node->text,
                "children" => $this->getChildren($node->tid)
            );
        }
        echo json_encode($data);
    }

    public function getChildren($pid){
        $children = TreeModel::where('pid', $pid)->get();
        $data = array();
        foreach($children as $child){
            $data[] = array(
                'id' => $child->tid,
                'text' => $child->text,
                'type' => $child->type,
                'children' => $this->getChildren($child->tid) 
            );
        }
        return $data;
    }

    public function addUserTree(Request $req){
        if(!session('login')) return redirect('/');

        $node = new TreeModel;
        $node->uid = session('userID');
        $node->tid = $req['id'];
        $node->pid = $req['pid'];
        $node->text = $req['text'];
        $node->html ="No Content";
        $node->type = $req['type'];
        $node->save();
        echo "OK";
    }

    public function reNameTree(Request $req){
        if(!session('login')) return redirect('/');

        TreeModel::where('tid', $req['tid'])
            ->update(['text' => $req['text']]);
        
        echo "OK";
    }

    public function moveNode(Request $req){
        if(!session('login')) return redirect('/');

        TreeModel::where('tid', $req['tid'])
             ->update(['pid' => $req['pid']]);
        
        echo "OK";
    }

    public function deleteTree(Request $req){
        if(!session('login')) return redirect('/');

        TreeModel::where('tid', $req['tid'])
             ->delete();
        
        echo "OK";
    }

    public function saveDoc(Request $req){
        if(!session('login')) return redirect('/');
        
        TreeModel::where('tid', $req['tid'])
                ->update(['html' => $req['html']]);
        
        echo "Save Success";
    }

    public function getDoc(Request $req){
        if(!session('login')) return redirect('/');

        $nodes = TreeModel::where([
                            ['tid', '=', $req['tid']]
                            ])->get();
        $data[] = array(
            'html'  => $nodes[0]->html,
        );
        echo json_encode($data);
    }

    public function uploadImage(Request $req){
        
        //$temp = explode(".", $_FILES["file"]["name"]);

       
        $link = array(
            "link" => "/Image1_0000.png"
        );
        echo json_encode($link);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\lain  $lain
     * @return \Illuminate\Http\Response
     */
    public function create(lain $lain)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\lain  $lain
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, lain $lain)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\lain  $lain
     * @param  \DummyFullModelClass  $DummyModelVariable
     * @return \Illuminate\Http\Response
     */
    public function show(lain $lain, DummyModelClass $DummyModelVariable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\lain  $lain
     * @param  \DummyFullModelClass  $DummyModelVariable
     * @return \Illuminate\Http\Response
     */
    public function edit(lain $lain, DummyModelClass $DummyModelVariable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\lain  $lain
     * @param  \DummyFullModelClass  $DummyModelVariable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, lain $lain, DummyModelClass $DummyModelVariable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\lain  $lain
     * @param  \DummyFullModelClass  $DummyModelVariable
     * @return \Illuminate\Http\Response
     */
    public function destroy(lain $lain, DummyModelClass $DummyModelVariable)
    {
        //
    }
}
