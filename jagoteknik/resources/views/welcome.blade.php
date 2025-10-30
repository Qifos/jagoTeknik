<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>JagoTeknik — Landing</title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    /* ===== Custom styles to approximate the prototype ===== */
    :root{
      --purple-500:#6c63ff;
      --bg-900:#0f0f17;
    }
    html,body{
      font-family:"Poppins",system-ui,-apple-system,"Segoe UI",Roboto,"Helvetica Neue","Noto Sans","Liberation Sans",Arial,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
    }
    body{
      background:
        radial-gradient(1200px 800px at 70% -10%, rgba(108,99,255,.12), transparent 60%),
        radial-gradient(900px 600px at -10% 20%, rgba(108,99,255,.06), transparent 60%),
        var(--bg-900);
    }
    .w-fit{width:fit-content}
    .hero{isolation:isolate}
    .hero-title{letter-spacing:.5px}
    .icon-badge{
      display:inline-grid;place-items:center;
      width:44px;height:44px;border-radius:12px;
      background:rgba(108,99,255,.12);color:var(--purple-500);font-size:1.25rem;
    }
    /* Decorative circles */
    .circle{
      position:absolute;border-radius:50%;pointer-events:none;
      background:radial-gradient(circle at 30% 30%, rgba(108,99,255,.35), rgba(108,99,255,.08) 45%, rgba(108,99,255,.02) 70%, transparent 72%);
      filter:blur(1px);opacity:.7;
    }
    .circle-lg{width:700px;height:700px;right:-200px;top:-80px}
    .circle-sm{width:360px;height:360px;left:-120px;bottom:-80px}
    .service-card{
      border:1px solid rgba(255,255,255,.06);
      background:rgba(255,255,255,.02);
      border-radius:1.25rem;
    }
    .blog-card{
      background:rgba(255,255,255,.02);
      border:1px solid rgba(255,255,255,.06);
      border-radius:1rem;
      text-decoration:none;color:inherit;
      transition:transform .25s ease,border-color .25s ease;
    }
    .blog-card:hover{transform:translateY(-4px);border-color:rgba(108,99,255,.5)}
    .hero-blob .stat{width:280px;border:1px solid rgba(255,255,255,.06)}
    @media (min-width:992px){
      .hero-blob{padding:2rem}
      .hero-blob .stat{margin-left:5rem}
    }
  </style>
