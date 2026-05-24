@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto my-8 px-4">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                Thêm tài khoản mới
            </h1>
            <a href="{{ route('accounts.index') }}" class="text-sm text-gray-500 hover:text-gray-700 flex items-center gap-1 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Quay lại danh sách
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg mb-6 shadow-sm flex items-start gap-3">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <div>
                    <p class="font-semibold text-red-800">Đã có lỗi xảy ra!</p>
                    <p class="text-sm text-red-700">Vui lòng kiểm tra lại thông tin các trường dữ liệu bên dưới.</p>
                </div>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
            <form action="{{ route('accounts.store') }}" method="POST" class="p-6 sm:p-8 space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Họ và tên <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="text" name="full_name" value="{{ old('full_name') }}" placeholder="Nhập đầy đủ họ tên"
                                   class="w-full pl-3 pr-3 py-2.5 rounded-lg border text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 transition
                               @error('full_name') border-red-400 bg-red-50/50 focus:ring-red-200 @else border-gray-300 focus:border-green-500 focus:ring-green-100 @enderror">
                        </div>
                        @error('full_name')
                        <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                            <span class="font-medium">{{ $message }}</span>
                        </p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Số tài khoản <span class="text-red-500">*</span></label>
                        <input type="text" name="account_number" value="{{ old('account_number') }}" maxlength="10" placeholder="Ví dụ: 0123456789"
                               class="w-full px-3 py-2.5 rounded-lg border text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 transition
                           @error('account_number') border-red-400 bg-red-50/50 focus:ring-red-200 @else border-gray-300 focus:border-green-500 focus:ring-green-100 @enderror">
                        @error('account_number')
                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Số điện thoại <span class="text-red-500">*</span></label>
                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Ví dụ: 0987654321"
                               class="w-full px-3 py-2.5 rounded-lg border text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 transition
                           @error('phone') border-red-400 bg-red-50/50 focus:ring-red-200 @else border-gray-300 focus:border-green-500 focus:ring-green-100 @enderror">
                        @error('phone')
                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Địa chỉ Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="name@example.com"
                               class="w-full px-3 py-2.5 rounded-lg border text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 transition
                           @error('email') border-red-400 bg-red-50/50 focus:ring-red-200 @else border-gray-300 focus:border-green-500 focus:ring-green-100 @enderror">
                        @error('email')
                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Số dư</label>
                        <div class="relative rounded-lg shadow-sm">
                            <input type="text" name="balance" value="{{ old('balance', 0) }}" min="0" step="any" placeholder="0"
                                   class="w-full px-3 py-2.5 rounded-lg border text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2
                               @error('balance') border-red-400 bg-red-50/50 focus:ring-red-200 @else border-gray-300 focus:border-green-500 focus:ring-green-100 @enderror">
                        </div>
                        @error('balance')
                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                    <button type="submit" class="px-6 py-2.5 rounded-lg bg-green-600 hover:bg-green-700 text-white text-sm font-medium shadow-sm hover:shadow focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Lưu tài khoản
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
