<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Logan Newell</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<?php include __DIR__ . '/template/navbar.php'; ?>

<!-- HEADER -->
<div class="content header-block">
    <h1>Logan Newell</h1>
    <h2 class="subtitle">Student Intern</h2>
    <div class="divider"></div>
</div>

<!-- ABOUT -->
<div class="content">
    <h3>About</h3>
    <p>I love learning new things and building cool stuff. I love working with Docker and Linux.
        I'm also a student at the University of Arkansas Fort Smith studying Computer Science.
        I will be graduating in December of 2026 and actively seeking opportunities to apply my skills.
        I'm hoping in the future to continue my education by pursuing a Master's degree in Computer Science.
        Based in Fort Smith, Arkansas.</p>
</div>

<!-- EXPERIENCE -->
<div class="content">
    <h3>Experience</h3>
    <ul>
        <li><strong>Information Center, Intern</strong> — ArcBest Technologies (2024 – Present)</li>
        <ul>
            <li>Assisted with deployment of desktops, laptops, and Zebra devices</li>
            <li>Provided technical support with Navori Digital Signage devices</li>
            <li>Researched new digital signage services</li>
            <li>Provisioned SIM cards</li>
            <li>Managed lost and stolen Zebra devices</li>
            <li>Assisted with device inventory and mismatch resolution</li>
        </ul>
        <li><strong>Chartwells Cook</strong> — University of Arkansas (2023 – 2024)</li>
        <li><strong>Student Worker</strong> — College of the Ozarks (2022 – 2023)</li>
        <ul>
            <li>Worked under the supervision of Chef Angie</li>
            <li>Trained as a line cook, prep chef, banquets chef, and baker</li>
            <li>Gained experience as a French-style server for banquets and catering</li>
        </ul>
    </ul>
</div>

<!-- PROJECTS -->
<div class="content">
    <h3>Projects</h3>
    <ul>
        <li><strong>Home Lab</strong> — Self-hosted services on Ubuntu Server with ZFS, Docker, and Cloudflare Tunnel</li>
        <li><strong>Portfolio Site</strong> — This site, served via Nginx in Docker with GitHub auto-pull</li>
    </ul>
</div>

<!-- SKILLS -->
<div class="content">
    <h3>Skills</h3>
    <div class="skills-grid">
        <span class="skill-tag">Java</span>
        <span class="skill-tag">PHP</span>
        <span class="skill-tag">SQL</span>
        <span class="skill-tag">Docker</span>
        <span class="skill-tag">Linux</span>
        <span class="skill-tag">Cloudflare</span>
        <span class="skill-tag">Networking</span>
        <span class="skill-tag">Git</span>
    </div>
</div>

<!-- CONTACT -->
<div class="content" style="padding-bottom: 4rem;">
    <h3>Contact</h3>
    <div class="contact-line">
        <a href="mailto:logan@thenewells.net">logan@thenewells.net</a>
        <a href="https://github.com/lnewell00">GitHub</a>
        <a href="https://lnewell.work">lnewell.work</a>
    </div>
</div>

<script>
    const toggle = document.getElementById('navToggle');
    const mobile = document.getElementById('navMobile');
    toggle.addEventListener('click', () => mobile.classList.toggle('open'));
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>