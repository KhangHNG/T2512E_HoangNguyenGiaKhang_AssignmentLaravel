@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto my-8 px-4">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Danh sách tài khoản</h1>
            </div>
            <a href="{{ route('accounts.create') }}"
               class="inline-flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2.5 rounded-lg font-medium shadow-sm hover:shadow transition whitespace-nowrap">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Thêm tài khoản
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">

            <div class="p-5 border-b border-gray-100 bg-gray-50/50">
                <form action="{{ route('accounts.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-4 items-end">

                    <div class="sm:col-span-2 lg:col-span-4">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Tìm kiếm nhanh</label>
                        <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </span>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Nhập Tên, Email hoặc Số điện thoại..."
                                   class="w-full pl-9 pr-3 py-2 text-sm rounded-lg border border-gray-300 focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 bg-white placeholder-gray-400 text-gray-700 transition">
                        </div>
                    </div>

                    <div class="lg:col-span-2">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Số dư</label>
                        <input type="number" name="balance_min" value="{{ request('balance_min') }}" placeholder="Ví dụ: 10000000" min="0"
                               class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 bg-white placeholder-gray-400 text-gray-700 transition">
                    </div>

                    <div class="lg:col-span-2">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Từ</label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}"
                               class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 bg-white text-gray-700 transition">
                    </div>

                    <div class="lg:col-span-2">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Đến</label>
                        <input type="date" name="date_to" value="{{ request('date_to') }}"
                               class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 bg-white text-gray-700 transition">
                    </div>

                    <div class="flex items-center gap-2 lg:col-span-2">
                        <button type="submit" class="flex-1 inline-flex items-center justify-center gap-1.5 bg-gray-800 hover:bg-gray-900 text-white text-sm font-medium px-4 py-2 rounded-lg shadow-sm transition h-[38px]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                            Lọc
                        </button>
                        @if(request()->anyFilled(['search', 'balance_min', 'date_from', 'date_to']))
                            <a href="{{ route('accounts.index') }}" class="inline-flex items-center justify-center bg-gray-200 hover:bg-gray-300 text-gray-600 p-2 rounded-lg transition h-[38px] w-[38px]" title="Xóa bộ lọc">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[800px]">
                    <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-gray-600 text-sm font-semibold uppercase tracking-wider">
                        <th class="py-3.5 px-6">Số tài khoản</th>
                        <th class="py-3.5 px-6">Họ và tên</th>
                        <th class="py-3.5 px-6">Email</th>
                        <th class="py-3.5 px-6">Số điện thoại</th>
                        <th class="py-3.5 px-6 text-right">Số dư</th>
                        <th class="py-3.5 px-6 text-center">Ngày tạo</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm divide-y divide-gray-100">
                    @forelse($items as $account)
                        <tr class="hover:bg-gray-50/70 transition-colors">
                            <td class="py-4 px-6 font-mono font-medium text-gray-900">{{ $account->account_number }}</td>
                            <td class="py-4 px-6 font-medium text-gray-900">{{ $account->full_name }}</td>
                            <td class="py-4 px-6 text-gray-500">{{ $account->email ?? '-' }}</td>
                            <td class="py-4 px-6 text-gray-500">{{ $account->phone }}</td>
                            <td class="py-4 px-6 text-right font-semibold text-green-600">{{ number_format($account->balance) }}đ</td>
                            <td class="py-4 px-6 text-center text-gray-500">{{ $account->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-gray-400">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                    <span class="text-base font-medium text-gray-500">Không tìm thấy tài khoản nào khớp với bộ lọc hiện tại.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            @if($items->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                    {{ $items->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
