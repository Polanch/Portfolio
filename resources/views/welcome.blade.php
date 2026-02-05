<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>John Lloyd Olipani</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=SN+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
    @vite('resources/css/welcome.css')
</head>
<body>

    <div class="main-container">
        <div class="top-navbar">
            <div class="navbar-left">
                <div class="logo">Polanch<sup>PH</sup></div>
            </div>
            <div class="navbar-center">
            </div>
            <div class="navbar-right">
                <button class="navbar-btn contact-btn">Contact Me</button>
                <button class="navbar-btn mode-toggle">
                    <img src="/images/night.png" alt="Mode Toggle" class="mode-icon">
                </button>
                <div class="pfp-dropdown-wrapper">
                    <img src="/images/pfp2.jpg" alt="Profile" class="navbar-pfp" id="pfp-trigger">
                    <div class="pfp-dropdown" id="pfp-dropdown">
                        <a href="#" class="dropdown-item"><img src="/images/facebook.png" alt="Facebook"> Facebook</a>
                        <a href="#" class="dropdown-item"><img src="/images/instagram.png" alt="Instagram"> Instagram</a>
                        <a href="#" class="dropdown-item"><img src="/images/twitter.png" alt="X"> X</a>
                        <a href="#" class="dropdown-item"><img src="/images/reddit.png" alt="Reddit"> Reddit</a>
                        <a href="#" class="dropdown-item"><img src="/images/tiktok.png" alt="TikTok"> TikTok</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-wrapper">
            <div class="bunny-section">
                <img src="/images/bunny.gif" id="bunny">
            </div>
            <div class="banner-section">
                <div class="banner-content">
                    <div class="banner-left">
                        <img src="/images/pfp1.jpg" id="profile-picture" alt="Profile Picture" loading="lazy">
                        <div class="banner-text">
                            <h2>John Lloyd F. Olipani</h2>
                            <p>Full Stack Developer</p>
                        </div>
                        <a href="/home" id="portfolio-button">My Portfolio</a>
                    </div>
                    <div class="banner-right">
                        <button class="action-btn" id="github-btn"><img src="/images/github2.png" alt="github"></button>
                        <button class="action-btn" id="linkedin-btn"><img src="/images/linkedin.png" alt="linkedin"></button>
                        <div class="share-dropdown-wrapper">
                            <button class="action-btn" id="share-btn"><img src="/images/share.png" alt="share">Share</button>
                            <div class="share-dropdown" id="share-dropdown">
                                <a href="#" class="share-item" data-social="facebook"><img src="/images/facebook.png" alt="Facebook"> Facebook</a>
                                <a href="#" class="share-item" data-social="instagram"><img src="/images/instagram.png" alt="Instagram"> Instagram</a>
                                <a href="#" class="share-item" data-social="twitter"><img src="/images/twitter.png" alt="X"> X</a>
                                <a href="#" class="share-item" data-social="reddit"><img src="/images/reddit.png" alt="Reddit"> Reddit</a>
                                <a href="#" class="share-item" data-social="tiktok"><img src="/images/tiktok.png" alt="TikTok"> TikTok</a>
                                <a href="#" class="share-item copy-link-item"><img src="/images/link.png" alt="Copy Link"> Copy Link</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="banner-information">
                <span class="view-information">
                    <h4 id="view-count">0</h4>
                    <h4>views</h4>
                    <h4 id="current-date">Month day, year</h4>
                </span>
                <span class="message">
                    <p>This is my unfiltered and casual self introduction😇</br>💼 If you want my professional summary, proceed to my portfolio.</p>
                </span>
                <span class="message">
                    <p>I like to chat and I am very noisy when happy🤭 My laugh is way too loud 😂 but I swear I am just genuinely glad to have people to talk to🥀</p>
                </span>
                <span class="message">
                    <p>I am someone you could call a disguised normie but actually a huge geek🤓. I like playing games, watching anime, reading manga and I hate it when my friends pull me out of that comfort zone. I rarely drink cause honestly I don't like the taste, I prefer coke over it anytime.</p>
                </span>
                <span class="message">
                    <p>I like coding 💻, drawing in digital arts and secretly making content on YouTube that nobody probably watches. Like any programmer, I am a coffee☕  person and a night owl. 😅 </br></br>Love life? Nah I can't even afford my needs and wants, let alone someone else's.</p>
                </span>
                <span class="message">
                    <p>But hey, if you want to know more about me, just reach me out through my social media accounts or check my portfolio. 🙏 </br></br>Thank you for dropping by!</p>
                </span>
            </div>
            <div class="footer"></div>
        </div>
    </div>

    @vite('resources/js/welcome.js')
</body>
</html>