</head>
<body>
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom border-opacity-25 sticky-top">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="#">
        <i class="bi bi-magic fs-4 text-primary"></i> Jago<span class="text-primary">Teknik</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="nav">
        <form class="me-lg-3 mt-3 mt-lg-0 d-flex" role="search">
          <div class="input-group">
            <span class="input-group-text bg-body"><i class="bi bi-search"></i></span>
            <input class="form-control" type="search" placeholder="Want to learn?" aria-label="Search">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Explore</button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="#">UI/UX</a></li>
              <li><a class="dropdown-item" href="#">Frontend</a></li>
              <li><a class="dropdown-item" href="#">Backend</a></li>
            </ul>
          </div>
        </form>

        <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
          <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#">About</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Courses</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
          <li class="nav-item"><a class="nav-link" href="#">FAQ</a></li>
          <li class="nav-item"><a class="btn btn-outline-light" href="#">Sign in</a></li>
          <li class="nav-item"><a class="btn btn-primary" href="#">Create free account</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <section class="py-5 position-relative overflow-hidden hero">
    <div class="container position-relative">
      <div class="row align-items-center g-5">
        <div class="col-lg-6">
          <h1 class="display-4 fw-bold lh-1 mb-4 hero-title">
            Kuliah <span class="text-primary">Teknik</span><br> Jadi Easy
          </h1>
          <p class="lead text-secondary-emphasis mb-4">
            Learn UI-UX Design skills with Weekend UX. The latest online learning system and materials that help your knowledge growing.
          </p>
          <div class="d-flex gap-3 flex-wrap">
            <a href="#" class="btn btn-primary btn-lg">Get Started</a>
            <a href="#" class="btn btn-outline-light btn-lg">Get free trial</a>
          </div>

          <div class="d-flex gap-4 flex-wrap mt-5 small text-secondary">
            <span><i class="bi bi-megaphone me-2 text-primary"></i>Public Speaking</span>
            <span><i class="bi bi-briefcase me-2 text-primary"></i>Career-Oriented</span>
            <span><i class="bi bi-lightbulb me-2 text-primary"></i>Creative Thinking</span>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="hero-blob ms-lg-5">
            <div class="stat p-3 rounded-4 bg-body-tertiary shadow-lg">
              <div class="d-flex align-items-center">
                <div class="icon-badge me-3"><i class="bi bi-collection-play"></i></div>
                <div>
                  <div class="fw-bold">2K+</div>
                  <small class="text-secondary">Video Courses</small>
                </div>
              </div>
            </div>

            <div class="stat p-3 rounded-4 bg-body-tertiary shadow-lg mt-3">
              <div class="d-flex align-items-center">
                <div class="icon-badge me-3"><i class="bi bi-cast"></i></div>
                <div>
                  <div class="fw-bold">5K+</</div>
                  <small class="text-secondary">Online Courses</small>
                </div>
              </div>
            </div>

            <div class="stat p-3 rounded-4 bg-body-tertiary shadow-lg mt-3">
              <div class="d-flex align-items-center">
                <div class="icon-badge me-3"><i class="bi bi-people"></i></div>
                <div>
                  <div class="fw-bold">300+</div>
                  <small class="text-secondary">Tutors</small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="d-flex align-items-center gap-4 mt-5 pt-3 text-secondary flex-wrap">
        <span class="fw-semibold">250+ Collaboration</span>
        <img src="https://dummyimage.com/96x24/6c63ff/ffffff&text=duolingo" height="24" alt="duolingo" class="opacity-75">
        <img src="https://dummyimage.com/96x24/6c63ff/ffffff&text=codecov" height="24" alt="codecov" class="opacity-75">
        <img src="https://dummyimage.com/96x24/6c63ff/ffffff&text=user" height="24" alt="user" class="opacity-75">
        <img src="https://dummyimage.com/96x24/6c63ff/ffffff&text=magic+leap" height="24" alt="magic leap" class="opacity-75">
      </div>
    </div>
    <!-- decorative circles -->
    <div class="circle circle-lg"></div>
    <div class="circle circle-sm"></div>
  </section>

  <!-- SERVICES -->
  <section class="py-5">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="fw-bold">Fostering a playful & engaging learning<br class="d-none d-md-block"> environment</h2>
      </div>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card h-100 service-card">
            <div class="card-body">
              <div class="icon-badge mb-3"><i class="bi bi-bezier2"></i></div>
              <h5 class="card-title">Interaction Design</h5>
              <p class="card-text text-secondary">Lessons on design that cover the most recent developments.</p>
              <a href="#" class="link-primary fw-semibold">Learn More <i class="bi bi-arrow-right-short"></i></a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card h-100 service-card">
            <div class="card-body">
              <div class="icon-badge mb-3"><i class="bi bi-layout-wtf"></i></div>
              <h5 class="card-title">UX Design Course</h5>
              <p class="card-text text-secondary">Classes in development that cover the most recent advancements in web.</p>
              <a href="#" class="link-primary fw-semibold">Learn More <i class="bi bi-arrow-right-short"></i></a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card h-100 service-card">
            <div class="card-body">
              <div class="icon-badge mb-3"><i class="bi bi-ui-checks-grid"></i></div>
              <h5 class="card-title">User Interface Design</h5>
              <p class="card-text text-secondary">UI Design courses that cover the most recent trends.</p>
              <a href="#" class="link-primary fw-semibold">Learn More <i class="bi bi-arrow-right-short"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- POPULAR CLASSES -->
  <section class="py-5">
    <div class="container">
      <div class="d-flex flex-wrap justify-content-between align-items-end mb-4">
        <div>
          <span class="text-secondary text-uppercase small">Explore Programs</span>
          <h3 class="fw-bold mb-0">Our Most Popular Class</h3>
        </div>
        <a href="#" class="btn btn-outline-light">Explore All Programs</a>
      </div>

      <div class="row g-4">
        <div class="col-md-4">
          <div class="card h-100 bg-body-tertiary border-0 shadow-sm">
            <img class="card-img-top object-fit-cover" style="height:180px" src="https://images.unsplash.com/photo-1551281044-8c5f6c8d08f9?q=80&w=1200&auto=format&fit=crop" alt="figma">
            <div class="card-body d-flex flex-column">
              <span class="badge bg-primary-subtle text-primary-emphasis w-fit mb-2">Design</span>
              <h5 class="card-title">Figma UI UX Design</h5>
              <p class="card-text small text-secondary flex-grow-1">Use Figma to get a job in UI Design, User Interface, User Experience design.</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="small text-secondary"><i class="bi bi-star-fill text-warning"></i> 4.3 <span class="opacity-75">(15,235)</span></div>
                <div class="fw-bold">$17.84</div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card h-100 bg-body-tertiary border-0 shadow-sm">
            <img class="card-img-top object-fit-cover" style="height:180px" src="https://images.unsplash.com/photo-1518779578993-ec3579fee39f?q=80&w=1200&auto=format&fit=crop" alt="developer">
            <div class="card-body d-flex flex-column">
              <span class="badge bg-primary-subtle text-primary-emphasis w-fit mb-2">Design</span>
              <h5 class="card-title">Learn With Shoaib</h5>
              <p class="card-text small text-secondary flex-grow-1">Design Websites and Mobile Apps that your users love and return to again.</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="small text-secondary"><i class="bi bi-star-fill text-warning"></i> 3.9 <span class="opacity-75">(8,237)</span></div>
                <div class="fw-bold">$8.99</div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card h-100 bg-body-tertiary border-0 shadow-sm">
            <img class="card-img-top object-fit-cover" style="height:180px" src="https://images.unsplash.com/photo-1542831371-29b0f74f9713?q=80&w=1200&auto=format&fit=crop" alt="ui">
            <div class="card-body d-flex flex-column">
              <span class="badge bg-primary-subtle text-primary-emphasis w-fit mb-2">Design</span>
              <h5 class="card-title">Building User Interface</h5>
              <p class="card-text small text-secondary flex-grow-1">Learn how to apply UX principles to your website designs.</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="small text-secondary"><i class="bi bi-star-fill text-warning"></i> 4.2 <span class="opacity-75">(1,725)</span></div>
                <div class="fw-bold">$11.70</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- TUTORS -->
  <section class="py-5">
    <div class="container">
      <div class="text-center mb-5">
        <span class="text-secondary text-uppercase small">Tutors</span>
        <h3 class="fw-bold">Meet the Heroes</h3>
        <p class="text-secondary">On Weekend UX, instructors from all over the world instruct millions of students.</p>
      </div>
      <div class="row g-4">
        <div class="col-12 col-md-6 col-lg-3">
          <div class="card h-100 border-0 shadow-sm bg-body-tertiary text-center p-3">
            <img src="https://i.pravatar.cc/160?img=13" alt="avatar" class="rounded-circle mx-auto mt-3" width="96" height="96">
            <div class="card-body">
              <h6 class="mb-0">Theresa Webb</h6>
              <small class="text-secondary d-block">Application Support Analyst Lead</small>
              <p class="small text-secondary mt-2">Former co-founder of Opendoor. Early staff at Spotify and Clearbit.</p>
              <div class="d-flex justify-content-center gap-2">
                <a class="btn btn-sm btn-outline-light" href="#"><i class="bi bi-linkedin"></i></a>
                <a class="btn btn-sm btn-outline-light" href="#"><i class="bi bi-twitter-x"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
          <div class="card h-100 border-0 shadow-sm bg-body-tertiary text-center p-3">
            <img src="https://i.pravatar.cc/160?img=32" alt="avatar" class="rounded-circle mx-auto mt-3" width="96" height="96">
            <div class="card-body">
              <h6 class="mb-0">Courtney Henry</h6>
              <small class="text-secondary d-block">Director, Undergraduate Analytics and Planning</small>
              <p class="small text-secondary mt-2">Lead engineering teams at Figma, Pitch, and Protocol Labs.</p>
              <div class="d-flex justify-content-center gap-2">
                <a class="btn btn-sm btn-outline-light" href="#"><i class="bi bi-linkedin"></i></a>
                <a class="btn btn-sm btn-outline-light" href="#"><i class="bi bi-twitter-x"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
          <div class="card h-100 border-0 shadow-sm bg-body-tertiary text-center p-3">
            <img src="https://i.pravatar.cc/160?img=56" alt="avatar" class="rounded-circle mx-auto mt-3" width="96" height="96">
            <div class="card-body">
              <h6 class="mb-0">Albert Flores</h6>
              <small class="text-secondary d-block">Career Educator</small>
              <p class="small text-secondary mt-2">Former PM for Linear, Lambda School, and On Deck.</p>
              <div class="d-flex justify-content-center gap-2">
                <a class="btn btn-sm btn-outline-light" href="#"><i class="bi bi-linkedin"></i></a>
                <a class="btn btn-sm btn-outline-light" href="#"><i class="bi bi-twitter-x"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
          <div class="card h-100 border-0 shadow-sm bg-body-tertiary text-center p-3">
            <img src="https://i.pravatar.cc/160?img=40" alt="avatar" class="rounded-circle mx-auto mt-3" width="96" height="96">
            <div class="card-body">
              <h6 class="mb-0">Marvin McKinney</h6>
              <small class="text-secondary d-block">Co-op & Internships Manager</small>
              <p class="small text-secondary mt-2">Frontend dev for Linear, Coinbase, and Postscript.</p>
              <div class="d-flex justify-content-center gap-2">
                <a class="btn btn-sm btn-outline-light" href="#"><i class="bi bi-linkedin"></i></a>
                <a class="btn btn-sm btn-outline-light" href="#"><i class="bi bi-twitter-x"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- BLOGS + FOOTER LINKS -->
  <section class="py-5 border-top border-opacity-10">
    <div class="container">
      <h4 class="fw-bold mb-4">Our recent blogs</h4>
      <div class="row g-4">
        <div class="col-md-6 col-lg-3">
          <a class="card h-100 blog-card" href="#">
            <img class="card-img-top object-fit-cover" style="height:140px" src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=1200&auto=format&fit=crop" alt="blog1">
            <div class="card-body">
              <small class="text-secondary d-block">November 16, 2014</small>
              <h6 class="mt-1 mb-2">Three Pillars of User Delight</h6>
              <p class="small text-secondary mb-0">Delight can be experienced viscerally, behaviourally, and reflectively…</p>
            </div>
          </a>
        </div>
        <div class="col-md-6 col-lg-3">
          <a class="card h-100 blog-card" href="#">
            <img class="card-img-top object-fit-cover" style="height:140px" src="https://images.unsplash.com/photo-1472289065668-ce650ac443d2?q=80&w=1200&auto=format&fit=crop" alt="blog2">
            <div class="card-body">
              <small class="text-secondary d-block">September 24, 2017</small>
              <h6 class="mt-1 mb-2">UX Mapping Methods</h6>
              <p class="small text-secondary mb-0">Visual-design principles can be applied consistently throughout…</p>
            </div>
          </a>
        </div>
        <div class="col-md-6 col-lg-3">
          <a class="card h-100 blog-card" href="#">
            <img class="card-img-top object-fit-cover" style="height:140px" src="https://images.unsplash.com/photo-1487014679447-9f8336841d58?q=80&w=1200&auto=format&fit=crop" alt="blog3">
            <div class="card-body">
              <small class="text-secondary d-block">March 13, 2014</small>
              <h6 class="mt-1 mb-2">Agile Development Projects and Usability</h6>
              <p class="small text-secondary mb-0">Agile methods aim to overcome usability barriers in traditional development…</p>
            </div>
          </a>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="p-4 h-100 rounded-4 bg-body-tertiary d-flex flex-column justify-content-between">
            <div>
              <h6 class="fw-bold">Product</h6>
              <ul class="list-unstyled small text-secondary mb-4">
                <li><a class="link-light link-opacity-75-hover" href="#">Overview</a></li>
                <li><a class="link-light link-opacity-75-hover" href="#">Features</a></li>
                <li><a class="link-light link-opacity-75-hover" href="#">Solutions</a></li>
                <li><a class="link-light link-opacity-75-hover" href="#">Tutorials</a></li>
                <li><a class="link-light link-opacity-75-hover" href="#">Pricing</a></li>
              </ul>
              <h6 class="fw-bold">Company</h6>
              <ul class="list-unstyled small text-secondary mb-0">
                <li><a class="link-light link-opacity-75-hover" href="#">About us</a></li>
                <li><a class="link-light link-opacity-75-hover" href="#">Careers</a></li>
                <li><a class="link-light link-opacity-75-hover" href="#">Press</a></li>
                <li><a class="link-light link-opacity-75-hover" href="#">News</a></li>
              </ul>
            </div>
            <div class="pt-3">
              <div class="d-flex gap-2">
                <a class="btn btn-outline-light btn-sm" href="#"><i class="bi bi-twitter-x"></i></a>
                <a class="btn btn-outline-light btn-sm" href="#"><i class="bi bi-linkedin"></i></a>
                <a class="btn btn-outline-light btn-sm" href="#"><i class="bi bi-github"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="py-4 border-top border-opacity-10">
    <div class="container d-flex flex-column flex-lg-row justify-content-between gap-3 align-items-center">
      <div class="small text-secondary">© 2025 JagoTeknik. All rights reserved.</div>
      <ul class="nav gap-3 small">
        <li class="nav-item"><a class="nav-link text-secondary" href="#">Terms</a></li>
        <li class="nav-item"><a class="nav-link text-secondary" href="#">Privacy</a></li>
        <li class="nav-item"><a class="nav-link text-secondary" href="#">Cookies</a></li>
        <li class="nav-item"><a class="nav-link text-secondary" href="#">Contact</a></li>
      </ul>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
