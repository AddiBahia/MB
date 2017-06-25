<?php

//	$imagePath = "http://localhost/Mairibel/imgprod/";
	$imagePath     = "http://mairibel.com.br/up/img/";
  	$pathDownload  = "http://mairibel.com.br/app/images/downloads";
   
  
function openDatabase() {
  //Mairibel Homepage:  
  //  $dsn = "mysql:host=mairibel2017.mysql.dbaas.com.br;dbname=mairibel2017;charset=utf8";
  $dsn = "mysql:host=mairibel2017.mysql.dbaas.com.br;dbname=mairibel2017;charset=latin1";
  $username = "mairibel2017";
  $password = "jesus777";
  
 
  $opc = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES LATIN1'  //    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
  );
  $conn = new PDO($dsn, $username, $password, $opc);	

  return $conn;
}	

function getTotalPrice($pedidoId) {
    
    $TotalPrice = 0;
    $TotalPriceRounded = 0;
    $conn2 = openDatabase();	
    
    $SQL = "SELECT produto_preco, produto_quantidade FROM pedidos WHERE id_pedido=".$pedidoId." ";

    $user2 = $conn2->prepare($SQL);
    $user2->execute();
    $state2 = $user2->fetchAll(PDO::FETCH_ASSOC);

    foreach($state2 as $statelist)
    {
	  $valor      = $statelist['produto_preco'];
	  $quantidade = $statelist['produto_quantidade'];    
      $TotalPrice = $TotalPrice + $valor * $quantidade;
    }
    $TotalPriceRounded = sprintf('%0.2f', $TotalPrice);
    
    return $TotalPriceRounded;    
}

function getKitProduct(&$output, $idNo, $productID) {
 
	$imagePath     = "http://mairibel.com.br/up/img/";
    
    $output .="<style> @font-face { font-family: 'Oswald'; src: url('fonts/oswald-demibold-webfont.ttf') format('truetype'); }</style>";
    $output .="	<style>#nomeID{	font-family: Oswald, Georgia, Serif; text-align:center; font-size:1.5em; margin-top:2px;}</style>";
    $output .="	<style>#refID{ font-family: Oswald, Georgia, Serif; color:#333333; font-size:2.0em; margin-left:0.3em; }</style>";  
    $output .="	<style>#valor001ID{ font-family: Oswald, Georgia, Serif; color:#FF0000; font-size:2.3em;}</style>";  
    $output .="	<style>#valorTotal001ID{ font-family: Oswald, Georgia, Serif; color:#FF0000; font-size:1.5em;}</style>";  
    $output .="	<style>#vID{ font-family: Oswald, Georgia, Serif; color:#333333; font-size:1.5em;}</style>"; 
    $output .="	<style>.ButtonClass1{ width:100%; margin-left:0%; margin-bottom:20px; padding-top:1.0em; padding-bottom:1.0em; background-color:#999999; color:#EEEEEE; text-align:center;}</style>"; 
         

    $conn = openDatabase();	
       
    $SQL = "SELECT id, nome, referencia, valor, imagem1 FROM revendedores_produtos WHERE referencia=".$productID." ";
    $user = $conn->prepare($SQL);
    $user->execute();
    $state = $user->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($state as $statelist)
    {
      $idNo       = $statelist['id'];
      $prodName   = $statelist['nome'];
      $imagem     = $statelist['imagem1'];  
      $referencia = $statelist['referencia'];  
      $valor      = $statelist['valor'];  
    }
    
    $output .= "<tr class='trClass' style='width:100%;'>";
    $output .= "  <td class='tdClass'>";
    $output .= "    <img class='imgClass' src='".$imagePath.$imagem."' />";
    $output .= "  </td>";
    $output .= "  <td>";
    $output .= "     <p style='margin-left:5px; font-size:14px; font-weight: bold;; color:#666666; margin-top:0px; margin-bottom:0px; padding-top:0px; padding-bottom:0px;'>".$prodName."</p>";
    $output .= "  </td>";
    $output .= "  <td>";
    $output .= "    <h5 style='margin-left:5px; font-size:14px; color: #0000FF;'> R$ ".$valor."</h5>";
    $output .= "  </td>";
    $output .= "  <td style='border-right: 1px solid #666666;'>";
    $output .= "  </td>";
    $output .= "  <td style='text-align:center'>";
    $output .= " ".$referencia." ";
    $output .= "  </td>";
    $output .= "</tr>";      
    
    return $valor;
    
}

function insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade ) {
        
    
    $SQL = "SELECT  nome 
    FROM revendedores_produtos 
    WHERE referencia =".$referencia." ";
      
	$user3 = $conn->prepare($SQL);
    $user3->execute();
    $state = $user3->fetchAll(PDO::FETCH_ASSOC);

    foreach($state as $statelist)
	{
	  $produtoNome = $statelist['nome'];  
    }
    
    
    $SQL = "INSERT INTO `pedidos` (`id_pedido`, `id_revendedor`, `id_produto`, `produto_nome`, `produto_preco`, `preco_total`,  `produto_quantidade`, `status`, `observacao`, `dt`) 
    VALUES ('$pedidoID', '$revendedor', '$referencia', '$produtoNome', '$valor', '$valorTotal', '$quantidade', '1', ' ', now() )";
                
    $user2 = $conn->prepare($SQL);        
    if ($user2->execute()) { 
        $success = true;
    }        
    $state = $user2->fetchAll(PDO::FETCH_ASSOC);

    {
        $phpmail->Body .= "Produto: ".$produtoNome."<br>";
        $phpmail->Body .= "ID: ".$referencia."<br>";
        $phpmail->Body .= "Preço: R$".$valor."<br>";
        $phpmail->Body .= "Quantidade: ".$quantidade."<br><hr>";
    } // temp. EMail 
    
    return;
}

/*========================================================================================*/

  $action = $_GET['TC']; // get TC number ..
  /* ================================================================= */
  /* begin of server                                                   */
  /*                                                                   */

  if($action == '123456'){  
      ;
  }
  /* ================================================================= */
  else if($action == '101'){  
      
    // TC= 101 : login 'user
    $nome  = $_GET['nome'];  // get 'username' & 'password' from request
    $senha = $_GET['senha']; // get 'password' for 'user' from database 'MB'
      
    // get password from database ..
      
    $conn = openDatabase();	
    $output = '';  
//    $SQL = "SELECT senha FROM revendedores WHERE nome='".$nome."'";
    $SQL = "SELECT senha FROM revendedores WHERE codigo='".$nome."'";

    $user = $conn->prepare($SQL);
    $user->execute();
    $state = $user->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($state as $statelist)
    {
      $senhaDB = $statelist['senha'];
    }
	
	//  if 'password OK' send 'OK' 
    //  else send 'NOK'	
    if ($senhaDB == $senha)
	  echo "OK";
    else
	  echo "NOK";

  }   /* login */

  else if($action == '999104'){  
	 
    $output = '';  
      
    $conn = openDatabase();	
    $SQL = "SELECT id, nome FROM revendedores_subcategorias WHERE categoria=1";
    $user = $conn->prepare($SQL);
    $user->execute();
    $state = $user->fetchAll(PDO::FETCH_ASSOC);

	$output .= "<table style='width:100%;' id='accTable1'>";
	$output .= "<style>";
	$output .= ".trClass{border-bottom: 1px solid #CCCCCC; background-color: #f3f3f3;}";
	$output .= ".tdClass{border-right:1px solid #666666; width:10%;}";
	$output .= "</style>";
    
    foreach($state as $statelist)
    {
	  $id = $statelist['id'];
	  $nome = $statelist['nome'];  
	 
	  $output .= "<tr class='trClass'>";  
	  $output .= "  <td style='width:85%;'>";
      $output .= "    <h5 style='margin-left:5px; font-size:14px; color: #333333;'>".$nome."</h5>";
	  $output .= "  </td>";
	  $output .= "  <td style='width:10%; text-align:center;'>";
      $output .= "<img src='http://mairibel.com.br/app/images/icons/right-arrow.png' style='width:60%;' />";
	  $output .= "  </td>";
	  $output .= "  <td style='width:5%; display:none;'>";
      $output .= " ".$id." ";
	  $output .= "  </td>";
	  $output .= "</tr>";
    }			
	$output .= "</table>"; 
    $output .=	'';
	
    echo $output;	  
  }     /* get all 'subcategorias' for Mairibel  */

  else if($action == '999105'){  
	 
    $conn = openDatabase();	
    $output = '';  
    $SQL = "SELECT id, nome FROM revendedores_subcategorias WHERE categoria=2";

	    $user = $conn->prepare($SQL);
    $user->execute();
    $state = $user->fetchAll(PDO::FETCH_ASSOC);

	$output .= "<table style='width:100%;' id='accTable2'>";
	$output .= "<style>";
	$output .= ".trClass{border-bottom: 1px solid #CCCCCC; background-color: #f3f3f3; margin:0; padding:0;}";
	$output .= ".tdClass{border-right:1px solid #666666; width:10%;}";
	$output .= "</style>";
    
    foreach($state as $statelist)
    {
	  $id = $statelist['id'];
	  $nome = $statelist['nome'];  
	 
	  $output .= "<tr class='trClass'>";  
	  $output .= "  <td style='width:85%;'>";
      $output .= "    <h5 style='margin-left:5px; font-size:14px; color: #333333;'>".$nome."</h5>";
	  $output .= "  </td>";
	  $output .= "  <td style='width:10%; text-align:center;'>";
      $output .= "<img src='http://mairibel.com.br/app/images/icons/right-arrow.png' style='width:60%;' />";
	  $output .= "  </td>";
	  $output .= "  <td style='width:5%; display:none;'>";
      $output .= " ".$id." ";
	  $output .= "  </td>";
	  $output .= "</tr>";
    }			
	$output .= "</table>"; 
    $output .=	'';
	
    echo $output;	  
  }     /* get all 'subcategorias' for HidratyCollor */

  else if($action == '999109'){
	global $imagePath;
	
    $idNo  = $_GET['idNo'];  

    $output = '';  

    $conn = openDatabase();	
    $SQL = "SELECT id, nome, referencia, valor, imagem1 FROM revendedores_produtos WHERE categoria=1 AND subcategoria=".$idNo." ";
    $user = $conn->prepare($SQL);
    $user->execute();
    $state = $user->fetchAll(PDO::FETCH_ASSOC);

      
    if($idNo != 6) {
          
        $output .= "<table style='width:100%; margin-top:25px;' id='selectedMBCategory'>";
        $output .= "<style>";
        $output .= ".trClass{border: 1px solid #999999; background-color: #f3f3f3;}";
        $output .= ".tdClass{border-right:1px solid #666666; width:10%;}";
        $output .= ".imgClass{width:80%; margin-top:1px; margin-left:10%;}";
        $output .= "</style>";
        
        $output .= "<tr class='trClass' style='width:100%;'>";
        $output .= "  <td style='width:10%;'></td>";
        $output .= "  <td style='width:60%; padding-top:5px; padding-bottom:5px;'>Produto</td>";
        $output .= "  <td style='width:20%; padding-top:5px; padding-bottom:5px;'>Valor</td>";
        $output .= "  <td style='width:0%;'> </td>";
        $output .= "  <td style='width:10%;'></td>";
        $output .= "</tr>";
        
        foreach($state as $statelist)
        {
              $idNo       = $statelist['id'];
              $prodName   = $statelist['nome'];
              $imagem     = $statelist['imagem1'];  
              $referencia = $statelist['referencia'];  
              $valor      = $statelist['valor'];  

              $output .= "<tr class='trClass' style='width:100%;'>";
              $output .= "  <td class='tdClass'><img class='imgClass' src='".$imagePath.$imagem."' />";
              $output .= "  </td>";
	  
              $output .= "  <td>";
              $output .= "     <p style='margin-left:5px; font-size:14px; font-weight: bold;; color:#666666; margin-top:0px; margin-bottom:0px; padding-top:0px; padding-bottom:0px;'>".$prodName."</p>";
              $output .= "  </td>";

              $output .= "  <td>";
              $output .= "    <h5 style='margin-left:5px; font-size:14px; color: #0000FF;'> R$ ".$valor."</h5>";
              $output .= "  </td>";

              $output .= "  <td style='border-right: 1px solid #666666;'>";
              $output .= "  </td>";

              $output .= "  <td style='text-align:center'>";
              $output .= " ".$referencia." ";
              $output .= "  </td>";

              $output .= "</tr>";
        }			
        $output .= "</br>";
        $output .= "</table>"; 
        $output .=	'';
    }  /* all categories, except 'Kits' */
    else {
        echo '<br><br>';
    
        $output .= "<table style='width:100%; margin-top:25px;' id='selectedMBCategoryKits'>";
        $output .= "<style>";
        $output .= ".imgClass{width:80%; margin-top:1px; margin-left:10%;}";
        $output .= ".tableCatKit{width:100%; background-color:#FAFAFA;}";
        $output .= ".tdKitNo1{width:5%; text-align:center;}";
        $output .= ".tdKitNo2{width:85%; padding-top:0.5em; padding-bottom:0.5em; padding-left:0.5em;}";
        $output .= ".tdKitNo3{width:10%;}";
        $output .= "</style>";

        /*
        01. Kit Alisamento com Amônia:                  itens: cod 984 - 1037 - 1814-  1696
        02. Kit Cauterização Capilar:                   Itens cod: 072 - 071 - 075 - 073 - 055
        03. Kit Permanente Afro:                        Itens Cod: 1696 - 1684 - 1685 - 1686
        04. Kit Relaxamento de Guanidina Grande:        Itens cod: 088 - 519 - 815 - 092 - 457 - 1001
        05. Kit Relaxamento Guanidina Pequeno:          Itens Cod: 088 - 454 - 452 - 1128 - 090 - 092
        06. Kit Reposição de Aminoacido e Nutrientes:   Itens Cod: 1029 - 1031 - 1030
        07. Kit Tratamento de Choque:                   ítens cod: 885 - 886 - 887
        08. Kit Selante Gold Mairi LIss:                ítens cod: 1232 - 1815 - 1778
        09. Kit Selante Gold Matizador:                 Itens Cod: 1232 - 1233 - 1778
        */
        $output .= "<tr class='tableCatKit'>";
        $output .= "  <td class='tdKitNo1'>1</td>";
        $output .= "  <td class='tdKitNo2'>Kit Alisamento com Amônia</td>";
        $output .= "  <td class='tdKitNo3'>";
        $output .= "    <img src='http://mairibel.com.br/app/images/icons/right-arrow.png' class='imgClass' />";
        $output .= "  </td>";
        $output .= "</tr>";             
    
        $output .= "<tr class='tableCatKit'>";
        $output .= "  <td class='tdKitNo1'>2</td>";
        $output .= "  <td class='tdKitNo2'>Kit Cauterização Capilar</td>";
        $output .= "  <td class='tdKitNo3'>";
        $output .= "    <img src='http://mairibel.com.br/app/images/icons/right-arrow.png' class='imgClass' />";
        $output .= "  </td>";
        $output .= "</tr>";
        
        $output .= "<tr class='tableCatKit'>";
        $output .= "  <td class='tdKitNo1'>3</td>";
        $output .= "  <td class='tdKitNo2'>Kit Permanente Afro</td>";
        $output .= "  <td class='tdKitNo3'>";
        $output .= "    <img src='http://mairibel.com.br/app/images/icons/right-arrow.png' class='imgClass' />";
        $output .= "  </td>";
        $output .= "</tr>";

        $output .= "<tr class='tableCatKit'>";
        $output .= "  <td class='tdKitNo1'>4</td>";
        $output .= "  <td class='tdKitNo2'>Kit Relaxamento de Guanidina Grande</td>";
        $output .= "  <td class='tdKitNo3'>";
        $output .= "    <img src='http://mairibel.com.br/app/images/icons/right-arrow.png' class='imgClass' />";
        $output .= "  </td>";
        $output .= "</tr>";

        $output .= "<tr class='tableCatKit'>";
        $output .= "  <td class='tdKitNo1'>5</td>";
        $output .= "  <td class='tdKitNo2'>Kit Relaxamento Guanidina Pequeno</td>";
        $output .= "  <td class='tdKitNo3'>";
        $output .= "    <img src='http://mairibel.com.br/app/images/icons/right-arrow.png' class='imgClass' />";
        $output .= "  </td>";
        $output .= "</tr>";
        
        $output .= "<tr class='tableCatKit'>";
        $output .= "  <td class='tdKitNo1'>6</td>";
        $output .= "  <td class='tdKitNo2'>Kit Reposição de Aminoacido e Nutrientes</td>";
        $output .= "  <td class='tdKitNo3'>";
        $output .= "    <img src='http://mairibel.com.br/app/images/icons/right-arrow.png' class='imgClass' />";
        $output .= "  </td>";
        $output .= "</tr>";
        
        $output .= "<tr class='tableCatKit'>";
        $output .= "  <td class='tdKitNo1'>7</td>";
        $output .= "  <td class='tdKitNo2'>Kit Tratamento de Choque</td>";
        $output .= "  <td class='tdKitNo3'>";
        $output .= "    <img src='http://mairibel.com.br/app/images/icons/right-arrow.png' class='imgClass' />";
        $output .= "  </td>";
        $output .= "</tr>";
        
        $output .= "<tr class='tableCatKit'>";
        $output .= "  <td class='tdKitNo1'>8</td>";
        $output .= "  <td class='tdKitNo2'>Kit Selante Gold Mairi LIss</td>";
        $output .= "  <td class='tdKitNo3'>";
        $output .= "    <img src='http://mairibel.com.br/app/images/icons/right-arrow.png' class='imgClass' />";
        $output .= "  </td>";
        $output .= "</tr>";

        $output .= "<tr class='tableCatKit'>";
        $output .= "  <td class='tdKitNo1'>9</td>";
        $output .= "  <td class='tdKitNo2'>Kit Selante Gold Matizador</td>";
        $output .= "  <td class='tdKitNo3'>";
        $output .= "    <img src='http://mairibel.com.br/app/images/icons/right-arrow.png' class='imgClass' />";
        $output .= "  </td>";
        $output .= "</tr>";

}	/* caregory 'Kits"*/
      
    echo $output;
  }     /* get all 'produtos' for selected subcategory for Mairibel */

  else if($action == '999110'){  
	
    $idNo  = $_GET['idNo'];  
	
    $conn = openDatabase();	
    $output = '';  
    $SQL = "SELECT id, nome, referencia, valor, imagem1 FROM revendedores_produtos WHERE categoria=2 AND subcategoria=".$idNo." ";
	
	$user = $conn->prepare($SQL);
    $user->execute();
    $state = $user->fetchAll(PDO::FETCH_ASSOC);

	$output .= "<table style='width:100%; margin-top:25px;' id='selectedHCCategory'>";
	$output .= "<style>";
	$output .= ".trClass{border: 1px solid #999999; background-color: #f3f3f3;}";
	$output .= ".tdClass{border-right:1px solid #666666; width:10%;}";
	$output .= ".imgClass{width:30%; margin-top:1px; margin-left:35%;}";
	$output .= "</style>";
    
    $output .= "<tr class='trClass' style='width:100%;'>";
    $output .= "  <td style='width:10%;'></td>";
    $output .= "  <td style='width:60%; padding-top:5px; padding-bottom:5px;'>Produto</td>";
    $output .= "  <td style='width:20%; padding-top:5px; padding-bottom:5px;'>Valor</td>";
    $output .= "  <td style='width:0%;'> </td>";
    $output .= "  <td style='width:10%;'></td>";
    $output .= "</tr>";

      
    foreach($state as $statelist)
    {
	  $idNo       = $statelist['id'];
	  $prodName   = $statelist['nome'];
	  $imagem     = $statelist['imagem1'];  
	  $referencia = $statelist['referencia'];  
	  $valor      = $statelist['valor'];  
	  
	  $output .= "<tr class='trClass'>";
	  $output .= '  <td class="tdClass"><img class="imgClass" src="'.$imagePath.$imagem.'" />';
	  $output .= "</td>";
	  
	  $output .= "<td>";
      $output .= "<p style='margin-left:5px; font-size:14px; font-weight: bold;; color:#666666; margin-top:0px; margin-bottom:0px; padding-top:0px; padding-bottom:0px;'>".$prodName."</p>";
      $output .= "</td>";

	  $output .= "<td>";
      $output .= "<h5 style='margin-left:5px; font-size:14px; color: #0000FF;'> R$ ".$valor."</h5>";
	  $output .= "</td>";

	  $output .= "<td style='border-right: 1px solid #666666;'>";
	  $output .= "</td>";
	  
	  $output .= "<td style='text-align:center'>";
      $output .= " ".$referencia." ";
	  $output .= "</td>";
	  $output .= "</tr>";
    }			
	$output .= "</br>";
	$output .= "</table>"; 
    $output .=	'';
	
    echo $output;
  }     /* get all 'products' for selected subcategory for HidratyCollor */

  else if($action == '999112001'){  
    $index = 0;
    $valorTotal = 0;

    $revendedor  = $_GET['revendedor'];        
      
    $conn = openDatabase();	
    $output = ''; 

    $SQL = "SELECT DISTINCT id_pedido FROM pedidos WHERE id_revendedor=".$revendedor." ORDER BY id_pedido DESC";
	
    $user = $conn->prepare($SQL);
    $user->execute();
    $state = $user->fetchAll(PDO::FETCH_ASSOC);

	foreach($state as $statelist)
    {
	  $NoPedido[$index] = $statelist['id_pedido'];  // no of 'pedidos' ..
	  $index = $index+1;
	}
	
	$output .= "<style>";
	$output .= ".headlineFormat0 { margin-left:5px; font-size:1.0em; font-weight: bold; color:#666666; padding-top:10px; padding-bottom:10px; margin-top:50px;}";
	$output .= ".headlineFormat1 { margin-left:5px; font-size:1.0em; font-weight: bold; color:#666666; padding-top:10px; }";
	$output .= "</style>";
      
    $output .= "<div style='background-color:transparent;'>";
    $output .= "  <p class='headlineFormat0' style='background-color:#FCF3F4; color:#000000; text-align:center; width:80%; margin-left:10%; border:5px solid #02FFF8; border-radius: 5px;'>REVENDEDOR: ".$revendedor."</p>";
    $output .= "</div>";
	
	$output .= "<table id='pedidoTable' class='table table-striped table-hover table-condensed well' style='width:98%; margin-left:1%;'>";
	$output .= "  <tr>";
	$output .= "    <td style='width:20%;'>";
    $output .= "      <p class='headlineFormat1'>Pedido</p>";
	$output .= "    </td>";
	$output .= "    <td style='width:40%;'>";
    $output .= "      <p class='headlineFormat1'>Data</p>";
	$output .= "    </td>";
	$output .= "    <td style='width:30%;'>";
    $output .= "      <p class='headlineFormat1'>Valor</p>";
	$output .= "    </td>";
	$output .= "    <td style='width:10%;'>";
    $output .= "      <p class='headlineFormat1'>Status</p>";
	$output .= "    </td>";
	$output .= "  </tr>";
	
    $countPedidos = count($NoPedido);
    for($i=0; $i<$countPedidos; $i++)
    {
	  $index=0;
      $SQL = "SELECT id_pedido, SUM(produto_preco), produto_quantidade, revendedores.nome, status, observacao, dt FROM pedidos FULL JOIN revendedores ON id_revendedor=revendedores.codigo WHERE id_pedido=".$NoPedido[$i]." ";
//$output .= 'SQL: '.$SQL.'<hr>';
        
      $user = $conn->prepare($SQL);
      $user->execute();
      $state = $user->fetchAll(PDO::FETCH_ASSOC);
    
      foreach($state as $statelist)
      {
	    $idPedido   = $statelist['id_pedido'];
	    $data       = $statelist['dt'];

        $dataFormat = substr($data, 8, 2)."/".substr($data, 5, 2)."/".substr($data, 0, 4)." ".substr($data, 11, 2).":".substr($data, 14, 2);

	    $idRevendedor   = $statelist['nome'];
	    $idProdutoPreco = $statelist['SUM(produto_preco)'];
	    $idProdutoPreco =  round($idProdutoPreco , 2);  
	    $quantidade     = $statelist['produto_quantidade'];
	    $observacao     = $statelist['observacao'];
	    $status         = $statelist['status'];
	    
//$output .= 'ped: '.$idPedido.' pr: '.$idProdutoPreco.' qu: '.$quantidade.'<hr>';
//$valorTotal = $idProdutoPreco * $quantidade;
//$valorTotal = number_format( $valorTotal, 2, ",", "." );
$valorTotal = getTotalPrice($NoPedido[$i]);
		           
	    $output .= "  <tr style='border-bottom: 1px solid #CCCCCC; width:100%;'>";
	    $output .= "    <td>";
        $output .= "      <p class='headlineFormat1' style='text-align:center;'>".$idPedido."</p>";
	    $output .= "    </td>";
	    $output .= "    <td>";
//        $output .= "      <p class='headlineFormat1''>".$data."</p>";
        $output .= "      <p class='headlineFormat1''>".$dataFormat."</p>";
	    $output .= "    </td>";
	    $output .= "    <td>";
	    $output .= "      <div class='headlineFormat1'>RS ".$valorTotal."</div>";
	    $output .= "    </td>";
	    $output .= "    <td>";
        
          if ($status==1) {
	        $output .= "<div style='width:70%; margin-left:15%; height:80%; margin-top:10%;'><img src='http://mairibel.com.br/app/images/icons/statusNew.png' style='width:100%;' /></div>";
          }
          elseif ($status==2){
	        $output .= "<div style='width:70%; margin-left:15%; height:80%; margin-top:10%;'><img src='http://mairibel.com.br/app/images/icons/statusVisualizado.png' style='width:100%;' /></div>";              
          }
          elseif ($status==3){
	        $output .= "<div style='width:70%; margin-left:15%; height:80%; margin-top:10%;'><img src='http://mairibel.com.br/app/images/icons/statusAndamento.png' style='width:100%;' /></div>";
          }
          elseif ($status==4){
	        $output .= "<div style='width:70%; margin-left:15%; height:80%; margin-top:10%;'><img src='http://mairibel.com.br/app/images/icons/statusFinalizado.png' style='width:100%;' /></div>";
          }
          elseif ($status==5){
	        $output .= "<div style='width:70%; margin-left:15%; height:80%; margin-top:10%;'><img src='http://mairibel.com.br/app/images/icons/statusSeraEntregue.png' style='width:100%;' /></div>";
          }
          
	    $output .= "    </td>";
	    $output .= "  </tr>";
	    $index = $index+1;
      }
	  //$output .= "</br>";
    }	
	$output .= "</table>"; 
    $output .=	'';
	
    echo $output;
  }  /* get * from  'pedidos'  for mobile */

  else if($action == '999114'){  
	
    $idNo  = $_GET['pedidoId'];  
	
    $conn = openDatabase();	
    $output = '';  
    $SQL = "SELECT id, id_produto,  produto_nome, produto_preco, produto_quantidade, observacao FROM pedidos WHERE id_pedido=".$idNo." ";

	$user = $conn->prepare($SQL);
    $user->execute();
    $state = $user->fetchAll(PDO::FETCH_ASSOC);
    
//	$output .= "<table class='table table-condensed' id='pedidoProdutos' style='background-color:#F0F0F0; width:100%; margin-top:50px;'>";
	$output .= "<table id='pedidoProdutos' style='background-color:#F0F0F0; width:100%; margin-top:50px;'>";
      
    foreach($state as $statelist)
	{
	  $idNo       = $statelist['id'];
	  $produtoId  = $statelist['id_produto'];
	  $nome       = $statelist['produto_nome'];
	  $valor      = $statelist['produto_preco'];
      $valorRounded = sprintf('%0.2f', $valor);
	  $quantidade = $statelist['produto_quantidade'];
	  $observacao = $statelist['observacao'];
	  $valorTotal = $valor*$quantidade;
      $valorTotalRounded = sprintf('%0.2f', $valorTotal);
 
	  $output .= "<tr style='width:100%; background-color:#F0F0F0;'>";
	  $output .= "  <td style='width:100%;'>";
        
      $output .= "    <table style='width:100%;'>";
	  $output .= "      <tr style='width:100%;'>";
	  $output .= "         <td style='width:100%;'>";
	  $output .= "           <p style='font-size:1.0em; font-weight:bold; color:#666666; margin-bottom:3px; padding-bottom:0px; margin-left:10px;'>".$nome."</p>";
	  $output .= "         </td>";
	  $output .= "      </tr>";
	  $output .= "    </table>";
        
      $output .= "    <table style='width:100%;'>";
	  $output .= "      <tr>";
	  $output .= "        <td style='width:20%; border-right:1px solid #999999; margin-bottom:20px;'>";
	  $output .= "          <p style='font-size:1.0em; color:#666666; margin-left:10px;'>unidade</p>";
	  $output .= "        </td>";
	  $output .= "        <td style='width:40%; border-right:1px solid #999999;'>";
	  $output .= "          <p style='font-size:1.0em; color:#666666; margin-left:10px;'>valor</p>";
	  $output .= "        </td>";
	  $output .= "        <td style='width:40%;'>";
	  $output .= "          <p style='font-size:1.0em; color:#666666; margin-left:10px;'>valor total</p>";
	  $output .= "        </td>";
	  $output .= "      </tr>";
	  $output .= "      <tr>";
	  $output .= "        <td style='width:20%; border-right:1px solid #999999;'>";
	  $output .= "          <p style='font-size:1.0em; color:#666666; text-align:center;'>".$quantidade."</p>";
	  $output .= "        </td>";
	  $output .= "        <td style='width:40%; border-right:1px solid #999999;'>";
	  $output .= "          <p style='font-size:1.0em; color:red; font-weight:bold; margin-left:10px;'>R$ ".$valor."</p>";
	  $output .= "        </td>";
	  $output .= "        <td style='width:40%;'>";
	  $output .= "          <p style='font-size:1.0em; color:red; font-weight:bold; margin-left:10px;'>R$ ".$valorTotalRounded."</p>";
	  $output .= "        </td>";
	  $output .= "      </tr>";
      $output .= "    </table>";
	  $output .= "  </td>";
	  $output .= "</tr>";
        
      /*  
	  $output .= "<tr style='width:100%; background-color:#F0F0F0;  margin-bottom:0px; padding-bottom:0px; margin-top:0px; padding-top:0px;'>";
	  $output .= "  <td style='width:100%;'>";
      $output .= "    <table style='width:100%; margin-bottom:0px; padding-bottom:0px; margin-top:0px; padding-top:0px;'>";
	  $output .= "      <tr style='width:100%;'>";
	  $output .= "         <td style='width:100%;'>";
	  $output .= "           <p style='font-size:1.0em; font-weight:bold; color:#666666;'>".$nome."</p>";
	  $output .= "         </td>";
	  $output .= "      </tr>";
	  $output .= "    </table>";
      $output .= "    <table style='width:100%; margin:0; padding:0;'>";
	  $output .= "      <tr style='margin-bottom:0px; padding-bottom:0px;'>";
	  $output .= "        <td style='width:20%; border-right:1px solid #999999;'>";
	  $output .= "          <p style='font-size:1.0em; color:#666666;'>unididade</p>";
	  $output .= "        </td>";
	  $output .= "        <td style='width:40%; border-right:1px solid #999999;'>";
	  $output .= "          <p style='font-size:1.0em; color:#666666; margin-left:10px;'>valor</p>";
	  $output .= "        </td>";
	  $output .= "        <td style='width:40%;'>";
	  $output .= "          <p style='font-size:1.0em; color:#666666; margin-left:10px;'>valor total</p>";
	  $output .= "        </td>";
	  $output .= "      </tr>";
	  $output .= "      <tr style='margin-bottom:0px; padding-bottom:0px;'>";
	  $output .= "        <td style='width:20%; border-right:1px solid #999999;'>";
	  $output .= "          <p style='font-size:1.0em; color:#666666; text-align:center;'>".$quantidade."</p>";
	  $output .= "        </td>";
	  $output .= "        <td style='width:40%; border-right:1px solid #999999;'>";
	  $output .= "          <p style='font-size:1.0em; color:red; font-weight:bold; margin-left:10px;'>R$ ".$valor."</p>";
	  $output .= "        </td>";
	  $output .= "        <td style='width:40%;'>";
	  $output .= "          <p style='font-size:1.0em; color:red; font-weight:bold; margin-left:10px;'>R$ ".$valorTotalRounded."</p>";
	  $output .= "        </td>";
	  $output .= "      </tr>";
      $output .= "    </table>";
	  $output .= "  </td>";
	  $output .= "</tr>";
      */  
        
	  $output .= "<tr>";
	  $output .= "<td style='height:5px; background-color:#FFFFFF;'></td>";
	  $output .= "</tr>";
        
      $index = $index+1;
	}
	
	$output .= "</table>";
	
    echo $output;
  }     /* get details for selected 'pedido' */

  else if($action == '999111'){
	
    $idNo  = $_GET['idNo'];
	
    $conn = openDatabase();
    $output = '';
    $SQL = "SELECT id, nome, referencia, valor, imagem1 FROM revendedores_produtos WHERE referencia=".$idNo." ";
	
	$user = $conn->prepare($SQL);
    $user->execute();
    $state = $user->fetchAll(PDO::FETCH_ASSOC);

    foreach($state as $statelist)
	{
	$idNo       = $statelist['id'];
	$prodName   = $statelist['nome'];
	$imagem     = $statelist['imagem1'];  
	$referencia = $statelist['referencia'];  
	$valor      = $statelist['valor'];  

    $output .="	<style>.h4Clas{	font-family: Oswald, Georgia, Serif;}</style>";
    $output .="	<style>.h2Clas{ font-family: Oswald, Georgia, Serif; color:#FF0000; font-size:70px;}</style>";
    
	$output .= "<div class='row'>";
	$output .= "  <div class='col-lg-12'>";
	$output .= "    <h2 class='h4Clas'>".$prodName."</h2>";
	$output .= "  </div>";
	$output .= "</div>";
	$output .= "<hr>";
	$output .= "<div class='row'>";
	$output .= "  <div class='col-lg-12'>";
	$output .= "    <h2> Código: ".$referencia."</h2>";
	$output .= "  </div>";
	$output .= "</div>";	
	$output .= "<hr>";
	$output .= "<div class='row'>";
	$output .= "  <div class='col-lg-6'>";
	$output .= "    <img style='width:98%; margin-left:1%;' src='http://localhost/Mairibel/imgprod/".$imagem."' />";
	$output .= "  </div>";
	$output .= "  <div class='col-lg-6'>";
	$output .= "    <h2 class='h2Clas'>R$ ".$valor."</h2>";
	$output .= "  </div>";
	$output .= "</div>";
	}
	
    echo $output;
  }     /* get details for selected 'product' */

  else if($action == '999111001'){
      
	global $imagePath;
	
    $idNo  = $_GET['idNo'];  
	
    $conn = openDatabase();	
    $output = '';  
    $SQL = "SELECT id, nome, referencia, valor, imagem1 FROM revendedores_produtos WHERE referencia=".$idNo." ";
	
	$user = $conn->prepare($SQL);
    $user->execute();
    $state = $user->fetchAll(PDO::FETCH_ASSOC);

    foreach($state as $statelist)
	{
	$idNo       = $statelist['id'];
	$prodName   = $statelist['nome'];
	$imagem     = $statelist['imagem1'];  
	$referencia = $statelist['referencia'];
	$valor      = $statelist['valor'];

    $output .="<style> @font-face { font-family: 'Oswald'; src: url('fonts/oswald-demibold-webfont.ttf') format('truetype'); }</style>";
        
    $output .="	<style>#nomeID{	font-family: Oswald, Georgia, Serif; text-align:center; font-size:1.5em; margin-top:20px;}</style>";
    $output .="	<style>#refID{ font-family: Oswald, Georgia, Serif; color:#333333; font-size:2.0em;}</style>";  
    $output .="	<style>#valor001ID{ font-family: Oswald, Georgia, Serif; color:#FF0000; font-size:2.5em;}</style>";  
    $output .="	<style>#valorTotal001ID{ font-family: Oswald, Georgia, Serif; color:#FF0000; font-size:1.5em;}</style>";  
    $output .="	<style>#vID{ font-family: Oswald, Georgia, Serif; color:#333333; font-size:1.5em;}</style>"; 
        
    $output .="	<style>.ButtonClass1{ width:100%; margin-left:0%; margin-bottom:20px; padding-top:1.0em; padding-bottom:1.0em; background-color:#999999; color:#EEEEEE; text-align:center;}</style>"; 
        
	$output .= "<div class='container' style='background-color:#FFFFFF; margin-top:50px;' width:96%; margin-left:2%;>";
	$output .= "  <div class='row'>";
	$output .= "    <div class='col-lg-12'>";
	$output .= "      <p id='nomeID'>".$prodName."</p>";
	$output .= "    </div>";
	$output .= "  </div>";	
	$output .= "  <hr>";
        
    $output .= "  <div class='row'>";
	$output .= "    <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>";
	$output .= "      <div class='row'>";        
    $output .= "        <div class='col-xs-6'>";
    $output .= "          <input class='form-control' type='text' value='0' id='countDetail001ID' style='margin-right:0px;'>";
    $output .= "        </div>";
    $output .= "        <div class='col-xs-6'>";
    $output .= "          <label for='example-text-input' class='col-2 col-form-label' style='text-align:left; margin-top:5px;'>und.</label>";
    $output .= "        </div>";
    $output .= "      </div>";    
	$output .= "    </div>";
	$output .= "    <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>";
	$output .= "      <p id='valorTotal001ID'>Total: R$ 0.00</p>";
	$output .= "    </div>";
	$output .= "  </div>";
	$output .= "  <hr>";
     
	$output .= "  <div class='row'>";
	$output .= "    <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>";
	$output .= "      <img style='width:80%;' src=".$imagePath.$imagem." />";
	$output .= "    </div>";
	$output .= "    <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>";
	$output .= "       <div class='row'>";
	$output .= "         <p id='refID'> Código: ".$referencia."</p>";
	$output .= "       </div>";
	$output .= "       <div class='row'>";
	$output .= "         <p id='valor001ID'>R$ ".$valor."</p>";
	$output .= "       </div>";
	$output .= "    </div>";
	$output .= "  </div>";	
    
	$output .= "  <br>";
	$output .= "  <div class='row'>";
	$output .= "    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>";
	$output .= "    </div>";
	$output .= "    <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>";
    $output .= "<a href='#'><p id='produtoPedirID'><img src='http://mairibel.com.br/app/images/icons/MBButtonsPedir.png' style='width:100%; height:4.0em;' ></p></a>";
        
	$output .= "    </div>";
	$output .= "    <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>";
    $output .= "<a href='#'><p id='produtoFecharID'><img src='http://mairibel.com.br/app/images/icons/MBButtonsFechar.png' style='width:100%; height:4.0em;' ></p></a>";
	$output .= "    </div>";
	$output .= "    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>";
	$output .= "    </div>";
	$output .= "  </div>";
	$output .= "</div>";
	}
	
    echo $output;
  }  /* get details for selected 'product' for mobile */

  else if($action == '999115'){
      {
/**/
$SMTPHost     = "email-ssl.com.br";
$SMTPPort     = 465;
$SMTPUsername = "sendEMail@mairibel.com.br";
$SMTPPassword = "loc@1020";
$emailContato = "contato@mairibel.com.br";
$emailPedido  = "pedidos@mairibel.com.br";
$emailFrom    = "sendEMail@mairibel.com.br";
/**/
/* * /   
$SMTPHost     = "srv168.prodns.com.br";
$SMTPPort     = 465;
$SMTPUsername = "sendemail@sillychilli.com.br";
$SMTPPassword = "1234Bier";
$emailContato = "burzinsky@yahoo.com.br";
$emailPedido  = "burzinsky@yahoo.com.br";
$emailFrom    = "sendemail@sillychilli.com.br";
/ * */
    
$nome         = "Revendedor";  
$assunto      = "Novo pedido do aplicativo";  
$mensagemForm = '';  
  
require 'PHPMailer/PHPMailerAutoload.php';
require('PHPMailer/class.smtp.php');
require 'PHPMailer/class.phpmailer.php';

$phpmail = new PHPMailer();
$phpmail->IsSMTP(); 					        // envia por SMTP
$phpmail->Host       = $SMTPHost;      // SMTP servers
$phpmail->Port       = $SMTPPort;      // Set the SMTP port
$phpmail->SMTPAuth   = true; 		   // Caso o servidor SMTP precise de autenticação
$phpmail->Username   = $SMTPUsername;  // SMTP username
$phpmail->Password   = $SMTPPassword;  // SMTP password
$phpmail->SMTPSecure = 'ssl';
$phpmail->From     = $emailFrom;
$phpmail->FromName = $nome;
$phpmail->AddAddress($emailPedido);
$phpmail->Subject  = $assunto;      
      } // temp. EMail

      $revendedor   = $_GET['revendedor']; 
      $revendedorID = 0;

      $conn = openDatabase();
      $output = '';  
      $maxID = 0;
    
    {
    $SQL = "SELECT id_pedido FROM pedidos";
    $user = $conn->prepare($SQL);
    $user->execute();
    $state = $user->fetchAll(PDO::FETCH_ASSOC);
    foreach($state as $statelist)
    {
      $pedidoID   = $statelist['id_pedido'];  
      if ($pedidoID > $maxID) {
         $maxID = $pedidoID;
      }
    }
    } // get max 'pedido' number ..
   
    $pedidoID = $pedidoID + 1;

    {
    $SQL = "SELECT id FROM revendedores WHERE nome='".$revendedor."'";
    $user = $conn->prepare($SQL);
    $user->execute();
    $state = $user->fetchAll(PDO::FETCH_ASSOC);
    foreach($state as $statelist)
    {
      $revendedorID   = $statelist['id'];  
    }
    } // get revendedorID ..
    {
        $phpmail->Body = "Revendedor: ".$revendedor."<hr>";
    } // temp. EMail
      
    {
    $SQL = "SELECT id_produto, revendedores_produtos.imagem1, revendedores_produtos.referencia, revendedores_produtos.nome, revendedores_produtos.valor, quantidade, id_revendedor 
    FROM produtopedidoatual 
    FULL JOIN revendedores_produtos 
    ON id_produto=revendedores_produtos.referencia AND id_revendedor=".$revendedor." ";      
      
	$user = $conn->prepare($SQL);
    $user->execute();
    $state = $user->fetchAll(PDO::FETCH_ASSOC);

    foreach($state as $statelist)
	{
	  $id_produto   = $statelist['id_produto'];  
	  $referencia   = $statelist['referencia'];  
	  $produto_nome = $statelist['nome'];  
	  $valor        = $statelist['valor'];  
	  $quantidade   = $statelist['quantidade'];         
	  $valorTotal   = $valor * $quantidade;  
        
      /*--------------------------------------------------------------------------------*/
      // insert 'pedido' ..
      
if ($referencia == 1817){
    
    $referencia = 984;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );
    $referencia = 1037;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );
    $referencia = 1814;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );
    $referencia = 1696;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );
    
}
elseif ($id_produto == 70){
    
    $referencia = 72;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );
    $referencia = 71;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );
    $referencia = 75;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );
    $referencia = 73;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );
    $referencia = 55;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );
        
}
elseif ($id_produto == 1692){
    
    $referencia = 1696;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );
    $referencia = 1684;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );
    $referencia = 1685;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );
    $referencia = 1686;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );
    
}
elseif ($id_produto == 975){

    $referencia = 88;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );
    $referencia = 519;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );
    $referencia = 815;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );
    $referencia = 92;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );
    $referencia = 457;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );
    $referencia = 1001;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );

}
elseif ($id_produto == 84){
  
    $referencia = 88;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );
    $referencia = 454;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );
    $referencia = 452;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );
    $referencia = 1128;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );
    $referencia = 90;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );
    $referencia = 92;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );

}
elseif ($id_produto == 1028){
    
    $referencia = 1029;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );
    $referencia = 1031;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );
    $referencia = 1030;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );

}
elseif ($id_produto == 884){

    $referencia = 885;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );
    $referencia = 886;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );
    $referencia = 887;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );
    
}
elseif ($id_produto == 1818){

    $referencia = 1232;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );
    $referencia = 1815;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );
    $referencia = 1778;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );
    
}
elseif ($id_produto == 1713){
    
    $referencia = 1232;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );
    $referencia = 1233;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );
    $referencia = 1778;
    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );
    
}
else { 

    insertProductIntoPedido($conn, $phpmail, $pedidoID, $revendedor, $referencia, $valor, $valorTotal, $quantidade );
   
/*   
      $SQL = "INSERT INTO `pedidos` (`id_pedido`, `id_revendedor`, `id_produto`, `produto_nome`, `produto_preco`, `preco_total`,  `produto_quantidade`, `status`, `observacao`, `dt`) 
      VALUES ('$pedidoID', '$revendedor', '$referencia', '$produto_nome', '$valor', '$valorTotal', '$quantidade', '1', ' ', now() )";
        
//echo 'pedido: '.$pedidoID.' | revendedor: '.$revendedor.' | ref: '.$referencia.' | produto: '.$produto_nome.' | preço: '.$valor.' | quant: '.$quantidade;
                
	  $user = $conn->prepare($SQL);        
      if ($user->execute()) { 
        $success = true;
      }        
      $state = $user->fetchAll(PDO::FETCH_ASSOC);

{
$phpmail->Body .= "Produto: ".$produto_nome."<br>";
$phpmail->Body .= "ID: ".$referencia."<br>";
$phpmail->Body .= "Preço: R$".$valor."<br>";
$phpmail->Body .= "Quantidade: ".$quantidade."<br><hr>";
} // temp. EMail 
 */    
    
}
    }
    }
     
    {      
        $phpmail->AltBody = '';
        $phpmail->isHTML(true);   
        $send = $phpmail->Send();
        if($send) {echo "A Mensagem foi enviada com sucesso.";}
        else {echo "Não foi possível enviar a mensagem. Erro: " .$phpmail->ErrorInfo;}
    } // temp. EMail ..
    
    {
    $SQL = "DELETE FROM produtopedidoatual WHERE id_revendedor=".$revendedor." ";
    $user = $conn->prepare($SQL);
    $user->execute();
    $state = $user->fetchAll(PDO::FETCH_ASSOC);
    foreach($state as $statelist)
    {
       $pedidoID   = $statelist['id_pedido'];  
       if ($pedidoID > $maxID) {
         $maxID = $pedidoID;
       }
    }
    }  // delete items from table ..
      
  }     /* INSERT data INTO 'pedidos' */

  else if($action == '999117'){ 
	
    $revendedor  = $_GET['revendedor'];  
      
    $conn = openDatabase();
    $output = '';

    $SQL = "SELECT id_produto, revendedores_produtos.imagem1, revendedores_produtos.referencia, revendedores_produtos.nome, revendedores_produtos.valor, quantidade, id_revendedor 
    FROM produtopedidoatual 
    FULL JOIN revendedores_produtos 
    ON id_produto=revendedores_produtos.referencia AND id_revendedor=".$revendedor." ";
     
//    $SQL = "SELECT id_produto, revendedores_produtos.imagem1, revendedores_produtos.referencia, revendedores_produtos.nome, revendedores_produtos.valor, quantidade 
//    FROM produtopedidoatual 
//    FULL JOIN revendedores_produtos 
//    ON id_produto=revendedores_produtos.referencia";

	$user = $conn->prepare($SQL);
    $user->execute();
    $state = $user->fetchAll(PDO::FETCH_ASSOC);

	$output .= "<table id='currentProdutos' style='width:100%; margin:0px; padding:0px;'>";
	$output .= "<style>";
	$output .= ".trClass {background-color: #F3F3F3; width:100%; margin:0px; padding:0px;}";
	$output .= ".imgClass{width:0%;}";
	$output .= "</style>";

    $output .= "<tr>";
    $output .= "  <td style='width:0%;'></td>";
    $output .= "  <td style='width:60%;'><p style='margin-left:5px; font-size:1.0em;'>Nome</p></td>";
    $output .= "  <td style='width:22%;'><p style='font-size:1.0em;'>Valor</p></td>";
    $output .= "  <td style='width:10%;'><p style='font-size:1.0em;'>Quant.</p></td>";
    $output .= "  <td style='width:0%;'></td>";
    $output .= "  <td style='width:8%;'></td>";
    $output .= "</tr>";
    
    foreach($state as $statelist)
    {
	  $prodName   = $statelist['nome'];
	  $imagem     = $statelist['imagem1'];  
	  $referencia = $statelist['referencia'];  
	  $valor      = $statelist['valor'];  
	  $quantidade = $statelist['quantidade']; 
        
	  $output .= "<tr class='trClass'>";
//	  $output .= "  <td style='width:0%;'><img src='".$imagePath.$imagem."' style='width:0px;' />";
//	  $output .= "  </td>";
	  $output .= "  <td></td>";
	  
	  $output .= "  <td>";
      $output .= "    <p style='margin-left:5px; font-size:0.9em; font-weight:bold; color:#666666; margin-top:0px; margin-bottom:0px; padding-top:3px; padding-bottom:3px;'>".$prodName."</p>";
      $output .= "  </td>";

	  $output .= "  <td>";
      $output .= "    <p style='margin-left:5px; font-size:0.85em; font-weight:bold; color:#0000FF; margin-top:0px; margin-bottom:0px; padding-top:3px; padding-bottom:3px;'> R$ ".$valor."</p>";
	  $output .= "  </td>";

	  $output .= "  <td style='text-align:center'>";
      $output .= "    <p style='font-size:0.75em; color:#666666; margin-top:0px; margin-bottom:0px; padding-top:3px; padding-bottom:3px;'>".$quantidade." </p>";
	  $output .= "  </td>";

	  $output .= "  <td style='width:0%; text-align:center'>";
      $output .= "    <p style='width:0%; font-size:0px;'>".$referencia." </p>";
	  $output .= "  </td>";

	  $output .= "  <td style='width:0%; text-align:center'>";
      $output .= "<img src='http://mairibel.com.br/app/images/icons/error.png' style='width:60%;' />";
	  $output .= "  </td>";        
	  $output .= "</tr>";
    }			
      
	$output .= "</br>";
	$output .= "</table>"; 
    $output .=	'';
	
    echo $output;
      
  }     /* get 'produtos' for current 'pedido' */

  else if($action == '999118'){

    $revendedor  = $_GET['revendedor']; 
    $idProduto   = $_GET['idProduto'];  
    $quantidade  = $_GET['quantidade'];  

    $conn = openDatabase();
    $output = '';
    $SQL = "INSERT INTO produtopedidoatual (id_produto, quantidade, id_revendedor) VALUES ( ".$idProduto.",".$quantidade.",".$revendedor.")";
//echo $SQL;
    $user = $conn->prepare($SQL);
    $user->execute();
    $state = $user->fetchAll(PDO::FETCH_ASSOC);
    
    //echo $state;  
  }     /* INSERT 'produtos' INTO db .. */

  else if($action == '999119'){

    $revendedor  = $_GET['revendedor'];  
    
    $valorTotal = 0;
    $valor      = 0;
    $quantidade = 0;
    $output     = '';  
    
    $conn = openDatabase();	
    
    $SQL = "SELECT revendedores_produtos.valor, quantidade 
    FROM produtopedidoatual
    FULL JOIN revendedores_produtos
    ON id_produto=revendedores_produtos.referencia  AND id_revendedor=".$revendedor." ";
    
	$user = $conn->prepare($SQL);
    $user->execute();
    $state = $user->fetchAll(PDO::FETCH_ASSOC);

    foreach($state as $statelist)
    {
	  $valor      = $statelist['valor'];  
	  $quantidade = $statelist['quantidade']; 

	  $valorTotal = $valorTotal + $valor*$quantidade;
    }
    
    if ($valorTotal > 0) {
          $valorTotalFormat = number_format($valorTotal,2);
    }
    else {
          $valorTotalFormat = "0.00";        
    }
      
    echo "<p style='color:#FF0000; font-size:2em;'>R$: $valorTotalFormat</p>";  
    
  }     /*  */

  else if($action == '999120'){ 
	 
	global $imagePath;
	
    $referencia  = $_GET['inputCodigo'];  
	
    $conn = openDatabase();
    $output = '';
    $SQL = "SELECT id, nome, referencia, valor, imagem1 FROM revendedores_produtos WHERE referencia=".$referencia." ";
	
	$user = $conn->prepare($SQL);
    $user->execute();
    $state = $user->fetchAll(PDO::FETCH_ASSOC);
    if (count($state) == 0) {
	   $output .= "NOK";
    }      
    else {      
      
    foreach($state as $statelist)
	{
	   $idNo       = $statelist['id'];
	   $prodName   = $statelist['nome'];
	   $imagem     = $statelist['imagem1'];  
	   $referencia = $statelist['referencia'];  
	   $valor      = $statelist['valor'];  

       $output .="<style> @font-face { font-family: 'Oswald'; src: url('fonts/oswald-demibold-webfont.ttf') format('truetype'); }</style>";
        
       $output .="	<style>#nomeID{	font-family: Oswald, Georgia, Serif; text-align:center; font-size:1.5em; margin-top:20px;}</style>";
       $output .="	<style>#refID{ font-family: Oswald, Georgia, Serif; color:#333333; font-size:2.0em;}</style>";
       $output .="	<style>#valorID{ font-family: Oswald, Georgia, Serif; color:#FF0000; font-size:2.5em;}</style>";
       $output .="	<style>#valorTotalModalID{ font-family: Oswald, Georgia, Serif; color:#FF0000; font-size:1.5em;}</style>";
       $output .="	<style>#vID{ font-family: Oswald, Georgia, Serif; color:#333333; font-size:1.5em;}</style>";
       $output .="	<style>.ButtonClass1{ width:100%; margin-left:0%; margin-bottom:20px; padding-top:1.0em; padding-bottom:1.0em; background-color:#999999; color:#EEEEEE; text-align:center;}</style>"; 

	   $output .= "<div class='container' style='background-color:#FFFFFF; margin-top:50px; width:96%; margin-left:2%;'>";
	   $output .= "  <div class='row'>";
	   $output .= "    <div class='col-lg-12'>";
	   $output .= "      <p id='nomeID'>".$prodName."</p>";
	   $output .= "    </div>";
	   $output .= "  </div>";	
	   $output .= "  <hr>";
        
       $output .= "  <div class='row'>";
	   $output .= "    <div class='col-lg-5 col-md-5 col-sm-5 col-xs-5'>";
	   $output .= "      <div class='row'>";        
       $output .= "        <div class='col-xs-8'>";
       $output .= "          <input class='form-control' type='text' value='0' id='countModalID' style='margin-right:0px;'>";
       $output .= "        </div>";
       $output .= "        <div class='col-xs-4'>";
       $output .= "          <label for='example-text-input' class='col-2 col-form-label' style='text-align:left;'>und.</label>";
       $output .= "        </div>";
       $output .= "      </div>";    
	   $output .= "    </div>";
	   $output .= "    <div class='col-lg-7 col-md-7 col-sm-7 col-xs-7'>";
	   $output .= "      <p id='valorTotalModalID'>Total: R$ 0.00</p>";
	   $output .= "    </div>";
	   $output .= "  </div>";
	   $output .= "  <hr>";            
        
	   $output .= "  <div class='row'>";
	   $output .= "    <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>";
	   $output .= "      <img style='width:80%;' src=".$imagePath.$imagem." />";
	   $output .= "    </div>";
	   $output .= "    <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>";
	   $output .= "       <div class='row'>";
	   $output .= "         <p id='refID'> Código: ".$referencia."</p>";
	   $output .= "       </div>";
	   $output .= "       <div class='row'>";
	   $output .= "         <p id='valorID'>R$ ".$valor."</p>";
	   $output .= "       </div>";
	   $output .= "    </div>";
	   $output .= "  </div>";	
                    
	   $output .= "  <br>";
	   $output .= "  <div class='row'>";
	   $output .= "    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>";
	   $output .= "    </div>";
	   $output .= "    <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>";
//       $output .= "      <a href='#'><p id='produtoDiretoPedirID' class='ButtonClass1'>Pedir</p></a>";
    $output .= "<a href='#'><p id='produtoDiretoPedirID'><img src='http://mairibel.com.br/app/images/icons/MBButtonsPedir.png' style='width:100%; height:4.0em;' ></p></a>";        
	   $output .= "    </div>";
	   $output .= "    <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>";
//       $output .= "      <a href='#'><p id='produtoDiretoFecharID' class='ButtonClass1'>Fechar</p></a>";
    $output .= "<a href='#'><p id='produtoDiretoFecharID'><img src='http://mairibel.com.br/app/images/icons/MBButtonsFechar.png' style='width:100%; height:4.0em;' ></p></a>";        
       $output .= "    </div>";
	   $output .= "    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>";
	   $output .= "    </div>";
	   $output .= "  </div>";
//	   $output .= "  <p>id:0002</p>";
	   $output .= "</div>";
	}
}
    echo $output;
  
  }     /* get data for 'produto detail' ... */

  else if($action == '999121'){ 
	
    $conn = openDatabase();	
    $output = '';  
      
    $SQL = "SELECT id_produto, revendedores_produtos.imagem1, revendedores_produtos.referencia, revendedores_produtos.nome, revendedores_produtos.valor, quantidade 
    FROM produtopedidoatual
    FULL JOIN revendedores_produtos
    ON id_produto=revendedores_produtos.referencia";

	$user = $conn->prepare($SQL);
    $user->execute();
    $state = $user->fetchAll(PDO::FETCH_ASSOC);

	$output .= "<p style='font-size:1.2em; text-align:center; margin-bottom:0px;'>Produtos</p>";
      
	$output .= "<table id='currentProdutosModal' style='width:100%; margin-top:0px; padding-top:0px;'>";
	$output .= "<style>";
	$output .= ".trClass{border-bottom: 1px solid #999999; background-color: #FFFFFF;}";
	$output .= ".tdClass{border-right:0px solid #666666; width:10%;}";
	$output .= ".imgClass{width:30%; margin-top:1px; margin-left:35%;}";
	$output .= "</style>";
      

    foreach($state as $statelist)
    {
	  //$idNo       = $statelist['id'];
	  $prodName   = $statelist['nome'];
	  $imagem     = $statelist['imagem1'];  
	  $referencia = $statelist['referencia'];  
	  $valor      = $statelist['valor'];  
	  $quantidade = $statelist['quantidade']; 
        
	  
	  $output .= "<tr class='trClass'>";
        
//	  $output .= "  <td style='width:0%;'><img class='imgClass' src='".$imagePath.$imagem."' />";
//*	  $output .= "  </td>";
	  $output .= "  <td style='width:0%;'></td>";
	  
	  $output .= "  <td style='width:60%;'>";
      $output .= "    <p style='margin-left:5px; font-size:12px; color:#666666; margin-top:0px; margin-bottom:0px; padding-top:0px; padding-bottom:0px;'>".$prodName."</p>";
      $output .= "  </td>";

	  $output .= "  <td style='width:30%;'>";
      $output .= "    <p style='margin-left:5px; font-size:12px; color: #0000FF;'> R$ ".$valor."</p>";
	  $output .= "  </td>";

	  $output .= "  <td style='width:10%; text-align:center'>";
      $output .= "    <p style='margin-left:5px; font-size:12px;'>".$quantidade." </p>";
	  $output .= "  </td>";
        
	  $output .= "  <td style='width:0px; text-align:center; display:none;'>";
      $output .= " ".$referencia." ";
	  $output .= "  </td>";
        
	  $output .= "  <td style='width:0px; text-align:center; display:none;'>";
      $output .= " ".$quantidade." ";
	  $output .= "  </td>";
        
/*
	  $output .= "  <td style='width:5%; text-align:center;'>";
      $output .= "  <a href='#'><p style='width:100%; height:40%; margin-top:30%; background-color:#EE1111; color:#EE1111;'>x</p></a>";
	  $output .= "  </td>";
*/
	  $output .= "</tr>";
    }			
      
	$output .= "</br>";
	$output .= "</table>"; 
	$output .= "  <br>";
	$output .= "  <div class='row'>";
	$output .= "    <div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'>";
	$output .= "    </div>";
	$output .= "    <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>";
    $output .= "       <button class='btn widget' id='produtoModalFecharID' style='width:90%; margin-left:5%; margin-bottom:10px;'>Fechar</button>";
	$output .= "    </div>";
	$output .= "    <div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'>";
	$output .= "    </div>";
	$output .= "  </div>";    $output .=	'';
	
    echo $output;
      
  }     /* get 'produtos' for current 'pedido' on modal */

  else if($action == '999122'){  
      
	global $imagePath;
	
    $idNo       = $_GET['idNo'];  
    $quant      = $_GET['quantidade'];  
    $quantidade = intval($quant);
	
    $conn = openDatabase();	
    $output = '';  
    $SQL = "SELECT id, nome, referencia, valor, imagem1 FROM revendedores_produtos WHERE referencia=".$idNo." ";
	
	$user = $conn->prepare($SQL);
    $user->execute();
    $state = $user->fetchAll(PDO::FETCH_ASSOC);

    foreach($state as $statelist)
	{
        $idNo       = $statelist['id'];
        $prodName   = $statelist['nome'];
	    $imagem     = $statelist['imagem1'];  
	    $referencia = $statelist['referencia'];  
	    $valor      = $statelist['valor'];  
            
	    $valorTotal = $valor * $quantidade;  
        $valorTotalForm = number_format($valorTotal, 2);
          
        $output .="<style> @font-face { font-family: 'Oswald'; src: url('fonts/oswald-demibold-webfont.ttf') format('truetype'); }</style>";        
        
        $output .="	<style>#nomeID       { font-family: Oswald, Georgia, Serif; text-align:center; font-size:1.4em; margin-top:0px;}</style>";
        $output .="	<style>#refID        { font-family: Oswald, Georgia, Serif; color:#333333; font-size:1.2em;}</style>";  
        $output .="	<style>#valorID      { font-family: Oswald, Georgia, Serif; color:#FF0000; font-size:1.8em;}</style>";  
        $output .="	<style>#valorTotalID { font-family: Oswald, Georgia, Serif; color:#FF0000; font-size:2.0em; text-align:center;}</style>";  
        $output .="	<style>#vID          { font-family: Oswald, Georgia, Serif; color:#333333; font-size:1.5em;}</style>"; 
        $output .="	<style>.ButtonClass1{ width:100%; margin-left:0%; margin-bottom:20px; padding-top:1.0em; padding-bottom:1.0em; background-color:#999999; color:#EEEEEE; text-align:center;}</style>"; 
            
	    //$output .= "<p style='font-size:1.2em; text-align:center; margin-bottom:0px;'>Produto detalhe</p>";
            
	    $output .= "<div class='container' style='background-color:#FFFFFF; margin-top:15px; width:96%; margin-left:2%;'>";
	    $output .= "  <div class='row'>";
	    $output .= "    <div class='col-lg-12'>";
	    $output .= "      <p id='nomeID'>".$prodName."</p>";
	    $output .= "    </div>";
	    $output .= "  </div>";	
	    $output .= "  <div class='row'>";        
        $output .= "    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'></div>";
        $output .= "    <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>";
        $output .= "        <input class='form-control' type='text' value='".$quantidade."' id='countDetalheID' style='margin-right:0px;'>";
        $output .= "    </div>";
        $output .= "    <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>";
        $output .= "        <label for='example-text-input' class='col-2 col-form-label' style='text-align:left; margin-top:5px;'>und.</label>";
        $output .= "    </div>";
        $output .= "    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'></div>";
        $output .= "  </div>";    
        $output .= "  <hr>";    
                        
	    $output .= "  <div class='row'>";
	    $output .= "    <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>";
	    $output .= "      <img style='width:80%;' src=".$imagePath.$imagem." />";
	    $output .= "    </div>";
	    $output .= "    <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>";
	    $output .= "       <div class='row'>";
	    $output .= "         <p id='refID'> Código: ".$referencia."</p>";
	    $output .= "       </div>";
 	    $output .= "       <div class='row'>";
	    $output .= "         <p id='valorID'>R$ ".$valor."</p>";
	    $output .= "       </div>";
	    $output .= "    </div>";
	    $output .= "  </div>";	
        
        $output .="	<style>.well{ background-color:#F0F0FE; margin:0% 1% 0% 1%; padding: 1% 0% 0% 0%;}</style>"; 
             
        $output .= "  <div class='row well'>";
        $output .= "    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
	    $output .= "     <p style='text-align:center; font-size:1.4em;'>Preço total</p>";
	    $output .= "    </div>";
        $output .= "    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
	    $output .= "     <p id='valorTotalID' style='text-align:center;'>R$: ".$valorTotalForm."</p>";
	    $output .= "    </div>";
	    $output .= "  </div>";
        
	    $output .= "  <br>";
        
        $output .= "  <div class='row'>";
        $output .= "    <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4' style='padding:0px; margin:0px;'>";
        $output .= "      <a href='#' id='produtoDetalheModalPedirID'><img src='http://mairibel.com.br/app/images/icons/MBButtonsPedir.png' style='width:98%; margin-left:1%;'></a>";
        $output .= "    </div>";
        $output .= "    <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4' style='padding:0px; margin:0px;'>";
        $output .= "      <a href='#' id='produtoDetalheModalDeletarID' style='width:100%;'><img src='http://mairibel.com.br/app/images/icons/MBButtonsDeletar.png' style='width:98%; margin-left:1%;'></a>";
        $output .= "    </div>";
        $output .= "    <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4' style='padding:0px; margin:0px;'>";
        $output .= "      <a href='#' id='produtoDetalheModalFecharID'><img src='http://mairibel.com.br/app/images/icons/MBButtonsFechar.png' style='width:98%; margin-left:1%;'></a>";
        $output .= "    </div>";
        $output .= "  </div>";	

//	    $output .= "  <p>id:0003</p>";
	}
	
    echo $output;
  }     /* get details for selected 'product' for mobile */

  else if($action == '999123'){ 
      
    $quantidade  = $_GET['quantidade'];  
    $referencia  = $_GET['referencia'];  

    $conn = openDatabase();	
    $output = ''; 
      
    $SQL = "UPDATE produtopedidoatual SET quantidade=".$quantidade." WHERE id_produto=".$referencia." ";

    $user = $conn->prepare($SQL);
    $user->execute();
    $state = $user->fetchAll(PDO::FETCH_ASSOC);

  }     /* UPDATE quantidade FROM 'produtopedidoatual' */

  else if($action == '999124'){ 
      
    $referencia  = $_GET['referencia'];  

    $conn = openDatabase();	
    $output = ''; 
      
    $SQL = "DELETE FROM produtopedidoatual WHERE id_produto=".$referencia." ";

    $user = $conn->prepare($SQL);
    $user->execute();
    $state = $user->fetchAll(PDO::FETCH_ASSOC);

      
  }     /* DELETE product FROM 'produtopedidoatual' */

  else if($action == '999130'){     
      
      $output  = '';

      $pathDownloadsPath  = "images/downloads";
      $pathDownloads  = "http://mairibel.com.br/app/images/downloads";

      $dir = opendir($pathDownloadsPath);	
      $files = array();
      while ($files[] = readdir($dir));
      sort ($files);
      closedir($dir);

      foreach ($files as $file){
          if ($file != "." && $file != ".." && $file != "") {
              $patternThumb = $pathDownloads . "/" .$file;	
              
              $output  .= '<img src="'.$patternThumb.'" style="width:50%; padding:1px; margin:0;" />';
              
              $i++;
		  }
	   }

      echo $output;
      
  }     /* list all 'download' itens .. */

  else if($action == '999131'){      
      $output  = '';

      $pathLancamentoPath  = "images/lancamentos";
      $pathLancamento  = "http://mairibel.com.br/app/images/lancamentos";

      $dir = opendir($pathLancamentoPath);	
      $files = array();
      while ($files[] = readdir($dir));
      sort ($files);
      closedir($dir);

      foreach ($files as $file){
          if ($file != "." && $file != ".." && $file != "") {
              $patternThumb = $pathLancamento . "/" .$file;	
              
              $output  .= '<img src="'.$patternThumb.'" style="width:50%; padding:1px; margin:0;" />';
              
              $i++;
		  }
	   }

      echo $output;
      
  }     /* list all 'lancamento' itens .. */
    
  else if($action == '999771'){
/*
01. Kit Alisamento com Amônia:                  itens: cod 984 - 1037 - 1814-  1696
02. Kit Cauterização Capilar:                   Itens cod: 072 - 071 - 075 - 073 - 055
03. Kit Permanente Afro:                        Itens Cod: 1696 - 1684 - 1685 - 1686
04. Kit Relaxamento de Guanidina Grande:        Itens cod: 088 - 519 - 815 - 092 - 457 - 1001
05. Kit Relaxamento Guanidina Pequeno:          Itens Cod: 088 - 454 - 452 - 1128 - 090 - 092
06. Kit Reposição de Aminoacido e Nutrientes:   Itens Cod: 1029 - 1031 - 1030
07. Kit Tratamento de Choque:                   ítens cod: 885 - 886 - 887
08. Kit Selante Gold Mairi LIss:                ítens cod: 1232 - 1815 - 1778
09. Kit Selante Gold Matizador:                 Itens Cod: 1232 - 1233 - 1778
*/      
      $idNo  = $_GET['idNo'];  
      $valorProduto = 0;
      $valorTotal = 0;
      $quantidade = 0;
$referencia=0;
      
      $output = '';  

      $output .= "<table style='width:100%; margin-top:1.0em;' id='selectedMBCategoryKitsProducts'>";
      $output .= "<style>";
      $output .= ".trClass{border: 1px solid #999999; background-color: #FAFAFA;}";
      $output .= ".tdClass{border-right:1px solid #666666; width:10%; padding-top:0.5em; padding-bottom:0.5em;}";
      $output .= ".imgClass{width:80%; margin-top:1px; margin-left:10%;}";
      $output .= "</style>";
      
    if ($idNo == 1){
        /* =====  details for Kit ..*/
        $referencia = "1817";
        
        $output .= "<div class='container' style='background-color:#FFFFFF; margin-top:50px;' width:96%; margin-left:2%;>";
        $output .= "  <div class='row'>";
        $output .= "    <div class='col-lg-12'>";
        $output .= "      <p id='nomeID'>Kit Alisamento com Amônia</p>";
        $output .= "    </div>";
        $output .= "  </div>";	

        $output .= "  <table>";
        
        $valorTotal = 0;
        $valorProduto = getKitProduct($output, $idNo, 984);
        $valorTotal += $valorProduto;
        $valorProduto = getKitProduct($output, $idNo, 1037);
        $valorTotal += $valorProduto;
        $valorProduto = getKitProduct($output, $idNo, 1814);
        $valorTotal += $valorProduto;
        $valorProduto = getKitProduct($output, $idNo, 1696);
        $valorTotal += $valorProduto;

        $output .= "  </table>";
       
    }
    else if ($idNo == 2){
        /* =====  details for Kit ..*/
        $referencia = "70";
        
        $output .= "<div class='container' style='background-color:#FFFFFF; margin-top:50px;' width:96%; margin-left:2%;>";
        $output .= "  <div class='row'>";
        $output .= "    <div class='col-lg-12'>";
        $output .= "      <p id='nomeID'>Kit Cauterização Capilar</p>";
        $output .= "    </div>";
        $output .= "  </div>";	

        $output .= "  <table>";
        
        $valorTotal = 0;
        $valorProduto = getKitProduct($output, $idNo, 72);
        $valorTotal += $valorProduto;
        $valorProduto = getKitProduct($output, $idNo, 71);
        $valorTotal += $valorProduto;
        $valorProduto = getKitProduct($output, $idNo, 75);
        $valorTotal += $valorProduto;
        $valorProduto = getKitProduct($output, $idNo, 73);
        $valorTotal += $valorProduto;
        $valorProduto = getKitProduct($output, $idNo, 55);
        $valorTotal += $valorProduto;

        $output .= "  </table>";
        
    }
    else if ($idNo == 3){
        /* =====  details for Kit ..*/
        $referencia = "1692";
        
        $output .= "<div class='container' style='background-color:#FFFFFF; margin-top:50px;' width:96%; margin-left:2%;>";
        $output .= "  <div class='row'>";
        $output .= "    <div class='col-lg-12'>";
        $output .= "      <p id='nomeID'>Kit Permanente Afro</p>";
        $output .= "    </div>";
        $output .= "  </div>";	

        $output .= "<table>";
        
        $valorTotal = 0;
        $valorProduto = getKitProduct($output, $idNo, 1696);
        $valorTotal += $valorProduto;
        $valorProduto = getKitProduct($output, $idNo, 1684);
        $valorTotal += $valorProduto;
        $valorProduto = getKitProduct($output, $idNo, 1685);
        $valorTotal += $valorProduto;
        $valorProduto = getKitProduct($output, $idNo, 1686);
        $valorTotal += $valorProduto;

        $output .= "</table>";
             
    }
    else if ($idNo == 4){
        /* =====  details for Kit ..*/
        $referencia = "975";
        
        $output .= "<div class='container' style='background-color:#FFFFFF; margin-top:50px;' width:96%; margin-left:2%;>";
        $output .= "  <div class='row'>";
        $output .= "    <div class='col-lg-12'>";
        $output .= "      <p id='nomeID'>Kit Relaxamento de Guanidina Grande</p>";
        $output .= "    </div>";
        $output .= "  </div>";	

        $output .= "<table>";
        
        $valorTotal = 0;
        $valorProduto = getKitProduct($output, $idNo, 088);
        $valorTotal += $valorProduto;
        $valorProduto = getKitProduct($output, $idNo, 519);
        $valorTotal += $valorProduto;
        $valorProduto = getKitProduct($output, $idNo, 815);
        $valorTotal += $valorProduto;
        $valorProduto = getKitProduct($output, $idNo, 092);
        $valorTotal += $valorProduto;
        $valorProduto = getKitProduct($output, $idNo, 457);
        $valorTotal += $valorProduto;
        $valorProduto = getKitProduct($output, $idNo, 1001);
        $valorTotal += $valorProduto;
        
        $output .= "</table>";
    
    }
    else if ($idNo == 5){
        /* =====  details for Kit ..*/
        $referencia = "84";

        $output .= "<div class='container' style='background-color:#FFFFFF; margin-top:50px;' width:96%; margin-left:2%;>";
        $output .= "  <div class='row'>";
        $output .= "    <div class='col-lg-12'>";
        $output .= "      <p id='nomeID'>Kit Relaxamento Guanidina Pequeno</p>";
        $output .= "    </div>";
        $output .= "  </div>";	
    
        $output .= "<table>";
           
        $valorTotal = 0;
        $valorProduto = getKitProduct($output, $idNo, 088);
        $valorTotal += $valorProduto;
        $valorProduto = getKitProduct($output, $idNo, 454);
        $valorTotal += $valorProduto;
        $valorProduto = getKitProduct($output, $idNo, 452);
        $valorTotal += $valorProduto;
        $valorProduto = getKitProduct($output, $idNo, 1128);
        $valorTotal += $valorProduto;
        $valorProduto = getKitProduct($output, $idNo, 090);
        $valorTotal += $valorProduto;
        $valorProduto = getKitProduct($output, $idNo, 092);
        $valorTotal += $valorProduto;

        $output .= "</table>";
    
    }
    else if ($idNo == 6){
        /* =====  details for Kit ..*/
        $referencia = "1028";

        $output .= "<div class='container' style='background-color:#FFFFFF; margin-top:50px;' width:96%; margin-left:2%;>";
        $output .= "  <div class='row'>";
        $output .= "    <div class='col-lg-12'>";
        $output .= "      <p id='nomeID'>Kit Reposição de Aminoacido e Nutrientes</p>";
        $output .= "    </div>";
        $output .= "  </div>";	

        $output .= "<table>";

        $valorTotal = 0;
        $valorProduto = getKitProduct($output, $idNo, 1029);
        $valorTotal += $valorProduto;
        $valorProduto = getKitProduct($output, $idNo, 1031);
        $valorTotal += $valorProduto;
        $valorProduto = getKitProduct($output, $idNo, 1030);
        $valorTotal += $valorProduto;

        $output .= "</table>";               
    }
    else if ($idNo == 7){
        /* =====  details for Kit ..*/
        $referencia = "884";

        $output .= "<div class='container' style='background-color:#FFFFFF; margin-top:50px;' width:96%; margin-left:2%;>";
        $output .= "  <div class='row'>";
        $output .= "    <div class='col-lg-12'>";
        $output .= "      <p id='nomeID'>Kit Tratamento de Choque</p>";
        $output .= "    </div>";
        $output .= "  </div>";	

        $output .= "<table>";

        $valorTotal = 0;
        $valorProduto = getKitProduct($output, $idNo, 885);
        $valorTotal += $valorProduto;
        $valorProduto = getKitProduct($output, $idNo, 886);
        $valorTotal += $valorProduto;
        $valorProduto = getKitProduct($output, $idNo, 887);
        $valorTotal += $valorProduto;

        $output .= "</table>";
    }
    else if ($idNo == 8){
        /* =====  details for Kit ..*/
        $referencia = "1818";

        $output .= "<div class='container' style='background-color:#FFFFFF; margin-top:50px;' width:96%; margin-left:2%;>";
        $output .= "  <div class='row'>";
        $output .= "    <div class='col-lg-12'>";
        $output .= "      <p id='nomeID'>Kit Selante Gold Mairi Liss</p>";
        $output .= "    </div>";
        $output .= "  </div>";	

        $output .= "<table>";

        $valorTotal = 0;
        $valorProduto = getKitProduct($output, $idNo, 1232);
        $valorTotal += $valorProduto;
        $valorProduto = getKitProduct($output, $idNo, 1815);
        $valorTotal += $valorProduto;
        $valorProduto = getKitProduct($output, $idNo, 1778);
        $valorTotal += $valorProduto;

        $output .= "</table>";
    }
    else if ($idNo == 9){
        /* =====  details for Kit ..*/
        $referencia = "1713";

        $output .= "<div class='container' style='background-color:#FFFFFF; margin-top:50px;' width:96%; margin-left:2%;>";
        $output .= "  <div class='row'>";
        $output .= "    <div class='col-lg-12'>";
        $output .= "      <p id='nomeID'>Kit Selante Gold Matizador</p>";
        $output .= "    </div>";
        $output .= "  </div>";	

        $output .= "<table>";

        $valorTotal = 0;
        $valorProduto = getKitProduct($output, $idNo, 1232);
        $valorTotal += $valorProduto;
        $valorProduto = getKitProduct($output, $idNo, 1233);
        $valorTotal += $valorProduto;
        $valorProduto = getKitProduct($output, $idNo, 1778);
        $valorTotal += $valorProduto;

        $output .= "</table>";      
    }

{
    $output .= "  <br>";
    $output .= "  <div class='row'>";
	$output .= "    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'></div>";
	$output .= "    <div class='col-lg-8 col-md-8 col-sm-8 col-xs-8'>";
	$output .= "      <div class='row'>";
    $output .= "        <div class='col-xs-4'>";
    $output .= "          <input class='form-control' type='text' value='0' id='countDetailKitID' style='margin-right:0px;'>";
    $output .= "        </div>";
    $output .= "        <div class='col-xs-8'>";
    $output .= "          <label for='example-text-input' class='col-2 col-form-label' style='text-align:left; margin-top:5px;'>unidades</label>";
    $output .= "        </div>";
    $output .= "      </div>";    
	$output .= "    </div>";
	$output .= "    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'></div>";
	$output .= "  </div>";
	$output .= "  <br>";

	$output .= "  <div class='row'>";
	$output .= "    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'></div>";
	$output .= "    <div class='col-lg-8 col-md-8 col-sm-8 col-xs-8'>";
	$output .= "      <p id='refID'> Código: ".$referencia."</p>";
	$output .= "    </div>";
	$output .= "    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'></div>";
	$output .= "  </div>";
   
	$output .= "  <div class='row'>";
	$output .= "    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'></div>";
	$output .= "    <div class='col-lg-8 col-md-8 col-sm-8 col-xs-8'>";
    $output .= "      <p id='valorSumKitID' style='display:none;'>".$valorTotal."</p>";
    $output .= "      <p id='valor001ID'>R$ 0.00</p>";
	$output .= "    </div>";
	$output .= "    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'></div>";
	$output .= "  </div>";
    
	$output .= "  <br>";
	$output .= "  <div class='row'>";
	$output .= "    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>";
	$output .= "    </div>";
	$output .= "    <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>";
    $output .= "      <a href='#'><p id='produtoPedirKitID'><img src='http://mairibel.com.br/app/images/icons/MBButtonsPedir.png' style='width:100%; height:4.0em;' ></p></a>";
	$output .= "    </div>";
	$output .= "    <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>";
    $output .= "      <a href='#'><p id='produtoFecharID'><img src='http://mairibel.com.br/app/images/icons/MBButtonsFechar.png' style='width:100%; height:4.0em;' ></p></a>";
	$output .= "    </div>";
	$output .= "    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>";
	$output .= "    </div>";
	$output .= "  </div>";
	$output .= "</div>";
}

    $output .= "</table>";      

    echo $output;
  }  /* get details for Kits = 1 */

  /*==================================================================================================================*/
  else if($action == '999112'){
    $index = 0;	
	
    $revendedor  = $_GET['revendedor'];        
      
    $conn = openDatabase();	
    $output = ''; 

    $SQL = "SELECT DISTINCT id_pedido FROM pedidos WHERE id-revendedor=".$revendedor."ORDER BY id_pedido DESC";
	
    $user = $conn->prepare($SQL);
    $user->execute();
    $state = $user->fetchAll(PDO::FETCH_ASSOC);

	foreach($state as $statelist)
    {
	  $NoPedido[$index] = $statelist['id_pedido'];  // no of 'pedidos' ..
	  $index = $index+1;
	}
	
	$output .= "<style>";
	$output .= ".headlineFormat1 { margin-left:5px; font-size:12px; font-weight: bold; color:#666666; padding-top:10px; }";
	$output .= "</style>";
	
	$output .= "<table id='pedidoTable' class='table table-striped table-hover table-condensed well' style='width:98%; margin-left:1%;'>";
	$output .= "  <tr>";
	$output .= "    <td style='width:5%;'>";
    $output .= "      <p class='headlineFormat1'>Id</p>";
	$output .= "    </td>";
	$output .= "    <td style='width:15%;'>";
    $output .= "      <p class='headlineFormat1'>Data</p>";
	$output .= "    </td>";
	$output .= "    <td style='width:40%;'>";
    $output .= "      <p class='headlineFormat1'>Revendedor</p>";
	$output .= "    </td>";
	$output .= "    <td style='width:25%;'>";
    $output .= "      <p class='headlineFormat1'>Valor</p>";
	$output .= "    </td>";
    $output .= "    <td style='width:5%;'>";
    $output .= "      <p class='headlineFormat1'>Observação</p>";
    $output .= "    </td>";
	$output .= "    <td style='width:5%;'>";
    $output .= "      <p class='headlineFormat1'>Status</p>";
	$output .= "    </td>";
	$output .= "    <td style='width:5%;'>";
    $output .= "      <p></p>";
	$output .= "    </td>";
	$output .= "    <td style='width:5%;'>";
    $output .= "      <p></p>";
	$output .= "    </td>";
	$output .= "  </tr>";
	
    $countPedidos = count($NoPedido);
    for($i=0; $i<$countPedidos; $i++)
    {
	  $index=0;
      $SQL = "SELECT id_pedido, SUM(produto_preco), produto_quantidade, revendedores.nome, status, observacao, dt FROM pedidos FULL JOIN revendedores ON id_revendedor=revendedores.id WHERE id_pedido=".$NoPedido[$i]." ";
	
      $user = $conn->prepare($SQL);
      $user->execute();
      $state = $user->fetchAll(PDO::FETCH_ASSOC);
    
      foreach($state as $statelist)
      {
	    $idPedido       = $statelist['id_pedido'];
	    $data           = $statelist['dt'];
        $dataFormat = sprintf('%.11s', $data);

	    $idRevendedor   = $statelist['nome'];
	    $idProdutoPreco = $statelist['SUM(produto_preco)'];
	    $idProdutoPreco =  round($idProdutoPreco , 2);  
	    $quantidade     = $statelist['produto_quantidade'];
	    $observacao     = $statelist['observacao'];
	    $status         = $statelist['status'];
	    
	    $valorTotal = $idProdutoPreco * $quantidade;
        $valorTotal = number_format( $valorTotal, 2, ",", "." );
		    
	    $output .= "  <tr style='border-bottom: 1px solid #CCCCCC; width:100%;'>";
	    $output .= "    <td>";
        $output .= "      <p class='headlineFormat1'>".$idPedido."</p>";
	    $output .= "    </td>";
	    $output .= "    <td>";
        $output .= "      <p class='headlineFormat1''>".$dataFormat."</p>";
	    $output .= "    </td>";
	    $output .= "    <td>";
        $output .= "      <p class='headlineFormat1'>".$idRevendedor."</p>";
	    $output .= "    </td>";
	    $output .= "    <td>";
	    $output .= "      <div class='headlineFormat1'>RS ".$valorTotal."</div>";
	    $output .= "    </td>";
        $output .= "    <td>";
	    $output .= "      <div class='headlineFormat1'>".$observacao."</div>";
        $output .= "    </td>";
	    $output .= "    <td>";
        
          if ($status==1) {
	        $output .= "<div style='background-color:#FF0000; color:#FF0000; width:50%; margin-left:25%; height:80%; margin-top:10%;'>x</div>";
          }
          elseif ($status==2){
	        $output .= "<div style='background-color:#DDEE88; color:#DDEE88; width:50%; margin-left:25%; height:80%; margin-top:10%;'>x</div>";
          }
          elseif ($status==3){
	        $output .= "<div style='background-color:#3333FF; color:#3333FF; width:50%; margin-left:25%; height:80%; margin-top:10%;'>x</div>";  
          }
          elseif ($status==4){
	        $output .= "<div style='background-color:#00FF00; color:#00FF00; width:50%; margin-left:25%; height:80%; margin-top:10%;'>x</div>";
          }
          
	    $output .= "    </td>";
	    $output .= "    <td>";
	    $output .= "      <div style=' width:70%; margin-left:35%; height:80%; margin-top:10%;'>edit</div>";
	    $output .= "    </td>";
	    $output .= "    <td>";
	    $output .= "      <div style=' width:70%; margin-left:35%; height:80%; margin-top:10%;'>del</div>";
	    $output .= "    </td>";
	    $output .= "  </tr>";
	    $index = $index+1;
      }
	  //$output .= "</br>";
    }	
	$output .= "</table>"; 
    $output .=	'';
	
    echo $output;
  }     /* get * from  'pedidos'  for desktop*/

  else if($action == '888'){  
    $index = 0;	

    $status  = $_GET['status'];  
    
    $conn = openDatabase();	
    $output = ''; 

//    $SQL = "SELECT DISTINCT id_pedido FROM pedidos ORDER BY id_pedido DESC";
    
    if ($status == 0)
        $SQL = "SELECT DISTINCT id_pedido FROM pedidos ORDER BY id_pedido DESC";
    else if ($status == 1)
        $SQL = "SELECT DISTINCT id_pedido FROM pedidos WHERE status='1' ORDER BY id_pedido DESC";
    else if ($status == 2)
        $SQL = "SELECT DISTINCT id_pedido FROM pedidos WHERE status='2' ORDER BY id_pedido DESC";
    else if ($status == 3)
        $SQL = "SELECT DISTINCT id_pedido FROM pedidos WHERE status='1' OR status='2' ORDER BY id_pedido DESC";
    else if ($status == 4)
        $SQL = "SELECT DISTINCT id_pedido FROM pedidos WHERE status='3' ORDER BY id_pedido DESC";
    else if ($status == 5)
        $SQL = "SELECT DISTINCT id_pedido FROM pedidos WHERE status='1' OR status='3' ORDER BY id_pedido DESC";
    else if ($status == 6)
        $SQL = "SELECT DISTINCT id_pedido FROM pedidos WHERE status='2' OR status='3' ORDER BY id_pedido DESC";
    else if ($status == 7)
        $SQL = "SELECT DISTINCT id_pedido FROM pedidos WHERE status='1' OR status='2' OR status='3' ORDER BY id_pedido DESC";
    else if ($status == 8)
        $SQL = "SELECT DISTINCT id_pedido FROM pedidos WHERE status='4' ORDER BY id_pedido DESC";
    else if ($status == 9)
        $SQL = "SELECT DISTINCT id_pedido FROM pedidos WHERE status='1' OR status='4' ORDER BY id_pedido DESC";
    else if ($status == 10)
        $SQL = "SELECT DISTINCT id_pedido FROM pedidos WHERE status='2' OR status='4' ORDER BY id_pedido DESC";
    else if ($status == 11)
        $SQL = "SELECT DISTINCT id_pedido FROM pedidos WHERE status='1' OR status='2' OR status='4' ORDER BY id_pedido DESC";
    else if ($status == 12)
        $SQL = "SELECT DISTINCT id_pedido FROM pedidos WHERE status='3' OR status='4' ORDER BY id_pedido DESC";
    else if ($status == 13)
        $SQL = "SELECT DISTINCT id_pedido FROM pedidos WHERE status='1' OR status='3' OR status='4' ORDER BY id_pedido DESC";
    else if ($status == 14)
        $SQL = "SELECT DISTINCT id_pedido FROM pedidos WHERE status='2' OR status='3' OR status='4' ORDER BY id_pedido DESC";
    else if ($status == 15)
        $SQL = "SELECT DISTINCT id_pedido FROM pedidos WHERE status='1' OR status='2' OR status='3' OR status='4' ORDER BY id_pedido DESC";

    else if ($status == 16)
        $SQL = "SELECT DISTINCT id_pedido FROM pedidos WHERE status='5' ORDER BY id_pedido DESC";
    else if ($status == 17)
        $SQL = "SELECT DISTINCT id_pedido FROM pedidos WHERE status='1' OR status='5' ORDER BY id_pedido DESC";
    else if ($status == 18)
        $SQL = "SELECT DISTINCT id_pedido FROM pedidos WHERE status='2' OR status='5' ORDER BY id_pedido DESC";
    else if ($status == 19)
        $SQL = "SELECT DISTINCT id_pedido FROM pedidos WHERE status='1' OR status='2' OR status='5' ORDER BY id_pedido DESC";
    else if ($status == 20)
        $SQL = "SELECT DISTINCT id_pedido FROM pedidos WHERE status='3' OR status='5' ORDER BY id_pedido DESC";
    else if ($status == 21)
        $SQL = "SELECT DISTINCT id_pedido FROM pedidos WHERE status='1' OR status='3' OR status='5' ORDER BY id_pedido DESC";
    else if ($status == 22)
        $SQL = "SELECT DISTINCT id_pedido FROM pedidos WHERE status='2' OR status='3' OR status='5' ORDER BY id_pedido DESC";
    else if ($status == 23)
        $SQL = "SELECT DISTINCT id_pedido FROM pedidos WHERE status='1' OR status='2' OR status='3' OR status='5' ORDER BY id_pedido DESC";
    else if ($status == 24)
        $SQL = "SELECT DISTINCT id_pedido FROM pedidos WHERE status='4' OR status='5' ORDER BY id_pedido DESC";
    else if ($status == 25)
        $SQL = "SELECT DISTINCT id_pedido FROM pedidos WHERE status='1' OR status='4' OR status='5' ORDER BY id_pedido DESC";
    else if ($status == 26)
        $SQL = "SELECT DISTINCT id_pedido FROM pedidos WHERE status='2' OR status='4' OR status='5' ORDER BY id_pedido DESC";
    else if ($status == 27)
        $SQL = "SELECT DISTINCT id_pedido FROM pedidos WHERE status='1' OR status='2' OR status='4' OR status='5' ORDER BY id_pedido DESC";
    else if ($status == 28)
        $SQL = "SELECT DISTINCT id_pedido FROM pedidos WHERE status='2' OR status='4' OR status='5' ORDER BY id_pedido DESC";
    else if ($status == 29)
        $SQL = "SELECT DISTINCT id_pedido FROM pedidos WHERE status='1' OR status='2' OR status='4' OR status='5' ORDER BY id_pedido DESC";
    else if ($status == 30)
        $SQL = "SELECT DISTINCT id_pedido FROM pedidos WHERE status='2' OR status='3' OR status='4' OR status='5' ORDER BY id_pedido DESC";
    else if ($status == 31)
        $SQL = "SELECT DISTINCT id_pedido FROM pedidos WHERE status='1' OR status='2' OR status='3' OR status='4' OR status='5' ORDER BY id_pedido DESC";
      
    
    $user = $conn->prepare($SQL);
    $user->execute();
    $state = $user->fetchAll(PDO::FETCH_ASSOC);

	foreach($state as $statelist)
    {
	  $NoPedido[$index] = $statelist['id_pedido'];  // no of 'pedidos' ..
	  $index = $index+1;
	}
	
	$output .= "<style>";
	$output .= ".headlineFormat1 { margin-left:5px; font-size:12px; font-weight: bold; color:#666666; padding-top:10px; }";
	$output .= ".signalImage { width:80%; margin-left:15%; height:80%; margin-top:10%; }";
	$output .= "</style>";

    $output .= "<table id='pedidoTable' class='display compact' style='width:98%; margin-left:1%;'>";
	$output .= " <thead>";
	$output .= "  <tr>";
	$output .= "    <td style='width:5%;'>";
    $output .= "      <p class='pedidoClass'>Id</p>";
	$output .= "    </td>";
	$output .= "    <td style='width:20%;'>";
    $output .= "      <p class=''>Data</p>";
	$output .= "    </td>";
	$output .= "    <td style='width:40%;'>";
    $output .= "      <p class=''>Revendedor</p>";
	$output .= "    </td>";
	$output .= "    <td style='width:20%;'>";
    $output .= "      <p class=''>Valor</p>";
	$output .= "    </td>";
	$output .= "    <td style='width:5%;'>";
    $output .= "      <p class=''>Status</p>";
	$output .= "    </td>";
	$output .= "    <td style='width:4%;'>";
	$output .= "    </td>";
	$output .= "    <td style='width:3%;'>";
	$output .= "    </td>";
	$output .= "    <td style='width:3%;'>";
	$output .= "    </td>";
	$output .= "  </tr>";
	$output .= " </thead>";

	$output .= " <tfoot>";
	$output .= "  <tr>";
	$output .= "    <td>";
    $output .= "      <p class='headlineFormat1'>Id</p>";
	$output .= "    </td>";
	$output .= "    <td>";
    $output .= "      <p class='headlineFormat1'>Data</p>";
	$output .= "    </td>";
	$output .= "    <td>";
    $output .= "      <p class='headlineFormat1'>Revendedor</p>";
	$output .= "    </td>";
	$output .= "    <td>";
    $output .= "      <p class='headlineFormat1'>Valor</p>";
	$output .= "    </td>";
	$output .= "    <td>";
    $output .= "      <p class='headlineFormat1'>Status</p>";
	$output .= "    </td>";
	$output .= "    <td>";
	$output .= "    </td>";
	$output .= "    <td>";
	$output .= "    </td>";
	$output .= "    <td>";
	$output .= "    </td>";
	$output .= "  </tr>";
	$output .= " </tfoot>";
	$output .= " <tbody>";
      
    $countPedidos = count($NoPedido);
    for($i=0; $i<$countPedidos; $i++)
    {
	  $index=0;
      $SQL = "SELECT id_pedido, SUM(preco_total), produto_quantidade, revendedores.nome, status, observacao, dt 
      FROM pedidos 
      FULL JOIN revendedores ON id_revendedor=revendedores.codigo 
      WHERE id_pedido=".$NoPedido[$i]." ";
	
      $user = $conn->prepare($SQL);
      $user->execute();
      $state = $user->fetchAll(PDO::FETCH_ASSOC);
    
      foreach($state as $statelist)
      {
	    $idPedido       = $statelist['id_pedido'];
	    $data           = $statelist['dt'];
	    $idRevendedor   = $statelist['nome'];
	    $idProdutoPreco = $statelist['SUM(preco_total)'];
	    $idProdutoPrecoRnd = round($idProdutoPreco , 2);  
	    $quantidade     = $statelist['produto_quantidade'];
	    $observacao     = $statelist['observacao'];
	    $status         = $statelist['status'];
	    
//	    $valorTotal     = $idProdutoPrecoRnd * $quantidade;
	    $valorTotal     = $idProdutoPrecoRnd;
        $valorTotalForm = number_format( $valorTotal, 2, ",", "." );
          
//echo ' id: '.$idPedido.' | preco: '.$idProdutoPrecoRnd.' | quant: '.$quantidade.' | valorTotal: '.$valorTotalForm;
          
	    $output .= "  <tr style='border-bottom: 1px solid #CCCCCC; width:100%;'>";
	    $output .= "    <td>";
        $output .= "      <p class='pedidoClass'>".$idPedido."</p>";
	    $output .= "    </td>";
	    $output .= "    <td>";
        $output .= "      <p class='''>".$data."</p>";
	    $output .= "    </td>";
	    $output .= "    <td>";
        $output .= "      <p class=''>".$idRevendedor."</p>";
	    $output .= "    </td>";
	    $output .= "    <td>";
	    $output .= "      <div class=''>RS ".$valorTotalForm."</div>";
	    $output .= "    </td>";
	    $output .= "    <td>";
        if ($status == 0) {
            $output .= "<div class='signalImage'><a href='#' id='work'><img src='images/signalYellow.png' style='width:100%;' /></a></div>";    
        }
        else if ($status == 1) {
            $output .= "<div class='signalImage'><a href='#' id='work'><img src='images/signalRed.png' style='width:100%;' /></a></div>";    
        }
        else if ($status == 2) {
            $output .= "<div class='signalImage'><a href='#' id='work'><img src='images/signalOrange.png' style='width:100%;' /></a></div>";    
        }
        else if ($status == 3) {
            $output .= "<div class='signalImage'><a href='#' id='work'><img src='images/signalBlue.png' style='width:100%;' /></a></div>";    
        }
        else if ($status == 4) {
            $output .= "<div class='signalImage'><a href='#' id='work'><img src='images/signalGreen.png' style='width:100%;' /></a></div>";    
        }
	    $output .= "    </td>";
	    $output .= "    <td>";
	    $output .= "      <div class='signalImage'><a href='#' id='work'><img src='images/hammer.png' style='width:100%;' /></a></div>";
	    $output .= "    </td>";
	    $output .= "    <td>";
	    $output .= "      <div class='signalImage'><a href='#' id='delete'><img src='images/error.png' style='width:100%;' /></a></div>";
	    $output .= "    </td>";
	    $output .= "    <td>";
	    $output .= "      <div class='signalImage'><a href='#' id='import'><img src='images/plus.png' style='width:100%;' /></a></div>";
	    $output .= "    </td>";
	    $output .= "  </tr>";
	    $index = $index+1;
      }
	  //$output .= "</br>";
    }	
	$output .= " </tbody>";
	$output .= "</table>"; 
    $output .=	'';
	
    echo $output;
  }  /* get * from  'pedidos' */

  else if($action == '889'){
	
    $idNo  = $_GET['pedidoId'];  
    $pedidoNo = $idNo;
	
    $conn = openDatabase();	
    $output = '';  
    $SQL = "SELECT id, id_produto, id_revendedor, produto_nome, produto_preco, produto_quantidade, observacao FROM pedidos WHERE id_pedido=".$idNo." ";

	$user = $conn->prepare($SQL);
    $user->execute();
    $state = $user->fetchAll(PDO::FETCH_ASSOC);

	$output .= "<p id='PedidoNo889'>No : ".$idNo."</p>";

    $output .= "<table class='table table-striped table-hover table-condensed' id='pedidoProdutos'>";
	$output .= "  <tr style='width:100%; font-weight: bold;'>";
	$output .= "    <td style='width:45%;'>";
	$output .= "      <p>Nome</p>";
	$output .= "    </td>";
	$output .= "    <td style='width:10%;'>";
	$output .= "      <p>Código</p>";
	$output .= "    </td>";
	$output .= "    <td style='width:10%;'>";
	$output .= "      <p>Quantidade</p>";
	$output .= "    </td>";
	$output .= "    <td style='width:10%;'>";
	$output .= "      <p>Valor</p>";
	$output .= "    </td>";
	$output .= "    <td style='width:15%;'>";
	$output .= "      <p>Valor Total</p>";
	$output .= "    </td>";
	$output .= "    <td style='width:5%;'>";
	$output .= "    </td>";
	$output .= "    <td style='width:5%;'>";
	$output .= "    </td>";
	$output .= "    <td style='width:0%;'>";
	$output .= "    </td>";
	$output .= "    <td style='width:0%;'>";
	$output .= "    </td>";
	$output .= "   </tr>";
	
    foreach($state as $statelist)
	{
	  $idNo         = $statelist['id'];
	  $produtoId    = $statelist['id_produto'];
	  $nome         = $statelist['produto_nome'];
	  $valor        = $statelist['produto_preco'];
      $valorRounded = sprintf('%0.2f', $valor);
	  $quantidade   = $statelist['produto_quantidade'];
	  $observacao   = $statelist['observacao'];
	  $valorTotal   = $valor*$quantidade;
      $valorTotalRounded = sprintf('%0.2f', $valorTotal);
	  $idRevendedor = $statelist['id_revendedor'];
        
      
	  $output .= "   <tr>";
	  $output .= "     <td>";
	  $output .= "       <p>".$nome."</p>";
	  $output .= "     </td>";
	  $output .= "     <td>";
	  $output .= "       <p>".$produtoId."</p>";
	  $output .= "     </td>";
	  $output .= "     <td>";
	  $output .= "       <p>".$quantidade."</p>";
//$output .= "      <input id='row-1-age' name='row-1-age' value='".$quantidade."' type='text'>";
	  $output .= "     </td>";
	  $output .= "     <td>";
	  $output .= "       <p>R$ ".$valor."</p>";
	  $output .= "     </td>";
	  $output .= "     <td>";
	  $output .= "       <p>R$ ".$valorTotalRounded."</p>";
	  $output .= "     </td>";
	  $output .= "     <td>";
	    $output .= "      <div style='height:10%; margin-top:10%;'><a href='#' id='work'><img src='images/tools.png' style='width:70%;' /></a></div>";
	  $output .= "     </td>";
	  $output .= "     <td>";
	    $output .= "      <div style='height:10%; margin-top:10%;'> <a href='#' id='work'><img src='images/minus.png' style='width:70%;' /></a></div>";
	  $output .= "     </td>";
	  $output .= "     <td style='width:0px;'>";
	  $output .= "       <p style='width:0px; color:#FFFFFF; display:none;'>".$pedidoNo."</p>";
	  $output .= "     </td>";
	  $output .= "     <td style='width:0px;'>";
	  $output .= "       <p style='width:0px; color:#FFFFFF; display:none;'>".idRevendedor."</p>";
	  $output .= "     </td>";
	  $output .= "   </tr>";
	}
	
	$output .= "</table>";
	
    echo $output;
  }  /* get details for selected 'pedido' */

  else if($action == '890'){  
	
	global $imagePath;
      
    $idNo        = $_GET['idNo'];  
$pedidoNo        = $_GET['idNo'];  
    $codigo     = $_GET['codigo'];  
    $quantidade = $_GET['quantidade'];  
    $quant = intval($quantidade);      
      
    $conn = openDatabase();	
    $output = '';  
    $SQL = "SELECT id, nome, referencia, valor, imagem1 FROM revendedores_produtos WHERE referencia=".$codigo." ";
	
	$user = $conn->prepare($SQL);
    $user->execute();
    $state = $user->fetchAll(PDO::FETCH_ASSOC);

    foreach($state as $statelist)
	{
	  $idNo = $statelist['id'];
	  $prodName = $statelist['nome'];
	  $imagem = $statelist['imagem1'];  
	  $referencia = $statelist['referencia'];  
	  $valor = $statelist['valor'];  
      $valorTotal = $quantidade * $valor;
      $valorTotalForm = number_format($valorTotal, 2, ".",",");

      $output .="	<style>.h4Clas{	font-family: Oswald, Georgia, Serif;}</style>";
      $output .="	<style>.h2Clas{ font-family: Oswald, Georgia, Serif; color:#FF0000; font-size:4.0em;}</style>";  
	  $output .= "<div class='row'>";
	  $output .= "  <div class='col-lg-12'>";
	  $output .= "    <h2 class='h4Clas'>".$prodName."</h2>";
	  $output .= "  </div>";
	  $output .= "</div>";	
	  $output .= "<hr>";
        
	  $output .= "<div class='row'>";
	  $output .= "  <div class='col-lg-6'>";
	  $output .= "    <img style='width:75%; margin-left:1%;' src=".$imagePath.$imagem." />";
	  $output .= "  </div>";
	  $output .= "  <div class='col-lg-6'>";
      $output .= "    <div class='row'>";
      $output .= "        <div class='col-lg-12'>";
	  $output .= "          <h2 id='referencia'> Código: ".$referencia."</h2>";
      $output .= "       </div>";
      $output .= "       <div class='col-lg-12'>";
	  $output .= "         <h2 class='h2Clas' id='valor'>R$ ".$valor."</h2>";
      $output .= "       </div>";
      $output .= "       <div class='col-lg-12'>";

      $output .= "         <form>";
      $output .= "           <div class='form-group'>";
      $output .= "             <label class='col-lg-3 control-label'><h4>Quantidade:</h4></label>";
      $output .= "             <div class='col-lg-9' style='width:20%;'>";
      $output .= "               <input class='form-control' id='quantidade' type='text' value='".$quant."' >";
      $output .= "             </div>";
      $output .= "           </div>";  
      $output .= "         </form>";
      $output .= "       </div>";
      $output .= "    </div>";
	  $output .= "  </div>";
	  $output .= "</div>";	
	  $output .= "<hr>";
          
	  $output .= "<div class='row'>";
	  $output .= "  <div class='col-lg-6'>";
    $output .= "         <h2 id='idNo' style='display:none;'>".$pedidoNo."</h2>";
	  $output .= "  </div>";
	  $output .= "  <div class='col-lg-6'>";
	  $output .= "    <h2 class='h2Clas' id='valorTotal'>R$ ".$valorTotalForm."</h2>";
	  $output .= "  </div>";
	  $output .= "</div>";
	}
	
    echo $output;
  }  /* get details for selected 'product' */

  else if($action == '891'){  
      
    $pedidoId     = $_GET['pedidoId']; 
            
    $conn = openDatabase();	
    $output = ''; 
      
    $SQL = "DELETE FROM pedidos WHERE id_pedido=".$pedidoId." ";

    $user = $conn->prepare($SQL);
    $user->execute();      
  }  /* delete record from 'pedidos' */

  else if($action == '892'){
    $pedidoId     = $_GET['pedidoId']; 
    $quantidade     = $_GET['quantidade']; 
    $referencia     = $_GET['referencia']; 

//$produto_preco = 43.34;
      
    $conn = openDatabase();	
      
    $SQL = "SELECT produto_preco FROM pedidos WHERE id_produto=".$referencia." ";
	$user = $conn->prepare($SQL);
    $user->execute();
    $state = $user->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($state as $statelist)
	{
        $produto_preco = $statelist['produto_preco'];  
    }
    
    
    // ------------------------------------------------------------------------
    $SQL = "UPDATE pedidos SET produto_quantidade=".$quantidade.", preco_total=".$quantidade*$produto_preco." WHERE id_pedido=".$pedidoId." AND id_produto=".$referencia." ";    
//echo $SQL;
      
    $user = $conn->prepare($SQL);
    $user->execute();
      
  }

  else if($action == '893'){
      
    $conn = openDatabase();	
    $SQL = "SELECT id, cod_venda FROM codigo_vendas ";
	$user = $conn->prepare($SQL);
    $user->execute();
    $state = $user->fetchAll(PDO::FETCH_ASSOC);
     
    foreach($state as $statelist)
	{
	  $cod_prevenda = $statelist['cod_venda'];
    }
      
//var_dump ($cod_prevenda);
      
    echo $cod_prevenda;
      
  }  /* read COD_VENDA */

