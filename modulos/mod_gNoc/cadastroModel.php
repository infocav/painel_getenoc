<?php

class treinamentoModel
{
        private $NCESC = 2;
        private $ENTRADA = 5;
        private $SAIDA = 1;
        private $EXEMPLOS = 16;
        
	private $epocas = 1000;
        private $eta = 0.2;
        private $errodes = 0.0004;
        
        private $cvs = array();
        private $cvsNormalizado = array();
        private $cvsDesnormalizado = array();
        private $a = -1 ;//intervalo para normalização inferior
        private $b = 1; // intevalo para normalização superior
        private $arrayEntrada = array();
        private $arraySaida = array();
        
        private $biasCamadaOculta = array();
        private $biasCamadaFinal = array();
        private $pesosCamadaOculta = array();
        private $pesosCamadaFinal = array();
        
        private $saidaNeuronioOculta = array();
        private $saidaNeuronioSaida = array();
        private $deltaNeuronioOculta = array();
        private $deltaNeuronioSaida = array();
        
        
        private $arraySaidasRedeNormalizadas = array();
        private $arraySaidasRedeDesnormalizadas = array();
        private $msg='';
        private $arrayMaxMin = array();
        
        private $acao;
        
        private $timeStart;
        private $timeMsg;
        private $funcaoAtivacao;

       

                  
        function treinamentoModel($options)
	{
            $this->setNCESC($options['neuronio']);
            $this->setEpocas($options['epocas']);
            $this->setEta($options['treinamento']);
            $this->setErrodes($options['txerro']);
            $this->setAcao($options['action']);
            $this->setFuncaoAtivacao($options['funcaoAtivacao']);
            
             if ( strcasecmp($this->getFuncaoAtivacao(), "sigmoid") == 0 )
            {              
                $this->setA(0);
                   
            }
            
            if ( strcasecmp($this->getFuncaoAtivacao(), "hiperbolica") == 0 )
            {    
            
                $this->setA(-1);
            }   
            
//            $this->setFuncaoAtivacao('hiperbolica');
            //$this->setFuncaoAtivacao('sigmoid');
            

          // echo "QtdNeuronio:".$this->getNCESC().", Epocas: ".$this->getEpocas().", Eta: .".$this->getEta().", Erros:  ".$this->getErrodes();
         
	}
        
