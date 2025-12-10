<!-- Floating Chat Button -->
<button onclick="toggleChat()" class="fixed bottom-6 right-6 w-14 h-14 bg-gradient-to-br from-purple-500 to-blue-500 hover:from-purple-600 hover:to-blue-600 text-white rounded-xl shadow-lg hover:shadow-xl z-50 transition-all duration-200 hover:scale-105 flex items-center justify-center group">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
    </svg>
    <span class="absolute -right-1 -top-1 flex h-3 w-3">
        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
        <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500 border-2 border-white"></span>
    </span>
</button>

<!-- Chat Window -->
<div id="chatWindow" class="fixed bottom-24 right-6 w-[360px] bg-white rounded-xl shadow-xl z-50 chat-widget chat-hidden flex flex-col border border-gray-200 overflow-hidden" style="height: 520px;">
    <!-- Header -->
    <div class="bg-gradient-to-r from-purple-500 to-blue-500 px-4 py-3 flex justify-between items-center text-white">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"/></svg>
            </div>
            <div>
                <h3 class="font-bold text-sm">AssetBot AI</h3>
                <p class="text-xs opacity-90 flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 bg-green-400 rounded-full animate-pulse"></span>
                    <span>Online</span>
                </p>
            </div>
        </div>
        <button onclick="toggleChat()" class="opacity-80 hover:opacity-100 transition-opacity duration-200 w-7 h-7 rounded-md hover:bg-white/10 flex items-center justify-center">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>

    <!-- Chat Messages -->
    <div id="chatBox" class="flex-1 p-4 overflow-y-auto bg-gray-50 space-y-3 prose">
        <div class="flex gap-2 animate-fade-up">
            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-purple-400 to-blue-500 flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"/></svg>
            </div>
            <div class="bg-white p-3 rounded-lg rounded-tl-sm text-sm text-gray-700 shadow-sm max-w-[80%] border border-gray-100">
                <p class="font-semibold text-purple-600 mb-1 text-xs">AssetBot AI</p>
                <p class="text-xs">Halo! Ada yang bisa saya bantu terkait inventaris aset?</p>
            </div>
        </div>
        <div id="loadingIndicator" class="hidden flex gap-2">
            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-purple-400 to-blue-500 flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"/></svg>
            </div>
            <div class="bg-white p-3 rounded-lg rounded-tl-sm text-sm text-gray-600 shadow-sm border border-gray-100">
                <div class="flex items-center gap-2">
                    <div class="flex gap-1">
                        <div class="w-1.5 h-1.5 bg-purple-500 rounded-full animate-bounce" style="animation-delay: 0s"></div>
                        <div class="w-1.5 h-1.5 bg-purple-500 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                        <div class="w-1.5 h-1.5 bg-purple-500 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                    </div>
                    <span class="italic text-xs">Sedang berpikir...</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Input Area -->
    <div class="p-3 bg-white border-t border-gray-200 flex gap-2">
        <input type="text" id="userInput" class="flex-1 bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-100 transition-all" placeholder="Ketik pertanyaan..." onkeypress="handleEnter(event)">
        <button onclick="sendMessage()" class="w-10 h-10 bg-gradient-to-br from-purple-500 to-blue-500 text-white rounded-lg hover:shadow-md transition-all duration-200 flex items-center justify-center hover:scale-105">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
            </svg>
        </button>
    </div>
</div>

<script>
    // Toggle Chat Window
    function toggleChat() {
        const win = document.getElementById('chatWindow');
        win.classList.toggle('chat-hidden');
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
                <div class="bg-gradient-to-br from-purple-500 to-blue-500 text-white p-3 rounded-lg rounded-tr-sm text-xs shadow-sm max-w-[80%]">
                    ${text}
                </div>
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-gray-300 to-gray-400 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                </div>
            `;
        } else {
            const parsedText = marked.parse(text);
            contentHtml = `
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-purple-400 to-blue-500 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"/></svg>
                </div>
                <div class="bg-white p-3 rounded-lg rounded-tl-sm text-sm text-gray-700 shadow-sm max-w-[80%] prose prose-sm border border-gray-100">
                    ${parsedText}
                </div>
            `;
        }
        
        div.innerHTML = contentHtml;
        chatBox.insertBefore(div, loadingIndicator);
        chatBox.scrollTop = chatBox.scrollHeight;
    }
</script>