/*  else if($action == '894'){
    
    $conn = openDatabase();	
    $SQL = "UPDATE codigo_vendas SET cod_venda=".$cod_prevenda." ";    
	$user = $conn->prepare($SQL);
    $user->execute();
    $state = $user->fetchAll(PDO::FETCH_ASSOC);
      
  }  */
/* write COD_VENDA */

  else if($action == '895'){
      
      $cod_prevenda  = $_GET['cod_prevenda'];  
      $xml1 = $_GET['xml1'];  
      $xml2 = $_GET['xml2'];  
      $pedidoNum = $_GET['pedidoNum']; 
      $sts = 0;
      
      $cod_prevendaStr = (string) $cod_prevenda;
      
      $sts = chdir('XMLFiles');
      
      //var_dump($cod_prevendaStr);
      $codePrevendatrimmed = trim($cod_prevendaStr);
      var_dump($codePrevendatrimmed);
     
      $sts = mkdir ($codePrevendatrimmed);  /* make new directory for COD_PREVENDA */
      
      chdir($codePrevendatrimmed);   /* change to new directory */

      /* create first XML-file 'PRE VENDA.XML' */
      $xml1file1 = fopen("PRE VENDA.XML", "w") or die("Unable to open file!");
      fwrite($xml1file1, $xml1);
      fclose($xml1file1);      
      
      /* create second XML-file 'ITENS DA PRE VENDA.XML' */
      $xml1file2 = fopen("ITENS DA PRE VENDA.XML", "w") or die("Unable to open file!");
      fwrite($xml1file2, $xml2);
      fclose($xml1file2);      
      
      $codPrevendaInt = (int)$codePrevendatrimmed + 1; /* save COD_PREVENDA into database .. */
      
      $conn = openDatabase();	
      $SQL = "UPDATE codigo_vendas SET cod_venda=".$codPrevendaInt." ";
      $user = $conn->prepare($SQL);
      $user->execute();
            
      /* change status to '2' */
      $conn = openDatabase();	
      $SQL = "UPDATE pedidos SET status=2 WHERE id_pedido=".$pedidoNum." ";
      $user = $conn->prepare($SQL);
      $user->execute();
      
  }  /* get XML files 1 & 2 */

  else if($action == '896'){
	
    $idNo  = $_GET['pedidoId'];
    $pedidoNo = $idNo;
    $valorTotalPedido = 0;
    $out = '';
    $index = 0;
      	
    $conn = openDatabase();
    $SQL = "SELECT id, id_produto, id_revendedor, produto_nome, produto_preco, produto_quantidade, observacao FROM pedidos WHERE id_pedido=".$idNo." ";
	$user = $conn->prepare($SQL);
    $user->execute();
    $state = $user->fetchAll(PDO::FETCH_ASSOC);

    /* build array of products for specified 'pedido'  */
    $out .= "[";
      
    foreach($state as $statelist)
	{
        if ($index > 0)
            $out .= ",";
        $idNo         = $statelist['id'];
        $produtoId    = $statelist['id_produto'];
        $nome         = $statelist['produto_nome'];
        $valor        = $statelist['produto_preco'];
        $valorRounded = sprintf('%0.2f', $valor);
        $quantidade   = $statelist['produto_quantidade'];
        $observacao   = $statelist['observacao'];
        $valorTotal   = $valor*$quantidade;
        $valorTotalRounded = sprintf('%0.2f', $valorTotal);
        $idRevendedor = $statelist['id_revendedor'];
        
        $valorTotalPedido = $valorTotalPedido + $valorTotalRounded;
           
        $out .= "[".$produtoId.",".$valorRounded.",".$valorTotalRounded.",".$quantidade.",".$idRevendedor."]";
    
        $index = $index+1;
    }
      
    $out .= "]";
      
    echo $out;
       
  }  /* get array of products for 'pedido' */

  else if($action == '897'){
      ;
  }
  else if($action == '898'){
      ;
  }
  else if($action == '899'){
      ;
  }
  else if($action == '900'){
      ;
  }


  /* end of server ==================================================*/



?>  
