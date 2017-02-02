<?php namespace estoque\Http\Controllers;

use	Illuminate\Support\Facades\DB;
use Request;
use Validator;
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
		
		$validator	=	Validator::make(
				['nome'	=>	Request::input('nome')],
				['nome'	=>	'required|min:5']
		);
		
		if	($validator->fails())
		{
			return	redirect()->action('ProdutoController@novo');
		}
		
		Produto::create(Request::all());
		
		return	redirect()->action('ProdutoController@lista');
	}


	public function remove($id){
		$produto = Produto::find($id);
		$produto->delete();
		return redirect()->action('ProdutoController@lista');
	}

	public function	listaJson(){

		return	response()->json(Produto::all());
	}


}