<!DOCTYPE html>
<html lang="pt-br">
  <head>
     <title>Mobile Element Testing</title>
	
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
		   		
    	
<style>
.main:before {
	width:100%;
	height:100%;
	position:absolute;
	top:0px;
	left:0px;
	z-index:-1;
	content:'';
	background:-webkit-radial-gradient(30%, rgba(255,255,255,0.15), rgba(0,0,0,0)), url('img/body-bg.png');
	background:-moz-radial-gradient(30%, rgba(255,255,255,0.15), rgba(0,0,0,0)), url('img/body-bg.png');
	background:-o-radial-gradient(30%, rgba(255,255,255,0.15), rgba(0,0,0,0)), url('img/body-bg.png');
	background:radial-gradient(30%, rgba(255,255,255,0.15), rgba(0,0,0,0)), url('img/body-bg.png');
}

.site-header-wrap {
	margin-bottom:60px;
	border-bottom:1px solid #cd9ad6;
}


/*----- Accordion -----*/
.accordion, .accordion * {
	-webkit-box-sizing:border-box; 
	-moz-box-sizing:border-box; 
	box-sizing:border-box;
}

.accordion {
	overflow:hidden;
	box-shadow:0px 1px 3px rgba(0,0,0,0.25);
	border-radius:3px;
	background:#f7f7f7;
}

/*----- Section Titles -----*/
.accordion-section-title {
	width:100%;
	padding:0px;
	display:inline-block;
	border-bottom:1px solid #1a1a1a;
	background:#333;
	transition:all linear 0.15s;
	/* Type */
	font-size:1.200em;
	text-shadow:0px 1px 0px #1a1a1a;
	color:#fff;
}

.accordion-section-title.active, .accordion-section-title:hover {
	background:#4c4c4c;
	/* Type */
	text-decoration:none;
    color:#E0E0E0;
}

.accordion-section:last-child .accordion-section-title {
	border-bottom:none;
}

/*----- Section Content -----*/
.accordion-section-content {
	padding:0px;
	display:none;
}


#accord1, #accord2 
{
	padding-top: 5px;
	padding-bottom: 5px;
}

</style>

</head>
<body>
 
  <h1 align="center">Test snippets </h1>

  <hr>
  <br><br>


<div class="container">
  <div class="row">
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
        <button type="button" class="btn btn-primary" id="buttonLoadAcc">Load accordeon</button>
        <br><br>
    	<div class="main">
    		<div class="accordion">
    			<div class="accordion-section">
    				<a class="accordion-section-title" id="accord1" href="#accordion-1">Mairibel</a>
    				<div id="accordion-1" class="accordion-section-content">
    				  <div id="acc1"></div>
    				</div>
    			</div>
    			<div class="accordion-section">
    				<a class="accordion-section-title" id="accord2" href="#accordion-2">Hidratycollor</a>
    				<div id="accordion-2" class="accordion-section-content">
    				  <div id="acc2"></div>
    				</div>
    			</div>
    		</div>
    	</div>
	
        <br>	
          <form class="well">
            <div class="form-group">
			  <input type="text" id="inpCodigo" placeholder="código produto">
			</div>
            <div class="form-group">
              <button type="button" class="btn btn-primary" id="btnCodigoProduto">Código produto</button>
			</div>
		  </form>		
          <div id="ProdutoDetail"  style="border:1px solid #999999;"></div>

		
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
  </div>
</div>

 

<hr>
<div class="row">
  <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
    <div id="testField"></div>
  </div>
  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
    <div id="testProdutoDetail"></div>
	
	
  </div>
  <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
</div>
<hr>

<!-- ============================================================================= -->
    <br><br>
    <hr>
    <div class="container">
      <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
          <button type="button" class="btn btn-primary" id="buttonTest1">Clientes</button>
          <div id="displayTab1"></div>
    	</div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
          <button type="button" class="btn btn-primary" id="buttonTest2">Categorias</button>
          <div id="displayTab2"></div>
    	</div>    
    	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
          <button type="button" class="btn btn-primary" id="buttonTest3">Revendedores</button>
          <div id="displayTab3"></div>
    	</div>	
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>
      </div>
    </div>
   
