@extends('layouts.app')
@section('content')

<section class="bg-gray-darker">
  <!-- Carousel -->
    <div id="carouselLocal" class="carousel slide carousel-fade" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active" data-interval="1000">
          <img src="https://cdn.computerhoy.com/sites/navi.axelspringer.es/public/styles/1200/public/media/image/2018/04/295717-que-es-malo-abusar-comida-rapida.png?itok=NWLAbya1" height="400" class="d-block w-100" alt="Imagen alimento">
        </div>
        <div class="carousel-item" data-interval="1000">
          <img src="https://sevilla.abc.es/gurme/wp-content/uploads/sites/24/2012/01/comida-rapida-casera.jpg" height="400" class="d-block w-100" alt="Hamburgesa">
        </div>
        <div class="carousel-item" data-interval="1000">
          <img src="https://i2.wp.com/tvmaulinos.com/wp-content/uploads/2016/03/comida-chatarra.jpg?fit=2833%2C1521" height="400" class="d-block w-100" alt="Bebida">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselLocal" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselLocal" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
</section>
<section class="section-50 section-sm-100" style="background: #791313 !important"> 
    <div class="container-wide">  
        <div class="row justify-content-xs-center">

                <div class="col-sm-6 col-md-4 view-animate zoomInSmall delay-04 active">
                    <a class="thumbnail-variant-3" href="menu-single.html">
                    <img class="img-responsive" src="https://static.iris.net.co/dinero/upload/images/2016/12/15/240194_1.jpg" alt="" width="566" height="401">
                    <div class="caption text-center">
                        <h3 class="text-italic">Título 1</h3>
                        <p class="big">Subtítulo 1</p>
                    </div></a>
                </div>

                <div class="col-sm-6 col-md-4 view-animate zoomInSmall delay-04 active">
                    <a class="thumbnail-variant-3" href="menu-single.html">
                    <img class="img-responsive" src="https://static.iris.net.co/dinero/upload/images/2016/12/15/240194_1.jpg" alt="" width="566" height="401">
                    <div class="caption text-center">
                        <h3 class="text-italic">Título 2</h3>
                        <p class="big">Subtítulo 2</p>
                    </div></a>
                </div>

                <div class="col-sm-6 col-md-4 view-animate zoomInSmall delay-04 active">
                    <a class="thumbnail-variant-3" href="menu-single.html">
                    <img class="img-responsive" src="https://static.iris.net.co/dinero/upload/images/2016/12/15/240194_1.jpg" alt="" width="566" height="401">
                    <div class="caption text-center">
                        <h3 class="text-italic">Título 3</h3>
                        <p class="big">Subtítulo 3</p>
                    </div></a>
                </div>

                <div class="slick-slider slick-tab-centered" data-arrows="true" data-loop="true" data-dots="false" data-swipe="true" data-items="1" data-xs-items="1" data-sm-items="2" data-md-items="3" data-lg-items="3" data-xl-items="5" data-center-mode="true" data-center-padding="10">
             

        </div>
      </div>
</section>
<section class="section-50 section-sm-top-80 section-sm-bottom-100 bg-gray-lighter">
        <h3 style="text-align:center">Nuestro Menú</h3>
        <div class="responsive-tabs responsive-tabs-button responsive-tabs-horizontal responsive-tabs-carousel offset-top-40" style="text-align:center">
          <ul class="resp-tabs-list">
              
                <li>Categoría 1</li>
                <li>Categoría 2</li>
                <li>Categoría 3</li>
              
          </ul>
          <div class="resp-tabs-container text-left">

           <div>
                <!-- Slick Carousel-->
                <div class="slick-slider slick-tab-centered" data-arrows="true" data-loop="true" data-dots="false" data-swipe="true" data-items="1" data-xs-items="1" data-sm-items="2" data-md-items="3" data-lg-items="3" data-xl-items="5" data-center-mode="true" data-center-padding="10">
                    

                            <div class="item">
                                <div class="thumbnail-menu-modern">
                                <figure><img class="img" src="https://sevilla.abc.es/gurme/wp-content/uploads/sites/24/2013/04/pizza-margarita-960x540.jpg" alt="" width="310" height="260"/>
                                </figure>
                                <div class="caption">
                                    <h5><a class="link link-default" href="menu-single.html">Título 1</a></h5>
                                    <p class="text-italic">Descripción 1</p>
                                    <p class="price">Precio 1</p>
                                   
                                        <a class="btn btn-shape-circle btn-burnt-sienna offset-top-15" href="#" style="padding: 5px 20px !important;">
                                          <span class="thin-icon-cart" style="font-size: 23px !important;"></span> Al carrito
                                    </a>
                                  
                                </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="thumbnail-menu-modern">
                                <figure><img class="img" src="https://sevilla.abc.es/gurme/wp-content/uploads/sites/24/2013/04/pizza-margarita-960x540.jpg" alt="" width="310" height="260"/>
                                </figure>
                                <div class="caption">
                                    <h5><a class="link link-default" href="menu-single.html">Título 2</a></h5>
                                    <p class="text-italic">Descripción 2</p>
                                    <p class="price">Precio 2</p>
                                   
                                        <a class="btn btn-shape-circle btn-burnt-sienna offset-top-15" href="#" style="padding: 5px 20px !important;">
                                          <span class="thin-icon-cart" style="font-size: 23px !important;"></span> Al carrito
                                    </a>
                                  
                                </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="thumbnail-menu-modern">
                                <figure><img class="img" src="https://sevilla.abc.es/gurme/wp-content/uploads/sites/24/2013/04/pizza-margarita-960x540.jpg" alt="" width="310" height="260"/>
                                </figure>
                                <div class="caption">
                                    <h5><a class="link link-default" href="menu-single.html">Título 3</a></h5>
                                    <p class="text-italic">Descripción 3</p>
                                    <p class="price">Precio 3</p>
                                   
                                        <a class="btn btn-shape-circle btn-burnt-sienna offset-top-15" href="#" style="padding: 5px 20px !important;">
                                          <span class="thin-icon-cart" style="font-size: 23px !important;"></span> Al carrito
                                    </a>
                                  
                                </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="thumbnail-menu-modern">
                                <figure><img class="img" src="https://sevilla.abc.es/gurme/wp-content/uploads/sites/24/2013/04/pizza-margarita-960x540.jpg" alt="" width="310" height="260"/>
                                </figure>
                                <div class="caption">
                                    <h5><a class="link link-default" href="menu-single.html">Título 4</a></h5>
                                    <p class="text-italic">Descripción 4</p>
                                    <p class="price">Precio 4</p>
                                   
                                        <a class="btn btn-shape-circle btn-burnt-sienna offset-top-15" href="#" style="padding: 5px 20px !important;">
                                          <span class="thin-icon-cart" style="font-size: 23px !important;"></span> Al carrito
                                    </a>
                                  
                                </div>
                                </div>
                            </div>
                        

                </div>
            </div>
        

          </div>
        </div>
      </section>

@endsection
