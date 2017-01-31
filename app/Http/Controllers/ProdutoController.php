<?php namespace estoque\Http\Controllers;

use	Illuminate\Support\Facades\DB;
use Request;
use estoque\Produto;

class ProdutoController extends Controller{
	
	public	function lista(){
		return view('produto.listagem')->with('produtos', Produto::all());	
	}

	public function mostra($id){
		
		$produto = Produto::find($id);
		
		if(empty($produto)){
			return	"Esse produto não existe";
		}

		return	view('produto.detalhes')->with('p',	$produto);

	}

	public function novo(){
		return view('produto.formulario');
	}

	public function adiciona(){
		
		Produto::create(Request::all());
		
		return	redirect()->action('ProdutoController@lista')->withInput(Request::only('nome'));
	}

	public function	listaJson(){

		return	response()->json(Produto::all());
	}


}