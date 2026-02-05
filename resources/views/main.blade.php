@extends('layouts.main_layout')

@section('content')
    <div class="main-container">
        <div class="sub-container-1">
            <div class="s1-box">
                <div class="intro">
                    <h1>hi polanch here</h1>
                    <img src="/images/happy.gif" id="chibi" loading="lazy">
                </div>
                <p>24yo Web Developer from Philippines 
                    <img src="/images/ph.png" id="phicn" loading="lazy">
                </p>
                <p>I'm a freelancer actively looking for clients and startup teams to work with</p>
                <div class="midtro">
                    <p>For Q&A, start chat with PolanchBot <a href="" id="chatbot-link">
                        <img src="/images/arrow.png" id="arrowicn" loading="lazy">
                    </a></p>
                    <p>For further inquiries, message me <a href="">here</a>instead</p>
                </div>
                <div class="outro">
                    <button class="resume-download">
                        <a href="/downloadable_files/John Lloyd Olipani - Activity.pdf" download>Resume 
                            <img src="/images/blank-page.png" class="intro-icn" loading="lazy">
                        </a>
                    </button>
                    <a href="">
                        <img src="/images/linkedin.png" class="intro-icn" loading="lazy">
                    </a>
                    <a href="">
                        <img src="/images/github.png" class="intro-icn" loading="lazy">
                    </a>
                    <a href="">
                        <img src="/images/mail.png" class="intro-icn" loading="lazy">
                    </a>
                </div>
            </div>
            <div class="s1-box">
                <div class="pfp-holder">
                            <img src="/images/pfp2.jpg" class="pfp" loading="lazy">
                </div>
                <div class="pfp-holder">
                            <img src="/images/pfp3.jpg" class="pfp" loading="lazy">
                </div>
                <div class="pfp-holder">
                            <img src="/images/pfp1.jpg" class="pfp" loading="lazy">
                </div>
            </div>
        </div>
        <div class="sub-container-2">
            <div class="s2-menu-box">
                <div class="tab-slider"></div>
                <button class="tab-btn active">Work</button>
                <button class="tab-btn">Education</button>
            </div>
            <div class="s2-window">
                <div class="s2-window-inner">
                    <div class="work-tab">
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-logo">
                                    <img src="/images/csu-logo.png" alt="CSU" loading="lazy">
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-header">
                                        <h3>Cagayan State University, Aparri Campus</h3>
                                        <span class="timeline-date">Jun 2023 - Dec 2023</span>
                                    </div>
                                    <p class="timeline-role">IT Faculty Staff - OJT</p>
                                    <ul class="timeline-details">
                                        <li>Became a member of the CICS family and worked as a staff during events</li>
                                        <li>Designed and published the front-end of the organization's website</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-logo">
                                    <img src="/images/eksperto-logo.png" alt="Eksperto" loading="lazy">
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-header">
                                        <h3>Eksperto Team, Startup-Company</h3>
                                        <span class="timeline-date">Oct 2023 - Jan 2024</span>
                                    </div>
                                    <p class="timeline-role">Junior Developer Intern</p>
                                    <ul class="timeline-details">
                                        <li>Trained to use Laravel Framework and adjusted as a member of a Team Project</li>
                                        <li>Worked with AGILE structure and different SDLC development approaches</li>
                                        <li>Designed a prototype of the admin page using Laravel, Node.js and Tailwind</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-logo">
                                    <img src="/images/cec-logo.png" alt="CAGELCO" loading="lazy">
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-header">
                                        <h3>Cagayan II Electric Cooperative, Inc.</h3>
                                        <span class="timeline-date">Jun 2019 - Feb 2020</span>
                                    </div>
                                    <p class="timeline-role">Front Desk Customer Service</p>
                                    <ul class="timeline-details">
                                        <li>Acted as a frontline customer service for complaints and uncooperative consumers</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="education-tab">
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-logo">
                                    <img src="/images/csu-logo.png" alt="CSU" loading="lazy">
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-header">
                                        <h3>Cagayan State University</h3>
                                        <span class="timeline-date">2025 - Present</span>
                                    </div>
                                    <p class="timeline-role">Masters of Science in Information Technology</p>
                                    <p class="timeline-location">Cagayan, PH</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-logo">
                                    <img src="/images/ama-logo.png" alt="AMA" loading="lazy">
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-header">
                                        <h3>AMA Philippines</h3>
                                        <span class="timeline-date">2021 - 2025</span>
                                    </div>
                                    <p class="timeline-role">Bachelor of Science in Information Technology</p>
                                    <p class="timeline-location">Tuguegarao City, PH</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-logo">
                                    <img src="/images/stpaul-logo.png" alt="St. Paul" loading="lazy">
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-header">
                                        <h3>St. Paul School of Aparri</h3>
                                        <span class="timeline-date">2014-2020</span>
                                    </div>
                                    <p class="timeline-role">GAS Curriculum</p>
                                    <p class="timeline-location">Cagayan, PH</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sub-container-3">
            <div class="s3-box">
                <h1>featured projects</h1>
                <a href="">view more <img src="/images/arrow.png" id="more-right"></a>
            </div>
            <div class="s3-content">
                <div class="project-card">
                    <img src="/project_thumbnails/cics1.webp" class="project-image" alt="Project 1" data-slideshow="cics">
                    <h3>Student Portal</h3>
                    <p class="project-description">Working with the Eksperto team, I was tasked to create the student portal for Cagayan State University, CICS department.</p>
                    <div class="project-tech">
                        <span class="tech-tag"><img src="/images/kit1.png" class="tech-icon"> Laravel</span>
                        <span class="tech-tag"><img src="/images/kit5.png" class="tech-icon"> CSS</span>
                        <span class="tech-tag"><img src="/images/kit9.png" class="tech-icon"> Javascript</span>
                        <span class="tech-tag"><img src="/images/kit4.png" class="tech-icon"> HTML5</span>
                        <span class="tech-tag"><img src="/images/kit2.png" class="tech-icon"> mySQL</span>
                        <span class="tech-tag"><img src="/images/kit8.png" class="tech-icon"> PHP</span>
                        <span class="tech-tag"><img src="/images/kit3.png" class="tech-icon"> Node.js</span>
                    </div>
                    <div class="project-links">
                        <a href="https://cicsportal.csuaparri.net/" class="project-btn"><img src="/images/domain.png" class="btn-icon"> Website</a>
                        <a href="" class="project-btn"><img src="/images/git.png" class="btn-icon"> Source</a>
                    </div>
                </div>
                <div class="project-card">
                    <img src="/project_thumbnails/yameT1.webp" class="project-image" alt="Project 2" data-slideshow="yame">
                    <h3>Wholesale System for Tshirt Business</h3>
                    <p class="project-description">This was made within a day as a challenge and I intend not to fix any bug as this is my badge and record of my limits.</p>
                    <div class="project-tech">
                        <span class="tech-tag"><img src="/images/kit1.png" class="tech-icon"> Laravel</span>
                        <span class="tech-tag"><img src="/images/kit11.png" class="tech-icon"> PostgreSQL</span>
                        <span class="tech-tag"><img src="/images/kit9.png" class="tech-icon"> Javascript</span>
                        <span class="tech-tag"><img src="/images/kit4.png" class="tech-icon"> HTML5</span>
                        <span class="tech-tag"><img src="/images/kit5.png" class="tech-icon"> CSS</span>
                        <span class="tech-tag"><img src="/images/kit3.png" class="tech-icon"> Node.js</span>
                        <span class="tech-tag"><img src="/images/kit10.png" class="tech-icon"> Docker</span>
                    </div>
                    <div class="project-links">
                        <a href="https://yametshirt-shopdemo.onrender.com/" class="project-btn"><img src="/images/domain.png" class="btn-icon"> Website</a>
                        <a href="" class="project-btn"><img src="/images/git.png" class="btn-icon"> Source</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="sub-container-4">
            <div class="s4-box">
                <h1>recent posts</h1>
                <a href="/blogs">view more <img src="/images/arrow.png" id="more-right-2"></a>
            </div>
            <div class="s4-content">
                <div class="blog-card">
                    <div class="blog-header">
                        <h3>Blog Post Title</h3>
                        <div class="blog-meta">
                            <span class="blog-date">📅 January 1, 2026</span>
                            <span class="blog-read">⏱️ 5 min read</span>
                            <span class="blog-views">👁️ 0 views</span>
                        </div>
                    </div>
                    <p class="blog-excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <div class="blog-tags">
                        <span class="blog-tag">Tag1</span>
                        <span class="blog-tag">Tag2</span>
                        <span class="blog-tag">Tag3</span>
                    </div>
                </div>
                <div class="blog-card">
                    <div class="blog-header">
                        <h3>Blog Post Title</h3>
                        <div class="blog-meta">
                            <span class="blog-date">📅 January 1, 2026</span>
                            <span class="blog-read">⏱️ 5 min read</span>
                            <span class="blog-views">👁️ 0 views</span>
                        </div>
                    </div>
                    <p class="blog-excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <div class="blog-tags">
                        <span class="blog-tag">Tag1</span>
                        <span class="blog-tag">Tag2</span>
                        <span class="blog-tag">Tag3</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection