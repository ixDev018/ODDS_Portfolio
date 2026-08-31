<!-- ODDS Chat Widget Container -->
<div class="fixed bottom-6 right-6 z-50 font-sans" id="odds-chat-container" style="width: 0; height: 0;">
    
    <!-- Chat Window (floats above the FAB) -->
    <div 
        id="chat-window"
        class="hidden flex-col w-[315px] sm:w-[345px] h-[460px] rounded-2xl shadow-2xl overflow-hidden transition-all duration-300 origin-bottom-right chat-box-panel absolute bottom-16 right-0"
        style="background: rgba(14, 14, 14, 0.75); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.08); box-shadow: 0 24px 60px rgba(0, 0, 0, 0.8), 0 0 40px rgba(207, 90, 168, 0.08);"
    >
        <!-- Header -->
        <div class="chat-header">
            <div class="chat-profile">
                <!-- Glowing ODDS Icon Avatar -->
                <div class="chat-avatar" style="background: linear-gradient(135deg, #cf5aa8 0%, #875af5 100%); box-shadow: 0 0 12px rgba(207, 90, 168, 0.4);">
                    <svg width="18" height="18" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-white">
                        <path d="M11.3567 12.2224C11.376 12.4818 11.5355 12.7099 11.7726 12.817L19.6574 16.378C20.1484 16.5998 20.6978 16.2154 20.6579 15.6782L20.2762 10.5463C20.2569 10.287 20.0974 10.0589 19.8603 9.95181L11.9755 6.39075C11.4845 6.169 10.9351 6.55335 10.975 7.09063L11.3567 12.2224Z" fill="currentColor"/>
                        <path d="M10.8914 13.253C11.0988 13.096 11.3754 13.0649 11.6124 13.172L19.4972 16.733C19.9882 16.9548 20.0631 17.6211 19.6336 17.9463L15.5312 21.053C15.3239 21.21 15.0472 21.2411 14.8102 21.1341L6.92539 17.573C6.43438 17.3512 6.35946 16.6849 6.78897 16.3597L10.8914 13.253Z" fill="currentColor"/>
                        <path d="M27.9087 13.9543C27.9087 21.6611 21.6611 27.9087 13.9543 27.9087C6.24757 27.9087 0 21.6611 0 13.9543C0 6.24757 6.24757 0 13.9543 0C21.6611 0 27.9087 6.24757 27.9087 13.9543ZM2.99795 13.9543C2.99795 20.0054 7.90329 24.9107 13.9543 24.9107C20.0054 24.9107 24.9107 20.0054 24.9107 13.9543C24.9107 7.90329 20.0054 2.99795 13.9543 2.99795C7.90329 2.99795 2.99795 7.90329 2.99795 13.9543Z" fill="currentColor"/>
                    </svg>
                </div>
                <div class="chat-details">
                    <h3 class="chat-title font-sora">Lorenzo</h3>
                    <div class="chat-status">
                        <span class="chat-status-dot animate-pulse"></span>
                        <span class="chat-status-text">ODDS Studio</span>
                    </div>
                </div>
            </div>
            
            <button 
                id="chat-close-btn"
                class="chat-close-btn active:scale-95"
                aria-label="Close chat"
            >
                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Messages Area -->
        <div 
            id="chat-messages" 
            class="flex-1 overflow-y-auto chat-messages-list scroll-container"
        >
            <!-- Greeting Message -->
            <div class="chat-message-row fade-in-message">
                <div class="chat-message-avatar">
                    <svg width="12" height="12" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-zinc-300">
                        <path d="M11.3567 12.2224C11.376 12.4818 11.5355 12.7099 11.7726 12.817L19.6574 16.378C20.1484 16.5998 20.6978 16.2154 20.6579 15.6782L20.2762 10.5463C20.2569 10.287 20.0974 10.0589 19.8603 9.95181L11.9755 6.39075C11.4845 6.169 10.9351 6.55335 10.975 7.09063L11.3567 12.2224Z" fill="currentColor"/>
                        <path d="M10.8914 13.253C11.0988 13.096 11.3754 13.0649 11.6124 13.172L19.4972 16.733C19.9882 16.9548 20.0631 17.6211 19.6336 17.9463L15.5312 21.053C15.3239 21.21 15.0472 21.2411 14.8102 21.1341L6.92539 17.573C6.43438 17.3512 6.35946 16.6849 6.78897 16.3597L10.8914 13.253Z" fill="currentColor"/>
                        <path d="M27.9087 13.9543C27.9087 21.6611 21.6611 27.9087 13.9543 27.9087C6.24757 27.9087 0 21.6611 0 13.9543C0 6.24757 6.24757 0 13.9543 0C21.6611 0 27.9087 6.24757 27.9087 13.9543ZM2.99795 13.9543C2.99795 20.0054 7.90329 24.9107 13.9543 24.9107C20.0054 24.9107 24.9107 20.0054 24.9107 13.9543C24.9107 7.90329 20.0054 2.99795 13.9543 2.99795C7.90329 2.99795 2.99795 7.90329 2.99795 13.9543Z" fill="currentColor"/>
                    </svg>
                </div>
                <div class="chat-bubble chat-bubble-assistant">
                    Hey! I'm <strong>Lorenzo</strong>. Ask me anything about ODDS—our projects, Simula, or how we collaborate!
                </div>
            </div>

            <!-- Typing Indicator -->
            <div id="typing-indicator" class="hidden chat-message-row chat-typing-wrapper">
                <div class="chat-message-avatar">
                    <svg width="12" height="12" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-zinc-400">
                        <path d="M11.3567 12.2224C11.376 12.4818 11.5355 12.7099 11.7726 12.817L19.6574 16.378C20.1484 16.5998 20.6978 16.2154 20.6579 15.6782L20.2762 10.5463C20.2569 10.287 20.0974 10.0589 19.8603 9.95181L11.9755 6.39075C11.4845 6.169 10.9351 6.55335 10.975 7.09063L11.3567 12.2224Z" fill="currentColor"/>
                        <path d="M10.8914 13.253C11.0988 13.096 11.3754 13.0649 11.6124 13.172L19.4972 16.733C19.9882 16.9548 20.0631 17.6211 19.6336 17.9463L15.5312 21.053C15.3239 21.21 15.0472 21.2411 14.8102 21.1341L6.92539 17.573C6.43438 17.3512 6.35946 16.6849 6.78897 16.3597L10.8914 13.253Z" fill="currentColor"/>
                        <path d="M27.9087 13.9543C27.9087 21.6611 21.6611 27.9087 13.9543 27.9087C6.24757 27.9087 0 21.6611 0 13.9543C0 6.24757 6.24757 0 13.9543 0C21.6611 0 27.9087 6.24757 27.9087 13.9543ZM2.99795 13.9543C2.99795 20.0054 7.90329 24.9107 13.9543 24.9107C20.0054 24.9107 24.9107 20.0054 24.9107 13.9543C24.9107 7.90329 20.0054 2.99795 13.9543 2.99795C7.90329 2.99795 2.99795 7.90329 2.99795 13.9543Z" fill="currentColor"/>
                    </svg>
                </div>
                <div class="chat-bubble chat-bubble-typing chat-bubble-assistant">
                    <span id="typing-status-text" class="chat-typing-status">parsing your request...</span>
                    <span class="chat-typing-dot"></span>
                    <span class="chat-typing-dot"></span>
                    <span class="chat-typing-dot"></span>
                </div>
            </div>
        </div>

        <!-- Input Area -->
        <form id="chat-form" class="chat-input-form">
            @csrf
            <input 
                type="text" 
                id="chat-input"
                placeholder="Ask Lorenzo a question..."
                class="chat-input-field font-sans"
                autocomplete="off"
            >
            <button 
                type="submit"
                class="chat-send-btn hover:scale-105 active:scale-95"
                aria-label="Send message"
            >
                <svg class="w-4 h-4 transform rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                </svg>
            </button>
        </form>
    </div>

    <!-- Chat Toggle Button (FAB) -->
    <button 
        id="chat-toggle-btn"
        class="flex items-center justify-center w-12 h-12 rounded-full text-white shadow-2xl transition-all duration-300 hover:scale-105 active:scale-95 cursor-pointer focus:outline-none absolute bottom-0 right-0 chat-fab"
        style="background: rgba(14, 14, 14, 0.65); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.08); box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3), 0 0 20px rgba(207, 90, 168, 0.25);"
        aria-label="Open Chat with Lorenzo"
    >
        <!-- Inner glow/pulse -->
        <span class="absolute inset-0 rounded-full bg-[#cf5aa8] opacity-0 group-hover:opacity-10 transition-opacity duration-300"></span>
        
        <!-- Toggle Icon (ODDS Geometric Icon) -->
        <div id="chat-icon-open" class="transition-transform duration-300 text-white group-hover:rotate-12">
            <svg width="22" height="22" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11.3567 12.2224C11.376 12.4818 11.5355 12.7099 11.7726 12.817L19.6574 16.378C20.1484 16.5998 20.6978 16.2154 20.6579 15.6782L20.2762 10.5463C20.2569 10.287 20.0974 10.0589 19.8603 9.95181L11.9755 6.39075C11.4845 6.169 10.9351 6.55335 10.975 7.09063L11.3567 12.2224Z" fill="currentColor"/>
                <path d="M10.8914 13.253C11.0988 13.096 11.3754 13.0649 11.6124 13.172L19.4972 16.733C19.9882 16.9548 20.0631 17.6211 19.6336 17.9463L15.5312 21.053C15.3239 21.21 15.0472 21.2411 14.8102 21.1341L6.92539 17.573C6.43438 17.3512 6.35946 16.6849 6.78897 16.3597L10.8914 13.253Z" fill="currentColor"/>
                <path d="M27.9087 13.9543C27.9087 21.6611 21.6611 27.9087 13.9543 27.9087C6.24757 27.9087 0 21.6611 0 13.9543C0 6.24757 6.24757 0 13.9543 0C21.6611 0 27.9087 6.24757 27.9087 13.9543ZM2.99795 13.9543C2.99795 20.0054 7.90329 24.9107 13.9543 24.9107C20.0054 24.9107 24.9107 20.0054 24.9107 13.9543C24.9107 7.90329 20.0054 2.99795 13.9543 2.99795C7.90329 2.99795 2.99795 7.90329 2.99795 13.9543Z" fill="currentColor"/>
            </svg>
        </div>
        
        <!-- Close Icon (initially hidden) -->
        <svg id="chat-icon-close" class="w-5 h-5 hidden transition-transform duration-300 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>

