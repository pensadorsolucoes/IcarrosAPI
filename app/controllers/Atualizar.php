<?php

class Atualizar extends Base{

	public function __construct() {

        parent::__construct();
    }

    public function teste(){
    	var_dump('teste');
    }

    public function index() {
    	  
    	/*
    	1@AC@16@47@@Nelson Mesquita@@69918703@Rua@S@R Nelson Mesquita 
    	0- id linha doc
    	1- uf
    	2- id_cidade
		3- id_bairro
		4- ""
		5- logradouro
		6- ""
		7- cep
		8- tipo
		9- abreviação

    	*/
		//1-rn 2-ro 3-rr 4-rs 5-sc 6-se 7-to
    	$fileName = __DIR__.'/../../cache/log_logradouro_to.txt';
    	$lines = file($fileName); 
    	$cont =0;
    	foreach ($lines as $value) {

			$buffer = iconv("ISO-8859-1","UTF-8",$value);
			$endereco = explode('@', $buffer);

			$cep['cep']=$endereco[7];
			$is_save_cep = parent::$db->from('cep')->where(['cep'  => $cep['cep']])->fetch();

			if(!$is_save_cep){
				$estado = parent::$db->from('estado')->where(['uf'  => $endereco[1]])->fetch();
				//$cidade = parent::$db->from('cidade')->where(['id'=> $endereco[2]])->fetch();

				$cep['tipo'] = $endereco[8];
				$cep['logradouro']=$endereco[5];
				$cep['estado'] = intval($estado->id);
				$cep['cidade'] = intval($endereco[2]);
				$cep['bairro'] = $endereco[3];
				$cep['bairro'] = intval(1);
				var_dump($cep);
				exit(0);
				//$insert = parent::$db->insertInto('cep')->values($cep)->execute();
			}
			$cont++;
    	}

    	var_dump("saiu foreach");
    }

    public function unidadeOperacional(){
    	/*
    	5061@TO@9799@32892@@AC Aparecida do Rio Negro@Avenida Sancha Lima Tavares 02 Quadra 51@77620970@N@AC Aparecida R Negro
		erro:
    	31593@PB@4964@6981@234832@Seção Recursos Tecnologia/ DPROR@Rodovia BR-230 km 24,5 1º Andar@58071980@N@Seção Recursos T DPROR
    	0- chave unidade operacional
    	1- uf
    	2- id_localidade
		3- id_bairro
		4- chave logradouro (opcional)
		5- nome unidade operacional
		6- endereço unidade operacional
		7- cep unidade operacional
		8- indicador caixa postal (s ou n)
		9- abreviatura nome da unidade operacional
    	*/

    	$fileName = __DIR__.'/../../cache/log_unid_oper.txt';
    	$lines = file($fileName); 
		$cont = 0;
		$aux = '';

		foreach ($lines as $value) {

			$buffer = iconv("ISO-8859-1","UTF-8",$value);
			$endereco = explode('@', $buffer);

			$cep['cep']=$endereco[7];

			try{
				$save_cep = parent::$db->from('cep')->where(['cep'  => $cep['cep']])->fetch();
			}catch (Exception $e) {

				var_dump(json_encode([
					'cont' => $cont,
					'cep'=>$cep['cep'],
					'message1' => $e->getMessage()
				]));
				exit(0);
			}
			
			if(!$save_cep){
				try{
					$estado = parent::$db->from('estado')->where(['uf'  => $endereco[1]])->fetch();

					$cidade_aux = parent::$db->from('localidade')->where(['loc_nu'  => $endereco[2]])->fetch();
					$cidade = parent::$db->from('cidade')->where(['nome'=> $cidade_aux->loc_no, 'estado'=>$estado->id])->fetch();

				}catch (Exception $e) {

					var_dump(json_encode([
						'cont' => $cont,
						'cep'=>$cep['cep'],
						'message1' => $e->getMessage()
					]));
					exit(0);
				
				}

				if(strcmp($cidade->tipo, "P")==0){
					$cep['tipo']="Povoado";

				} else if(strcmp($cidade->tipo, "M")==0){
					$cep['tipo']="Município";

				} else if(strcmp($cidade->tipo, "D")==0){
					$cep['tipo']="Distrito";

				}

				$cep['logradouro']=$endereco[6];
				$cep['estado'] = intval($estado->id);
				$cep['cidade'] = intval($cidade->id);
				$cep['bairro'] = $endereco[3];
				$cep['ativo'] =intval(1);
				$insert = parent::$db->insertInto('cep')->values($cep)->execute();
				// var_dump($cep);
				// exit(0);
			}

			$cont++;
       	}
    }

