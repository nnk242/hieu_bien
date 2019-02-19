<?php

namespace App\Http\Controllers\Admin;

use App\Doctor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function model()
    {
        return Doctor::class;
    }

    public function index()
    {
        $posts = $this->model()::orderby('id', 'desc')->paginate(10);
        return view('admin.doctor.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.doctor.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'education' => 'required',
            'experience' => 'required',
            'expert' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->messages()->first() . '!');
        }

        $file = $request->file('image');
        $imageName = time() . '_' . str_random(7) . '.' . $file->getClientOriginalExtension();

        $this->model()::create([
            'title' => $request->title,
            'expert' => $request->expert,
            'education' => $request->education,
            'experience' => $request->experience,
            'description' => $request->description,
            'image' => uploadFile($file, $imageName, 'uploads/image'),
            'status' => 'show'
        ]);
        return redirect()->back()->with('success', 'Thêm thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        return view('admin.doctor.edit', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'education' => 'required',
            'experience' => 'required',
            'expert' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->messages()->first() . '!');
        }

        $file = $request->file('image');
        if (isset($file)) {
            $validator = Validator::make($request->all(), [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', 'Kiểm tra lại hình ảnh, hình ảnh có thể quá lớn hoặc không theo chuẩn jpeg,png,jpg,gif,svg' . '!');
            }

            $imageName = time() . '_' . str_random(7) . '.' . $file->getClientOriginalExtension();
            $data = [
                'title' => $request->title,
                'expert' => $request->expert,
                'education' => $request->education,
                'experience' => $request->experience,
                'description' => $request->description,
                'image' => uploadFile($file, $imageName, 'uploads/image'),
                'status' => $request->status
            ];
            File::delete($doctor->image);
        } else {
            $data = [
                'title' => $request->title,
                'expert' => $request->expert,
                'education' => $request->education,
                'experience' => $request->experience,
                'description' => $request->description,
                'status' => $request->status
            ];
        }

        $doctor->update($data);
        return redirect()->back()->with('success', 'Sửa thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        //
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
