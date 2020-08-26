<?php

use App\Models\Form;
use App\Models\Task;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Addon;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::find(1);

        $service = $user->products()->create([
            'title' => 'Sample Service',
            'description' => ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec consequat purus. Proin congue felis vitae neque dignissim varius. Mauris ullamcorper eleifend quam, a convallis ligula. Maecenas vulputate tortor non posuere ultricies. Mauris luctus sed neque vitae ornare. Curabitur sollicitudin hendrerit lorem, sit amet consequat ipsum. Maecenas at urna ac erat feugiat vulputate sit amet ac nisl. Vivamus eu nulla in purus finibus facilisis. Phasellus sit amet venenatis eros. Suspendisse vulputate, tortor quis mollis tempor, sem dui vulputate felis, vitae suscipit justo diam sit amet justo.',
            'price' => '12.00',
            'status' => 'publish',
            'form_id' => Form::all()->first()->id
        ]);

        $addon = Addon::create([
            'name' => 'Fast Delivery',
            'description' => 'Fast Delivery'
        ]);

        $service->addons()->sync([$addon->id => ['price' => '8.00']]);

        $tasks = [
            ['name' => 'Basic SEO Optimization'],
            ['name' => 'Basic Security Optimization'],
            ['name' => 'Basic Performance Optimization']
        ];

        foreach ($tasks as $task) {
            $service->tasks()->save(new Task($task));
        }

        $meta_array = [
            'guideline' => 'Vestibulum vulputate risus neque, eu ullamcorper ipsum iaculis eu. Fusce ullamcorper ut orci sed cursus. Morbi ullamcorper, sem fringilla laoreet laoreet, mauris erat dictum felis, id placerat nisi erat quis ante.',
            'demo_url' => 'http://www.chargepanda.com/',
            'delivery_time' => '3 Days',
            'revisions' => '4',
            'variable_pricing_enabled' => '0',
        ];

        foreach ($meta_array as $key => $value) {
            $newMeta = new App\Models\ProductMeta(['key' => $key]);
            $meta = $service->meta()->where('key', $key)->first() ?: $newMeta->product()->associate($service);

            if (is_array($value)) {
                $value = serialize($value);
            }

            $meta->value = $value;
            $meta->save();
        }

    }
}