    public function cpc(){
    	/*
    	1285@AL@158@Conjunto Mutirão@Quadra 1 nº 37 - Conj.Mutirão - Rio Largo@57100990
    	0- cpc_nu
    	1- uf
    	2- id_localidade
		3- nome_cpc
		4- endereco_cpc
		5- logradouro
		6- cep
    	*/
		$fileName = __DIR__.'/../../cache/log_cpc.txt';
		$lines = file($fileName); 
		$cont = 0;
		$aux = '';

		foreach ($lines as $value) {

			$buffer = iconv("ISO-8859-1","UTF-8",$value);
			$endereco = explode('@', $buffer);
			$cep['cep'] = substr($endereco[5], 0, 8);

			$save_cep = parent::$db->from('cep')->where(['cep'  => $cep['cep']])->fetch();
			if(!$save_cep){
				$estado = parent::$db->from('estado')->where(['uf'  => $endereco[1]])->fetch();

				$localidade = parent::$db->from('localidade')->where(['loc_nu'  => $endereco[2]])->fetch();
				$cidade = parent::$db->from('cidade')->where(['nome'=> $localidade->loc_no, 'estado'=>$estado->id])->fetch();

				$cep['tipo']="CPC";
				$cep['logradouro']=$endereco[4];
				$cep['complemento']=$endereco[3];
				$cep['estado'] = intval($estado->id);
				$cep['cidade'] = intval($cidade->id);
				$cep['bairro'] = 2147483647;
				$cep['ativo'] =intval(1);
				$insert = parent::$db->insertInto('cep')->values($cep)->execute();
			}
			$cont++;
       	}
    } 

    public function localidade(){
    	/*
    	13@AC@Plácido de Castro@69928000@0@M@@Plácido Castro@1200385
    	0- loc_nu
    	1- uf
    	2- nome localidade (nome cidade)
		3- cep (opcional)
		4- situacao
		5- tipo D-distrito, m-municipio, p-povoado
		6- nome abreviado
		7- numero municipio (IBGE)
    	*/
		$fileName = __DIR__.'/../../cache/log_localidade.txt';
		$lines = file($fileName); 
		$cont = 0;
		$aux = '';
		foreach ($lines as $value) {
			if($cont > 9){
	   			var_dump('deu certo!');
	   			exit(0);
			}

			$buffer = iconv("ISO-8859-1","UTF-8",$value);
			$endereco = explode('@', $buffer);
			$cep['cep']=$endereco[3];

			if(!empty($cep['cep'])){
				$save_cep = parent::$db->from('cep')->where(['cep'  => $cep['cep']])->fetch();

				if(!$save_cep){
					$estado = parent::$db->from('estado')->where(['uf'  => $endereco[1]])->fetch();
					$cidade = parent::$db->from('cidade')->where(['nome'=> $endereco[2], 'estado'=>$estado->id])->fetch();

					try{
						if(strcmp($cidade->tipo, "P")==0){
							$cep['tipo']="Povoado";

						} else if(strcmp($cidade->tipo, "M")==0){
							$cep['tipo']="Município";

						} else if(strcmp($cidade->tipo, "D")==0){
							$cep['tipo']="Distrito";

						}
					}catch (Exception $e) {

					var_dump(json_encode([
						'cont' => $cont,
						'cep'=>$cep['cep'],
						'nome'=>$endereco[2],
						'estado'=>$estado,
						'message1' => $e->getMessage()
					]));
					exit(0);
				
				}

					$cep['estado'] = intval($estado->id);
					$cep['cidade'] = intval($cidade->id);
					$cep['bairro'] = 2147483647;
					$cep['ativo'] =intval(1);
					$insert = parent::$db->insertInto('cep')->values($cep)->execute();
					// var_dump($cep);
					// exit(0);
				}

			}
			$cont++;
		}

    }

