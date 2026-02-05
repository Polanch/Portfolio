// Dark Mode Toggle
document.addEventListener('DOMContentLoaded', () => {
    const darkModeBtn = document.querySelector('.toggle-btn:has(.app-mode[src*="night"], .app-mode[src*="day"])');
    const darkModeIcon = darkModeBtn?.querySelector('.app-mode');
    let isDarkMode = false;

    if (darkModeBtn && darkModeIcon) {
        darkModeBtn.addEventListener('click', () => {
            isDarkMode = !isDarkMode;
            document.body.classList.toggle('dark-mode', isDarkMode);
            darkModeIcon.src = isDarkMode ? '/images/day.png' : '/images/night.png';
        });
    }

    // Tab slider for Work/Education toggle
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabSlider = document.querySelector('.tab-slider');
    const windowInner = document.querySelector('.s2-window-inner');
    const s2Window = document.querySelector('.s2-window');
    const workTab = document.querySelector('.work-tab');
    const educationTab = document.querySelector('.education-tab');
    
    // Function to set window height based on active tab
    function setActiveTabHeight(index) {
        if (s2Window) {
            const activeTab = index === 0 ? workTab : educationTab;
            if (activeTab) {
                s2Window.style.height = activeTab.getBoundingClientRect().height + 'px';
            }
        }
    }
    
    // Set initial height after fonts and content are loaded
    setTimeout(() => {
        setActiveTabHeight(0);
    }, 100);
    
    tabBtns.forEach((btn, index) => {
        btn.addEventListener('click', () => {
            // Remove active from all, add to clicked
            tabBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            
            // Slide the background
            tabSlider.style.transform = `translateX(${index * 100}%)`;
            
            // Slide the content window
            if (windowInner) {
                windowInner.style.transform = `translateX(${index * -50}%)`;
            }
            
            // Adjust height to active tab
            setActiveTabHeight(index);
        });
    });
});

// PFP Carousel - Click to cycle cards
document.addEventListener('DOMContentLoaded', () => {
    const pfpHolders = document.querySelectorAll('.pfp-holder');
    
    // Define the rotation/position states for each position in the stack
    const states = [
        { transform: 'rotate(10deg) translateX(20px) translateZ(0px)', zIndex: 1 },   // Back right
        { transform: 'rotate(0deg) translateX(0px) translateZ(0px)', zIndex: 2 },     // Middle
        { transform: 'rotate(-10deg) translateX(-20px) translateZ(0px)', zIndex: 3 }  // Front left
    ];
    
    // Track current position of each card (0, 1, 2)
    let positions = [0, 1, 2];
    let animationsComplete = 0;
    
    // Apply state to a card
    function applyState(card, stateIndex) {
        card.style.transform = states[stateIndex].transform;
        card.style.zIndex = states[stateIndex].zIndex;
        card.style.opacity = '1'; // Ensure carousel items are visible
    }
    
    // Cycle the carousel - move front card to back
    function cycleCarousel() {
        // Shift positions: each card moves up one position, last goes to first
        positions = positions.map(pos => (pos + 1) % 3);
        
        // Apply new states
        pfpHolders.forEach((card, index) => {
            applyState(card, positions[index]);
        });
    }
    
    // Wait for each card's animation to finish
    pfpHolders.forEach((card, index) => {
        card.addEventListener('click', cycleCarousel);
    });
});

// Scroll reveal for timeline items, sub-containers, project cards, and blog cards
document.addEventListener('DOMContentLoaded', () => {
    const timelineItems = document.querySelectorAll('.timeline-item');
    const subContainer1 = document.querySelector('.sub-container-1');
    const subContainer2 = document.querySelector('.sub-container-2');
    const projectCards = document.querySelectorAll('.project-card');
    const blogCards = document.querySelectorAll('.blog-card');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            } else {
                entry.target.classList.remove('visible');
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px 0px 0px'
    });
    
    timelineItems.forEach(item => {
        observer.observe(item);
    });
    
    projectCards.forEach(card => {
        observer.observe(card);
    });
    
    blogCards.forEach(card => {
        observer.observe(card);
    });
    
    if (subContainer1) {
        observer.observe(subContainer1);
    }
    
    if (subContainer2) {
        observer.observe(subContainer2);
    }
});

// Project slideshow
document.addEventListener('DOMContentLoaded', () => {
    const slideshows = {
        cics: ['/project_thumbnails/cics1.webp', '/project_thumbnails/cics2.webp', '/project_thumbnails/cics3.webp'],
        yame: ['/project_thumbnails/yameT1.webp', '/project_thumbnails/yameT2.webp', '/project_thumbnails/yameT3.webp']
    };
    
    const slideshowDelays = {
        cics: 4000,  // Start first change at 4s
        yame: 2000   // Start first change at 2s (offset for unbalanced timing)
    };
    
    const images = document.querySelectorAll('[data-slideshow]');
    
    images.forEach(img => {
        const slideshowName = img.dataset.slideshow;
        const imageList = slideshows[slideshowName];
        const initialDelay = slideshowDelays[slideshowName] || 5000;
        
        if (imageList && imageList.length > 1) {
            let currentIndex = 0;
            
            // Set initial delayed start
            setTimeout(() => {
                // First change
                currentIndex = (currentIndex + 1) % imageList.length;
                img.style.transition = 'opacity 0.3s ease';
                img.style.opacity = '0.5';
                
                setTimeout(() => {
                    img.src = imageList[currentIndex];
                    img.style.opacity = '1';
                }, 150);
                
                // Then set regular interval for subsequent changes
                setInterval(() => {
                    currentIndex = (currentIndex + 1) % imageList.length;
                    img.style.transition = 'opacity 0.3s ease';
                    img.style.opacity = '0.5';
                    
                    setTimeout(() => {
                        img.src = imageList[currentIndex];
                        img.style.opacity = '1';
                    }, 150);
                }, 5000);
            }, initialDelay);
        }
    });
});