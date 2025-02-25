<?php require_once '../app/views/layout/header.php'; ?>
  <header>
    <a href="/"  class="menu-home mob-see "><img src="pic/logo-mob.svg" alt="Logo" class="logo"></a>
    <a href="#"><img class="flag mob-see" src="pic/lang-engl.png" alt="flag" title="English" ></a>
    <label  class="menu-toggle-label" aria-label="Toggle flyout menu" onclick="toggleElements()">
      <img src="pic/logo-so/menu.svg" alt="Menu" class="menu-toggle">
    </label>
    <label  class="close mob-see" aria-label="Toggle flyout menu" onclick="reloadPage()">
      <img src="pic/logo-so/close.svg" alt="close" class="close-toggle">
    </label>

    <div class="menu-flyout">
      <nav class="menu-main">
        <a href="#about-me">About me</a>
        <a href="#skills">Skills</a>
        <a href="#portfolio">Portfolio</a>
        <a id="contact-me" href="#contact">CONTACT ME</a>
      </nav>
      <a href="#"><img class="flag" src="pic/lang-engl.png" alt="flag" title="English" ></a>
    </div>
  </header>
  <main>
    <section id="preview">
      <div class="container">
        <div class="prev" >
          <div class="name-prev">
            <p class="name">Hi, I am <br><span>Pasha</span></p>
            <h1 class="prof-prev">Full-stack  <strong>Developer</strong> / Tutor</h1>
            <div class="soc-prev">
              <a href="#"><img class="mail-prev" src="pic/logo-so/mail%20symbol.png" alt="My email" title="My email" ></a>
              <a href="#"><img class="git-prev" src="pic/logo-so/git.png" alt="My Git" title="My Git Hab" ></a>
              <a href="#"><img class="linkedin-prev" src="pic/logo-so/linkedin%20symbol.png" alt="My LinkedIn" title="My LinkedIn" ></a>
            </div>
          </div>
          <div class="empty-prev"></div>
        </div>
      </div>
      <div class="tutor-prev">
        <div class="tutor-prev-text container">
          <h2>it tutor</h2>
          <p>I am a mentor in IT field . I help people to get into the IT field in a short tea. I am also a full-stack developer. I work as a teacher in cyberOne and give private lessons. I also work as a Full Stack Developer for a marketing company. I am constantly developing my skills and my projects.  If you want to learn more about me, click the button below!</p>
          <a href="#">READ MORE</a>
        </div>
        <img class="tutor-prev-logo" src="pic/Logo%20ITB.svg" alt="Logo ITB">
      </div>
    </section>

    <section id="mob-preview">
      <div class="mob-carousel">
        <div class="prev-item first">
          <div class="name-prev">
            <p class="name">my name is <span>Pasha</span></p>
            <h1 class="prof-prev">I'm a <strong>Developer</strong> </h1>
            <img class="divider" src="pic/separatorBlack.svg" alt="divider">
            <div class="soc-prev">
              <a href="#"><img class="mail-prev" src="pic/logo-so/cib_mail-ru.png" alt="email" title="My email" ></a>
              <a href="#"><img class="git-prev" src="pic/logo-so/git-white.png" alt="Git" title="My Git Hab" ></a>
              <a href="#"><img class="linkedin-prev" src="pic/logo-so/entypo-social_linkedin-with-circle.png" alt="LinkedIn" title="My LinkedIn" ></a>
            </div>
          </div>
        </div>
        <div class="prev-item second">
          <div class="name-prev">
            <div class="text-prev">
              <p class="name">Hi, I am <br><span>Pasha</span></p>
              <h1 class="prof-prev">Full-stack  <strong>Developer</strong> / Tutor</h1>
            </div>
            <div class="soc-prev">
              <a href="#"><img class="mail-prev" src="/assets/pic/logo-so/cib_mail-ru.png" alt="email" title="My email" ></a>
              <a href="#"><img class="git-prev" src="/assets/pic/logo-so/git-white.png" alt="Git" title="My Git Hab" ></a>
              <a href="#"><img class="linkedin-prev" src="pic/logo-so/entypo-social_linkedin-with-circle.png" alt="LinkedIn" title="My LinkedIn" ></a>
            </div>
          </div>
        </div>
      </div>
      <div class="tutor-prev">
        <div class="tutor-prev-text container">
          <h2>it tutor</h2>
          <p>I am a mentor in IT field . I help people to get into the IT field in a short tea. I am also a full-stack developer. I work as a teacher in cyberOne and give private lessons. I also work as a Full Stack Developer for a marketing company. I am constantly developing my skills and my projects.  If you want to learn more about me, click the button below!</p>
          <a href="#">READ MORE</a>
        </div>
        <img class="tutor-prev-logo" src="pic/Logo%20ITB.svg" alt="Logo ITB">
        <a class="mob-more" href="#">MORE</a>
      </div>
    </section>



    <section id="about-me">
      <div class="container">
        <h2>ABOUT ME</h2>
        <p>My name is Pasha, I have completed many IT courses, I also have a higher technical education. I finished a course in general psychology. I have been studying full stack technologies for more than 5 years, and this time was enough for me to make sure that this is my place in the industry.</p>
        <p>Working in a children's computer school has taught me a lot, as well as I have learned and explored so much technology. But I put most of my efforts into the web: design, non-coding, programming, etc. </p>
        <a class="button-style" href="#">EXPLORE</a>
        <img class="divider" src="pic/separatorBlack.svg" alt="divider">
        <div class="label-prof">
          <div id="tutor">
            <h3 class="about-h3">TUTOR</h3>
            <p class="about-p">Having experience in teaching whith 6 year olds, it is easy for me to explain a complex topic in a language you can understand</p>
          </div>
          <div id="development">
            <h3 class="about-h3">DEVELOPMENT</h3>
            <p class="about-p">Having experience in teaching whith 6 year olds, it is easy for me to explain a complex topic in a language you can understand</p>
          </div>
        </div>
        <div id="maintenance">
          <h3 class="about-h3" >MAINTENANCE</h3>
          <p class="about-p">I can design the site based on your needs and suggestions. I can <br> also design the site from scratch and consult you during the job.</p>
        </div>
        <img class="divider" src="pic/separatorBlack.svg" alt="divider">
      </div>
    </section>
    <section id="skills">
      <div class="container">
        <h2>SKILLS</h2>
        <h3>USING NOW:</h3>
        <div class="skills-row">
          <figure>
            <img src="pic/logo-teh/logo-html.svg" alt="logo-html">
            <figcaption>HTML</figcaption>
          </figure>
          <figure>
            <img src="pic/logo-teh/logo-css.svg" alt="logo-css">
            <figcaption>CSS</figcaption>
          </figure>
          <figure>
            <img src="pic/logo-teh/logo-sass.svg" alt="logo-sass">
            <figcaption>SASS</figcaption>
          </figure>
          <figure id="js-none">
            <img src="pic/logo-teh/logo-js.svg" alt="logo-js">
            <figcaption>JAVASCRIPT</figcaption>
          </figure>
        </div>
        <div class="skills-row mob-none">
          <figure >
            <img src="pic/logo-teh/logo-msql.svg" alt="logo-msql">
            <figcaption>MySQL</figcaption>
          </figure>
          <figure>
            <img src="pic/logo-teh/bootstrap.svg" alt="logo-bootstrap">
            <figcaption>BOOTSTRAP</figcaption>
          </figure>
          <figure>
            <img src="pic/logo-teh/git.svg" alt="logo-git">
            <figcaption>GIT</figcaption>
          </figure>
          <figure>
            <img src="pic/logo-teh/figma.svg" alt="logo-figma">
            <figcaption>FIGMA</figcaption>
          </figure>
        </div>
        <div class="skills-row mob-none">
          <figure>
            <img src="pic/logo-teh/php.svg" alt="logo-php">
            <figcaption>PHP</figcaption>
          </figure>
          <figure>
            <img src="pic/logo-teh/wordpress.svg" alt="logo-wordpress">
            <figcaption>WORDPRESS</figcaption>
          </figure>
          <figure>
            <img src="pic/logo-teh/webflow.svg" alt="logo-webflow">
            <figcaption>WEBfLOW</figcaption>
          </figure>
          <figure>
            <img src="pic/logo-teh/yii2.svg" alt="logo-yii2">
            <figcaption>YII-2</figcaption>
          </figure>
        </div>
        <div class="skills-row mob-none">
          <figure>
            <img src="pic/logo-teh/linux.svg" alt="logo-linux">
            <figcaption>LINUX</figcaption>
          </figure>
          <figure>
            <img src="pic/logo-teh/bash.svg" alt="logo-bash">
            <figcaption>BASH</figcaption>
          </figure>
          <figure>
            <img src="pic/logo-teh/docker.svg" alt="logo-docker">
            <figcaption>DOCKER</figcaption>
          </figure>
          <figure>
            <img src="pic/logo-teh/opencart.svg" alt="logo-opencart">
            <figcaption>OPENCART</figcaption>
          </figure>
        </div>

        <h3 class="mob-none">OTHER SKILLS:</h3>
        <div class="skills-row mob-none">
          <figure>
            <img src="pic/engl-flag.svg" alt="logo-engl-flag">
            <figcaption>ENGLISH <br> B1/B2</figcaption>
          </figure>
          <figure>
            <img src="pic/ukrain-flag.svg" alt="logo-ukrain-flag">
            <figcaption>UKRAINE <br>NATIVE</figcaption>
          </figure>
          <figure>
            <img src="pic/extreme.svg" alt="logo-extreme">
            <figcaption>EXTREME</figcaption>
          </figure>
          <figure>
            <img src="pic/psychology.svg" alt="logo-psychology">
            <figcaption>PSYCHOLOGY</figcaption>
          </figure>
        </div>
