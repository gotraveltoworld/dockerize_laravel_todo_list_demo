<?php

namespace App\Http\Controllers;

use App\TodoList;
use Illuminate\Http\Request;

use Validator;

class TodoListController extends Controller
{
    protected $__model = null;
    /**
     * Create a new TodoListController instance.
     * @return void
     */
    public function __construct()
    {
        $this->__model = new TodoList();
    }

    /**
     * Display a listing of the resource.
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        $result = $this->__model->getData($id);
        return response()->json([
            'data' => $result
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $request = request()->all();
        $validator = Validator::make($request, [
            'title' => 'required|max:50',
            'content' => 'required|max:300',
            'attachment' => [
                'file',
                'max : 10240' // 10 MB
            ]
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'validator fails.'
            ]);
        }

        $oriName = request()->file('attachment')->getClientOriginalName();
        $ext = request()->file('attachment')->getClientOriginalExtension();
        $fileName = md5("{$oriName}.{$ext}"). '-'. uniqid(). '.'. $ext;
        $path = request()->file('attachment')->storeAs(
            'public/attachments',
            $fileName
        );

        $id = $this->__model->addToDoList(
            $request['title'],
            $request['content'],
            $fileName,
            $oriName
        );
        return response()->json([
            'data' => $id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TodoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function show(TodoList $todoList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TodoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function edit(TodoList $todoList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\TodoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function update($id = null, TodoList $todoList)
    {
        $request = request()->all();
        $validator = Validator::make($request, [
            'title' => 'required|max:50',
            'content' => 'required|max:300'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => 'validator fails.',
                'data' => $request
            ]);
        }
        $result = $this->__model->updatedList(
            $id,
            $request['title'],
            $request['content']
        );
        return response()->json([
            'data' => $result
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TodoList  $todoList
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TodoList $todoList, $id = null)
    {
        $result = $this->__model->deletedList($id);
        return response()->json([
            'data' => $result
        ]);
    }
}
