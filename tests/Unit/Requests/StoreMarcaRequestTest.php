<?php

namespace Tests\Requests;

use App\Http\Requests\StoreMarcaRequest;
use PHPUnit\Framework\TestCase;

class StoreMarcaRequestTest extends TestCase
{
    public function testStoreMarcaRequestValidationPasses()
    {
        $request = new StoreMarcaRequest();
        $this->assertTrue($request->authorize());
        $this->assertEquals([
            'nome' => ['required','unique:marcas,nome','string','max:30'],
            'imagem' => ['required','string','max:100']
        ], $request->rules());
    }

    public function testStoreRequestValidationMessages()
    {
        $request = new StoreMarcaRequest();
        $messages = $request->messages();

        $this->assertEquals('O campo nome é obrigatório.', $messages['nome.required']);
        $this->assertEquals('O nome já está em uso.', $messages['nome.unique']);
        $this->assertEquals('O campo nome deve ter no máximo :max caracteres.', $messages['nome.max']);
        $this->assertEquals('O campo imagem é obrigatório.', $messages['imagem.required']);
        $this->assertEquals('O campo imagem deve ter no máximo :max caracteres.', $messages['imagem.max']);
    }
}