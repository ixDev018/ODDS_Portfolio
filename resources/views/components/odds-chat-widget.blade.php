<div class="fixed bottom-6 right-6 z-50 font-sans" id="odds-chat-container">
    <!-- Chat Toggle Button -->
    <button 
        id="chat-toggle-btn"
        class="flex items-center justify-center w-14 h-14 rounded-full text-white shadow-2xl transition-all duration-300 hover:scale-105 active:scale-95 cursor-pointer focus:outline-none relative group"
        style="background: linear-gradient(135deg, #cf5aa8 0%, #a83f84 100%); box-shadow: 0 8px 30px rgba(207, 90, 168, 0.4);"
        aria-label="Open ODDS Assistant"
    >
        <!-- Pulse effect -->
        <span class="absolute inset-0 rounded-full bg-pink-500 opacity-20 group-hover:animate-ping duration-1000"></span>
        
        <!-- Chat Icon -->
        <svg id="chat-icon-open" class="w-6 h-6 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
        </svg>
        
        <!-- Close Icon (initially hidden) -->
        <svg id="chat-icon-close" class="w-6 h-6 hidden transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <!-- Chat Window -->
    <div 
        id="chat-window"
        class="hidden flex-col w-[360px] sm:w-[400px] h-[500px] bg-[#16161a] border border-[#ffffff15] rounded-2xl shadow-2xl overflow-hidden transition-all duration-300 origin-bottom-right"
        style="box-shadow: 0 12px 40px rgba(0, 0, 0, 0.6);"
    >
        <!-- Header -->
        <div class="flex items-center justify-between px-5 py-4 border-b border-[#ffffff10] bg-[#1e1e24]">
            <div class="flex items-center gap-3">
                <!-- Avatar/Logo -->
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-[#cf5aa8] text-white font-extrabold text-xs tracking-tighter">
                    ODDS
                </div>
                <div>
                    <h3 class="text-sm font-bold text-white leading-none">ODDS Assistant</h3>
                    <div class="flex items-center gap-1.5 mt-1">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span class="text-[10px] text-zinc-400 font-semibold uppercase tracking-wider">Online</span>
                    </div>
                </div>
            </div>
            
            <button 
                id="chat-close-btn"
                class="text-zinc-400 hover:text-white transition-colors cursor-pointer p-1 rounded-lg hover:bg-[#ffffff08]"
                aria-label="Close chat"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Messages Area -->
        <div 
            id="chat-messages" 
            class="flex-1 overflow-y-auto p-4 space-y-4 scrollbar-thin scrollbar-thumb-zinc-800 scrollbar-track-transparent"
        >
            <!-- Greeting Message -->
            <div class="flex gap-2 max-w-[85%]">
                <div class="flex-shrink-0 w-6 h-6 rounded-full bg-zinc-800 text-zinc-300 flex items-center justify-center text-[9px] font-bold">
                    ODDS
                </div>
                <div class="bg-zinc-800/80 text-zinc-100 text-xs py-2.5 px-3.5 rounded-2xl rounded-tl-none border border-[#ffffff05] leading-relaxed">
                    Hey! I'm the ODDS assistant. Ask me anything about our services, past projects, or our simulation engine, Simula.
                </div>
            </div>
        </div>

        <!-- Typing Indicator -->
        <div id="typing-indicator" class="hidden px-4 py-2 flex items-center gap-2 max-w-[85%]">
            <div class="flex-shrink-0 w-6 h-6 rounded-full bg-zinc-800 text-zinc-300 flex items-center justify-center text-[9px] font-bold">
                ODDS
            </div>
            <div class="bg-zinc-800/50 text-zinc-400 text-xs py-2 px-3 rounded-2xl rounded-tl-none flex items-center gap-1">
                <span class="w-1.5 h-1.5 bg-zinc-400 rounded-full animate-bounce" style="animation-delay: 0ms"></span>
                <span class="w-1.5 h-1.5 bg-zinc-400 rounded-full animate-bounce" style="animation-delay: 150ms"></span>
                <span class="w-1.5 h-1.5 bg-zinc-400 rounded-full animate-bounce" style="animation-delay: 300ms"></span>
            </div>
        </div>

        <!-- Input Area -->
        <form id="chat-form" class="p-3 bg-[#121215] border-t border-[#ffffff08] flex items-center gap-2">
            @csrf
            <input 
                type="text" 
                id="chat-input"
                placeholder="Ask a question..."
                class="flex-1 bg-zinc-900 border border-zinc-800 text-white placeholder-zinc-500 rounded-xl px-3.5 py-2.5 text-xs focus:outline-none focus:border-[#cf5aa8] transition-colors"
                autocomplete="off"
            >
            <button 
                type="submit"
                class="flex items-center justify-center w-9 h-9 rounded-xl text-white transition-all cursor-pointer hover:scale-105 active:scale-95"
                style="background: #cf5aa8;"
                aria-label="Send message"
            >
                <svg class="w-4 h-4 transform rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                </svg>
            </button>
        </form>
    </div>
</div>

<style>
    .fade-in-message {
        animation: fadeInMsg 0.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        opacity: 0;
        transform: translateY(8px);
    }
    @keyframes fadeInMsg {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('odds-chat-container');
    const toggleBtn = document.getElementById('chat-toggle-btn');
    const closeBtn = document.getElementById('chat-close-btn');
    const chatWindow = document.getElementById('chat-window');
    const chatIconOpen = document.getElementById('chat-icon-open');
    const chatIconClose = document.getElementById('chat-icon-close');
    const chatForm = document.getElementById('chat-form');
    const chatInput = document.getElementById('chat-input');
    const chatMessages = document.getElementById('chat-messages');
    const typingIndicator = document.getElementById('typing-indicator');

    if (!container || !toggleBtn || !closeBtn || !chatWindow || !chatForm || !chatInput || !chatMessages || !typingIndicator) {
        return;
    }

    // Toggle chat window open/close
    toggleBtn.addEventListener('click', toggleChat);
    closeBtn.addEventListener('click', closeChat);

    function toggleChat() {
        const isHidden = chatWindow.classList.contains('hidden');
        if (isHidden) {
            openChat();
        } else {
            closeChat();
        }
    }

    function openChat() {
        chatWindow.classList.remove('hidden');
        chatWindow.classList.add('flex');
        // Animation trigger
        setTimeout(() => {
            chatWindow.style.opacity = '1';
            chatWindow.style.transform = 'scale(1)';
        }, 10);
        
        chatIconOpen.classList.add('hidden');
        chatIconClose.classList.remove('hidden');
        chatInput.focus();
    }

    function closeChat() {
        chatWindow.style.opacity = '0';
        chatWindow.style.transform = 'scale(0.95)';
        
        // Wait for animation to finish
        setTimeout(() => {
            chatWindow.classList.add('hidden');
            chatWindow.classList.remove('flex');
        }, 250);

        chatIconOpen.classList.remove('hidden');
        chatIconClose.classList.add('hidden');
    }

    // Initialize initial styles for transition
    chatWindow.style.transition = 'opacity 0.25s cubic-bezier(0.16, 1, 0.3, 1), transform 0.25s cubic-bezier(0.16, 1, 0.3, 1)';
    chatWindow.style.opacity = '0';
    chatWindow.style.transform = 'scale(0.95)';

    // Handle form submit
    chatForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const messageText = chatInput.value.trim();
        if (!messageText) return;

        // Append user message
        appendMessage(messageText, 'user');
        chatInput.value = '';
        
        // Show typing indicator
        showTyping(true);

        try {
            const csrfTokenElement = document.querySelector('input[name="_token"]');
            const csrfToken = csrfTokenElement ? csrfTokenElement.value : '';

            const response = await fetch('/api/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ message: messageText })
            });

            const data = await response.json();
            showTyping(false);

            if (response.ok && data.reply) {
                appendMessage(data.reply, 'assistant');
            } else {
                appendMessage(data.error || 'Oops, something went wrong. Please try again.', 'system');
            }
        } catch (error) {
            console.error('Chat error:', error);
            showTyping(false);
            appendMessage('Connection error. Please check your network and try again.', 'system');
        }
    });

    function appendMessage(text, sender) {
        const messageDiv = document.createElement('div');
        messageDiv.classList.add('flex', 'gap-2', 'max-w-[85%]', 'fade-in-message');

        if (sender === 'user') {
            messageDiv.classList.add('ml-auto', 'justify-end');
            messageDiv.innerHTML = `
                <div class="text-white text-xs py-2.5 px-3.5 rounded-2xl rounded-tr-none leading-relaxed break-words" style="background: #cf5aa8;">
                    ${escapeHtml(text)}
                </div>
            `;
        } else if (sender === 'assistant') {
            messageDiv.innerHTML = `
                <div class="flex-shrink-0 w-6 h-6 rounded-full bg-zinc-800 text-zinc-300 flex items-center justify-center text-[9px] font-bold">
                    ODDS
                </div>
                <div class="bg-zinc-800/80 text-zinc-100 text-xs py-2.5 px-3.5 rounded-2xl rounded-tl-none border border-[#ffffff05] leading-relaxed break-words">
                    ${formatResponse(text)}
                </div>
            `;
        } else {
            // System or error messages
            messageDiv.classList.add('mx-auto');
            messageDiv.innerHTML = `
                <div class="bg-red-950/40 text-red-300 text-[11px] py-1.5 px-3 rounded-lg border border-red-900/30 text-center">
                    ${escapeHtml(text)}
                </div>
            `;
        }

        chatMessages.appendChild(messageDiv);
        
        // Auto scroll to bottom
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function showTyping(show) {
        if (show) {
            typingIndicator.classList.remove('hidden');
            typingIndicator.classList.add('flex');
            chatMessages.scrollTop = chatMessages.scrollHeight;
        } else {
            typingIndicator.classList.add('hidden');
            typingIndicator.classList.remove('flex');
        }
    }

    function escapeHtml(string) {
        return String(string)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function formatResponse(text) {
        // Convert simple markdown-like elements (bold, lists, links) to HTML safely
        let html = escapeHtml(text);
        
        // Replace bold **text**
        html = html.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
        
        // Replace newlines with <br>
        html = html.replace(/\n/g, '<br>');

        return html;
    }
});
</script>
