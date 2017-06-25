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
		   		
    <!-- Mobile viewport optimized -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet">
  

    <script src="numeral.min.js"></script>
  
</head>
<body>

	<h2 align="center">Pedidos</h2>
    <hr>
    <div class="container">
      <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-6">
            <form>
                <label class="checkbox-inline"><input type="checkbox" id="Check1" value="1">Novos</label>  
                <label class="checkbox-inline"><input type="checkbox" id="Check2" value="2">Confirmados</label>
                <label class="checkbox-inline"><input type="checkbox" id="Check3" value="3">Separados</label>
                <label class="checkbox-inline"><input type="checkbox" id="Check4" value="4">Finalizados</label>
                <label class="checkbox-inline"><input type="checkbox" id="Check5" value="5">Arquivados</label>
            </form>
        </div>
        <div class="col-lg-2">
          <button type="button" class="btn btn-primary" id="buttonPd1">Ver Pedidos</button>
        </div>
        <div class="col-lg-2"></div>
      </div>
    </div>          
    <br>
    <hr>
    <div class="container">
      <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
          <div id="displayDataTable"></div>          
        </div>
        <div class="col-lg-1"></div>
      </div>
	</div>

 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Produtos do pedido</h4>
        </div>
        <div class="modal-body">
            <div id="displayModalProdutos"></div>
        </div>
        <div class="modal-footer">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">                    
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3" align="center">                    
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="buttonConfirm">Confirmar pedido</button>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3" align="center">                    
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="buttonClose">Fechar</button>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                </div>
            </div>
        </div>
      </div>
      
    </div>
  </div>

<!-- ========================================================================================  -->
  <div class="modal fade" id="produtoModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Produto</h4>
        </div>
        <div class="modal-body">
            <div id="displayModalSingle"></div>
         </div>
        <div class="modal-footer">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3"></div>
                <div class="col-lg-3 col-md-3 col-sm-3" align="center">                    
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="buttonPDConfirm">Confirmar produto</button>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3" align="center">                    
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="buttonPDClose">Fechar</button>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3"></div>
            </div>
        </div>
      </div>
      
    </div>
  </div> 
  
<!-- ========================================================================================  -->
  <div class="modal fade" id="ConfirmPedidoDialog" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" align="center">Confirmar o pedido ?</h4>
        </div>
        <div class="modal-body">
            <div id="ConfirmPedidoDialogNo" align="center"></div>       
       </div>
        <div class="modal-footer">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">                    
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3" align="center">                    
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="ConfirmPedidoDialogConfirmar">Sim</button>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3" align="center">                    
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="ConfirmPedidoDialogFechar">Não</button>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">                    
                </div>
            </div>
        </div>
      </div>
      
    </div>
  </div>       

<!-- ========================================================================================  -->
  <div class="modal fade" id="PedidosDelete" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" align="center">Deletar o pedido ?</h4>
        </div>
        <div class="modal-body">
            <div id="PedidoDeleteNo" align="center"></div>       
       </div>
        <div class="modal-footer">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">                    
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3" align="center">                    
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="PedidosDeleteConfirmar">Sim</button>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3" align="center">                    
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="PedidosDeleteFechar">Não</button>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">                    
                </div>
            </div>
        </div>
      </div>
      
    </div>
  </div>	

<!-- ========================================================================================  -->
  <div class="modal fade" id="PedidosImport" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" align="center">Importar o pedido ?</h4>
        </div>
        <div class="modal-body">
            <div id="PedidoImportNo" align="center"></div>       
       </div>
        <div class="modal-footer">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">                    
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3" align="center">                    
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="PedidosImportConfirmar">Sim</button>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3" align="center">                    
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="PedidosImportFechar">Não</button>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">                    
                </div>
            </div>
        </div>
      </div>
      
    </div>
  </div>	

                                
<br><br>
   
</body>

    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>


<script>
var ServerPath = "server.php";
    
