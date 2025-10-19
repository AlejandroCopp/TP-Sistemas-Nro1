<?php
require_once __DIR__ . '/components/landing/Header.php';
require_once __DIR__ . '/components/landing/Hero.php';
require_once __DIR__ . '/components/landing/Problem.php';
require_once __DIR__ . '/components/landing/Solution.php';
require_once __DIR__ . '/components/landing/HowItWorks.php';
require_once __DIR__ . '/components/landing/Testimonials.php';
require_once __DIR__ . '/components/landing/CTA.php';
require_once __DIR__ . '/components/landing/Footer.php';

function Landing(){
?>
<div class="bg-gray-900">
    <?php
    LandingHeader();
    ?>
    <main class="bg-gray-900">
        <?php
        LandingHero();
        LandingProblem();
        LandingSolution();
        LandingHowItWorks();
        LandingTestimonials();
        LandingCTA();
        ?>
    </main>
    <?php
    LandingFooter();
    ?>
</div>
<script>
    lucide.createIcons();
</script>
<?php
}
?>