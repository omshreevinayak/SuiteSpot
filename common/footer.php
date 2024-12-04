<style>
a:hover {
    color: black;
}
</style>

<?php
$contact_q = "SELECT * FROM `contact_detail` WHERE `id`=?";
$values = [1];
$contact_r = mysqli_fetch_assoc(select($contact_q, $values, 'i'));
// print_r($contact_r);
?>


<footer class="bd-footer py-4 py-md-5 mt-5 bg-body-tertiary">
    <div class="container py-4 py-md-5 px-4 px-md-3 text-body-secondary">
        <div class="row">
            <div class="text-start col-lg-4 mb-3">
                <a class="d-inline-flex align-items-center mb-2 text-body-emphasis text-decoration-none" href="/"
                    aria-label="Bootstrap">
                    <i class="fa-solid fa-person-booth"></i>
                    <span class="fs-5 h-font text-dark">SuiteSpot</span>
                </a>
                <ul class="list-unstyled small">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nulla minus incidunt, eius laboriosam
                    dignissimos iste rerum aliquid vitae voluptates debitis vero in porro maiores quas molestiae beatae
                    adipisci assumenda sequi aut cupiditate quam. Dignissimos, impedit. Blanditiis nobis consequatur
                    deserunt laudantium temporibus illum quia ab, libero qui error dolor, dolores veniam!
                </ul>
            </div>
            <div class="text-center col-lg-4 mb-3">
                <h5 class="text-dark text-decoration-underline">Links</h5>
                <ul class="list-unstyled ">
                    <li class="mb-2"><a href="home.php">Home</a></li>
                    <li class="mb-2"><a href="rooms.php">Rooms</a></li>
                    <li class="mb-2"><a href="facilities.php">Facilities</a></li>
                    <li class="mb-2"><a href="contactUs.php">Contact Us</a></li>
                    <li class="mb-2"><a href="aboutUs.php">About Us</a></li>
                    <li class="mb-2"><a href="https://www.instagram.com/omshreevinayak_yadav/">About Developer</a></li>
                </ul>
            </div>
            <div class="text-center col-lg-4 mb-3">
                <h5 class="text-dark text-decoration-underline">Follow Us</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <?php
                        if ($contact_r['insta_link'] != '') {
                            echo <<<data
                                <a href="<?php echo $contact_r[insta_link]; ?>" class="d-inline-block mb-2
                        text-decoration-none " target="_blank">
                        <i class="bi bi-instagram"></i> Instagram
                        </a>
                        data;
                        }
                        ?>
                    </li>
                    <li class="mb-2">
                        <?php
                        if ($contact_r['insta_link'] != '') {
                            echo <<<data
                                <a href="<?php echo $contact_r[insta_link]; ?>" class="d-inline-block mb-2
                        text-decoration-none " target="_blank">
                        <i class="bi bi-instagram"></i> Instagram
                        </a>
                        data;
                        }
                        ?>
                    </li>
                    <li class="mb-2">
                        <?php
                        if ($contact_r['insta_link'] != '') {
                            echo <<<data
                                <a href="<?php echo $contact_r[insta_link]; ?>" class="d-inline-block mb-2
                        text-decoration-none " target="_blank">
                        <i class="bi bi-instagram"></i> Instagram
                        </a>
                        data;
                        }
                        ?>
                    </li>
                    <li class="mb-2">
                        <?php
                        if ($contact_r['insta_link'] != '') {
                            echo <<<data
                                <a href="<?php echo $contact_r[insta_link]; ?>" class="d-inline-block mb-2
                        text-decoration-none " target="_blank">
                        <i class="bi bi-instagram"></i> Instagram
                        </a>
                        data;
                        }
                        ?>
                    </li>
                </ul>
            </div>


        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>