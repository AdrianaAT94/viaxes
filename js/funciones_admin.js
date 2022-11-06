$( document ).ready(function() {
  $('.img_menu_movil img').click(function() {f
      if ($('.contenido_menu_movil').is(':hidden')) {
        $('.contenido_menu_movil').show();
        $('.menu_movil').css('background-color', 'rgba(0, 0, 0, 0.9)');
      }
      else {
        $('.contenido_menu_movil').hide();
        $('.menu_movil').css('background', 'none');
      }
    });

    $('.contenido_menu_movil ul li a').click(function() {
      $('.contenido_menu_movil').hide();
      $('.menu_movil').css('background', 'none');
    });
});

jQuery(document).ready(function () {
$( ".chofers_admin" )
  .mouseenter(function() {
  	$( ".chofers_admin" ).css({
  		"background": "url(./images/iconos_areaprivada/ap_flechaAM.png)",
		"background-repeat": "no-repeat",
		"background-position": "95% 50%"
  	});
    if ($('.lista_subopcions_chofer').css("display") == "none") { 
      $('.lista_subopcions_camion').hide();
      $('.lista_subopcions_cliente').hide();
            $('.lista_subopcions_chofer').fadeToggle('slow');  
        }
  })
  .mouseleave(function() {
  	$( ".chofers_admin" ).css("background", "none");
    $('.lista_subopcions_chofer').fadeOut('slow'); 
  });

$( ".clientes_admin" )
  .mouseenter(function() {
    $( ".clientes_admin" ).css({
      "background": "url(./images/iconos_areaprivada/ap_flechaAM.png)",
    "background-repeat": "no-repeat",
    "background-position": "95% 50%"
    });
    if ($('.lista_subopcions_cliente').css("display") == "none") { 
      $('.lista_subopcions_camion').hide();
      $('.lista_subopcions_chofer').hide();
            $('.lista_subopcions_cliente').fadeToggle('slow');  
        }
  })
  .mouseleave(function() {
    $( ".clientes_admin" ).css("background", "none");
    $('.lista_subopcions_cliente').fadeOut('slow'); 
  });

  $( ".camiones_admin" )
  .mouseenter(function() {
    $( ".camiones_admin" ).css({
      "background": "url(./images/iconos_areaprivada/ap_flechaAM.png)",
    "background-repeat": "no-repeat",
    "background-position": "95% 50%"
    });
    if ($('.lista_subopcions_camion').css("display") == "none") { 
      $('.lista_subopcions_chofer').hide();
      $('.lista_subopcions_cliente').hide();
            $('.lista_subopcions_camion').fadeToggle('slow');  
        }
  })
  .mouseleave(function() {
    $( ".camiones_admin" ).css("background", "none");
    $('.lista_subopcions_camion').fadeOut('slow'); 
  });

$( ".clave_user" )
  .mouseenter(function() {
    $( ".clave_user" ).css({
      "background": "url(./images/iconos_areaprivada/ap_flechaAM.png)",
    "background-repeat": "no-repeat",
    "background-position": "95% 50%"
    });
  })
  .mouseleave(function() {
    $( ".clave_user" ).css("background", "none");
  });

  $( ".volver_admin" )
  .mouseenter(function() {
    $( ".volver_admin" ).css({
      "background": "url(../images/iconos_areaprivada/ap_flechaAM.png)",
    "background-repeat": "no-repeat",
    "background-position": "95% 50%"
    });
  })
  .mouseleave(function() {
    $( ".volver_admin" ).css("background", "none");
  })
  .click(function() {
    location.href = "../administracion.php";
  });

});
