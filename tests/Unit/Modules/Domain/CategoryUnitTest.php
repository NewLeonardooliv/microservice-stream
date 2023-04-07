<?php

namespace Unit\Modules\Domain;

use Core\Domain\Exception\EntityValidationException;
use Modules\Category\Domain\Category;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

/**
 * @internal
 *
 * @coversNothing
 */
class CategoryUnitTest extends TestCase
{
    public function testAttributes()
    {
        $category = new Category(
            '',
            name: 'Teste Name',
            description: 'Desc test',
            isActive: true
        );

        $this->assertNotEmpty($category->createdAt(), 'Deve gerar um DateTime automatico para o atributo createdAt');
        $this->assertNotEmpty($category->id(), 'Deve gerar um Uuid automatico para o atributo id');
        $this->assertEquals('Teste Name', $category->name, 'Deve criar um objeto onde contenha um atributo string de name');
        $this->assertEquals('Desc test', $category->description, 'Deve criar um objeto onde contenha um atributo string de description');
        $this->assertTrue($category->isActive, 'Deve criar um objeto onde contenha um atributo boolean ativo');
    }

    public function testActiveted()
    {
        $uuid = (string) Uuid::uuid4()->toString();

        $category = new Category(
            id: $uuid,
            name: 'Teste Name',
            description: 'Desc test',
            isActive: false
        );

        $this->assertFalse($category->isActive, 'Deve verificar se o atributo isActive foi criado como falso');

        $category->activate();

        $this->assertTrue($category->isActive, 'Deve verificar se o atributo isActive foi definido para verdadeiro');
    }

    public function testDesable()
    {
        $uuid = (string) Uuid::uuid4()->toString();

        $category = new Category(
            id: $uuid,
            name: 'Teste Name',
            description: 'Desc test',
            isActive: true
        );

        $this->assertTrue($category->isActive, 'Deve verificar se o atributo isActive foi criado como verdadeiro');

        $category->disable();

        $this->assertFalse($category->isActive, 'Deve verificar se o atributo isActive foi definido para falso');
    }

    public function testUpdate()
    {
        $uuid = (string) Uuid::uuid4()->toString();

        $category = new Category(
            id: $uuid,
            name: 'New Name',
            description: 'Desc test',
            isActive: true
        );

        $category->update(
            name: 'Updated Name',
            description: 'New Desc',
        );

        $this->assertEquals('Updated Name', $category->name, 'Deve alterar o atributo name do objeto Category');
        $this->assertEquals('New Desc', $category->description, 'Deve alterar o description des do objeto Category');
    }

    public function testExceptionShortName()
    {
        $this->expectException(EntityValidationException::class);

        $uuid = (string) Uuid::uuid4()->toString();

        new Category(
            id: $uuid,
            name: 'Ne',
            description: 'Desc test',
            isActive: true
        );
    }

    public function testExceptionLongDescription()
    {
        $this->expectException(EntityValidationException::class);

        $uuid = (string) Uuid::uuid4()->toString();

        new Category(
            id: $uuid,
            name: 'New Name',
            description: "
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an 
                unknown printer took a galley of type and scrambled it to make a type specimen book. 
                It has survived not only five centuries, but also the leap into electronic typesetting, 
                remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets
                containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker 
                including versions of Lorem Ipsum.
            ",
            isActive: true
        );
    }
}
