<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enterprise Asset Assistant</title>
    <link rel="icon" href="data:,">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        /* Gaya Sederhana namun Modern */
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #f3f4f6; 
            margin: 0; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            overflow: hidden; /* Mencegah scrollbar ganda */
        }
        .chat-container { 
            width: 100%; 
            max-width: 450px; 
            background: white; 
            border-radius: 12px; 
            box-shadow: 0 4px 20px rgba(0,0,0,0.1); 
            display: flex; 
            flex-direction: column; 
            height: 80vh; 
        }
        
        /* Header */
        .chat-header { background: #2563eb; color: white; padding: 20px; text-align: center; }
        .chat-header h2 { margin: 0; font-size: 18px; }
        .chat-header p { margin: 5px 0 0; font-size: 12px; opacity: 0.8; }

        /* Area Pesan */
        .chat-box { flex: 1; padding: 20px; overflow-y: auto; display: flex; flex-direction: column; gap: 15px; }
        .message { max-width: 80%; padding: 10px 15px; border-radius: 10px; font-size: 14px; line-height: 1.5; }
        .message.user { align-self: flex-end; background: #2563eb; color: white; border-bottom-right-radius: 2px; }
        .message.bot { align-self: flex-start; background: #e5e7eb; color: #1f2937; border-bottom-left-radius: 2px; }
        .loading { font-style: italic; color: #6b7280; font-size: 12px; display: none; }

        /* Input Area */
        .input-area { padding: 15px; border-top: 1px solid #e5e7eb; display: flex; gap: 10px; background: white; }
        input { flex: 1; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; outline: none; }
        input:focus { border-color: #2563eb; }
        button { padding: 12px 20px; background: #2563eb; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 500; transition: 0.2s; }
        button:hover { background: #1d4ed8; }
        button:disabled { background: #9ca3af; cursor: not-allowed; }
    </style>
</head>
<body>

<div class="chat-container">
    <div class="chat-header">
        <h2>Asset Assistant 🤖</h2>
        <p>Tanya stok, lokasi, atau status barang</p>
    </div>

    <div class="chat-box" id="chatBox">
        <div class="message bot">
            Halo! Saya asisten gudang. Ada yang bisa saya bantu cek hari ini?
        </div>
        <div class="loading" id="loadingIndicator">Sedang mengetik...</div>
    </div>

    <div class="input-area">
        <input type="text" id="userInput" placeholder="Ketik pesan..." onkeypress="handleEnter(event)">
        <button onclick="sendMessage()" id="sendBtn">Kirim</button>
    </div>
</div>

<script>
    const chatBox = document.getElementById('chatBox');
    const userInput = document.getElementById('userInput');
    const sendBtn = document.getElementById('sendBtn');
    const loadingIndicator = document.getElementById('loadingIndicator');

    function handleEnter(e) {
        if (e.key === 'Enter') sendMessage();
    }

    async function sendMessage() {
        const text = userInput.value.trim();
        if (!text) return;

        appendMessage(text, 'user');
        userInput.value = '';
        userInput.focus();
        showLoading(true);

        try {
            const response = await fetch('/api/v1/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ message: text })
            });

            const result = await response.json();

            if (response.ok) {
                appendMessage(result.data.reply, 'bot');
            } else {
                appendMessage("Maaf, terjadi kesalahan: " + (result.message || 'Error'), 'bot');
            }

        } catch (error) {
            appendMessage("Gagal terhubung ke server. Cek koneksi internet.", 'bot');
            console.error(error);
        } finally {
            showLoading(false);
        }
    }

    function appendMessage(text, sender) {
        const div = document.createElement('div');
        div.classList.add('message', sender);
        
        if (sender === 'bot') {
            let formattedText = text
                .replace(/\n/g, '<br>')
                .replace(/\*\*(.*?)\*\*/g, '<b>$1</b>')
                .replace(/- /g, '• ')  
                .replace(/\* /g, '• '); 
            div.innerHTML = formattedText;
        } else {
            div.innerText = text;
        }
        
        chatBox.insertBefore(div, loadingIndicator);
        scrollToBottom();
    }

    function showLoading(isLoading) {
        loadingIndicator.style.display = isLoading ? 'block' : 'none';
        sendBtn.disabled = isLoading;
        if (isLoading) scrollToBottom();
    }

    function scrollToBottom() {
        chatBox.scrollTop = chatBox.scrollHeight;
    }
</script>

</body>
</html>