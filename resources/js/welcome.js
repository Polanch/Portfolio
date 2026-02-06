// Dark Mode Toggle
document.addEventListener('DOMContentLoaded', () => {
            // Bunny GIF is now static, no rotation.
        // --- Comment Sort Dropdown ---
        let currentSort = 'recent';
        const sortBtn = document.getElementById('sort-btn');
        const sortDropdown = document.getElementById('sort-dropdown');
        if (sortBtn && sortDropdown) {
            sortBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                sortDropdown.style.display = sortDropdown.style.display === 'block' ? 'none' : 'block';
            });
            document.addEventListener('click', (e) => {
                if (!sortDropdown.contains(e.target) && e.target !== sortBtn) {
                    sortDropdown.style.display = 'none';
                }
            });
            sortDropdown.querySelectorAll('.sort-option').forEach(option => {
                option.addEventListener('click', () => {
                    currentSort = option.getAttribute('data-sort');
                    sortDropdown.style.display = 'none';
                    loadComments();
                });
            });
        }
    // View Counter and Date Display
    const viewCountElement = document.getElementById('view-count');
    const currentDateElement = document.getElementById('current-date');
    
    if (viewCountElement && currentDateElement) {
        // Display current date
        const today = new Date();
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        const formattedDate = today.toLocaleDateString('en-US', options);
        currentDateElement.textContent = formattedDate;

        // Increment view count in database
        fetch('/api/portfolio-views/increment', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ page: 'welcome' })
        })
        .then(response => response.json())
        .then(data => {
            viewCountElement.textContent = data.view_count;
        })
        .catch(error => console.error('Error:', error));
    }

    const modeToggleBtn = document.querySelector('.mode-toggle');
    const modeIcon = modeToggleBtn?.querySelector('.mode-icon');
    let isDarkMode = false;

    if (modeToggleBtn && modeIcon) {
        modeToggleBtn.addEventListener('click', () => {
            isDarkMode = !isDarkMode;
            document.body.classList.toggle('dark-mode', isDarkMode);
            modeIcon.src = isDarkMode ? '/images/day.png' : '/images/night.png';
        });
    }

    // Profile Picture Dropdown
    const pfpTrigger = document.getElementById('pfp-trigger');
    const pfpDropdown = document.getElementById('pfp-dropdown');

    if (pfpTrigger && pfpDropdown) {
        pfpTrigger.addEventListener('click', (e) => {
            e.preventDefault();
            pfpDropdown.classList.toggle('active');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!pfpTrigger.contains(e.target) && !pfpDropdown.contains(e.target)) {
                pfpDropdown.classList.remove('active');
            }
        });

        // Close dropdown when a link is clicked
        const dropdownItems = pfpDropdown.querySelectorAll('.dropdown-item');
        dropdownItems.forEach(item => {
            item.addEventListener('click', () => {
                pfpDropdown.classList.remove('active');
            });
        });
    }

    // Share Button Dropdown
    const shareBtn = document.getElementById('share-btn');
    const shareDropdown = document.getElementById('share-dropdown');

    if (shareBtn && shareDropdown) {
        shareBtn.addEventListener('click', (e) => {
            e.preventDefault();
            shareDropdown.classList.toggle('active');
            shareBtn.classList.toggle('active');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!shareBtn.contains(e.target) && !shareDropdown.contains(e.target)) {
                shareDropdown.classList.remove('active');
                shareBtn.classList.remove('active');
            }
        });

        // Handle share items
        const shareItems = shareDropdown.querySelectorAll('.share-item');
        shareItems.forEach(item => {
            item.addEventListener('click', (e) => {
                e.preventDefault();
                const social = item.getAttribute('data-social');
                
                if (item.classList.contains('copy-link-item')) {
                    // Copy current page URL to clipboard
                    const url = window.location.href;
                    navigator.clipboard.writeText(url).then(() => {
                        alert('Link copied to clipboard!');
                        shareDropdown.classList.remove('active');
                        shareBtn.classList.remove('active');
                    });
                } else if (social) {
                    // Handle social media sharing
                    const url = window.location.href;
                    const text = 'Check out my portfolio!';
                    let shareUrl = '';

                    switch(social) {
                        case 'facebook':
                            shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
                            break;
                        case 'twitter':
                            shareUrl = `https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}&text=${encodeURIComponent(text)}`;
                            break;
                        case 'linkedin':
                            shareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(url)}`;
                            break;
                        case 'reddit':
                            shareUrl = `https://reddit.com/submit?url=${encodeURIComponent(url)}&title=${encodeURIComponent(text)}`;
                            break;
                        case 'instagram':
                            // Instagram doesn't support direct sharing via URL on web
                            alert('Please share this manually on Instagram!');
                            shareDropdown.classList.remove('active');
                            shareBtn.classList.remove('active');
                            return;
                        case 'tiktok':
                            // TikTok doesn't support direct sharing via URL on web
                            alert('Please share this manually on TikTok!');
                            shareDropdown.classList.remove('active');
                            shareBtn.classList.remove('active');
                            return;
                    }

                    if (shareUrl) {
                        window.open(shareUrl, '_blank', 'width=600,height=400');
                    }
                    shareDropdown.classList.remove('active');
                    shareBtn.classList.remove('active');
                }
            });
        });
    }

    // Read More Functionality
    const readMoreBtn = document.getElementById('read-more-btn');
    const descriptionContent = document.getElementById('description-content');

    if (readMoreBtn && descriptionContent) {
        readMoreBtn.addEventListener('click', () => {
            const isExpanded = descriptionContent.classList.contains('expanded');
            descriptionContent.classList.toggle('expanded');
            readMoreBtn.textContent = isExpanded ? 'Show more' : 'Show less';
        });
    }

    // Helper function to escape HTML
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    // Get CSRF token
    function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    }

    // Auth State Management
    let currentUser = null;

    // Check if user is logged in
    async function checkAuthStatus() {
        try {
            const response = await fetch('/api/auth/user', {
                credentials: 'include'
            });
            if (response.ok) {
                currentUser = await response.json();
                updateCommentFormUI();
            } else {
                currentUser = null;
            }
        } catch (error) {
            console.error('Error checking auth status:', error);
        }
    }

    // Logout function
    async function logout(event) {
        if (event) {
            event.preventDefault();
        }

        try {
            const response = await fetch('/api/auth/logout', {
                method: 'POST',
                credentials: 'include',
                headers: {
                    'X-CSRF-TOKEN': getCsrfToken()
                }
            });

            let data;
            const contentType = response.headers.get('content-type');
            
            if (contentType && contentType.includes('application/json')) {
                data = await response.json();
            } else {
                const text = await response.text();
                console.log('Logout response:', response.status, text.substring(0, 200));
            }

            if (response.ok) {
                currentUser = null;
                updateCommentFormUI();
                loadComments();
                // Make logout function available globally
                window.logout = logout;
            } else {
                console.log('Logout error:', data);
                alert('Error logging out');
            }
        } catch (error) {
            console.error('Error logging out:', error);
            alert('Error logging out: ' + error.message);
        }
    }

    // Make logout available globally
    window.logout = logout;

    // Update comment form based on auth status
    function updateCommentFormUI() {
        const userInfoBar = document.getElementById('user-info-bar');
        const commentForm = document.querySelector('.comment-form');
        const buttonsContainer = document.querySelector('.auth-buttons-container') || document.querySelector('.comment-form > div:last-child');
        
        if (!commentForm) return;

        if (currentUser) {
            // User is logged in - show user info bar
            if (userInfoBar) {
                document.getElementById('user-name').textContent = currentUser.name;
                userInfoBar.style.display = 'flex';
            }
            // Enable textarea
            const textarea = commentForm.querySelector('textarea');
            if (textarea) {
                textarea.disabled = false;
            }
        } else {
            // User not logged in - hide user info bar
            if (userInfoBar) {
                userInfoBar.style.display = 'none';
            }
            // Disable textarea and show Login/Register buttons
            const textarea = commentForm.querySelector('textarea');
            if (textarea) {
                textarea.disabled = true;
            }
            // Create or update buttons container
            if (buttonsContainer) {
                buttonsContainer.innerHTML = `
                    <button class="auth-btn login-btn" onclick="window.openAuthModal('login')">Login</button>
                    <button class="auth-btn register-btn" onclick="window.openAuthModal('signup')">Register</button>
                `;
            } else {
                commentForm.innerHTML += `
                    <div class="auth-buttons-container">
                        <button class="auth-btn login-btn" onclick="window.openAuthModal('login')">Login</button>
                        <button class="auth-btn register-btn" onclick="window.openAuthModal('signup')">Register</button>
                    </div>
                `;
            }
        }
    }

    // Attach submit handler to comment button
    function attachCommentSubmitHandler() {
        const commentForm = document.getElementById('comment-form');
        if (commentForm) {
            commentForm.addEventListener('submit', function(e) {
                e.preventDefault();
                submitComment();
            });
        }
    }

    // Submit comment
    async function submitComment() {
        // Get textarea from the comment form
        const commentForm = document.getElementById('comment-form');
        const textarea = commentForm ? commentForm.querySelector('textarea[name="comment"]') : null;
        const comment = textarea ? textarea.value.trim() : '';

        if (!comment) {
            alert('Please enter a comment');
            return;
        }

        if (!currentUser) {
            alert('Please log in to comment');
            window.openAuthModal();
            return;
        }

        try {
            const response = await fetch('/api/comments', {
                method: 'POST',
                credentials: 'include',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken()
                },
                body: JSON.stringify({
                    comment: comment,
                    page: 'welcome'
                })
            });

            const data = await response.json();

            if (response.ok) {
                if (textarea) textarea.value = '';
                loadComments();
            } else {
                console.log('Server response:', response.status, data);
                alert(data.message || 'Error posting comment');
            }
        } catch (error) {
            console.error('Error posting comment:', error);
            alert('Error posting comment: ' + error.message);
        }
    }

    // Load and render comments
    async function loadComments() {
        // --- Preserve open reply threads/forms state ---
        // Only top-level comments have .replies-container (flat threading)
        const openReplies = Array.from(document.querySelectorAll('.replies-container'))
            .filter(el => el.style.display === 'block')
            .map(el => el.id.replace('replies-container-', ''));
        // Save open reply forms for both comments and replies
        const openReplyForms = Array.from(document.querySelectorAll('.reply-form'))
            .map(form => form.id.replace('reply-form-', ''));
        const commentsContainer = document.getElementById('comments-container');
        const noCommentsMsg = document.getElementById('no-comments-msg');

        if (!commentsContainer) return;

        try {
            const response = await fetch('/api/comments?page=welcome', {
                credentials: 'include'
            });
            const data = await response.json();
            
            commentsContainer.innerHTML = '';
            const commentCount = document.getElementById('comment-count');
            
            // Only show top-level comments (no parent)
            let topLevelComments = data.comments.filter(c => !c.parent_comment_id);
            const allComments = data.comments;
            
            // --- Sort logic ---
            if (currentSort === 'recent') {
                topLevelComments.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
            } else if (currentSort === 'oldest') {
                topLevelComments.sort((a, b) => new Date(a.created_at) - new Date(b.created_at));
            } else if (currentSort === 'liked') {
                topLevelComments.sort((a, b) => (b.likes_count || 0) - (a.likes_count || 0));
            }
            // --- Restore open reply threads/forms state ---
            // Restore open replies (expanded threads) for top-level comments only
            for (const id of openReplies) {
                const btn = document.querySelector(`.view-replies-btn[onclick*='${id}']`);
                if (btn) btn.click();
            }
            // Restore open reply forms for both comments and replies
            for (const id of openReplyForms) {
                showReplyForm(id);
            }
            
            if (commentCount) {
                commentCount.textContent = allComments.length;
            }
            
            if (topLevelComments.length === 0) {
                if (noCommentsMsg) {
                    commentsContainer.appendChild(noCommentsMsg.cloneNode(true));
                }
            } else {
                topLevelComments.forEach(comment => {
                    const commentEl = document.createElement('div');
                    commentEl.className = 'comment-item';
                    const commentDate = new Date(comment.created_at).toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'short',
                        day: 'numeric'
                    });

                    // Check if current user owns this comment
                    const isOwner = currentUser && comment.user && currentUser.id === comment.user.id;

                    let replyBtn = '';
                    if (currentUser) {
                        replyBtn = `<button class="reply-comment-btn" onclick="showReplyForm(${comment.id})">Reply</button>`;
                    }

                    // Use user's profile picture or default (handle null user)
                    let avatarUrl = '/images/pfp3.jpg';
                    let userName = 'Anonymous';
                    
                    if (comment.user) {
                        userName = comment.user.name || 'Anonymous';
                        if (comment.user.profile_picture) {
                            avatarUrl = `/storage/${comment.user.profile_picture}`;
                        }
                    }

                    // Count all descendant replies for this comment
                    let replyCount = 0;
                    const queue = [comment.id];
                    while (queue.length > 0) {
                        const currentId = queue.shift();
                        allComments.forEach(c => {
                            if (c.parent_comment_id === currentId) {
                                replyCount++;
                                queue.push(c.id);
                            }
                        });
                    }
                    const replyCountHtml = replyCount > 0 ? `<button class="view-replies-btn" onclick="toggleReplies(${comment.id})"><span class="reply-count">${replyCount}</span> ${replyCount === 1 ? 'reply' : 'replies'}</button>` : '';

                    commentEl.setAttribute('data-comment-id', comment.id);
                    commentEl.innerHTML = `
                        <img src="${avatarUrl}" alt="Avatar" class="comment-avatar" style="border:2px solid #000;">
                        <div class="comment-content">
                            <div class="comment-header">
                                <strong class="comment-name">${escapeHtml(userName)}</strong>
                                <span class="comment-date">${commentDate}</span>
                            </div>
                            <p class="comment-text">${escapeHtml(comment.comment)}</p>
                            <div class="comment-actions">
                                <button class="comment-action-btn like-btn" onclick="voteComment(${comment.id}, 'like')">
                                    👍 <span>${comment.likes_count || 0}</span>
                                </button>
                                <button class="comment-action-btn dislike-btn" onclick="voteComment(${comment.id}, 'dislike')">
                                    👎 <span>${comment.dislikes_count || 0}</span>
                                </button>
                                ${replyBtn}
                            </div>
                            ${replyCountHtml}
                            <div id="replies-container-${comment.id}" class="replies-container" style="display: none;"></div>
                        </div>
                    `;
                    commentsContainer.appendChild(commentEl);
                });
            }
        } catch (error) {
            console.error('Error loading comments:', error);
        }
    }

    // Vote on comment
    window.voteComment = async function(commentId, voteType) {
        if (!currentUser) {
            alert('Please log in to vote');
            window.openAuthModal();
            return;
        }

        try {
            const response = await fetch(`/api/comments/${commentId}/vote`, {
                method: 'POST',
                credentials: 'include',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken()
                },
                body: JSON.stringify({ vote_type: voteType })
            });

            if (response.ok) {
                // Update only the like/dislike count in the DOM for this comment/reply
                const data = await response.json();
                const updated = data.comment || {};
                // For comments
                const commentLikeBtn = document.querySelector(`.comment-item[data-comment-id='${commentId}'] .like-btn span`);
                const commentDislikeBtn = document.querySelector(`.comment-item[data-comment-id='${commentId}'] .dislike-btn span`);
                // For replies
                const replyLikeBtn = document.querySelector(`.reply-item[data-comment-id='${commentId}'] .like-btn span`);
                const replyDislikeBtn = document.querySelector(`.reply-item[data-comment-id='${commentId}'] .dislike-btn span`);
                if (commentLikeBtn) commentLikeBtn.textContent = updated.likes_count || 0;
                if (commentDislikeBtn) commentDislikeBtn.textContent = updated.dislikes_count || 0;
                if (replyLikeBtn) replyLikeBtn.textContent = updated.likes_count || 0;
                if (replyDislikeBtn) replyDislikeBtn.textContent = updated.dislikes_count || 0;
            } else {
                const data = await response.json();
                alert(data.message || 'Error voting on comment');
            }
        } catch (error) {
            console.error('Error voting on comment:', error);
        }
    };

    // Delete comment
    window.deleteComment = async function(commentId) {
        if (!confirm('Are you sure you want to delete this comment?')) {
            return;
        }

        try {
            const response = await fetch(`/api/comments/${commentId}`, {
                method: 'DELETE',
                credentials: 'include',
                headers: {
                    'X-CSRF-TOKEN': getCsrfToken()
                }
            });

            if (response.ok) {
                loadComments();
            } else {
                const data = await response.json();
                alert(data.message || 'Error deleting comment');
            }
        } catch (error) {
            console.error('Error deleting comment:', error);
        }
    };

    // Load comments on page load
    checkAuthStatus();
    loadComments();

    // Blog Filter Functionality
    const filterBtns = document.querySelectorAll('.filter-btn');
    const blogCards = document.querySelectorAll('.blog-card');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Remove active class from all buttons
            filterBtns.forEach(b => b.classList.remove('active'));
            // Add active class to clicked button
            btn.classList.add('active');

            const filterType = btn.getAttribute('data-filter');

            // Mock filtering logic (just shows/hides cards for demo)
            blogCards.forEach(card => {
                card.style.opacity = '1';
                card.style.pointerEvents = 'auto';
            });

            console.log(`Filtered by: ${filterType}`);
        });
    });

    // Auth Modal Functionality
    const authModal = document.getElementById('auth-modal');
    const closeModalBtn = document.getElementById('close-modal');
    const authTabBtns = document.querySelectorAll('.auth-tab-btn');
    const switchTabBtns = document.querySelectorAll('.switch-tab');
    const authForms = document.querySelectorAll('.auth-form');

    // Open modal
    function openAuthModal(tab = 'login') {
        authModal.classList.add('active');
        // Set the active tab
        if (tab === 'signup') {
            authTabBtns.forEach(b => b.classList.remove('active'));
            authForms.forEach(f => f.classList.remove('active'));
            document.querySelector('[data-tab="signup"]').classList.add('active');
            document.getElementById('signup-form').classList.add('active');
        } else {
            authTabBtns.forEach(b => b.classList.remove('active'));
            authForms.forEach(f => f.classList.remove('active'));
            document.querySelector('[data-tab="login"]').classList.add('active');
            document.getElementById('login-form').classList.add('active');
        }
    }

    // Close modal
    function closeAuthModal() {
        authModal.classList.remove('active');
    }

    closeModalBtn.addEventListener('click', closeAuthModal);

    // Close modal when clicking outside
    authModal.addEventListener('click', (e) => {
        if (e.target === authModal) {
            closeAuthModal();
        }
    });

    // Tab switching
    authTabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const tabName = btn.getAttribute('data-tab');
            
            // Update active tab button
            authTabBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            // Update active form
            authForms.forEach(form => form.classList.remove('active'));
            document.getElementById(`${tabName}-form`).classList.add('active');
        });
    });

    // Switch tab from footer link
    switchTabBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const tabName = btn.getAttribute('data-tab');
            
            authTabBtns.forEach(b => b.classList.remove('active'));
            authForms.forEach(f => f.classList.remove('active'));

            document.querySelector(`[data-tab="${tabName}"]`).classList.add('active');
            document.getElementById(`${tabName}-form`).classList.add('active');
        });
    });

    // Login form submission
    const loginForm = document.getElementById('login-form');
    if (loginForm) {
        loginForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const email = loginForm.querySelector('input[type="email"]').value;
            const password = loginForm.querySelector('input[type="password"]').value;

            try {
                const response = await fetch('/api/auth/login', {
                    method: 'POST',
                    credentials: 'include',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': getCsrfToken()
                    },
                    body: JSON.stringify({ email, password })
                });

                const data = await response.json();

                if (response.ok) {
                    currentUser = data.user || data;
                    loginForm.reset();
                    closeAuthModal();
                    window.location.reload();
                } else {
                    alert(data.message || 'Login failed');
                }
            } catch (error) {
                console.error('Error logging in:', error);
                alert('Error logging in');
            }
        });
    }

    // Signup form submission
    const signupForm = document.getElementById('signup-form');
    if (signupForm) {
        signupForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const name = signupForm.querySelector('input[placeholder="Full Name"]').value;
            const email = signupForm.querySelector('input[type="email"]').value;
            const password = signupForm.querySelector('input[placeholder="Password"]').value;
            const passwordConfirm = signupForm.querySelector('input[placeholder="Confirm Password"]').value;
            const profilePictureInput = signupForm.querySelector('input[type="file"]');

            if (password !== passwordConfirm) {
                alert('Passwords do not match');
                return;
            }

            try {
                // Create FormData to handle file upload
                const formData = new FormData();
                formData.append('name', name);
                formData.append('email', email);
                formData.append('password', password);
                formData.append('password_confirmation', passwordConfirm);
                
                // Add profile picture if selected
                if (profilePictureInput.files.length > 0) {
                    formData.append('profile_picture', profilePictureInput.files[0]);
                }
                
                const response = await fetch('/api/auth/register', {
                    method: 'POST',
                    credentials: 'include',
                    headers: {
                        'X-CSRF-TOKEN': getCsrfToken()
                    },
                    body: formData
                });

                let data;
                const contentType = response.headers.get('content-type');
                
                if (contentType && contentType.includes('application/json')) {
                    data = await response.json();
                } else {
                    // Server returned HTML (error page), get the text
                    const htmlText = await response.text();
                    console.log('Unexpected HTML response:', htmlText.substring(0, 500));
                    alert('Server error - check console for details');
                    return;
                }

                if (response.ok) {
                    currentUser = data.user || data;
                    signupForm.reset();
                    closeAuthModal();
                    window.location.reload();
                } else {
                    console.log('Signup error response:', data);
                    // If there are validation errors, display them
                    if (data.errors) {
                        const errorMessages = Object.values(data.errors)
                            .flat()
                            .join('\n');
                        alert(errorMessages);
                    } else {
                        alert(data.message || 'Signup failed');
                    }
                }
            } catch (error) {
                console.error('Error signing up:', error);
                alert('Error signing up: ' + error.message);
            }
        });
    }

    // Toggle display of replies
    async function toggleReplies(parentCommentId) {
        const repliesContainer = document.getElementById(`replies-container-${parentCommentId}`);
        
        if (repliesContainer.style.display === 'none') {
            // Show replies
            repliesContainer.style.display = 'block';
            
            // If already loaded, don't fetch again
            if (repliesContainer.innerHTML === '') {
                await loadReplies(parentCommentId);
            }
        } else {
            // Hide replies
            repliesContainer.style.display = 'none';
        }
    }

    // Load replies for a comment
    async function loadReplies(parentCommentId) {
        try {
            const response = await fetch('/api/comments?page=welcome');
            const data = await response.json();
            
            const repliesContainer = document.getElementById(`replies-container-${parentCommentId}`);
            // Show all replies (including replies to replies) under the parent comment as a flat list
            const allReplies = data.comments.filter(c => c.parent_comment_id !== null);
            // Find all replies that are descendants of this parentCommentId
            const replies = [];
            const queue = [parentCommentId];
            while (queue.length > 0) {
                const currentId = queue.shift();
                allReplies.forEach(reply => {
                    if (reply.parent_comment_id === currentId) {
                        replies.push(reply);
                        queue.push(reply.id);
                    }
                });
            }
            
            if (replies.length === 0) {
                repliesContainer.innerHTML = '<div class="no-replies">No replies yet.</div>';
                return;
            }

            replies.forEach(reply => {
                const replyEl = document.createElement('div');
                replyEl.className = 'reply-item';
                replyEl.setAttribute('data-comment-id', reply.id);

                const replyDate = new Date(reply.created_at).toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric'
                });

                let avatarUrl = '/images/pfp3.jpg';
                let userName = 'Anonymous';
                if (reply.user) {
                    userName = reply.user.name || 'Anonymous';
                    if (reply.user.profile_picture) {
                        avatarUrl = `/storage/${reply.user.profile_picture}`;
                    }
                }

                // Add reply button for replies, but prefill textarea with @username
                let replyBtn = '';
                if (currentUser) {
                    replyBtn = `<button class="reply-comment-btn" onclick="prefillReplyMention(${reply.id}, '${userName.replace(/'/g, "\\'")}')">Reply</button>`;
                }

                replyEl.innerHTML = `
                    <img src="${avatarUrl}" alt="Avatar" class="reply-avatar" style="border:2px solid #000;">
                    <div class="reply-content">
                        <div class="reply-header">
                            <strong class="reply-name">${escapeHtml(userName)}</strong>
                            <span class="reply-date">${replyDate}</span>
                        </div>
                        <p class="reply-text">${escapeHtml(reply.comment)}</p>
                        <div class="reply-actions">
                            <button class="reply-action-btn like-btn" onclick="voteComment(${reply.id}, 'like')">
                                👍 <span>${reply.likes_count || 0}</span>
                            </button>
                            <button class="reply-action-btn dislike-btn" onclick="voteComment(${reply.id}, 'dislike')">
                                👎 <span>${reply.dislikes_count || 0}</span>
                            </button>
                            ${replyBtn}
                        </div>
                    </div>
                `;
                repliesContainer.appendChild(replyEl);
            });
        } catch (error) {
            console.error('Error loading replies:', error);
        }
    }

    // Reply button functionality
    function showReplyForm(parentCommentId) {
        if (!currentUser) {
            alert('Please log in to reply');
            window.openAuthModal('login');
            return;
        }

        // Remove any existing reply forms (only one open at a time)
        document.querySelectorAll('.reply-form').forEach(f => f.remove());

        // Create reply form with proper CSS classes
        const replyForm = document.createElement('div');
        replyForm.id = `reply-form-${parentCommentId}`;
        replyForm.className = 'reply-form';
            replyForm.innerHTML = `
                <form onsubmit="submitReply(event, ${parentCommentId})">
                    <textarea placeholder="Write a reply..." maxlength="500" class="reply-textarea" required></textarea>
                    <div class="reply-form-actions">
                        <button type="submit" style="background:#000;color:#fff;border:none;padding:6px 18px;border-radius:4px;">Reply</button>
                        <button type="button" onclick="document.getElementById('reply-form-${parentCommentId}').remove()">Cancel</button>
                    </div>
                </form>
            `;

        // Find the comment element and insert form after it
        const commentElement = document.querySelector(`[data-comment-id="${parentCommentId}"]`);
        if (commentElement) {
            const repliesContainer = commentElement.querySelector(`.replies-container`);
            if (repliesContainer && repliesContainer.style.display !== 'none') {
                repliesContainer.appendChild(replyForm);
            } else {
                commentElement.parentNode.insertBefore(replyForm, commentElement.nextSibling);
            }
            replyForm.querySelector('.reply-textarea').focus();
        }
    }

    // Submit reply
    async function submitReply(e, parentCommentId) {
        e.preventDefault();
        
        const replyForm = document.getElementById(`reply-form-${parentCommentId}`);
        const replyText = replyForm.querySelector('.reply-textarea').value.trim();

        if (!replyText) {
            alert('Please enter a reply');
            return;
        }

        try {
            const response = await fetch('/api/comments', {
                method: 'POST',
                credentials: 'include',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken()
                },
                body: JSON.stringify({
                    comment: replyText,
                    page: 'welcome',
                    parent_comment_id: parentCommentId
                })
            });

            const data = await response.json();

            if (response.ok) {
                replyForm.remove();
                loadComments();
            } else {
                alert(data.message || 'Error posting reply');
            }
        } catch (error) {
            console.error('Error posting reply:', error);
            alert('Error posting reply');
        }
    }

    // Make these functions available globally
    window.showReplyForm = showReplyForm;
    window.submitReply = submitReply;
    window.toggleReplies = toggleReplies;
    window.loadReplies = loadReplies;
    // Prefill reply textarea with @username for replies to replies
    window.prefillReplyMention = function(parentCommentId, username) {
        // Remove any existing reply forms (only one open at a time)
        document.querySelectorAll('.reply-form').forEach(f => f.remove());
        // Create reply form
        const replyForm = document.createElement('div');
        replyForm.id = `reply-form-${parentCommentId}`;
        replyForm.className = 'reply-form';
            replyForm.innerHTML = `
                <form onsubmit="submitReply(event, ${parentCommentId})">
                    <textarea placeholder="Write a reply..." maxlength="500" class="reply-textarea" required>@${username} </textarea>
                    <div class="reply-form-actions">
                        <button type="submit" style="background:#000;color:#fff;border:none;padding:6px 18px;border-radius:4px;">Reply</button>
                        <button type="button" onclick="document.getElementById('reply-form-${parentCommentId}').remove()">Cancel</button>
                    </div>
                </form>
            `;
        // Insert the reply form directly after the reply element
        const replyElement = document.querySelector(`[data-comment-id='${parentCommentId}']`);
        if (replyElement) {
            replyElement.parentNode.insertBefore(replyForm, replyElement.nextSibling);
            replyForm.querySelector('.reply-textarea').focus();
        }
    };

    // Expose openAuthModal globally so "Join to Comment" button can use it
    window.openAuthModal = openAuthModal;

    // Attach comment submit handler so the comment button works
    attachCommentSubmitHandler();
}); // Close DOMContentLoaded event listener