<!-- ============================================================================= -->
    <br>
    <hr>
	<h2 align="center">Clientes</h2>
    <div class="container">
      <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
          <button type="button" class="btn btn-primary" id="buttonCl1">Ver Clientes</button>
          <div id="displayTabCl1"></div>
    	</div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
		
          <form class="well">
            <div class="form-group">
              <input type="text" id="inpClNome" placeholder="nome" class="form-control">
            </div>
            <div class="form-group">
              <input type="text" id="inpClTelefone" placeholder="telefone"  class="form-control">
            </div>
            <div class="form-group">
              <input type="text" id="inpClCEP" placeholder="CEP"  class="form-control">
            </div>
            <div class="form-group">
              <input type="text" id="inpClCidade" placeholder="cidade"  class="form-control">
            </div>
            <div class="form-group">
              <input type="text" id="inpClCNPJ" placeholder="CNPJ"  class="form-control">
            </div>
            <div class="form-group">
        	    <textarea class="form-control" rows="5" id="inpClDescr" placeholder="descrição"></textarea>
            </div>
            <button type="button" class="btn btn-primary" id="buttonCl2">Cadastrar Cliente</button>
          </form>		
        	
	
          <div id="displayTabCl2"></div>
    	</div>    	
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
      </div>
    </div>

<!-- ============================================================================= -->
    <br><br>
    <hr>
	<h2 align="center">Pedidos</h2>
    <div class="container">
      <div class="row">
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
          <button type="button" class="btn btn-primary" id="buttonPd1">Ver Pedidos</button>
          <div id="displayTabPd1x"></div>
    	</div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
		
          <form class="well">
            <div class="form-group">
              <input type="text" id="inpCliente" placeholder="cliente" class="form-control">
            </div>
            <div class="form-group">
              <input type="text" id="inpRevendedor" placeholder="revendedor"  class="form-control">
            </div>
            <div class="form-group">
              <input type="text" id="inpProdutoNome" placeholder="produto nome"  class="form-control">
            </div>
            <div class="form-group">
              <input type="text" id="inpProdutoPreco" placeholder="produto preco"  class="form-control">
            </div>
            <div class="form-group">
              <input type="text" id="inpProdutoQuantidade" placeholder="produto quantidade"  class="form-control">
            </div>
            <div class="form-group">
              <input type="text" id="inpStatus" placeholder="status"  class="form-control">
            </div>
                  <button type="button" class="btn btn-primary" id="buttonPd2">Cadastrar Pedido</button>
          </form>		
		
          <div id="displayTabPd2x"></div>
    	</div>    
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
      </div>
    </div>
<hr>
    <div class="container">
      <div class="row">
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
          <div id="displayTabPd1"></div>
    	</div>    
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
      </div>
    </div>


	
<br><br>
   