$(document).ready(function() {
    
    $(document).on("click", "#buttonPd1", function(evt) {
        var statusNo = 0;
        var sts = 0;
    
        $('input[type="checkbox"]:checked').each(function() {
            sts = $(this).val(); 
            if (sts==1)      statusNo = statusNo + 1;
            else if (sts==2) statusNo = statusNo + 2;
            else if (sts==3) statusNo = statusNo + 4;
            else if (sts==4) statusNo = statusNo + 8;
            else if (sts==5) statusNo = statusNo + 16;
        });
     
        $.ajax({
            type        : "GET",
            dataType    : "html",
            url         : ServerPath,
            data        :{
                "TC":888,
                "status":statusNo,
            },
            success: function(data) {
//alert("data");
                displayTabPedidos (data);
            }
        }); 
		
        function displayTabPedidos(data) {
            $("#displayDataTable").html(data);
            $('#pedidoTable').DataTable( {
                "paging":   true,
                //"ordering": false,
                "order": [0, 'desc'],
                //"info":     false,
                //"scrollY":        '50vh',
                //"scrollCollapse": true,
                //"processing": true,
                //"serverSide": true,
                //"ajax": "scripts/ids-arrays.php",
                //"rowCallback": function( row, data ) {
                //    if ( $.inArray(data.DT_RowId, selected) !== -1 ) {
                //        $(row).addClass('selected');
                //    }
                //},
                //"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
            } );
        }      
    });
    
    $(document).on("click", "#pedidoTable td", function(evt)
    {
        var row_index = $(this).parent().index() + 2;
        var col = $(this).parent().children().index($(this));
        var pedidoId = $("#pedidoTable tr:eq("+row_index+") td:eq("+0+")").text(); 
       //alert('row'+row_index+' / col: '+col+' / pedido:'+pedidoId);
        
        if (col == 4) { // change status
alert ('mudar status ... ');        
        }
        if (col == 5) { //edit
            $.ajax({
                type        : "GET",
                dataType    : "html",
                url         : ServerPath,
                data        :{
                    "TC":889,
                    "pedidoId":pedidoId,		
                },
                success: function(data) {
                    displayPedidoDetalhe (data);
                }
            }); 
		
            function displayPedidoDetalhe(data) {
                $("#displayModalProdutos").html(data);
                $('#myModal').modal('show');
            }    
        }
        else if (col == 6) { // delete
            var msg = '<h4>No: '+pedidoId+'</h4>';        
            $("#PedidoDeleteNo").html(msg);
            $('#PedidosDelete').modal('show');
        }
//        else if (col == 7) { // import
//            var msg = '<h4>No: '+pedidoId+'</h4>';        
//            $("#PedidoImportNo").html(msg);
//            $('#PedidosImport').modal('show');
//        }

    });
    
    $(document).on("click", "#pedidoProdutos td", function(evt)
    {
        
        var row = $(this).parent().index();
        var col = $(this).parent().children().index($(this));
        var codigo = $("#pedidoProdutos tr:eq("+row+") td:eq("+1+")").text(); 
        var quantidade = $("#pedidoProdutos tr:eq("+row+") td:eq("+2+")").text(); 
        var idNo = $("#pedidoProdutos tr:eq("+row+") td:eq("+7+")").text(); 

//alert('codigo: '+codigo+' / quant: '+quantidade+ ' / idNo: '+idNo);
        
        if (col == 5) { //edit
            $.ajax({
                type: "GET",
                dataType  : "html",
                url: ServerPath,
                data:{
                    "TC":890,
                    "codigo":codigo,
                    "quantidade":quantidade,
                    "idNo":idNo,
                },
                success: function(data) {
                    displayPedidoDetalhe (data);
                }
            }); 
		
            function displayPedidoDetalhe(data) {
                $("#displayModalSingle").html(data);
                //$('#myModal').modal('hide');
                $('#produtoModal').modal('show');
            }    
            
            
        }
        else if (col == 6) { //delete
            alert('delete');
        }
        
    });
    
    $(document).on("change", "#quantidade", function(evt)
    {
        var quant = $( "#quantidade" ).val();
        var valor = $( "#valor" ).text();
        var valorSub = valor.substring(3);          
        var valorInt = parseFloat(valorSub);
        var valorTotal = quant * valorInt;
        var valorForm = "R$ "+valorTotal.toFixed(2); 

        $( "#valorTotal" ).text(valorForm);
        
    });
    
    $(document).on("click", "#buttonConfirm", function(evt)
    {
        var id  = $( "#PedidoNo889" ).text();
        var msg = '<h4 id="pedidoNoTmp">'+id+'</h4>';        
        $("#ConfirmPedidoDialogNo").html(msg);
        $('#ConfirmPedidoDialog').modal('show');
    });

    $(document).on("click", "#buttonPDConfirm", function(evt)
    {
        var quantidade = $( "#quantidade" ).val();
    var ref = $( "#referencia" ).text();
    var refSub = ref.substring(8);          
    var refInt = parseFloat(refSub);
        
        
        var pedidoId   = $( "#idNo" ).text();
        var pedidoIdInt = parseFloat(pedidoId);

//alert ('buttonPDConfirm...'+'/ quant: '+quantidade+' / ref: '+refInt+' / pedido: '+pedidoIdInt);
        // 1. update data
        $.ajax({
            type        : "GET",
            dataType    : "html",
            url         : ServerPath,
            data        :{
                "TC":892,
                "pedidoId":pedidoIdInt,		
                "quantidade":quantidade,		
                "referencia":refInt,		
            },
            success: function(data) {
                //alert(data);
                displayUpdatePedido (data);
            }
        }); 
		
        function displayUpdatePedido(data) {
        
            // 2. refresh table 
            $.ajax({
                type        : "GET",
                dataType    : "html",
                url         : ServerPath,
                data        :{
                    "TC":889,
                    "pedidoId":pedidoIdInt,		
                },
                success: function(data) {
                    displayPedidoDetalhe (data);
                }
            }); 
		  
            function displayPedidoDetalhe(data) {
                $("#displayModalProdutos").html(data);
                $('#myModal').modal('show');
            }     
        }         
            
    });

    $(document).on("click", "#ConfirmPedidoDialogConfirmar", function(evt)
    {
        
        {
        var valorTotal= '0';
        var out ='';
        var xml1 ='';
        var xml2 ='';
        var revendedorId = 0; 
        var valorTotalPedido = 0;
        var valorTotalProduct = 0;    
        var valorQuantProduct = 0;    
        var valorTotalPedidoXML = 0;
        var valorTotalPedidoXMLFormat = 0;
      
        var pedidoData=0;   
        var pedidosNumber = 0;
        var pedidosArray = [];
        var indexXML = 0;
        var vlr_brutoXML = 0;
        var vlr_brutoXMLFormat = 0;
        var vlr_totalXML = 0;
        var vlr_totalXMLFormat = 0;
        var quantidadeXML = 0;
        var quantidadeXMLFormat = 0;
        
        var codPrevenda = 0;  // from database ..
        var codPrevendaXML = 0;  
        var codPrevendaXMLFormat = 0;  
  
        var vlr_pedidoXML = 0;
        var vlr_pedidoXMLFormat = 0;
        
        var a = $( "#pedidoNoTmp" ).html();        
        var as = a.substr(4); 
          
        var bnum = as.trim();
        var pedidoNum = parseInt(bnum);
        }
     
        $.ajax({
            type        : "GET",
            dataType    : "json",
            url         : ServerPath,
            data        :{
                "TC":896,
                "pedidoId":pedidoNum,		
            },
            success: function(data) {
                displayPedidoDetalheConfirm (data);
            }
        }); /* 896 get produtos array */

        function displayPedidoDetalheConfirm(data) {
            pedidosArray=data;
            pedidosNumber = pedidosArray.length;
            //    alert(pedidosArray);

            $.ajax({
                type        : "GET",
                dataType    : "html",
                url         : ServerPath,
                data        :{
                    "TC":893,
                },
                success: function(data) {
                    displayCodigoPrevenda (data);
                }
            }); /* get COD_REVENDA from database ..*/
        
            function displayCodigoPrevenda(data) {
                codPrevenda = data;
                        
  //      function displayUpdateCodigoPrevenda(data) {
{
        
                var timestamp = Date();  // get current datetime ..
        
                var d = new Date();
                var curr_date = d.getDate();
                var curr_month = d.getMonth()+1;
                var curr_year = d.getFullYear();
                var c_date = numeral(curr_date);
                var c_dateFormat = c_date.format('00');
                var c_month = numeral(curr_month);
                var c_monthFormat = c_month.format('00');
                var c_year = numeral(curr_year);
                var c_yearFormat = c_year.format('00');      
                var currentDateFormat= c_yearFormat+c_monthFormat+c_dateFormat;
        
                var itemsSequence = 0;
                var productId = 0;
                var quantidade = 0;   // 9.999
                var productPrice = 0; // 9.9999999
                var priceTotal = 0;   // 9.9999999
        
                var quant = numeral(quantidade);
                var quantidadeFormat = quant.format('0.000');
    
{
                xml2 = '';
                xml2 +='<\?xml version=="1.0" encoding="UTF-8" standalone="yes"\?> ';
                xml2 +='<DATAPACKET Version="2.0"> ';
                xml2 +='<METADATA> ';
            
                xml2 +='<FIELDS> ';
                xml2 +='<FIELD attrname="COD_PREVENDA" fieldtype="fixed" WIDTH="8"/> ';
                xml2 +='<FIELD attrname="SEQ_ITEM" fieldtype="fixed" WIDTH="8"/> ';
                xml2 +='<FIELD attrname="COD_ITEM" fieldtype="fixed" WIDTH="8"/> ';
                xml2 +='<FIELD attrname="QTD_ITEM" fieldtype="fixed" DECIMALS="3" WIDTH="13"/> ';
                xml2 +='<FIELD attrname="SIG_UNIDADE" fieldtype="string" WIDTH="5"/> ';
                xml2 +='<FIELD attrname="VLR_BRUTO" fieldtype="fixedFMT" DECIMALS="7" WIDTH="14"/> ';
                xml2 +='<FIELD attrname="POR_DESCONTO" fieldtype="fixed" DECIMALS="2" WIDTH="10"/> ';
                xml2 +='<FIELD attrname="VLR_DESCONTO" fieldtype="fixedFMT" DECIMALS="7" WIDTH="14"/> ';
                xml2 +='<FIELD attrname="VLR_UNITARIO" fieldtype="fixedFMT" DECIMALS="7" WIDTH="14"/> ';
                xml2 +='<FIELD attrname="VLR_TOTAL" fieldtype="fixedFMT" DECIMALS="7" WIDTH="14"/> ';
                xml2 +='</FIELDS> ';
                xml2 +='<PARAMS LCID="0"/> ';
                xml2 +='</METADATA> ';
                xml2 +='<ROWDATA> ';
        
                var revendedorXML = 0;
 
                for (i2 = 0; i2 < pedidosNumber; i2++)
                {
                    indexXML = indexXML+1;
        
                    vlr_brutoXML = numeral(pedidosArray[i2][1]);
                    vlr_brutoXMLFormat = vlr_brutoXML.format('0.0000000');
                    vlr_totalXML = numeral(pedidosArray[i2][2]);
                    valorTotalProduct = pedidosArray[i2][1];
                    vlr_totalXMLFormat = vlr_totalXML.format('0.0000000');
                    quantidadeXML = numeral(pedidosArray[i2][3]);
                    valorQuantProduct = pedidosArray[i2][3];
                    quantidadeXMLFormat = quantidadeXML.format('0.000');
                    codPrevendaXML = numeral(codPrevenda);
                    codPrevendaXMLFormat = codPrevendaXML.format('0');
                    revendedorXML = pedidosArray[i2][4];
                    
                    xml2 +='<ROW COD_PREVENDA="'+codPrevendaXMLFormat+'" ';
                    xml2 +='SEQ_ITEM="'+indexXML+'" ';
                    xml2 +='COD_ITEM="'+pedidosArray[i2][0]+'" ';
                    xml2 +='QTD_ITEM="'+quantidadeXMLFormat+'" ';
                    xml2 +='SIG_UNIDADE="UN" ';
                    xml2 +='VLR_BRUTO="'+vlr_brutoXMLFormat+'" ';
                    xml2 +='POR_DESCONTO="0.00" ';
                    xml2 +='VLR_DESCONTO="0.0000000" ';
                    xml2 +='VLR_UNITARIO="'+vlr_brutoXMLFormat+'" ';
                    xml2 +='VLR_TOTAL="'+vlr_totalXMLFormat+'"/>';
                    
                    valorTotalPedido = valorTotalPedido + valorTotalProduct*valorQuantProduct;
                    valorTotalPedidoXML = numeral(valorTotalPedido);
                    valorTotalPedidoXMLFormat = valorTotalPedidoXML.format('0.00');
                }
    
                xml2 +='</ROWDATA>';
                xml2 +='';
                xml2 +='</DATAPACKET>';
}  // define XML file #2 ..
           
{
                vlr_pedidoXML = numeral(vlr_pedidoXML);
                vlr_pedidoXMLFormat = vlr_pedidoXML.format('0.0000000');
            
                xml1 +='<\?xml version=="1.0" encoding="UTF-8" standalone="yes"\?>';
                xml1 +='<DATAPACKET Version="2.0">';
                xml1 +='<METADATA>';
                
                xml1 +='<FIELDS>';
                xml1 +='<FIELD attrname="COD_PREVENDA"           fieldtype="fixed" WIDTH="8"/>';
                xml1 +='<FIELD attrname="DAT_PREVENDA"           fieldtype="SQLdateTime"/>';
                xml1 +='<FIELD attrname="COD_TIPOPEDIDO"         fieldtype="fixed" WIDTH="4"/>';
                xml1 +='<FIELD attrname="COD_CENTROCUSTO"        fieldtype="fixed" WIDTH="9"/>';
                xml1 +='<FIELD attrname="COD_CLIENTE"            fieldtype="fixedFMT" WIDTH="15"/>';
                xml1 +='<FIELD attrname="COD_VENDEDOR"           fieldtype="fixed" WIDTH="8"/>';
                xml1 +='<FIELD attrname="COD_CONDICAOPAGTO"      fieldtype="fixed" WIDTH="3"/>';
                xml1 +='<FIELD attrname="COD_FORMAPAGTO"         fieldtype="fixed" WIDTH="3"/>';
                xml1 +='<FIELD attrname="VLR_TOTALPEDIDO"        fieldtype="fixed" DECIMALS="2" WIDTH="13"/>';
                xml1 +='<FIELD attrname="OPC_PREVENDAAUTORIZADA" fieldtype="string" WIDTH="1"/>';
                xml1 +='<FIELD attrname="DAT_PREVENDAAUTORIZADA" fieldtype="SQLdateTime"/>';
                xml1 +='<FIELD attrname="OBS_PREVENDAAUTORIZADA" fieldtype="string" WIDTH="128"/>';
                xml1 +='</FIELDS> ';
                xml1 +='<PARAMS LCID="0"/> ';
                xml1 +='</METADATA> ';
                xml1 +='<ROWDATA> ';
                xml1 +='<ROW COD_PREVENDA="'+codPrevendaXMLFormat+'" ';
                xml1 +='DAT_PREVENDA="'+currentDateFormat+'" ';
                xml1 +='COD_TIPOPEDIDO="1" ';
                xml1 +='COD_CENTROCUSTO="10900400." ';
                xml1 +='COD_CLIENTE="1." ';
                xml1 +='COD_VENDEDOR="'+revendedorXML+'" ';      
                xml1 +='COD_CONDICAOPAGTO="10." ';
                xml1 +='COD_FORMAPAGTO="1." ';
                xml1 +='VLR_TOTALPEDIDO="'+valorTotalPedidoXMLFormat+'" ';
                xml1 +='OPC_PREVENDAAUTORIZADA="S" ';
                xml1 +='DAT_PREVENDAAUTORIZADA="'+currentDateFormat+'" ';
                xml1 +='OBS_PREVENDAAUTORIZADA="AUTORIZADO"/>';
                xml1 +='</ROWDATA> ';
                xml1 +='</DATAPACKET> ';
}  // define XML file #1 ..
        
//alert ('SendXMLfiles .., codPrevend: '+codPrevenda+' Pedido: '+pedidoNum);
                $.ajax({
                    type        : "GET",
                    dataType    : "html",
                    url         : ServerPath,
                    data        :{
                        "TC":895,
                        "cod_prevenda":codPrevenda,		
                        "xml1":xml1,		
                        "xml2":xml2,	
                        "pedidoNum":pedidoNum,	
                    },
                    success: function(data) {
                        displaySendXMLFiles (data);
                    }
                });   /* 895 create XML-files .. */
            
                function displaySendXMLFiles(data) {
                    //alert(data);
                    ;
                }
}
            } /* end function displayCodigoPrevenda() */
        } /* end function displayPedidoDetalheConfirm() */
    });   
    
    
    $(document).on("click", "#PedidosDeleteConfirmar", function(evt)
    {
        //alert('confirm delete pedido ..');
        var pedidoId  = $( "#PedidoDeleteNo" ).text();
        var pedidoIdSub = pedidoId.substring(4);          
        var pedidoIdInt = parseFloat(pedidoIdSub);
        
        $.ajax({
                type        : "GET",
                dataType    : "html",
                url         : ServerPath,
                data        :{
                    "TC":891,
                    "pedidoId":pedidoIdInt,		
                },
                success: function(data) {
                    displayConfirmDeletePedido (data);
                }
        }); 
		
        function displayConfirmDeletePedido(data) {
            
            var statusNo = 0;
            var sts = 0;
    
            $('input[type="checkbox"]:checked').each(function() {
                sts = $(this).val(); 
                if (sts==1)      statusNo = statusNo + 1;
                else if (sts==2) statusNo = statusNo + 2;
                else if (sts==3) statusNo = statusNo + 4;
                else if (sts==4) statusNo = statusNo + 8;
            });
     
            $.ajax({
                type        : "GET",
                dataType    : "html",
                url         : ServerPath,
                data        :{
                    "TC":888,
                    "status":statusNo,
                },
                success: function(data) {
                    displayTabPedidos (data);
                }
            }); 
		
            function displayTabPedidos(data) {
                $("#displayDataTable").html(data);
                $('#pedidoTable').DataTable( {
                    "paging":   true,
                    //"ordering": false,
                    "order": [0, 'desc'],
                } );
            }      

        } 

        // delete pedidoId from 'pedido' 
    });   

    function JSDump(data) {
        var xout = '';
        for (var ii in data) {
            xout += data[ii]; 
        }
        alert(xout);           
    }    
    
} );

</script>	

	
</html>