@extends('layout')

@section('title', 'Chatbot - Si Pandji')

@section('content')
<div class="d-flex flex-column" style="height: calc(100vh - 120px);"> <!-- 120px accounts for header + footer -->

    <!-- Header -->
    <div class="d-flex align-items-center border-bottom p-3">
        <img src="/image/avatar.webp" alt="Si Pandji" width="48" height="48" class="rounded-circle me-3">
        <div>
            <h5 class="mb-0 fw-semibold">Si Pandji</h5>
            <small class="text-success">🟢 Online</small>
        </div>
    </div>

    <!-- Chat Box -->
    <div id="chat-box" class="flex-grow-1 overflow-auto p-3 bg-light d-flex flex-column">
        <div id="chat-placeholder" class="d-flex flex-column align-items-center text-muted mb-4">
            <div class="rounded-pill px-4 py-2 bg-white border shadow-sm">
                <i class="bi bi-chat-dots me-2 text-primary"></i>
                <strong>Mulai percakapan dengan <span class="text-primary">Si Pandji</span></strong>
            </div>
            <small class="mt-2 fst-italic">Ketik sesuatu dan tekan kirim ✨</small>
        </div>
    </div>

    <!-- Input -->
    <div class="border-top bg-white">
        <form id="chat-form" class="container d-flex gap-2 py-3">
            <input type="text" id="userInput" class="form-control rounded-pill" placeholder="Tulis pesan..." required>
            <button class="btn btn-primary rounded-pill px-4" type="submit">Kirim</button>
        </form>
    </div>
</div>

<style>
    .chat-bubble {
        padding: 10px 15px;
        border-radius: 20px;
        max-width: 70%;
        margin-bottom: 10px;
        white-space: pre-wrap;
        word-wrap: break-word;
    }

    .user-bubble {
        background-color: #0d6efd;
        color: white;
        align-self: end;
    }

    .bot-bubble {
        background-color: #e9ecef;
        color: #212529;
        align-self: start;
    }

    .typing-dots span {
        display: inline-block;
        font-size: 20px;
        animation: blink 1.4s infinite;
    }

    .typing-dots span:nth-child(2) { animation-delay: 0.2s; }
    .typing-dots span:nth-child(3) { animation-delay: 0.4s; }

    @keyframes blink {
        0%, 80%, 100% { opacity: 0; }
        40% { opacity: 1; }
    }

    @media (max-width: 768px) {
        #chat-box {
            max-height: calc(100vh - 230px); /* mobile header + footer + input */
        }
    }
</style>

<script>
    const form = document.getElementById('chat-form');
    const chatBox = document.getElementById('chat-box');

    form.addEventListener('submit', async function (e) {
        e.preventDefault();
        const input = document.getElementById('userInput');
        const message = input.value.trim();
        if (!message) return;

        appendMessage('user', message);
        input.value = '';

        const placeholder = document.getElementById('chat-placeholder');
        if (placeholder) placeholder.remove();

        const typingBubble = document.createElement('div');
        typingBubble.className = 'chat-bubble bot-bubble me-auto';
        typingBubble.innerHTML = `<span class="typing-dots"><span>.</span><span>.</span><span>.</span></span>`;
        chatBox.appendChild(typingBubble);
        chatBox.scrollTop = chatBox.scrollHeight;

        try {
            const res = await fetch('http://localhost:3001/api/activity', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ mood: message })
            });
            const data = await res.json();

            typingBubble.remove();
            appendMessage('bot', '💡 ' + data.recommendation);
        } catch {
            typingBubble.remove();
            appendMessage('bot', '⚠️ Gagal terhubung ke server.');
        }
    });

    function appendMessage(from, text) {
        const bubble = document.createElement('div');
        bubble.className = 'chat-bubble ' + (from === 'user' ? 'user-bubble ms-auto' : 'bot-bubble me-auto');
        bubble.textContent = text;
        chatBox.appendChild(bubble);
        chatBox.scrollTop = chatBox.scrollHeight;
    }
</script>
@endsection
