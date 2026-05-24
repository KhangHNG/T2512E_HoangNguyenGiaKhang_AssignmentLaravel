<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use Illuminate\Http\Request;
use Carbon\Carbon;


class AccountController extends Controller
{
    public function index(Request $request)
    {
        $query = BankAccount::query();

        // 1. Tìm kiếm nhanh: Gom Tên, Email, SĐT vào chung một cụm nhóm OR
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // 2. Lọc theo số dư lớn hơn hoặc bằng (>=)
        if ($request->filled('balance_min')) {
            $query->where('balance', '>=', $request->balance_min);
        }

        // 3. Lọc theo khoảng ngày tạo (Date Range)
        if ($request->filled('date_from')) {
            // startOfDay() để tính từ 00:00:00 của ngày đó
            $query->where('created_at', '>=', Carbon::parse($request->date_from)->startOfDay());
        }

        if ($request->filled('date_to')) {
            $query->where('created_at', '<=', Carbon::parse($request->date_to)->endOfDay());
        }

        // Thực thi query, sắp xếp mới nhất lên đầu và phân trang
        $items = $query->latest()->paginate(10);

        return view('accounts.index', compact('items'));
    }

    function show($id) {
        $items = BankAccount::find($id);
        return view('accounts.detail', compact('items'));
    }

    function create() {
        return view('accounts.create');
    }

    function store(\Illuminate\Http\Request $request) {
        $data = $request->validate([
            'account_number'=>'required',
            'full_name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'balance'=>'nullable|numeric|min:0',
        ]);
        BankAccount::create($data);
        return redirect()->route('accounts.index')->with('success', 'Thêm thành công!');
    }
}
