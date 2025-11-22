<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Ang Katambayayung Foundation</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <h1>Ang Katambayayung Foundation</h1>
            </div>
            <div class="nav-right">
                <a href="donate.php" class="donate-btn">Donate Now</a>
                <ul class="nav-menu">
                    <li class="dropdown">
                        <a href="#">About Us</a>
                        <ul class="dropdown-menu">
                            <li><a href="mission.php">Mission & Vision</a></li>
                            <li><a href="history.php">History</a></li>
                            <li><a href="student-stories.php">Student Stories</a></li>
                            <li><a href="board.php">Board of Directors</a></li>
                            <li><a href="staff.php">Staff</a></li>
                            <li><a href="policy-fellows.php">Policy Fellows</a></li>
                            <li><a href="partners.php">Partners</a></li>
                            <li><a href="financials.php">Financials & Annual Reports</a></li>
                            <li><a href="contact.php">Contact Us</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#">For Students</a>
                        <ul class="dropdown-menu">
                            <li><a href="eligibility.php">Who Is Eligible</a></li>
                            <li><a href="grants-loans.php">Grants & Loans</a></li>
                            <li><a href="how-to-apply.php">How to Apply</a></li>
                            <li><a href="faq.php">FAQ</a></li>
                            <li><a href="student-advising.php">Student Advising</a></li>
                            <li><a href="workshops.php">Workshops</a></li>
                            <li><a href="mental-health.php">Flourish Mental Health Support</a></li>
                            <li><a href="resources.php">Resources</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#">Support & Engage</a>
                        <ul class="dropdown-menu">
                            <li><a href="advocacy.php">Advocacy</a></li>
                            <li><a href="ways-to-give.php">Ways to Give</a></li>
                            <li><a href="donate.php">Donate Online</a></li>
                            <li><a href="planned-giving.php">Planned Giving</a></li>
                            <li><a href="tribute-gift.php">Make a Tribute Gift</a></li>
                            <li><a href="transparency.php">Transparency</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <section>
            <h2>Contact Us</h2>
            <div class="contact-info">
                <p><strong>Address:</strong> 123 Main Street, Suite 100, Manila, Philippines 1000</p>
                <p><strong>Phone:</strong> +63 123 456 7890</p>
                <p><strong>Email:</strong> info@angkatambayung.org</p>
            </div>
            <form action="send_contact.php" method="post">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Message:</label>
                <textarea id="message" name="message" required></textarea>

                <button type="submit">Send Message</button>
            </form>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-info">
                <p>Ang Katambayayung Foundation</p>
                <p>123 Main Street, Suite 100, Manila, Philippines 1000</p>
                <p>Phone: +63 123 456 7890</p>
                <p>Email: info@angkatambayung.org</p>
            </div>
            <div class="footer-links">
                <a href="privacy.php">Privacy Policy</a>
                <a href="financials.php">Financials</a>
            </div>
            <div class="social-media">
                <a href="#" class="social-icon">Facebook</a>
                <a href="#" class="social-icon">Twitter</a>
                <a href="#" class="social-icon">Instagram</a>
            </div>
        </div>
        <p>&copy; 2023 Ang Katambayayung Foundation. All rights reserved.</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>