<!-- Floating Chat Button -->
<button id="chatButton" onclick="toggleChat()" class="fixed bottom-6 right-6 w-12 h-12 bg-gradient-to-br from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white rounded-full shadow-lg hover:shadow-2xl z-50 transition-all duration-300 hover:scale-110 flex items-center justify-center group">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
    </svg>
    <span class="absolute -right-0.5 -top-0.5 flex h-2.5 w-2.5">
        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-500"></span>
    </span>
</button>

<!-- Chat Window -->
<div id="chatWindow" class="fixed bottom-20 right-6 w-[380px] bg-white rounded-2xl shadow-2xl z-50 chat-widget chat-hidden flex flex-col overflow-hidden" style="height: 550px; border: 1px solid rgba(0,0,0,0.08);">
    <!-- Header -->
    <div class="bg-gradient-to-r from-purple-600 to-blue-600 px-4 py-3.5 flex justify-between items-center text-white shadow-sm">
        <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 bg-white/25 backdrop-blur-sm rounded-full flex items-center justify-center ring-2 ring-white/30">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div>
                <h3 class="font-bold text-sm leading-tight">AssetBot AI</h3>
                <p class="text-xs opacity-95 flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 bg-green-300 rounded-full animate-pulse shadow-sm"></span>
                    <span>Siap membantu Anda</span>
                </p>
            </div>
        </div>
        <button onclick="toggleChat()" class="w-7 h-7 rounded-full hover:bg-white/20 transition-all duration-200 flex items-center justify-center group">
            <svg class="w-4 h-4 group-hover:rotate-90 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <!-- Chat Messages -->
    <div id="chatBox" class="flex-1 p-3 overflow-y-auto bg-gradient-to-b from-gray-50 to-white space-y-2.5">
        <div class="flex gap-2 animate-fade-up">
            <div class="w-7 h-7 rounded-full bg-gradient-to-br from-purple-500 to-blue-600 flex items-center justify-center flex-shrink-0 shadow-sm">
                <svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="bg-white p-2.5 rounded-2xl rounded-tl-sm text-gray-700 shadow-sm max-w-[75%] border border-gray-100">
                <p class="text-xs leading-relaxed m-0">Halo! 👋 Ada yang bisa saya bantu terkait inventaris aset?</p>
            </div>
        </div>
        <div id="loadingIndicator" class="hidden flex gap-2">
            <div class="w-7 h-7 rounded-full bg-gradient-to-br from-purple-500 to-blue-600 flex items-center justify-center flex-shrink-0 shadow-sm">
                <svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="bg-white p-2.5 rounded-2xl rounded-tl-sm text-gray-600 shadow-sm border border-gray-100">
                <div class="flex items-center gap-2">
                    <div class="flex gap-1">
                        <div class="w-1.5 h-1.5 bg-purple-500 rounded-full animate-bounce" style="animation-delay: 0s"></div>
                        <div class="w-1.5 h-1.5 bg-purple-500 rounded-full animate-bounce" style="animation-delay: 0.15s"></div>
                        <div class="w-1.5 h-1.5 bg-purple-500 rounded-full animate-bounce" style="animation-delay: 0.3s"></div>
                    </div>
                    <span class="text-xs italic">Sedang berpikir...</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Input Area -->
    <div class="p-3 bg-white border-t border-gray-100 flex gap-2">
        <input type="text" id="userInput" class="flex-1 bg-gray-50 border border-gray-200 rounded-full px-4 py-2 text-xs focus:outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-100 transition-all placeholder:text-gray-400" placeholder="Ketik pertanyaan Anda..." onkeypress="handleEnter(event)">
        <button onclick="sendMessage()" class="w-9 h-9 bg-gradient-to-br from-purple-600 to-blue-600 text-white rounded-full hover:shadow-lg transition-all duration-200 flex items-center justify-center hover:scale-105 flex-shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
            </svg>
        </button>
    </div>
</div>

<script>
    // Toggle Chat Window
    function toggleChat() {
        const win = document.getElementById('chatWindow');
        const btn = document.getElementById('chatButton');
        
        win.classList.toggle('chat-hidden');
        btn.classList.toggle('button-hidden');
        
        if(!win.classList.contains('chat-hidden')) {
            document.getElementById('userInput').focus();
        }
    }

    // Chat Logic
    const chatBox = document.getElementById('chatBox');
    const userInput = document.getElementById('userInput');
    const loadingIndicator = document.getElementById('loadingIndicator');

    function handleEnter(e) { 
        if (e.key === 'Enter') sendMessage(); 
    }

    async function sendMessage() {
        const text = userInput.value.trim();
        if (!text) return;

        // Display User Message
        appendMessage(text, 'user');
        userInput.value = '';
        loadingIndicator.classList.remove('hidden');
        chatBox.scrollTop = chatBox.scrollHeight;

        try {
            const response = await fetch('/api/v1/chat', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify({ message: text })
            });
            const result = await response.json();
            
            // Display Bot Response
            if (response.ok) {
                appendMessage(result.data.reply, 'bot');
            } else {
                appendMessage("❌ Error: " + (result.message || 'Terjadi kesalahan'), 'bot');
            }
        } catch (error) {
            appendMessage("⚠️ Gagal terhubung ke server. Coba lagi nanti.", 'bot');
        } finally {
            loadingIndicator.classList.add('hidden');
        }
    }

    function appendMessage(text, sender) {
        const div = document.createElement('div');
        div.className = sender === 'user' ? 'flex gap-2 justify-end animate-fade-up' : 'flex gap-2 animate-fade-up';
        
        let contentHtml = '';
        if (sender === 'user') {
            contentHtml = `
                <div class="bg-gradient-to-br from-purple-600 to-blue-600 text-white px-3 py-2 rounded-2xl rounded-tr-sm text-xs shadow-sm max-w-[75%] leading-relaxed">
                    ${text}
                </div>
                <div class="w-7 h-7 rounded-full bg-gradient-to-br from-gray-400 to-gray-500 flex items-center justify-center flex-shrink-0 shadow-sm">
                    <svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                    </svg>
                </div>
            `;
        } else {
            const parsedText = marked.parse(text);
            contentHtml = `
                <div class="w-7 h-7 rounded-full bg-gradient-to-br from-purple-500 to-blue-600 flex items-center justify-center flex-shrink-0 shadow-sm">
                    <svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="bg-white p-2.5 rounded-2xl rounded-tl-sm text-gray-700 shadow-sm max-w-[75%] border border-gray-100 chatbot-response">
                    ${parsedText}
                </div>
            `;
        }
        
        div.innerHTML = contentHtml;
        chatBox.insertBefore(div, loadingIndicator);
        chatBox.scrollTop = chatBox.scrollHeight;
    }
</script>