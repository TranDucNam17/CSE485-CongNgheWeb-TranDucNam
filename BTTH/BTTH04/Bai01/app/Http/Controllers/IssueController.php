<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Computer;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    //hiển thị danh sách với phân trang
    public function index()
    {
        $issues = Issue::with('computer')->paginate(10);
        return view('index', compact('issues'));
    }

    //hiển thị form tạo sự cố mới
    public function create()
    { 
        $computers = Computer::all(); //lấy danh sách máy tính
        return view('create', compact('computers')); //trả về view create
    }

    //lưu sự cố mới
    public function store(Request $request)
    {
        $request->validate([
            'computer_id' => 'required|exists:computers,id',
            'reported_by' => 'required|string|max:50',
            'reported_date' => 'required|date',
            'description' => 'required|string',
            'urgency' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Open,In Progress,Resolved',
        ]);
        Issue::create($request->all()); //tạo mới issue với thông tin từ request

        return redirect()->route('index')->with('success', 'Issue created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Issue $issue)
    {
        //
    }

    //hiển thị form chỉnh sửa sự cố
    public function edit($id)
    {
        $issue =Issue::findOrFail($id);
        $computers = Computer::all(); //lấy danh sách máy tính
        return view('edit', compact('issue', 'computers'));
    }

    //cập nhật thông tin sự cố
    public function update(Request $request, $id)
    {
        $request->validate([
            'computer_id' => 'required|exists:computers,id',
            'reported_by' => 'required|string|max:50',
            'reported_date' => 'required|date',
            'description' => 'required|string',
            'urgency' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Open,In Progress,Resolved',
        ]);
        $issue = Issue::findOrFail($id);
        $issue->update($request->all());
        return redirect()->route('index')->with('success', 'Issue updated successfully.');
    }

    //xóa có xác nhận
    public function destroy($id)
    {
        $issue = Issue::findOrFail($id);
        return view('confirm_delete', compact('issue'));
    }

    public function confirmDelete(Request $request, $id)
    {
        $issue = Issue::findOrFail($id);
        $issue->delete();
        return redirect()->route('index')->with('success', 'Issue deleted successfully.');
    }

}
