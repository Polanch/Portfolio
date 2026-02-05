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
    
    @yield('content')

    <div class="footer">
        <p>© 2026 John Lloyd Olipani. All rights reserved.</p>
        <a href="/privacy">Privacy and Terms</a>
    </div>
    
    @vite('resources/js/main_script.js')
</body>
</html>
