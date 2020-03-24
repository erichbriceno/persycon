<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Requests\CreateProjectRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RequestProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function validates_request_project()
    {
        
        $this->markTestSkipped();
        $request = new CreateProjectRequest();

        $this->assertEquals(
            $request->rules()
            ,[
                'name' => 'required',
                'description' => '',
                'start' => '',
                'ending' => '',
                'state' => ''
            ]);

    }
}
