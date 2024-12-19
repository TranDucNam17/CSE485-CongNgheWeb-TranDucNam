<?php

namespace App\Http\Controllers;

use App\Models\Computer;
use Illuminate\Http\Request;

class ComputerController extends Controller
{
    //hiển thị danh sách các máy tính với phân trang
    public function index()
    {
        $computers = Computer::paginate(5);
        return view('index', compact('computers'));
    }

    //hiển thị form thêm máy tính mới
    public function create()
    {
        return view('create');
    }

    //lưu máy tính mới
    public function store(Request $request)
    {
        $request->validate([
            'computer_name' => 'required|max:50',
            'model' => 'required|max:100',
            'operating_system' => 'required|max:50',
            'processor' => 'required|max:50',
            'memory' => 'required|integer',
            'available' => 'required|boolean',
        ]);

        Computer::create($request->all());

        return redirect()->route('index')->with('success', 'Computer created successfully.');
    }

    //hiển thị chi tiết máy tính
    public function show(Computer $computer)
    {
        return view('show', compact('computer'));
    }

    //hiển thị form chỉnh sửa thông tin máy tính
    public function edit($id)
    {
        $computer = Computer::findOrFail($id);
        return view('edit', compact('computer'));
    }

    //cập nhật thông tin máy tính
    public function update(Request $request, Computer $computer)
    {
        $request->validate([
            'computer_name' => 'required|max:50',
            'model' => 'required|max:100',
            'operating_system' => 'required|max:50',
            'processor' => 'required|max:50',
            'memory' => 'required|integer',
            'available' => 'required|boolean',
        ]);

        $computer = Computer::findOrFail($id);
        $computer->update($request->all());

        return redirect()->route('index')->with('success', 'Computer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    //xóa máy tính
    public function destroy($id)
    {
        $computer = Computer::findOrFail($id);
        $computer->delete();

        return redirect()->route('index')->with('success', 'Computer deleted successfully.');
    }
}
