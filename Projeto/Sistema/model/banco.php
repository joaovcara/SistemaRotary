<?php
class Banco extends PDO{
	
	private $dsn = 'mysql:dbname=taskflow;host=localhost;charset=utf8;';
	private $user = 'root';
	private $password = '';
	private $pdo;
	
	private     $_abreSessao = true; 		// Inicia a sessão com um session_start()?
	var 		$_tabela = 'Usuario';
	var 		$_validaSempre = true;
	var 		$_caseSensitive = false;  
	
	function __construct () {
   
		try {
			if ( $this->pdo == null ) {
				//Conexao com o banco via PDO
				$dbh = parent::__construct( $this->dsn , $this->user , $this->password );
				$this->pdo = $dbh;
				
				// Verifica se precisa iniciar a sessão
				if ($this->_abreSessao == true) {
					@session_start();
				}
				
				return $this->pdo;
			}
			
		} catch ( PDOException $e ) {
    		echo $e->getMessage ();
			echo '<br>>>>>>>>>>>>>> Erro de conexão com o Banco de dados.';
		}
	}
	
	//Função que valida um usuário e senha.
	function validaUsuario($usuario, $senha) {
	
		$cS = ($this->_caseSensitive) ? 'BINARY' : '';
	
		// Usa a função addslashes para escapar as aspas
		$nusuario = addslashes($usuario);
		$nsenha = addslashes($senha);
		
		$sql = "SELECT id, idUsuarioTipo, idEmpresa, nome, email, senha FROM ".$this->_tabela." WHERE ".$cS." email = '".$nusuario."' LIMIT 1";
		$resultado = $this->consultaSQL($sql);
		$nhash = $resultado[0]['senha'];
		
		if (crypt($nsenha, $nhash) === $nhash) {
			//'Senha OK!';
			// Definimos dois valores na sessão com os dados do usuário
			$_SESSION['usuarioID'] = $resultado[0]['id']; // Pega o valor da coluna 'id do registro encontrado no MySQL
			$_SESSION['usuarioNome'] = $resultado[0]['nome']; // Pega o valor da coluna 'nome' do registro encontrado no MySQL
			$_SESSION['usuarioemail'] = $resultado[0]['email'];
		    $_SESSION['usuarioIdEmpresa'] = $resultado[0]['idEmpresa'];
		    $_SESSION['usuarioTipo'] = $resultado[0]['idUsuarioTipo'];
			
      //Atualiza status para online
      $this->consultaSQL("UPDATE Usuario SET online=1 WHERE id=".$resultado[0]['id']);
      
			// Verifica a opção se sempre validar o login
			if ($this->_validaSempre == true) {
				// Definimos dois valores na sessão com os dados do login
				$_SESSION['usuarioLogin'] = $usuario;
				$_SESSION['usuarioSenha'] = $senha;
			}
			
			return true;
			
		} else {
			//'Senha incorreta!'
			return false;	
		}
	}
	
	// Função que protege uma página
	function protegePagina() {

		if (!isset($_SESSION['usuarioID']) OR !isset($_SESSION['usuarioNome'])) {
			// Não há usuário logado, manda pra página de login
			$this->expulsaVisitante();
		} else if (isset($_SESSION['usuarioID']) OR isset($_SESSION['usuarioNome'])) {
			// Há usuário logado, verifica se precisa validar o login novamente
			if ($this->_validaSempre == true) {
				// Verifica se os dados salvos na sessão batem com os dados do banco de dados
				if (!$this->validaUsuario($_SESSION['usuarioLogin'], $_SESSION['usuarioSenha'])) {
					// Os dados não batem, manda pra tela de login
					$this->expulsaVisitante();
				}
			}
		}
	}
	
	//Função para expulsar um visitante
	function expulsaVisitante($erro, $pagina){
	
		// Remove as variáveis da sessão (caso elas existam)
		session_destroy();
    
		if('login' == $pagina){
			// Manda pra tela de login
			header("Location: ../login.php?erro=". $erro);
		}else{
			header("Location: login.php");	
		}
	}
	
	//REALIZA CONSULTAS GENERALIZADAS NO BANCO.
	function consultaSQL($sql) {
		$this->exec("set names utf8");
		//Verifica conteudo da query
		if(empty($sql)){
		   return "variavel SQL empty";
		}

		try{
			$stm = $this->prepare($sql);
			$stm->execute();
			$resultados = array();
			while ( $obj = $stm->fetch ( PDO::FETCH_ASSOC ) ) {
				// Resultados podem ser recuperados atraves de seus atributos
				$resultados[] = $obj;
			 }

		} catch ( PDOException $e ) {
    		echo $e->getMessage ();
		}
		return $resultados; //retorna o resultado da pesquisa
	 }
}