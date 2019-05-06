$(window).scroll(function(){
	$('nav').toggleClass('scrolled', $(this).scrollTop() > 50);
});

console.log('asdasdasdasdasddasd');
$("#menu-toggle").click(function(e) {
  e.preventDefault();
  $("#wrapper").toggleClass("toggled");
  $('.close1').toggle();
});

$("#menu-toggle1").click(function(e) {
  e.preventDefault();
  $("#wrapper").toggleClass("toggled");
  $('.close1').toggle();
});

