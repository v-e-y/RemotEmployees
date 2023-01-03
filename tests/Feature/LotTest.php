<?php

namespace Tests\Feature;

use App\Models\Category;
use Tests\TestCase;
use App\Models\Condition;
use App\Models\Product;
use App\Repositories\CategoryRepository;
use Illuminate\Foundation\Testing\WithFaker;

class LotTest extends TestCase
{
    use WithFaker;

    private string $name;
    private float $price;
    private string $description;
    private string $conditionId;
    private array $categories;

    protected function setUp(): void
    {
        parent::setUp();

        $this->name = 'test_' . $this->faker->words(random_int(3, 5), true);
        $this->price = $this->faker->randomFloat(2, 1, 500);
        $this->description = $this->faker->text(random_int(50, 300));
        $this->conditionId = Condition::inRandomOrder()->limit(1)->first()->id;
        $this->categories = CategoryRepository::getAllCategories()
            ->random(3)->pluck('id')->toArray();
    }

    public function test_create_lot_link_showed()
    {
        $this->get(
            '/'
        )->assertSeeText('Add lot');
    }

    public function test_create_lot_page_response_ok()
    {
        $this->get(
            route('product.create')
        )->assertOk();
    }

    public function test_create_lot_form_field_text_name_show()
    {
        $this->get(
            route('product.create')
        )->assertSeeText('Lot name');
    }

    public function test_create_lot_form_field_text_price_show()
    {
        $this->get(
            route('product.create')
        )->assertSeeText('Price');
    }

    public function test_create_lot_form_field_text_condition_show()
    {
        $this->get(
            route('product.create')
        )->assertSeeText('Condition');
    }

    public function test_create_lot_form_field_text_description_show()
    {
        $this->get(
            route('product.create')
        )->assertSeeText('Description');
    }

    public function test_create_lot_form_field_text_category_show()
    {
        $this->get(
            route('product.create')
        )->assertSeeText('Choose a categories:');
    }

    public function test_create_lot_form_field_text_categories_show()
    {
        $response = $this->get(
            route('product.create')
        );

        foreach (CategoryRepository::getAllCategories() as $category) {
            $response->assertSeeText($category->name);
        }
    }

    public function test_create_lot_form_submit_button_show()
    {
        $this->get(
            route('product.create')
        )->assertSeeText('Add lot');
    }

    public function test_create_lot_send_post_all_and_good_data()
    {
        $response = $this->post(
            route('product.store'),
            [
                'price' => $this->price,
                'name' => $this->name,
                'description' => $this->description,
                'condition_id' => $this->conditionId,
                'categories' => $this->categories
            ]
        );

        $response->assertStatus(201);
    }

    public function test_create_lot_send_post_bad_data_name_empty()
    {
        $response = $this->post(
            route('product.store'),
            [
                'price' => $this->price,
                'name' => '',
                'description' => $this->description,
                'condition_id' => $this->conditionId,
                'categories' => $this->categories
            ]
        );

        $response->assertStatus(302);
        $response->assertSessionHasErrors('name');
    }

    public function test_create_lot_send_post_bad_data_name_long()
    {
        $response = $this->post(
            route('product.store'),
            [
                'price' => $this->price,
                'name' => $this->faker->words(500, true),
                'description' => $this->description,
                'condition_id' => $this->conditionId,
                'categories' => $this->categories
            ]
        );

        $response->assertStatus(302);
        $response->assertSessionHasErrors('name');
    }

    public function test_create_lot_send_post_bad_data_price_empty()
    {
        $response = $this->post(
            route('product.store'),
            [
                'price' => '',
                'name' => $this->name,
                'description' => $this->description,
                'condition_id' => $this->conditionId,
                'categories' => $this->categories
            ]
        );

        $response->assertStatus(302);
        $response->assertSessionHasErrors('price');
    }

    public function test_create_lot_send_post_bad_data_price_wrong_format()
    {
        $response = $this->post(
            route('product.store'),
            [
                'price' => 'price',
                'name' => $this->name,
                'description' => $this->description,
                'condition_id' => $this->conditionId,
                'categories' => $this->categories
            ]
        );

        $response->assertStatus(302);
        $response->assertSessionHasErrors('price');
    }

    public function test_create_lot_send_post_bad_data_description_empty()
    {
        $response = $this->post(
            route('product.store'),
            [
                'price' => $this->price,
                'name' => $this->name,
                'description' => '',
                'condition_id' => $this->conditionId,
                'categories' => $this->categories
            ]
        );

        $response->assertStatus(302);
        $response->assertSessionHasErrors('description');
    }

    public function test_create_lot_send_post_bad_data_description_long()
    {
        $response = $this->post(
            route('product.store'),
            [
                'price' => $this->price,
                'name' => $this->name,
                'description' => $this->faker->words(2000, true),
                'condition_id' => $this->conditionId,
                'categories' => $this->categories
            ]
        );

        $response->assertStatus(302);
        $response->assertSessionHasErrors('description');
    }

    public function test_create_lot_send_post_bad_data_condition_empty()
    {
        $response = $this->post(
            route('product.store'),
            [
                'price' => $this->price,
                'name' => $this->name,
                'description' => $this->description,
                'condition_id' => '',
                'categories' => $this->categories
            ]
        );

        $response->assertStatus(302);
        $response->assertSessionHasErrors('condition_id');
    }

    public function test_create_lot_send_post_bad_data_condition_wrong_data()
    {
        $response = $this->post(
            route('product.store'),
            [
                'price' => $this->price,
                'name' => $this->name,
                'description' => $this->description,
                'condition_id' => 999,
                'categories' => $this->categories
            ]
        );

        $response->assertStatus(302);
        $response->assertSessionHasErrors('condition_id');
    }

    public function test_create_lot_send_post_category_empty()
    {
        $response = $this->post(
            route('product.store'),
            [
                'price' => $this->price,
                'name' => $this->name,
                'description' => $this->description,
                'condition_id' => $this->conditionId,
                'categories' => ''
            ]
        );

        $response->assertStatus(302);
        $response->assertSessionHasErrors('categories');
    }

    public function test_create_lot_send_post_bad_data_category_wrong_data()
    {
        $response = $this->post(
            route('product.store'),
            [
                'price' => $this->price,
                'name' => $this->name,
                'description' => $this->description,
                'condition_id' => $this->conditionId,
                'categories' => [333]
            ]
        );

        $response->assertStatus(302);
        $response->assertSessionHasErrors('categories.*');
    }

    public function test_created_lot_showed_on_home_page()
    {
        $response = $this->post(
            route('product.store'),
            [
                'price' => $this->price,
                'name' => $this->name,
                'description' => $this->description,
                'condition_id' => $this->conditionId,
                'categories' => $this->categories
            ]
        );

        $response->assertStatus(201);

        $homePage = $this->get('/');

        $homePage->assertSeeText($this->name)->assertSeeText($this->description);
    }

    public function test_created_lot_showed_on_category_page()
    {
        $response = $this->post(
            route('product.store'),
            [
                'price' => $this->price,
                'name' => $this->name,
                'description' => $this->description,
                'condition_id' => $this->conditionId,
                'categories' => $this->categories
            ]
        );

        $response->assertStatus(201);

        foreach ($this->categories as $category) {
            $categoryPage = $this->get(
                route('category.showProducts', [Category::find($category)->slug])
            );

            $categoryPage->assertSeeText($this->name)->assertSeeText($this->description);
        }
    }
}
