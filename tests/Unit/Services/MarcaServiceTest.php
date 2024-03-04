<?php

namespace Tests\Services;

use App\Models\Marca;
use App\Repositories\Interfaces\MarcaInterface;
use App\Services\MarcaService;
use Illuminate\Support\Facades\Log;
use PHPUnit\Framework\TestCase;

class MarcaServiceTest extends TestCase
{
    private $mockMarcaInterface;

    public function setUp(): void
    {
        parent::setUp();

        $this->mockMarcaInterface = $this->getMockBuilder(MarcaInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @dataProvider marcaDadosProvider
    */
    public function testObterTodasAsMarcas($dados)
    {
        $this->mockMarcaInterface->expects($this->once())
            ->method('getAll')
            ->willReturn($dados);
        
        $service = new MarcaService($this->mockMarcaInterface);
        $marcas = $service->buscarTodasAsMarcas();

        $this->assertEquals($dados, $marcas);
    }

    public function testObterTodasAsMarcasLancaException()
    {
        $this->mockMarcaInterface->expects($this->once())
                           ->method('getAll')
                           ->willThrowException(new \Exception('Erro ao obter marcas'));
        
        $service = new MarcaService($this->mockMarcaInterface);
        
        $this->expectException(\Exception::class);
        
        $service->buscarTodasAsMarcas();
    }

    /**
     * @dataProvider marcaIdAndProvider
    */
    public function testBuscarMarcaPorIdComSucesso($marcaId, $marcaRetornada)
    {        
        $this->mockMarcaInterface->expects($this->once())
            ->method('getById')
            ->with($marcaId)
            ->willReturn($marcaRetornada);
        
        $marcaService = new MarcaService($this->mockMarcaInterface);
        $marca = $marcaService->buscarMarcaPorId($marcaId);

        $this->assertEquals($marcaRetornada, $marca);
    }

    /**
     * @dataProvider idsProvider
    */
    public function testeBuscarMarcaPorIdLancaException($id)
    {
         $this->mockMarcaInterface->expects($this->once())
            ->method('getById')
            ->with($id)
            ->willThrowException(new \Exception('Erro ao buscar marca'));

        $marcaService = new MarcaService($this->mockMarcaInterface);
        
        $this->expectException(\Exception::class);

        $marcaService->buscarMarcaPorId($id);
    }
    
    /**
     * @dataProvider marcaProvider
    */
    public function testCriaMarca($dados, $marcaEsperada)
    {    
        $this->mockMarcaInterface->expects($this->once())
            ->method('create')
            ->with($dados)
            ->willReturn($marcaEsperada);

        $service = new MarcaService($this->mockMarcaInterface);

        $marca = $service->criaMarca($dados);

        $this->assertInstanceOf(Marca::class, $marca);
        $this->assertEquals('Bugatti', $marca->nome);
        $this->assertEquals('imagem_bugatti.jpg', $marca->imagem);
    }

    /**
     * @dataProvider marcaDadosProvider
    */
    public function testErroAoCriarMarcaLancaException($dados)
    {
        Log::shouldReceive('error')
            ->once()
            ->with('Erro ao criar marca', []);

        $this->mockMarcaInterface->method('create')
            ->willThrowException(new \Exception('Erro ao criar marca'));

        $service = new MarcaService($this->mockMarcaInterface);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Erro ao criar marca');
        
        $service->criaMarca($dados);
    }

    /**
     * @dataProvider idsAndDadosProvider
    */
    public function testAtualizaMarca($id, $dados)
    {        
        $this->mockMarcaInterface->expects($this->once())
            ->method('updateById')
            ->with($dados,  $id);

        $service = new MarcaService($this->mockMarcaInterface);

        $service->atualizaMarca($dados, $id);
    }

    /**
     * @dataProvider idsAndDadosProvider
    */
    public function testUpdateByIdLancaExcecao($id, $dados)
    {        
        $this->mockMarcaInterface->expects($this->once())
            ->method('updateById')
            ->with($dados, $id)
            ->will($this->throwException(new \Exception('Erro ao atualizar marca')));
        
        $service = new MarcaService($this->mockMarcaInterface);
        
        $this->expectException(\Exception::class);
        
        $service->atualizaMarca($dados, $id);
    }

    /**
     * @dataProvider idsProvider
    */
    public function testDeleteMarcaById($id)
    {
        $this->mockMarcaInterface->expects($this->once())
            ->method('deleteById')
            ->with($id);

        $service = new MarcaService($this->mockMarcaInterface);

        $service->deletaMarcaPorId($id);
    }

    /**
     * @dataProvider idsProvider
    */
    public function testDeleteMarcaByILancaExcecao($id)
    {
        $this->mockMarcaInterface->expects($this->once())
            ->method('deleteById')
            ->with($id)
            ->will($this->throwException(new \Exception('Erro ao deletar marca')));
        
        $service = new MarcaService( $this->mockMarcaInterface);
        
        $this->expectException(\Exception::class);
        
        $service->deletaMarcaPorId($id);
    }

    public function idsProvider()
    {
        return [
            [1],
            [2],
            [3]
        ];
    }

    public function idsAndDadosProvider()
    {
        return [
            [1, ['nome' => 'Novo Nome', 'imagem' => 'nova_imagem.jpg']],
            [2, ['nome' => 'Outro Nome', 'imagem' => 'outra_imagem.jpg']],
        ];
    }

    public function marcaProvider()
    {
        return [
            [
                ['nome' => 'Bugatti', 'imagem' => 'imagem_bugatti.jpg'], 
                new Marca(['id' => 5, 'nome' => 'Bugatti', 'imagem' => 'imagem_bugatti.jpg'])
            ],
        ];
    }

    public function marcaIdAndProvider()
    {
        return [
            [1, ['id' => 1, 'nome' => 'mercedes', 'imagem' => 'imagem_logo_mercedes.png']],
            [2, ['id' => 2, 'nome' => 'audi', 'imagem' => 'imagem_logo_audi.png']],
        ];
    }

    public function marcaDadosProvider()
    {
        return [
            [['nome' => 'Bugatti', 'imagem' => 'imagem_bugatti.jpg']],
            [['nome' => 'Ferrari', 'imagem' => 'imagem_ferrari.jpg']],
        ];
    }
}