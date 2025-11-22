// Enhanced JavaScript for smooth interactions
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add hover effects to interactive elements
    const interactiveElements = document.querySelectorAll('button, .cta-btn, .donate-btn');
    interactiveElements.forEach(el => {
        el.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
        });
        el.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });

    // Add click feedback
    document.addEventListener('click', function(e) {
        if (e.target.matches('button, .cta-btn, .donate-btn')) {
            e.target.style.transform = 'scale(0.95)';
            setTimeout(() => {
                e.target.style.transform = 'scale(1)';
            }, 150);
        }
    });

    // Toast notification system
    window.showToast = function(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;
        toast.textContent = message;
        document.body.appendChild(toast);

        setTimeout(() => {
            toast.classList.add('show');
        }, 100);

        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => document.body.removeChild(toast), 300);
        }, 3000);
    };
});

// Load dynamic content asynchronously
document.addEventListener('DOMContentLoaded', function() {
    loadPhotos();
    loadDates();
    loadTestimonials();
    loadNews();
    loadEvents();
    loadHomepageTestimonials();
});

function loadPhotos() {
    fetch('api.php?action=photos')
        .then(response => response.json())
        .then(data => {
            const photosDiv = document.getElementById('photos');
            photosDiv.classList.remove('loading');
            if (data.length === 0) {
                photosDiv.innerHTML = 'No photos available.';
            } else {
                photosDiv.innerHTML = data.map(photo => `<img src="uploads/${photo}" alt="Foundation Photo" style="max-width:200px; margin:10px;">`).join('');
            }
        })
        .catch(error => {
            document.getElementById('photos').innerHTML = 'Error loading photos.';
            console.error('Error loading photos:', error);
        });
}

function loadDates() {
    fetch('api.php?action=dates')
        .then(response => response.json())
        .then(data => {
            const datesDiv = document.getElementById('dates');
            datesDiv.classList.remove('loading');
            if (data.length === 0) {
                datesDiv.innerHTML = 'No dates available.';
            } else {
                datesDiv.innerHTML = data.map(date => `<p><strong>${date.date}:</strong> ${date.description}</p>`).join('');
            }
        })
        .catch(error => {
            document.getElementById('dates').innerHTML = 'Error loading dates.';
            console.error('Error loading dates:', error);
        });
}

function loadTestimonials() {
    fetch('api.php?action=testimonials')
        .then(response => response.json())
        .then(data => {
            const testimonialsDiv = document.getElementById('testimonials-content');
            testimonialsDiv.classList.remove('loading');
            if (data.length === 0) {
                testimonialsDiv.innerHTML = 'No testimonials available.';
            } else {
                testimonialsDiv.innerHTML = data.map(testimonial => `
                    <div class="testimonial-item">
                        ${testimonial.photo ? `<img src="uploads/${testimonial.photo}" alt="Student Photo" style="max-width:200px; margin:10px;">` : ''}
                        ${testimonial.video ? `<video controls style="max-width:300px; margin:10px;"><source src="uploads/${testimonial.video}" type="video/mp4"></video>` : ''}
                        <blockquote>${testimonial.text}</blockquote>
                        ${testimonial.caption ? `<p><em>${testimonial.caption}</em></p>` : ''}
                    </div>
                `).join('');
            }
        })
        .catch(error => {
            document.getElementById('testimonials-content').innerHTML = 'Error loading testimonials.';
            console.error('Error loading testimonials:', error);
        });
}

function loadHomepageTestimonials() {
    fetch('data/testimonials.json')
        .then(response => response.json())
        .then(data => {
            const testimonialsDiv = document.getElementById('homepage-testimonials');
            testimonialsDiv.classList.remove('loading');
            if (data.length === 0) {
                testimonialsDiv.innerHTML = '<p style="text-align: center; color: #666;">No testimonials available yet.</p>';
            } else {
                testimonialsDiv.innerHTML = data.slice(0, 3).map((testimonial, index) => `
                    <div class="testimonial-item" style="animation-delay: ${index * 0.2}s">
                        ${testimonial.photo ? `<img src="uploads/${testimonial.photo}" alt="Student Photo" style="max-width:150px; margin:10px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">` : ''}
                        <blockquote style="font-style: italic; color: #555;">"${testimonial.text}"</blockquote>
                        ${testimonial.caption ? `<p style="color: #007bff; font-weight: bold;">${testimonial.caption}</p>` : ''}
                    </div>
                `).join('');
            }
        })
        .catch(error => {
            document.getElementById('homepage-testimonials').innerHTML = '<p style="text-align: center; color: #d9534f;">Unable to load testimonials at this time.</p>';
            console.error('Error loading testimonials:', error);
        });
}

function loadNews() {
    fetch('api.php?action=news')
        .then(response => response.json())
        .then(data => {
            const newsDiv = document.getElementById('news-content');
            newsDiv.classList.remove('loading');
            if (data.length === 0) {
                newsDiv.innerHTML = 'No news available.';
            } else {
                newsDiv.innerHTML = data.map(news => `<article><h4>${news.title}</h4><p>${news.date}</p><p>${news.summary}</p><a href="${news.link}">Read More</a></article>`).join('');
            }
        })
        .catch(error => {
            document.getElementById('news-content').innerHTML = 'Error loading news.';
            console.error('Error loading news:', error);
        });
}

function loadEvents() {
    fetch('api.php?action=events')
        .then(response => response.json())
        .then(data => {
            const eventsDiv = document.getElementById('events-content');
            eventsDiv.classList.remove('loading');
            if (data.length === 0) {
                eventsDiv.innerHTML = 'No events available.';
            } else {
                eventsDiv.innerHTML = data.map(event => `<div class="event"><h4>${event.title}</h4><p>${event.date}</p><p>${event.description}</p><a href="${event.link}">Register</a></div>`).join('');
            }
        })
        .catch(error => {
            document.getElementById('events-content').innerHTML = 'Error loading events.';
            console.error('Error loading events:', error);
        });
}