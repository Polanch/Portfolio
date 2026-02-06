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
                <a class="navbar-btn contact-btn" href="/contact">Contact Me</a>
                <button class="navbar-btn mode-toggle">
                    <img src="/images/night.png" alt="Mode Toggle" class="mode-icon">
                </button>
                <div class="pfp-dropdown-wrapper">
                    <img src="/images/pfp2.jpg" alt="Profile" class="navbar-pfp" id="pfp-trigger">
                    <div class="pfp-dropdown" id="pfp-dropdown">
                        <a href="https://www.facebook.com/lm.olipani/" class="dropdown-item"><img src="/images/facebook.png" alt="Facebook"> Facebook</a>
                        <a href="https://pin.it/31KHs7Mby" class="dropdown-item"><img src="/images/pinterest.png" alt="Pinterest"> Pinterest</a>
                        <a href="https://x.com/OlipaniJoh92344" class="dropdown-item"><img src="/images/twitter.png" alt="X"> X</a>
                        <a href="https://www.reddit.com/user/Ampolanch/" class="dropdown-item"><img src="/images/reddit.png" alt="Reddit"> Reddit</a>
                        <a href="https://www.youtube.com/@polanch/videos" class="dropdown-item"><img src="/images/youtube.png" alt="YouTube"> YouTube</a>
                        <a href="https://www.linkedin.com/in/john-lloyd-olipani-bb2996290/" class="dropdown-item"><img src="/images/linkedin.png" alt="LinkedIn"> LinkedIn</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-wrapper">
            <div class="content-wrapper">
                <div class="bunny-section">
                    <!-- Monetization Ad Placeholder with Bunny GIF fallback -->
                    <div id="ad-container" style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;min-height:180px;position:relative;">
                        <img id="bunny-fallback" src="/images/bunny.gif" alt="Bunny" style="max-width:100%;max-height:100%;position:absolute;left:50%;top:50%;transform:translate(-50%,-50%);z-index:0;">
                        <!-- Example: Google AdSense Responsive Ad -->
                        <!-- Replace the data-ad-client and data-ad-slot with your own values -->
                        <ins class="adsbygoogle"
                             style="display:block;position:relative;z-index:1;"
                             data-ad-client="ca-pub-xxxxxxxxxxxxxxxx"
                             data-ad-slot="1234567890"
                             data-ad-format="auto"
                             data-full-width-responsive="true"></ins>
                        <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                            // Hide bunny.gif if ad loads
                            window.addEventListener('load', function() {
                                setTimeout(function() {
                                    var ad = document.querySelector('#ad-container ins.adsbygoogle');
                                    var bunny = document.getElementById('bunny-fallback');
                                    if (ad && ad.offsetHeight > 0) {
                                        bunny.style.display = 'none';
                                    } else {
                                        bunny.style.display = 'block';
                                    }
                                }, 2000); // Wait for ad to attempt to load
                            });
                        </script>
                    </div>
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
                            <a class="action-btn icon-only" id="github-btn" href="https://github.com/Polanch" target="_blank" rel="noopener noreferrer"><img src="/images/github2.png" alt="github"></a>
                            <a class="action-btn icon-only" id="linkedin-btn" href="https://www.linkedin.com/in/john-lloyd-olipani-bb2996290/" target="_blank" rel="noopener noreferrer"><img src="/images/linkedin.png" alt="linkedin"></a>
                            <div class="share-dropdown-wrapper">
                                <button class="action-btn" id="share-btn"><img src="/images/share.png" alt="share">Share</button>
                                <div class="share-dropdown" id="share-dropdown">
                                    <a href="#" class="share-item" data-social="facebook"><img src="/images/facebook.png" alt="Facebook"> Facebook</a>
                                    <a href="#" class="share-item" data-social="pinterest"><img src="/images/pinterest.png" alt="Pinterest"> Pinterest</a>
                                    <a href="#" class="share-item" data-social="twitter"><img src="/images/twitter.png" alt="X"> X</a>
                                    <a href="#" class="share-item" data-social="reddit"><img src="/images/reddit.png" alt="Reddit"> Reddit</a>
                                    <a href="#" class="share-item" data-social="whatsapp"><img src="/images/whatsapp.png" alt="WhatsApp"> WhatsApp</a>
                                    <a href="#" class="share-item" data-social="linkedin"><img src="/images/linkedin2.png" alt="LinkedIn"> LinkedIn</a>
                                    <a href="#" class="share-item copy-link-item"><img src="/images/link.png" alt="Copy Link"> Copy Link</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="banner-information">
                    <div class="view-information">
                        <h4 id="view-count">0</h4>
                        <h4>views</h4>
                        <h4 id="current-date">Month day, year</h4>
                    </div>
                    <div class="description-box">
                        <div class="description-content" id="description-content">
                            <span class="message">
                                <p>This is my unfiltered and casual self introduction😇</br>💼 If you want my professional summary, proceed to my portfolio.</p>
                            </span>
                            <span class="message">
                                <p>I like to chat and I am very noisy when happy🤭 My laugh is way too loud 😂 but I swear I am just genuinely glad to have people to talk to🥀</p>
                            </span>
                            <span class="message">
                                <p>I am someone you could call a disguised normie but actually a huge geek🤓. I like playing games, watching anime, reading manga and I hate it when my friends pull me out of that comfort zone. I rarely drink cause honestly I don't like the taste, I prefer coke over it anytime.</p>
                            </span>
                            <span class="message hidden-message">
                                <p>I like coding 💻, drawing in digital arts and secretly making content on YouTube that nobody probably watches. Like any programmer, I am a coffee☕  person and a night owl. 😅 </br></br>Love life? Nah I can't even afford my needs and wants, let alone someone else's.</p>
                            </span>
                            <span class="message hidden-message">
                                <p>But hey, if you want to know more about me, just reach me out through my social media accounts or check my portfolio. 🙏 </br></br>Thank you for dropping by!</p>
                            </span>
                        </div>
                        <button class="read-more-btn" id="read-more-btn">Show more</button>
                    </div>
                </div>
                <div class="comments-section">
                    <div class="comments-header">
                        <h3><span id="comment-count">0</span> Comments</h3>
                        <div class="sort-dropdown-wrapper" style="display:inline-block;position:relative;">
                            <button class="sort-btn" id="sort-btn" style="background:none;border:none;cursor:pointer;font-weight:500;">Sort by</button>
                            <div class="sort-dropdown" id="sort-dropdown" style="display:none;position:absolute;right:0;top:100%;background:#fff;border:1px solid #ddd;border-radius:6px;box-shadow:0 2px 8px rgba(0,0,0,0.07);z-index:10;min-width:140px;">
                                <div class="sort-option" data-sort="recent" style="padding:8px 16px;cursor:pointer;">Most Recent</div>
                                <div class="sort-option" data-sort="oldest" style="padding:8px 16px;cursor:pointer;">Oldest</div>
                                <div class="sort-option" data-sort="liked" style="padding:8px 16px;cursor:pointer;">Most Liked</div>
                            </div>
                        </div>
                    </div>

                    @auth
                        <div class="user-info-bar">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                @if(auth()->user()->profile_picture)
                                    <img src="/storage/{{ auth()->user()->profile_picture }}" alt="{{ auth()->user()->name }}" style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover; border:2px solid #000;">
                                @else
                                    <div style="width: 32px; height: 32px; border-radius: 50%; background: #ddd; display: flex; align-items: center; justify-content: center; border:2px solid #000;">👤</div>
                                @endif
                                <span id="user-name">{{ auth()->user()->name }}</span>
                            </div>
                            <form action="/logout" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="logout-btn" style="background: none; border: none; color: #0066cc; cursor: pointer; text-decoration: underline;">Logout</button>
                            </form>
                        </div>

                        <div class="comment-form">
                            <form id="comment-form" style="display: flex; flex-direction: column; gap: 12px;">
                                @csrf
                                <textarea name="comment" placeholder="Share your thoughts..." maxlength="500" required style="flex: 1; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-family: inherit; resize: vertical; min-height: 80px;"></textarea>
                                <button type="submit" class="auth-submit-btn">Comment</button>
                            </form>
                        </div>
                    @endauth

                    @guest
                        <div class="comment-form">
                            <textarea placeholder="Share your thoughts..." maxlength="500" disabled style="opacity: 0.5;"></textarea>
                            <div class="auth-buttons-container">
                                <button class="auth-btn login-btn" onclick="window.openAuthModal('login')">Login</button>
                                <button class="auth-btn register-btn" onclick="window.openAuthModal('signup')">Register</button>
                            </div>
                        </div>
                    @endguest

                    <div class="comments-container" id="comments-container">
                        <div class="no-comments" id="no-comments-msg">No comments yet. Be the first to comment!</div>
                    </div>
                </div>
            </div>
            <div class="blogs-sidebar">
                <div class="blogs-header">
                    <div class="blog-filters">
                        <button class="filter-btn active" data-filter="newest">Newest</button>
                        <button class="filter-btn" data-filter="oldest">Oldest</button>
                        <button class="filter-btn" data-filter="views">Most Viewed</button>
                    </div>
                </div>
                <div class="blog-cards-container">
                    <div class="blog-card">
                        <div class="blog-thumbnail">
                            <img src="/images/placeholder.png" alt="Blog 1">
                        </div>
                        <div class="blog-info">
                            <div class="blog-header">
                                <img src="/images/pfp3.jpg" alt="Author" class="blog-author-pfp">
                                <h4>My First Blog Post</h4>
                            </div>
                        </div>
                    </div>
                    <div class="blog-card">
                        <div class="blog-thumbnail">
                            <img src="/images/placeholder.png" alt="Blog 2">
                        </div>
                        <div class="blog-info">
                            <div class="blog-header">
                                <img src="/images/pfp3.jpg" alt="Author" class="blog-author-pfp">
                                <h4>Web Development Tips</h4>
                            </div>
                        </div>
                    </div>
                    <div class="blog-card">
                        <div class="blog-thumbnail">
                            <img src="/images/placeholder.png" alt="Blog 3">
                        </div>
                        <div class="blog-info">
                            <div class="blog-header">
                                <img src="/images/pfp3.jpg" alt="Author" class="blog-author-pfp">
                                <h4>Learning JavaScript</h4>
                            </div>
                        </div>
                    </div>
                    <div class="blog-card">
                        <div class="blog-thumbnail">
                            <img src="/images/placeholder.png" alt="Blog 4">
                        </div>
                        <div class="blog-info">
                            <div class="blog-header">
                                <img src="/images/pfp3.jpg" alt="Author" class="blog-author-pfp">
                                <h4>Full Stack Development</h4>
                            </div>
                        </div>
                    </div>
                    <div class="blog-card">
                        <div class="blog-thumbnail">
                            <img src="/images/placeholder.png" alt="Blog 5">
                        </div>
                        <div class="blog-info">
                            <div class="blog-header">
                                <img src="/images/pfp3.jpg" alt="Author" class="blog-author-pfp">
                                <h4>Laravel Best Practices</h4>
                            </div>
                        </div>
                    </div>
                    <div class="blog-card">
                        <div class="blog-thumbnail">
                            <img src="/images/placeholder.png" alt="Blog 5">
                        </div>
                        <div class="blog-info">
                            <div class="blog-header">
                                <img src="/images/pfp3.jpg" alt="Author" class="blog-author-pfp">
                                <h4>Laravel Best Practices</h4>
                            </div>
                        </div>
                    </div>
                    <div class="blog-card">
                        <div class="blog-thumbnail">
                            <img src="/images/placeholder.png" alt="Blog 5">
                        </div>
                        <div class="blog-info">
                            <div class="blog-header">
                                <img src="/images/pfp3.jpg" alt="Author" class="blog-author-pfp">
                                <h4>Laravel Best Practices</h4>
                            </div>
                        </div>
                    </div>
                    <div class="blog-card">
                        <div class="blog-thumbnail">
                            <img src="/images/placeholder.png" alt="Blog 5">
                        </div>
                        <div class="blog-info">
                            <div class="blog-header">
                                <img src="/images/pfp3.jpg" alt="Author" class="blog-author-pfp">
                                <h4>Laravel Best Practices</h4>
                            </div>
                        </div>
                    </div>
                    <div class="blog-card">
                        <div class="blog-thumbnail">
                            <img src="/images/placeholder.png" alt="Blog 5">
                        </div>
                        <div class="blog-info">
                            <div class="blog-header">
                                <img src="/images/pfp3.jpg" alt="Author" class="blog-author-pfp">
                                <h4>Laravel Best Practices</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <p>&copy; 2026 John Lloyd F. Olipani</p>
            <a href="">Privacy Policy</a>
        </div>
    </div>

    <!-- Auth Modal -->
    <div class="auth-modal" id="auth-modal">
        <div class="auth-modal-content">
            <button class="modal-close" id="close-modal">&times;</button>
            
            <div class="auth-tabs">
                <button class="auth-tab-btn active" data-tab="login">Login</button>
                <button class="auth-tab-btn" data-tab="signup">Sign Up</button>
            </div>

            <!-- Login Form -->
            <form class="auth-form active" id="login-form" data-form="login">
                <h2>Welcome Back</h2>
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" autocomplete="email" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" autocomplete="current-password" required>
                </div>
                <button type="submit" class="auth-submit-btn">Login</button>
                <p class="form-footer">Don't have an account? <button type="button" class="switch-tab" data-tab="signup">Sign up here</button></p>
            </form>

            <!-- Sign Up Form -->
            <form class="auth-form" id="signup-form" data-form="signup" enctype="multipart/form-data">
                <h2>Create Account</h2>
                <div class="form-group">
                    <input type="text" name="name" placeholder="Full Name" autocomplete="name" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" autocomplete="email" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" autocomplete="new-password" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" autocomplete="new-password" required>
                </div>
                <div class="form-group">
                    <label for="signup-profile-picture" style="display: block; margin-bottom: 8px; font-size: 0.9rem; color: #666; font-weight: 600;">Profile Picture (Optional)</label>
                    <input type="file" id="signup-profile-picture" name="profile_picture" accept="image/*" class="file-input">
                </div>
                <button type="submit" class="auth-submit-btn">Sign Up</button>
                <p class="form-footer">Already have an account? <button type="button" class="switch-tab" data-tab="login">Login here</button></p>
            </form>
        </div>
    </div>

    @vite('resources/js/welcome.js')
</body>
</html>