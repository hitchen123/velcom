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
    if ($('.slider__item').hasClass('not_hidden')){
      $('.slider__item.not_hidden').removeClass('not_hidden').addClass('hidden');
    }
    ga('vbankingby.send', 'event', 'nav', 'scroll-advantage');
  });

  new WOW().init();

  $('.download_wr a').on('click', function(){
    var target = $(this).data('target');
    console.log(target)
    // ga('vbankingby.send', 'event', 'nav', 'go-market', target);
  });
  

  $('.v-banking').on('click', function(){
    ga('vbankingby.send', 'event', 'nav', 'go-about');
  });

  $('.link_wr a').on('click', function(){
    var id = $(this).data('id');
    console.log(id)
    ga('vbankingby.send', 'event', 'nav', 'go-rules', id);
  });

  $('a.slider__item').on('click', function(e){
    e.preventDefault();
    if ($(this).hasClass('hidden')){
      $(this).removeClass('hidden').addClass('not_hidden');
      var id = $(this).data('id');
      ga('vbankingby.send', 'event', 'nav', 'click-advantage', id);
    }
    else{
      $(this).addClass('hidden').removeClass('not_hidden');
    }
  })

  function widthing() {
    var width3 = $('.bloger_wr.bloger_plus').width();
    var width1 = $('.bloger_wr:not(.bloger_plus)').width();
    var height1= $('.bloger_wr:not(.bloger_plus)').height();
    var height3 = "auto";
    if ($(window).width() < 700) {
        height3 = "auto"
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

  	// $('.bloger_wr').removeClass('bloger_plus')

    // if ($(window).width()>= 768) {
      if ($(this).hasClass('bloger_plus'))
      {
        console.log('heh')    
      } 
      else{
        ga('vbankingby.send', 'event', 'nav', 'click-blogger', id);
      	$('.bloger_plus .bloger__photo-cut').addClass('photo_anim');
        $('.bloger_wr').removeClass('bloger_plus');
        widthing();

        $(this).addClass('bloger_plus');
        var width2 = $('.bloger_wr.bloger_plus').width();
        height2 = "auto";

        $(this).children('.blog_wr2').height(height2).width(width2)
      } 
  	  		
  });

  $(document).on('click', '.blog_link', function(e){
  	var id = $(this).closest('.bloger_wr').data('id');
    ga('vbankingby.send', 'event', 'nav', 'go-blogger-profile', id);
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
      TweenLite.fromTo(box.node, 0.5, { x: x, y: y }, { x: 0, y: 0, ease: ease }); 
      box.y = lastY;
      // TweenLite.to($('.bloger_wr.bloger_plus'), 1,  {width:'100%'});   
    } 
  }

});