</body>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
<script>
$(document).ready(function() {
//    var urlServer = "http://localhost/Mairibel/server.php";
    var urlServer = "http://mairibel.com.br/novo/app/server.php";
    
    
	
    $(document).on("click", "#accTable1 td", function(evt)
    {
      var row_index = $(this).parent().index();
	  var col_index = $("#accTable1").find('tr')[0].cells.length - 1;  // get number of columns in table ;

      var idNo=$("#accTable1 tr:eq("+row_index+") td:eq("+col_index+")").html(); // value of last column of selected row ..  
//alert(idNo);
	  
      $.ajax({
          type: "GET",
          dataType  : 'html',
          url: urlServer,
          data:{
              "TC":999109,
              "idNo":idNo,		
          },
          success: function(data) {
              callProductsPerCategory (data);
          }
      }); 
      
      function callProductsPerCategory(data) {
        $("#testField").html(data);
      //activate_page("#");   
      }         
	  
	  
    });
	
    $(document).on("click", "#accTable2 td", function(evt)
    {
      var row_index = $(this).parent().index();
	  var col_index = $("#accTable2").find('tr')[0].cells.length - 1;  // get number of columns in table ;

      var idNo=$("#accTable2 tr:eq("+row_index+") td:eq("+col_index+")").html(); // value of last column of selected row ..
      //alert(idNo);
	  
      $.ajax({
          type: "GET",
          dataType  : 'html',
          url: urlServer,
          data:{
              "TC":999110,
              "idNo":idNo,		
          },
          success: function(data) {
              callProductsPerCategory (data);
          }
      }); 
      
      function callProductsPerCategory(data) {
        $("#testField").html(data);
      //activate_page("#");   
      }         
 
    });
	
	
    $(document).on("click", "#selectedMBCategory td", function(evt)
    {
      var row_index = $(this).parent().index();
	  var col_index = $("#selectedMBCategory").find('tr')[0].cells.length - 1;  // get number of columns in table ;

      var idNo=$("#selectedMBCategory tr:eq("+row_index+") td:eq("+col_index+")").html(); // value of last column of selected row ..
//alert(idNo);
	  
      $.ajax({
          type: "GET",
          dataType  : 'html',
          url: urlServer,
          data:{
              "TC":999111,
              "idNo":idNo,		
          },
          success: function(data) {
              callProductsDetailMB (data);
          }
      }); 
      
      function callProductsDetailMB(data) {
        $("#testProdutoDetail").html(data);
      //activate_page("#");   
      }         

    });	
	
    $(document).on("click", "#selectedHCCategory td", function(evt)
    {
      var row_index = $(this).parent().index();
	  var col_index = $("#selectedHCCategory").find('tr')[0].cells.length - 1;  // get number of columns in table ;

      var idNo=$("#selectedHCCategory tr:eq("+row_index+") td:eq("+col_index+")").html(); // value of last column of selected row ..
//alert(idNo);
	  
      $.ajax({
          type: "GET",
          dataType  : 'html',
          url: urlServer,
          data:{
              "TC":999111,
              "idNo":idNo,		
          },
          success: function(data) {
              callProductsDetailHC (data);
          }
      }); 
      
      function callProductsDetailHC(data) {
        $("#testProdutoDetail").html(data);
      //activate_page("#");   
      }         

    });	
	
	/*-------------------------------------------------*/
    $(document).on("click", "#buttonLoadAcc", function(evt)
	{
        $.ajax({
            type: "GET",
            dataType  : 'html',
            url: urlServer,
            data:{
                "TC":999104
            },
            success: function(data) {
                displayAcc1 (data);
            }
        }); 
		
       function displayAcc1(data) {
	     $("#acc1").html(data);
       }         
		
        $.ajax({
            type: "GET",
            dataType  : 'html',
            url: urlServer,
            data:{
                "TC":999105
            },
            success: function(data) {
                displayAcc2 (data);
            }
        }); 
		
       function displayAcc2(data) {
	     $("#acc2").html(data);
       }         
		
    });
	
	function close_accordion_section() {
		jQuery('.accordion .accordion-section-title').removeClass('active');
		jQuery('.accordion .accordion-section-content').slideUp(300).removeClass('open');
	}

	jQuery('#accord1').click(function(e) {
		// Grab current anchor value
		var currentAttrValue = jQuery(this).attr('href');

		if(jQuery(e.target).is('.active')) {
			close_accordion_section();
		}else {
			close_accordion_section();
			// Add active class to section title
			jQuery(this).addClass('active');
			// Open up the hidden content panel
			jQuery('.accordion ' + currentAttrValue).slideDown(300).addClass('open'); 
		}
		e.preventDefault();
	});
	
	jQuery('#accord2').click(function(e) {
		// Grab current anchor value
		var currentAttrValue = jQuery(this).attr('href');

		if(jQuery(e.target).is('.active')) {
			close_accordion_section();
		}else {
			close_accordion_section();
			// Add active class to section title
			jQuery(this).addClass('active');
			// Open up the hidden content panel
			jQuery('.accordion ' + currentAttrValue).slideDown(300).addClass('open'); 
		}
		e.preventDefault();
	});
	

/*=========================================================*/	
    $(document).on("click", "#buttonTest1", function(evt)
    {
        $.ajax({
            type: "GET",
            dataType  : 'html',
            url: urlServer,
            data:{
                "TC":999101
            },
            success: function(data) {
                displayTabs (data);
            }
        }); 
		
       function displayTabs(data) {
	     $("#displayTab1").html(data);
       }         
	  
    });

	
    $(document).on("click", "#buttonTest2", function(evt)
    {  
        $.ajax({
            type: "GET",
            dataType  : 'html',
            url: urlServer,
            data:{
                "TC":999102
            },
            success: function(data) {
                displayTabs (data);
            }
        }); 
		
       function displayTabs(data) {
	     $("#displayTab2").html(data);
       }         
	  
    });

    $(document).on("click", "#buttonTest3", function(evt)
    {  
        $.ajax({
            type: "GET",
            dataType  : 'html',
            url: urlServer,
            data:{
                "TC":999103
            },
            success: function(data) {
                displayTabs (data);
            }
        }); 
		
       function displayTabs(data) {
	     $("#displayTab3").html(data);
       }         
	  
    });

	
    $(document).on("click", "#buttonCl1", function(evt)
    {  
	
        $.ajax({
            type: "GET",
            dataType  : 'html',
            url: urlServer,
            data:{
                "TC":999101
            },
            success: function(data) {
                displayTabs (data);
            }
        }); 
		
       function displayTabs(data) {
	     $("#displayTabCl1").html(data);
       }         
	
    });

    $(document).on("click", "#buttonCl2", function(evt)
    {  
	
        nome = $( "#inpClNome" ).val();
        fone = $( "#inpClTelefone" ).val();
        CEP = $( "#inpClCEP" ).val();
        cidade = $( "#inpClCidade" ).val();
        CNPJ = $( "#inpClCNPJ" ).val();
        descr = $( "#inpClDescr" ).val();
		
        $.ajax({
            type: "GET",
            dataType  : 'html',
            url: urlServer,
            data:{
                "TC":999113,
                "nome":nome,		
                "fone":fone,		
                "CEP":CEP,		
                "cidade":cidade,		
                "CNPJ":CNPJ,		
                "descr":descr,		
            },
            success: function(data) {
alert('cadastrar cliente');	
alert(data);
            }
        }); 
			
    });


    $(document).on("click", "#buttonPd1", function(evt)
    {
	
        $.ajax({
            type: "GET",
            dataType  : 'html',
            url: urlServer,
            data:{
                "TC":999112
            },
            success: function(data) {
                displayTabPedidos (data);
            }
        }); 
		
        function displayTabPedidos(data) {
	      $("#displayTabPd1").html(data);
        }         
    });
	
    $(document).on("click", "#buttonPd2", function(evt)
    {  
	/*
        $.ajax({
            type: "GET",
            dataType  : 'html',
            url: urlServer,
            data:{
                "TC":999103
            },
            success: function(data) {
                displayTabs (data);
            }
        }); 
		
       function displayTabs(data) {
	     $("#displayTab3").html(data);
       }         
	*/
alert('cadastrar pedido');	
    });

	
	
    $(document).on("click", "#btnCodigoProduto", function(evt)
    { 

        idNo = $( "#inpCodigo" ).val();
	
	
        $.ajax({
            type: "GET",
            dataType  : 'html',
            url: urlServer,
            data:{
                "TC":999111,
                "idNo":idNo,		
            },
            success: function(data) {
                displayProdutoDetail (data);
            }
        }); 
		
       function displayProdutoDetail(data) {
	     $("#ProdutoDetail").html(data);
       }         
	
	
    });
	
});






</script>	

	
</html>