        function processarGrafico()
        {   
            $posReal = $this->getENTRADA();
            $posPrevista = $this->getENTRADA() + 1;
            
            $grafico = '<script type="text/javascript">
                        var options = {
                            responsive:true
                        };

                        var data = {
                        ';
            $arraySaidas = $this->getArraySaidasRedeDesnormalizadas();
            $arrlength = count($arraySaidas); //QUANTIDADE LINHAS
           
            $grafico .= ' labels: [';
            for($x = 0; $x < $arrlength ; $x++) { 
               
                $grafico .= '"'.$arraySaidas[$x][0].'"';
                if ($x != $arrlength -1 )
                {
                  $grafico .= ",";  
                }
            } 
            
            $grafico .= '],
                            datasets: [
                            {
                                label: "Dados reais",
                               fillColor: "rgba(220,220,220,0.2)",
                                strokeColor: "rgba(220,220,220,1)",
                                pointColor: "rgba(220,220,220,1)",
                                pointStrokeColor: "#fff",
                                pointHighlightFill: "#fff",
                                pointHighlightStroke: "rgba(220,220,220,1)",
                                data: [';
                
             for($x = 0; $x < $arrlength; $x++) { 
               
                $grafico .= ''.$arraySaidas[$x][$posReal].'';
                if ($x != $arrlength -1 )
                {
                  $grafico .= ",";  
                }
            }     
            
            $grafico .= ']},
                            {
                                label: "Dados previstos",
                                   fillColor: "rgba(110, 44, 44, 0.2)",
                                strokeColor: "rgba(110, 44, 44, 0.6)",
                                pointColor: "rgba(110, 44, 44, 0.6)",
                                pointStrokeColor: "#fff",
                                pointHighlightFill: "#fff",
                                pointHighlightStroke: "rgba(110, 44, 44, 0.6)",
                                data: [';
            
             for($x = 0; $x < $arrlength; $x++) { 
               
                $grafico .= ''.$arraySaidas[$x][$posPrevista].'';
                if ($x != $arrlength -1 )
                {
                  $grafico .= ",";  
                }
            }  
            $grafico .= '] }]};</script>';
            
            return $grafico;
            
            
        }
        
         function processarGraficoJSON()
        {   
            $posReal = $this->getENTRADA();
            $posPrevista = $this->getENTRADA() + 1;
            
//            $json = '{
//                    labels: ["65", "59", "80", "81", "56", "55", "40"],
//                    real: [65, 59, 80, 81, 56, 55, 40],
//                    previsto:[65, 59, 80, 81, 56, 55, 40],
//                    erro: [65, 59, 80, 81, 56, 55, 40]
//                    }';
            
           //   $grafico = array();
            $arraySaidas = $this->getArraySaidasRedeDesnormalizadas();
            $arrlength = count($arraySaidas); //QUANTIDADE LINHAS
           
            $json = '{"labels": [';
            for($x = 0; $x < $arrlength ; $x++) { //labels
               
                 $json .= '"'.$arraySaidas[$x][0].'"';
                if ($x != $arrlength -1 )
                {
                  $json .= ",";  
                }
              
                //$grafico[0][$x] = $arraySaidas[$x][0];
              
            }      
             $json .= '],';
             $json .= '"real": [';       
             
            for($x = 0; $x < $arrlength; $x++) { //dados reais
                 $json .= ''.$arraySaidas[$x][$posReal].'';
                if ($x != $arrlength -1 )
                {
                  $json .= ",";  
                }
               // $grafico[1][$x] = $arraySaidas[$x][$posReal];
               
            }
             $json .= '],';
             $json .= '"previsto": [';
             for($x = 0; $x < $arrlength; $x++) { //dados previsto pela rede
                $json .= ''.$arraySaidas[$x][$posPrevista].'';
                if ($x != $arrlength -1 )
                {
                  $json .= ",";  
                }
               // $grafico[2][$x] = $arraySaidas[$x][$posPrevista];
               
            }  
             $json .= '],';
             $json .= '"erro": [';
           for($x = 0; $x < $arrlength; $x++) { //erro
                 $json .= ''.$arraySaidas[$x][$posReal] - $arraySaidas[$x][$posPrevista].'';
                if ($x != $arrlength -1 )
                {
                  $json .= ",";  
                }
              // $grafico[3][$x] = $arraySaidas[$x][$posReal] - $arraySaidas[$x][$posPrevista]; //FUNCIONANDO
                
              
            }  
            
             $json .= ']}';
            
           // return $grafico;
             return $json;
            
            
        }
        
        
        function funcaoNormalizar($a, $b, $x, $xMinimo, $xMaximo)
        {
           return ((($b-$a) * ($x - $xMinimo)) /($xMaximo - $xMinimo)) + $a;   
        }
        
        function funcaoDesnormalizar($a, $b, $x, $xMinimo, $xMaximo)
        {
           return ((($x-$a) * ($xMaximo - $xMinimo))/($b - $a )) + $xMinimo;   
        }
        
        
       function inicializarPesosBiasTESTE($NCESC, $ENTRADA, $SAIDA)
        {
             //INICIALIZA OS PESOS
            for($y = 0; $y < $NCESC; $y++){
                for($x = 0; $x < $SAIDA; $x++)
                {
                      //$w[$x][$y] = rand(0.001,1)%2 + .5;
                    $w[$x][$y] = 0.4;
                }
                for($x = 0; $x < $ENTRADA; $x++)
                {
                      $W[$y][$x] =0.4;
                }
                $biasesc[$y] = 0.4;
             }
             for($x = 0; $x < $SAIDA; $x++)
             {
                $biass[$x] = 0.4;
             }
             
            $this->setBiasCamadaOculta($biasesc);
            $this->setBiasCamadaFinal($biass);
            $this->setPesosCamadaOculta($W);
            $this->setPesosCamadaFinal($w);
        }
        
        function inicializarPesosBias($NCESC, $ENTRADA, $SAIDA)
        {
             //INICIALIZA OS PESOS
            for($y = 0; $y < $NCESC; $y++){
                for($x = 0; $x < $SAIDA; $x++)
                {
                      //$w[$x][$y] = rand(0.001,1)%2 + .5;
                   // $w[$x][$y] = rand(0, 10) / 10;
                    $w[$x][$y] = rand(-2, 2);
                     

                }
                for($x = 0; $x < $ENTRADA; $x++)
                {
                     // $W[$y][$x] = rand(0, 10) / 10;
                    $W[$y][$x] = rand(-2, 2);
                }
                //$biasesc[$y] = rand(0, 10) / 10;
                $biasesc[$y] =rand(-2, 2);
             }
             for($x = 0; $x < $SAIDA; $x++)
             {
                //$biass[$x] = rand(0, 10) / 10;
                 $biass[$x] = rand(-2, 2);
             }
             
            $this->setBiasCamadaOculta($biasesc);
            $this->setBiasCamadaFinal($biass);
            $this->setPesosCamadaOculta($W);
            $this->setPesosCamadaFinal($w);
        }
        
        function rodarTreinamentoNovo()
        {
            $this->iniciaTimer();
            $this->normalizarDados();
            $this->iniciarEntradas();
            $this->inicarSaidas();
            $this->inicializarPesosBias(
                               $this->getNCESC(), 
                               $this->getENTRADA(),
                               $this->getSAIDA()
                               );
//            $this->inicializarPesosBiasTESTE(
//                               $this->getNCESC(), 
//                               $this->getENTRADA(),
//                               $this->getSAIDA()
//                               );
            $this->treinarRedeNovo($this->getEpocas(), 
                               $this->getErrodes(), 
                               $this->getEta(), 
                               $this->getNCESC(), 
                               $this->getENTRADA(),
                               $this->getSAIDA(),
                               $this->getEXEMPLOS());
            
            $this->saidasNormalizadas( $this->getNCESC(), $this->getENTRADA(), $this->getSAIDA(), $this->getEXEMPLOS());
            $this->saidasDesnormalizadas($this->getA(), $this->getB(), $this->getNCESC(), $this->getENTRADA(), $this->getSAIDA(), $this->getEXEMPLOS());
            $this->finalizaTimer();
            
            
            
        }
        
        function treinarRedeNovo($epocas, $errodes, $eta ,$NCESC, $ENTRADA, $SAIDA, $EXEMPLOS)
        {
                for($x = 0; $x < $epocas; $x++){
                    
                   for($y = 0; $y < $EXEMPLOS; $y++){
                       //$this->setMsg($this->getMsg() . 'Epocas: '.$x. ', Exemplo: '.$y.'<br>') ;
                       
                       
                      $this->calcularSaidas($NCESC, $ENTRADA, $SAIDA, $y ,$epocas);
                      $this->calculateDelta($NCESC, $ENTRADA, $SAIDA, $y);
                      $this->calculateNewWeights($eta ,$NCESC, $ENTRADA, $SAIDA,$y);
                      $this->calculateNewBias($NCESC, $SAIDA);
                      
                      //$this->setMsg($this->getMsg() . '****Fim do exemplo: '.  $y.'<br>');
                   }
                    //$this->setMsg($this->getMsg() .  '****Fim da epoca: '.  $x.'<br>');
  
                } 
        }
        
        
        function calculateNewBias($NCESC, $SAIDA){
           
            $deltaOculta = $this->getDeltaNeuronioOculta();
            $deltaSaida = $this->getDeltaNeuronioSaida();
           
            $biasesc = $this->getBiasCamadaOculta();
            $biass = $this->getBiasCamadaFinal();
            
            //$this->setMsg($this->getMsg() .  'Calculo dos novos BIAS<br>');
            //INICIALIZA OS PESOS
            for($y = 0; $y < $NCESC; $y++){
                //$this->setMsg($this->getMsg() .  'Neuronio camada OCULTA: '.$y.'<br>');
   
                //$this->setMsg($this->getMsg() .  'Camada Oculta - Bias atual: '.$biasesc[$y].' + delta Oculta: '. $deltaOculta[$y]);
                $biasesc[$y] += $deltaOculta[$y];
                //$this->setMsg($this->getMsg() .  ' = '.$biasesc[$y].'<br>');

             }
             for($x = 0; $x < $SAIDA; $x++)
             {
                //$this->setMsg($this->getMsg() .  'Neuronio camada SAIDA: '.$x.'<br>');
                //$this->setMsg($this->getMsg() .  'Camada saida - Bias atual: '.$biass[$x].' + delta saida: '. $deltaSaida[$x]);

                $biass[$x] += $deltaSaida[$x];
                                //$this->setMsg($this->getMsg() .  ' = '.$biass[$x].'<br>');

             }
             
            $this->setBiasCamadaOculta($biasesc);
            $this->setBiasCamadaFinal($biass);
            
        }
        
        function calculateNewWeights($eta ,$NCESC, $ENTRADA, $SAIDA, $exemplo)
        {
             $W = $this->getPesosCamadaOculta();
             $w = $this->getPesosCamadaFinal();
             
             $deltaOculta = $this->getDeltaNeuronioOculta();
             $deltaSaida = $this->getDeltaNeuronioSaida();
             
             $entradas = $this->getArrayEntrada();
             $phiesc = $this->getSaidaNeuronioOculta();
             $phi = $this->getSaidaNeuronioSaida();

              //$this->setMsg($this->getMsg() .  'Calculo dos novos PESOS <br>');
             
             for($x = 0; $x < $NCESC; $x++)
             {
                 //$this->setMsg($this->getMsg() .  'Neuronio da camada oculta:  '.$x.' <br>');

                 for($y = 0; $y < $ENTRADA; $y++)
                 {
                      //$this->setMsg($this->getMsg() .  'Peso antigo camada oculta '.$W[$x][$y].' <br>');
                    //$W[$x][$y] += ( $eta * $deltaOculta[$x] * $entradas[$y][$exemplo] * $phiesc[$x] * ( 1 - $phiesc[$x]));
                    $W[$x][$y] += ( $eta * $deltaOculta[$x] * $entradas[$y][$exemplo] * $this->calculaDerivada($phiesc[$x]) );
                     //$this->setMsg($this->getMsg() .  'Eta: '.$eta. ' * deltaCamadaOculta: '.$deltaOculta[$x]. ' * entrada: '.$entradas[$y][$exemplo].' * derivada: da saida do neuronio:  '.$phiesc[$x].', derivada: '.$this->calculaDerivada($phiesc[$x]).' = novo peso'.$W[$x][$y].'<br>');
                 }
                              
             }
             
              for($x = 0; $x < $SAIDA; $x++)
             {
                   //$this->setMsg($this->getMsg() .  'Neuronio da camada de saida:  '.$x.' <br>');

                 for($y = 0; $y < $NCESC; $y++)
                 {
                      //$this->setMsg($this->getMsg() .  'Peso antigo camada de saida '.$w[$x][$y].' <br>');

                     //$w[$x][$y] += ( $eta * $deltaSaida[$x] * $phiesc[$y] * $phi[$x] * ( 1 - $phi[$x]));
                     $w[$x][$y] += ( $eta * $deltaSaida[$x] * $phiesc[$y] * $this->calculaDerivada($phi[$x]));
                      //$this->setMsg($this->getMsg() .  'Eta: '.$eta. ' * deltaCamadaSaida: '.$deltaSaida[$x]. ' * entrada: '.$phiesc[$y].' * derivada: da saida do neuronio:  '.$phi[$x].', derivada: '.$this->calculaDerivada($phi[$x]).' = novo peso'.$w[$x][$y].'<br>');

                 }
                              
             }
       
            $this->setPesosCamadaOculta($W);
            $this->setPesosCamadaFinal($w);
            
//             echo "<pre>Camada oculta pesos";
//            print_r(var_dump(  $W));
//           echo  "</pre>";

        }
        
        function calculaDerivada($dados)
        {
           if ( strcasecmp($this->getFuncaoAtivacao(), "sigmoid") == 0 )
            {              
                return   $dados * ( 1 - $dados);//sigmoid
                   
            }
            
            if ( strcasecmp($this->getFuncaoAtivacao(), "hiperbolica") == 0 )
            {    
            
                //return pow((1/(cosh( $dados))), 2);
                return pow( 1/(cosh($dados)*cosh($dados)) ,2);
                //$dados * ( 1 - $dados);//sigmoid
            }   
        }
        
        
        function calculateDelta( $NCESC, $ENTRADA, $SAIDA, $exemplo ){
                      
            $deltaSaida = array();
            $deltaOculta = array();
            $saidas= array();
            $saidas= $this->getArraySaida();
            
            $w = $this->getPesosCamadaFinal();
            $phi = $this->getSaidaNeuronioSaida();
            $phiesc = $this->getSaidaNeuronioOculta();

            
            $qtdSaida = count($phi);
            $qtdOculta = count($phiesc);
            
             //$this->setMsg($this->getMsg() .  'Calculo do DELTA<br>');

            //neuronios de saida
            for($contt = 0; $contt < $qtdSaida; $contt++)
            {
                $deltaSaida[$contt] = $saidas[$contt][$exemplo] - $phi[$contt];
                 //$this->setMsg($this->getMsg() . 'Delta camada saida: '.$deltaSaida[$contt].'<br> ');
            }
                
                        
            for ($contt = 0; $contt < $qtdOculta; $contt++)
            {   
                 $deltaOculta[$contt] = 0;   
                 for ($contt2 = 0; $contt2 < $qtdSaida; $contt2++)
                 {
                    $deltaOculta[$contt] +=  ( $deltaSaida[$contt2] * $w[$contt2][$contt] );
                     //$this->setMsg($this->getMsg() .  'Delta camada oculta: '.$deltaOculta[$contt].'<br> ');
                                     
                 }
                 
                                 
            }
            
            
//                 echo "<pre> Delta camada  OCULTA
//                ";
//                print_r(var_dump($deltaOculta));
//                echo "Delta camada de saida"
//                . "";
//                print_r(var_dump($deltaSaida));
//                echo  "</pre>";
                   
            
            $this->setDeltaNeuronioOculta($deltaOculta);
            $this->setDeltaNeuronioSaida($deltaSaida);
             
         }
        
         function calcularSaidas($NCESC, $ENTRADA, $SAIDA, $exemplo, $epocas)
        {
            $contt;
            $cont2;
            $niesc = array();
            $phiesc= array();
            $ni= array(); 
            $phi = array();
            
            $entradas= array(); 
            $entradas = $this->getArrayEntrada();
           
            
            $biasesc = $this->getBiasCamadaOculta();
            $biass = $this->getBiasCamadaFinal();
            $W = $this->getPesosCamadaOculta();
            $w = $this->getPesosCamadaFinal();
            
             //$this->setMsg($this->getMsg() .  'Calcular saidas SOMATORIO + FUNCAO DE ATIVAÇÃO <br>');
                               //neuronios de ENTRADA
            
//             echo "<pre>Maximo e minimo: func normalizarDados";
//              print_r(var_dump($biasesc));
//              echo  "</pre>";
            for($contt = 0; $contt < $NCESC; $contt++){
               $niesc[$contt] = 0;
                //$this->setMsg($this->getMsg() .  'Neuronio, Camada oculta:  '.$contt.'<br>');
              for($cont2 = 0; $cont2 < $ENTRADA; $cont2++)
              {
                  $niesc[$contt] += $W[$contt][$cont2]*$entradas[$cont2][$exemplo]; //somat�rio
                   //$this->setMsg($this->getMsg() .  'Entrada: '.$entradas[$cont2][$exemplo]. ', peso: '. $W[$contt][$cont2]);
                  
              }
               
               $niesc[$contt] +=  $biasesc[$contt]; //total do somatorio + bias
                //$this->setMsg($this->getMsg() .  ', bias: '.$biasesc[$contt]. ', Somatório + bias: '. $niesc[$contt],'<br>');
               
               $phiesc[$contt] = $this->funcaoAtivacao($niesc[$contt]);
               
                 //$this->setMsg($this->getMsg() .  'Saida do neuronio camada oculta(FUNCAO DA ATIVACAO): neuronio: '.$contt.' , saida: ' .$phiesc[$contt].' <br> ');


            }

            //neuronio  de SAIDA
            for($contt = 0; $contt < $SAIDA; $contt++){
                $ni[$contt] = 0;
                  //$this->setMsg($this->getMsg() .  'Neuronio, Camada saida:  '.$contt.'<br>');
                for($cont2 = 0; $cont2 < $NCESC; $cont2++)
                {
                      $ni[$contt] +=  $w[$contt][$cont2]*$phiesc[$cont2];
                       //$this->setMsg($this->getMsg() .  'Entrada: '.$phiesc[$cont2]. ', peso: '. $w[$contt][$cont2]);
                }
                
                $ni[$contt] += $biass[$contt];
                 //$this->setMsg($this->getMsg() .  ', bias: '.$biass[$contt]. ', Somatório + bias: '.  $ni[$contt].'<br>');
                $phi[$contt] = $this->funcaoAtivacao($ni[$contt]);
                
                  //$this->setMsg($this->getMsg() .  'Saida do neuronio da camada de saida(FUNCAO DA ATIVACAO):  neuronio: '.$contt.' , saida: ' . $phi[$contt].' <br> ');
           }

            $this->setSaidaNeuronioOculta($phiesc);
            $this->setSaidaNeuronioSaida($phi);
             
            
            
        }
        
        function  funcaoAtivacao($somatorio)
        {
            if ( strcasecmp($this->getFuncaoAtivacao(), "sigmoid") == 0 )
            {              
                return   1/(1 + exp((-1)*$somatorio));//sigmoid
                   
            }
            
            if ( strcasecmp($this->getFuncaoAtivacao(), "hiperbolica") == 0 )
            {    
            
                return tanh($somatorio);
            }
        }
        
        
        function rodarTreinamento()        
        {   
            $this->iniciaTimer();
            $this->normalizarDados();
            $this->iniciarEntradas();
            $this->inicarSaidas();
            $this->setMsg($this->treinarRede($this->getEpocas(), 
                               $this->getErrodes(), 
                               $this->getEta(), 
                               $this->getNCESC(), 
                               $this->getENTRADA(),
                               $this->getSAIDA(),
                               $this->getEXEMPLOS())
                    );
            
            $this->saidasNormalizadas( $this->getNCESC(), $this->getENTRADA(), $this->getSAIDA(), $this->getEXEMPLOS());
            $this->saidasDesnormalizadas($this->getA(), $this->getB(), $this->getNCESC(), $this->getENTRADA(), $this->getSAIDA(), $this->getEXEMPLOS());
            $this->finalizaTimer();
        }
        
        function rodarSimulacao()
        {
            $this->iniciaTimer();
            $this->normalizarDados();
            $this->iniciarEntradas();
            $this->inicarSaidas();
            
                     
            $this->saidasNormalizadas( $this->getNCESC(), $this->getENTRADA(), $this->getSAIDA(), $this->getEXEMPLOS());
            $this->saidasDesnormalizadas($this->getA(), $this->getB(), $this->getNCESC(), $this->getENTRADA(), $this->getSAIDA(), $this->getEXEMPLOS());
            $this->desnormalizarDados();
            
            $this->finalizaTimer();

        }
        
      
     
        function rodarProcessamento()
        {
            
        }
        
        function normalizarDados()
        {
            $arrayNormalizacao = array();
            $cvsNormalizado = array();
           
            $cvs = $this->getCvs();
            $cvsNormalizado = $cvs;  
            
            
           // var_dump($this->getCvs());
            
            $arrlength = count($cvs); //QUANTIDADE LINHAS
            $entrada = $this->getENTRADA();
            $arrayMinMax = array();
            
            if ( strcasecmp($this->getAcao(), "simular") == 0 )
             {
                 $arrayMinMax = $this->getArrayMaxMin();

             }
             
            for($x = 0; $x < $entrada + 1; $x++) { // pecorre as colunas
               
                for ($y = 0; $y < $arrlength; $y++) //pecorre as linhas
                {
                   $arrayNormalizacao[$y] = $cvs[$y][$x];
                }

                
                
               if ( strcasecmp($this->getAcao(), "treinar") == 0 )
               {
                   $arrayMinMax[0][$x] = max($arrayNormalizacao); 
                   $arrayMinMax[1][$x] = min($arrayNormalizacao); 
                  
                   $this->setArrayMaxMin($arrayMinMax);
                   
               }
            
                $maximo = $arrayMinMax[0][$x];
                $minimo = $arrayMinMax[1][$x]; 

                for ($y = 0; $y < $arrlength; $y++) //pecorre as linhas
               {
                 $cvsNormalizado[$y][$x] = $this->funcaoNormalizar($this->getA(), $this->getB(),
                                                                        $arrayNormalizacao[$y],
                                                                        $minimo,
                                                                        $maximo);   
             
               }

             }    
                 
//              echo "<pre>Maximo e minimo: func normalizarDados";
//              print_r(var_dump($cvsNormalizado));
//              echo  "</pre>";
              $this->setCvsNormalizado($cvsNormalizado);
             
            
             
             
        }
        
        function desnormalizarDados()
        {
            
            $arrayDesnormalizacao = array();
            $cvsDesnormalizado = array();
            
            $cvsNormalizado = $this->getCvsNormalizado();

            
            $cvs = $this->getCvs();           
            $cvsDesnormalizado = $cvs;       

            $arrlength = count($cvs); //QUANTIDADE LINHAS
            $entrada = $this->getENTRADA();
            
            $arrayMinMax = array();
             
            
            if ( strcasecmp($this->getAcao(), "simular") == 0 )
             {
                 $arrayMinMax = $this->getArrayMaxMin();

             }

            for($x = 0; $x < $entrada; $x++) { // pecorre as colunas
                
                for ($y = 0; $y < $arrlength; $y++) //pecorre as linhas
                {
                   $arrayDesnormalizacao[$y] = $cvs[$y][$x];
                } 
                
               if ( strcasecmp($this->getAcao(), "treinar") == 0 )
                {
                                      
                    $arrayMinMax[0][$x] = max($arrayDesnormalizacao); 
                    $arrayMinMax[1][$x] = min($arrayDesnormalizacao); 
                  
                    $this->setArrayMaxMin($arrayMinMax);
                }

                $maximo = $arrayMinMax[0][$x];
                $minimo = $arrayMinMax[1][$x]; 
                
//                  $maximo =  max($arrayDesnormalizacao);
//                  $minimo = min($arrayDesnormalizacao);

                //  echo "<br/>Maximo: ".$maximo;
                //  echo "<br/>Minimo: ".$minimo;
                
                
                 for ($y = 0; $y < $arrlength; $y++) //pecorre as colunas
                 {
                     $cvsDesnormalizado[$y][$x] = $this->funcaoDesnormalizar($this->getA(), $this->getB(),
                                                                        $cvsNormalizado[$y][$x],
                                                                        $minimo,
                                                                        $maximo); 
                 }

             }
             
            
              $this->setCvsDesnormalizado($cvsDesnormalizado);
        }
        
        
        function iniciarEntradas()
        {   
            $cvsNormalizado = $this->getCvsNormalizado();
            $entrada = $this->getENTRADA();
            $exemplos = $this->getEXEMPLOS();
            $arrayEntradas = $this->getArrayEntrada();
              
            for($x = 0; $x < $entrada; $x++){   
                  for($y = 0; $y < $exemplos; $y++) {
                     $arrayEntradas[$x][$y]= $cvsNormalizado[$y][$x] ;
               }
            }
            
            $this->setArrayEntrada($arrayEntradas);
          
           //var_dump($this->getArrayEntrada());

        }
        
        function inicarSaidas()
        {
            $cvsNormalizado = $this->getCvsNormalizado();
            $saida = $this->getSAIDA();
            $exemplos = $this->getEXEMPLOS();
            $arraySaidas = $this->getArraySaida();
            $entradas = $this->getENTRADA();
            
            for($x = 0; $x < $saida; $x++){

               for($y = 0; $y < $exemplos; $y++){
                 
                    $arraySaidas[$x][$y] = $cvsNormalizado[$y][$entradas];
                 }   
            }
            
            $this->setArraySaida($arraySaidas);
           // var_dump($this->getArraySaida());
        }
        
        
      
        
        function treinarRede($epocas, $errodes, $eta ,$NCESC, $ENTRADA, $SAIDA, $EXEMPLOS)
        {
            
            $msg = 'Finalizado';
            $w = array(); $W= array(); $Erroinst; $Erromg = 0; $erro=array(); $niesc = array(); $ni= array(); 
            $biasesc= array(); $biass= array(); $phiesc= array(); $phi= array(); $philesc= array();
            $phil= array(); $delta= array(); $deltaesc= array();
            $x; $y; $cont2; $contt; $teste;
            
            //INICIALIZA OS PESOS
            for($y = 0; $y < $NCESC; $y++){
                for($x = 0; $x < $SAIDA; $x++)
                {
                      //$w[$x][$y] = rand(0.001,1)%2 + .5;
                    $w[$x][$y] = rand(0, 10) / 10;
                }
                for($x = 0; $x < $ENTRADA; $x++)
                {
                      $W[$y][$x] = rand(0, 10) / 10;
                }
                $biasesc[$y] = rand(0, 10) / 10;
             }
             for($x = 0; $x < $SAIDA; $x++)
             {
                $biass[$x] = rand(0, 10) / 10;
             }
             
                      
            $entradas= array(); 
            $entradas = $this->getArrayEntrada();
            
            
            $saidas= array();
            $saidas= $this->getArraySaida();
      
           
            for($x = 0; $x < $epocas; $x++){
              //teste do while no lugar do for 
//              do {
                for($y = 0; $y < $EXEMPLOS; $y++){

                //neuronios de ENTRADA
                for($contt = 0; $contt < $NCESC; $contt++){
                   $niesc[$contt] = 0;
                  for($cont2 = 0; $cont2 < $ENTRADA; $cont2++)
                      $niesc[$contt] = $niesc[$contt] + $W[$contt][$cont2]*$entradas[$cont2][$y]; //somat�rio

                   $niesc[$contt] = $niesc[$contt] + $biasesc[$contt]; //total do somatorio + bias
                   $phiesc[$contt] = 1/(1 + exp(-$niesc[$contt]));//sigmoid
                   //$phiesc[$contt] = tanh($niesc[$contt]);//sigmoid
                   
//                      echo "<pre> Ativação: exemplo",$y
//               . "";
//              print_r(var_dump($phiesc));
//              echo  "</pre>";
                   
                   }

                   //neuronio  de SAIDA
                 for($contt = 0; $contt < $SAIDA; $contt++){
                   $ni[$contt] = 0;
                   for($cont2 = 0; $cont2 < $NCESC; $cont2++)
                         $ni[$contt] = $ni[$contt] + $w[$contt][$cont2]*$phiesc[$cont2];
                   $ni[$contt] = $ni[$contt] + $biass[$contt];
                   $phi[$contt] = 1/(1 + exp(-$ni[$contt]));
                   //$phi[$contt] = tanh(-$ni[$contt]);
                   }

                for($contt = 0; $contt < $SAIDA; $contt++) // calculo dos erros
                   $erro[$contt] = $saidas[$contt][$y] - $phi[$contt];
                $Erroinst = 0;
                for($contt = 0; $contt < $SAIDA; $contt++) 
                   $Erroinst = $Erroinst + $erro[$contt]*$erro[$contt]/2;
                $Erromg = ($Erromg*($x*$EXEMPLOS + $y) + $Erroinst)/($x*$EXEMPLOS + ($y+1));
                if ($Erromg < $errodes)
                   break;

                for($cont2 = 0; $cont2 < $SAIDA; $cont2++){
                   $phil[$cont2] = exp(-$ni[$cont2])/((1+exp(-$ni[$cont2]))*(1+exp(-$ni[$cont2])));
                   $delta[$cont2] = -$erro[$cont2]*$phil[$cont2];
                   }
                for($cont2 = 0; $cont2 < $NCESC; $cont2++){
                   $philesc[$cont2] = exp(-$niesc[$cont2])/((1+exp(-$niesc[$cont2]))*(1+exp(-$niesc[$cont2])));
                   $deltaesc[$cont2] = 0;
                   for($contt = 0; $contt < $SAIDA; $contt++)
                      $deltaesc[$cont2] = $deltaesc[$cont2] + $philesc[$cont2]*$delta[$contt]*$w[$contt][$cont2];
                   }
                for($cont2 = 0; $cont2 < $SAIDA; $cont2++){
                   for($contt = 0; $contt < $NCESC; $contt++){
                      $w[$cont2][$contt] = $w[$cont2][$contt] - $eta*$delta[$cont2]*$phiesc[$contt];
                      $biass[$cont2] = $biass[$cont2] - $eta*$delta[$cont2]*$phiesc[$contt];
                      }
                   }
                for($cont2 = 0; $cont2 < $NCESC; $cont2++){
                   for($contt = 0; $contt < $ENTRADA; $contt++){
                      $W[$cont2][$contt] = $W[$cont2][$contt] - $eta*$deltaesc[$cont2]*$entradas[$contt][$y];
                      $biasesc[$cont2] = $biasesc[$cont2] - $eta*$deltaesc[$cont2]*$entradas[$contt][$y];
                      }
                   }
                }
//            if ($Erromg < $errodes) {
//               $msg =  "Finalizado pelo erro em  epocas de treinamento!". $x;
//               break;
//            }
            //while no lugar do for
         } //while ($Erromg > $errodes);
         
          $this->setBiasCamadaOculta($biasesc);
          $this->setBiasCamadaFinal($biass);
          $this->setPesosCamadaOculta($W);
          $this->setPesosCamadaFinal($w);
          
          $msg .= " Erro global: ".$Erromg." Erro: ".$errodes;
          return $msg;
        }
        
        
        
        function saidasNormalizadas($NCESC, $ENTRADA, $SAIDA, $EXEMPLOS)
        {
            $msg = 'Finalizado';
            $w = array(); $W= array(); $Erroinst; $Erromg = 0; $erro=array(); $niesc = array(); $ni= array(); 
            $biasesc= array(); $biass= array(); $phiesc= array(); $phi= array(); $philesc= array();
            $phil= array(); $delta= array(); $deltaesc= array();
            $x; $y; $cont2; $contt; $teste;
            
            $biasesc = $this->getBiasCamadaOculta();
            $biass = $this->getBiasCamadaFinal();
            $W = $this->getPesosCamadaOculta();
            $w = $this->getPesosCamadaFinal();
                               

          
            $entradas= array(); 
            $entradas = $this->getArrayEntrada();
            
//              echo "<br/><pre>Saida  entradas";
//              print_r(var_dump($entradas));
//              echo  "</pre>";

            
           // var_dump($EXEMPLOS);
            
            for ($x = 0; $x < $EXEMPLOS; $x++){    
                for($contt = 0; $contt < $NCESC; $contt++){
                   $niesc[$contt] = 0;
                   for($cont2 = 0; $cont2 < $ENTRADA; $cont2++)
                      $niesc[$contt] = $niesc[$contt] + $W[$contt][$cont2]*$entradas[$cont2][$x];
                   $niesc[$contt] = $niesc[$contt] + $biasesc[$contt];
                   $phiesc[$contt] = $this->funcaoAtivacao($niesc[$contt]);
                }
                for($contt = 0; $contt < $SAIDA; $contt++){
                   $ni[$contt] = 0;
                   for($cont2 = 0; $cont2 < $NCESC; $cont2++)
                         $ni[$contt] = $ni[$contt] + $w[$contt][$cont2]*$phiesc[$cont2];
                  

                   
                   $ni[$contt] = $ni[$contt] + $biass[$contt];
                   $phi[$x] = $this->funcaoAtivacao($ni[$contt]);
                   
                  
                }
            }
            $this->setArraySaidasRedeNormalizadas($phi);
            
            //$this->setMsg($this->getMsg() .  'saidas normalizadas  '. print_r(var_dump($phi)).'<br>');
//            echo "<br/><pre>Saida  setArraySaidasRedeNormalizadas";
//              print_r(var_dump($phi));
//              echo  "</pre>";

          
        }
        
        function saidasDesnormalizadas($a, $b, $NCESC, $ENTRADA, $SAIDA, $EXEMPLOS)
        {
           $msg = 'Finalizado';
            $w = array(); $W= array(); $Erroinst; $Erromg = 0; $erro=array(); $niesc = array(); $ni= array(); 
            $biasesc= array(); $biass= array(); $phiesc= array(); $phi= array(); $philesc= array();
            $phil= array(); $delta= array(); $deltaesc= array();
            $x; $y; $cont2; $contt; $teste;
            
            $phi = $this->getArraySaidasRedeNormalizadas();
            
                
            $cvsDesnormalizadoSaida = array();
            $cvsDesnormalizadoSaida = $this->getCvs();
            $cvs = $this->getCvs();

//            $arrayDesnormalizacaoSaida = array();

            $arrlength = count($phi); //QUANTIDADE LINHAS
            
            $maxMin  = array();

//           for ($y = 0; $y < $arrlength; $y++) //pecorre as linhas
//            {
//               $arrayDesnormalizacaoSaida[$y] = $cvs[$y][$ENTRADA];
//            }
            
            $maxMin = $this->getArrayMaxMin();

//            $maximo = max($arrayDesnormalizacaoSaida);
//            $minimo = min($arrayDesnormalizacaoSaida);
            
//            echo "<br/> Maximo capturado: ".$maximo;
//            echo "<br/> Minimo capturado: ".$minimo;
//            echo "<br/> Maximo salvo: ".$maxMin[0][$ENTRADA];
//            echo "<br/> Minimo salvo: ".$maxMin[1][$ENTRADA];
//            
   
            $maximo = $maxMin[0][$ENTRADA];
            $minimo = $maxMin[1][$ENTRADA];
                  

            for ($y = 0; $y < $arrlength; $y++) //pecorre as linhas
            {

              //$cvsDesnormalizadoSaida[$y][8] = number_format(((($phi[$y]-$a) * ($maximo - $minimo))/($b - $a )) + $minimo , 2, ",", "");

              $cvsDesnormalizadoSaida[$y][$ENTRADA + 1] =((($phi[$y]-$a) * ($maximo - $minimo))/($b - $a )) + $minimo;

            }
            
           
            $this->setArraySaidasRedeDesnormalizadas($cvsDesnormalizadoSaida);
             
        }

        function iniciaTimer()
        {
          // Iniciamos o "contador"
          list($usec, $sec) = explode(' ', microtime());
          $script_start = (float) $sec + (float) $usec;

          $this->setTimeStart($script_start);
        }

        function finalizaTimer()
        {
           // Terminamos o "contador" e exibimos
          list($usec, $sec) = explode(' ', microtime());
          $script_end = (float) $sec + (float) $usec;
          $elapsed_time = round($script_end - $this->getTimeStart(), 5);
          // Exibimos uma mensagem
          
          $this->setTimeMsg('Elapsed time: '. $elapsed_time. ' secs. Memory usage: '. round(((memory_get_peak_usage(true) / 1024) / 1024), 2). 'Mb');
 

        }
        
        function getTimeStart() {
            return $this->timeStart;
        }

        function getTimeMsg() {
            return $this->timeMsg;
        }

        function setTimeStart($timeStart) {
            $this->timeStart = $timeStart;
        }

        function setTimeMsg($timeMsg) {
            $this->timeMsg = $timeMsg;
        }

            
        function getAcao() {
            return $this->acao;
        }

        function setAcao($acao) {
            $this->acao = $acao;
        }

                
        function getArrayMaxMin() {
            return $this->arrayMaxMin;
        }

        function setArrayMaxMin($arrayMaxMin) {
            $this->arrayMaxMin = $arrayMaxMin;
        }

               
        function getArraySaidasRedeNormalizadas() {
            return $this->arraySaidasRedeNormalizadas;
        }

        function getArraySaidasRedeDesnormalizadas() {
            return $this->arraySaidasRedeDesnormalizadas;
        }

        function setArraySaidasRedeNormalizadas($arraySaidasRedeNormalizadas) {
            $this->arraySaidasRedeNormalizadas = $arraySaidasRedeNormalizadas;
        }

        function setArraySaidasRedeDesnormalizadas($arraySaidasRedeDesnormalizadas) {
            $this->arraySaidasRedeDesnormalizadas = $arraySaidasRedeDesnormalizadas;
        }

                
        function getEpocas() {
            return $this->epocas;
        }

        function getEta() {
            return $this->eta;
        }

        function getErrodes() {
            return $this->errodes;
        }

        function getBiasCamadaOculta() {
            return $this->biasCamadaOculta;
        }

        function getBiasCamadaFinal() {
            return $this->biasCamadaFinal;
        }

        function getPesosCamadaOculta() {
            return $this->pesosCamadaOculta;
        }

        function getPesosCamadaFinal() {
            return $this->pesosCamadaFinal;
        }

        function setEpocas($epocas) {
            $this->epocas = $epocas;
        }

        function setEta($eta) {
            $this->eta = $eta;
        }

        function setErrodes($errodes) {
            $this->errodes = $errodes;
        }

        function setBiasCamadaOculta($biasCamadaOculta) {
            $this->biasCamadaOculta = $biasCamadaOculta;
        }

        function setBiasCamadaFinal($biasCamadaFinal) {
            $this->biasCamadaFinal = $biasCamadaFinal;
        }

        function setPesosCamadaOculta($pesosCamadaOculta) {
            $this->pesosCamadaOculta = $pesosCamadaOculta;
        }

        function setPesosCamadaFinal($pesosCamadaFinal) {
            $this->pesosCamadaFinal = $pesosCamadaFinal;
        }

                
        
        
        function getArrayEntrada() {
            return $this->arrayEntrada;
        }

        function getArraySaida() {
            return $this->arraySaida;
        }

        function setArrayEntrada($arrayEntrada) {
            $this->arrayEntrada = $arrayEntrada;
        }

        function setArraySaida($arraySaida) {
            $this->arraySaida = $arraySaida;
        }

        
	function getCvs() {
            return $this->cvs;
        }

        function setCvs($cvs) {
           // $arrlength = count($cvs); //QUANTIDADE LINHAS
            $this->setEXEMPLOS(count($cvs));
            $this->setENTRADA(count($cvs[0]) - 1);
            $this->cvs = $cvs;
            
//             echo "<pre>arquivo cvs ";
//                print_r(var_dump($cvs));
//                
//               echo  "</pre>";
        }
        
        function getCvsNormalizado() {
            return $this->cvsNormalizado;
        }

        function setCvsNormalizado($cvsNormalizado) {
            $this->cvsNormalizado = $cvsNormalizado;
        }



        function getNCESC() {
            return $this->NCESC;
        }

        function getENTRADA() {
            return $this->ENTRADA;
        }

        function getSAIDA() {
            return $this->SAIDA;
        }

        function getEXEMPLOS() {
            return $this->EXEMPLOS;
        }

        function getA() {
            return $this->a;
        }

        function getB() {
            return $this->b;
        }

        function setNCESC($NCESC) {
            $this->NCESC = $NCESC;
        }

        function setENTRADA($ENTRADA) {
            $this->ENTRADA = $ENTRADA;
        }

        function setSAIDA($SAIDA) {
            $this->SAIDA = $SAIDA;
        }

        function setEXEMPLOS($EXEMPLOS) {
            $this->EXEMPLOS = $EXEMPLOS;
        }

        function setA($a) {
            $this->a = $a;
        }

        function setB($b) {
            $this->b = $b;
        }
        
        function getCvsDesnormalizado() {
            return $this->cvsDesnormalizado;
        }

        function setCvsDesnormalizado($cvsDesnormalizado) {
            $this->cvsDesnormalizado = $cvsDesnormalizado;
        }

        function getMsg() {
            return $this->msg;
        }

        function setMsg($msg) {
            $this->msg = $msg;
        }


         function getDeltaNeuronioOculta() {
            return $this->deltaNeuronioOculta;
        }

        function getDeltaNeuronioSaida() {
            return $this->deltaNeuronioSaida;
        }

        function setDeltaNeuronioOculta($deltaNeuronioOculta) {
            $this->deltaNeuronioOculta = $deltaNeuronioOculta;
        }

        function setDeltaNeuronioSaida($deltaNeuronioSaida) {
            $this->deltaNeuronioSaida = $deltaNeuronioSaida;
        }

                
        function getFuncaoAtivacao() {
            return $this->funcaoAtivacao;
        }

        function setFuncaoAtivacao($funcaoAtivacao) {
            $this->funcaoAtivacao = $funcaoAtivacao;
        }

        function getSaidaNeuronioOculta() {
            return $this->saidaNeuronioOculta;
        }

        function getSaidaNeuronioSaida() {
            return $this->saidaNeuronioSaida;
        }

        function setSaidaNeuronioOculta($saidaNeuronioOculta) {
            $this->saidaNeuronioOculta = $saidaNeuronioOculta;
        }

        function setSaidaNeuronioSaida($saidaNeuronioSaida) {
            $this->saidaNeuronioSaida = $saidaNeuronioSaida;
        }


}

?>


