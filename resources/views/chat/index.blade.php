@extends('layouts.app')

@section('title', 'لیست پیام‌ها')

@push('styles')
<style>
    .chat-list-container {
        max-width: 900px;
        margin: 40px auto;
        background: #fff;
        border: 1px solid #dee2e6;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.1);
        min-height: 60vh; /* حداقل ارتفاع */
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    .chat-list-header {
        padding: 16px 20px;
        border-bottom: 1px solid #dee2e6;
        background: #f8f9fa;
        font-weight: 600;
        font-size: 1.1rem;
        color: #333;
    }

    .chat-items {
        flex: 1;
        overflow-y: auto;
        padding: 10px 0;
    }

    .chat-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 20px;
        margin: 0 10px;
        border-bottom: 1px solid #f1f3f5;
        transition: background 0.2s;
        border-radius: 8px;
    }

    .chat-item:hover {
        background: #f1f3f5;
        cursor: pointer;
    }

    .chat-item-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .chat-item-info img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        background: #e9ecef;
    }

    .chat-item-info .chat-title {
        font-weight: 500;
        color: #333;
    }

    .chat-item-date {
        font-size: 0.85rem;
        color: #6c757d;
    }

    /* اسکرول زیبا */
    .chat-items::-webkit-scrollbar {
        width: 6px;
    }
    .chat-items::-webkit-scrollbar-thumb {
        background-color: rgba(0,0,0,0.2);
        border-radius: 3px;
    }
    .chat-items::-webkit-scrollbar-track {
        background: transparent;
    }
</style>
@endpush

@section('content')
<div class="container py-4">
    <div class="chat-list-container">
        <div class="chat-list-header">
            پیام‌های شما
        </div>

        <div class="chat-items">
            {{-- نمونه آیتم چت --}}
            @forelse ($chats ?? [] as $chat)
            <a href="{{ route('chat.show', $chat->id) }}" class="text-decoration-none text-dark">
                <div class="chat-item">
                    <div class="chat-item-info">
                        <img src="{{ $chat->counterparty->avatar ?? 'https://via.placeholder.com/50' }}" alt="کاربر">
                        <div class="chat-title">{{ $chat->counterparty->name ?? 'کاربر' }}</div>
                    </div>
                    <div class="chat-item-date">{{ $chat->updated_at->format('Y/m/d H:i') }}</div>
                </div>
            </a>
            @empty
            <div class="text-center text-muted py-5">
                <i class="bi bi-chat-dots" style="font-size: 3rem;"></i>
                <p class="mt-3">هیچ پیامی موجود نیست.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
