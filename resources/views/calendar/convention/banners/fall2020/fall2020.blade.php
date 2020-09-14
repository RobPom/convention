<style>


@import url('https://fonts.googleapis.com/css2?family=Oswald:wght@900&display=swap');

@import url('https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz:wght@400;700&display=swap" rel="stylesheet');

  /* Convention Banner */
  .glow {
    text-shadow: 0 0 8px #daffff;
  }

  .banner {
    font-family: 'Oswald', sans-serif;
    margin-bottom: 20px;
    background: url(/img/fall2020banner_bg.jpg) 40% center no-repeat ;
    box-shadow: inset 0px 0px 160px rgba(0, 0, 0, 1);
    background-size: cover;
    position: relative;
    color: white; 
  }

  .logo{
    font-size: 2rem;
    line-height: 2rem;
    font-weight: bold ;
    
  }

  .tagline{
    font-size: 1.4rem;
    font-family: 'Yanone Kaffeesatz', sans-serif;
  }

  .position {
    text-align: right;
    position: absolute;
    top: 30%;
    left: 5%;
  }
  
  .date{
    color: white;
    font-size: 1rem; 
  }
  
  .row {
    min-height: 140px;
  }

  .banner-content-wrap {
    padding-bottom: 3rem;    /* Footer height */ 
    }

.banner-footer { 
  position: absolute;
  bottom: 0;
  padding-right: 3rem;
  width: 100%;
  height: 3rem;            /* Footer height */
}


@media (min-width: 576px) {

  .logo{
    font-size: 1.6rem;
    line-height: 1.6rem;
    font-weight: bold ;

  }
  .tagline{
    font-size: 1.2rem;
  }
  .row {
    min-height: 200px;
  }
  .banner {
    background: url(/img/fall2020banner_bg.jpg) 60% right no-repeat ;
    box-shadow: inset 0px 0px 200px rgba(0, 0, 0, 1);
  }
  .position {
    text-align: right;
    position: absolute;
    top: 30%;
    right: 0%;
  }
  .date{
  
    font-size: 1rem; 
  }
 
 }






@media (min-width: 992px) { 
.logo{
    font-size: 3.4rem;
    line-height: 3.5rem;
    font-weight: bold ;
    letter-spacing:-1px;
  }
  .tagline{
    font-size: 2rem;
  }
  .row {
    min-height: 340px;
  }
  .banner {
    background: url(/img/fall2020banner_bg.jpg) 75% center no-repeat ;
    margin-bottom: 20px;
    box-shadow: inset 0px 0px 300px rgba(0, 0, 0, 1);
  }
  .position {
    text-align: right;
    position: absolute;
    top: 30%;
    right: 0%;
  }
  .date{
    font-size: 1.3rem; 
  }
 
 }


</style>


<div class="col-12 ">
  <div class="banner ">
    <div class='row'>
      <div class='col banner-content-wrap'>
        <div class="container">
          <div class="row ">
            <div class="col-sm-5 ">
              <div class="position">
                <div class="logo ">IntrigueCon 2020</div>
                <div class="tagline ">This time  . . .   it's virtual</div>
                <a href="/calendar/convention" class="btn btn-light btn-sm">Find Out More</a>
              </div>
            </div>
          </div>
          <div class="banner-footer">

              <span class="date">October 17th 2020</span>

          </div>
        </div>     
      </div> 
    </div>
  </div>
</div>

