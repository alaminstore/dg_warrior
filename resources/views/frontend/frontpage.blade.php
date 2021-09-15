@extends('frontend.home')
@section('title','DG Warrior | Home')
@section('content')
<style>.team_content {display: flex; width: 100%;flex-wrap: wrap;justify-content: center;align-items: center;}.error{color:#a84343;font-size:13px;}.gap_br {margin-top: -5px;}.gap_sp {margin-top: 10px;}</style>
  <section id="hero" class="d-flex align-items-center">
    <div class="container d-flex flex-column align-items-center justify-content-center" data-aos="fade-up">
      <h1>DG Warrior</h1>
      <h2>Community is our priority</h2>
      <a href="{{ url('/home') }}" class="btn-get-started scrollto">Get Started</a>
    </div>
  </section>
 <main id="main">
    <section id="about" class="about">
      <div class="container">

        <div class="row no-gutters">
          <div class="content col-xl-5 d-flex align-items-stretch" data-aos="fade-right">
            <div class="content">
              <h3>Why are market research and objectives so important</h3>
              <p>Why are survey objectives and goals so important? How are they used?  What are the benefits? <div class="gap_br"></div> These are important questions. Establishing clear survey goals and objectives is an essential first step in the survey process. This is where to start if you want to engage your survey respondents and get valid feedback that will help you make the right decisions.
              </p>
              <a href="#" class="about-btn">About us <i class="bx bx-chevron-right"></i></a>
            </div>
          </div>
          <div class="col-xl-7 d-flex align-items-stretch" data-aos="fade-left">
            <div class="icon-boxes d-flex flex-column justify-content-center">
              <div class="row">
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                  <i class="bx bx-receipt"></i>
                  <h4>Survey Research</h4>
                  <p>Surveys are relatively inexpensive. Online surveys and mobile surveys, in particular, have a very small cost per respondent. <div class="gap_br"></div> Even if incentives are given to respondents, the cost per response is often far less than the cost of administering a paper survey or phone survey, and the number of potential responses can be in the thousands.</p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                  <i class="bx bx-cube-alt"></i>
                  <h4>Flexible</h4>
                  <p>Surveys can be administered in many modes, including: online surveys, email surveys, social media surveys, paper surveys, mobile surveys, telephone surveys, and face-to-face interview surveys. <div class="gap_br"></div>  For remote or hard-to-reach respondents, using a mixed mode of survey research may be necessary (e.g. administer both online surveys and paper surveys to collect responses and compile survey results into one data set, ready for analysis).</p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                  <i class="bx bx-images"></i>
                  <h4>Extensive</h4>
                  <p>Online surveys are useful in describing the characteristics of a large population. <div class="gap_br"></div> No other research method can provide this broad capability, which ensures a more accurate sample to gather targeted results in which to draw conclusions and make important decisions.</p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="400">
                  <i class="bx bx-shield"></i>
                  <h4>Dependable</h4>
                  <p>The anonymity of surveys allows respondents to answer with more candid and valid answers. To get the most accurate data, you need respondents to be as open and honest as possible with their answers. <div class="gap_br"></div> Surveys conducted anonymously provide an avenue for more honest and unambiguous responses than other types of research methodologies, especially if it is clearly stated that survey answers will remain completely confidential.</p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
    <section id="clients" class="clients">
      <div class="container" data-aos="zoom-in">
        <div class="row">
          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="frontend/assets/img/clients/client-1.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="frontend/assets/img/clients/client-2.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="frontend/assets/img/clients/client-3.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="frontend/assets/img/clients/client-4.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="frontend/assets/img/clients/client-5.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="frontend/assets/img/clients/client-6.png" class="img-fluid" alt="">
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
            With the assist of decentralised technologies and community contributions, our goal is a broad statement of the primary aim or outcome.  The objectives are specific and measurable steps to meet the goal. The objectives provide a framework for asking the right questions or. As an example, identifying the demographic characteristics of the survey groups is often an important objective.
          </p>
        </div>

        <div class="row">
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bx bxl-dribbble"></i></div>
              <h4 class="title"><a href="">AI Analytics</a></h4>
              <p class="description">Results using AI driven analytics to produce outcome faster</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4 class="title"><a href="">Customizations</a></h4>
              <p class="description">Choose and customize a method to achieve personal/ organisation desire outcome</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-tachometer"></i></div>
              <h4 class="title"><a href="">Community</a></h4>
              <p class="description">Tab on millions of our active communities</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="400">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-layer"></i></div>
              <h4 class="title"><a href="">Template</a></h4>
              <p class="description">All questionnaire template are written by experts </p>
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
              "81% of millennials are checking Twitter at least once a day. The average amount of search queries Twitter receives a day is two billion."
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
            {{-- <img src="{{asset('logo.png')}}" class="testimonial-img" alt=""> --}}
            <h3>Digital Marketing</h3>
          </div>

          <div class="testimonial-item">
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              "Do you know? Based on recent stats, it’s estimated that people will spend a collective 3.8 trillion hours using the mobile internet this year, rising to 4.5 trillion hours in 2021.”
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
            {{-- <img src="{{asset('logo.png')}}" class="testimonial-img" alt=""> --}}
            <h3>Digital Marketing</h3>
          </div>
          <div class="testimonial-item">
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              "Do you know?
              29% of us believe that “cloud computing” involves a real cloud”
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
            {{-- <img src="{{asset('logo.png')}}" class="testimonial-img" alt=""> --}}
            <h3>Fun Facts</h3>
          </div>
          <div class="testimonial-item">
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              “ Do you know?
              48% of us sing in the shower.
              ”
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
            {{-- <img src="{{asset('logo.png')}}" class="testimonial-img" alt=""> --}}
            <h3>Fun Facts</h3>
            {{-- <h4>Freelancer</h4> --}}
          </div>
          <div class="testimonial-item">
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              "Do you know?
              As a very rough rule of thumb, 200 responses will provide fairly good survey accuracy under most assumptions and parameters of a survey project. 100 responses are probably needed even for marginally acceptable accuracy."
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
            <img src="{{asset('logo.png')}}" class="testimonial-img" alt="">
            <h3>Market Response</h3>
            {{-- <h4>Entrepreneur</h4> --}}
          </div>
          <div class="testimonial-item">
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              “Do you know?
              Your short-term memory can only hold on to so much information at a time (unless you try one of the simple ways to improve your memory), which is why you use "chunking" to remember long numbers. For instance, if you try to memorize this number: 90655372, you probably naturally thought something like 906-553-72.”
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
            {{-- <img src="{{asset('logo.png')}}" class="testimonial-img" alt=""> --}}
            <h3>Studies Facts</h3>
            {{-- <h4>Entrepreneur</h4> --}}
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
                    <div class="social">
                      <a href=""><i class="fa fa-twitter"></i></a>
                      <a href=""><i class="fa fa-facebook"></i></a>
                      <a href=""><i class="fa fa-instagram"></i></a>
                      <a href=""><i class="fa fa-linkedin"></i></a>
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
                    <div class="social">
                        <a href=""><i class="fa fa-twitter"></i></a>
                        <a href=""><i class="fa fa-facebook"></i></a>
                        <a href=""><i class="fa fa-instagram"></i></a>
                        <a href=""><i class="fa fa-linkedin"></i></a>
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
                    <div class="social">
                        <a href=""><i class="fa fa-twitter"></i></a>
                        <a href=""><i class="fa fa-facebook"></i></a>
                        <a href=""><i class="fa fa-instagram"></i></a>
                        <a href=""><i class="fa fa-linkedin"></i></a>
                    </div>
                  </div>
                </div>
              </div>
          </div>
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
