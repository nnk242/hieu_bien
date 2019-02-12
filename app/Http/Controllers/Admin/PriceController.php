<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Component\MessageAdmin;
use App\Http\Controllers\Controller;
use App\Price;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PriceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function newMessage()
    {
        return MessageAdmin::newMessage();
    }

    public function model()
    {
        return Price::class;
    }

    public function index()
    {
        $types = Type::all();
        $posts = Price::paginate(10);
        $newMessage = $this->newMessage();
        return view('admin.price.index', compact('posts', 'newMessage', 'types'));
    }

    public function create()
    {
        $newMessage = $this->newMessage();
        $types = Type::all();
        return view("admin.price.create", compact('newMessage', 'types'));
    }

    public function store(Request $request)
    {
        $items = $request->all();

        $validator = Validator::make($items, [
            'name' => 'required',
            'description' => 'required|max:255',
            'price' => 'required',
            'per' => 'required',
            'type' => 'required',
            'status' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', serialize($validator->errors()->getMessages()));
        }

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'per' => $request->per == '1' ? 'răng' : $request->per == '2' ? 'cặp' : 'hàm',
            'type_id' => $request->type,
            'status' => $request->status
        ];
        $this->model()::create($data);
        return redirect()->back()->with('success', 'Thêm giá thành công!');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Price $price
     * @return \Illuminate\Http\Response
     */
    public function show(Price $price)
    {
        //
    }

    public function edit(Price $price)
    {
        $types = Type::all();
        $newMessage = $this->newMessage();
        return view('admin.price.edit', compact('price', 'newMessage', 'types'));
    }

    public function update(Request $request, Price $price)
    {
        $items = $request->all();

        $validator = Validator::make($items, [
            'name' => 'required',
            'description' => 'required|max:255',
            'price' => 'required',
            'per' => 'required',
            'type' => 'required',
            'status' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Sửa thất bại!');
        }

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'per' => $request->per == '1' ? 'răng' : $request->per == '2' ? 'cặp' : 'hàm',
            'type_id' => $request->type,
            'status' => $request->status
        ];

        $price->update($data);
        return redirect()->back()->with('success', 'Thêm giá thành công!');
    }

    public function destroy(Price $price)
    {
        if ($price->delete()) {
            return redirect()->back()->with('success', 'Xóa thành công!');
        } else
            return redirect()->back()->with('error', 'Xóa thất bại!');
    }

    public function addType(Request $request)
    {
        $items = $request->all();

        $validator = Validator::make($items, [
            'name' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', serialize($validator->errors()->getMessages()));
        }

        $data = [
            'name' => $request->name,
        ];

        Type::create($data);

        return redirect()->back()->with('success', 'Thêm thể loại thành công!');
    }

    public function destroyType(Type $type)
    {
        if ($type->delete()) {
            return redirect()->back()->with('success', 'Xóa thành công!');
        } else
            return redirect()->back()->with('error', 'Xóa thất bại!');
    }

    public function editType(Type $type)
    {
        $newMessage = $this->newMessage();
        return view('admin.price.editType', compact('type', 'newMessage'));
    }
    public function updateType(Request $request, Type $type)
    {
        $items = $request->all();
        $validator = Validator::make($items, [
            'name' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Sửa thất bại!');
        }
        $data = [
            'name' => $request->name
        ];

        $type->update($data);
        return redirect()->back()->with('success', 'Cập nhật thành công!');
    }

    public function changeStatus(Request $request)
    {
        $item = $this->model()::findOrFail($request->id);
        $status = $item->status;
        $item->update(
            [
                'status' => $status == 'show' ? 'hide' : 'show'
            ]
        );
        return redirect()->back()->with('success', 'Thay đổi status thành công!');
    }
}
