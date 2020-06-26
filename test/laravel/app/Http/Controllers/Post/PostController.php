<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Requests\CSVFileRequest;
use Illuminate\Support\Facades\Auth;
use App\Contracts\Services\Post\PostServiceInterface;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DownloadPost;
use App\Imports\CSVFiles;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PostController extends Controller
{
    private $postService;

    /**
     * Create a new controller instance.
     *
     * @param PostServiceInterface $postService
     */
    public function __construct(PostServiceInterface $postService)
    {
        // $this->middleware('auth', ['except' => ['show', 'export']]);
        $this->postService = $postService;
    }

    public function show()
    {
        $post = Post::with('users')->get();
        return $post;
    }

    public function postconfirm(PostRequest $request)
    {
        $request->validated();
        $post    =  new Post;
        $post->title = $request->title;
        $post->description  = $request->description;

        return response()->json([
            "user" => $post,
            "message" => "The post confirm"
        ]);
    }

    public function store(Request $request)
    {
        $post    =  new Post;
        $post->title = $request->title;
        $post->description  = $request->description;
        $post->create_user_id = Auth::guard("api")->user()->id;
        $post->updated_user_id = Auth::guard("api")->user()->id;
        $post->save();

        return response()->json([
            "user" => $post,
            "message" => "The post successfully created"
        ]);
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->deleted_user_id = Auth::guard("api")->user()->id;
        $post->deleted_at = now();
        $post->save();
        return response()->json([
            "user" => $post,
            "message" => "The post successfully delete"
        ]);
    }

    // public function edit($id)
    // {
    //     $post_detail = Post::find($id);
    //     return $post_detail;
    // }

    public function editconfirm(Request $request)
    {
        $post_edit = new Post;
        $post_edit = Post::find($request->id);
        $post_edit->title = $request->title;
        $post_edit->status = $request->status;
        // if($post_edit->status == 1) {
        //     return true;
        // }else {
        //     return false;
        // }
        $post_edit->description = $request->description;
        $post_edit->updated_user_id = Auth::guard("api")->user()->id;
        $post_edit->updated_at = now();
        return response()->json([
            'post' => $post_edit,
            'message' => 'post update confirm'
        ]);
    }

    public function update(Request $request)
    {
        $update_post = Post::find($request->id);
        $update_post->title = $request->title;
        $update_post->description = $request->description;
        $update_post->status = $request->status;
        $update_post->updated_user_id = Auth::guard("api")->user()->id;
        $update_post->updated_at = now();
        $update_post->save();
        return response()->json([
            'post' => $update_post,
            'message' => 'The post successfully update'
        ]);
    }

    public function downloadpost()
    {
        // $down = Excel::store(new DownloadPost, 'post01.xlsx');
        // return response()->json([
        //     'post' => $down,
        //     'message' => 'The post successfully download'
        // ]);
        $filename = Carbon::now()->format('Ymdhms') . '-Product01s.xlsx';
        Excel::store(new DownloadPost, $filename);
        $fullPath = Storage::put('excel', $filename);

        return response()->json([
            'data' => $fullPath,
            'message' => 'Products are successfully exported.'
        ], 200);
    }

    public function uploadFile(CSVFileRequest $request)
    {
        $request->validated();
        $path1 = $request->file('import_file')->store('temp');
        $path = storage_path('app') . '/' . $path1;
        $data = Excel::import(new CSVFiles, $path);
        return response()->json([
            'post' => $data,
            'message' => 'The post successfully update'
        ]);
    }
}