<!-- Custom Layout & Spacing Styles -->
<style>
    /* Font bindings */
    .font-sora {
        font-family: 'Sora', 'Plus Jakarta Sans', sans-serif;
    }
    
    /* Header layout rules */
    .chat-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        background: rgba(20, 20, 24, 0.4);
    }
    .chat-profile {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .chat-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .chat-details {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .chat-title {
        color: #ffffff;
        font-size: 14px;
        font-weight: 700;
        line-height: 1.2;
        letter-spacing: 0.02em;
    }
    .chat-status {
        display: flex;
        align-items: center;
        gap: 5px;
        margin-top: 3px;
    }
    .chat-status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background-color: #cf5aa8;
    }
    .chat-status-text {
        font-size: 9px;
        color: #a1a1aa;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.12em;
    }
    .chat-close-btn {
        color: #a1a1aa;
        background: transparent;
        border: none;
        padding: 6px;
        border-radius: 8px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }
    .chat-close-btn:hover {
        color: #ffffff;
        background: rgba(255, 255, 255, 0.08);
    }

    /* Message list area */
    .chat-messages-list {
        padding: 18px 18px 26px 18px;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }
    .chat-message-row {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        max-width: 90%;
    }
    .chat-message-avatar {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.05);
        margin-top: 2px;
    }

    /* SPECIFICITY OVERRIDE FOR HIDING ELEMENTS */
    .chat-message-row.hidden {
        display: none !important;
    }
    #typing-indicator.hidden {
        display: none !important;
    }

    /* Message bubbles */
    .chat-bubble {
        padding: 10px 14px;
        font-size: 13px;
        line-height: 1.5;
        word-break: break-word;
        box-sizing: border-box;
    }
    .chat-bubble-assistant {
        color: #f4f4f5;
        border-radius: 16px;
        border-top-left-radius: 4px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.05);
        box-shadow: inset 0 1px 1px rgba(255, 255, 255, 0.03);
    }
    .chat-bubble-user {
        color: #ffffff;
        border-radius: 16px;
        border-top-right-radius: 4px;
        background: linear-gradient(135deg, #cf5aa8 0%, #a83f84 100%);
        box-shadow: 0 4px 12px rgba(207, 90, 168, 0.2);
    }
    .chat-bubble-typing {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 10px 14px;
    }
    .chat-typing-status {
        font-family: var(--font-mono, 'JetBrains Mono', monospace);
        font-size: 11.5px;
        color: #a1a1aa;
        margin-right: 3px;
        white-space: nowrap;
    }
    .chat-typing-wrapper {
        margin-top: 4px;
    }
    
    /* Bouncing dots styling */
    .chat-typing-dot {
        width: 5px;
        height: 5px;
        background-color: #cf5aa8;
        border-radius: 50%;
        animation: chatBounce 1.4s infinite ease-in-out both;
        display: inline-block;
    }
    .chat-typing-dot:nth-child(1) { animation-delay: -0.32s; }
    .chat-typing-dot:nth-child(2) { animation-delay: -0.16s; }
    .chat-typing-dot:nth-child(3) { animation-delay: 0s; }

    @keyframes chatBounce {
        0%, 80%, 100% { transform: scale(0.3); opacity: 0.4; }
        40% { transform: scale(1.1); opacity: 1; }
    }

    /* Footer / Input Area styling */
    .chat-input-form {
        padding: 12px 16px;
        background: rgba(10, 10, 12, 0.55);
        border-top: 1px solid rgba(255, 255, 255, 0.06);
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .chat-input-field {
        flex: 1;
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.08);
        color: #ffffff;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 13px;
        outline: none;
        transition: all 0.25s ease;
        box-sizing: border-box;
    }
    .chat-input-field::placeholder {
        color: #71717a;
    }
    .chat-input-field:focus {
        border-color: #cf5aa8;
        background: rgba(255, 255, 255, 0.07);
        box-shadow: 0 0 10px rgba(207, 90, 168, 0.15);
    }
    .chat-send-btn {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        background: linear-gradient(135deg, #cf5aa8 0%, #a83f84 100%);
        box-shadow: 0 4px 15px rgba(207, 90, 168, 0.3);
        transition: all 0.25s ease;
        flex-shrink: 0;
    }
    
    /* Toggle FAB styling */
    .chat-fab:hover {
        border-color: rgba(207, 90, 168, 0.5) !important;
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4), 0 0 30px rgba(207, 90, 168, 0.5) !important;
    }
    
    /* Hide scrollbars but keep scrolling active */
    .scroll-container::-webkit-scrollbar {
        display: none;
    }
    .scroll-container {
        scrollbar-width: none;
        -ms-overflow-style: none;
    }
    
    /* Markdown rendering specifics */
    .chat-bubble-assistant strong {
        color: #ffffff;
        font-weight: 700;
    }
    .chat-bubble-assistant ul {
        list-style-type: disc;
        margin-left: 1.25rem;
        margin-top: 0.4rem;
        margin-bottom: 0.4rem;
    }
    .chat-bubble-assistant li {
        margin-bottom: 0.2rem;
    }

    /* Message animation */
    .fade-in-message {
        animation: fadeInMsg 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        opacity: 0;
        transform: translateY(10px);
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
    const typingStatusText = document.getElementById('typing-status-text');

    const typingPhrases = [
        'parsing your request...',
        'spinning up context...',
        'compiling a response...',
        'cross-checking the stack...',
        'almost shipped...'
    ];

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
        
        // Let display register then trigger transition
        setTimeout(() => {
            chatWindow.style.opacity = '1';
            chatWindow.style.transform = 'scale(1) translateY(0)';
        }, 10);
        
        chatIconOpen.classList.add('hidden');
        chatIconClose.classList.remove('hidden');
        
        // Pulse animation toggle on button
        toggleBtn.style.borderColor = 'rgba(207, 90, 168, 0.4)';
        
        chatInput.focus();
    }

    function closeChat() {
        chatWindow.style.opacity = '0';
        chatWindow.style.transform = 'scale(0.92) translateY(15px)';
        
        // Wait for transition to finish
        setTimeout(() => {
            chatWindow.classList.add('hidden');
            chatWindow.classList.remove('flex');
        }, 250);

        chatIconOpen.classList.remove('hidden');
        chatIconClose.classList.add('hidden');
        
        toggleBtn.style.borderColor = 'rgba(255, 255, 255, 0.08)';
    }

    // Initialize styling transition properties
    chatWindow.style.transition = 'opacity 0.28s cubic-bezier(0.16, 1, 0.3, 1), transform 0.28s cubic-bezier(0.16, 1, 0.3, 1)';
    chatWindow.style.opacity = '0';
    chatWindow.style.transform = 'scale(0.92) translateY(15px)';

    // Prevent key and scroll events from leaking to global page transitions
    chatInput.addEventListener('keydown', (e) => {
        e.stopPropagation();
    });
    chatWindow.addEventListener('wheel', (e) => {
        e.stopPropagation();
    }, { passive: true });

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
                appendMessage(data.error || 'Oops, Lorenzo had an issue processing that. Please try again.', 'system');
            }
        } catch (error) {
            console.error('Chat error:', error);
            showTyping(false);
            appendMessage('Connection error. Please check your network and try again.', 'system');
        }
    });

    function appendMessage(text, sender) {
        const messageDiv = document.createElement('div');
        messageDiv.className = 'chat-message-row fade-in-message';

        if (sender === 'user') {
            messageDiv.classList.add('ml-auto', 'justify-end');
            messageDiv.innerHTML = `
                <div class="chat-bubble chat-bubble-user">
                    ${escapeHtml(text)}
                </div>
            `;
        } else if (sender === 'assistant') {
            messageDiv.innerHTML = `
                <div class="chat-message-avatar">
                    <svg width="12" height="12" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-zinc-300">
                        <path d="M11.3567 12.2224C11.376 12.4818 11.5355 12.7099 11.7726 12.817L19.6574 16.378C20.1484 16.5998 20.6978 16.2154 20.6579 15.6782L20.2762 10.5463C20.2569 10.287 20.0974 10.0589 19.8603 9.95181L11.9755 6.39075C11.4845 6.169 10.9351 6.55335 10.975 7.09063L11.3567 12.2224Z" fill="currentColor"/>
                        <path d="M10.8914 13.253C11.0988 13.096 11.3754 13.0649 11.6124 13.172L19.4972 16.733C19.9882 16.9548 20.0631 17.6211 19.6336 17.9463L15.5312 21.053C15.3239 21.21 15.0472 21.2411 14.8102 21.1341L6.92539 17.573C6.43438 17.3512 6.35946 16.6849 6.78897 16.3597L10.8914 13.253Z" fill="currentColor"/>
                        <path d="M27.9087 13.9543C27.9087 21.6611 21.6611 27.9087 13.9543 27.9087C6.24757 27.9087 0 21.6611 0 13.9543C0 6.24757 6.24757 0 13.9543 0C21.6611 0 27.9087 6.24757 27.9087 13.9543ZM2.99795 13.9543C2.99795 20.0054 7.90329 24.9107 13.9543 24.9107C20.0054 24.9107 24.9107 20.0054 24.9107 13.9543C24.9107 7.90329 20.0054 2.99795 13.9543 2.99795C7.90329 2.99795 2.99795 7.90329 2.99795 13.9543Z" fill="currentColor"/>
                    </svg>
                </div>
                <div class="chat-bubble chat-bubble-assistant">
                    ${formatResponse(text)}
                </div>
            `;
        } else {
            // System or error messages
            messageDiv.classList.add('mx-auto');
            messageDiv.innerHTML = `
                <div class="bg-red-950/40 text-red-300 text-xs py-2 px-4 rounded-lg border border-red-900/30 text-center font-semibold">
                    ${escapeHtml(text)}
                </div>
            `;
        }

        chatMessages.insertBefore(messageDiv, typingIndicator);
        
        // Auto scroll to bottom
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function showTyping(show) {
        if (show) {
            if (typingStatusText) {
                const randomIndex = Math.floor(Math.random() * typingPhrases.length);
                typingStatusText.textContent = typingPhrases[randomIndex];
            }
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
        // Convert simple markdown-like elements safely
        let html = escapeHtml(text);
        
        // Replace bold **text**
        html = html.replace(/\*\/(.*?)\*\//g, '<strong>$1</strong>');
        html = html.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
        
        // Replace bullet lists: lines starting with "- " or "* "
        const lines = html.split('\n');
        let inList = false;
        const processedLines = lines.map(line => {
            const listMatch = line.match(/^(\s*)[-*]\s+(.*)$/);
            if (listMatch) {
                let content = listMatch[2];
                let prefix = '';
                if (!inList) {
                    prefix = '<ul class="list-disc ml-4 my-1">';
                    inList = true;
                }
                return prefix + '<li>' + content + '</li>';
            } else {
                let prefix = '';
                if (inList) {
                    prefix = '</ul>';
                    inList = false;
                }
                return prefix + line;
            }
        });
        
        if (inList) {
            processedLines.push('</ul>');
        }
        
        html = processedLines.join('\n');
        
        // Replace newlines outside lists with <br>
        html = html.replace(/([^>])\n([^<])/g, '$1<br>$2');
        html = html.replace(/<\/ul>\n/g, '</ul>');
        html = html.replace(/<\/li>\n/g, '</li>');
        html = html.replace(/<li>\n/g, '<li>');

        return html;
    }
});
</script>
