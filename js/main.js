$(document).ready(function(){
  var owl = $(".owl-carousel").owlCarousel({
  	items: 3,
  	responsiveClass:true,
  	loop: true,
  	dots: false,
  	// navContainer: true,
  	nav: true,
    responsive:{
        0:{
            items:1
        },
        700:{
            items:3
        }
    }
  });

  owl.on('changed.owl.carousel', function(event) {
    console.log('heh');
    $('.slider__item').removeClass('not_hidden').addClass('hidden');
  //   ga('vbankingby.send', 'event', 'nav', 'scroll-advantage',);
  });

  new WOW().init();

  // $('.download_wr a').on('click', function(){
  //   var target = $(this).data('target');
  //   console.log(target)
  //   ga('vbankingby.send', 'nav', 'go-market', target);
  // });
  

  // $('.v-banking').on('click', function(){
  //   ga('vbankingby.send', 'nav', 'go-about',);
  // });

  // $('.link_wr a').on('click', function(){
  //   var id = $(this).data('id');
  //   console.log(id)
  //   ga('vbankingby.send', 'nav', 'go-rules', id);
  // });

  // $('.slider__item').on('click', function(){
  //   var id = $(this).data('id');
  //   console.log(id)
  //   ga('vbankingby.send', 'nav', 'click-advantage', id);
  // });

  

  // ga('vbankingby.send', 'event', 'social', 'footer-email');

  $('.slider__item').on('click', function(e){
    e.preventDefault();
    if ($(this).hasClass('hidden')){
      $(this).removeClass('hidden').addClass('not_hidden');
    }
    else{
      $(this).addClass('hidden').removeClass('not_hidden');
    }
  })

  function widthing() {
    var width3 = $('.bloger_wr.bloger_plus').width();
    var height3= $('.bloger_wr.bloger_plus').height();
    var width1 = $('.bloger_wr:not(.bloger_plus)').width();
    var height1= $('.bloger_wr:not(.bloger_plus)').height();
    if ($(window).width() < 700) {
        // height3 = $('.bloger_plus .bloger__photo-cut').outerHeight() + $('.bloger_plus .bloger__profile_mob').outerHeight() + $('.bloger_plus .bloger__tips').outerHeight();
        height3 = "auto"
        // console.log(height3,$('.bloger_plus .bloger__photo-cut').outerHeight(), $('.bloger_plus .bloger__profile_mob').outerHeight(), $('.bloger_plus .bloger__tips').outerHeight())
        // $(this).css('transition', 'padding .5s ease');
      }
    $('.blog_wr2').height(height1).width(width1);
    $('.bloger_plus .blog_wr2').height(height3).width(width3)  
  }

  widthing();

  $(window).resize(widthing)
  // $(window).resize(function(){
  //   $('.bloger_wr').removeClass('bloger_plus');
  // })

  $('.bloger_wr').click(function(){

  	$('.bloger__photo-cut').removeClass('photo_anim');

    var id = $(this).data('id');
    console.log(id)
    // ga('vbankingby.send', 'nav', 'click-blogger', id);

  	// $('.bloger_wr').removeClass('bloger_plus')

    // if ($(window).width()>= 768) {
      if ($(this).hasClass('bloger_plus'))
      {
        console.log('heh')    
      } 
      else{
      	$('.bloger_plus .bloger__photo-cut').addClass('photo_anim');
        $('.bloger_wr').removeClass('bloger_plus');
        widthing();

        $(this).addClass('bloger_plus');
        var width2 = $('.bloger_wr.bloger_plus').width();
        var height2= $('.bloger_wr.bloger_plus').height();

        if ($(window).width() < 700) {
          height2 = $('.bloger_plus .bloger__photo-cut').outerHeight() + $('.bloger_plus .bloger__profile_mob').outerHeight() + $('.bloger_plus .bloger__tips').outerHeight()-50;
          // $(this).css('transition', 'padding .5s ease');
        }

        $(this).children('.blog_wr2').height(height2).width(width2)


      } 
    // }
    // else{
    //   // $('.blog_wr2').height('auto');
    //   $(this).addClass('bloger_plus');
    // }


  	  		
  });

  $(document).on('click','.bloger__close',function(e){
    if ($(window).width() < 700) {
      layout2();
    }    
    e.preventDefault();
    e.stopPropagation();
    $(this).closest('.bloger_wr').removeClass('bloger_plus');
    $(this).closest('.bloger_wr').find('.bloger__photo-cut').addClass('photo_anim');
    widthing();
    layout();
  })

  $(document).on('click', '.bloger_wr', function(){ 
    TweenLite.set(".blogers");
    TweenLite.set("footer");
    layout();
    // $(this).css('transition', 'width 1s') 
  });

  // $(document).on('click', '.b2', function(){  
  //   TweenLite.set(".daddy", { width: 110 });
  //   layout();
  // });

  var nodes = document.querySelectorAll(".bloger_wr, footer");
  var total = nodes.length;
  var ease  = Power1.easeInOut;
  var boxes = [];

  for (var i = 0; i < total; i++) {
      
    var node = nodes[i];
    
    // Initialize transforms on node
    TweenLite.set(node, { x: 0 });
     
    boxes[i] = {
      transform: node._gsTransform,
      x: node.offsetLeft,
      y: node.offsetTop,
      node: node
    };
  } 

  function layout() {
    
    for (var i = 0; i < total; i++) {
      
      var box = boxes[i];
          
      // Last offset position
      var lastX = box.x;
      var lastY = box.y;
      if (i == 5){
        console.log('item')
      console.log(box.y)
      }
      // Record new offset position
      box.x = box.node.offsetLeft;
      box.y = box.node.offsetTop;
      // Continue loop if box hasn't moved
      if (i == 5){
        console.log('item')
      console.log(box.y)
      }
      if (lastX === box.x && lastY === box.y) continue;

      
      // Reversed delta values taking into account current
      // transforms in case animation was interrupted
      var x = box.transform.x + lastX - box.x;
      var y = box.transform.y + lastY - box.y;  
      
      // Tween to 0,0 to remove the transforms
      TweenLite.fromTo(box.node, 1, { x: x, y: y }, { x: 0, y: 0, ease: ease }); 
      // TweenLite.to($('.bloger_wr.bloger_plus'), 1,  {width:'100%'});   
    } 
  }

  function layout2() {
    
    for (var i = 0; i < total; i++) {
      
      var box = boxes[i];
          
      // Last offset position
      var lastX = box.x;
      var lastY = box.y;
      if (i == 5){
        console.log('item close')
        console.log(box.y)
      }
      
      // Record new offset position
      box.x = box.node.offsetLeft;
      box.y = box.node.offsetTop;
      if (i == 5){
        console.log('item close')
        console.log(box.y)
      }
      // box.y = -box.y;
      // Continue loop if box hasn't moved
      if (lastX === box.x && lastY === box.y) continue;

      
      // Reversed delta values taking into account current
      // transforms in case animation was interrupted
      var x = box.transform.x + lastX - box.x;
      var y = box.transform.y - lastY + box.y;  
      
      // Tween to 0,0 to remove the transforms
      TweenLite.fromTo(box.node, 1, { x: x, y: y }, { x: 0, y: 0, ease: ease }); 
      box.y = lastY;
      // TweenLite.to($('.bloger_wr.bloger_plus'), 1,  {width:'100%'});   
    } 
  }

});