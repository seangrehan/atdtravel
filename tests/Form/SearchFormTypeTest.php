<?php

namespace App\Tests\Form;

use App\Form\SearchFormType;
use Symfony\Component\Form\Test\TypeTestCase;

class SearchFormTypeTest extends TypeTestCase
{
    public function testSubmitValidData(): void
    {
        $formData = [
            'title' => 'test',
            'geo'   => 'en',
        ];

        // $model will retrieve data from the form submission; pass it as the second argument
        $form = $this->factory->create(SearchFormType::class);

        // submit the data to the form directly
        $form->submit($formData);

        // This check ensures there are no transformation failures
        $this->assertTrue($form->isSynchronized());
    }
}
