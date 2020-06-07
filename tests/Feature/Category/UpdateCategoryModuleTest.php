<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Model\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateCategoryModuleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_update_a_project_categories()
    {
        $project = $this->createRandomProject();

        $this->from(route('category.edit', $project))
            ->put(
                route('category.update', $project),
                $this->getCustomCategoriesData()
            )
            ->assertRedirect(route('categories'));
            
        $project->refresh();
        
        $this->assertSame($project->cat1->minimum,"2.00");
        $this->assertSame($project->cat1->maximum,"19.00");
        $this->assertSame($project->cat2->minimum,"20.00");
        $this->assertSame($project->cat2->maximum,"39.00");
        $this->assertSame($project->cat3->minimum,"40.00");
        $this->assertSame($project->cat3->maximum,"59.00");
        $this->assertSame($project->cat4->minimum,"60.00");
        $this->assertSame($project->cat4->maximum,"79.00");
    }

    // /** @test */
    // function when_updating_the_salary_categories_of_a_project_the_values_cannot_be_zero()
    // {
    //     // $this->withoutExceptionHandling();

    //     $project = $this->createRandomProject();
        
    //     //Category 1
    //     $this->from(route('category.edit', $project))
    //         ->put(
    //             route('category.update', $project),
    //             $this->getCustomCategoriesData([
    //                 'min1' => 0,
    //         ]))
    //         ->assertRedirect(route('category.edit', $project))
    //         ->assertSessionHasErrors(['min1']);
    //     $project->refresh();
    //     $this->assertSame($project->cat1->minimum,1);

    //     $this->from(route('category.edit', $project))
    //         ->put(
    //             route('category.update', $project),
    //             $this->getCustomCategoriesData([
    //                 'max1' => 0,
    //         ]))
    //         ->assertRedirect(route('category.edit', $project))
    //         ->assertSessionHasErrors(['max1']);
    //     $project->refresh();
    //     $this->assertSame($project->cat1->maximum,9);

    //     //Category 2      
    //     $this->from(route('category.edit', $project))
    //         ->put(
    //             route('category.update', $project),
    //             $this->getCustomCategoriesData([
    //                 'min2' => 0,
    //         ]))
    //         ->assertRedirect(route('category.edit', $project))
    //         ->assertSessionHasErrors(['min2']);
    //     $project->refresh();
    //     $this->assertSame($project->cat2->minimum,10);

    //     $this->from(route('category.edit', $project))
    //         ->put(
    //             route('category.update', $project),
    //             $this->getCustomCategoriesData([
    //                 'max2' => 0,
    //         ]))
    //     ->assertRedirect(route('category.edit', $project))
    //     ->assertSessionHasErrors(['max2']);
    //     $project->refresh();
    //     $this->assertSame($project->cat2->maximum,19);

    //     //Category 3
    //     $this->from(route('category.edit', $project))
    //     ->put(
    //         route('category.update', $project),
    //         $this->getCustomCategoriesData([
    //             'min3' => 0,
    //     ]))
    //     ->assertRedirect(route('category.edit', $project))
    //     ->assertSessionHasErrors(['min3']);
    //     $project->refresh();
    //     $this->assertSame($project->cat3->minimum,20);

    //         $this->from(route('category.edit', $project))
    //         ->put(
    //             route('category.update', $project),
    //             $this->getCustomCategoriesData([
    //                 'max3' => 0,
    //         ]))
    //     ->assertRedirect(route('category.edit', $project))
    //     ->assertSessionHasErrors(['max3']);
    //     $project->refresh();
    //     $this->assertSame($project->cat3->maximum,29);

    //     //Category 4
    //     $this->from(route('category.edit', $project))
    //     ->put(
    //         route('category.update', $project),
    //         $this->getCustomCategoriesData([
    //             'min4' => 0,
    //     ]))
    //     ->assertRedirect(route('category.edit', $project))
    //     ->assertSessionHasErrors(['min4']);
    //     $project->refresh();
    //     $this->assertSame($project->cat4->minimum,30);

    //     $this->from(route('category.edit', $project))
    //         ->put(
    //             route('category.update', $project),
    //             $this->getCustomCategoriesData([
    //                 'max4' => 0,
    //         ]))
    //     ->assertRedirect(route('category.edit', $project))
    //     ->assertSessionHasErrors(['max4']);
    //     $project->refresh();
    //     $this->assertSame($project->cat4->maximum,39);
    // }

    // /** @test */
    // function when_updating_the_salary_categories_of_a_project_the_values_can_be_numeric()
    // {
    //     $project = $this->createRandomProject();

    //     //Category 1
    //     $this->from(route('category.edit', $project))
    //     ->put(
    //         route('category.update', $project),
    //         $this->getCustomCategoriesData([
    //             'min1' => 'no-numeric',
    //     ]))
    //     ->assertRedirect(route('category.edit', $project))
    //     ->assertSessionHasErrors(['min1']);
    //     $project->refresh();
    //     $this->assertSame($project->cat1->minimum,1);

    //     $this->from(route('category.edit', $project))
    //     ->put(
    //         route('category.update', $project),
    //         $this->getCustomCategoriesData([
    //             'max1' => null,
    //     ]))
    //     ->assertRedirect(route('category.edit', $project))
    //     ->assertSessionHasErrors(['max1']);
    //     $project->refresh();
    //     $this->assertSame($project->cat1->maximum,9);
    // }

    // /** @test */
    // function when_updating_the_salary_categories_of_a_project_the_values_can_be_valid()
    // {
    //     $project = $this->createRandomProject();
        
    //     // Validate Minimum 1
    //     $this->from(route('category.edit', $project))
    //     ->put(
    //         route('category.update', $project),
    //         $this->getCustomCategoriesData([
    //             'min1' => '2',
    //             'max1' => '1',
    //             'min2' => '3',
    //     ]))
    //     ->assertRedirect(route('category.edit', $project))
    //     ->assertSessionHasErrors(['min1']);

        // // Validate Maximum 1
        // $this->from(route('category.edit', $project))
        // ->put(
        //     route('category.update', $project),
        //     $this->getCustomCategoriesData([
        //         'min1' => '1',
        //         'max1' => '4',
        //         'min2' => '3',
        // ]))
        // ->assertRedirect(route('category.edit', $project))
        // ->assertSessionHasErrors(['max1']);

        // // Validate Minimum 2
        // $this->from(route('category.edit', $project))
        // ->put(
        //     route('category.update', $project),
        //     $this->getCustomCategoriesData([
        //         'min1' => '1',
        //         'max1' => '3',
        //         'min2' => '7',
        //         'max2' => '5',
        // ]))
        // ->assertRedirect(route('category.edit', $project))
        // ->assertSessionHasErrors(['min2']);

        // // Validate Maximum 2
        // $this->from(route('category.edit', $project))
        // ->put(
        //     route('category.update', $project),
        //     $this->getCustomCategoriesData([
        //         'min1' => '1',
        //         'max1' => '3',
        //         'min2' => '5',
        //         'max2' => '9',
        //         'min3' => '8',
        // ]))
        // ->assertRedirect(route('category.edit', $project))
        // ->assertSessionHasErrors(['max2']);

        // // Validate Minimum 3
        // $this->from(route('category.edit', $project))
        // ->put(
        //     route('category.update', $project),
        //     $this->getCustomCategoriesData([
        //         'min1' => '1',
        //         'max1' => '3',
        //         'min2' => '4',
        //         'max2' => '5',
        //         'min3' => '8',
        //         'max3' => '6',
        // ]))
        // ->assertRedirect(route('category.edit', $project))
        // ->assertSessionHasErrors(['min3']);

        // // Validate Maximum 3
        // $this->from(route('category.edit', $project))
        // ->put(
        //     route('category.update', $project),
        //     $this->getCustomCategoriesData([
        //         'min1' => '1',
        //         'max1' => '3',
        //         'min2' => '4',
        //         'max2' => '5',
        //         'min3' => '6',
        //         'max3' => '10',
        //         'min4' => '8',
        // ]))
        // ->assertRedirect(route('category.edit', $project))
        // ->assertSessionHasErrors(['max3']);

        // // Validate Minimum 4
        // $this->from(route('category.edit', $project))
        // ->put(
        //     route('category.update', $project),
        //     $this->getCustomCategoriesData([
        //         'min1' => '1',
        //         'max1' => '2',
        //         'min2' => '3',
        //         'max2' => '4',
        //         'min3' => '5',
        //         'max3' => '6',
        //         'min4' => '9',
        //         'max4' => '8',
        // ]))
        // ->assertRedirect(route('category.edit', $project))
        // ->assertSessionHasErrors(['min4']);

        // // Validate Maximum 4
        // $this->from(route('category.edit', $project))
        // ->put(
        //     route('category.update', $project),
        //     $this->getCustomCategoriesData([
        //         'min1' => '1',
        //         'max1' => '2',
        //         'min2' => '3',
        //         'max2' => '4',
        //         'min3' => '5',
        //         'max3' => '6',
        //         'min4' => '9',
        //         'max4' => '8',
        // ]))
        // ->assertRedirect(route('category.edit', $project))
        // ->assertSessionHasErrors(['max4']);
        // }

}