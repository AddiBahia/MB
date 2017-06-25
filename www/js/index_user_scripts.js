/*jshint browser:true */
/*global $ */(function()
{
 "use strict";
 /*
   hook up event handlers 
 */
 function register_event_handlers()
 {

    var ServerPath  = "http://mairibel.com.br/app/server.php";
    var EmailServer = "http://mairibel.com.br/app/mailer.php";
    var errorMsg    = "";
     
    var loggedIn    = 0;
   
     
    function showErrorModal(data) {
        $("#ModalError").html(data);
        $('#modalError').modal('show');     
    };
     

    // footer :                                                               
    //========= mainpage =========
    $(document).on("click", "#mainFooter1", function(evt) { activate_page("#");  return false; });
    $(document).on("click", "#mainFooter2", function(evt) { uib_sb.toggle_sidebar($("#LSMmainpage"));   return false;});
    $(document).on("click", "#mainFooter3", function(evt) { activate_page("#");  return false; });

    //========= login =========
    $(document).on("click", "#loginFooter1", function(evt) { activate_page("#mainpage"); return false; });
    $(document).on("click", "#loginFooter2", function(evt) { activate_page("#");         return false; });
    $(document).on("click", "#loginFooter3", function(evt) { activate_page("#mainpage"); return false; });
     
    //========= start =========
    $(document).on("click", "#startFooter1", function(evt) { activate_page("#login");    return false; });
    $(document).on("click", "#startFooter2", function(evt) { activate_page("#");         return false; });
    $(document).on("click", "#startFooter3", function(evt) { activate_page("#mainpage"); return false; });
     
    //========= contato =========
    $(document).on("click", "#contatoFooter1", function(evt) { activate_page("#mainpage"); return false; });
    $(document).on("click", "#contatoFooter2", function(evt) { activate_page("#");         return false; });
    $(document).on("click", "#contatoFooter3", function(evt) { activate_page("#mainpage"); return false; });
                
    //========= produtos =========
    $(document).on("click", "#produtosFooter1", function(evt) { activate_page("#fazerpedido"); return false; });
    $(document).on("click", "#produtosFooter2", function(evt) { activate_page("#");            return false; });
    $(document).on("click", "#produtosFooter3", function(evt) { activate_page("#mainpage");    return false; });
  
    //========= produtos detalhe =========
    $(document).on("click", "#produtoDetalheFooter1", function(evt) { activate_page("#produtos"); return false; });
    $(document).on("click", "#produtoDetalheFooter2", function(evt) { activate_page("#");         return false; });
    $(document).on("click", "#produtoDetalheFooter3", function(evt) { activate_page("#mainpage"); return false; });
  
    //========= pedidos =========
    $(document).on("click", "#pedidosFooter1", function(evt) { activate_page("#start");    return false; });
    $(document).on("click", "#pedidosFooter2", function(evt) { activate_page("#");         return false; });
    $(document).on("click", "#pedidosFooter3", function(evt) { activate_page("#mainpage"); return false; });
     
    //========= pedidos detalhe =========
    $(document).on("click", "#pedidosDetalheFooter1", function(evt) { activate_page("#pedidos");  return false; });
    $(document).on("click", "#pedidosDetalheFooter2", function(evt) { activate_page("#");         return false; });
    $(document).on("click", "#pedidosDetalheFooter3", function(evt) { activate_page("#mainpage"); return false; });
     
    //========= fazer pedido =========
    $(document).on("click", "#fazerpedidoFooter1", function(evt) { activate_page("#start");  return false; });
    $(document).on("click", "#fazerpedidoFooter2", function(evt) { activate_page("#");         return false; });
    $(document).on("click", "#fazerpedidoFooter3", function(evt) { activate_page("#mainpage"); return false; });
     
    //========= Midia Social =========
    $(document).on("click", "#MidiaSocialFooter1", function(evt) { activate_page("#mainpage");  return false; });
    $(document).on("click", "#MidiaSocialFooter2", function(evt) { activate_page("#");         return false; });
    $(document).on("click", "#MidiaSocialFooter3", function(evt) { activate_page("#mainpage"); return false; });
       
    //========= facebook =========
    $(document).on("click", "#FacebookFooter1", function(evt) { activate_page("#midiasocial");  return false; });
    $(document).on("click", "#FacebookFooter2", function(evt) { activate_page("#");         return false; });
    $(document).on("click", "#FacebookFooter3", function(evt) { activate_page("#mainpage"); return false; });

    //========= lancamentos =========
    $(document).on("click", "#LancamentosFooter1", function(evt) { activate_page("#mainpage");  return false; });
    $(document).on("click", "#LancamentosFooter2", function(evt) { activate_page("#");         return false; });
    $(document).on("click", "#LancamentosFooter3", function(evt) { activate_page("#mainpage"); return false; });

    //========= download =========
    $(document).on("click", "#DownloadFooter1", function(evt) { activate_page("#mainpage");  return false; });
    $(document).on("click", "#DownloadFooter2", function(evt) { activate_page("#");         return false; });
    $(document).on("click", "#DownloadFooter3", function(evt) { activate_page("#mainpage"); return false; });

    //========= sobre =========
    $(document).on("click", "#SobreFooter1", function(evt) { activate_page("#mainpage");  return false; });
    $(document).on("click", "#SobreFooter2", function(evt) { activate_page("#");         return false; });
    $(document).on("click", "#SobreFooter3", function(evt) { activate_page("#mainpage"); return false; });
     
     
    // mainpage 
    $(document).on("click", "#mainpageLoginBtn",       function(evt) { activate_page("#login");       return false; });
    $(document).on("click", "#mainpageContactBtn",     function(evt) { activate_page("#contato");     return false; });
    $(document).on("click", "#mainpageLancamentoBtn",  function(evt) { 
   
            $.ajax({
                type: "GET",
                dataType  : 'html',
                url: ServerPath,
                data:{
                    "TC":999131,
                },
                success: function(data) {
//showErrorModal ("lancamento ...");
                    getLancamentoItems (data);
                }
            }); 
               
            function getLancamentoItems(data) {
                $("#displayLancamento ").html(data);
                activate_page("#lancamento");  
            }
        
    });
    $(document).on("click", "#mainpageMidiaSocialBtn", function(evt) { activate_page("#midiasocial"); return false; });
     
    $(document).on("click", "#mainpageDownloadBtn",    function(evt) { 
        
        // get all download files ...        
        $.ajax({
            type        : "GET",
            dataType    : "html",
            url         : ServerPath,
            data        : {
                "TC":999130 
            },
            success: function(data) {
                displayDownloadItens (data);
          }
        }); 
		
        function displayDownloadItens(data) {
	        $("#displayDownloads").html(data);
            activate_page("#download");   
        }

    });
     
    $(document).on("click", "#mainpageFacebookBtn", function(evt) { activate_page("#facebook"); return false; });
          
    $(document).on("click", "#LSMmainFechar", function(evt) { uib_sb.toggle_sidebar($("#LSMmainpage")); return false; });
     

    // login 
    $(document).on("click", "#loginLoginBtn", function(evt) {
        var inputNome  = $("#loginNomeID").val();
        var inputSenha = $("#loginSenhaID").val();
        
        if (inputNome=="") {
            errorMsg = "insere o codigo";
            showErrorModal (errorMsg);
        }
        else if (inputSenha=="") {
            errorMsg = "insere a senha";
            showErrorModal (errorMsg);            
        }
        else {
            $.ajax({
                type: "GET",
                dataType  : 'html',
                url: ServerPath,
                data:{
                    "TC":101,
                    "nome":inputNome,
                    "senha":inputSenha
                },
                success: function(data) {
                    loginCheck (data);
                }
            }); 
               
            function loginCheck(status) {
                var result = status.substring(0, 2);
                if (result === "OK") {
                   // load category-data ..
                   $.ajax({
                       type: "GET",
                       dataType  : 'html',
                       url: ServerPath,
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
                       url: ServerPath,
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
        
                    // set global revendedor 
                    $("#globalRevendedorID").html(inputNome);
                    
                    loggedIn = 1;
                    
                    activate_page("#start");
                }
                else {
                    errorMsg = "senha errada";
                    showErrorModal (errorMsg);
                }
            }
        }
    });


    // start 
    $(document).on("click", "#StartFazerPedido", function(evt) {
        callFazerPedido ();
    });
     
    function callFazerPedido (){
        var revendedor  = $("#globalRevendedorID").text();
        
        // get 'produtos' for current 'pedido' ...        
        $.ajax({
            type: "GET",
            dataType  : 'html',
            url: ServerPath,
            data:{
                "TC":999117, 
                "revendedor":revendedor
            },
            success: function(data) {
                displayProdutoPedidoAtual (data);
          }
        }); 
		
        function displayProdutoPedidoAtual(data) {
	        $("#currentProducts").html(data);
            //navigator.notification.alert(data, null, 'Aviso', 'OK' );
            //activate_page("#fazerpedido");           
        }        
       
        $.ajax({
            type: "GET",
            dataType  : 'html',
            url: ServerPath,
            data:{
                "TC":999119,   // get valorTotal of selected 'products' ...
                "revendedor":revendedor
            },
            success: function(data) {
                displayValorTotal (data);
            }
        }); 
		
        function displayValorTotal(data) {
	        $("#currentValorTotal").html(data);
            //navigator.notification.alert(data, null, 'Aviso', 'OK' );
            activate_page("#fazerpedido");           
        }                
    } 

    $(document).on("click", "#currentProducts td", function(evt) {
     
        var row  = $(this).parent().index();
        var col  = $("#currentProdutos").find('tr')[0].cells.length - 1;  // get number of columns in table ;
        var idNo = $("#currentProdutos tr:eq("+row+") td:eq(4)").text(); 
        var quantidade = $("#currentProdutos tr:eq("+row+") td:eq(3)").text(); 
        
        $.ajax({
            type        : "GET",
            dataType    : "html",
            url         : ServerPath,
            data        :{
                    "TC"    : 999122,
                    "idNo"  : idNo,		
                    "quantidade":quantidade
            },
            success: function(data) {
                displayPedidoDetalheModal (data);
            }
        }); 
        
        function displayPedidoDetalheModal(data) {
            $("#ModalProdutosDetalhe").html(data);
            $('#modalProduto').modal('show'); // show selected products on modal screen
        } 
        
    });

    $(document).on("click", "#StartMidia", function(evt) { activate_page("#"); return false; });

    $(document).on("click", "#StartMeusPedidos",  function(evt) { // get pedidos 
        callMeusPedidos();        
    });
     
    function callMeusPedidos(data) {
        var revendedor  = $("#globalRevendedorID").text();

        $.ajax({
            type: "GET",
            dataType  : 'html',
            url: ServerPath,
            data:{
                "TC":999112001, // TC=999112001 for smartphone
                "revendedor":revendedor,
            },
            success: function(data) {
                displayTabPedidos (data);
            }
        }); 
		
        function displayTabPedidos(data) {
	        $("#displayTabPd1").html(data);
            activate_page("#pedidos");           
        }        
    }

    
    $(document).on("click", "#mainHeader",    function(evt) { uib_sb.toggle_sidebar($("#LSMmain")); return false;});
    $(document).on("click", "#LSMMainFechar", function(evt) { uib_sb.toggle_sidebar($("#LSMmain")); return false;});     
     
    $(document).on("click", "#startHeader",    function(evt) { uib_sb.toggle_sidebar($("#LSMstart")); return false;});     
    $(document).on("click", "#LSMStartFechar", function(evt) { uib_sb.toggle_sidebar($("#LSMstart")); return false;});

    $(document).on("click", "#fazerPedidoHeader",    function(evt) { uib_sb.toggle_sidebar($("#LSMfazerpedido")); return false;});
    $(document).on("click", "#LSMFazerPedidoFechar", function(evt) { uib_sb.toggle_sidebar($("#LSMfazerpedido")); return false;});

    $(document).on("click", "#contatoHeader",    function(evt) { uib_sb.toggle_sidebar($("#LSMcontato")); return false;});
    $(document).on("click", "#LSMContatoFechar", function(evt) { uib_sb.toggle_sidebar($("#LSMcontato")); return false;});
     
    $(document).on("click", "#sobreHeader",    function(evt) { uib_sb.toggle_sidebar($("#LSMsobre")); return false;});
    $(document).on("click", "#LSMSobreFechar", function(evt) { uib_sb.toggle_sidebar($("#LSMsobre")); return false;});
     
    $(document).on("click", "#DownloadsHeader",    function(evt) { uib_sb.toggle_sidebar($("#LSMdownload")); return false;});
    $(document).on("click", "#LSMDownloadFechar", function(evt) { uib_sb.toggle_sidebar($("#LSMdownload")); return false;});
     
    $(document).on("click", "#LancamentosHeader",   function(evt) { uib_sb.toggle_sidebar($("#LSMlancamento")); return false;});
    $(document).on("click", "#LSMLancamentoFechar", function(evt) { uib_sb.toggle_sidebar($("#LSMlancamento")); return false;});
     
    $(document).on("click", "#MidiaSocialHeader",    function(evt) { uib_sb.toggle_sidebar($("#LSMmidiasocial")); return false;});
    $(document).on("click", "#LSMMidiasocialFechar", function(evt) { uib_sb.toggle_sidebar($("#LSMmidiasocial")); return false;});
     
    $(document).on("click", "#loginHeader",    function(evt) { uib_sb.toggle_sidebar($("#LSMlogin")); return false;});
    $(document).on("click", "#LSMLoginFechar", function(evt) { uib_sb.toggle_sidebar($("#LSMlogin")); return false;});
     
    $(document).on("click", "#pedidosXXXHeader",  function(evt) { uib_sb.toggle_sidebar($("#LSMpedidos")); return false;});
    $(document).on("click", "#LSMPedidosFechar",  function(evt) { uib_sb.toggle_sidebar($("#LSMpedidos")); return false;});
     
    $(document).on("click", "#produtoPorPedidoHeader",  function(evt) { uib_sb.toggle_sidebar($("#LSMpedidosdetail")); return false;});
    $(document).on("click", "#LSMPedidosDetailFechar",  function(evt) { uib_sb.toggle_sidebar($("#LSMpedidosdetail")); return false;});
     
    $(document).on("click", "#produtosHeader",    function(evt) { uib_sb.toggle_sidebar($("#LSMprodutos")); return false;});
    $(document).on("click", "#LSMProdutosFechar", function(evt) { uib_sb.toggle_sidebar($("#LSMprodutos")); return false;});
     
    // pedidos 
    $(document).on("click", "#pedidoTable td", function(evt) {
        var row_index = $(this).parent().index();
        var col_index = $("#pedidoTable").find('tr')[0].cells.length - 1;  // get number of columns in table ;
	  
        col_index=0;
        var pedidoId = $("#pedidoTable tr:eq("+row_index+") td:eq("+col_index+")").text(); 

        // --> get 'produtos' for selected 'pedidoId' ...
        if (pedidoId > 0){
            $.ajax({
                type: "GET",
                dataType  : 'html',
                url: ServerPath,
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
                activate_page("#pedidosdetail");   
            } 
        }
    });
     
    // fazer pedido 
    $(document).on("click", "#fazerpedidoPedir", function(evt) {
        
        var revendedor  = $("#globalRevendedorID").text();
                    
        $.ajax({
          type      : "GET",
          dataType  : "html",
          url       : ServerPath,
          data      :{
                "TC":999115,
                "revendedor":revendedor
          },
          success: function(data) {
              callInsertPedido (data);
          }
        }); 

        function callInsertPedido(data) {
            
            var revendedor  = $("#globalRevendedorID").text();
            
// --> send pedido - email ..
/*
$.ajax({
    type: "GET",
    dataType  : 'html',
    url: EmailServer,
    data:{
        "TC":5153,
"pedidoId":122,		
    },
    success: function(data) {
showErrorModal (data);
        displaySendPedidoEmail (data);
    }
}); 
function displaySendPedidoEmail(data) {
    ;
}
//-----------------------
*/
        
            // get 'produtos' for current 'pedido' ...        
            $.ajax({
                type: "GET",
                dataType  : 'html',
                url: ServerPath,
                data:{
                    "TC":999117, 
                    "revendedor":revendedor
                },
                success: function(data) {
                    displayProdutoPedidoAtual (data);
                }
            }); 
		
            function displayProdutoPedidoAtual(data) {
	           $("#currentProducts").html(data);
            }        
       
            $.ajax({
                type: "GET",
                dataType  : 'html',
                url: ServerPath,
                data:{
                    "TC":999119,   // get valorTotal of selected 'products' ...
                    "revendedor":revendedor
                },
                success: function(data) {
                    displayValorTotal (data);
                }
            }); 
		
            function displayValorTotal(data) {
	           $("#currentValorTotal").html(data);
                activate_page("#fazerpedido");           
            }
        }

    });

    $(document).on("click", "#fazerpedidoEscolher", function(evt) {
        var inputCodigo  = $("#inputCodigo").val();
        
        // get data for 'produto detail' ,,
        // goto screen 'produto detail' ..
        $.ajax({
            type        : "GET",
            dataType    : "html",
            url         : ServerPath,
            data        :{
                "TC":999120,
                "inputCodigo":inputCodigo,		
            },
            success: function(data) {
                //navigator.notification.alert(data , null, 'Aviso', 'OK' );
                displayProdutoDetalhe (data);
            }
        }); 
		
        function displayProdutoDetalhe(data) {
            
            var result = data.substring(0, 3);
            if (result === "NOK")
            {
                errorMsg = "produto não existe";
                showErrorModal (errorMsg);                
                activate_page("#fazerpedido");
            }
            else {
                $("#testProdutoDetail").html(data);
                activate_page("#produtodetail");
            }
            
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
	
    $(document).on("click", "#accTable1 td", function(evt) {
      var row_index = $(this).parent().index();
	  var col_index = $("#accTable1").find('tr')[0].cells.length - 1;  // get number of columns in table ..

      var idNo=$("#accTable1 tr:eq("+row_index+") td:eq("+col_index+")").html(); // value of last column of selected row ..

      $.ajax({
          type      : "GET",
          dataType  : "html",
          url       : ServerPath,
          data      : {
              "TC"  : 999109,
              "idNo": idNo,
          },
          success   : function(data) {
              callProductsPerCategory (data);
          }
      }); 
      
      function callProductsPerCategory(data) {
        $("#testField").html(data);
        activate_page("#produtos");   
      }
	  
    });
     
    $(document).on("click", "#accTable2 td", function(evt) {
      var row_index = $(this).parent().index();
	  var col_index = $("#accTable2").find('tr')[0].cells.length - 1;  // get number of columns in table ;

      var idNo=$("#accTable2 tr:eq("+row_index+") td:eq("+col_index+")").html(); // value of last column of selected row ..
	  
      $.ajax({
          type      : "GET",
          dataType  : "html",
          url: ServerPath,
          data      :{
                "TC"  : 999110,
                "idNo": idNo,		
          },
          success: function(data) {
              callProductsPerCategory (data);
          }
      }); 
      
      function callProductsPerCategory(data) {
        $("#testField").html(data);
        activate_page("#produtos");   
      }         
 
    });
     
    $(document).on("click", "#selectedMBCategory td", function(evt) {
      var row_index = $(this).parent().index();
	  var col_index = $("#selectedMBCategory").find('tr')[0].cells.length - 1;  // get number of columns in table ;

      var idNo=$("#selectedMBCategory tr:eq("+row_index+") td:eq("+col_index+")").html(); // value of last column of selected row ..
	  
      $.ajax({
          type      : "GET",
          dataType  : "html",
          url       : ServerPath,
          data      :{
              "TC":999111001,
              "idNo":idNo,		
          },
          success: function(data) {
              callProductsDetailMB (data);
          }
      }); 
      
      function callProductsDetailMB(data) {
        $("#testProdutoDetail").html(data);
        activate_page("#produtodetail");   
      }         

    });
     
    $(document).on("click", "#selectedMBCategoryKits td", function(evt) {
                
      var row_index = $(this).parent().index();
	  var col_index = 0;
      var idNo=$("#selectedMBCategoryKits tr:eq("+row_index+") td:eq("+col_index+")").html(); // value of last column of selected row ..
        //errorMsg = "idNo: "+idNo;
        //showErrorModal (errorMsg);
    
      $.ajax({
          type      : "GET",
          dataType  : "html",
          url       : ServerPath,
          data      :{
              "TC":999771,
              "idNo":idNo,		
          },
          success: function(data) {
              callProductsDetailMB (data);
          }
      }); 
      
      function callProductsDetailMB(data) {
        $("#testProdutoDetail").html(data);
        activate_page("#produtodetail");   
      }          

    });   
     
 
    $(document).on("click", "#selectedMBCategoryKitsProducts td", function(evt) {
                
      var row_index = $(this).parent().index();
	  var col_index = 4;
      var idNo=$("#selectedMBCategoryKitsProducts tr:eq("+row_index+") td:eq("+col_index+")").html(); // value of last column of selected row ..
      
      $.ajax({
          type      : "GET",
          dataType  : "html",
          url       : ServerPath,
          data      :{
              "TC":999111001,
              "idNo":idNo,		
          },
          success: function(data) {
              callProductsDetailMBKits (data);
          }
      }); 
      
      function callProductsDetailMBKits(data) {
        $("#testProdutoDetail").html(data);
        activate_page("#produtodetail");   
      }         
        
        //errorMsg = "Kits-Product idNo: "+idNo;
        //showErrorModal (errorMsg);
    });   
     
    $(document).on("click", "#selectedHCCategory td", function(evt) {
      var row_index = $(this).parent().index();
	  var col_index = $("#selectedHCCategory").find('tr')[0].cells.length - 1;  // get number of columns in table ;
        
      var idNo=$("#selectedHCCategory tr:eq("+row_index+") td:eq("+col_index+")").html(); // value of last column of selected row ..
        	  
      $.ajax({
          type: "GET",
          dataType  : 'html',
          url: ServerPath,
          data:{
              "TC":999111001,
              "idNo":idNo,		
          },
          success: function(data) {
              callProductsDetailHC (data);
          }
      });

      function callProductsDetailHC(data) {
        $("#testProdutoDetail").html(data);
        activate_page("#produtodetail");   
      }

    });	
     
    $(document).on("focusout", "#countModalID", function(evt) { 
        var quant      = $( "#countModalID" ).val();
        var valor      = $( "#valorID" ).text();
        var valorSub   = valor.substring(3);          
        var valorInt   = parseFloat(valorSub);
        var valorTotal = quant * valorInt;
        var valorForm = "Total: R$ "+valorTotal.toFixed(2); 
        //navigator.notification.alert('countModalID ...'+'quant: '+quant+' valorSub: '+valorSub+' valorTotal: '+valorTotal+' valorInt:'+valorInt+' valorForm:'+valorForm, null, 'Aviso', 'OK' );

        $("#valorTotalModalID").text(valorForm);
    });	
     
    $(document).on("focusout", "#countDetalheID", function(evt) { 
        var quant      = $( "#countDetalheID" ).val();
        var valor      = $( "#valorID" ).text();
        var valorSub   = valor.substring(3);          
        var valorInt   = parseFloat(valorSub);
        var valorTotal = quant * valorInt;
        var valorForm = "R$ "+valorTotal.toFixed(2); 
        //navigator.notification.alert(valorForm, null, 'Aviso', 'OK' );

        $("#valorTotalID").text(valorForm);
    });	
     
    $(document).on("focusout", "#countDetail001ID", function() { 
        var quant      = $( "#countDetail001ID" ).val();
        var valor      = $( "#valor001ID" ).text();
        var valorSub   = valor.substring(3);          
        var valorInt   = parseFloat(valorSub);
        var valorTotal = quant * valorInt;
        var valorForm  = "R$ "+valorTotal.toFixed(2); 
        //navigator.notification.alert(valorForm, null, 'Aviso', 'OK' );
       
        $("#valorTotal001ID").text(valorForm);
    });	

    $(document).on("focusout", "#countDetailKitID", function() { 
        var quant      = $( "#countDetailKitID" ).val();
        var valor      = $( "#valorSumKitID" ).text();
   //     var valorSub   = valor.substring(3);          
   //     var valorInt   = parseFloat(valorSub);
        var valorTotal = quant * valor;
        var valorForm  = "R$ "+valorTotal.toFixed(2); 
        //navigator.notification.alert(valorForm, null, 'Aviso', 'OK' );
       
        $("#valor001ID").text(valorForm);
    });	
     
    // midia social 
    
    $(document).on("click", "#SocialMidiafacebookBtn",  function(evt) { activate_page("#facebook"); return false; });
     
    $(document).on("click", "#SocialMidiaYoutubeBtn",   function(evt) { activate_page("#"); return false; });
     
    $(document).on("click", "#SocialMidiaInstagramBtn", function(evt) { activate_page("#"); return false; });
    
    $(document).on("click", "#produtoDetalheModalPedirID", function(evt) {
        
        var revendedor = $("#globalRevendedorID").text();
        var quant      = $( "#countDetalheID" ).val();
        var referencia = $( "#refID" ).text();
        var refVal     = referencia.substring(9);
        
        // (1) update 'quantidade' for selected item
        $.ajax({
            type        : "GET",
            dataType    : "html",
            url         : ServerPath,
            data        :{
                "TC":999123,
                "referencia":refVal,
                "quantidade":quant
            },
            success: function(data) {
                UpdateQuantidadePedidoAtual (data);
            }
        }); 

        function UpdateQuantidadePedidoAtual(data) {
            
            $.ajax({
                type        : "GET",
                dataType    : "html",
                url         : ServerPath,
                data        :{
                    "TC":999117, 
                    "revendedor":revendedor
                },
                success: function(data) {
                    displayProdutoPedidoAtualModal (data);
                }
            });
    
            function displayProdutoPedidoAtualModal(data) {
                $("#currentProducts").html(data);
                
                $.ajax({
                    type        : "GET",
                    dataType    : "html",
                    url         : ServerPath,
                    data        :{
                        "TC":999119,   // get valorTotal of selected 'products' ...
                        "revendedor":revendedor
                    },
                    success: function(data) {
                        displayValorTotalModal (data);
                    }
                }); 
        
                function displayValorTotalModal(data) {
//                    showErrorModal (data);
            $("#currentValorTotal").html(data);
            $('#modalProduto').modal('hide');     
                }
            }    
        }        

    });
   
    $(document).on("click", "#produtoDetalheModalFecharID", function(evt) {
        $('#modalProduto').modal('hide'); 
    });	 
     
    $(document).on("click", "#produtoDetalheModalDeletarID", function(evt) {
        
        var revendedor  = $("#globalRevendedorID").text();
        
        var referencia = $( "#refID" ).text();
        var refVal = referencia.substring(9);
        
        // (1) delete 'referencia' 
        $.ajax({
            type        : "GET",
            dataType    : "html",
            url         : ServerPath,
            data        :{
                "TC":999124,
                "referencia":refVal,
            },
            success: function(data) {
                DeletePedidoAtual (data);
            }
        }); 

        function DeletePedidoAtual(data) {
            
            $.ajax({
                type: "GET",
                dataType  : 'html',
                url: ServerPath,
                data:{
                    "TC":999117, 
                    "revendedor":revendedor
                },
                success: function(data) {
                    displayProdutoPedidoAtualModal (data);
                }
            }); 
    
            function displayProdutoPedidoAtualModal(data) {
                $("#currentProducts").html(data);
                $.ajax({
                    type: "GET",
                    dataType  : 'html',
                    url: ServerPath,
                    data:{
                        "TC":999119,   // get valorTotal of selected 'products' ...
                        "revendedor":revendedor
                    },
                    success: function(data) {
                        displayValorTotalModal (data);
                    }
                }); 
        
                function displayValorTotalModal(data) {
                    $("#currentValorTotal").html(data);
                    $('#modalProduto').modal('hide');     
                }
            }
        }
        
    });
     
    $(document).on("click", "#produtoPedirID", function(evt) {
        var revendedor  = $("#globalRevendedorID").text();
        var quantidade  = $("#countDetail001ID").val();
        var refStr      = $("#refID").text();
        var refSub      = refStr.substring(9);  
        var idProduto   = parseFloat(refSub);        
  
//alert ('idProd: '+idProduto+' quant: '+quantidade+' reve: '+revendedor);
        // INSERT 'produto' into DB ..
        $.ajax({
            type        : "GET",
            dataType    : "html",
            url         : ServerPath,
            data        : {
                "TC":999118,
                "idProduto":idProduto,		
                "quantidade":quantidade,		
                "revendedor":revendedor,		
            },
            success: function(data) {
                callProductsDetailInsertHC (data); 
            }
        }); 
      
        function callProductsDetailInsertHC(data) {
            
            // get 'produtos' for current 'pedido' ...        
            $.ajax({
                type        : "GET",
                dataType    : 'html',
                url         : ServerPath,
                data        :{
                    "TC":999117, 
                    "revendedor":revendedor
                },
                success: function(data) {
                    displayInsertProdutoPedidoAtual (data);
              }
            });
		  
            function displayInsertProdutoPedidoAtual(data) {
	           $("#currentProducts").html(data);
                
                // get valor total of selected products ..
                $.ajax({
                    type        : "GET",
                    dataType    : "html",
                    url         : ServerPath,
                    data        :{
                        "TC":999119,   // get valorTotal of selected 'products' ...
                        "revendedor":revendedor
                    },
                    success: function(data) {
                        displayValorTotal (data);
                    }
                });
		      
                function displayValorTotal(data) {
	               $("#currentValorTotal").html(data);
                    activate_page("#fazerpedido");           
                }                
            }

        }
                 
    });	
     
     
    $(document).on("click", "#produtoPedirKitID", function(evt) {
        var revendedor  = $("#globalRevendedorID").text();
        var quantidade  = $("#countDetailKitID").val();
        var refStr      = $("#refID").text();
        var refSub      = refStr.substring(9);  
        var idProduto   = parseFloat(refSub);        
  
//errorMsg = "ref: "+idProduto+" quant: "+quantidade+" rev: "+revendedor;
//showErrorModal (errorMsg);

     
        // INSERT 'produto' into DB ..
        $.ajax({
            type        : "GET",
            dataType    : "html",
            url         : ServerPath,
            data        : {
                "TC":999118,
                "idProduto":idProduto,		
                "quantidade":quantidade,		
                "revendedor":revendedor,		
            },
            success: function(data) {
                callProductsDetailInsertKit (data); 
            }
        }); 
      
        function callProductsDetailInsertKit(data) {
            
            // get 'produtos' for current 'pedido' ...        
            $.ajax({
                type        : "GET",
                dataType    : 'html',
                url         : ServerPath,
                data        :{
                    "TC":999117, 
                    "revendedor":revendedor
                },
                success: function(data) {
                    displayInsertProdutoPedidoAtual (data);
              }
            });
		  
            function displayInsertProdutoPedidoAtual(data) {
	           $("#currentProducts").html(data);
                
                // get valor total of selected products ..
                $.ajax({
                    type        : "GET",
                    dataType    : "html",
                    url         : ServerPath,
                    data        :{
                        "TC":999119,   // get valorTotal of selected 'products' ...
                        "revendedor":revendedor
                    },
                    success: function(data) {
                        displayValorTotal (data);
                    }
                });
		      
                function displayValorTotal(data) {
	               $("#currentValorTotal").html(data);
                    activate_page("#fazerpedido");           
                }                
            }

        }
                 
    });	
     
    $(document).on("click", "#produtoFecharID", function(evt) {
        activate_page("#produtos");           
    });	     
     
    $(document).on("click", "#produtoDiretoFecharID", function(evt) {
        activate_page("#fazerpedido");           
    });	 
     
    $(document).on("click", "#produtoDiretoPedirID", function(evt) {
        
        var revendedor  = $("#globalRevendedorID").text();
        var quantidade  = $("#countModalID").val();
        var refStr      = $("#refID").text();
        var refSub      = refStr.substring(9);  
        var idProduto   = parseFloat(refSub);        
       
        // (1) INSERT 'produto' into DB ..
        $.ajax({
            type: "GET",
            dataType  : 'html',
            url: ServerPath,
            data:{
                "TC":999118,
                "idProduto":idProduto,		
                "quantidade":quantidade,		
                "revendedor":revendedor,		
            },
            success: function(data) {
                callProductsDetailInsertHC (data); 
            }
        }); 
      
        function callProductsDetailInsertHC(data) {
            //$("#testProdutoDetail").html(data);
            //activate_page("#produtodetail");   
            
            // (2) get 'produtos' for current 'pedido' ...        
            $.ajax({
                type: "GET",
                dataType  : 'html',
                url: ServerPath,
                data:{
                    "TC":999117, 
                    "revendedor":revendedor
                },
                success: function(data) {
                    displayInsertProdutoPedidoAtual (data);
              }
            }); 
		  
            function displayInsertProdutoPedidoAtual(data) {
	           $("#currentProducts").html(data);
                
                // (3) get valor total
                $.ajax({
                    type: "GET",
                    dataType  : 'html',
                    url: ServerPath,
                    data:{
                        "TC":999119,   // get valorTotal of selected 'products' ...
                        "revendedor":revendedor
                    },
                    success: function(data) {
                        displayValorTotal (data);
                    }
                }); 
		      
                function displayValorTotal(data) {
	               $("#currentValorTotal").html(data);
                    activate_page("#fazerpedido");           
                }        
            }             
        }            
        
    });	    
     
     
    $(document).on("click", "#ScreenContactSend", function(evt) {
        var nome     = $("#inputNome").val();
        var assunto  = $("#inputAssunto").val();
        var email    = $("#inputEmail").val();
        var fone     = $("#inputTelefone").val();
        var mensagem = $("#inputMensagem").val();

        if (nome=="") {
            errorMsg = "campo 'nome' obrigatório ..";
            showErrorModal (errorMsg);
        }
        else if (email=="") {
            errorMsg = "campo 'email' obrigatório ..";
            showErrorModal (errorMsg);            
        }
        else if (assunto=="") {
            errorMsg = "campo 'assunto' obrigatório ..";
            showErrorModal (errorMsg);            
        }
        else if (mensagem=="") {
            errorMsg = "campo 'mensagem' obrigatório ..";
            showErrorModal (errorMsg);            
        }
        else {
            $.ajax({
               type      : "GET",
               dataType  : "html",
               url       : EmailServer,
               data      : {
                   "TC":5151,
                   "nome":nome,
                   "assunto":assunto,
                   "email":email,
                   "fone":fone,
                   "mensagem":mensagem,
               },
               success: function(data) {
                   callSendForm (data);
               }
            }); 
    
            function callSendForm(data) {
              $("#form-messages").html(data);
              activate_page("#mainpage");
            }
        }

    });

    $(document).on("click", "#modalErrorButtonClose", function(evt) {
        $('#modalError').modal('hide'); 
    });	 
     
     
    $(document).on("click", "#LSMgotoFazerPedido", function(evt) {
        if (loggedIn == 1) {
            uib_sb.toggle_sidebar($("#LSMstart"));
            callFazerPedido ();
        }
        else {
            uib_sb.toggle_sidebar($("#LSMstart"));
            activate_page("#login");                
        }
    });	 
     
    $(document).on("click", "#LSMgotoMeusPedidos", function(evt) {
        if (loggedIn == 1) {        
            uib_sb.toggle_sidebar($("#LSMstart"));
            callMeusPedidos();        
        }
        else {
            uib_sb.toggle_sidebar($("#LSMstart"));
            activate_page("#login");                
        }
    });	 
     
    $(document).on("click", "#LSMgotoMidia", function(evt) {
        uib_sb.toggle_sidebar($("#LSMstart"));
        activate_page("#midiasocial");    
    });	 

    $(document).on("click", "#LSMgotoLancamentos", function(evt) {
        uib_sb.toggle_sidebar($("#LSMstart"));
        
            $.ajax({
                type: "GET",
                dataType  : 'html',
                url: ServerPath,
                data:{
                    "TC":999131,
                },
                success: function(data) {
//showErrorModal ("lancamento ...");
                    getLancamentoItems (data);
                }
            }); 
               
            function getLancamentoItems(data) {
                $("#displayLancamento ").html(data);
                activate_page("#lancamento");  
            }
//        activate_page("#lancamento");    
    });	 

    $(document).on("click", "#LSMgotoDownloads", function(evt) {
        uib_sb.toggle_sidebar($("#LSMstart"));
        
        // get all download files ...        
        $.ajax({
            type        : "GET",
            dataType    : "html",
            url         : ServerPath,
            data        : {
                "TC":999130 
            },
            success: function(data) {
                displayDownloadItens (data);
          }
        }); 
		
        function displayDownloadItens(data) {
	        $("#displayDownloads").html(data);
            activate_page("#download");   
        }        
        //activate_page("#download");    
    });	 

    $(document).on("click", "#LSMgotoContato", function(evt) {
        uib_sb.toggle_sidebar($("#LSMstart"));
        activate_page("#contato");    
    });	 

    $(document).on("click", "#LSMgotoSobre", function(evt) {
        uib_sb.toggle_sidebar($("#LSMstart"));
        activate_page("#sobre");    
    });	 

                                                                    

    $(document).on("click", "#PedidosCommentSend", function(evt) {
        var mensagem    = $("#comment").val();
        var valueRadio1 = $("form input[name='radioGroup1']:checked").val();
        var valueRadio2 = $("form input[name='radioGroup2']:checked").val();

//showErrorModal (valueRadio1);            
        
        if (mensagem != "") {
            $.ajax({
               type      : "GET",
               dataType  : "html",
               url       : EmailServer,
               data      : {
                   "TC":5152,
                   "mensagem":mensagem,
                   "radio1":valueRadio1,
                   "radio2":valueRadio2,
               },
               success: function(data) {
                   callCommentSendForm (data);
               }
            }); 
    
            function callCommentSendForm(data) {
              $("#pedidos-messages").html(data);
              activate_page("#pedidosdetail");
            }    
        }

    });

     
 }
    
 document.addEventListener("app.Ready", register_event_handlers, false);
})();
    
