<?php

namespace Modules\Blockchain\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Blockchain\BlockChain;
use App\Blockchain\Block;
use App\Models\BlockChainModel;

class BlockchainController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        //obtenmos los chain, que son index = 0
        $chains = BlockChainModel::where('index',0)->get();
        //dump($chains);
        return view('blockchain::index',compact('chains'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('blockchain::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //comprobamos si comenzamos una nueva cadena de bloques o no
        if( $request->newChain == 1 ){
            //obtenemos el bloque genesis
            $block = new BlockChain();
            //creamos un nuevo bloque
            $newBlock = new BlockChainModel;
            $newBlock->index = $block->chain[0]->index;
            $newBlock->nonce = $block->chain[0]->nonce;
            $newBlock->timestamp = $block->chain[0]->timestamp;
            $newBlock->data = $block->chain[0]->data;
            $newBlock->previous_hash = $block->chain[0]->previousHash;
            $newBlock->hash = $block->chain[0]->hash;
            //guardamos en la base de datos
            $newBlock->save();


        }else{
            //obtenemos el úñtimo bloque
            $lastBlock = BlockChainModel::orderBy('created_at', 'desc')->first();
            //dump($lastBlock);
            $block = new Block($lastBlock->index + 1, strtotime("now"), $request->data,$lastBlock->hash);
            //dump($block->index);
            //creamos un nuevo bloque
            $newBlock = new BlockChainModel;
            $newBlock->index = $block->index;
            $newBlock->nonce = $block->nonce;
            $newBlock->timestamp = $block->timestamp;
            $newBlock->data = $block->data;
            $newBlock->previous_hash = $block->previousHash;
            $newBlock->hash = $block->hash;
            //guardamos en la base de datos
            $newBlock->save();
        }

        //dump($block);
        //echo $request->newChain;
        //echo $request->data;
        return redirect('blockchain/create');
    }

    /**
     * Show Blocks by chain.
     * @return Response
     */
    public function showBlocks($hash)
    {
        $blocks = $this->getBlocks($hash);
        $verifityBlock = $this->verifyBlock($blocks);
        return view('blockchain::show_blocks',compact('blocks','verifityBlock'));
    }

    /**
     * Show Block data by id.
     * @return Response
     */
    public function showBlock($id)
    {
        $block = BlockChainModel::find($id);
        return view('blockchain::show_block',compact('block'));
    }

    /**
     * montamos la cadena con sus bloques y lo retornamos 
     * @return Response
     */
    private function getBlocks($hash,$blocks = array())
    {

        $block = BlockChainModel::where('previous_hash',$hash)->first();

        while ($block) {
            array_push($blocks,$block);
            $block = BlockChainModel::where('previous_hash',$block->hash)->first();
        }
        
        return $blocks;
    }

    private function verifyBlock($blocks){

        $verifyBlocks = [];
        foreach ($blocks as $key => $block) {
            
            $verifyBlocks[$block->hash] = $block->hash == $this->getHash($block);
        }

        return $verifyBlocks;
    }

    private function getHash($block) {
        $b = $block->index.$block->previous_hash.$block->timestamp.((string)$block->data);
        return hash("sha256", $b);
    }
}
