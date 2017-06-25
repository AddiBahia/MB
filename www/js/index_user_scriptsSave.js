/*jshint browser:true */
/*global $ */(function()
{
 "use strict";
 /*
   hook up event handlers 
 */
 function register_event_handlers()
 {
/*
    /* button  Register * /
    $(document).on("click", ".uib_w_6", function(evt)
    {
        return false;
    });
    
    /* button  Categorias * /
    $(document).on("click", ".uib_w_43", function(evt)
    {
         activate_page("#categories"); 
         return false;
    });

    /* button  back * /
    $(document).on("click", ".uib_w_47", function(evt)
    {
         activate_page("#mainpage"); 
         return false;
    });
    
    /* button  back * /
    $(document).on("click", ".uib_w_53", function(evt)
    {
         activate_page("#mainpage"); 
         return false;
    });
    
    /* button  Produtos  * /
    $(document).on("click", ".uib_w_44", function(evt)
    {
         activate_page("#products"); 
         return false;
    });
    
        /* button  back11 * /
    $(document).on("click", ".uib_w_66", function(evt)
    {
         activate_page("#mainpage"); 
         return false;
    });

 
    $(document).on("click", ".uib_w_68", function(evt)
    {

        $.ajax({
            type: "GET",
            dataType  : 'html',
            url: "http://localhost/Mairibel/server.php",
            data: "TC=003",
            success: function(data) {
                $('#loginSenhaID').html(data);
            }
        });
        
        return false;
    });
    
    $(document).on("click", ".uib_w_78", function(evt)
    {

        $.ajax({
            type: "GET",
            dataType  : 'html',
            url: "http://localhost/Mairibel/server.php",
            data: "TC=004",
            success: function(data) {
                $('#newsID').html(data);
            }
        });
        
        return false;
    });
    

        /* button  Produto000 * /
    $(document).on("click", ".uib_w_99", function(evt)
    {
         activate_page("#escolherproduto"); 
         return false;
    });
        

        /* button  Goto Start * /
    $(document).on("click", ".uib_w_110", function(evt)
    {
         activate_page("#start"); 
         return false;
    });
    
        /* button  voltar00 * /
    $(document).on("click", ".uib_w_117", function(evt)
    {
         activate_page("#fazerpedido"); 
         return false;
    });
    
        /* button  logout00 * /
    $(document).on("click", ".uib_w_118", function(evt)
    {
         activate_page("#mainpage"); 
         return false;
    });
    
        /* button  voltar99 * /
    $(document).on("click", ".uib_w_120", function(evt)
    {
         activate_page("#fazerpedido"); 
         return false;
    });
    
        /* button  Logout889 * /
    $(document).on("click", ".uib_w_122", function(evt)
    {
         activate_page("#mainpage"); 
         return false;
    });
    
        /* button  voltar66 * /
    $(document).on("click", ".uib_w_124", function(evt)
    {
         activate_page("#fazerpedido"); 
         return false;
    });
    
        /* button  Logout89 * /
    $(document).on("click", ".uib_w_126", function(evt)
    {
         activate_page("#mainpage"); 
         return false;
    });
    
        /* button  voltar55 * /
    $(document).on("click", ".uib_w_128", function(evt)
    {
         activate_page("#start"); 
         return false;
    });
     
        /* button  voltar * /
    $(document).on("click", ".uib_w_134", function(evt)
    {
         activate_page("#start"); 
         return false;
    });
    
        /* button  Button * /
    $(document).on("click", ".uib_w_136", function(evt)
    {
         activate_page("#mainpage"); 
         return false;
    });
    
        /* button  Logout * /
    $(document).on("click", ".uib_w_149", function(evt)
    {
         activate_page("#mainpage"); 
         return false;
    });
    
        /* button  voltar * /
    $(document).on("click", ".uib_w_147", function(evt)
    {
         activate_page("#cadastrarcliente"); 
         return false;
    });
    
        /* button  Voltar * /
    $(document).on("click", ".uib_w_151", function(evt)
    {
         activate_page("#cadastrarcliente"); 
         return false;
    });
    
        /* button  Button * /
    $(document).on("click", ".uib_w_153", function(evt)
    {
         activate_page("#mainpage"); 
         return false;
    });
    
        /* button  00Cadastrar cliente novo * /
    $(document).on("click", ".uib_w_138", function(evt)
    {
         activate_page("#cadastrarclientenovo"); 
         return false;
    });
    
        /* button  000Cadastrar cliente * /
    $(document).on("click", ".uib_w_93", function(evt)
    {
         activate_page("#cadastrarcliente"); 
         return false;
    });
    
        /* button  00Meus clientes * /
    $(document).on("click", ".uib_w_137", function(evt)
    {
         activate_page("#meusclientes"); 
         return false;
    });
    
        /* button  Logout * /
    $(document).on("click", ".uib_w_165", function(evt)
    {
         activate_page("#mainpage"); 
         return false;
    });
    
        /* button  Voltar000 * /
    $(document).on("click", ".uib_w_166", function(evt)
    {
         activate_page("#cadastrarcliente"); 
         return false;
    });
    
        /* button  Voltar111 * /
    $(document).on("click", ".uib_w_167", function(evt)
    {
         activate_page("#cadastrarcliente"); 
         return false;
    });
    
        /* button  Voltar9999 * /
    $(document).on("click", ".uib_w_168", function(evt)
    {
         activate_page("#start"); 
         return false;
    });
    
        /* button  Voltar444 * /
    $(document).on("click", ".uib_w_169", function(evt)
    {
         activate_page("#fazerpedido"); 
         return false;
    });
    
        /* button  Voltar2345 * /
    $(document).on("click", ".uib_w_170", function(evt)
    {
         activate_page("#fazerpedido"); 
         return false;
    });
    
        /* button  Voltar1234 * /
    $(document).on("click", ".uib_w_171", function(evt)
    {
         activate_page("#fazerpedido"); 
         return false;
    });
    
        /* button  Voltar11 * /
    $(document).on("click", ".uib_w_172", function(evt)
    {
         activate_page("#start"); 
         return false;
    });
    
        /* button  0000 * /
    $(document).on("click", ".uib_w_197", function(evt)
    {
         activate_page("#produtoCuidadoCorporal"); 
         return false;
    });
    
        /* button  000 * /
    $(document).on("click", ".uib_w_198", function(evt)
    {
         activate_page("#mainpage"); 
         return false;
    });
    
        /* button  aaa00011 * /
    $(document).on("click", ".uib_w_178", function(evt)
    {
         activate_page("#mainpage"); 
         return false;
    });
    
        /* button  a2222 * /
    $(document).on("click", ".uib_w_177", function(evt)
    {
         activate_page("#escolherproduto"); 
         return false;
    });
    
        /* button  Button0000000 * /
    $(document).on("click", ".uib_w_205", function(evt)
    {
         activate_page("#escolherproduto"); 
         return false;
    });
    
        /* button  Button999999 * /
    $(document).on("click", ".uib_w_206", function(evt)
    {
         activate_page("#mainpage"); 
         return false;
    });
    
        /* button  g00000 * /
    $(document).on("click", ".uib_w_183", function(evt)
    {
         activate_page("#escolherproduto"); 
         return false;
    });
    
        /* button  a66666 * /
    $(document).on("click", ".uib_w_184", function(evt)
    {
         activate_page("#mainpage"); 
         return false;
    });
      
        /* button  Linha Profissional * /
    $(document).on("click", ".uib_w_144", function(evt)
    {
         activate_page("#produtoLinhaProfissional"); 
         return false;
    });
    
        /* button  Linha Manutenção * /
    $(document).on("click", ".uib_w_145", function(evt)
    {
         activate_page("#produtoLinhaManutencao"); 
         return false;
    });
    
        /* list item avatar  .uib_w_187 * /
    $(document).on("click", ".uib_w_187", function(evt)
    {
         activate_page("#produtoDetalhe"); 
         return false;
    });

        /* list item avatar  gygy000777 * /
    $(document).on("click", ".uib_w_186", function(evt)
    {
         activate_page("#produtoDetalhe"); 
         return false;
    });
    
        /* list item avatar  0000Secondary Text * /
    $(document).on("click", ".uib_w_185", function(evt)
    {
         activate_page("#produtoDetalhe"); 
         return false;
    });
    
        /* list item avatar  Condicionador Hidratante * /
    $(document).on("click", ".uib_w_207", function(evt)
    {
         activate_page("#produtoDetalhe"); 
         return false;
    });
    
        /* list item avatar  Ativador de Brilho * /
    $(document).on("click", ".uib_w_208", function(evt)
    {
         activate_page("#produtoDetalhe"); 
         return false;
    });
    
       /* list item avatar  BB Cream Hidratycollor * /
    $(document).on("click", ".uib_w_213", function(evt)
    {
         activate_page("#produtoDetalhe"); 
         return false;
    });
    
        /* list item avatar  Condicionador Hidratante * /
    $(document).on("click", ".uib_w_209", function(evt)
    {
         activate_page("#produtoDetalhe"); 
         return false;
    });
    
        /* list item avatar  Intensificador de Brilho * /
    $(document).on("click", ".uib_w_210", function(evt)
    {
         activate_page("#produtoDetalhe"); 
         return false;
    });
    
        /* list item avatar  Oleo de Argan * /
    $(document).on("click", ".uib_w_211", function(evt)
    {
         activate_page("#produtoDetalhe"); 
         return false;
    });
    
        /* list item avatar  Sabonete Intimo * /
    $(document).on("click", ".uib_w_214", function(evt)
    {
         activate_page("#produtoDetalhe"); 
         return false;
    });
    
        /* list item avatar  0000Ativador de Cachos * /
    $(document).on("click", ".uib_w_188", function(evt)
    {
         activate_page("#produtoDetalhe"); 
         return false;
    });
    
        /* list item avatar  0000Mascara Tratamento * /
    $(document).on("click", ".uib_w_192", function(evt)
    {
         activate_page("#produtoDetalhe"); 
         return false;
    });
    
        /* button  test * /
    $(document).on("click", ".uib_w_218", function(evt)
    {
         activate_page("#aaa"); 
         return false;
    });
    
    /* button  TC01 login * /
    $(document).on("click", ".uib_w_220", function(evt)
    {

        $.ajax({
            type: "GET",
            dataType  : 'html',
            url: "http://localhost/Mairibel/server.php",
            data: "TC=01",
            success: function(data) {
                $('#testID').html(data);
            }
        });
        
        return false;
    });
    
        /* button  TC02 * /
    $(document).on("click", ".uib_w_223", function(evt)
    {

        $.ajax({
            type: "GET",
            dataType  : 'html',
            url: "http://localhost/Mairibel/server.php",
            data: "TC=02",
            success: function(data) {
                $('#testID').html(data);
            }
        });
        
         return false;
    });
    
        /* button  TC03 * /
    $(document).on("click", ".uib_w_225", function(evt)
    {

        $.ajax({
            type: "GET",
            dataType  : 'html',
            url: "http://localhost/Mairibel/server.php",
            data: "TC=03",
            success: function(data) {
                $('#testID').html(data);
            }
        });
        
         return false;
    });
    
        /* button  TC04 * /
    $(document).on("click", ".uib_w_222", function(evt)
    {

     $.ajax({
            type: "GET",
            dataType  : 'html',
            url: "http://localhost/Mairibel/server.php",
            data: "TC=100",
            success: function(data) {
                $('#testID').html(data);
            }
        });
        
        return false;
    });
    
        /* button  TC05 * /
    $(document).on("click", ".uib_w_224", function(evt)
    {

        $.ajax({
            type: "GET",
            dataType  : 'html',
            url: "http://localhost/Mairibel/server.php",
            data: "TC=05",
            success: function(data) {
                $('#testID').html(data);
            }
        });
        
        return false;
    });
    
        /* button  TC06 * /
    $(document).on("click", ".uib_w_226", function(evt)
    {

        $.ajax({
            type: "GET",
            dataType  : 'html',
            url: "http://localhost/Mairibel/server.php",
            data: "TC=06",
            success: function(data) {
                $('#testID').html(data);
            }
        });
        
         return false;
    });
   
        /* button  TC07 * /
    $(document).on("click", ".uib_w_227", function(evt)
    {

        $.ajax({
            type: "GET",
            dataType  : 'html',
            url: "http://localhost/Mairibel/server.php",
            data: "TC=07",
            success: function(data) {
                $('#testID').html(data);
            }
        });
        
         return false;
    });
    
        /* button  TC08 * /
    $(document).on("click", ".uib_w_221", function(evt)
    {

        $.ajax({
            type: "GET",
            dataType  : 'html',
            url: "http://localhost/Mairibel/server.php",
            data: "TC=08",
            success: function(data) {
                $('#testID').html(data);
            }
        });
        
         return false;
    });
    
        /* button  TC09 * /
    $(document).on("click", ".uib_w_228", function(evt)
    {

        $.ajax({
            type: "GET",
            dataType  : 'html',
            url: "http://localhost/Mairibel/server.php",
            data: "TC=09",
            success: function(data) {
                $('#testID').html(data);
            }
        });
        
         return false;
    });
    
        /* button  Button00 * /
    $(document).on("click", ".uib_w_231", function(evt)
    {
         activate_page("#mainpage"); 
         return false;
    });
    
        /* button  0909Button * /
    $(document).on("click", ".uib_w_244", function(evt)
    {
         activate_page("#start"); 
         return false;
    });
    
        /* button  88988Button * /
    $(document).on("click", ".uib_w_245", function(evt)
    {
         activate_page("#mainpage"); 
         return false;
    });
    
        /* button  Meus pedidos * /
    $(document).on("click", ".uib_w_95", function(evt)
    {
         activate_page("#meuspedidos"); 
         return false;
    });
    
        /* button  00099Button * /
    $(document).on("click", ".uib_w_246", function(evt)
    {
         activate_page("#mainpage"); 
         return false;
    });
    
        /* button  Button1 * /
    $(document).on("click", ".uib_w_241", function(evt)
    {
        return false;
    });
    
    /* button  categorias * /
    $(document).on("click", ".uib_w_250", function(evt)
    {

     $.ajax({
            type: "GET",
            dataType  : 'html',
            url: "http://localhost/Mairibel/server.php",
            data: "TC=102",
            success: function(data) {
                $('#testID').html(data);
            }
        });
        
        return false;
    });
    
    /* button  pedidos * /
    $(document).on("click", ".uib_w_249", function(evt)
    {

     $.ajax({
            type: "GET",
            dataType  : 'html',
            url: "http://localhost/Mairibel/server.php",
            data: "TC=103",
            success: function(data) {
                $('#testID').html(data);
            }
        });
        
        return false;
    });
        
    /* button  Fazer pedido * /
    $(document).on("click", ".uib_w_94", function(evt)
    {
         return false;
    });
    
    /* button  Fazer pedido * /
    $(document).on("click", ".uib_w_94", function(evt)
    {
         activate_page("#fazerpedido"); 
         return false;
    });
    
        /* button  aaa * /
    $(document).on("click", ".uib_w_130", function(evt)
    {
         activate_page("#aaa"); 
         return false;
    });
*/
     
     

        

     
/*
    $(document).on("click", "#StartFooterHomeID ", function(evt)
    {
         activate_page("#mainpage"); 
         return false;
    });   
*/

    $(document).on("click", "#ProdutoDetalheFooterHomeID ", function(evt)
    {
         activate_page("#mainpage"); 
         return false;
    });     

    $(document).on("click", "#ProdutoDetalheFooterBackID  ", function(evt)
    {
         activate_page("#produtoCuidadoCorporal"); 
         return false;
    });     
/*
    $(document).on("click", "#MeusPedidosFooterHomeID  ", function(evt)
    {
         activate_page("#mainpage"); 
         return false;
    });     

    $(document).on("click", "#MeusPedidosFooterBackID   ", function(evt)
    {
         activate_page("#start"); 
         return false;
    });     

    $(document).on("click", "#ButtonFazerPedidoAmostraID      ", function(evt)
    {
         activate_page("#escolheramostra"); 
         return false;
    });     

    $(document).on("click", "#ButtonFazerPedidoPropagandaID      ", function(evt)
    {
         activate_page("#escolherpropaganda"); 
         return false;
    });     
     
    $(document).on("click", "#ClienteNovoFooterBackID      ", function(evt)
    {
         activate_page("#cadastrarcliente"); 
         return false;
    });     

    $(document).on("click", "#ButtonEscolherProdutoCuidadoCorporalID      ", function(evt)
    {
         $.ajax({
            type: "GET",
            dataType  : 'html',
            url: "http://localhost/Mairibel/server.php",
            data: "TC=999",
            success: function(data) {
                $('#CCTestID').html(data);
            }
        });
 
         activate_page("#produtoCuidadoCorporal"); 
         return false;
    });     
     
    $(document).on("click", "#ButtonEscolherProdutoLinhaProfiID      ", function(evt)
    {
         $.ajax({
            type: "GET",
            dataType  : 'html',
            url: "http://localhost/Mairibel/server.php",
            data: "TC=998",
            success: function(data) {
                $('#LPTestID').html(data);
            }
        });
 
         activate_page("#produtoLinhaProfissional"); 
         return false;
    });     
    
    $(document).on("click", "#ButtonEscolherProdutoLinhaManuID      ", function(evt)
    {
         $.ajax({
            type: "GET",
            dataType  : 'html',
            url: "http://localhost/Mairibel/server.php",
            data: "TC=997",
            success: function(data) {
                $('#LMTestID').html(data);
            }
        });
 
         activate_page("#produtoLinhaManutencao"); 
         return false;
    });  
   
    $(document).on("click", "#ButtonStartMenu", function(evt)
    {    
         uib_sb.toggle_sidebar($("#LeftSideMenu"));  
         return false;
    });
*/  
    

    /*========================================================================*/
    /* mainpage */
    /*========================================================================*/

    $(document).on("click", "#ButtonMainAAAID", function(evt)
    {
         activate_page("#aaa"); 
         return false;
    });
     
    $(document).on("click", "#ButtonMainContatoID", function(evt)
    {
        alert('AAAAAAAAA22222222222');
        return false;
    });
     
    $(document).on("click", "#ButtonMainLoginID", function(evt)
    {
         activate_page("#login"); 
         return false;
    });
       
    $(document).on("click", "#ButtonMainMenu", function(evt)
    {
         uib_sb.toggle_sidebar($("#LeftSideMenu"));  
         return false;
    });

    $(document).on("click", "#LeftSideMenuClose", function(evt)
    {
         /*global uib_sb */
         /* Other possible functions are: 
           uib_sb.open_sidebar($sb)
           uib_sb.close_sidebar($sb)
           uib_sb.toggle_sidebar($sb)
            uib_sb.close_all_sidebars()
          See js/sidebar.js for the full sidebar API */
        
         uib_sb.toggle_sidebar($("#LeftSideMenu"));  
         return false;
    });
     
    /*========================================================================*/
    /* login  */
    /*========================================================================*/
    $(document).on("click", "#ButtonLoginLoginID", function(evt)
    {
        var inputNome  = $("#loginNomeID").val();
        var inputSenha = $("#loginSenhaID").val();
        var returnValue;

        $.ajax({
            type: "GET",
            //type: "POST",
            dataType  : 'html',
            //dataType  : 'json',
            url: "http://localhost/Mairibel/server.php",
            data:{
                "TC":101,
                "nome":inputNome,
                "senha":inputSenha
            },
            success: function(data) {
                loginCheck (data);
            }
        }); 
        
        return false;
    });
     
    function loginCheck(status) {
        var result = status.substring(0, 2);
         if (result === "OK") {
             //alert('OK');
             activate_page("#start"); 
         }
         else {
             alert('NOK');
             //alert(status);
         }   
     }
     
    $(document).on("click", "#LoginFooterBackID", function(evt)
    {
         activate_page("#mainpage"); 
         return false;
    });  

    $(document).on("click", "#LoginFooterGOTOID", function(evt)
    {
         activate_page("#aaa"); 
         return false;
    });     

    $(document).on("click", "#LoginFooterGOTOID    ", function(evt)
    {
     activate_page("#start"); 
     return false;
    });  
     
     
    /*========================================================================*/
    /* start screen */
    /*========================================================================*/

    $(document).on("click", "#StartScreenBtn1", function(evt)
    {
         activate_page("#fazerpedido"); 
         return false;
    });
     
    $(document).on("click", "#StartScreenBtn2", function(evt)
    {
         activate_page("#cadastrarcliente"); 
         return false;
    });
     
    $(document).on("click", "#StartScreenBtn3", function(evt)
    {
         activate_page("#meuspedidos"); 
         return false;
    });
     
    $(document).on("click", "#ScreenFooterBtn1", function(evt)
    {
         activate_page("#"); 
         return false;
    });
     
    $(document).on("click", "#ScreenFooterBtn2", function(evt)
    {
         uib_sb.toggle_sidebar($("#LeftSideMenuStart"));  
         return false;
    });
     
    $(document).on("click", "#ScreenFooterBtn3", function(evt)
    {
         activate_page("#mainpage"); 
         return false;
    });
   
    $(document).on("click", "#LeftSideMenuStartClose", function(evt)
    {
         uib_sb.toggle_sidebar($("#LeftSideMenuStart"));  
         return false;
    });
     
     
    $(document).on("click", "#LeftSideMenuStartSobre", function(evt)
    {
         activate_page("#about"); 
         return false;
    });
     
    /*========================================================================*/
    /* fazer pedido */
    /*========================================================================*/
    $(document).on("click", "#FazerPedidoScreenBtn1", function(evt)
    {
         activate_page("#escolherproduto"); 
         return false;
    }); 
     
    $(document).on("click", "#FazerPedidoScreenBtn2", function(evt)
    {
         activate_page("#escolheramostra"); 
         return false;
    }); 

    $(document).on("click", "#FazerPedidoScreenBtn3", function(evt)
    {
         activate_page("#escolherpropaganda"); 
         return false;
    }); 
        
    $(document).on("click", "#FazerPedidoFooterBtn1", function(evt)
    {
         activate_page("#start"); 
         return false;
    });     
    $(document).on("click", "#FazerPedidoFooterBtn2", function(evt)
    {
         activate_page("#"); 
         return false;
    });     
    $(document).on("click", "#FazerPedidoFooterBtn3", function(evt)
    {
         activate_page("#mainpage"); 
         return false;
    });     

    $(document).on("click", "#FazerPedidoFooterBackID", function(evt)
    {
         activate_page("#start"); 
         return false;
    });     

    /*========================================================================*/
    /* cadastrar cliente */
    /*========================================================================*/   
    $(document).on("click", "#CadastrarClienteScreenBtn1", function(evt)
    {
         activate_page("#meusclientes"); 
         return false;
    });  
     
    $(document).on("click", "#CadastrarClienteScreenBtn2", function(evt)
    {
         activate_page("#cadastrarclientenovo"); 
         return false;
    });  
     
    $(document).on("click", "#CadastrarClienteFooterBtn1", function(evt)
    {
         activate_page("#start"); 
         return false;
    });  
     
    $(document).on("click", "#CadastrarClienteFooterBtn2", function(evt)
    {
         activate_page("#"); 
         return false;
    });
     
    $(document).on("click", "#CadastrarClienteFooterBtn3", function(evt)
    {
         activate_page("#mainpage"); 
         return false;
    });     
     

    /*========================================================================*/
    /* meus pedidos */
    /*========================================================================*/
    $(document).on("click", "#MeusPedidosFooterBtn1", function(evt)
    {
         activate_page("#start"); 
         return false;
    }); 
     
    $(document).on("click", "#MeusPedidosFooterBtn2", function(evt)
    {
         activate_page("#"); 
         return false;
    });   
     
    $(document).on("click", "#MeusPedidosFooterBtn3", function(evt)
    {
         activate_page("#mainpage"); 
         return false;
    });     

    /*========================================================================*/
    /* escolher produto */
    /*========================================================================*/
     
    $(document).on("click", "#EscolherProdutoScreenBtn1", function(evt)
    {  
        
       $.ajax({
            type: "GET",
            //type: "POST",
            dataType  : 'html',
            //dataType  : 'json',
            url: "http://localhost/Mairibel/server.php",
            data:{
                "TC":999
            },
            success: function(data) {
                //alert(data);
                displayCC (data);
            }
        }); 
      
        return false;
    });
    
    function displayCC(data) {
        $("#CCdisplay").html(data);
        activate_page("#produtoCuidadoCorporal"); 
    }
    
     
    $(document).on("click", "#EscolherProdutoScreenBtn2", function(evt)
    {
       $.ajax({
            type: "GET",
            //type: "POST",
            dataType  : 'html',
            //dataType  : 'json',
            url: "http://localhost/Mairibel/server.php",
            data:{
                "TC":998
            },
            success: function(data) {
                //alert(data);
                displayLP (data);
            }
        }); 
      
        return false;
    });
    
    function displayLP(data) {
        $("#LPdisplay").html(data);
        activate_page("#produtoLinhaProfissional"); 
    }        
          
     
    $(document).on("click", "#EscolherProdutoScreenBtn3", function(evt)
    {
        
       $.ajax({
            type: "GET",
            //type: "POST",
            dataType  : 'html',
            //dataType  : 'json',
            url: "http://localhost/Mairibel/server.php",
            data:{
                "TC":997
            },
            success: function(data) {
                //alert(data);
                displayLM (data);
            }
        }); 
      
        return false;
    });
    
    function displayLM(data) {
        $("#LMdisplay").html(data);
        activate_page("#produtoLinhaManutencao"); 
    }        
        
        
     
    $(document).on("click", "#EscolherProdutoFooterBtn1", function(evt)
    {
         activate_page("#fazerpedido"); 
         return false;
    });     

    $(document).on("click", "#EscolherProdutoFooterBtn2", function(evt)
    {
         activate_page("#"); 
         return false;
    });     

    $(document).on("click", "#EscolherProdutoFooterBtn3", function(evt)
    {
         activate_page("#mainpage"); 
         return false;
    });     
     
    /*========================================================================*/
    /* cadastrar cliente novo */
    /*========================================================================*/

    $(document).on("click", "#CadastrarClienteNovoFooterBtn1", function(evt)
    {
         activate_page("#cadastrarcliente"); 
         return false;
    });     

    $(document).on("click", "#CadastrarClienteNovoFooterBtn2", function(evt)
    {
         activate_page("#"); 
         return false;
    });     

    $(document).on("click", "#CadastrarClienteNovoFooterBtn3", function(evt)
    {
         activate_page("#mainpage"); 
         return false;
    });     
     
    /*========================================================================*/
    /* escolher propaganda */
    /*========================================================================*/

    $(document).on("click", "#EscolherPropagandaFooterBtn1", function(evt)
    {
         activate_page("#fazerpedido"); 
         return false;
    });     

    $(document).on("click", "#EscolherPropagandaFooterBtn2", function(evt)
    {
         activate_page("#"); 
         return false;
    });     

    $(document).on("click", "#EscolherPropagandaFooterBtn3", function(evt)
    {
         activate_page("#mainpage"); 
         return false;
    });     
     
    /*========================================================================*/
    /* escolher amostra */
    /*========================================================================*/
     
    $(document).on("click", "#EscolherAmostraFooterBtn1", function(evt)
    {
         activate_page("#fazerpedido"); 
         return false;
    });     
     
    $(document).on("click", "#EscolherAmostraFooterBtn2", function(evt)
    {
         activate_page("#"); 
         return false;
    });     
     
    $(document).on("click", "#EscolherAmostraFooterBtn3", function(evt)
    {
         activate_page("#mainpage"); 
         return false;
    });     
     
    /*========================================================================*/
    /* produto linha manutenção */
    /*========================================================================*/

    $(document).on("click", "#LinhaManutencaoFooterBtn1", function(evt)
    {
         activate_page("#escolherproduto"); 
         return false;
    });     

    $(document).on("click", "#LinhaManutencaoFooterBtn2", function(evt)
    {
         activate_page("#"); 
         return false;
    });     

    $(document).on("click", "#LinhaManutencaoFooterBtn3", function(evt)
    {
         activate_page("#mainpage"); 
         return false;
    });     
     
    /*========================================================================*/
    /* produto linha profissional */
    /*========================================================================*/

    $(document).on("click", "#LinhaProfissionalFooterBtn1", function(evt)
    {
         activate_page("#escolherproduto"); 
         return false;
    });     

    $(document).on("click", "#LinhaProfissionalFooterBtn2", function(evt)
    {
         activate_page("#"); 
         return false;
    });     

    $(document).on("click", "#LinhaProfissionalFooterBtn3", function(evt)
    {
         activate_page("#mainpage"); 
         return false;
    });     
     
    /*========================================================================*/
    /* produto cuidado corporal */
    /*========================================================================*/

    $(document).on("click", "#CuidadoCorporalFooterBtn1", function(evt)
    {
         activate_page("#escolherproduto"); 
         return false;
    });     

    $(document).on("click", "#CuidadoCorporalFooterBtn2", function(evt)
    {
         activate_page("#"); 
         return false;
    });     

    $(document).on("click", "#CuidadoCorporalFooterBtn3", function(evt)
    {
         activate_page("#mainpage"); 
         return false;
    });     
     
    /*========================================================================*/
    /* meus clientes */
    /*========================================================================*/

    $(document).on("click", "#MeusClientesFooterBtn1", function(evt)
    {
         activate_page("#cadastrarcliente"); 
         return false;
    });     

    $(document).on("click", "#MeusClientesFooterBtn2", function(evt)
    {
         activate_page("#"); 
         return false;
    });     

    $(document).on("click", "#MeusClientesFooterBtn3", function(evt)
    {
         activate_page("#mainpage"); 
         return false;
    });     
     
    /*========================================================================*/
    /* produto detalhe */
    /*========================================================================*/

    $(document).on("click", "#ProdutoDetalheFooterBtn1", function(evt)
    {
         activate_page("#"); 
         return false;
    });     

    $(document).on("click", "#ProdutoDetalheFooterBtn2", function(evt)
    {
         activate_page("#"); 
         return false;
    });     

    $(document).on("click", "#ProdutoDetalheFooterBtn3", function(evt)
    {
         activate_page("#mainpage"); 
         return false;
    });     
     
/*========================================================================*/         
 
    /*=====================================================================*/
    /* aaa */
    /*=====================================================================*/
    $(document).on("click", "#ScreenBBtn1", function(evt)
    {

        $.ajax({
            type: "GET",
            dataType  : 'html',
            url: "http://localhost/Mairibel/server.php",
            data:{
                "TC":999
            },
            success: function(data) {
                $('#a000testID').html(data);
            }
        }); 
        
        return false;
    });  
     
    /* ==================================================================== */ 
     
     
}
    
 document.addEventListener("app.Ready", register_event_handlers, false);
})();

