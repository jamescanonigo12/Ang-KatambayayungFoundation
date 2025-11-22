<?php
session_start();
$pageContent = json_decode(file_get_contents('data/page-content.json'), true);
$history = $pageContent['history'] ?? ['title' => 'History', 'content' => 'Default content'];
$isAdmin = isset($_SESSION['admin_logged_in']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($history['title']); ?> - Ang Katambayayung Foundation</title>
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
        <?php if ($isAdmin): ?>
        <div class="admin-controls">
            <button onclick="editPage('history')">Edit Page</button>
        </div>
        <?php endif; ?>
        <section>
            <h2 id="page-title"><?php echo htmlspecialchars($history['title']); ?></h2>
            <div id="page-content" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"><?php echo $history['content']; ?></div>
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
    <?php if ($isAdmin): ?>
    <script>
        function editPage(page) {
            const title = document.getElementById('page-title').innerText;
            const content = document.getElementById('page-content').innerHTML;
            fetch('admin/save_page.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ page, title, content })
            })
            .then(response => response.text())
            .then(data => alert(data));
        }
    </script>
    <?php endif; ?>
</body>
</html>