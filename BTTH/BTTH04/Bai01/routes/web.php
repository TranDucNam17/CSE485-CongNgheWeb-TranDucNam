<?php

use App\Http\Controllers\ComputerController;
use App\Http\Controllers\IssueController;
use Illuminate\Support\Facades\Route;

Route::resource('issues', IssueController::class);

//đường dẫn hiển thị danh sách các vấn đề(trang chủ)
Route::get('/', [IssueController::class, 'index'])->name('index');

// Đường dẫn để tạo mới một vấn đề (hiển thị form thêm mới)
Route::get('/create ', [IssueController::class, 'create'])->name('create');

// Đường dẫn để lưu dữ liệu vấn đề mới (thực hiện thêm mới)
Route::post('/', [IssueController::class, 'store'])->name('store');

// Đường dẫn để hiển thị chi tiết một vấn đề cụ thể (tuỳ chọn)
Route::get('{id}', [IssueController::class, 'show'])->name('show');

// Đường dẫn để chỉnh sửa thông tin vấn đề (hiển thị form chỉnh sửa)
Route::get('{id}', [IssueController::class, 'edit'])->name('edit');

// Đường dẫn để cập nhật thông tin vấn đề (thực hiện cập nhật)
Route::put('{id}', [IssueController::class, 'update'])->name('update');

// Đường dẫn để xóa vấn đề (thực hiện xóa sau khi có modal xác nhận)
Route::delete('{id}', [IssueController::class, 'destroy'])->name('destroy');

// Đường dẫn xác nhận xóa
Route::get('{id}/confirm', [IssueController::class, 'destroy'])->name('destroy');
Route::post('{id}/confirm', [IssueController::class, 'confirmDelete'])->name('confirmDelete');

