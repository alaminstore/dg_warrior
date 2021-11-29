@extends('frontend.home')
@section('title','DG Warrior | Home')
@section('content')
<style>.team_content {display: flex; width: 100%;flex-wrap: wrap;justify-content: center;align-items: center;}.error{color:#a84343;font-size:13px;}.gap_br {margin-top: -5px;}.gap_sp {margin-top: 10px;}</style>
<section id="hero" class="d-flex align-items-center">
    <div class="container d-flex flex-column align-items-center justify-content-center" data-aos="fade-up">
      <h1>DG Warrior</h1>
      <h2>Community is our priority</h2>
      <a href="{{ url('/home') }}" class="btn-get-started scrollto">Get Started</a>
      <a href="#" id="google_translate_elements"   data-toggle="tooltip" data-placement="bottom" title="Select Which language you want to convert"></a>
    </div>
  </section>
 <main id="main">
    <section id="about" class="about">
      <div class="container">

        <div class="row no-gutters">
          <div class="content col-xl-5 d-flex align-items-stretch" data-aos="fade-right">
            <div class="content">
              <h3>What is DG Warrior?</h3>
                <p><div class="gap_br"></div>The internet is known as a small world where anything can be done without stress. The past few years have proven that the internet technology as got enough room for projects that are ready to simplify the world’s most difficult activities. This led to the pioneering of the different gig/freelance platforms designed for professionals.
                <br><br><div class="gap_br"></div> The DG warrior is an all-new reward system platform equipped for businesses, organisations or even individuals within the community as a marketplace for job listings by issuer, and work completion by job participant.
                <br><br><div class="gap_br"></div> All tasks do not require a skillset or particular qualification on DG warrior platform, there is something for everyone; anyone can earn on DG warrior.
              </p>
              {{-- <a href="#" class="about-btn">About us <i class="bx bx-chevron-right"></i></a> --}}
            </div>
          </div>
          <div class="col-xl-7 d-flex align-items-stretch" data-aos="fade-left">
            <div class="icon-boxes d-flex flex-column justify-content-center">
              <div class="row">
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                  <i class="bx bx-face"></i>
                  <h4>Distribution</h4>
                  <p>On DG warrior, you do not need special skills. Whether you are skilled or unskilled, you can find tasks on DG warrior. All tasks do not require a skillset or particular qualification on DG warrior platform, there is something for everyone; anyone can earn on DG warrior.
                  <div class="gap_br"></div> </p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                  <i class="bx bxs-group"></i>
                  <h4>Gathering</h4>
                  <p>We have dedicated a great deal of time and energy to designing and building this platform and community with the view of enabling everyone to participate and earn rewards without worrying about being screened out or limited as is the case with most of the other popular freelance platforms.</p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                  <i class="bx bx-atom"></i>
                  <h4>Wide Range</h4>
                  <p>Listed jobs will include a wide range of services, such as objective’s task, survey, challenge, polls, quiz or even experimental research, such that both skilled and unskilled participant can participate.</p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="400">
                  <i class="bx bx-gift"></i>
                  <h4>Rewards</h4>
                  <p>The DG warrior platform credits (USD) will be used by clients to post jobs on the platform and will also be paid to participant who complete jobs.</p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>

    <section id="features" class="features" data-aos="fade-up">
      <div class="container">

        <div class="section-title">
          <h2>Features</h2>
          <p>
            More upcoming products ranging from Quiz, Survey Research, Games, Polls, Objectives Task to Experimental Research to gather more accurate feedback with our AI analytic to create a data driven decisions.
          </p>
        </div>

        <div class="row content">
          <div class="col-md-5" data-aos="fade-right" data-aos-delay="100">
            <img src="frontend/assets/img/features-1.png" class="img-fluid" alt="">
          </div>
          <div class="col-md-7 pt-4" data-aos="fade-left" data-aos-delay="100">
            <h3>Quiz and Objective Tasks</h3>
            <ul>
              <li>
                <span style="color:#3b4ef8;font-size:20px;">&check;</span> No technical skills needed, create and publish your own quizzes to get engagements with large numbers of participants and also to gain insight in audience.
              </li>
              <li>
                <span style="color:#3b4ef8;font-size:20px;">&check;</span> Publishing an objective task is important as objective task can better direct participants towards achieving organisation goals and visions.
              </li>
            </ul>
          </div>
        </div>

        <div class="row content">
          <div class="col-md-5 order-1 order-md-2" data-aos="fade-left">
            <img src="frontend/assets/img/features-2.png" class="img-fluid" alt="">
          </div>
          <div class="col-md-7 pt-5 order-2 order-md-1" data-aos="fade-right">
            <h3>Online Survey Research</h3>
            <ul>
             <li>
                <span style="color:#3b4ef8;font-size:20px;">&check;</span> Increase response rates by reaching your target audience fast, conduct market research at a fraction of the usual cost, get real-time results for quick and easy analysis with our simple templates written by experts.
             </li>
             <li>
                <span style="color:#3b4ef8;font-size:20px;">&check;</span> One of the biggest advantages of online surveys is their cost. Online surveys are cheaper than paper ones conduct market research at a fraction of the usual cost, and get real-time results for quick and easy analysis. <div class="gap_sp"></div> Increase response rates by reaching your target audience fast, the convenience and reach of online surveys, coupled with their accessibility, make them particularly suited to produce quick results. When it comes down to it, online surveys are usually more accurate. Since respondents record their own answers, there is no opportunity for an interviewer or facilitator to misinterpret a response, and there is a better chance that respondents will be fully honest.
             </li>
            </ul>
          </div>
        </div>
        <div class="row content">
          <div class="col-md-5" data-aos="fade-right">
            <img src="frontend/assets/img/features-3.png" class="img-fluid" alt="">
          </div>
          <div class="col-md-7 pt-5" data-aos="fade-left">
            <h3>Games and Polls</h3>
            <ul>
              <li><span style="color:#3b4ef8;font-size:20px;">&check;</span>
                MiniGames can be a powerful tool, Mini-games have several strong advantages, such as simple instructions, wide user reach, low threshold, diverse carriers and strong social interaction. <div class="gap_sp"></div> Based on these advantages Mini-games can better match the user attributes and promotion of its social platform.
              </li>
              <li><span style="color:#3b4ef8;font-size:20px;">&check;</span>
                 Polls are great because they allow people to respond with minimal effort, making engagement more likely. It takes a split second to answer a poll, because the choices are already there this makes polls attractive. <div class="gap_sp"></div> The fact that with some polls the results are shown after voting encourages people to engage, as those who are curious to know the results will have to vote to see them.
              </li>
            </ul>
          </div>
        </div>
        <div class="row content">
          <div class="col-md-5 order-1 order-md-2" data-aos="fade-left">
            <img src="frontend/assets/img/features-4.png" class="img-fluid" alt="">
          </div>
          <div class="col-md-7 pt-5 order-2 order-md-1" data-aos="fade-right">
            <h3>Experimental Research</h3>
            <ul>
              <li>
                <span style="color:#3b4ef8;font-size:20px;">&check;</span>How do you make sure that a new product, theory, or idea has validity? There are multiple ways to test them, with one of the most common being the use of experimental research. When there is complete control over one variable, the other variables can be manipulated to determine the value or validity that has been proposed.
              </li>
              <li>
                <span style="color:#3b4ef8;font-size:20px;">&check;</span> Experimental research is not limited to a specific industry or type of idea. It can be used in a wide variety of situations. Experimental research is straightforward, basic form of research that allows for its duplication when the same variables are controlled by others. This helps to promote the validity of a concept for products, ideas, and theories.
              </li>
            </ul>
          </div>
        </div>

      </div>
    </section>
    <section id="services" class="services">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Services</h2>
          <p>
          With the assist of our user-friendly platform and community contributions, our goal is a broad statement of the primary aim or outcome. The objectives are specific and measurable steps to meet the goal.
          The objectives provide a framework for issuing the right job.
          As an example for market conversion, identifying the demographic characteristics within the community is often an important objective.
          </p>
        </div>

        <div class="row">
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-happy-beaming"></i></div>
              <h4 class="title"><a href="">User Friendly</a></h4>
              <p class="description">No technical skills needed, create and publish your own job based on your primary aim or outcome</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-customize"></i></div>
              <h4 class="title"><a href="">Customizations</a></h4>
              <p class="description">You can easily customize the type of  jobs that suits your demand with our dashboard systems</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-world"></i></div>
              <h4 class="title"><a href="">Community</a></h4>
              <p class="description">Huge world wide  community of DG Warrior makes targeted outcome more accurate and easier</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="400">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-coin-stack"></i></div>
              <h4 class="title"><a href="">Flexible</a></h4>
              <p class="description">Flexible rewards let you set each completed job reward to bring up the jobs effectiveness</p>
            </div>
          </div>

        </div>

      </div>
    </section>

    <section id="testimonials" class="testimonials section-bg">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Testimonials</h2>
          <p>
            Our vision, mission, and values reflect the best interests of our clients, users, employees, and community. They inspire our growth. They help shape our business decisions, define our culture, and gauge our success. Through our choices, words, and actions, we strive to live our values each and every day.
          </p>
        </div>
        <div class="owl-carousel testimonials-carousel">
          <div class="testimonial-item">
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              "Platform is user friendly and simple to use without any professional skill needed."
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p><br>
            <img src="frontend/assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
            <h3>Kristine</h3>
          </div>

          <div class="testimonial-item">
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              "Dgwarrior has a great, fresh approach to the business world. It has wide rage of task daily which doesn’t require any knowledge.”
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
            <img src="frontend/assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
            <h3>Maria</h3>
          </div>
          <div class="testimonial-item">
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              "DGWARRIOR have helped my business gain lots of attention by issuing task.”
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p><br>
            <img src="frontend/assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
            <h3>Ryan</h3>
          </div>
          <div class="testimonial-item">
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              “I recommend you to use Dg warrior platform. I am using it for month and it is very interesting.”
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p><br>
            <img src="frontend/assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
            <h3>Kelly</h3>
          </div>
          <div class="testimonial-item">
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              " I love my dgwarrior! Easy platform to use, fantastic staff and nothing but great results!"
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
            <br>
            <img src="frontend/assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
            <h3>George</h3>
          </div>
          <div class="testimonial-item">
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              “You can really tell that their community is big. They have helped me gained new client in a short amount of time.”
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
            <img src="frontend/assets/img/testimonials/testimonials-6.jpg" class="testimonial-img" alt="">
            <h3>Nancy</h3>
          </div>

        </div>

      </div>
    </section>
    <section id="team" class="team">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Our Team</h2>
          <p>We’re a sincere team of professionals with years of experience in relevant industries delivering intuitive, people-centric solutions that help industry leaders quickly and confidently make important decisions, take action, and achieve tangible results.</p>
        </div>
        <div class="row">
          <div class="team_content">
            <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="member">
                  <img src="frontend/assets/img/team/team-1.jpeg" class="img-fluid" alt="">
                  <div class="member-info">
                    <div class="member-info-content">
                      <h4>Luis Smith</h4>
                      <span>Chief Executive Officer</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="member">
                  <img src="frontend/assets/img/team/team-2.jpeg" class="img-fluid" alt="">
                  <div class="member-info">
                    <div class="member-info-content">
                      <h4>Ronnie Fischer</h4>
                      <span>Chief Technical Officer</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="member">
                  <img src="frontend/assets/img/team/team-3.jpeg" class="img-fluid" alt="">
                  <div class="member-info">
                    <div class="member-info-content">
                      <h4>Ryan Miller</h4>
                      <span>Managing Director</span>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
          <div class="section-title">
            <h3>About Us</h3>
              <div class="row content"></div><p><b>Our vision</b> is to build up a community with all industries leaders and professional around the globe to raise human experience by amplifying individual voices. We exist to serve people-their passions, pursuits, and potential. Our product and technologies are design to understand from individual’s perspectives regarding their needs. We believe in equality and the power of elevated voices.</p>
              <div class="row content"></div><p><b>Our mission</b> is to shape and power the curiosity on what’s next for organisation and communities. Which helps turn insight into action, empowering you to grow, innovate, and change what’s possible to establish a brave and ambitious teams.</p>
              <div class="row content"></div><p><b>Our core values</b> helps define our culture, shape our business decisions, and inspire our growth. We strive to live our values each and every day, through our choices, words, and actions. </p>
          </div>
      </div>
    </section>
    <section id="faq" class="faq">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Frequently Asked Questions</h2>
        </div>
        <ul class="faq-list">
          <li data-aos="fade-up" data-aos-delay="100">
            <a data-toggle="collapse" class="" href="#faq1">Why do I need market research? <i class="fa fa-chevron-up" aria-hidden="true"></i></a>
            <div id="faq1" class="collapse show" data-parent=".faq-list">
              <p>
                Market research provides critical information about your market and your business landscape. It can tell you how your company is perceived by the target customers and clients you want to reach.
              </p>
            </div>
          </li>
          <li data-aos="fade-up" data-aos-delay="200">
            <a data-toggle="collapse" href="#faq2" class="collapsed">How does market research enhance my business?  <i class="fa fa-chevron-up" aria-hidden="true"></i></a>
            <div id="faq2" class="collapse" data-parent=".faq-list">
              <p>
                Market research can help you develop products that customers want to buy. Market research can help you know whether or not your product idea will appeal to your customer base. You can also gather competitive intelligence to find out how to differentiate yourself from other companies with similar products and services.
              </p>
            </div>
          </li>
          <li data-aos="fade-up" data-aos-delay="300">
            <a data-toggle="collapse" href="#faq3" class="collapsed">What Objectives Task benefits? <i class="fa fa-chevron-up" aria-hidden="true"></i></a>
            <div id="faq3" class="collapse" data-parent=".faq-list">
              <p>
                Businesses can issue objectives task to help with brand exposure. This allows businesses to direct where their main focus should be. Objectives also shows directions to where the business is planning to take. ... Objectives task are set to help a business to achieve its aims.
              </p>
            </div>
          </li>
          <li data-aos="fade-up" data-aos-delay="400">
            <a data-toggle="collapse" href="#faq4" class="collapsed">Why DG Warrior?  <i class="fa fa-chevron-up" aria-hidden="true"></i></a>
            <div id="faq4" class="collapse" data-parent=".faq-list">
              <p>
                DG has a very huge groups of online community around the world with professional network to bring people together around a centralized, shared organization-based experience or purpose for expansive online collaboration and growth. These communities play a huge part in customer or member experience. They break down the traditional one-way exchange of information & open up communication to deliver increased value.
              </p>
            </div>
          </li>
        </ul>
      </div>
    </section>
    <section id="contact" class="contact section-bg">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Contact Us</h2>
          <p>Ready to join us?</p>
        </div>
        <div class="row">
          <div class="col-lg-6">
              <div class="col-md-12">
                <div class="info-box mt-4">
                  <i class="bx bx-envelope"></i>
                  <h3>Email us</h3>
                  <p>support@dgwarrior.com</p>
                </div>
              </div>
          </div>
          {{-- PLZ Dont't edit from this portion --}}

          <div class="col-lg-6 mt-4 mt-md-0">
             {!!Form::open(['class' => 'form-horizontal','id'=>'mailIdSystem'])!!}
                @csrf
              <div class="form-row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validate"></div>
                </div>
                <div class="col-md-6 form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                <div class="validate"></div>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary" id="btn-loading">
                    <span  id="pre-loading" class="spinner-border-sm" role="status" aria-hidden="true"></span>
                    Send Message
                </button>
            </div>
            {!!Form::close()!!}
          </div>
        </div>
      </div>
    </section>
  </main>
  @endsection
  @section('scripts')
  <script>
    $("#mailIdSystem").validate({
        rules: {
            name: {
                required:true,
                maxlength: 80,
            },
            email: {
                required:true,
            },
            subject: {
                required:true,
            },
            message: {
                required:true,
            },
        }
    });
    $( document ).ready(function() {
        $('#mailIdSystem').on('submit', function (e) {
            e.preventDefault();
            var $form = $(this);
            if(! $form.valid()) return false;
            $( "#btn-loading" ).prop( "disabled", true );
            $( "#pre-loading" ).addClass( "spinner-border");
            $.ajax({
                url: "{{route('send.email')}}",
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    // console.log('save', response);
                    toastr.options = {
                        "debug": false,
                        "positionClass": "toast-top-right",
                        "onclick": null,
                        "fadeIn": 300,
                        "fadeOut": 1000,
                        "timeOut": 5000,
                        "extendedTimeOut": 1000
                    };
                    if(response.status == 0){
                        $.each(response.error,function(key,value){
                            toastr.error(value);
                        })
                    }else{
                        if(response.status == true){
                            $( "#btn-loading" ).prop( "disabled", false );
                            $( "#pre-loading" ).removeClass( "spinner-border");
                            $('#mailIdSystem').trigger('reset');
                            toastr.success('Your message sent Successfully');
                        }
                    }
                }
            });
        });
     });
  </script>
  @endsection
