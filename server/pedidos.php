<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Mobile Element Testing</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!--<link href="bootstrap.min.css" rel="stylesheet">-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

   <link rel="apple-touch-icon" sizes="180x180" href="favicons/apple-touch-icon.png">
   <link rel="icon" type="image/png" href="favicons/favicon-32x32.png" sizes="32x32">
   <link rel="icon" type="image/png" href="favicons/favicon-16x16.png" sizes="16x16">
   <link rel="manifest" href="favicons/manifest.json">
   <link rel="mask-icon" href="favicons/safari-pinned-tab.svg" color="#5bbad5">
 

</head>
<body>

	<h2 align="center">Pedidos</h2>
<!--	
    <div class="container">
      <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-6">
          <button type="button" class="btn btn-primary" id="buttonPd1">Ver Pedidos</button>
          <div id="displayTabPd1x"></div>
    	</div>
        <div class="col-lg-4">
		
          <form class="well">
		  <div class="row">
		    <div class="col-lg-6">
              <div class="form-group">
                <input type="text" id="inpRevendedor" placeholder="revendedor"  class="form-control">
              </div>			
			</div>
		    <div class="col-lg-6">
              <div class="form-group">
                <input type="text" id="inpProdutoNome" placeholder="produto nome"  class="form-control">
              </div>
			</div>
		  </div>
		  <div class="row">
		    <div class="col-lg-6">
              <div class="form-group">
                <input type="text" id="inpProdutoPreco" placeholder="produto preco"  class="form-control">
              </div>			
			</div>
		    <div class="col-lg-6">
              <div class="form-group">
                <input type="text" id="inpProdutoQuantidade" placeholder="produto quantidade"  class="form-control">
              </div>
			</div>
		  </div>
		  <div class="row">
		    <div class="col-lg-12">
              <div class="form-group">
        	    <textarea class="form-control" rows="5" id="inpClDescr" placeholder="observação"></textarea>
              </div>			
			</div>
		  </div>
		  <div class="row">
		    <div class="col-lg-6">
              <div class="form-group">
              <input type="text" id="inpStatus" placeholder="status"  class="form-control">
              </div>			
			</div>
		    <div class="col-lg-6">
              <button type="button" class="btn btn-primary" id="buttonPd2">Cadastrar Pedido</button>
			</div>
		  </div> 
           
          </form>		
		
          <div id="displayTabPd2x"></div>
    	</div>    
        <div class="col-lg-1"></div>
      </div>
    </div>
-->
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
	<hr>

    <div class="container">
      <div class="row">
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
         <div id="displayPedidosDetalhe"></div>
		</div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
      </div>
	</div>

    <div class="container">
      <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
          <button type="button" class="btn btn-primary" id="buttonPd1">Ver Pedidos</button>
		</div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
          <button type="button" class="btn btn-primary" id="btnImport">Importar</button>
		</div>    
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Open Modal</button>
		</div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
          <button type="button" class="btn btn-primary" id="btnCreateXML">Create XML</button>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
      </div>
    </div>
    <br><br>

	
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modal Header</h4>
          </div>
          <div class="modal-body">
            <div id="displayPedidosDetalhe"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

</body>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
//    var urlServer = "http://localhost/Mairibel/server.php";
    var urlServer = "http://mairibel.com.br/app/server.php";

			
$(document).ready(function() {
		
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
	
    $(document).on("click", "#pedidoTable td", function(evt)
    {
      var row_index = $(this).parent().index();
	  var col_index = $("#pedidoTable").find('tr')[0].cells.length - 1;  // get number of columns in table ;
	  
	  col_index=0;
      var pedidoId = $("#pedidoTable tr:eq("+row_index+") td:eq("+col_index+")").text(); 
	
	  // --> get 'produtos' for selected 'pedidoId' ...
	  if (pedidoId > 0){
		  
        $.ajax({
            type: "GET",
            dataType  : 'html',
            url: urlServer,
            data:{
                "TC":999114,
                "pedidoId":pedidoId,		
            },
            success: function(data) {
                displayPedidoDetalhe (data);
            }
        }); 
		
       function displayPedidoDetalhe(data) {
	     $("#displayPedidosDetalhe").html(data);
       }         
		  
	  }
	  
    });

    
		
    $(document).on("click", "#btnCreateXML", function(evt)
    {

        alert('create XML');
         
    });
    
});




</script>	

	
</html>