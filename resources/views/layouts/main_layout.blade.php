<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>John Lloyd Olipani</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=SN+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
    @vite('resources/css/main_style.css')
</head>
<body>
    <div class="top-nav">
        <div class="top-nav-inner">
            <ul class="nav-links">
                <li><a href="/home" class="swap-text">home</a></li>
                <li><a href="/blogs" class="swap-text">blogs</a></li>
                <li><a href="/projects" class="swap-text">projects</a></li>
                <li><a href="/contact" class="swap-text">contact</a></li>
            </ul>
            <div class="top-toggles">
                <button class="toggle-btn"><img src="/images/chatbot.png" class="app-mode" loading="lazy"></button>
                <button class="toggle-btn"><img src="/images/night.png" class="app-mode" loading="lazy"></button>
            </div> 
        </div>
    </div>
    
    <!-- Chatbot Widget -->
    <div id="chatbot-widget" class="chatbot-widget">
        <div class="chatbot-header" id="chatbot-header">
            <span>Chat with</span>
            <span style="display:flex;align-items:center;margin-top:4px;">
                <span style="display:inline-block;width:10px;height:10px;background:#2ecc40;border-radius:50%;margin-right:8px;"></span>
                <span>Polanch</span>
            </span>
            <img id="chatbot-arrow" src="" alt="" style="width:20px;height:20px;display:none;">
        </div>
        <div id="chatbot-body" class="chatbot-body">
            <div id="chatbot-messages" class="chatbot-messages"></div>
            <form class="chatbot-input-row" id="chatbot-form" autocomplete="off" onsubmit="return false;">
                <input id="chatbot-input" type="text" placeholder="Ask something..." autocomplete="off">
                <button id="chatbot-send" type="submit">Send</button>
            </form>
        </div>
    </div>
    <script>
        const chatbotWidget = document.getElementById('chatbot-widget');
        const chatbotHeader = document.getElementById('chatbot-header');
        chatbotHeader.style.cursor = 'pointer';
        chatbotHeader.addEventListener('click', () => {
            chatbotWidget.classList.toggle('active');
        });
        // Collapse chatbot when clicking outside
        window.addEventListener('mousedown', function(e) {
            if (!chatbotWidget.contains(e.target)) {
                chatbotWidget.classList.remove('active');
            }
        });
    </script>
    
    @yield('content')

    <div class="footer">
        <p>© 2026 John Lloyd Olipani. All rights reserved.</p>
        <a href="/privacy">Privacy and Terms</a>
    </div>
    
    @vite('resources/js/main_script.js')
</body>
</html>
