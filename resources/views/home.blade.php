@extends('layouts.guest')
@section('content')

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container">
    <h3>Welcome to <strong>Scoops Troop</strong></h3>
      <p>
      Discover our <span>artful</span> ice cream creations – where each scoop is a <span>masterpiece!</span> Our devotion to crafting <span>exquisite</span> flavors using the finest ingredients shines in every cone. Explore <span>timeless</span> classics and imaginative combinations to satisfy every craving. 
      <br><br>
      Treat yourself <span>today!</span></p>
      <br>
      <center><a href="#services" class="btn-get-started scrollto">Get Started</a></center>
    </div>
    <div class="hero-img">
      <img src="{{asset('assets/img/bg.png')}}" alt="">
      <!-- <img src="{{asset('assets/img/hero1r.png')}}" alt="" class="img2"> -->
    </div>
    
  </section><!-- End Hero -->

  <main id="main">


    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="section-title">
          <h2>Services</h2>
          <h3>We offer awesome <span>Services</span></h3>
          <p>We've got great deals, online ordering, a Flavour of the Month Club, and a loyalty programme that includes a free birthday scoop every year. Whether you dine-in or take your treats to go, we've got you covered. Treat yourself to a scoop (or two) today!</p>
        </div>

        <div class="row">
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box">
              <div class="icon"><i class="bx bxl-dribbble"></i></div>
              <h4 class="title"><a href="">Impressive discounts</a></h4>
              <p class="description">Offering up to 30% discounts on various products year-round and providing customers with the best value for their money</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4 class="title"><a href="">Online ordering</a></h4>
              <p class="description">Our customers can easily place their orders through our online ordering system, making it convenient for them to enjoy our delicious ice cream at home.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-tachometer"></i></div>
              <h4 class="title"><a href="">Flavour of the month Club</a></h4>
              <p class="description">Customers can sign up for a Flavor of the Month Club subscription to receive a pint of the month's featured flavor delivered to their doorstep each month.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-world"></i></div>
              <h4 class="title"><a href="">Free birthday scoop</a></h4>
              <p class="description">Join our loyalty program and receive a free scoop of ice cream on your birthday as our way of celebrating with you!</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Services Section -->



    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
      <div class="container">

        <div class="text-center">
          <h3>The most delicious place on the Internet!</h3>
          <p> There's so much to explore, here at the home of ice cream.</p>
          <a class="cta-btn" href="#">Explore</a>
        </div>

      </div>
    </section><!-- End Cta Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container">

        <div class="section-title">
          <h2>Products</h2>
          <h3>Check out our <span>Flavours</span></h3>
          <p>Explore our extensive selection of ice creams, carefully categorized into fruity, creamy, and boozy options. Each category offers a distinct flavor profile, catering to all taste preferences and dietary needs. Indulge in our guilt-free delights, knowing that every scoop is a delightful experience.</p>
        </div>

        <div class="row">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">All</li>
              <li data-filter=".filter-fruity">Fruity</li>
              <li data-filter=".filter-creamy">Creamy</li>
              <li data-filter=".filter-boozy">Boozy</li>
            </ul>
          </div>
        </div>

        <div class="row portfolio-container">

          <div class="col-lg-4 col-md-6 portfolio-item filter-fruity">
            <img src="assets/img/cherry.png" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Cherry Blossom Bliss</h4>
              <p>200.00 LKR</p>
              <a href="assets/img/cherry.png" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Cherry Blossom Bliss"><i class="bx bx-plus"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-creamy">
            <img src="assets/img/chocolate.png" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Chocolate Dreamland</h4>
              <p>300.00 LKR</p>
              <a href="assets/img/chocolate.png" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Chocolate Dreamland"><i class="bx bx-plus"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-fruity">
            <img src="assets/img/peachy.png" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Peachy Paradise</h4>
              <p>250.00 LKR</p>
              <a href="assets/img/peachy.png" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Peachy Paradise"><i class="bx bx-plus"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-creamy">
            <img src="assets/img/pistachio.png" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Pistachio Passion</h4>
              <p>370.00 LKR</p>
              <a href="assets/img/pistachio.png" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Pistachio Passion"><i class="bx bx-plus"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-boozy">
            <img src="assets/img/lemon.png" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Lemon Sorbet</h4>
              <p>600.00 LKR</p>
              <a href="assets/img/lemon.png" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Lemon Sorbet"><i class="bx bx-plus"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-fruity">
            <img src="assets/img/blueberry.png" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Blueberry Blast</h4>
              <p>350.00 LKR</p>
              <a href="assets/img/blueberry.png" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Blueberry Blast"><i class="bx bx-plus"></i></a>
            </div>
          </div>

         <div class="col-lg-4 col-md-6 portfolio-item filter-fruity">
            <img src="assets/img/orange.png" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Orange Creamsicle</h4>
              <p>200.00 LKR</p>
              <a href="assets/img/orange.png" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Orange Creamsicle"><i class="bx bx-plus"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-creamy">
            <img src="assets/img/toffee.png" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Toffee Temptation</h4>
              <p>350.00 LKR</p>
              <a href="assets/img/toffee.png" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Toffee Temptation"><i class="bx bx-plus"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-boozy">
            <img src="assets/img/lavsorbet.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Honey Lavender Sorbet</h4>
              <p>650.00 LKR</p>
              <a href="assets/img/lavsorbet.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Honey Lavender"><i class="bx bx-plus"></i></a>
            </div>
            
          </div>
               
        </div>
        <div class="section-title">
          <a href="{{route('categories.index')}}"><h2>See More</h2></a>
        </div>

      </div>
    </section><!-- End Portfolio Section -->

        <!-- ======= Toppings Section ======= -->
        <section id="toppings" class="features">
      <div class="container">
      <div class="section-title">
          <h2>Toppings</h2>
          <h3>12 Different <span>Toppings</span></h3>
          <p>Enhance your ice cream experience with our wide variety of unique and flavorful toppings, adding a sweet, crunchy, or spicy touch to your favorite scoop.</p>
          
          
        </div>

        <div class="row">
          <div class="col-lg-3 col-md-4 col-6 col-6">
            <div class="icon-box">
              <i class="ri-store-line" style="color: #ffbb2c;"></i>
              <h3><a href="assets/img/fruity.jpg" data-gallery="portfolioTopping" class="portfolio-lightbox preview-link" title="Fruity Pebbles">Fruity Pebbles</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-6">
            <div class="icon-box">
              <i class="ri-bar-chart-box-line" style="color: #5578ff;"></i>
              <h3><a href="assets/img/bacon.jpg" data-gallery="portfolioTopping" class="portfolio-lightbox preview-link" title="Caramelized Bacon">Caramelized Bacon</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-6 mt-4 mt-md-0">
            <div class="icon-box">
              <i class="ri-calendar-todo-line" style="color: #e80368;"></i>
              <h3><a href="assets/img/nutella.jpg" data-gallery="portfolioTopping" class="portfolio-lightbox preview-link" title="Nutella Drizzle">Nutella Drizzle</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-6 mt-4 mt-lg-0">
            <div class="icon-box">
              <i class="ri-paint-brush-line" style="color: #e361ff;"></i>
              <h3><a href="assets/img/balsamic.jpg" data-gallery="portfolioTopping" class="portfolio-lightbox preview-link" title="Balsamic Glaze">Balsamic Glaze</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-6 mt-4">
            <div class="icon-box">
              <i class="ri-database-2-line" style="color: #47aeff;"></i>
              <h3><a href="assets/img/honey.jpg" data-gallery="portfolioTopping" class="portfolio-lightbox preview-link" title="Honeycomb Pieces">Honeycomb Pieces</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-6 mt-4">
            <div class="icon-box">
              <i class="ri-gradienter-line" style="color: #ffa76e;"></i>
              <h3><a href="assets/img/blackberry.jpg" data-gallery="portfolioTopping" class="portfolio-lightbox preview-link" title="Blackberry Coulis">Blackberry Coulis</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-6 mt-4">
            <div class="icon-box">
              <i class="ri-file-list-3-line" style="color: #11dbcf;"></i>
              <h3><a href="assets/img/matcha.jpg" data-gallery="portfolioTopping" class="portfolio-lightbox preview-link" title="Matcha Dust">Matcha Dust</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-6 mt-4">
            <div class="icon-box">
              <i class="ri-price-tag-2-line" style="color: #4233ff;"></i>
              <h3><a href="assets/img/coconut.jpg" data-gallery="portfolioTopping" class="portfolio-lightbox preview-link" title="Toasted Coconut Flakes">Toasted Coconut Flakes</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-6 mt-4">
            <div class="icon-box">
              <i class="ri-anchor-line" style="color: #b2904f;"></i>
              <h3><a href="assets/img/raspberry.jpg" data-gallery="portfolioTopping" class="portfolio-lightbox preview-link" title="Raspberry Rose Jam">Raspberry Rose Jam</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-6 mt-4">
            <div class="icon-box">
              <i class="ri-disc-line" style="color: #b20969;"></i>
              <h3><a href="assets/img/pecans.jpg" data-gallery="portfolioTopping" class="portfolio-lightbox preview-link" title="Spicy Candied Pecans">Spicy Candied Pecans</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-6 mt-4">
            <div class="icon-box">
              <i class="ri-base-station-line" style="color: #ff5828;"></i>
              <h3><a href="assets/img/caramel.jpg" data-gallery="portfolioTopping" class="portfolio-lightbox preview-link" title="Bourbon Caramel Sauce">Bourbon Caramel Sauce</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-6 mt-4">
            <div class="icon-box">
              <i class="ri-fingerprint-line" style="color: #29cc61;"></i>
              <h3><a href="assets/img/ginger.jpg" data-gallery="portfolioTopping" class="portfolio-lightbox preview-link" title="Ginger Snap Crumbles">Ginger Snap Crumbles</a></h3>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Toppings Section -->



    <!-- ======= Categories Section ======= -->
    <section class="pricing">
      <div class="container">

        <div class="section-title">
          <h2>Categories</h2>
          <h3>Here Comes<span>Treble</span></h3>
          <p>Discover a whole new world of ice cream flavors with our fruity, boozy, and creamy collections, each offering a range of unique and irresistible tastes.</p>
        </div>

        <div class="row">

          <div class="col-lg-4 col-md-6">
            <div class="box">
              <h3>Fruity</h3>
              <h4><sup>LKR</sup>200<span> base</span></h4>
              <ul>
                <li>Burst of freshness with our fruity collection</li>
                <li>Variety of tangy and authentic flavors made with fresh fruits</li>
                <li>Classic and exotic blends to choose from, like strawberry, raspberry, mango, and blueberry.</li>
                <li class="na"></li>
                <li class="na"></li>
              </ul>
              <div class="btn-wrap">
                <a href="{{route('categories.index')}}" class="btn-buy">Explore</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mt-4 mt-md-0">
            <div class="box recommended">
              <span class="recommended-badge">New</span>
              <h3>Boozy</h3>
              <h4><sup>LKR</sup>600<span> base</span></h4>
              <ul>
                <li>Our boozy sorbet collection is perfect for adults seeking a sweet treat with a kick.</li>
                <li>Each scoop is infused with just the right amount of alcohol, providing a sophisticated taste.</li>
                <li>Come explore our boozy collection today and find your new favorite adult dessert!</li>

              </ul>
              <div class="btn-wrap">
                <a href="{{route('categories.index')}}" class="btn-buy">Explore</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mt-4 mt-lg-0">
            <div class="box">
              <h3>Creamy</h3>
              <h4><sup>LKR</sup>300<span>  base</span></h4>
              <ul>
                <li>Enjoy our rich and silky creamy collection.</li>
                <li>Featuring classic flavors like chocolate and vanilla, as well as unique blends like salted caramel and hazelnut.</li>
                <li>Indulge in the ultimate dessert experience today.</li>
                <li></li>
                <li></li>
              </ul>
              <div class="btn-wrap">
                <a href="{{route('categories.index')}}" class="btn-buy">Explore</a>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Pricing Section -->

     <!-- ======= F.A.Q Section ======= -->
     <section class="faq">
      <div class="container">

        <div class="section-title">
          <h2>F.A.Q</h2>
          <h3>Frequently Asked <span>Questions</span></h3>
        </div>

        <ul class="faq-list">

          <li>
            <div data-bs-toggle="collapse" class="collapsed question" href="#faq1">What flavors of ice cream do you offer? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq1" class="collapse" data-bs-parent=".faq-list">
              <p>
              At Scoops Troop, we pride ourselves on offering an extensive variety of flavors to satisfy every taste bud. Our menu boasts over 100 unique and delicious flavors, ranging from classic vanilla and chocolate to exotic flavors like mango habanero and lavender honey. We use only the freshest and highest quality ingredients to create each flavor, ensuring that every scoop is bursting with flavor and texture. Whether you're in the mood for a refreshing sorbet or a rich and creamy indulgence, we have something for everyone. Come explore our flavor-filled world and indulge in a sweet treat that will leave you wanting more.
              </p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq2" class="collapsed question">Can I customize my ice cream with toppings? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq2" class="collapse" data-bs-parent=".faq-list">
              <p>
              We offer a wide range of toppings to elevate your ice cream experience. With over 10 delicious options to choose from, including fruity pebbles, caramel, pecans, nutella, and fresh fruit, you can customize your dessert to suit your unique taste buds. Whether you're in the mood for something sweet or savory, we have the perfect topping to satisfy your cravings.
              </p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq3" class="collapsed question">Are your ingredients locally sourced or organic? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq3" class="collapse" data-bs-parent=".faq-list">
              <p>
              While we strive to source our ingredients locally whenever possible, our priority is to use ingredients that meet our strict standards for taste and quality. We work closely with our suppliers to ensure that all ingredients meet our high standards, and we are committed to using only natural and wholesome ingredients in our ice cream. While not all of our ingredients are certified organic, we do prioritize using organic ingredients when possible.
              </p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq4" class="collapsed question">What sizes of cones or cups do you offer? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq4" class="collapse" data-bs-parent=".faq-list">
              <p>
              We offer a range of sizes for both our cones and cups to satisfy your ice cream cravings. Our cones come in small, medium, and large sizes, while our cups are available in single, double, and triple scoop sizes. 
              </p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq5" class="collapsed question">What types of discounts do you offer? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq5" class="collapse" data-bs-parent=".faq-list">
              <p>
              We love to offer our customers special deals and promotions to make their ice cream experience even sweeter. We frequently offer discounts such as loyalty, percent-off, or seasonal deals. The best way to stay up to date on our current promotions is to follow us on social media, sign up for our newsletter, or check our website regularly. You can also ask our friendly staff about any current promotions when you visit us in-store. Don't miss out on the opportunity to save while indulging in our delicious ice cream!
              </p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq6" class="collapsed question">Can I place an order online for pickup or delivery? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq6" class="collapse" data-bs-parent=".faq-list">
              <p>
              Yes, we offer the convenience of online ordering for both pickup and delivery. Simply visit our website and select the items you would like to order. You can choose to pick up your order at our store, or have it delivered right to your doorstep. For delivery, we partner with third-party delivery services to ensure that your order arrives fresh and in a timely manner. Please note that delivery options and fees may vary depending on your location. If you have any questions or concerns about online ordering, our friendly staff is available to assist you.
              </p>
            </div>
          </li>

        </ul>

      </div>
    </section><!-- End F.A.Q Section -->


    <!-- ======= Team Section ======= -->
    <section id="team" class="team">
      <div class="container">

        <div class="section-title">
          <h2>Team</h2>
          <h3>Our Hardworking <span>Team</span></h3>
          <p>Our team at Scoops Troop is dedicated to crafting delicious treats and providing exceptional service to our customers.</p>
        </div>

        <div class="row">

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <div class="member-img">
                <img src="assets/img/team/team-1.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Walter White</h4>
                <span>Head Ice Cream Chef</span>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <div class="member-img">
                <img src="assets/img/team/team-2.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Sarah Jhonson</h4>
                <span>Server</span>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <div class="member-img">
                <img src="assets/img/team/team-3.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>William Anderson</h4>
                <span>Operations Manager</span>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <div class="member-img">
                <img src="assets/img/team/team-4.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Amanda Jepson</h4>
                <span>Marketing Coordinater</span>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Team Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Contact</h2>
          <h3>Contact <span>Us</span></h3>
          <p>If you have any questions about our menu, flavors, or ingredients, please don't hesitate to contact us using the form provided below. We'll do our best to get back to you as soon as possible.</p>
        </div>

        <div>
          <iframe style="border:0; width: 100%; height: 270px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.646747372587!2d80.61742947480195!3d7.2809739138981495!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae3673f5e22ab3b%3A0xcbaef11262bec73!2sAPIIT%20Kandy%20Campus!5e0!3m2!1sen!2slk!4v1682247700188!5m2!1sen!2slk" frameborder="0" allowfullscreen></iframe>
        </div>

        <div class="row mt-5">

          <div class="col-lg-4">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Location:</h4>
                <p>542 Peradeniya Rd, Kandy</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>scoopstroop@gmail.com</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                <p>+94 76 467 1129</p>
              </div>

            </div>

          </div>

          <div class="col-lg-8 mt-5 mt-lg-0">
          @if (Session::has('success'))
              <script>
                  alert('{{ Session::get('success') }}');
              </script>
          @endif

          <form action="{{ route('messages.store') }}" method="post" class="contact-form">
              @csrf
              <div class="row">
                <div class="col-md-6 form-group">
                  @if (Route::has('login'))
                  @auth
                    <input type="text" name="name" class="form-control" id="name" value="{{ Auth::user()->name }}" required autofocus readonly>
                  @else
                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                  @endauth
                  @endif
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  @if (Route::has('login'))
                  @auth
                    <input type="email" class="form-control" name="email" id="email" value="{{ Auth::user()->email }}" required autofocus readonly>
                    <input type="hidden" name="userId" id="userId" value="{{ Auth::user()->id }}">
                  @else
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                  <input type="hidden" name="userId" id="userId" value="">
                  @endauth
                  @endif
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
          
            </form>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->
  @endsection
  <!-- ======= Footer ======= -->
 