<!--        <a class="button-style mob-first" href="#">MORE</a>-->
      </div>
    </section>

    <section id="portfolio">
      <div class="portfolio-h2">
        <h2>PORTFOLIO</h2>
      </div>
      <div class="portfolio-main">
        <div class="portfolio-menu">
          <a class="mob-more activ" href="#">ALL</a>
          <a class="mob-more" href="#">CODED</a>
          <a class="mob-more" href="#">DESIGNED</a>
        </div>
        <div class="portfolio-project">
          <a class="mob-more" href="#"><img src="pic/Portfolio/Project.png" alt="project-extreme" title="Pls click"></a>
          <a class="mob-more" href="#"><img src="pic/Portfolio/Project-4.png" alt="project-extreme" title="Pls click"></a>
          <a class="mob-more" href="#"><img src="pic/Portfolio/Project-3.png" alt="project-extreme" title="Pls click"></a>
          <a class="mob-more" href="#"><img src="pic/Portfolio/Project-4.png" alt="project-extreme" title="Pls click"></a>
          <a class="mob-more" href="#"><img src="pic/Portfolio/Project-3.png" alt="project-extreme" title="Pls click"></a>
          <a class="mob-more" href="#"><img src="pic/Portfolio/Project.png" alt="project-extreme" title="Pls click"></a>
        </div>
        <p>And many more to come!</p>
      </div>
    </section>

    <section id="contact">
      <div class="container">
        <h2>CONTACT</h2>
        <p>
          Nulla in velit a metus rhoncus tempus. Nulla congue nulla vel sem varius finibus. <br>Sed ornare sit amet lorem sed viverra. In vel urna quis libero viverra facilisis ut ac est.
        </p>
        <img class="divider" src="pic/separatorBlack.svg" alt="divider">
        <form action="#" method="post">
          <input type="text" id="name" name="name" placeholder="ENTER YOUR NAME:" autofocus required>
          <input type="email" id="email" name="email" placeholder="ENTER YOUR EMAIL:" required>
          <input type="tel" id="phone" name="phone" placeholder="PHONE NUMBER:" required>
          <textarea id="message" name="message" rows="8" placeholder="YOUR MESSAGE:" ></textarea>
          <button type="submit">SUBMIT</button>
        </form>
      </div>
    </section>
  </main>

<?php require_once '../app/views/layout/footer.php'; ?>
