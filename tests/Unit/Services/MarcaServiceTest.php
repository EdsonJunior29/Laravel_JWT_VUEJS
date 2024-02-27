<?php

namespace Tests\Services;

use App\Models\Marca;
use App\Repositories\MarcaRepository;
use App\Services\MarcaService;
use PHPUnit\Framework\TestCase;

class MarcaServiceTest extends TestCase
{
    public function testCriaMarca()
    {
        $repoMock = $this->getMockBuilder(MarcaRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        
        $repoMock->expects($this->once())
            ->method('createMarca')
            ->with(['nome' => 'Bugatti', 'imagem' => 'imagem_bugatti.jpg'])
            ->willReturn(new Marca(['id' => 5, 'nome' => 'Bugatti', 'imagem' => 'imagem_bugatti.jpg']));

        $service = new MarcaService($repoMock);

        $marca = $service->criaMarca(['nome' => 'Bugatti', 'imagem' => 'imagem_bugatti.jpg']);

        $this->assertInstanceOf(Marca::class, $marca);
        $this->assertEquals('Bugatti', $marca->nome);
        $this->assertEquals('imagem_bugatti.jpg', $marca->imagem);
    }

    public function testErroAoCriarMarcaLancaException()
    {
        $repoMock = $this->getMockBuilder(MarcaRepository::class)
                         ->disableOriginalConstructor()
                         ->getMock();

        $repoMock->method('createMarca')
                 ->willThrowException(new \Exception('Erro ao criar marca'));

        $service = new MarcaService($repoMock);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Erro ao criar marca');
        
        $service->criaMarca(['nome' => 'Bugatti', 'imagem' => 'imagem_bugatti.jpg']);
    }
}