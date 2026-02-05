// Dark Mode Toggle
document.addEventListener('DOMContentLoaded', () => {
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
});
