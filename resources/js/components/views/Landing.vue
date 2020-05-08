<template>
  <div id="landing">
    <div class="container-fluid">
      <div class="header">
        <ul class="auth-nav">
          <li>
            <a href="/register">Signup now!</a>
          </li>
          <li>
            <a href="/login">Login</a>
          </li>
        </ul>
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-5 text-left">
            <h1>{{ headline }}</h1>
            <p>{{ description }}</p>
            <a href="/surveys" class="btn btn-primary btn-lg">See all Surveys</a>
          </div>
          <div class="col-md-7">
            <div class="polls-container">
              <div v-for="survey in surveys" class="poll-content px-2">
                <div class="card card-body">
                  <survey-content :survey="survey"/>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <footer class="footer">
        <div class="row">
          <div class="col-md-4">
            <div class="copyright">
              <h4>{{ brandname }}</h4>
              &copy; All rights reserved {{ brandname }} 2020 <br>
              United States
            </div>
          </div>
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <!-- <ul class="socials">
              <li>
                <a class="fab">
                  <span class="fab fa-facebook-square"></span>
                </a>
              </li>
              <li>
                <a class="fab">
                  <span class="fab fa-twitter"></span>
                </a>
              </li>
              <li>
                <a class="fab">
                  <span class="fab fa-instagram"></span>
                </a>
              </li>
            </ul> -->
          </div>
        </div>
      </footer>
    </div>
  </div>
</template>

<script>
export default {
  props: ['surveys', 'siteconfig'],
  data(){
    return {
      headline: 'Polly',
      description: 'Access to a whole set of surveys and interesting content know what others think, share with others',
    }
  },
  created(){
    this.headline = this.siteconfig.headline
    this.description = this.siteconfig.description
    this.brandname = this.siteconfig.brandname
    
    setTimeout(function(){
      $('.polls-container').slick({
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: false,
        responsive:[
        {
          breakpoint: 1028,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          }
        },
        {
          breakpoint: 867,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          }
        },
        {
          breakpoint: 576,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          }
        }]
      });
    },1000);
    
  }
}
</script>

<style lang="scss" scoped>
  #landing {
    display: flex;
    flex-flow: column nowrap;
    justify-content: space-between;
    min-height: 100vh;
    color: #1e1e1e;
    // background: linear-gradient(45deg, #ffae00, #f0c103);
    h1 {
      font-size: 5.14em;
      position: relative;
    }
    h1:before {
      display: block;
      font-size: 14px;
      font-weight: 400;
      content: 'Welcome to';
      width: 100%;
    }
    p {
      font-weight: 400;
    }
    .footer {
      padding: 50px 0;
      height: 25vh;
    }
    
    .card {
      color: #434343;
      border-radius: 5px;
      background: none;
      overflow: hidden;
    }
    .card-body {
      padding: 20px 20px 0;
    }
  }
  .header {
    display: flex;
    align-items: center;
  }
  .auth-nav {
    display: inline-flex;
    list-style-type: none;
    padding: 0;
    margin: 0 0 0 auto;
    li {
      margin-left: 20px;
    }
    li a {
      font-size: 1.25em;
      font-weight: 500;
    }
  }
  .slick-list.draggable {
    padding: 5px 0 !important;
  }
  
  @media(min-width: 991px){
    .header {
      height: 25vh;
    }
  }
  .content {
    padding: 50px 0;
  }
  
  .auth-bar {
    text-align: center;
    height: 130px;
    padding: 50px;
    margin-bottom: 20px;
  }
  .btn-auth {
    color: #fff;
    font-weight: 500;
    min-width: 150px;
    padding: 5px 25px;
    margin: 0 10px 10px;
    border-radius: 5px;
    background: #1e1e1e;
  }
  
  .copyright {
    font-weight: 400;
    margin-bottom: 20px;
    h4 {
      margin-bottom: 10px;
    }
  }
  .socials {
    display: flex;
    justify-content: flex-end;
    list-style-type: none;
    margin-bottom: 20px;
    li {
      .fab {
        box-shadow: none;
      }
      margin-right: 10px;
      span.fab {
        font-size: 1.75em;
        color: #1e1e1e;
      }
    }
  }
</style>
