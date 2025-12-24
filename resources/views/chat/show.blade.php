@extends('layouts.app')

@section('title', 'چت با فروشنده')

@push('styles')
<style>
.chat-container {
    height:75vh;
    max-width:900px;
    width:100%;
    margin:auto;
    display:flex;
    flex-direction:column;
    border:1px solid #dee2e6;
    border-radius:12px;
    background:#fff;
    overflow:hidden;
    box-shadow:0 2px 8px rgba(0,0,0,0.1);

    /* بهینه‌سازی برای لپ‌تاپ */
    padding: 0;
}
.chat-header {
    padding:12px 16px;
    border-bottom:1px solid #dee2e6;
    background:#f8f9fa;
    display:flex;
    flex-direction:column;
    gap:8px;
    font-weight:600;
    font-size:1rem;
}
.ad-info {
    display:flex;
    align-items:center;
    gap:10px;
}
.ad-info img {
    width:50px;
    height:50px;
    border-radius:8px;
    object-fit:cover;
}
.ad-info .title {
    font-weight:500;
    font-size:0.95rem;
    color:#333;
}
.chat-messages {
    flex:1;
    padding:15px;
    overflow-y:auto;
    display:flex;
    flex-direction:column;
    gap:10px;
    background:#f8f9fa;
    scroll-behavior:smooth;
}
.message {
    max-width:70%;
    padding:12px 16px;
    border-radius:20px;
    line-height:1.5;
    font-size:0.95rem;
    word-wrap:break-word;
}
.message.me {
    background:#ff6b6b;
    color:#fff;
    margin-left:auto;
    border-bottom-right-radius:0;
}
.message.other {
    background:#e9ecef;
    color:#000;
    margin-right:auto;
    border-bottom-left-radius:0;
}
.chat-input-area {
    padding:12px 15px;
    border-top:1px solid #dee2e6;
    display:flex;
    flex-direction:column;
    gap:10px;
    position:relative;
}
.predefined-messages {
    display:flex;
    justify-content:flex-end;
    gap:8px;
    position:absolute;
    bottom:80px;
    right:15px;
}
.predefined-messages button {
    padding:6px 12px;
    border-radius:20px;
    border:none;
    background:#e9ecef;
    font-size:0.85rem;
    cursor:pointer;
    transition:0.2s;
}
.predefined-messages button:hover {
    background:#ced4da;
}
.chat-input-row {
    display:flex;
    gap:10px;
}
.chat-input-row input {
    flex:1;
    border-radius:25px;
    border:1px solid #ced4da;
    padding:12px 18px;
    transition:0.2s;
}
.chat-input-row input:focus {
    outline:none;
    border-color:#ff6b6b;
    box-shadow:0 0 5px rgba(255,107,107,0.4);
}
.chat-input-row button {
    width:50px;
    height:50px;
    border-radius:50%;
    border:none;
    background:#ff6b6b;
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:1.2rem;
    cursor:pointer;
}
.chat-input-row button:hover {
    background:#e04848;
}

/* ریسپانسیو برای لپ‌تاپ */
@media (min-width: 1200px) {
    .chat-container {
        max-width: 900px;
    }
}
</style>
@endpush

@section('content')
<div class="container py-4">
    <div class="chat-container shadow-sm">

        {{-- هدر چت --}}
        <div class="chat-header">
            @php
                $counterparty = (auth()->id() == $ad->user_id) ? $ad->buyer : $ad->seller;
            @endphp
            <div class="role">کاربر: {{ $counterparty?->name ?? 'طرف مقابل' }}</div>

            {{-- اطلاعات آگهی --}}
            <div class="ad-info">
                <img src="{{ $ad->image ?? 'https://via.placeholder.com/50' }}" alt="آگهی">
                <div class="title">{{ $ad->title ?? 'عنوان آگهی' }}</div>
            </div>
        </div>

        {{-- پیام‌ها --}}
        <div class="chat-messages" id="chatMessages"></div>

        {{-- پیام‌های آماده و ورودی --}}
        <div class="chat-input-area">
            <div class="predefined-messages">
                <button onclick="sendPredefined('سلام')">سلام</button>
                <button onclick="sendPredefined('ممنون')">ممنون</button>
                <button onclick="sendPredefined('خدانگهدار')">خدانگهدار</button>
            </div>

            <div class="chat-input-row">
                <input type="text" id="messageInput" placeholder="پیام خود را بنویسید...">
                <button onclick="sendMessage()"><i class="bi bi-send-fill"></i></button>
            </div>
        </div>

    </div>
</div>

<script>
function addMessage(text,type){
    let msg=document.createElement("div");
    msg.className="message "+type;
    msg.innerText=text;
    let chat=document.getElementById("chatMessages");
    chat.appendChild(msg);
    chat.scrollTop=chat.scrollHeight;
}
function sendMessage(){
    let input=document.getElementById("messageInput");
    let text=input.value.trim();
    if(!text) return;
    addMessage(text,'me');
    input.value="";
}
function sendPredefined(text){ addMessage(text,'me'); }
</script>
@endsection