    public function bairro(){
    	/*
    	52135@SP@9660@Conjunto Habitacional São José dos Campos A@Cj Hab S J Campos A@UPD
    	0- id bairro
    	1- uf
    	2- nome bairro
		3- abreviatura
    	*/
		$fileName = __DIR__.'/../../cache/log_bairro.txt';
		$lines = file($fileName); 
		$cont = 0;
		$aux = '';
		foreach ($lines as $value) {

			$buffer = iconv("ISO-8859-1","UTF-8",$value);
			$endereco = explode('@', $buffer);
			$bairro['id']=$endereco[0];

			$save_bairro = parent::$db->from('bairro')->where(['id'  => $bairro['id']])->fetch();

			if(!$save_bairro){
				$estado = parent::$db->from('estado')->where(['uf'  => $endereco[1]])->fetch();
				$localidade = parent::$db->from('localidade')->where(['loc_nu'  => $endereco[2]])->fetch();
				$cidade = parent::$db->from('cidade')->where(['nome'=> $localidade->loc_no, 'estado'=>$estado->id])->fetch();


				$bairro['cidade'] = intval($cidade->id);
				$bairro['nome'] = $endereco[3];
				$bairro['ativo'] =intval(1);
				$insert = parent::$db->insertInto('bairro')->values($bairro)->execute();
				// var_dump($bairro);
				// exit(0);
			}

			$cont++;
   		}
   	}	

   	public function grandesUsuarios(){
   		/*
    	52135@SP@9660@Conjunto Habitacional São José dos Campos A@Cj Hab S J Campos A@UPD
    	0- id grande usuário
    	1- uf
    	2- id localidade
		3- id bairro
		4- id logradouro (opcional)
		5- nome grande usuário
		6- endereço grande usuário
		7- cep do grande usuário
		8- abreviatura
    	*/
		$fileName = __DIR__.'/../../cache/log_grande_usuario.txt';
		$lines = file($fileName); 
		$cont = 0;
		$aux = '';

		foreach ($lines as $value) {

			$buffer = iconv("ISO-8859-1","UTF-8",$value);
			$endereco = explode('@', $buffer);
			$cep['cep']=$endereco[7];
			$save_cep = parent::$db->from('cep')->where(['cep'  => $cep['cep']])->fetch();

			if(!$save_cep){
				$estado = parent::$db->from('estado')->where(['uf'  => $endereco[1]])->fetch();
				
				$localidade = parent::$db->from('localidade')->where(['loc_nu'  => $endereco[2]])->fetch();
				$cidade = parent::$db->from('cidade')->where(['nome'=> $localidade->loc_no, 'estado'=>$estado->id])->fetch();


				$cep['tipo']="CPC";
				$cep['estado'] = intval($estado->id);
				$cep['cidade'] = intval($cidade->id);
				$cep['bairro'] = $endereco[3];
				$cep['logradouro'] = $endereco[6];
				$cep['complemento'] = $endereco[5];
				$cep['ativo'] =intval(1);
				$insert = parent::$db->insertInto('cep')->values($cep)->execute();
			
			}


		}

	}

	public function logradouro(){
		/*
    	1125327@BA@759@600@@4@(Cond M Árvores)@48904599@Travessa@S@Tv 4                                @INS@
    	0- id logradouro
    	1- uf
    	2- id localidade
		3- id bairro inicial
		4- id bairro final (opcional)
		5- ""
		6- complemento do logradouro
		7- cep
		8- tipo do logradouro
		9- indicador de utilização do tipo de logradouro (S ou N) (opcional)
		10- abreviatura
		11- ""
		12- ""
    	*/
		$fileName = __DIR__.'/../../cache/log_logradouro.txt';
		$lines = file($fileName); 
		$cont = 0;
		$aux = '';

		foreach ($lines as $value) {
			$buffer = iconv("ISO-8859-1","UTF-8",$value);
			$endereco = explode('@', $buffer);
			$cep['cep']=$endereco[7];

			$save_cep = parent::$db->from('cep')->where(['cep'  => $cep['cep']])->fetch();

			if(!$save_cep){
				$estado = parent::$db->from('estado')->where(['uf'  => $endereco[1]])->fetch();
				$localidade = parent::$db->from('localidade')->where(['loc_nu'  => $endereco[2]])->fetch();
				$cidade = parent::$db->from('cidade')->where(['nome'=> $localidade->loc_no, 'estado'=>$estado->id])->fetch();


				$cep['tipo']=$endereco[8];
				$cep['estado'] = intval($estado->id);
				$cep['cidade'] = intval($cidade->id);
				$cep['bairro'] = $endereco[3];
				$cep['logradouro'] = $endereco[10];
				$cep['complemento'] = $endereco[6];
				$cep['ativo'] =intval(1);
				$insert = parent::$db->insertInto('cep')->values($cep)->execute();
				// var_dump($cep);
				// exit(0);
			}
		}
	}
}